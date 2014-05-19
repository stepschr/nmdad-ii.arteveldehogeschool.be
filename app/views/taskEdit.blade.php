@extends('layouts.master')

@section('content')
<div data-role="header">
    <div class="ui-block-a" id="header">
        <a href=""><img class="logo" src="../../styles/images/logoBizzi.png"/></a>
        <ul id="search-head" data-role="listview" data-filter="true" data-filter-placeholder="&hellip;" data-inset="true" data-split-icon="delete"></ul>
    </div>
    <div id="head-btn">
        <div class="" id="profiel">
            @if ( Auth::check() )
            <div class="foto" style="background: url('../../<?php echo Auth::user()->getProfilePictureUrl() ?>') no-repeat;"> </div>
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
<div class="ui-grid-b">
    <div class="ui-block-a"></div>
    <div class="ui-block-b">
        <h1>Todo Bewerken </h1>
        @if ($errors->any())
        <div class="ui-corner-all">
            <div class="ui-bar ui-bar-a">
                <h3>Kan Todo niet bewerken.</h3>
            </div>
            <div class="ui-body ui-body-a">
                <p>Controleer de in <span class="error">rood</span> aangeduide velden.</p>
                <ul>
                    @foreach ($errors->all('<li>:message</li>' . PHP_EOL) as $message)
                    {{ $message }}
                    @endforeach
                </ul>
            </div>
        </div>

        @endif

        {{ Form::open(['data-ajax' => 'false', 'method' => 'post', 'action' => array('TaskController@update', $id)]) }}
        <fieldset>
            {{ Form::label('name', "Naam" . ':', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div class="ui-input-text ui-body-inherit{{{ $errors->has('email') ? ' error' : '' }}}">
                {{ Form::text('name', $task->name, [
                'placeholder' => "Naam",
                'data-enhanced' => 'true',
                ]), PHP_EOL }}
                @if ($errors->has('name'))
                {{ $errors->first('name', '<small class="ui-bar">:message</small>') }}
                @endif
            </div>



            {{ Form::label('deadline', "Deadline" . ':', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div class="ui-input-text ui-body-inherit{{{ $errors->has('password') ? ' error' : '' }}}">
                {{ Form::text('due_at', $task->due_at,[
                'placeholder' => "Deadline: YYYY-MM-DD HH:MM:SS",
                'data-enhanced' => 'true',
                ]), PHP_EOL }}

            </div>

            {{ Form::label('lists_id', "Lijst" . ':'), PHP_EOL }}
            <div>
                {{ Form::select('lists_id', Lists::where('user_id', '=', Auth::user()->id)->lists('name', 'id'), $task->lists_id) }}
            </div>



        </fieldset>

        <div class="ui-input-btn ui-btn ui-btn-inline ui-btn-b">
            Bijwerken
            {{ Form::submit('Bijwerken', [
            'data-enhanced' => 'true'
            ]), PHP_EOL }}
        </div>

        {{ Form::close(), PHP_EOL }}
</div>
@stop