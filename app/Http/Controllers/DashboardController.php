<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\App;
use App\Models\Template;
use App\Models\FeaturedOffer;
use App\Models\Setting;
use App\Models\Contact;
use App\Models\Tracking;
use App\Models\AppBlocker;
use App\Models\TrafficTracking;
use App\Models\ConversionErrorTracker;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index(Request $request){
        $userCountry = $this->getUserCountry(request()->ip());
        $allBlockers = $this->GetBlockers($userCountry);
        if($allBlockers['country'] || $allBlockers['emulator']){
            return redirect()->route('blocked');
        }
        $cookieValue = NULL;
        $requestedParams = $request->all();
        if(!isset($requestedParams['userId'])){
            $requestedParams['userId'] = 0;
        }
        if(!isset($requestedParams['sub4'])){
            $requestedParams['sub4'] = NULL;
        }
        if(!isset($requestedParams['sub5'])){
            $requestedParams['sub5'] = NULL;
        }
        if(!isset($requestedParams['sub6'])){
            $requestedParams['sub6'] = NULL;
        }
        if(!empty($request->apiKey) && !empty($request->wallId)){
            $affiliateRecord = User::where('api_key',$request->apiKey)->where('status',1)->first();
            $appDetails = App::where('appId',$request->wallId)->where('status',1)->first();
            if(empty($affiliateRecord) || empty($appDetails)){
                die('Invalid Details');
            }
            $offerWallTemplate = Template::where('app_id',$appDetails->id)->first();
            if(empty($offerWallTemplate)){
                $offerWallTemplate = Template::find(1);
            }
            $offerSettings = Setting::find(1);
            if(!empty($affiliateRecord) && !empty($appDetails)){
                //User Agents
                $agentDetails = new Agent();

                if ($agentDetails->isMobile()) {
                    $deviceType = 'mobile';
                } elseif ($agentDetails->isTablet()) {
                    $deviceType = 'tablet';
                } else {
                    $deviceType = 'desktop';
                }
                $operatingSystem = $agentDetails->platform();
                $osMapping = [
                    'OS X'       => 'Mac OS X',  // Correcting macOS older naming
                    'macOS'      => 'macOS',     // Modern macOS name
                    'Windows'    => 'Windows',
                    'Windows NT' => 'Windows',   // Some user agents report Windows NT
                    'AndroidOS'  => 'Android',
                    'Android'    => 'Android',
                    'iOS'        => 'iOS',
                    'iPadOS'     => 'iPadOS',    // iPads have separate OS
                    'Linux'      => 'Linux',
                    'Ubuntu'     => 'Ubuntu',
                    'CrOS'       => 'Chrome OS'  // Chrome OS detection (optional)
                ];
                $operatingSystem = $osMapping[$operatingSystem] ?? $operatingSystem;
                //End

                //Get Featured Offer List
                $featuredOffer = FeaturedOffer::whereRaw("FIND_IN_SET(?, affiliates)", [$affiliateRecord->id])
                ->whereRaw("FIND_IN_SET(?, countries)", [$userCountry])
                ->whereRaw("FIND_IN_SET(?, devices)", [$deviceType])
                ->orderBy('id', 'ASC')
                ->first();
                if(!emptY($featuredOffer)){
                    $url_feat = $offerSettings->affise_endpoint . "offer/{$featuredOffer->offer_id}";
                    $response_feat = HTTP::withHeaders([
                        'API-Key' => $affiliateRecord->affise_api_key,
                    ])->get($url_feat);
                    if ($response_feat->successful()) {
                        $featuredOfferDetails = $response_feat->json();
                    }
                }

                $url = $offerSettings->affise_endpoint . "partner/offers?sort[epc]=desc&limit=50&countries[]=$userCountry";
                $response = HTTP::withHeaders([
                    'API-Key' => $affiliateRecord->affise_api_key,
                ])->get($url);
                if ($response->successful()) {
                    $allOffers = $response->json();
                    if(!empty($featuredOfferDetails)){
                        $featuredOfferDetails['offer']['isfeat'] = 1;
                        $mergedOffers = array_merge([$featuredOfferDetails['offer']], $allOffers['offers']);
                        $allOffers['offers'] = $mergedOffers;
                    }

                    //add cookie
                    $cookieValue = $this->checkAndSetCookie();
                }else{
                    die('No offer found');
                }
            }else{
                die('Not a valid affiliate');
            }
        }else{
            die('Not a valid request');
        }
        
        if($allBlockers['vpn']){
            $isVpn = $this->checkVpn();
        }else{
            $isVpn = false;
        }

        return view('offerwall',compact('allOffers','offerWallTemplate','offerSettings','appDetails','deviceType','cookieValue','requestedParams','userCountry','isVpn','operatingSystem','featuredOffer'));
    }

    public function detectDeviceType(){
        $userAgent = request()->header('User-Agent');
        // Custom OS mapping based on patterns
        $osArray = [
            'Windows' => 'Windows NT',
            'MacOS'   => 'Macintosh',
            'iOS'     => 'iPhone|iPad|iPod',
            'Android' => 'Android',
            'Linux'   => 'Linux',
            'Ubuntu'  => 'Ubuntu',
        ];

        $detectedOS = 'Unknown OS';

        // Matching user agent with OS patterns
        foreach ($osArray as $os => $pattern) {
            if (stripos($userAgent, $pattern) !== false) {
                $detectedOS = $os;
                break;
            }
        }
        return $detectedOS;
    }

    public function GetBlockers($userCountry){
        $vpnBlocker = AppBlocker::where('id',1)->where('enabled',1)->first();
        $rootedBlocker = AppBlocker::where('id',2)->where('enabled',1)->first();
        $termuxBlocker = AppBlocker::where('id',3)->where('enabled',1)->first();
        $emulatorBlocker = AppBlocker::where('id',4)->where('enabled',1)->first();
        $countryBlocker = AppBlocker::where('id',5)->where('enabled',1)->whereJsonContains('countries',$userCountry)->first();
        $enabledBlockers = [
            'vpn' => false,
            'rooted' => false,
            'termux' => false,
            'emulator' => false,
            'country' => false,
        ];
        if($vpnBlocker){
            $enabledBlockers['vpn']=  true;
        }
        if($rootedBlocker){
            $enabledBlockers['rooted']=  true;
        }
        if($termuxBlocker){
            $enabledBlockers['termux']=  true;
        }
        if($emulatorBlocker){
            $userAgent = request()->header('User-Agent');

            // Common emulator keywords in User-Agent
            $emulatorKeywords = [
                'BlueStacks', 'Nox', 'Genymotion', 'Emulator', 'SDK', 
                'GoogleSDK', 'X86', 'Xamarin', 'Andy', 'VirtualBox', 'VMware'
            ];

            foreach ($emulatorKeywords as $keyword) {
                if (stripos($userAgent, $keyword) !== false) {
                    $enabledBlockers['emulator']=  true;
                }
            }
        }
        if($countryBlocker){
            $enabledBlockers['country']=  true;
        }

        return $enabledBlockers;
    }

    public function checkVpn()
    {
        $ip = request()->ip();
        $isVpn = false;
        $response = file_get_contents("http://ip-api.com/json/{$ip}?fields=status,message,country,countryCode,region,regionName,city,zip,lat,lon,timezone,isp,org,as,proxy,query");
        $data = json_decode($response, true);
        if (!empty($data['proxy']) && $data['proxy'] === true) {
            $isVpn = true;
        }

        // Check known VPN ISPs
        $vpnProviders = ["NordVPN", "ExpressVPN", "CyberGhost", "ProtonVPN", "Surfshark"];
        if (isset($data['isp']) && in_array($data['isp'], $vpnProviders)) {
            $isVpn = true;
        }

        // Check AS number (many VPNs use specific ASNs)
        // if (isset($data['as']) && strpos($data['as'], "AS") !== false) {
        //     $isVpn = true;
        // }
        return $isVpn;
    }

    function checkAndSetCookie()
    {
        $cookieName = 'userCookie';
        if (isset($_COOKIE[$cookieName])) {
            return $_COOKIE[$cookieName];
        }
        
        $cookieValue = rand();
        setcookie($cookieName, $cookieValue, time() + (10 * 365 * 24 * 60 * 60), "/", "", false, false);
        return $cookieValue;
    }

    public function track(Request $request){
        if(!isset($_COOKIE['userCookie'])){
            $this->checkAndSetCookie();
        }
        $offerSettings = Setting::find(1);
        $redirectingTo = base64_decode(urldecode($request->query('ufto')));
        $fullQueryparam = parse_url($redirectingTo, PHP_URL_QUERY);
        parse_str($fullQueryparam, $paramValues);
        $affiseOfferId = $paramValues['offer_id'] ?? null;
        $appId = $request->query('wall');
        if (!empty($redirectingTo) && $appId>0) {
            $appDetails = App::where('appId',$appId)->first();
            $userDetails = User::find($appDetails->affiliateId);
            $trackingData = new Tracking();
            $trackingData->visitor_id = $_COOKIE['userCookie'];
            $trackingData->webmaster_id = $request->webmaster_id;
            $trackingData->sub4 = $request->sub4;
            $trackingData->sub5 = $request->sub5;
            $trackingData->sub6 = $request->sub6;
            $trackingData->app_id = $appDetails->id;
            $trackingData->offer_id = $affiseOfferId;
            $trackingData->offer_name = $request->offer_name;
            $trackingData->reward = $request->reward;
            $trackingData->user_id = $appDetails->affiliateId;
            $trackingData->affiliate_id = $userDetails->affiseId;
            $trackingData->save();

            //Tracking Traffic
            $agentDetails = new Agent();
            if ($agentDetails->isMobile()) {
                $deviceType = 'mobile';
            } elseif ($agentDetails->isTablet()) {
                $deviceType = 'tablet';
            } else {
                $deviceType = 'desktop';
            }
            $operatingSystem = $agentDetails->platform();
            $osMapping = [
                'OS X'       => 'Mac OS X',  // Correcting macOS older naming
                'macOS'      => 'macOS',     // Modern macOS name
                'Windows'    => 'Windows',
                'Windows NT' => 'Windows',   // Some user agents report Windows NT
                'AndroidOS'  => 'Android',
                'Android'    => 'Android',
                'iOS'        => 'iOS',
                'iPadOS'     => 'iPadOS',    // iPads have separate OS
                'Linux'      => 'Linux',
                'Ubuntu'     => 'Ubuntu',
                'CrOS'       => 'Chrome OS'  // Chrome OS detection (optional)
            ];
            $operatingSystem = $osMapping[$operatingSystem] ?? $operatingSystem;
            $userCountry = $this->getUserCountry(request()->ip());
            TrafficTracking::create([
                'tracking_id' => $trackingData->id,
                'device' => $deviceType,
                'os' => $operatingSystem,
                'country' => $userCountry,
                'caps' => NULL,
                'agent' => request()->header('User-Agent')
            ]);
            $redirectingTo.= '&sub1='.base64_encode($trackingData->id).'&sub2='.$offerSettings->offer_alias.'&sub3='.base64_encode($appDetails->id); 
            
            if (!empty($trackingData->sub4)) {
                $redirectingTo .= '&sub4=' .$trackingData->sub4;
            }
            if (!empty($trackingData->sub5)) {
                $redirectingTo .= '&sub5=' .$trackingData->sub5;
            }
            if (!empty($trackingData->sub6)) {
                $redirectingTo .= '&sub6=' .$trackingData->sub6;
            }
            
            return redirect()->away($redirectingTo);
        }
        die('Not a valid request');
    }

    public function updateConversion(){
        set_time_limit(-1); 
        $advertiserDetails = Setting::find(1);
        $allActiveAffiliates = User::where('status',1)->where('role','affiliate')->get();
        $previousDate = Carbon::yesterday()->toDateString();
        $currentDate = Carbon::today()->toDateString();

        if($allActiveAffiliates->isNotEmpty()){
            foreach($allActiveAffiliates as $affiliate){
                $affiliateAffiseId = $affiliate->affiseId;
                $clickUrl = $advertiserDetails->affise_endpoint . "stats/clicks?limit=500&date_from={$previousDate}&date_to={$currentDate}&partner[]={$affiliateAffiseId}";
                $response = HTTP::withHeaders([
                    'API-Key' =>  $advertiserDetails->affise_api_key,
                ])->get($clickUrl);
                if ($response->successful()) {
                    $allClicks = $response->json();
                    if(!empty($allClicks['clicks'])){
                        foreach($allClicks['clicks'] as $clicKey => $clickValue){
                            if($clickValue['sub2']!=$advertiserDetails->offer_alias){
                                continue;
                            }
                            if (intval($clickValue['sub1']) > 0) {}
                            else{
                                $clickValue['sub1'] = base64_decode($clickValue['sub1']);
                            }

                            if (intval($clickValue['sub3']) > 0) {}
                            else{
                                $clickValue['sub3'] = base64_decode($clickValue['sub3']);
                            }
                            
                            if($clickValue['sub1']>0 && $clickValue['sub3']>0){
                                $ifAlreadyAdded = Tracking::where('click_id',$clickValue['click_id'])->first();
                                if(empty($ifAlreadyAdded)){
                                    $validateTracking = Tracking::find($clickValue['sub1']);
                                    //Check device Type
                                    if (preg_match('/mobile/i', $clickValue['ua'])) {
                                        $deviceType = 'Mobile';
                                    } elseif (preg_match('/tablet|ipad|playbook|silk/i', $clickValue['ua'])) {
                                        $deviceType = 'Tablet';
                                    } else {
                                        $deviceType = 'Desktop';
                                    }
                                    //$deviceIsp = $this->getIsp($clickValue['ip']);
                                    $deviceIsp = 'Unknown';
                                    if(!empty($validateTracking)){
                                        $validateTracking->country_code = $clickValue['country'];
                                        $validateTracking->country_name = $clickValue['country_name'];
                                        $validateTracking->browser = $clickValue['browser'];
                                        $validateTracking->device_brand = $clickValue['device'];
                                        $validateTracking->device_model = $clickValue['device_model'];
                                        $validateTracking->device_os = $clickValue['os'];
                                        $validateTracking->device_type = $deviceType;
                                        $validateTracking->isp = $deviceIsp;
                                        $validateTracking->ip = $clickValue['ip'];
                                        $validateTracking->ua = $clickValue['ua'];
                                        $validateTracking->goal = NULL;
                                        $validateTracking->click_id = $clickValue['click_id'];
                                        $validateTracking->click_time = $clickValue['created_at'];
                                        $validateTracking->conversion_id = NULL;
                                        $validateTracking->conversion_time = NULL;
                                        $validateTracking->payout = NULL;
                                        $validateTracking->revenue = NULL;
                                        $validateTracking->status = 0;
                                        $validateTracking->postback_sent = 0;
                                        $validateTracking->save();
                                    }else{
                                        $errorTracking = new ConversionErrorTracker();
                                        $errorTracking->offer_id = $clickValue['offer']['id'];
                                        $errorTracking->click_id = $clickValue['click_id'];
                                        $errorTracking->conversion_id = NULL;
                                        $errorTracking->save();
                                    }
                                }
                            }
                        }
                    }
                }
            
                //updating the conversions of all added clicks
                //only confirmed and declined
                $url = $advertiserDetails->affise_endpoint . "stats/conversions?limit=500&date_from={$previousDate}&date_to={$currentDate}&subid2={$advertiserDetails->offer_alias}&partner[]={$affiliateAffiseId}&status[]=1&status[]=3";
                $response = HTTP::withHeaders([
                    'API-Key' => $advertiserDetails->affise_api_key,
                ])->get($url);
                if ($response->successful()) {
                    $allConversion = $response->json();

                    if(!empty($allConversion['conversions'])){
                        foreach($allConversion['conversions'] as $key => $value){
                            if($value['sub2']==$advertiserDetails->offer_alias){
                                if (intval($value['sub1']) > 0) {}
                                else{
                                    $value['sub1'] = base64_decode($value['sub1']);
                                }

                                if (intval($value['sub3']) > 0) {}
                                else{
                                    $value['sub3'] = base64_decode($value['sub3']);
                                }
                                if($value['sub3']>0 && $value['sub1']>0){
                                    if($value['status']!='confirmed' && strtolower($value['comment'])!='fraud'){
                                        continue;
                                    }
                                    $ifAlreadyAdded = Tracking::where('conversion_id',$value['conversion_id'])->first();
                                    if(empty($ifAlreadyAdded)){
                                        $TrackingDetails = Tracking::find($value['sub1']);
                                        if(empty($TrackingDetails)){
                                            continue;
                                        }
                                        if($TrackingDetails->conversion_id!==NULL){
                                            $TrackingDetails = $this->insertNewWithSame($value['sub1']);
                                        }
                                        if (!empty($TrackingDetails)) {
                                            $appDetail = App::find($TrackingDetails->app_id);
                                            $TrackingDetails->conversion_id = $value['conversion_id'];
                                            $TrackingDetails->conversion_time = $value['created_at'];
                                            $TrackingDetails->payout = $value['payouts'];
                                            $TrackingDetails->revenue = $value['revenue'];
                                            $TrackingDetails->goal = $value['goal_value'];
                                            if($value['status']=='confirmed'){
                                                $TrackingDetails->postback_sent = 1;
                                                $TrackingDetails->status = 1;
                                            }else{
                                                if(strtolower($value['comment'])=='fraud'){
                                                    $TrackingDetails->postback_sent = 0;
                                                    $TrackingDetails->reason = 'Fraud';
                                                    $TrackingDetails->status = 2;
                                                }else{
                                                    continue;
                                                }
                                            }

                                            //creating signature
                                            $signatureUserId= (strpos($appDetail->postback, '{user_id}') !== false) ? $TrackingDetails->webmaster_id : null;
                                            $signatureClickId = (strpos($appDetail->postback, '{click_id}') !== false) ? $TrackingDetails->click_id : null;
                                            $signatureTrackingId = (strpos($appDetail->postback, '{tracking_id}') !== false) ? $TrackingDetails->id : null;
                                            $signatureAppId = (strpos($appDetail->postback, '{app_id}') !== false) ? $TrackingDetails->app_id : null;
                                            $TrackingDetails->signature = md5($signatureUserId.$signatureClickId.$signatureTrackingId.$signatureAppId.$appDetail->secrect_key);
                                            //End

                                            //defining postback url with parameters
                                            $replacements = [
                                                '{user_id}' => $TrackingDetails->webmaster_id,
                                                '{reward}' => $TrackingDetails->reward,
                                                '{status}' => 'Approved',
                                                '{payout}' => $value['payouts'],
                                                '{offer_id}' => $TrackingDetails->offer_id,
                                                '{offer_name}' => $TrackingDetails->offer_name,
                                                '{goal}' => $TrackingDetails->goal,
                                                '{device_type}' => $TrackingDetails->device_type,
                                                '{geo}' => $TrackingDetails->country_code,
                                                '{ip}' => $TrackingDetails->ip,
                                                '{os}' => $TrackingDetails->device_os,
                                                '{user_agent}' => $TrackingDetails->ua,
                                                '{click_id}' => $TrackingDetails->click_id,
                                                '{app_id}' => $TrackingDetails->app_id,
                                                '{tracking_id}' => $TrackingDetails->id
                                            ];
                                            
                                            $postbackUrl = strtr($appDetail->postback, $replacements);      
                                            $postbackUrl = $postbackUrl.'&signature='.$TrackingDetails->signature;      
                                            if(!empty($TrackingDetails->sub4)){
                                                $postbackUrl.='&sub4='.$TrackingDetails->sub4;
                                            }
                                            if(!empty($TrackingDetails->sub5)){
                                                $postbackUrl.='&sub5='.$TrackingDetails->sub5;
                                            }
                                            if(!empty($TrackingDetails->sub6)){
                                                $postbackUrl.='&sub6='.$TrackingDetails->sub6;
                                            }
                                            if($value['status']=='confirmed'){                        
                                                $TrackingDetails->postback_url = $postbackUrl;

                                                //fire postback on webmaster
                                                $postBackStatus = $this->sendPostback($postbackUrl);
                                                $TrackingDetails->http_code = $postBackStatus['http_code'] ?? '500';
                                                $TrackingDetails->error = $postBackStatus['error'] ?? NULL;
                                                //end
                                            }
                                            $TrackingDetails->save();
                                        }else{
                                            $errorTracking = new ConversionErrorTracker();
                                            $errorTracking->offer_id = $value['offer_id'];
                                            $errorTracking->click_id = $value['clickid'];
                                            $errorTracking->conversion_id = $value['conversion_id'].'---0';
                                            $errorTracking->save();
                                        }
                                    }
                                }else{
                                    $errorTracking = new ConversionErrorTracker();
                                    $errorTracking->offer_id = $value['offer_id'];
                                    $errorTracking->click_id = $value['clickid'];
                                    $errorTracking->conversion_id = $value['conversion_id'];
                                    $errorTracking->save();
                                }
                            }
                        }
                    }
                }
            }
        }
        
        die('done');
    }

    function isBase64Encoded($string) {
        // Must be a string and not empty
        if (!is_string($string) || $string === '') {
            return false;
        }

        // Check if length is a multiple of 4
        if (strlen($string) % 4 !== 0) {
            return false;
        }

        // Check if it contains only valid base64 characters
        if (!preg_match('/^[A-Za-z0-9+\/]*={0,2}$/', $string)) {
            return false;
        }

        // Decode in strict mode
        $decoded = base64_decode($string, true);
        if ($decoded === false) {
            return false;
        }

        // Check if encoding the decoded result gives original input (with padding considered)
        // Padding may differ (extra =), so normalize both sides before comparing
        return base64_encode($decoded) === $string;
    }


    public function insertNewWithSame($id){
        $original = Tracking::find($id); 

        if ($original) {
            // Convert to array and remove unwanted columns
            $data = $original->toArray();
            $data['goal'] = NULL;
            $data['conversion_id'] = NULL;
            $data['conversion_time'] = NULL;
            $data['payout'] = NULL;
            $data['revenue'] = NULL;
            $data['postback_sent'] = 0;
            $data['postback_url'] = NULL;
            $data['http_code'] = NULL;
            $data['error'] = NULL;
            $data['signature'] = NULL;
            $data['status'] = 0;
            $data['reason'] = NULL;
            unset($data['id'], $data['created_at'], $data['updated_at']);
            // Create a new record with the remaining data
            return Tracking::create($data);
        }

    }

    public function sendPostback($url){
        try {
            $response = Http::timeout(10)->get($url);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'error' => null,
                    'http_code' => $response->status(),
                    'response' => $response->body(),
                ];
            }

            return [
                'success' => false,
                'error' => "HTTP Error: " . $response->status(),
                'http_code' => $response->status(),
                'response' => $response->body(),
            ];
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'http_code' => $e->response ? $e->response->status() : 500,
                'response' => $e->response ? $e->response->body() : null,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'http_code' => 500,
                'response' => null,
            ];
        }
    }

    public function serverPostbacks(){
        $advertiserDetails = Setting::find(1);
        $previousDate = Carbon::yesterday()->toDateString();
        $currentDate = Carbon::today()->toDateString();
        $clickUrl = $advertiserDetails->affise_endpoint . "stats/serverpostbacks?limit=500&date_from={$previousDate}&date_to={$currentDate}";
        $response = HTTP::withHeaders([
            'API-Key' => $advertiserDetails->affise_api_key,
        ])->get($clickUrl);
        if ($response->successful()) {
            $allPostbacks = $response->json();
            if(!empty($allPostbacks['postbacks'])){
                //67c57e0313757622cb3939ed
                foreach($allPostbacks['postbacks'] as $postbackDetail){
                    $existingConversion = Tracking::where('conversion_id',$postbackDetail['conversion_id'])->first();
                    if(!empty($existingConversion)){
                        $existingConversion->postback_url = $postbackDetail['postback_url'];
                        $existingConversion->http_code = $postbackDetail['http_code'];
                        $existingConversion->save();
                    }else{
                        continue;
                    }
                }
            }
        }
    }

    public function getIsp($ip){
        $apiUrl = "https://ipinfo.io/{$ip}/json";

        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);

        return $data['org'] ?? 'Unknown';
    }

    public function getUserCountry($ip)
    {
        $url = "http://ipinfo.io/{$ip}/json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        
        return $data['country'] ?? 'IN';
    }

    public function submitContact(Request $request){
        $contactDetails = new Contact();
        $contactDetails->name = $request->name;
        $contactDetails->email = $request->email;
        $contactDetails->message = $request->message;
        $contactDetails->save();
        echo 1;die;
    }

    public function completedOffers(Request $request){
        $offerSettings = Setting::find(1);
        $advertiserDetails = Setting::find(1);
        $allOffers = [
            'offers' => []
        ];
        if (isset($_COOKIE['userCookie'])) {
            $allTrackings = Tracking::whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('trackings')
                    ->where('visitor_id', $_COOKIE['userCookie'])
                    ->groupBy('offer_id');
            })->orderBy('id', 'DESC')->get();
            $allOffers = [
                'offers' => []
            ];

            if($allTrackings->isNotEmpty()){
                foreach($allTrackings as $trKey => $tracking){
                    $url = $advertiserDetails->affise_endpoint.'offer/'.$tracking->offer_id;
                    $response = HTTP::withHeaders([
                        'API-Key' => $advertiserDetails->affise_api_key,
                    ])->get($url);
                    
                    if ($response->successful()) {
                        $offerDetails = $response->json();
                        if(!$this->isValidImageUrl($offerDetails['offer']['logo'])){
                            $allOffers['offers'][$tracking->id]['logo'] = $offerSettings->default_image;
                        }else{
                            $allOffers['offers'][$tracking->id]['logo'] = $offerDetails['offer']['logo'];
                        }
                        $allOffers['offers'][$tracking->id]['description_lang'] = $offerDetails['offer']['description_lang']['en'];
                    }
                }
            }
        }
        $appDetails = App::where('appId',$request->wallId)->where('status',1)->first();
        $offerWallTemplate = Template::where('app_id',$appDetails->id)->first();
        if(empty($offerWallTemplate)){
            $offerWallTemplate = Template::find(1);
        }
        $requestedParams = $request->all();
        return view('completedoffers',compact('allOffers','offerWallTemplate','appDetails','requestedParams','offerSettings'));
        
    }

    function isValidImageUrl($url) {
        try {
            $response = Http::head($url);
    
            return $response->successful(); // Returns true if status is 200 OK
        } catch (\Exception $e) {
            return false;
        }
    }

    public function blocked(){
        return view('blocked');
    }

}
