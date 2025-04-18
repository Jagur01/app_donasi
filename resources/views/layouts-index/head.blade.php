<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="{{ asset('index/assets/css/bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/css/icofont.min.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/css/meanmenu.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/css/modal-video.min.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/fonts/flaticon.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/css/animate.min.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/css/lightbox.min.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/css/owl.carousel.min.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/css/owl.theme.default.min.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/css/odometer.min.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/css/nice-select.min.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/css/style.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/css/responsive.css') }}">
   <link rel="stylesheet" href="{{ asset('index/assets/css/theme-dark.css') }}">
   <title>Home</title>
   <link rel="icon" type="image/png" href="{{ asset('index/assets/img/masjid_uika.png') }}">
   <style>
      .donation-item:hover h3,
      .donation-item:hover .inner ul li,
      .donation-item:hover .inner span {
         color: white !important;
      }
   </style>

      
   <style>
      .phpdebugbar pre.sf-dump {
         display: block;
         white-space: pre;
         padding: 5px;
         overflow: initial !important;
      }

      .phpdebugbar pre.sf-dump:after {
         content: "";
         visibility: hidden;
         display: block;
         height: 0;
         clear: both;
      }

      .phpdebugbar pre.sf-dump span {
         display: inline;
      }

      .phpdebugbar pre.sf-dump a {
         text-decoration: none;
         cursor: pointer;
         border: 0;
         outline: none;
         color: inherit;
      }

      .phpdebugbar pre.sf-dump img {
         max-width: 50em;
         max-height: 50em;
         margin: .5em 0 0 0;
         padding: 0;
         background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAAAAAA6mKC9AAAAHUlEQVQY02O8zAABilCaiQEN0EeA8QuUcX9g3QEAAjcC5piyhyEAAAAASUVORK5CYII=) #D3D3D3;
      }

      .phpdebugbar pre.sf-dump .sf-dump-ellipsis {
         display: inline-block;
         overflow: visible;
         text-overflow: ellipsis;
         max-width: 5em;
         white-space: nowrap;
         overflow: hidden;
         vertical-align: top;
      }

      .phpdebugbar pre.sf-dump .sf-dump-ellipsis+.sf-dump-ellipsis {
         max-width: none;
      }

      .phpdebugbar pre.sf-dump code {
         display: inline;
         padding: 0;
         background: none;
      }

      .sf-dump-public.sf-dump-highlight,
      .sf-dump-protected.sf-dump-highlight,
      .sf-dump-private.sf-dump-highlight,
      .sf-dump-str.sf-dump-highlight,
      .sf-dump-key.sf-dump-highlight {
         background: rgba(111, 172, 204, 0.3);
         border: 1px solid #7DA0B1;
         border-radius: 3px;
      }

      .sf-dump-public.sf-dump-highlight-active,
      .sf-dump-protected.sf-dump-highlight-active,
      .sf-dump-private.sf-dump-highlight-active,
      .sf-dump-str.sf-dump-highlight-active,
      .sf-dump-key.sf-dump-highlight-active {
         background: rgba(253, 175, 0, 0.4);
         border: 1px solid #ffa500;
         border-radius: 3px;
      }

      .phpdebugbar pre.sf-dump .sf-dump-search-hidden {
         display: none !important;
      }

      .phpdebugbar pre.sf-dump .sf-dump-search-wrapper {
         font-size: 0;
         white-space: nowrap;
         margin-bottom: 5px;
         display: flex;
         position: -webkit-sticky;
         position: sticky;
         top: 5px;
      }

      .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>* {
         vertical-align: top;
         box-sizing: border-box;
         height: 21px;
         font-weight: normal;
         border-radius: 0;
         background: #FFF;
         color: #757575;
         border: 1px solid #BBB;
      }

      .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>input.sf-dump-search-input {
         padding: 3px;
         height: 21px;
         font-size: 12px;
         border-right: none;
         border-top-left-radius: 3px;
         border-bottom-left-radius: 3px;
         color: #000;
         min-width: 15px;
         width: 100%;
      }

      .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>.sf-dump-search-input-next,
      .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>.sf-dump-search-input-previous {
         background: #F2F2F2;
         outline: none;
         border-left: none;
         font-size: 0;
         line-height: 0;
      }

      .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>.sf-dump-search-input-next {
         border-top-right-radius: 3px;
         border-bottom-right-radius: 3px;
      }

      .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>.sf-dump-search-input-next>svg,
      .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>.sf-dump-search-input-previous>svg {
         pointer-events: none;
         width: 12px;
         height: 12px;
      }

      .phpdebugbar pre.sf-dump .sf-dump-search-wrapper>.sf-dump-search-count {
         display: inline-block;
         padding: 0 5px;
         margin: 0;
         border-left: none;
         line-height: 21px;
         font-size: 12px;
      }

      .phpdebugbar pre.sf-dump,
      .phpdebugbar pre.sf-dump .sf-dump-default {
         word-wrap: break-word;
         white-space: pre-wrap;
         word-break: normal
      }

      .phpdebugbar pre.sf-dump .sf-dump-num {
         font-weight: bold;
         color: #1299DA
      }

      .phpdebugbar pre.sf-dump .sf-dump-const {
         font-weight: bold
      }

      .phpdebugbar pre.sf-dump .sf-dump-str {
         font-weight: bold;
         color: #3A9B26
      }

      .phpdebugbar pre.sf-dump .sf-dump-note {
         color: #1299DA
      }

      .phpdebugbar pre.sf-dump .sf-dump-ref {
         color: #7B7B7B
      }

      .phpdebugbar pre.sf-dump .sf-dump-public {
         color: #000000
      }

      .phpdebugbar pre.sf-dump .sf-dump-protected {
         color: #000000
      }

      .phpdebugbar pre.sf-dump .sf-dump-private {
         color: #000000
      }

      .phpdebugbar pre.sf-dump .sf-dump-meta {
         color: #B729D9
      }

      .phpdebugbar pre.sf-dump .sf-dump-key {
         color: #3A9B26
      }

      .phpdebugbar pre.sf-dump .sf-dump-index {
         color: #1299DA
      }

      .phpdebugbar pre.sf-dump .sf-dump-ellipsis {
         color: #A0A000
      }

      .phpdebugbar pre.sf-dump .sf-dump-ns {
         user-select: none;
      }

      .phpdebugbar pre.sf-dump .sf-dump-ellipsis-note {
         color: #1299DA
      }
   </style>
</head>
