@extends('layouts.master')

@section('content')

<div class="ui-grid-b">
    <div class="ui-block-a">

        </ul>
    </div>
    <div class="ui-block-b">
        <h1>Lijst Bewerken</h1>
        @if ($errors->any())
        <div class="ui-corner-all">
            <div class="ui-bar ui-bar-a">
                <h3>Kan Lijst niet toevoegen.</h3>
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
        {{ Form::open(['data-ajax' => 'false', 'method' => 'post', 'action' => array('LijstController@update', $id)]) }}
        <fieldset>
            {{ Form::label('name', "Naam" . ':', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div class="ui-input-text ui-body-inherit{{{ $errors->has('email') ? ' error' : '' }}}">
                {{ Form::text('name', $lijst->name, [
                'placeholder' => "Naam",
                'data-enhanced' => 'true',
                ]), PHP_EOL }}
                @if ($errors->has('name'))
                {{ $errors->first('name', '<small class="ui-bar">:message</small>') }}
                @endif
            </div>
        </fieldset>

        <div class="ui-input-btn ui-btn ui-btn-inline ui-btn-b">
            Bewerken
            {{ Form::submit('Bewerken', [
            'data-enhanced' => 'true'
            ]), PHP_EOL }}
        </div>

        {{ Form::close(), PHP_EOL }}
    </div>
</div>
@stop