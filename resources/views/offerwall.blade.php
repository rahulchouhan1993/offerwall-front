<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="Googlebot-News" content="noindex, nofollow">
      <meta name="googlebot" content="noindex, nofollow">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <link rel="icon" type="image/x-icon" href="images/favicon.png">
      <title>OfferwallXXX | Active Offers</title>
      <meta name="description" content="Get Rewarded!">
      <meta name="author" content="OfferwallXXX">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <!-- Open Graph for Social Media -->
      <meta property="og:title" content="OfferwallXXX">
      <meta property="og:description" content="Get Rewarded!">
      <meta property="og:image" content="images/favicon.png">
      <meta property="og:url" content="{{ url()->current() }}">
      
      <!-- Twitter Card -->
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="OfferwallXXX">
      <meta name="twitter:description" content="Get Rewarded!">
      <meta name="twitter:image" content="/images/favicon.png">
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
         .modal-content{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:{{ $offerWallTemplate->offerBg }};padding:1rem 1.5rem;width:90%; max-width: 45rem;border-radius:0.5rem;}
         .close-button{text-align: center; cursor: pointer; width: 35px; height: 35px; background: #dc4848; display: flex ; position: absolute; right: -10px; top: -10px; font-size: 25px; align-items: center; justify-content: center; border-radius: 60px; color: #fff; border: 1px solid #dc4848;}
         .close-button:hover{background-color:#fff; color:#000}
         .show-modal{opacity:1;visibility:visible;transform:scale(1.0);transition:visibility 0s linear 0s,opacity 0.25s 0s,transform 0.25s;}
         .trigger { cursor: pointer;}
         /* responsive */
         @media(max-width:767px){/* .boxList{flex-direction:column;}
         .cntbxsize{width:100%!important;}
         */
         .cntbxsize{flex-direction:column;justify-content:flex-start !important;align-items:flex-start !important;}
         .cntbxsize div{width:100% !important;}
         .cntbx{font-size:11px !important;line-height:18px;}
         .menu li a{padding:0 10px !important;}
         .cntbxsize button{margin:10px 0 0; max-width: 120px!important;}
         .cntbxsize h2 { margin: 0 0 2px!important; font-size: 12px!important; }
         .cntbxsize p { font-size: 11px!important; line-height: 13px!important; }
         .boxList { padding: 10px !important;         gap: 9px !important;}
         .btnsm { margin-top:10px;        max-width: 150px;}
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
                  $checkIfAlredyCliced = Tracking::where('offer_id',$offer['id'])->where('visitor_id',$cookieValue)->first();
                  if(!empty($checkIfAlredyCliced)){
                     continue;
                  }
                  $deviceAllowed = empty($offer['targeting'][0]['device_type']) || in_array($deviceType, $offer['targeting'][0]['device_type']);
                  $countryAllowed = empty($offer['targeting'][0]['country']['allow']) || in_array($userCountry, $offer['targeting'][0]['country']['allow']);
               @endphp
               @if($deviceAllowed && $countryAllowed)
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
                  @php $totalPayoutGiven.=' '.$appDetails->currencyNameP; @endphp
               @else 
                  @php $totalPayoutGiven.=' '.$appDetails->currencyName; @endphp
               @endif
               @php 
                  $ufto = base64_encode($offer['link']);
                  $redirectlink = env('APP_URL')."/track?ufto=" . urlencode($ufto).'&wall='.$appDetails->appId.'&vstr='.base64_encode($cookieValue).'&offer_name='.$offer['title'].'&reward='.$totalPayoutGiven;
                  $descriptionOffer = html_entity_decode(strip_tags($offer['description_lang']['en']));
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
                 
                  <div class="cntbxsize" style="width: calc(100% - 107px); display: flex; align-items: center; justify-content: space-between;">
                     <div style="width: calc(100% - 200px);">
                        <h2 style="margin: 0 0 10px; font-weight: 600; font-size: 20px; color: {{ $offerWallTemplate->offerText }};">{{ $offer['title'] }}</h2>
                        <div style="display:flex;gap: 14px;align-items: center;">
                           {{-- <svg width="18" height="18" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 2C7.46957 2 6.96086 2.21071 6.58579 2.58579C6.21071 2.96086 6 3.46957 6 4C6 4.53043 6.21071 5.03914 6.58579 5.41421C6.96086 5.78929 7.46957 6 8 6C8.53043 6 9.03914 5.78929 9.41421 5.41421C9.78929 5.03914 10 4.53043 10 4C10 3.46957 9.78929 2.96086 9.41421 2.58579C9.03914 2.21071 8.53043 2 8 2ZM8 9C10.67 9 16 10.33 16 13V16H0V13C0 10.33 5.33 9 8 9ZM8 10.9C5.03 10.9 1.9 12.36 1.9 13V14.1H14.1V13C14.1 12.36 10.97 10.9 8 10.9Z" fill="{{ $offerWallTemplate->offerText }}"></path>
                           </svg> --}}
                           <div style="font-size: 18px;color:{{ $offerWallTemplate->offerText }}">
                              {{ implode(',',$offer['categories']) }}
                           </div>
                        </div>
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
                           text-decoration:none;
                           color:{{ $offerWallTemplate->offerButtonText }};
                           "
                           > + 
                            {{ $totalPayoutGiven }}
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
            <span class="close-button">×</span>
            <div class="modalbx" style="display: flex ; align-items: center; justify-content: flex-start; gap: 20px;">
               <div style="display: flex ; align-items: center; width: 25%;">
                  <img id="offer-image-pop" src="{{ $offer['logo'] }}" alt="img" style="width: 100%; max-width: 100%; object-fit: cover;" />
               </div>
               <div style="display: flex ; align-items: center; justify-content: space-between; width: 100%;">
                  <div style="">
                     <h2 style="margin: 0 0 10px; font-family: 'Inter'; font-weight: 600; font-size: 16px; color: {{ $offerWallTemplate->offerText }};" id="offer-title-pop">--</h2>
                     <h3 style="margin: 0 0 20px; font-family: 'Inter'; font-weight: 400; font-size: 18px; color: {{ $offerWallTemplate->offerText }};">Offer Requirments</h3>
                     <div style="display: flex ; gap: 10px; align-items: center; color: #757575; margin-bottom: 20px;">
                        {{-- <svg width="18" height="18" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                           <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 2C7.46957 2 6.96086 2.21071 6.58579 2.58579C6.21071 2.96086 6 3.46957 6 4C6 4.53043 6.21071 5.03914 6.58579 5.41421C6.96086 5.78929 7.46957 6 8 6C8.53043 6 9.03914 5.78929 9.41421 5.41421C9.78929 5.03914 10 4.53043 10 4C10 3.46957 9.78929 2.96086 9.41421 2.58579C9.03914 2.21071 8.53043 2 8 2ZM8 9C10.67 9 16 10.33 16 13V16H0V13C0 10.33 5.33 9 8 9ZM8 10.9C5.03 10.9 1.9 12.36 1.9 13V14.1H14.1V13C14.1 12.36 10.97 10.9 8 10.9Z" fill="{{ $offerWallTemplate->offerText }}"></path>
                        </svg> --}}
                        <div style="font-size: 18px;color:{{ $offerWallTemplate->offerText }}" id="offer-category-pop">
                           --
                        </div>
                     </div>
                     <div style="width:100%" class="cntbx">
                        <p style="margin: 0; font-family: 'Inter'; font-size: 15px; color:{{ $offerWallTemplate->offerText }}" id="offer-description-pop">---</p>
                     </div>
                     <a href="#" style="display: inline-block; padding: 10px 30px; border-radius: 60px; background:{{ $offerWallTemplate->offerButtonBg }}; font-family: 'Inter';  font-size: 18px; color: {{ $offerWallTemplate->offerButtonText }}; text-decoration: none;" id="offer-price-pop">----</a>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="modal fade fraudToolModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog  modal-dialog-centered">
           
           <div class="modal-content">
           <div class="fraudicon"><img src="images/fraudicon.png" alt=""></div>
           <div class="fraudHeading">
              <h2><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11 15H13V17H11V15ZM11 7H13V13H11V7Z"></path></svg> Fraud Detection Tools Detected!</h2>   
              <h3>We have detected that you are using fraud detection or privacy tools that may interfere with the proper functioning of our website.</h3>
              <h4><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M5.76282 17H20V5H4V18.3851L5.76282 17ZM6.45455 19L2 22.5V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V18C22 18.5523 21.5523 19 21 19H6.45455ZM11 14H13V16H11V14ZM8.56731 8.81346C8.88637 7.20919 10.302 6 12 6C13.933 6 15.5 7.567 15.5 9.5C15.5 11.433 13.933 13 12 13H11V11H12C12.8284 11 13.5 10.3284 13.5 9.5C13.5 8.67157 12.8284 8 12 8C11.2723 8 10.6656 8.51823 10.5288 9.20577L8.56731 8.81346Z"></path></svg> Why?</h4>
           </div>
           <div class="interruptionsBx">
              <ul>
                 <li>
                    <div class="fraudiconbx">
                       <img src="images/fraudicon1.png" alt="img">
                    </div>   
                 Prevent interruptions in your access</li>
                 <li> <div class="fraudiconbx">
                       <img src="images/fraudicon2.png" alt="img">
                    </div>  
                    Ensure transactions and rewards are processed correctly</li>
                 <li> <div class="fraudiconbx">
                       <img src="images/fraudicon3.png" alt="img">
                    </div>  
                    Maintain a fair and secure platform for all users</li>
              </ul>
           </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.9997 10.5865L16.9495 5.63672L18.3637 7.05093L13.4139 12.0007L18.3637 16.9504L16.9495 18.3646L11.9997 13.4149L7.04996 18.3646L5.63574 16.9504L10.5855 12.0007L5.63574 7.05093L7.04996 5.63672L11.9997 10.5865Z"></path></svg></button>
            
             <div class="modal-body">
               <div class="blockersbx">
                 <h4>We have detected the following security risks on your device:</h4>
                 <ul>
                    <li class="selectedbx">
                       <!-- <span class="checkmarkSelect"></span> -->
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
                          <img src="/images/vpn.png" alt="img">
                       </div>
                       <div class="blockText">
                          <h2>Rooted Device:</h2>
                          <h3>Use a non-rooted device for access.</h3>
                       </div>
                    </li>
     
                    <li class="selectedbx">
                       <div class="blockicons">
                          <img src="/images/vpn.png" alt="img">
                       </div>
                       <div class="blockText">
                          <h2>Termux Detected:</h2>
                          <h3>Close Termux and access the site normally.</h3>
                       </div>
                    </li>
     
                    <li class="selectedbx">
                       <div class="blockicons">
                          <img src="/images/vpn.png" alt="img">
                       </div>
                       <div class="blockText">
                          <h2>Emulator Detected:</h2>
                          <h3>Use a real device for access.</h3>
                       </div>
                    </li>
     
                    <li class="selectedbx">
                       <div class="blockicons">
                          <img src="/images/vpn.png" alt="img">
                       </div>
                       <div class="blockText">
                          <h2>Blocked Country:</h2>
                          <h3>Our services are unavailable in your location.</h3>
                       </div>
                    </li>
                 </ul>
               </div>
               <div class="actionReq">
                 <strong>Action Required:</strong>
                 <p>Disable the above restriction(s) and refresh the page.</p>
               </div>
             </div>
     
             <div class="thankcoop">
             Thank you for your cooperation! 
             </div>
            
           </div>
         </div>
       </div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Modal -->
      <script>
         $(document).on('click', '.openPopupDetail', function () {
             $('#offerDetailsPop').addClass('show-modal'); 
             var redirectLink = $(this).attr('redirect-link')
             var description = $(this).attr('description')
             var title = $(this).attr('title')
             var price = $(this).attr('price')
             var image = $(this).attr('image')
             var category = $(this).attr('category')

             $('#offer-price-pop').html(price)
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