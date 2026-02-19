Databáze IndieHub obsahuje dohromady 6 tabulek: 

##Hlavní tabulka games
-ID (int(4))
-title (varchar(100))
-ID_dev (int(4)) N:1 s ID tabulky dev
-releaseyear (year(4))
-description (text)
-img (varchar(100))

##dev
-ID (int(4))
-name (varchar(100))
-country (varchar(100))
-founded/started (year(4))

##users
-ID (int(4))
-firstName (varchar(200))
-lastName (varchar(200))
-email (varchar(200))
-password (varchar(200))

##ratings
-ID (int(8))
-ID_game (int(4)) M:N s ID tabulky games
-ID_users (int(4)) M:N s ID tabulky users
-rating (varchar(100))
-comment (text)
-created (datetime)

##genres
-ID (int(4))
-name (varchar(100))

##genresgames
-ID_game (int(4)) M:N s ID tabulky games
-ID_genre (int(4)) M:N s ID tabulky genres