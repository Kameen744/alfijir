<!DOCTYPE html>
<html lang="ha">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <meta property="og:title" content="{{ empty($og_title) ? 'Alfijir Radio' : $og_title }}" />
    <meta property="og:description" content="{{ empty($og_description) ? 'Alfijir Radio. Hasken Al\'umma, sabon gidan radio' : $og_description }}" />
    <meta property="og:image" content="{{ empty($og_image) ? asset('images/icons/icon-384x384.png') : $og_image }}" />
    <meta property="og:image:secure_url" content="{{ empty($og_image) ? asset('images/icons/icon-384x384.png') : $og_image }}" />
    <meta property="og:url" content="{{ empty($og_url) ? url()->current() : $og_url }}" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:alt" content="Alfijir Radio Logo">

    <meta name="twitter:card" content="{{ empty($og_image) ? asset('images/icons/icon-384x384.png') : $og_image }}"/>
    <meta name="twitter:title" content="{{ empty($og_title) ? 'Alfijir Radio' : $og_title }}"/>
    <meta name="twitter:description" content="{{ empty($og_description) ? 'Alfijir Radio. Hasken Al\'umma, sabon gidan radio' : $og_description }}"/>
    <meta name="twitter:image"content="{{ empty($og_image) ? asset('images/icons/icon-384x384.png') : $og_image }}"/>
    {{-- <meta name="twitter:site" content="@yourusername"/> --}}
    {{-- <meta name="twitter:creator" content="@yourusername"/> --}}

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('css/n-progress.css') }}" defer></script> --}}
  </head>
  <body>
      <div class="p-3"></div>
    @routes
    @inertia
  </body>
</html>
