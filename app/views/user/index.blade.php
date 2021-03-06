@extends('layouts.master')

@section('head')
{{ HTML::script('scripts/utilities.js') }}
{{ HTML::script('scripts/app.js') }}
@stop

@section('content')
<div class="wrapper" id="header-wrapper" data-role="header">
    <header class="container" id="header" role="header">
        <div class="row ui-block-a">

            <img class="logo" src="styles/images/logoBizzi.png"/>
            <ul id="zoekbalk" data-role="listview" data-filter="true" data-filter-placeholder="&hellip;" data-inset="true" data-split-icon="delete"></ul>
        </div>
    </header>

</div>
<div id="head-btn">
    @if( Auth::check() && Auth::user()->isAdmin() )

    <div class="" id="profiel_admin">
        @if ( Auth::check() )
        <div class="foto" style="background: url('<?php echo Auth::user()->getProfilePictureUrl() ?>') no-repeat;"> </div>


        <p>{{ Auth::user()->username}}</p>
    </div>



    @else

    @endif
    <!--{{ HTML::link('/', 'Ga naar de taken', [
    'class'     => 'ui-btn ui-btn-inline ui-btn-b ui-btn-icon-left ui-icon-bullets',
    'data-ajax' => 'false',
    ]) }}-->
    {{ HTML::linkRoute('user.logout', 'AFMELDEN', [], [
    'id'        => 'btn-afmeld-admin',
    'class'     => 'ui-btn ui-btn-inline',
    'data-ajax' => 'false',
    ]) }}
</div>

@else
@if ( Auth::guest() )

{{-- Link maken van een Named Route http://laravel.com/api/class-Illuminate.Html.HtmlBuilder.html#_linkRoute --}}
<div class="ui-block-b">
    {{ Form::open([
    'route' => 'user.auth',
    'data-ajax' => 'false',
    ]), PHP_EOL }}

    <fieldset id="login_blok">
        <div id="invul">
            <legend class="ui-hidden-accessible">Aanmeldgegevens</legend>
            {{ Form::label('email', 'E-mailadres', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div class="ui-input-text ui-body-inherit" id="invul1">
                {{ Form::email('email', '', [
                'placeholder' => 'E-mailadres',
                'data-enhanced' => 'true',
                ]), PHP_EOL }}
            </div>

            {{ Form::label('password', 'Wachtwoord:', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div class="ui-input-text ui-body-inherit" id="invul2">
                {{ Form::password('password', [
                'placeholder' => 'Wachtwoord',
                'data-enhanced' => 'true',
                ]), PHP_EOL }}
            </div>
            <div class="ui-field-contain" id="remember-switch">
                <label for="" class="">Onthouden:</label>
                <select name="switch-auth" id="switch-auth" data-role="">
                        <option value="forget">Nee</option>
                        <option value="remember" selected>Ja</option>
                </select>

            </div>
        </div>
    </fieldset>

    <div class="ui-input-btn ui-btn ui-btn-inline ui-btn-b btn-head emailvakje" id="btn-aanmeld">
        Aanmelden
        {{ Form::submit('Aanmelden', [
        'route' => 'home',
        'data-enhanced' => 'true',
        ]), PHP_EOL }}

    </div>
</div>


    <!--{{ HTML::linkRoute('user.index', 'Terug naar de startpagina', [], [
    'class' => 'ui-btn ui-btn-inline ui-btn-icon-left ui-icon-home',
    'data-ajax' => 'false',
    ]), PHP_EOL }}-->

    {{ Form::close(), PHP_EOL }}



    @else
    <div id="btn-afmeld-profiel">
    <div class="" id="profiel">
        @if ( Auth::check() )
        <div class="foto" style="background: url('<?php echo Auth::user()->getProfilePictureUrl() ?>') no-repeat;"> </div>
    </div>
    <p>{{ Auth::user()->username}}</p>
    @else

    @endif
    <!--{{ HTML::link('/', 'Ga naar de taken', [
    'class'     => 'ui-btn ui-btn-inline ui-btn-b ui-btn-icon-left ui-icon-bullets',
    'data-ajax' => 'false',
    ]) }}-->
    {{ HTML::linkRoute('user.logout', 'AFMELDEN', [], [
    'id'        => 'btn-afmeld',
    'class'     => 'ui-btn ui-btn-inline',
    'data-ajax' => 'false',
    ]) }}
    </div>

@endif

</div>
</div>
</div>
</div>
@if ( Auth::guest() )
<div class="wrapper" id="main-wrapper">
    <div class="container" id="main-container">
        <main id="main" role="main">

            <div id="info">
                <aside id="aside-logo">
                    <h2>Bizzi</h2>
                    <h3>De nieuwe todo webapp</h3>
                </aside>
                <article id="article-slogan">
                    <p>helpt je met:<br>
                        -  Nieuwe taken aan te maken<br>
                        -  Lijsten aan te maken<br>
                        -  Vrienden toe te voegen<br>
                        -  Lijsten te delen</p>

                    <p>

                        {{ HTML::linkRoute('user.create', 'Registreer je', [], [
                        'id'        => 'btn-registreer',
                        'class'     => 'ui-btn ui-btn-inline btn-head',
                        'data-ajax' => 'false',
                        ]) }}
                    </p>
                </article>

            </div>



            <div id="beschikbaar" class="ui-block-a">BESCHIKBAAR OP</div>
            <div id="vb" class="ui-grid-a">

                <img id="mac" src="assets/images/macbook.png"/>
                <img id="ipad" src="assets/images/ipad.png" height="250px"/>
                <img id="iphone" src="assets/images/iphone.png" height="200px"/>
            </div>

        </main>
    </div>
</div>
@else

@include('navigation', ['pageActive' => 'user'])
<div id="navbar_index">

</div>

<div id="content_profile"></div>
<div class="foto_aanpas_profiel" style="background: url('<?php echo Auth::user()->getProfilePictureUrl(); ?>') no-repeat;">
    <h3>Welkom, <?php echo Auth::user()->username ?></h3>
</div>
@endif

@endif

@if( Auth::check() && Auth::user()->isAdmin() )
<div id="admin">
    <h1>Actieve Users:</h1>
    <div id="userlist"></div>

    <h1>Verwijderde Users:</h1>
    <div id="deleteduserlist"></div>

    <h1>Alle Taken:</h1>
    <div id="alltask"></div>
</div>

@else
@endif
<div class="wrapper" id="footer-wrapper">
    <footer class="container" id="footer" role="footer">
        <p>© Charlotte Balcaen, Pauline Chevalier & Stephanie Schroé in opdracht van Arteveldehogeschool | 2MMP | 2013 -2014</p>
    </footer>
</div>
@stop
