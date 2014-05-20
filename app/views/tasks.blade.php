@extends('layouts.master')
@section('head')
    {{ HTML::script('scripts/utilities.js') }}
    {{ HTML::script('scripts/models/Pomodoro.js') }}
    {{ HTML::script('scripts/models/Label.js') }}
    {{ HTML::script('scripts/models/Lists.js') }}
    {{ HTML::script('scripts/models/Task.js') }}
    {{ HTML::script('scripts/app.js') }}
@stop

@section('content')

    <div id="page-tasks" data-role="page">

        <div data-role="header">
            <div class="ui-block-a" id="header">
                <a href=""><img class="logo" src="styles/images/logoBizzi.png"/></a>
                <ul id="search-head" data-role="listview" data-filter="true" data-filter-placeholder="&hellip;" data-inset="true" data-split-icon="delete"></ul>
            </div>
            <div id="head-btn">
                <div class="" id="profiel">
                    @if ( Auth::check() )
                    <div class="foto" style="background: url('<?php echo Auth::user()->getProfilePictureUrl() ?>') no-repeat;"> </div>
                    <p>{{ Auth::user()->username}}</p>
                    @else

                    @endif
                    {{ HTML::linkRoute('user.logout', 'AFMELDEN', [], [
                    'id'        => 'btn-afmeld',
                    'class'     => 'ui-btn ui-btn-inline',
                    'data-ajax' => 'false',
                    ]) }}
                </div>
            </div>
        </div>
        @include('navigation', ['pageActive' => 'page-tasks'])
        <div role="main" class="ui-content">

            <div class="ui-grid-b">
                <div class="ui-block-a"></div>
                <div class="ui-block-b">
                    <h1>Taken</h1>

                    <div id="tasks"></div>

                    <h1>Afgelopen Taken</h1>
                    <div id="finishedtasks"></div>

                    {{ HTML::linkRoute('task.create', 'Nieuwe Taak Toevoegen', []) }}

                </div>
            </div>


        </div><!-- /content -->
    </div><!-- /page -->
<div id="page-task-create" data-transition="slide" data-role="page" data-dialog="true" data-close-btn="right">
    <div data-role="header">
        <h1>Taak Toevoegen</h1>
    </div>
    <div role="main" class="ui-content">

            {{ Form::open([
            'route' => 'task.store',
            'data-ajax' => 'false',
            ]), PHP_EOL }}
            <fieldset>
                {{ Form::label('name', "Naam" . ':'), PHP_EOL }}
                <div class="ui-input-text ui-body-inherit">
                    {{ Form::text('name', '', [
                    'placeholder' => "Naam",
                    'data-enhanced' => 'true',
                    ]), PHP_EOL }}
                </div>

                {{ Form::label('due_at', "Deadline" . ':'), PHP_EOL }}
                <div class="ui-input-text ui-body-inherit">
                    {{ Form::text('due_at', '',[
                    'placeholder' => "Deadline: YYYY-MM-DD HH:MM:SS",
                    'data-enhanced' => 'true',
                    'data-role' => 'date',
                    ]), PHP_EOL }}

                </div>


                {{ Form::label('lists_id', "Lijst" . ':'), PHP_EOL }}
                <div>
                    {{ Form::select('lists_id', Lists::where('user_id', '=', Auth::user()->id)->lists('name', 'id')) }}
                </div>

                {{ Form::label('prioriteit', "todo" . ':', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
                <div>
                    {{ Form::select('prioriteit', Prioriteit::lists('name', 'class')) }}
                </div>


            </fieldset>

            <div class="ui-input-btn ui-btn ui-btn-inline ui-btn-b">
                Toevoegen
                {{ Form::submit('Toevoegen', [
                'data-enhanced' => 'true'
                ]), PHP_EOL }}
            </div>

            {{ Form::close(), PHP_EOL }}

    </div>
</div><!-- /page -->
<div id="taskEdit/${task.id}" data-role="page" data-dialog="true" data-close-btn="right">
    <div data-role="header">
        <h1>Taak bewerken</h1>
    </div>


</div><!-- /page -->

<div id="page-lists" data-role="page">
        <div data-role="header">
            <div class="ui-block-a" id="header">
                <a href=""><img class="logo" src="styles/images/logoBizzi.png"/></a>
                <ul id="search-head" data-role="listview" data-filter="true" data-filter-placeholder="&hellip;" data-inset="true" data-split-icon="delete"></ul>
            </div>
            <div id="head-btn">
                <div class="" id="profiel">
                    @if ( Auth::check() )
                    <div class="foto" style="background: url('<?php echo Auth::user()->getProfilePictureUrl() ?>') no-repeat;"> </div>
                    <p>{{ Auth::user()->username}}</p>
                    @else

                    @endif
                    {{ HTML::linkRoute('user.logout', 'AFMELDEN', [], [
                    'id'        => 'btn-afmeld',
                    'class'     => 'ui-btn ui-btn-inline',
                    'data-ajax' => 'false',
                    ]) }}
                </div>
            </div>
        </div>

        @include('navigation', ['pageActive' => 'page-lists'])
        <div role="main" class="ui-content">
            <div class="ui-grid-b">
                <div class="ui-block-a"></div>
                <div class="ui-block-b">
                    <h1>Lijst weergeven:</h1>
                    <ul id="lijsten">

                    </ul>


                    <h1>Lijst Toevoegen</h1>

                    {{ Form::open([
                    'route' => 'lijst.store',
                    'data-ajax' => 'false',
                    ]), PHP_EOL }}
                    <fieldset>
                        {{ Form::label('name', "Naam" . ':', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
                        <div class="ui-input-text ui-body-inherit{{{ $errors->has('email') ? ' error' : '' }}}">
                            {{ Form::text('name', '', [
                            'placeholder' => "Naam",
                            'data-enhanced' => 'true',
                            ]), PHP_EOL }}
                            @if ($errors->has('name'))
                            {{ $errors->first('name', '<small class="ui-bar">:message</small>') }}
                            @endif
                        </div>
                    </fieldset>

                    <div class="ui-input-btn ui-btn ui-btn-inline ui-btn-b">
                        Toevoegen
                        {{ Form::submit('Toevoegen', [
                        'data-enhanced' => 'true'
                        ]), PHP_EOL }}
                    </div>

                    {{ Form::close(), PHP_EOL }}
                </div>
            </div>
        </div>
</div><!-- /page -->

<div id="page-labels" data-role="page">
    <div data-role="header">
        <div class="ui-block-a" id="header">
            <a href=""><img class="logo" src="styles/images/logoBizzi.png"/></a>
            <ul id="search-head" data-role="listview" data-filter="true" data-filter-placeholder="&hellip;" data-inset="true" data-split-icon="delete"></ul>
        </div>
        <div id="head-btn">
            <div class="" id="profiel">
                @if ( Auth::check() )
                <div class="foto" style="background: url('<?php echo Auth::user()->getProfilePictureUrl() ?>') no-repeat;"> </div>
                <p>{{ Auth::user()->username}}</p>
                @else

                @endif
                {{ HTML::linkRoute('user.logout', 'AFMELDEN', [], [
                'id'        => 'btn-afmeld',
                'class'     => 'ui-btn ui-btn-inline',
                'data-ajax' => 'false',
                ]) }}
            </div>
        </div>

    </div>
    @include('navigation', ['pageActive' => 'page-labels'])
    <div role="main" class="ui-content">
        <div class="ui-grid-b">
            <div class="ui-block-a"></div>
            <div class="ui-block-b">
                <h1>Labels</h1>
                <ul id="labels" data-role="listview" data-filter="true" data-filter-placeholder="Labels zoeken&hellip;" data-inset="true" data-split-icon="delete"></ul>
                <form id="form-label-add" action="">
                    <input type="text" name="label-name" placeholder="Nieuw Label toevoegen&hellip;" value="">
                </form>
            </div>
        </div>
    </div><!-- /content -->
</div><!-- /page -->

<div id="page-label" data-role="page" data-dialog="true" data-close-btn="right">
    <div data-role="header">
        <h1>Label bewerken</h1>
    </div>
    <div role="main" class="ui-content">
        <form id="form-label-update" action="">
            <div class="ui-field-contain">
                <label for="label-name">Naam:</label>
                <input type="text" name="label-name" id="label-name" placeholder="Naam" value="">
            </div>
            <div class="ui-field-contain">
                <label for="label-colour">Kleur:</label>
                <input type="text" name="label-colour" id="label-colour" pattern="[0-9A-Fa-f]{6}" placeholder="RRGGBB" maxlength="6" value="">
            </div>
            <button class="ui-btn ui-btn-icon-left ui-icon-check">Opslaan</button>
        </form>
    </div><!-- /content -->
</div><!-- /page -->

<div id="page-vrienden" data-role="page">
    <div data-role="header">
        <div class="ui-block-a" id="header">
            <a href=""><img class="logo" src="styles/images/logoBizzi.png"/></a>
            <ul id="search-head" data-role="listview" data-filter="true" data-filter-placeholder="Zoeken&hellip;" data-inset="true" data-split-icon="delete"></ul>
        </div>
        <div id="head-btn">
            <div class="" id="profiel">
                @if ( Auth::check() )
                <div class="foto" style="background: url('<?php echo Auth::user()->getProfilePictureUrl() ?>') no-repeat;"> </div>
                <p>{{ Auth::user()->username}}</p>
                @else

                @endif
                {{ HTML::linkRoute('user.logout', 'AFMELDEN', [], [
                'id'        => 'btn-afmeld',
                'class'     => 'ui-btn ui-btn-inline',
                'data-ajax' => 'false',
                ]) }}
            </div>
        </div>
    </div>
    @include('navigation', ['pageActive' => 'page-vrienden'])
    <div role="main" class="ui-content">
        <div class="ui-grid-b">
            <div class="ui-block-a"></div>
            <div class="ui-block-b">
                <h1>Vrienden</h1>
                <!--<ul id="labels" data-role="listview" data-filter="true" data-filter-placeholder="Labels zoeken&hellip;" data-inset="true" data-split-icon="delete"></ul>-->
                {{ Auth::user()->friends }}
            </div>
        </div>
    </div><!-- /content -->
</div><!-- /page -->


<div id="page-instellingen" data-role="page">
    <div data-role="header">
        <div class="ui-block-a" id="header">
            <a href=""><img class="logo" src="styles/images/logoBizzi.png"/></a>
            <ul id="search-head" data-role="listview" data-filter="true" data-filter-placeholder="&hellip;" data-inset="true" data-split-icon="delete"></ul>
        </div>
        <div id="head-btn">
            <div class="" id="profiel">
                @if ( Auth::check() )
                <div class="foto" style="background: url('<?php echo Auth::user()->getProfilePictureUrl() ?>') no-repeat;"> </div>
                <p>{{ Auth::user()->username}}</p>
                @else

                @endif
                {{ HTML::linkRoute('user.logout', 'AFMELDEN', [], [
                'id'        => 'btn-afmeld',
                'class'     => 'ui-btn ui-btn-inline',
                'data-ajax' => 'false',
                ]) }}
            </div>
        </div>

    </div>
    @include('navigation', ['pageActive' => 'page-instellingen'])
    <div role="main" class="ui-content">
        <div class="ui-grid-b">
            <div class="ui-block-a"></div>
            <div class="ui-block-b" id="inhoud">
                <h1>Instellingen</h1>
                {{ Form::model(Auth::user(), array('route' => array('user.profile_picture'), 'data-ajax'=>'false', 'files'=>true)) }}
                <fieldset>
                    <legend class="ui-hidden-accessible">Aanmeldgegevens</legend>

                    {{ Form::label('email', 'Email', ['class' => '']) }}
                    {{ Form::email('email', null, array('class'=>"ui-input-text ui-body-inherit", 'disabled')); }}
                    <div class="error">{{$errors->first('email');}}</div>

                    {{ Form::label('username', 'Gebruikersnaam', ['class' => '']) }}
                    {{ Form::text('username', null, array('class'=>"ui-input-text ui-body-inherit")); }}
                    <div class="error">{{$errors->first('username');}}</div>

                    {{ Form::label('password', 'Wachtwoord', ['class' => '']) }}
                    {{ Form::password('password', '', array('class'=>"ui-input-text ui-body-inherit")); }}
                    <div class="error">{{$errors->first('password');}}</div>

                    {{ Form::label('password_repeat', 'Herhaal wachtwoord', ['class' => '']) }}
                    {{ Form::password('password_repeat', '', array('class'=>"ui-input-text ui-body-inherit")); }}
                    <div class="error">{{$errors->first('password_repeat');}}</div>

                    {{ Form::label('date_of_birth', 'Geboortedatum', ['class' => '']) }}
                    {{ Form::text('date_of_birth', null, array('class'=>"ui-input-text ui-body-inherit")); }}
                    <div class="error">{{$errors->first('date_of_birth');}}</div>

                    <div class="btn">
                        {{ Form::submit('Wijzigen'); }}
                    </div>
                   <!-- <div class="foto_aanpas" style="background: url('styles/images/pic.jpg') no-repeat;">-->
                    <div class="foto_aanpas" style="background: url('<?php echo Auth::user()->getProfilePictureUrl(); ?>') no-repeat;">
                        {{ Form::file('profile_picture') }}
                        <div class="error">{{$errors->first('profile_picture');}}</div>
                        <div>


                </fieldset>
                {{ Form::close() }}




                </fieldset>
            </div>
        </div>
    </div><!-- /content -->
</div><!-- /page -->

@stop
