# Laravel Beyond

*Dieses Paket ist inspiriert von "[Laravel Beyond CRUD](https://spatie.be/products/laravel-beyond-crud)" von Spatie
und "[Modularising the Monolith](https://www.youtube.com/watch?v=0Rq-yHAwYjQ&t=4129s)" von Ryuta Hamasaki.


Dieses Paket wird Ihnen mit `beyond:make`-Befehlen helfen, auf einfache Weise Klassen innerhalb Ihrer "Laravel Beyond CRUD"
inspirierten Anwendung zu erstellen.
Wir versuchen, die Befehle so nah wie möglich an ihre ursprünglichen `make`-Pendants zu implementieren.

In Version 7 haben wir die Arbeitsweise von Laravel Beyond komplett geändert. Wir ändern jetzt nicht mehr Laravels Standard
Verzeichnisstruktur, stattdessen platzieren wir die DDD-Struktur in einem separaten `modules`-Verzeichnis. Dies gewährleistet
Kompatibilität mit allen anderen (Laravel-bezogenen) Paketen.