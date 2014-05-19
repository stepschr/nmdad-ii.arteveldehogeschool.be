New Media Design & Development II
=================================
Demoproject met Laravel 4.1

Installatie
-----------
Zorg ervoor dat de HTTP- en Databaseserver opgestart zijn.

0.  Configureer deze domeinnamen in het hosts-bestand van je developmentcomputer:

    127.0.0.1   database.arteveldehogeschool.be
    127.0.0.1   nmdad-ii.arteveldehogeschool.be

    Tip: voor Mac heb je [Gas Mask App](http://www.clockwise.ee/gasmask/) en voor Windows is er
    bijvoorbeeld [HostsMan](http://www.abelhadigital.com/hostsman) om het beheer van het hosts-bestand te
    vergemakkelijken.

    Mac:

        /etc/hosts

    Win:

        %SystemRoot%\system32\drivers\etc\hosts

1.  Open de projectmap met PhpStorm.

2.  Maak de database aan via MySQL Workbench of phpMyAdmin door dit script uit te voeren:

        app/database/create_database_schema.sql

3.  Voeg de PHP-interpreter toe aan het project.

    Mac: PhpStorm -> Preferences... -> PHP

        /Applications/mampstack-5.4.26-2/php/bin

    Win: File -> Settings... -> PHP

        C:\BitNami\wampstack-5.4.26-2\php

4.  Integreer Composer in het project

    Mac: PhpStorm -> Preferences... -> Command Line Tool Support -> + (Add) -> Composer
    Win: File -> Settings... -> Command Line Tool Support -> + (Add) -> Composer

    Gebruik `Visibility: global` zodat je dit voor nieuwe projecten niet meer moet instellen.

    Selecteer het tool en klik op Edit om de Alias te hernoemen naar 'composer'

    Tools -> Run Command...

        composer update

5.  Integreer Artisan in het project

    Mac: PhpStorm -> Preferences... -> Command Line Tool Support -> + (Add) -> Tool based on Symfony Console
    Win: File -> Settings... -> Command Line Tool Support -> + (Add) -> Tool based on Symfony Console

    Tools -> Run Command...

        artisan migrate --seed
