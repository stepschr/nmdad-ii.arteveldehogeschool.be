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
        <h1>Registreer je</h1>
        {{ Form::open([
        'route' => 'user.store',
        'data-ajax' => 'false',
        ]), PHP_EOL }}

        <fieldset id="aanmaken">
            <legend class="ui-hidden-accessible">Aanmeldgegevens</legend>
            {{ Form::label('email', 'E-mailadres', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div class="ui-input-text ui-body-inherit blokje boven">
                {{ Form::email('email', '', [
                'placeholder' => 'E-mailadres',
                'required'  => '',
                'data-enhanced' => 'true',
                ]), PHP_EOL }}
            </div>

            {{ Form::label('password', 'Maak een wachtwoord:', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div class="ui-input-text ui-body-inherit blokje">
                {{ Form::password('password', [
                'placeholder' => 'Maak een wachtwoord',
                'required'  => '',
                'data-enhanced' => 'true',
                ]), PHP_EOL }}
            </div>

            {{ Form::label('password_repeat', 'Wachtwoord opnieuw invoeren:', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div class="ui-input-text ui-body-inherit blokje">
                {{ Form::password('password_repeat', [
                'placeholder' => 'Wachtwoord opnieuw invoeren',
                'required'  => '',
                'data-enhanced' => 'true',
                ]), PHP_EOL }}
            </div>
        </fieldset>

        <fieldset>
            <legend class="ui-hidden-accessible">Personalia</legend>
            {{ Form::label('username', 'Voornaam:', ['class' => 'ui-hidden-accessible']), PHP_EOL }}
            <div class="ui-input-text ui-body-inherit onder blokje">
                {{ Form::text('username', '', [
                'placeholder' => 'Gebruikersnaam',
                'required'  => '',
                'data-enhanced' => 'true',
                ]), PHP_EOL }}
            </div>

        </fieldset>

        <div class="ui-input-btn ui-btn ui-btn-inline ui-btn-b">
            Registreren
            {{ Form::submit('Registreren', [
            'data-enhanced' => 'true'
            ]), PHP_EOL }}
        </div>
        {{ HTML::linkRoute('user.index', 'Terug naar de startpagina', [], [
        'class' => 'ui-btn ui-btn-inline ui-btn-icon-left ui-icon-home',
        'data-ajax' => 'false',
        ]), PHP_EOL }}

        {{ Form::close(), PHP_EOL }}
    </div>
</div>
@stop