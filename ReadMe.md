Comment installer le projet:
-dans phpMyAdmin, créer la base de données "pokemons" de type utf8_general_ci
-dans visualStudio, faire php artisan migrate
-puis installer les Seeders : 
php artisan db:seed --class=EnergySeeder
php artisan db:seed --class=EnergiesMasteredSeeder
php artisan db:seed --class=UsersSeeder
php artisan db:seed --class=PokemonTableSeeder
php artisan db:seed --class=TypesCombatSeeder
-faire php artisan serve
-ouvrir le localhost sur le port indiqué
-le jeu est prêt!

Les vidéos d'installation et de présentation du site sont disponibles ici : https://drive.google.com/drive/folders/1xNCvun071I_MoDdW6xoVPFLnXyR9Vkly?usp=sharing

La base de données comporte déjà deux joueurs. Le premier a pour mail oli@namee.bio et pour mot de passe Finn, le second a pour mail finn@namee.bio et pour mot de passe Tank.


