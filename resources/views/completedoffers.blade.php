<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Googlebot-News" content="noindex, nnofollow">
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
        .pending{background: #ff420f2b;    color: #f76815;}
        .awarded{background: #1399482b;    color: #438908;}
        .declined{background: #ff05052b;    color: #ff0101;}

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
        .boxList { padding: 10px !important;gap: 9px !important; border-radius:5px!important;}
        .btnsm { margin-top:10px; max-width: 140px;padding: 7px 10px !important;}
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
            <div style="display: flex ; align-items: center; justify-content: space-between; padding: 3px 5px; background:{{ $offerWallTemplate->headerMenuBg }};">
                <ul class="menuNav" style="display: flex; align-items: center; justify-content: start; gap: 15px; padding: 0; margin: 0; list-style: none;">
                    <li>
                        <a  href="{{ route('offerwall', ['apiKey' => $requestedParams['apiKey'], 'wallId' => $requestedParams['wallId'], 'userId' => $requestedParams['userId'], 'sub4' => $requestedParams['sub4'], 'sub5' => $requestedParams['sub5'], 'sub6' => $requestedParams['sub6']]) }}" style="display: block;font-family: Open Sans; padding: 14px 10px; font-size: 15px; color: {{ $offerWallTemplate->headerNonActiveTextColor }}; border-bottom: 1px solid transparent; text-decoration: none; ">Offers</a>
                    </li>
                    <li>
                        <a class="active" href="{{ route('completedOffers', ['apiKey' => $requestedParams['apiKey'], 'wallId' => $requestedParams['wallId'], 'userId' => $requestedParams['userId'], 'sub4' => $requestedParams['sub4'], 'sub5' => $requestedParams['sub5'], 'sub6' => $requestedParams['sub6']]) }}" style="display: block;font-family: Open Sans; padding: 14px 10px; font-size: 15px; color: {{ $offerWallTemplate->headerTextColor }}; border-bottom: 1px solid transparent; text-decoration: none;  background: {{ $offerWallTemplate->headerActiveBg }}">My Rewards</a>
                    </li>
                </ul>
            </div>
        </div>
        <div style="display: flex ; height: 100%;  padding-bottom: 60px; align-items: start; width: 100%; flex-direction: column; font-family: Open Sans; background-color:{{ $offerWallTemplate->bodyBg }}">
            <div  class="cntmainbx" style="width:100%; display: flex; flex-direction: column; align-items: flex-start; gap: 15px;padding: 60px;padding-bottom: 80px; background: {{ $offerWallTemplate->bodyBg }};">
            @if($allOffers['offers'])
                @foreach ($allOffers['offers'] as $trackId => $offer)
                    @php
                    $trackingDetails = Tracking::find($trackId);
                        $totalPayoutGiven = $trackingDetails->reward;
                    @endphp
                    <div class="boxList" style="display: flex; align-items: center; flex-wrap:wrap; gap: 20px; padding: 20px;     box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.2); border-radius:15px; background: {{ $offerWallTemplate->offerBg }}; border: 1px solid {{ $offerWallTemplate->offerBg }}; width: 100%;">
                        <div style="width: 100%; display: flex ; align-items: center; gap:10px;">

                        <div style="width: 107px;">
                            <img src="{{ $offer['logo'] }}" alt="img" style="width: 100px; max-width: 100%; object-fit: cover;" />
                        </div>
                        @php $descriptionOffer = html_entity_decode(strip_tags($offer['description_lang'])); @endphp
                        @if(empty($descriptionOffer))
                            @php $descriptionOffer = $offerSettings->default_description; @endphp
                        @endif
                        <div class="cntbxsize" style="width: calc(100% - 107px); display: flex; align-items: center; justify-content: space-between;">
                            <div style="width: calc(100% - 200px);">
                                <h2 style="margin: 0 0 10px; font-weight: 600; font-size: 18px; color: {{ $offerWallTemplate->offerText }};">{{ $trackingDetails->offer_name }}</h2>
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
                    <div style="display: flex ; flex-wrap: wrap; justify-content: space-between; align-items: center; width: 100%; background-color: {{ $offerWallTemplate->offerText }}; padding: 9px 15px; border-radius: 6px; gap:10px">
                        <div style="display: flex ; justify-content: space-between; align-items: center; gap: 4px;">
                            <svg style="width: 18px; height: 18px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="{{ $offerWallTemplate->offerBg }}">
                                <path d="M9 1V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9ZM20 11H4V19H20V11ZM7 5H4V9H20V5H17V7H15V5H9V7H7V5Z"></path>
                            </svg>
                            <h2 style="font-size: 13px; color: {{ $offerWallTemplate->offerBg }}; margin: 0; font-weight: 600;">{{ ($trackingDetails->click_time) ? date('d M Y',strtotime($trackingDetails->click_time)) : date('d M Y',strtotime($trackingDetails->created_at)) }}</h2>
                        </div>
                        <div style="display: flex ; justify-content: space-between; align-items: center; gap: 4px;">
                        
                        <svg style="width: 18px; height: 18px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="{{ $offerWallTemplate->offerBg }}"><path d="M17.6177 5.9681L19.0711 4.51472L20.4853 5.92893L19.0319 7.38231C20.2635 8.92199 21 10.875 21 13C21 17.9706 16.9706 22 12 22C7.02944 22 3 17.9706 3 13C3 8.02944 7.02944 4 12 4C14.125 4 16.078 4.73647 17.6177 5.9681ZM12 20C15.866 20 19 16.866 19 13C19 9.13401 15.866 6 12 6C8.13401 6 5 9.13401 5 13C5 16.866 8.13401 20 12 20ZM11 8H13V14H11V8ZM8 1H16V3H8V1Z"></path></svg>
                            <h2 style="font-size: 13px; color: {{ $offerWallTemplate->offerBg }}; margin: 0; font-weight: 600;">{{ ($trackingDetails->status) ? 'Completed' : 'Pending'; }}</h2>
                        </div>
                        
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
            <div style="padding: 20px 15px; display: flex ; justify-content: space-between; align-items: center; width: 100%; position: fixed; bottom: 0; background-color: {{ $offerWallTemplate->footerBg }}">
                <h2 style="margin: 0; font-size: 11px; font-weight: 600;"><img style="max-width: 150px;" src="/images/logo.png" /></h2>
                @if ($offerSettings->privacy_policy==1)
                <a href="" class="footerText-colordy" style="margin: 0px; font-size: 14px; color: {{ $offerWallTemplate->footerText }};">Privacy policy</a>
                @endif
             </div>
        </div>
    </div>
</body>
</html>