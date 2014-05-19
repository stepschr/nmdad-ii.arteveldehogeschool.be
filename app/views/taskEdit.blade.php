@extends('layouts.master')

@section('content')

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

        {{ Form::open(['data-ajax' => 'false', 'method' => 'post', 'action' => array('TodoController@update', $id)]) }}
        <fieldset>
            {{ Form::label('name', "Naam" . ':', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div class="ui-input-text ui-body-inherit{{{ $errors->has('email') ? ' error' : '' }}}">
                {{ Form::text('name', $todo->name, [
                'placeholder' => "Naam",
                'data-enhanced' => 'true',
                ]), PHP_EOL }}
                @if ($errors->has('name'))
                {{ $errors->first('name', '<small class="ui-bar">:message</small>') }}
                @endif
            </div>



            {{ Form::label('deadline', "Deadline" . ':', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div class="ui-input-text ui-body-inherit{{{ $errors->has('password') ? ' error' : '' }}}">
                {{ Form::text('deadline', $todo->deadline,[
                'placeholder' => "Deadline: YYYY-MM-DD HH:MM:SS",
                'data-enhanced' => 'true',
                ]), PHP_EOL }}
                @if ($errors->has('deadline'))
                {{ $errors->first('deadline', '<small class="ui-bar">:message</small>') }}
                @endif
            </div>

            {{ Form::label('lijst_id', "Lijst" . ':', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div>
                {{ Form::select('lijst_id', Lijst::where('user_id', '=', Auth::user()->id)->lists('name', 'id'), $todo->lijst_id) }}
            </div>

            {{ Form::label('prioriteit', "todo" . ':', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div>
                {{ Form::select('prioriteit', Prioriteit::lists('name', 'class'), $todo->prioriteit) }}
            </div>

        </fieldset>

        <div class="ui-input-btn ui-btn ui-btn-inline ui-btn-b">
            Bijwerken
            {{ Form::submit('Bijwerken', [
            'data-enhanced' => 'true'
            ]), PHP_EOL }}
        </div>

        {{ Form::close(), PHP_EOL }}

<!--
        {{ Form::model($todo, array('route' => array('todo.update', $todo->id))) }}
        <fieldset>
            {{ Form::label('name', 'Name:')}}
            {{ Form::text('name')}}
        </fieldset>
        <fieldset>
            {{ Form::label('deadline', 'Deadline:')}}
            {{ Form::text('deadline')}}

        </fieldset>

        <div class="ui-input-btn ui-btn ui-btn-inline ui-btn-b">
            Bewerken
            {{ Form::submit('Bewerken', [
            'data-enhanced' => 'true'
            ]) }}
        </div>
        {{ Form::close(), PHP_EOL }}


    </div>
    -->
</div>
@stop