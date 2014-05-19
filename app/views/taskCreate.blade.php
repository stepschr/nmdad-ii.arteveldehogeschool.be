@extends('layouts.master')

@section('content')

<div class="ui-grid-b">
    <div class="ui-block-a"></div>
    <div class="ui-block-b">
        <h1>Taak Toevoegen</h1>
        @if ($errors->any())
        <div class="ui-corner-all">
            <div class="ui-bar ui-bar-a">
                <h3>Kan Taak niet toevoegen.</h3>
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

        {{ Form::open([
        'route' => 'todo.store',
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



            {{ Form::label('deadline', "Deadline" . ':', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div class="ui-input-text ui-body-inherit{{{ $errors->has('password') ? ' error' : '' }}}">
                {{ Form::text('deadline', '',[
                'placeholder' => "Deadline: YYYY-MM-DD HH:MM:SS",
                'data-enhanced' => 'true',
                'data-role' => 'date',
                ]), PHP_EOL }}
                @if ($errors->has('deadline'))
                {{ $errors->first('deadline', '<small class="ui-bar">:message</small>') }}
                @endif
            </div>




            {{ Form::label('lijst_id', "Lijst" . ':', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div>
                {{ Form::select('lijst_id', Lijst::where('user_id', '=', Auth::user()->id)->lists('name', 'id')) }}
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
</div>
@stop