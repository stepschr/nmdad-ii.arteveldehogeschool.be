<?php
$version = [
    'jQuery-legacy' => '1.11.0', // Previous generation of jQuery
    'jQuery'        => '2.1.0',
    'jQueryMobile'  => '1.4.2',
    'lodash'        => '2.4.1',
    'modernizr'     => '2.7.1',
];
?><!doctype html>
<html lang="{{ Config::get('app.locale') }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>{{ HTML::entities('Bizzi - Organize your tasks') }}</title>
    {{ HTML::style("//code.jquery.com/mobile/{$version['jQueryMobile']}/jquery.mobile-{$version['jQueryMobile']}.min.css") }}
    {{ HTML::style("styles/app_steph.css") }}
    <!--{{ HTML::style("styles/app.css") }}-->
    <!--{{ HTML::style("styles/global.css") }}-->
    {{ HTML::script("//code.jquery.com/jquery-{$version['jQuery']}.min.js") }}
    {{ HTML::script("//cdnjs.cloudflare.com/ajax/libs/lodash.js/{$version['lodash']}/lodash.mobile.min.js") }}
@yield('head')
    {{ HTML::script("//code.jquery.com/mobile/{$version['jQueryMobile']}/jquery.mobile-{$version['jQueryMobile']}.min.js") }}
    {{ HTML::script("//cdnjs.cloudflare.com/ajax/libs/modernizr/{$version['modernizr']}/modernizr.min.js") }}
    <link rel="shortcut icon" type="image/x-icon" href="/nmdad-ii.arteveldehogeschool.be/public/assets/images/favicon.png" />
</head>
<body class="{{ $page_class or '' }}">

@yield('content')

<footer>
    <p>© Charlotte Balcaen, Pauline Chevalier & Stephanie Schroé in opdracht van Arteveldehogeschool | 2MMP | 2013 -2014</p></footer>
</body>
</html>