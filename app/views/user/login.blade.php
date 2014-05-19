@extends('layouts.master')

@section('content')
<div data-role="header">
    <div class="ui-block-a" id="header">
        <a href=""><img class="logo" src="../styles/images/logoBizzi.png"/></a>
        <ul id="search-head" data-role="listview" data-filter="true" data-filter-placeholder="&hellip;" data-inset="true" data-split-icon="delete"></ul>
    </div>
</div>
    <div class="ui-grid-b">
        <div class="ui-block-a"></div>
        <div class="ui-block-b">
            <h1>Meld je aan</h1>
            {{ Form::open([
                'route' => 'user.auth',
                'data-ajax' => 'false',
            ]), PHP_EOL }}

            <fieldset>
                <legend class="ui-hidden-accessible">Aanmeldgegevens</legend>
                {{ Form::label('email', 'E-mailadres', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
                <div class="ui-input-text ui-body-inherit">
                    {{ Form::email('email', '', [
                        'placeholder' => 'E-mailadres',
                        'data-enhanced' => 'true',
                    ]), PHP_EOL }}
                </div>

                {{ Form::label('password', 'Wachtwoord:', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
                <div class="ui-input-text ui-body-inherit">
                    {{ Form::password('password', [
                        'placeholder' => 'Wachtwoord',
                        'data-enhanced' => 'true',
                    ]), PHP_EOL }}
                </div>
                <div class="ui-field-contain">
                    <label for="switch-auth" class="">Onthouden:</label>
                    <select name="switch-auth" id="switch-auth" data-role="slider">
                        <option value="forget">Nee</option>
                        <option value="remember" selected>Ja</option>
                    </select>
                </div>
            </fieldset>

            <div class="ui-input-btn ui-btn ui-btn-inline ui-btn-b">
                Aanmelden
                {{ Form::submit('Aanmelden', ['data-enhanced' => 'true']), PHP_EOL }}
            </div>
            {{ HTML::linkRoute('user.index', 'Terug naar de startpagina', [], [
                'class' => 'ui-btn ui-btn-inline ui-btn-icon-left ui-icon-home',
                'data-ajax' => 'false',
            ]), PHP_EOL }}

            {{ Form::close(), PHP_EOL }}
        </div>
    </div>
@stop