<head>
    <base href="{{ config('app.url') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="author" content="{{ $system['homepage_company'] }}">
    <meta name="copyright" content="{{ $system['homepage_copyright'] }}">
    <meta http-equiv="refresh" content="1800">
    <link rel="icon" href="{{ $system['homepage_favicon'] }}" type="image/png" sizes="30x30">
    {{-- GOOGLE --}}
    <title>{{ $seo['meta_title'] }}</title>
    <meta name="description" content="{{ $seo['meta_description'] }}">
    <meta name="keyword" content="{{ $seo['meta_keyword'] }}">
    <link rel="canonical" href="{{ $seo['canonical'] }}">
    <meta property="og:locale" content="vi_VN" />
    {{-- FACEBOOK --}}
    <meta property="og:title" content="{{ $seo['meta_title'] }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $seo['canonical'] }}" />
    <meta property="og:image" content=" {{ $seo['meta_image'] }} " />
    <link rel="stylesheet" href="{{ asset('frontend/resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/resources/uikit/css/uikit.modify.css')}}">
    <link rel="stylesheet" href="{{ asset('https://unpkg.com/swiper/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('frontend/resources/library/css/library.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/resources/plugins/wow/css/libs/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/resources/style.css')}}">
    <script src="{{ asset('frontend/resources/library/js/jquery.js')}}"></script>
</head>