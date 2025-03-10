<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Googlebot-News" content="noindex, nnofollow">
	<meta name="googlebot" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <title>Offerwall</title>
    <style>
html{height:100%;}
body{height:100%;margin:0;padding:0;}
*{box-sizing:border-box;}
.menu li.active a{border-bottom-color:#000;color:bisque;}
.menuNav li a.active{color:#ffffff !important;}
.cntbx{max-height:240px;overflow-y:auto;padding-right:15px;margin-bottom: 20px;}
.cntbx::-webkit-scrollbar{width:6px; height: 6px;}
.cntbx::-webkit-scrollbar-track{background:#f1f1f1;}
.cntbx::-webkit-scrollbar-thumb{background:#888;}
.cntbx::-webkit-scrollbar-thumb:hover{background:#555;}

/* mdal */
.modal{position:fixed;left:0;top:0;width:100%;height:100%;background-color:rgba(0,0,0,0.5);opacity:0;visibility:hidden;transform:scale(1.1);transition:visibility 0s linear 0.25s,opacity 0.25s 0s,transform 0.25s;}
.modal-content{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;padding:1rem 1.5rem;width:90%; max-width: 45rem;border-radius:0.5rem;}
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
<body>
    <!-- Static page -->






    <div style=" width: 100%;height: 100%;">

        <div style="display: flex ; align-items: center; width: 100%; background: #d196f8; padding: 15px 15px; justify-content: space-between;">
            <a href="#" style="margin: 0; font-size: 11px; font-weight: 600; color: #ce68ce;"><img style="max-width: 150px;" src="/images/logo.png" /></a>
            <div style="displya:flex align-items:center; gap:10px">
            <button style="cursor: pointer; display: flex; align-items: center; gap: 10px; padding: 8px 15px 8px 15px; background: {{ $offerWallTemplate->headerButtonBg }}; font-family: Open Sans; font-size: 15px; text-align: center; border: none; color: {{ $offerWallTemplate->headerButtonColor }}">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 2C7.46957 2 6.96086 2.21071 6.58579 2.58579C6.21071 2.96086 6 3.46957 6 4C6 4.53043 6.21071 5.03914 6.58579 5.41421C6.96086 5.78929 7.46957 6 8 6C8.53043 6 9.03914 5.78929 9.41421 5.41421C9.78929 5.03914 10 4.53043 10 4C10 3.46957 9.78929 2.96086 9.41421 2.58579C9.03914 2.21071 8.53043 2 8 2ZM8 9C10.67 9 16 10.33 16 13V16H0V13C0 10.33 5.33 9 8 9ZM8 10.9C5.03 10.9 1.9 12.36 1.9 13V14.1H14.1V13C14.1 12.36 10.97 10.9 8 10.9Z"
                        fill="currentColor"
                    />
                </svg>
                My Account
            </button>
            </div>
        </div>



    <div style="display: flex ; height: 100%;    padding-bottom: 60px; align-items: start; width: 100%; flex-direction: column; font-family: Open Sans; background-color:{{ $offerWallTemplate->bodyBg }}">
        <div style="display: flex ; align-items: center; justify-content: space-between; width: 100%; padding: 0 15px;background: #fff;">
            <ul class="menuNav" style="display: flex; align-items: center; justify-content: start; gap: 15px; padding: 0; margin: 0; list-style: none;">
            <li>
                <a class="active" href="{{ route('offerwall', ['apiKey' => $requestedParams['apiKey'], 'wallId' => $requestedParams['wallId']]) }}" 
                style="display: block; padding: 14px 10px; font-size: 15px; color: {{ $offerWallTemplate->headerTextColor }}; border-bottom: 1px solid transparent; text-decoration: none;    background: #7030a0;">
                Offers
                </a>
            </li>
            <li>
                <a href="{{ route('completedOffers', ['apiKey' => $requestedParams['apiKey'], 'wallId' => $requestedParams['wallId']]) }}" 
                style="display: block; padding: 14px 10px; font-size: 15px; color: {{ $offerWallTemplate->headerTextColor }}; border-bottom: 1px solid transparent; text-decoration: none;">
                My Rewards
                </a>
            </li>
            </ul>
           
        </div>
    
        <div style="display: flex; align-items: center; justify-content: space-between; background:{{ $offerWallTemplate->NotificationBg }}; padding: 10px 10px; width: 100%;">
            <p class="cntbx" style="margin: 0; font-family: Open Sans; font-size: 15px; color: {{ $offerWallTemplate->notificationText }};">Register and complete your survey profile to access all our surveys. </p>
            <button style="cursor: pointer; display: flex; align-items: center; gap: 10px; padding: 8px 10px 8px 10px; border: none; background: none; font-family: Open Sans; font-size: 15px; text-align: center; color: {{ $offerWallTemplate->notificationText }};">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.46387 8.535L8.53587 1.465M1.46387 1.465L8.53587 8.535" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </button>
        </div>

        <div class="cntmainbx" style="width:100%; display: flex; flex-direction: column; align-items: flex-start; gap: 15px; padding: 60px;     padding-bottom: 80px; background: {{ $offerWallTemplate->offerBg }};">
        @foreach ($allOffers['offers'] as $offer)
        @if(in_array($deviceType,$offer['targeting'][0]['device_type']) || empty($offer['targeting'][0]['device_type']))
        
        
            <div class="boxList trigger" style="display: flex; align-items: center; gap: 20px; padding: 20px;     box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.2); border-radius:15px; background: {{ $offerWallTemplate->offerBgInner }}; border: 1px solid {{ $offerWallTemplate->offerBgInner }}; width: 100%;">
                @if(empty($offer['logo']))
                    @php $offer['logo'] = 'images/'.$offerSettings->default_image; @endphp
                @endif
                <div style="width: 107px;">
                    <img src="{{ $offer['logo'] }}" alt="img" style="width: 100px; max-width: 100%; object-fit: cover;" />
                </div>
                @php $descriptionOffer = html_entity_decode(strip_tags($offer['description_lang']['en'])); @endphp
                @if(empty($descriptionOffer))
                    @php $descriptionOffer = $offerSettings->default_description; @endphp
                @endif
                <div class="cntbxsize" style="width: calc(100% - 107px); display: flex; align-items: center; justify-content: space-between;">
                    <div style="width: calc(100% - 200px);">
                        <h2 style="margin: 0 0 10px; font-weight: 600; font-size: 20px; color: {{ $offerWallTemplate->offerText }};">{{ $offer['title'] }}</h2>

                        <div style="display:flex;gap: 14px;align-items: center;">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 2C7.46957 2 6.96086 2.21071 6.58579 2.58579C6.21071 2.96086 6 3.46957 6 4C6 4.53043 6.21071 5.03914 6.58579 5.41421C6.96086 5.78929 7.46957 6 8 6C8.53043 6 9.03914 5.78929 9.41421 5.41421C9.78929 5.03914 10 4.53043 10 4C10 3.46957 9.78929 2.96086 9.41421 2.58579C9.03914 2.21071 8.53043 2 8 2ZM8 9C10.67 9 16 10.33 16 13V16H0V13C0 10.33 5.33 9 8 9ZM8 10.9C5.03 10.9 1.9 12.36 1.9 13V14.1H14.1V13C14.1 12.36 10.97 10.9 8 10.9Z" fill="currentColor"></path>
                            </svg>
                            <div style="font-size: 18px;color: #000000;">
                                856
                            </div>

                        </div>
                        <!-- <p style="margin: 0; font-size: 13px; font-weight: 400; line-height: 21px; color: {{ $offerWallTemplate->offerText }};">{{ $descriptionOffer }}</p> -->
                        <!-- <div style="margin: 10px 0 0; padding: 11px; background: {{ $offerWallTemplate->offerInfoBg }}; border-left: 2px solid {{ $offerWallTemplate->offerInfoBorder }};">
                            <p style="margin: 0; font-size: 13px; color: {{ $offerWallTemplate->offerInfoText }};">{{ $offer['title'] ?? $offerSettings->default_info }}</p>
                        </div> -->
                    </div>
                    @php 
                        $ufto = base64_encode($offer['link']);
                        $redirectlink = env('APP_URL')."/track?ufto=" . urlencode($ufto).'&wall='.base64_encode($appDetails->appId).'&vstr='.base64_encode($cookieValue);
                    @endphp
                    <div style="min-width: 150px;">
                        <a class="btnsm" target="_blank"
                            href="{{ $redirectlink }}"
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
                        @php 
                            $totalPayoutGiven = $offer['payments'][0]['revenue'] ?? 0*$appDetails->currencyValue;
                        @endphp
                        {{ $totalPayoutGiven }} 
                        {{ ($totalPayoutGiven>1) ? $appDetails->currencyNameP : $appDetails->currencyName; }}
                        </a>
                    </div>
                </div>
            </div>
        
        @endif
        @endforeach
        </div>
        <div style="padding: 20px 15px; display: flex ; justify-content: space-between; align-items: center; width: 100%; position: fixed; bottom: 0; background-color: #d196f8;">
            <h2 style="margin: 0; font-size: 11px; font-weight: 600; color: #ce68ce;"><img style="max-width: 150px;" src="/images/logo.png" /></h2>
            <p class="footerText-colordy" style="margin: 0px; font-size: 14px; color: {{ $offerWallTemplate->footerText }};">Privacy policy</p>
        </div>
    </div>
    </div>



<div class="modal">
    <div class="modal-content">
        <span class="close-button">×</span>
        <div class="modalbx" style="display: flex ; align-items: center; justify-content: flex-start; gap: 20px;">
            <div style="display: flex ; align-items: center; width: 25%;">
                <img src="{{ $offer['logo'] }}" alt="img" style="width: 100%; max-width: 100%; object-fit: cover;" />
            </div>
            <div style="display: flex ; align-items: center; justify-content: space-between; width: 100%;">
                    <div style="">
                        <h2 style="margin: 0 0 10px; font-weight: 600; font-size: 16px; color: {{ $offerWallTemplate->offerText }};">{{ $offer['title'] }}</h2>

                        <h3 style="margin: 0 0 20px; font-weight: 400; font-size: 18px; color: {{ $offerWallTemplate->offerText }};">Offer Requirments</h3>


                        <div style="display: flex ; gap: 10px; align-items: center; color: #757575; margin-bottom: 20px;">
                                    <svg width="18" height="18" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 2C7.46957 2 6.96086 2.21071 6.58579 2.58579C6.21071 2.96086 6 3.46957 6 4C6 4.53043 6.21071 5.03914 6.58579 5.41421C6.96086 5.78929 7.46957 6 8 6C8.53043 6 9.03914 5.78929 9.41421 5.41421C9.78929 5.03914 10 4.53043 10 4C10 3.46957 9.78929 2.96086 9.41421 2.58579C9.03914 2.21071 8.53043 2 8 2ZM8 9C10.67 9 16 10.33 16 13V16H0V13C0 10.33 5.33 9 8 9ZM8 10.9C5.03 10.9 1.9 12.36 1.9 13V14.1H14.1V13C14.1 12.36 10.97 10.9 8 10.9Z" fill="currentColor"></path>
                            </svg>
                            <div style="font-size: 18px;color: #757575;">
                                856
                            </div>
                        </div>
                        <div style="width:100%" class="cntbx">
                        <p style="margin: 0; font-family: Open Sans; font-size: 15px; color: #212121;">Ipsum lorem site dist lorem ipsum sit lorem site dist lorem ipsum sit lorem site dist lorem ipsum sit lorem site dist lorem ipsum sit lorem site dist lorem ipsum sit</p>
                        </div>

                        <a href="#" style="display: inline-block; padding: 10px 30px; border-radius: 60px; background: #e788dd; font-size: 18px; color: #fff; text-decoration: none;">+2200</a>
                    </div>
            </div>
        </div>
    </div>
</div>



    <!-- Modal -->
    <script>
        var modal = document.querySelector(".modal");
        var trigger = document.querySelector(".trigger");
        var closeButton = document.querySelector(".close-button");

        function toggleModal() {
            modal.classList.toggle("show-modal");
        }

        function windowOnClick(event) {
            if (event.target === modal) {
                toggleModal();
            }
        }

        trigger.addEventListener("click", toggleModal);
        closeButton.addEventListener("click", toggleModal);
        window.addEventListener("click", windowOnClick);

    </script>
</body>
</html>