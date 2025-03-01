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
        body{margin:0;padding:0;}
        .menu li.active a{border-bottom-color:#000;color:bisque;}
        *{box-sizing:border-box;}
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
        .boxList { padding: 10px !important; }
    }
    </style>
</head>
<body>
    <!-- Static page -->
    <div class="display: flex ; align-items: start; width: 100%;">
    <div style="display: flex; align-items: start; width: 100%; max-width: 1200px; padding: 0 15px; margin: auto; flex-direction: column; font-family: Open Sans; background-color:{{ $offerWallTemplate->bodyBg }}">
        <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
            <ul style="display: flex; align-items: center; justify-content: start; gap: 15px; padding: 0; margin: 0; list-style: none;">
                <li><a href="#" style="display: block; padding: 14px 10px; font-size: 15px; color: {{ $offerWallTemplate->headerTextColor }}; border-bottom: 1px solid transparent; text-decoration: none;">Offers</a></li>
            </ul>
            <button style="cursor: pointer; display: flex; align-items: center; gap: 10px; padding: 8px 15px 8px 15px; background: {{ $offerWallTemplate->headerButtonBg }}; font-family: Open Sans; font-size: 15px; text-align: center; border: none; color: {{ $offerWallTemplate->headerButtonColor }}">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 2C7.46957 2 6.96086 2.21071 6.58579 2.58579C6.21071 2.96086 6 3.46957 6 4C6 4.53043 6.21071 5.03914 6.58579 5.41421C6.96086 5.78929 7.46957 6 8 6C8.53043 6 9.03914 5.78929 9.41421 5.41421C9.78929 5.03914 10 4.53043 10 4C10 3.46957 9.78929 2.96086 9.41421 2.58579C9.03914 2.21071 8.53043 2 8 2ZM8 9C10.67 9 16 10.33 16 13V16H0V13C0 10.33 5.33 9 8 9ZM8 10.9C5.03 10.9 1.9 12.36 1.9 13V14.1H14.1V13C14.1 12.36 10.97 10.9 8 10.9Z"
                        fill="currentColor"
                    />
                </svg>
                My Account
            </button>
        </div>
    
        <div style="display: flex; align-items: center; justify-content: space-between; background:{{ $offerWallTemplate->NotificationBg }}; padding: 10px 10px; width: 100%;">
            <p class="cntbx" style="margin: 0; font-family: Open Sans; font-size: 15px; color: {{ $offerWallTemplate->notificationText }};">Register and complete your survey profile to access all our surveys. </p>
            <button style="cursor: pointer; display: flex; align-items: center; gap: 10px; padding: 8px 10px 8px 10px; border: none; background: none; font-family: Open Sans; font-size: 15px; text-align: center; color: {{ $offerWallTemplate->notificationText }};">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.46387 8.535L8.53587 1.465M1.46387 1.465L8.53587 8.535" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </button>
        </div>
        @foreach ($allOffers['offers'] as $offer)
        @if(in_array($deviceType,$offer['targeting'][0]['device_type']) || empty($offer['targeting'][0]['device_type']))
        <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 15px; padding: 25px; background: {{ $offerWallTemplate->offerBg }};">
            <div class="boxList" style="display: flex; align-items: center; gap: 20px; padding: 20px; background: {{ $offerWallTemplate->offerBgInner }}; border: 1px solid {{ $offerWallTemplate->offerBgInner }}; width: 100%;">
                @if(empty($offer['logo']))
                    @php $offer['logo'] = 'images/'.$offerSettings->default_image; @endphp
                @endif
                <div style="min-width: 110px;">
                    <img src="{{ $offer['logo'] }}" alt="img" style="width: 100px; max-width: 100%; object-fit: cover;" />
                </div>
                @php $descriptionOffer = html_entity_decode(strip_tags($offer['description_lang']['en'])); @endphp
                @if(empty($descriptionOffer))
                    @php $descriptionOffer = $offerSettings->default_description; @endphp
                @endif
                <div class="cntbxsize" style="width: 80%;">
                    <h2 style="margin: 0 0 10px; font-weight: 600; font-size: 18px; color: {{ $offerWallTemplate->offerText }};">{{ $offer['title'] }}</h2>
                    <p style="margin: 0; font-size: 13px; font-weight: 400; line-height: 21px; color: {{ $offerWallTemplate->offerText }};">{{ $descriptionOffer }}</p>
                    <div style="margin: 10px 0 0; padding: 11px; background: {{ $offerWallTemplate->offerInfoBg }}; border-left: 2px solid {{ $offerWallTemplate->offerInfoBorder }};">
                        <p style="margin: 0; font-size: 13px; color: {{ $offerWallTemplate->offerInfoText }};">{{ $offer['title'] ?? $offerSettings->default_info }}</p>
                    </div>
                </div>
                @php 
                    $ufto = base64_encode($offer['link']);
                    $redirectlink = env('APP_URL')."/track?ufto=" . urlencode($ufto).'&wall='.base64_encode($appDetails->appId);
                @endphp
                <div style="min-width: 150px;">
                    <a target="_blank"
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
                            color:{{ $offerWallTemplate->offerButtonText }};
                        "
                    >
                    @php 
                        $totalPayoutGiven = $offer['payments'][0]['revenue']*$appDetails->currencyValue;
                    @endphp
                    {{ $totalPayoutGiven }} 
                    {{ ($totalPayoutGiven>1) ? $appDetails->currencyNameP : $appDetails->currencyName; }}
                    </a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        <div style="padding: 20px 15px; display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <h2 style="margin: 0; font-size: 11px; font-weight: 600; color: #ce68ce;"><img style="max-width: 150px;" src="/images/logo.png" /></h2>
            <p class="footerText-colordy" style="margin: 0px; font-size: 11px; color: {{ $offerWallTemplate->footerText }};">Privacy policy</p>
        </div>
    </div>
    </div>
</body>
</html>