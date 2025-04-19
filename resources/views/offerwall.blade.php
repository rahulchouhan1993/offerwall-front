<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="Googlebot-News" content="noindex, nofollow">
      <meta name="googlebot" content="noindex, nofollow">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <link rel="icon" type="image/x-icon" href="images/favicon.png">
      <title>{{ $offerSettings->meta_title }}</title>
      <meta name="description" content="{{ $offerSettings->meta_description }}">
      {{-- <meta name="author" content="{{ $offerSettings->meta_title }}"> --}}
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <!-- Open Graph for Social Media -->
      <meta property="og:title" content="{{ $offerSettings->meta_title }}">
      <meta property="og:description" content="{{ $offerSettings->meta_description }}">
      <meta property="og:image" content="images/favicon.png">
      <meta property="og:url" content="{{ url()->current() }}">
      
      <!-- Twitter Card -->
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="{{ $offerSettings->meta_title }}">
      <meta name="twitter:description" content="{{ $offerSettings->meta_description }}">
      <meta name="twitter:image" content="/images/favicon.png">
      <link rel="stylesheet" href="css/style.css?dfgdg">
      <style>
         html{height:100%;}
         body{height:100%;margin:0;padding:0;}
         *{box-sizing:border-box;}
         .menu li.active a{border-bottom-color:#000;color:bisque;}
         .menuNav li a.active{color:{{ $offerWallTemplate->headerActiveTextColor }} !important;}
         .cntbx{max-height:240px;overflow-y:auto;padding-right:15px;margin-bottom: 20px;}
         .cntbx::-webkit-scrollbar{width:6px; height: 6px;}
         .cntbx::-webkit-scrollbar-track{background:#f1f1f1;}
         .cntbx::-webkit-scrollbar-thumb{background:#888;}
         .cntbx::-webkit-scrollbar-thumb:hover{background:#555;}
         /* mdal */
         .modal{position:fixed;left:0;top:0;width:100%;height:100%;background-color:rgba(0,0,0,0.5);opacity:0;visibility:hidden;transform:scale(1.1);transition:visibility 0s linear 0.25s,opacity 0.25s 0s,transform 0.25s;}
         .modal-content{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:{{ $offerWallTemplate->offerBg }};padding:1rem 1rem;width:94%; max-width: 430px;border-radius:0.5rem;}
         .close-button{text-align: center; cursor: pointer; width: 35px; height: 35px; background: #dc4848; display: flex ; position: absolute; right: -10px; top: -10px; font-size: 25px; align-items: center; justify-content: center; border-radius: 60px; color: #fff; border: 1px solid #dc4848;}
         .close-button svg {width: 17px;}
         .close-button:hover{background-color:#fff; color:#000}
         .show-modal{opacity:1;visibility:visible;transform:scale(1.0);transition:visibility 0s linear 0s,opacity 0.25s 0s,transform 0.25s;}
         .trigger { cursor: pointer;}
         .arrow-icon {width: 20px;height: 20px;fill: {{ $offerWallTemplate->offerButtonText }};animation:moveArrow 1s infinite alternate ease-in-out;}

         @keyframes moveArrow {
            0% {
            transform: translateX(0);
            }
            100% {
            transform: translateX(6px);
            }
         }
         /* responsive */
         @media(max-width:767px){/* .boxList{flex-direction:column;}
         .cntbxsize{width:100%!important;}
         */
         .cntbxsize{flex-direction:column;justify-content:flex-start !important;align-items:flex-start !important;}
         .cntbxsize > div{width:100% !important;}
         .cntbx{font-size:11px !important;line-height:18px;}
         .menu li a{padding:0 10px !important;}
         .cntbxsize button{margin:10px 0 0; max-width: 120px!important;}
         .cntbxsize h2 { margin: 0 0 2px!important; font-size: 16px!important; }
         .cntbxsize p { font-size: 11px!important; line-height: 13px!important; }
         .boxList { padding: 10px !important;         gap: 9px !important;}
         .btnsm {margin-top: 5px; max-width: 120px; font-size: 12px !important; padding: 5px 5px !important;}
         .cntmainbx { padding:20px!important;    padding-bottom: 80px!important;}
         }
         @media(max-width:480px){
         .modalbx {flex-wrap:wrap!important;}    
         }
      </style>
   </head>
   @php
      use App\Models\Tracking;
   @endphp
   <body>
      <!-- Static page -->
      <div style=" width: 100%;height: 100%;">
         <div style="display: flex ; flex-wrap: wrap; align-items: center; width: 100%; background: {{ $offerWallTemplate->headerBg }}; padding: 15px 15px; justify-content: space-between;">
            <a href="#" style="margin: 0; font-size: 11px; font-weight: 600;">
               <img style="max-width: 150px;" src="/images/logo.png" />
            </a>
            <div style="display: flex ; align-items: center; justify-content: space-between; padding: 3px 5px; background:{{ $offerWallTemplate->headerMenuBg }}">
               <ul class="menuNav" style="display: flex; align-items: center; justify-content: start; gap: 15px; padding: 0; margin: 0; list-style: none;">
                  <li>
                     <a class="active" href="{{ route('offerwall', ['apiKey' => $requestedParams['apiKey'], 'wallId' => $requestedParams['wallId']]) }}" 
                        style="display: block; padding: 14px 10px; font-size: 15px; border-bottom: 1px solid transparent; text-decoration: none;font-family: Open Sans; background: {{ $offerWallTemplate->headerActiveBg }}">
                     Offers
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('completedOffers', ['apiKey' => $requestedParams['apiKey'], 'wallId' => $requestedParams['wallId']]) }}" 
                        style="display: block; padding: 14px 10px; font-size: 15px; color: {{ $offerWallTemplate->headerNonActiveTextColor }}; border-bottom: 1px solid transparent; text-decoration: none;font-family: Open Sans;">
                     My Rewards
                     </a>
                  </li>
               </ul>
            </div>
         </div>
         <div style="display: flex ; height: 100%;  padding-bottom: 60px; align-items: start; width: 100%; flex-direction: column; font-family: Open Sans; background-color:{{ $offerWallTemplate->bodyBg }}">
            <div class="cntmainbx" style="width:100%; display: flex; flex-direction: column; align-items: flex-start; gap: 15px; padding: 60px; padding-bottom: 80px; background: {{ $offerWallTemplate->bodyBg }};">
               @foreach ($allOffers['offers'] as $offer)
               @php
                  $checkIfAlredyCliced = Tracking::where('offer_id',$offer['id'])->where('visitor_id',$cookieValue)->whereNotNull('conversion_id')->first();
                  if(!empty($checkIfAlredyCliced)){
                     continue;
                  }
                  //Checking OS
                  $osItems = $offer['strictly_os']['items'] ?? [];
                  $operatingSystemAllowed = empty($osItems) || array_key_exists($operatingSystem, $osItems);

                  //Checking Device
                  $deviceTypes = $offer['targeting'][0]['device_type'] ?? [];
                  $deviceAllowed = empty($deviceTypes) || in_array($deviceType, $deviceTypes);

                  //Checking Country
                  $countryData = $offer['targeting'][0]['country'] ?? [];
                  $allowCountries = $countryData['allow'] ?? [];
                  $denyCountries = $countryData['deny'] ?? [];

                  $countryAllowed = (empty($allowCountries) || in_array($userCountry, $allowCountries)) && !in_array($userCountry, $denyCountries);

                  //Checking Caps
                  $caps = $offer['caps'][0] ?? null;
                  if ($caps && isset($caps['value'], $caps['current_value'])) {
                     if ((int) $caps['current_value'] >= (int) $caps['value']) {
                        continue;
                     }
                  }
               @endphp
               @if($deviceAllowed && $countryAllowed && $operatingSystemAllowed)
               @if(empty($offer['logo']))
                    @php $offer['logo'] = $offerSettings->default_image; @endphp
               @endif
               @php 
                    $totalPayoutGiven = $offer['payments'][0]['revenue']*$appDetails->currencyValue ?? 0*$appDetails->currencyValue;
               @endphp
               @if($totalPayoutGiven>1)
                  @if ($appDetails->rounding==1)
                     @php
                        $rounded = round($totalPayoutGiven, 1);
                        if ($rounded > 0 && $rounded < 0.1) {
                           $totalPayoutGiven = 0.1; 
                        }else{
                           $totalPayoutGiven = ($totalPayoutGiven > floor($totalPayoutGiven)) ? $totalPayoutGiven : floor($totalPayoutGiven);
                        }
                     @endphp
                  @elseif ($appDetails->rounding==2)
                     @php
                        $rounded = round($totalPayoutGiven, 2);
                        if ($rounded > 0 && $rounded < 0.1) {
                           $totalPayoutGiven = 0.1; 
                        }else{
                           $totalPayoutGiven = ($totalPayoutGiven > floor($totalPayoutGiven)) ? $totalPayoutGiven : floor($totalPayoutGiven);
                        }
                     @endphp
                  @else
                     @php
                        $totalPayoutGiven = round($totalPayoutGiven);
                     @endphp
                  @endif
                  @php 
                     $totalPayoutGiven = number_format($totalPayoutGiven).' '.$appDetails->currencyNameP; 
                  @endphp
               @else 
                  @php 
                     $totalPayoutGiven = number_format($totalPayoutGiven).' '.$appDetails->currencyName;
                  @endphp
               @endif
               @php 
                  $ufto = base64_encode($offer['link']);
                  $redirectlink = env('APP_URL')."/track?ufto=" . urlencode($ufto).'&wall='.$appDetails->appId.'&vstr='.base64_encode($cookieValue).'&offer_name='.$offer['title'].'&reward='.$totalPayoutGiven;
                  $descriptionOffer = html_entity_decode($offer['description_lang']['en']);
               @endphp
               @if(empty($descriptionOffer))
                    @php $descriptionOffer = $offerSettings->default_description; @endphp
               @endif
               <div class="boxList trigger openPopupDetail" 
                redirect-link="{{ $redirectlink }}" 
                description="{{ $descriptionOffer }}" 
                title="{{ $offer['title'] }}"
                image="{{ $offer['logo'] }}"
                price="{{ $totalPayoutGiven }}"
                category="{{ implode(',',$offer['categories']) }}"
                style="display: flex; align-items: center; gap: 20px; padding: 20px;box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.2); border-radius:15px; background: {{ $offerWallTemplate->offerBg }}; border: 1px solid {{ $offerWallTemplate->offerBg }}; width: 100%;">
                  
                  <div style="width: 107px;">
                     <img src="{{ $offer['logo'] }}" alt="img" style="width: 100px; max-width: 100%; object-fit: cover;" />
                  </div>
                  @php 
                     $blockedCategories =[];
                     if(!empty($offerSettings->blocked_categories)){
                        $blockedCategories = explode(',',strtolower($offerSettings->blocked_categories));
                     }
                  @endphp
                  <div class="cntbxsize" style="width: calc(100% - 107px); display: flex; align-items: center; justify-content: space-between;">
                     <div style="width: calc(100% - 200px);">
                        <h2 style="margin: 0 0 10px; font-weight: 600; font-size: 20px; color: {{ $offerWallTemplate->offerText }};">{{ $offer['title'] }}</h2>
                        @if(!empty($offer['categories']))
                        <div style="display:flex;gap: 14px;align-items: center;">
                           
                           <div style="display:flex; flex-wrap:wrap; gap:4px; font-size: 14px;color:{{ $offerWallTemplate->offerText }}">
                              @if(!empty($offer['categories']))
                              @foreach ($offer['categories'] as $cat)
                              @if(!in_array($cat,$blockedCategories))
                              <div style="background:{{ $offerWallTemplate->offerBadgeBg }}; text-align:center; padding:4px 10px; border-radius:5px; font-size:14px;color:{{ $offerWallTemplate->offerBadgeText }};">{{ $cat }}</div> 
                              @endif
                              @endforeach
                              @endif
                           </div>
                        </div>
                        @endif
                     </div>
                     
                     <div style="min-width: 150px;">
                        <a class="btnsm" 
                           href="javascript:void(0);"
                           style="
                           display: flex;
                           align-items: center;
                           gap: 10px;
                           padding: 8px 15px 8px 15px;
                           background: {{ $offerWallTemplate->offerButtonBg }};
                           font-family: Open Sans;
                           font-size: 15px;
                           width: 100%;
                           text-align: center;
                           justify-content: center;
                           border: none;
                           text-decoration:none;    box-shadow:0 0 15px 0 rgba(0, 0, 0, 0.2);
                           color:{{ $offerWallTemplate->offerButtonText }};
                           "
                           > + 
                            {{ $totalPayoutGiven }} <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                           <path d="M12 4l1.41 1.41L7.83 11H20v2H7.83l5.58 5.59L12 20l-8-8 8-8z" transform="scale(-1,1) translate(-24, 0)"/>
                        </svg>
                        </a>
                     </div>
                  </div>
               </div>
               @endif
               @endforeach
            </div>
            <div style="padding: 20px 15px; display: flex ; justify-content: space-between; align-items: center; width: 100%; position: fixed; bottom: 0; background-color: {{ $offerWallTemplate->footerBg }}">
               <h2 style="margin: 0; font-size: 11px; font-weight: 600;"><img style="max-width: 150px;" src="/images/logo.png" /></h2>
               @if ($offerSettings->privacy_policy==1)
               <a href="" class="footerText-colordy" style="margin: 0px; font-size: 14px; color: {{ $offerWallTemplate->footerText }};">Privacy policy</a>
               @endif
               
            </div>
         </div>
      </div>
      <div class="modal" id="offerDetailsPop" tabindex="-1" aria-hidden="true">
         <div class="modal-content">
            <span class="close-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M10.5859 12L2.79297 4.20706L4.20718 2.79285L12.0001 10.5857L19.793 2.79285L21.2072 4.20706L13.4143 12L21.2072 19.7928L19.793 21.2071L12.0001 13.4142L4.20718 21.2071L2.79297 19.7928L10.5859 12Z"></path></svg></span>
            <div class="modalbx" style="display: flex ; align-items: center; justify-content: flex-start; gap: 20px;">
               <div style="display: flex ; align-items: center; width: 33%;">
                  <img id="offer-image-pop" src="{{ $offer['logo'] }}" alt="img" style="width: 100%; max-width: 100%; object-fit: cover;" />
               </div>
               <div style="display: flex ; align-items: center; justify-content: space-between; width: 100%;">
                  <div style="">
                     <h2 style="margin: 0 0 5px; font-family: 'Inter'; font-weight: 600; font-size: 18px; color: {{ $offerWallTemplate->offerText }};" id="offer-title-pop">--</h2>
                     <h3 style="margin: 0 0 10px; font-family: 'Inter'; font-weight: 400; font-size: 15px; color: {{ $offerWallTemplate->offerText }};">Offer Requirements</h3>
                     {{-- <div style="display: flex ; gap: 10px; align-items: center; color: #757575; margin-bottom: 20px;">
                        <div style="font-size: 18px;font-family: 'Inter';color:{{ $offerWallTemplate->offerText }}" id="offer-category-pop">
                           --
                        </div>
                     </div> --}}
                     <div style="width:100%" class="cntbx">
                        <p style="margin: 0; font-family: 'Inter'; font-size: 14px; color:{{ $offerWallTemplate->offerText }}" id="offer-description-pop">---</p>
                     </div>
                     <a target="_blank" href="javascript;void(0);" style="display: inline-block; padding: 10px 30px;  background:{{ $offerWallTemplate->offerButtonBg }}; font-family: 'Inter';  font-size: 14px;     box-shadow:0 0 15px 0 rgba(0, 0, 0, 0.2); color: {{ $offerWallTemplate->offerButtonText }}; text-decoration: none;" id="offer-price-pop">----</a>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="modal fade fraudToolModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
         <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
            <div class="fraudicon">
               <img src="images/fraudicon.png" alt="">
            </div>
            <div class="fraudHeading">
               <h2>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11 15H13V17H11V15ZM11 7H13V13H11V7Z"></path></svg> Fraud Detection Tools Detected!
               </h2>   
               <h3>We have detected that you are using fraud detection or privacy tools that may interfere with the proper functioning of our website.</h3>
            </div>
            <div class="modal-body">
               <div class="blockersbx">
                  <h4>Please make sure that following tools are disabled:</h4>
                  <ul>
                     <li class="selectedbx">
                        <div class="blockicons">
                           <img src="/images/vpn.png" alt="img">
                        </div>
                        <div class="blockText">
                           <h2>VPN Access:</h2>
                           <h3>Disable your VPN and try again.</h3>
                        </div>
                     </li>
                     <li class="selectedbx">
                        <div class="blockicons">
                           <img src="/images/rooted.png" alt="img">
                        </div>
                        <div class="blockText">
                           <h2>Rooted Device:</h2>
                           <h3>Use a non-rooted device for access.</h3>
                        </div>
                     </li>
                     <li class="selectedbx">
                        <div class="blockicons">
                           <img src="/images/termux.png" alt="img">
                        </div>
                        <div class="blockText">
                           <h2>Termux Detected:</h2>
                           <h3>Close Termux and access the site normally.</h3>
                        </div>
                     </li>
                     <li class="selectedbx">
                        <div class="blockicons">
                           <img src="/images/emul.png" alt="img">
                        </div>
                        <div class="blockText">
                           <h2>Emulator Detected:</h2>
                           <h3>Use a real device for access.</h3>
                        </div>
                     </li>
                  </ul>
               </div>
               <div class="actionReq">
                  <strong>Action Required:</strong>
                  <p>Disable the above restriction(s) and refresh the page.</p>
               </div>
             </div>
           </div>
         </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Modal -->
      <script>
         var isVpn = '{{ $isVpn }}';
         $(document).ready(function(){
            if(isVpn){
               $('.fraudToolModal').addClass('show-modal');
            }
         })
         $(document).on('click', '.openPopupDetail', function () {
             $('#offerDetailsPop').addClass('show-modal'); 
             var redirectLink = $(this).attr('redirect-link')
             var description = $(this).attr('description')
             var title = $(this).attr('title')
             var price = $(this).attr('price')
             var image = $(this).attr('image')
             var category = $(this).attr('category')
            var icon = '<svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 4l1.41 1.41L7.83 11H20v2H7.83l5.58 5.59L12 20l-8-8 8-8z" transform="scale(-1,1) translate(-24, 0)"/></svg>';
             $('#offer-price-pop').html("+ "+price+" "+icon)
             $('#offer-price-pop').attr('href',redirectLink)
             $('#offer-title-pop').html(title)
             $('#offer-description-pop').html(description)
             $('#offer-category-pop').html(category)
             
             $('#offer-image-pop').attr('src',image)
             
         });
         $('.close-button').on('click', function () {
             $('#offerDetailsPop').removeClass('show-modal');
         });
         
      </script>
   </body>
</html>