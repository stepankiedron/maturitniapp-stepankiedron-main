# Zadání
## Název práce
Indie hry /IndieHub

## Cíl práce
Webová aplikace s katalogem s vyhledáváním indie her, která bude využívat databázi a umožní registraci uživatelů.- Můj oficiální cíl práce
Cílem aplikace je shrnout moc neznámé / Indie hry do jedné přehledné aplikace. Aplikace je určená pro nadšence do her, které chtějí sdílet své myšlenky o určitých hrách, nebo někoho, kdo hledá co si zahrát dál. 

## Použité technologie
- PHP: PHP pro práci se session a komunikaci s databází.
- Databáze: MariaDB
- Další technologie: HTML, CSS, JavaScript, Apache

## Očekávaný výstup
Výsledkem bude plně funkční webová aplikace napojená na databázi. Aplikace umožní uživatelům prohlížet katalog her, registrovat se a přihlašovat. Přihlášení uživatelé budou moci vkládat hodnocení a komentáře k jednotlivým titulům.

# Návrh řešení

## Popis aplikace
Hlavní stránka dá uživateli vědět, že není internetový obchod, ale pouze katalog. Také na uživatele čeká informativní video, co to jsou indie hry. Stránka katalogu ukazuje všechny tituly s možností filtrace podle žánru hry.
## Funkční požadavky
- [x] Aplikace používá databázi s minimálně 5 tabulkami (včetně users).
- [x] Registrace uživatele pomocí e-mailu a hesla.
- [x] Přihlášení a odhlášení uživatele.
- [x] Nepřihlášený uživatel nemá přístup k chráněným částem aplikace.
- [ ] CRUD nad hlavní entitou podle zadání (např. zakázky/rezervace/produkty…).
- [x] Vstupy jsou validované.
- [ ] Dotazy do databáze jsou přes prepared statements.
- [ ] Výstupy jsou ošetřené proti XSS.
