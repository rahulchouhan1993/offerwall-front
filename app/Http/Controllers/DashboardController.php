<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\App;
use App\Models\Template;
use App\Models\Setting;
use App\Models\Contact;
use App\Models\Tracking;
use App\Models\ConversionErrorTracker;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Http;
class DashboardController extends Controller
{
    public function index(Request $request){
        if(!empty($request->apiKey) && !empty($request->wallId)){
            $affiliateRecord = User::where('api_key',$request->apiKey)->where('status',1)->first();
            $appDetails = App::where('appId',base64_decode($request->wallId))->where('status',1)->first();
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
                
                $userCountry = $this->getUserCountry(request()->ip());
                //End
                $url = env('AFFISE_API_END') . "partner/offers?sort[epc]=desc&limit=50&countries[]=$userCountry";
                $response = HTTP::withHeaders([
                    'API-Key' => $affiliateRecord->affise_api_key,
                ])->get($url);
                if ($response->successful()) {
                    $allOffers = $response->json();
                }else{
                    die('No offer found');
                }
            }else{
                die('Not a valid affiliate');
            }
        }else{
            die('Not a valid request');
        }
        return view('offerwall',compact('allOffers','offerWallTemplate','offerSettings','appDetails','deviceType'));
    }

    public function track(Request $request){
        $redirectingTo = base64_decode(urldecode($request->query('ufto')));
        $fullQueryparam = parse_url($redirectingTo, PHP_URL_QUERY);
        parse_str($fullQueryparam, $paramValues);
        $affiseOfferId = $paramValues['offer_id'] ?? null;
        $appId = base64_decode($request->query('wall'));
        if (!empty($redirectingTo) && $appId>0) {
            $appDetails = App::where('appId',$appId)->first();
            $redirectingTo.= '&sub2=offerwall&sub3='.$appDetails->id;
            return redirect()->away($redirectingTo);
        }
        die('Not a valid request');
    }

    public function updateConversion(){
        $previousDate = date('Y-m-d', strtotime('-1 day'));
        $currentDate = date('Y-m-d');
        //get all the clicks from the affise of a particular affiliate
        $allAffiliates = User::where('status',1)->where('role','affiliate')->get();
        if($allAffiliates && $allAffiliates->isNotEmpty()){
            foreach($allAffiliates as $affiliateKey => $affiliateValue){
                $affiseAffiliateId = $affiliateValue->affiseId;
                $clickUrl = env('AFFISE_API_END') . "stats/clicks?date_from={$previousDate}&date_to={$currentDate}&partner[]={$affiseAffiliateId}";
                $response = HTTP::withHeaders([
                    'API-Key' => '6235cc345962e5f2a43b5d6f9c4c7ad4',
                ])->get($clickUrl);
                if ($response->successful()) {
                    $allClicks = $response->json();
                    if(!empty($allClicks['clicks'])){
                        foreach($allClicks['clicks'] as $clicKey => $clickValue){
                            if($clickValue['sub2']!='offerwall'){
                                continue;
                            }
                            $validateTracking = Tracking::where('click_id',$clickValue['click_id'])->first();
                            if(empty($validateTracking)){
                                $trackingData = new Tracking();
                                $trackingData->app_id = $clickValue['sub3'];
                                $trackingData->offer_id = $clickValue['offer']['id'];
                                $trackingData->affiliate_id = $clickValue['partner_id'];
                                $trackingData->country_code = $clickValue['country'];
                                $trackingData->country_name = $clickValue['country_name'];
                                $trackingData->browser = $clickValue['browser'];
                                $trackingData->device_brand = $clickValue['device'];
                                $trackingData->device_model = $clickValue['device_model'];
                                $trackingData->device_os = $clickValue['os'];
                                $trackingData->ip = $clickValue['ip'];
                                $trackingData->ua = $clickValue['ua'];
                                $trackingData->goal = NULL;
                                $trackingData->click_id = $clickValue['click_id'];
                                $trackingData->click_time = $clickValue['created_at'];
                                $trackingData->conversion_id = NULL;
                                $trackingData->conversion_time = NULL;
                                $trackingData->payout = NULL;
                                $trackingData->revenue = NULL;
                                $trackingData->status = 0;
                                $trackingData->postback_sent = 0;
                                $trackingData->save();
                            }
                        }
                    }
                }
            }
        }
        
        //updating the conversions of all added clicks
        $url = env('AFFISE_API_END') . "stats/conversions?date_from={$previousDate}&date_to={$currentDate}&subid2=offerwall";
        $response = HTTP::withHeaders([
            'API-Key' => env('AFFISE_API_KEY'),
        ])->get($url);
        if ($response->successful()) {
            $allConversion = $response->json();
            if(!empty($allConversion['conversions'])){
                foreach($allConversion['conversions'] as $key => $value){
                    if($value['sub2']=='offerwall'){
                        if($value['sub3']>0){
                            $TrackingDetails = Tracking::where('click_id',$value['clickid'])->first();
                            if (!empty($TrackingDetails)) {
                                $TrackingDetails->conversion_id = $value['conversion_id'];
                                $TrackingDetails->conversion_time = $value['created_at'];
                                $TrackingDetails->payout = $value['payouts'];
                                $TrackingDetails->revenue = $value['revenue'];
                                $TrackingDetails->postback_sent = 1;
                                $TrackingDetails->status = 1;
                                $TrackingDetails->save();
                                //fire postback on webmaster

                                //end
                            }else{
                                $errorTracking = new ConversionErrorTracker();
                                $errorTracking->offer_id = $value['offer_id'];
                                $errorTracking->click_id = $value['clickid'];
                                $errorTracking->conversion_id = $value['conversion_id'].'---0';
                                $errorTracking->save();
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

}
