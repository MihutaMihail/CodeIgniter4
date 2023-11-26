# C'est quoi CodeIgniter ?
 
CodeIgniter est un framework écrit en PHP open source créé par EllisLab (une société de logiciels américaine) sortie en février 2006. Son principal objectif est de permettre aux développeurs de créer des site web plus facilement et plus rapidement. En ce moment, on travaille avec la version 4 du CodeIgniter.
 
# Préparer l'environnement
Afin que le site web fonctionne correctement, il y a quelques chose à préparer <br>
### .env & création base de données
Premièrement, il faut configurer le fichier **.env**. Voici la configuration : <br>
![environnement.JPG](./Images_Readme/environnement.JPG) <br>
![bdd.JPG](./Images_Readme/bdd.JPG) <br>
Dans mon cas, ma base de données est appeller **dbTodo**. 
Maintenant qu'on a dit quel base de données CodeIgniter doit utiliser, il faut la créer. On y va dans le terminal et on saisie `` $ mysql -u root -p 
`` pour se connecter (il faut saisir le mot de passe). <br>
Ensuite, on saisie ``$ create database <nom_base_de_données>`` (sans les < >) pour créer la base de données.
### Migration
Avant de faire les migrations, il faut faire un ``$ composer update`` pour récupérer le **vendor** et avoir accès à la création des tables Myth/Auth.<br>
Pour faire les migrations, on saisie dans le terminal ``$ php spark migrate --all`` pour les exécuter et donc créer les tables nécessaires dans la base de données (ici on a les tables du *myth/auth* et la table *task*) <br>
### Seeder
Pour ne pas créer les utilisateurs, groupes, tâches, etc, j'ai créé 3 seeders pour que toutes ces choses soient créées automatiquement. Les seeders doivent être exécuter dans un certain ordre sinon ça ne fonctionne pas. Voici l'ordre : <br>
1) AdminUserSeeder (création d'un admin et de 2 utilisateurs) <br>
2) GroupUser (création d'un groupe admin et d'un groupe utilisateur + association d'un utilisateur dans un groupe) <br>
3) TaskSeeder (création des tâches pour les 2 utilisateurs) <br>
 
Pour avoir accès aux identifiants des utilisateurs et de l'admin, il faut aller dans **app/Database/Seeds/AdminUserSeeder.php**
 
Pour exécuter un seeder on saisie ``$ php spark db:seed nom_seeder``
### Attention
**Les seeders ne vont pas fonctionner si vous avez déjà créer un groupe,utilisateur,etc. Comme les *id* sont en auto_increment, si vous avez créer un groupe,etc, le prochain *id* sera 2 et pas 1. Les seeders ont été créés avec l'idée qu'il n'y a eu aucune modification sur la base de données. Dans le cas où 1 groupe/utilisateur a été créer, pour ne pas recréer une autre base de données, on peut saisir ``alter table nom_table auto_increment = 0;`` pour que le auto_increment recommencera à 0**.<br>
 
# La structure du CodeIgniter
CodeIgniter utilise une structur qui s'appelle **Model View Controller (MVC)**. Le principe est de séparer le code de programme et le code de présentation. <br>
<br>
**Model →** Le **Model** signifie le modèle de données. Avec ceci, on peut consulter les données stockées dans la base de données ou les mettre à jour. Le **Model** propose plusieurs fonctions qui interagir avec la base de données pour éviter de le faire nous-même. <br>
**View →** Le **View** est la partie de l'application qui est présentée aux utilisateurs. Généralement, c'est du HTML dans lequel le contenu est intégré dynamiquement via PHP. On a aussi la possibilité de définir des éléments de la page comme l'en-tête (header) ou le pied de page (footer) <br>
**Controller →** Le **Controller** (contrôleur) sert comme lien entre le modèle, la vue et toute autre ressource qui est utilisé pour générer dynamiquement un site Web. Ce composant prend les demandes entrantes, valide l'entrée et sélectionne la vue souhaitée et transmet le contenu que le modèle de données a chargé à partir d'une base de données. <br>
 
# Code important/utile
### Fichier .env
![bdd.JPG](./Images_Readme/bdd.JPG) <br>
Le fichier **.env** (et pas **env**), est le fichier qui contient le code pour se connecter à la base de données. Dans cet exemple, on se connecte en tant que **root** sur la base de données **dbTodo** sur **localhost**. Il doit être configuré avant de créer la base de données.<br>
![environnement.JPG](./Images_Readme/environnement.JPG) <br>
Dans la phase de développement, c'est important de mettre la valeur de ce paramètre à **development** (**production** par défaut). Ceci va nous permettre de visualiser les erreurs produites par le site web et potentiellement les résoudre. <br>
 
### Fichier app/Config/Routes.php
![routes.JPG](./Images_Readme/routes.JPG) <br>
Ce fichier va nous permettre de configurer les liens URL de notre site web. <br>
![routes2.JPG](./Images_Readme/routes2.JPG) <br>
Premièrement on va définir quel page on va configurer (ici c'est **/pizzas**). Ensuite, on définit le contrôleur avec le fonctionnement désiré. Dans notre exemple, quand on arrive sur la page **/pizzas**, le contrôleur **PizzaController** va appeler la fonctionne **index** qui est ici une page de présentation. Avec les **routes** en combinaison avec **AuthMyth** (une extension qui permet d'avoir des comptes et donc une connexion), on peut définir quels personnes peuvent accéder à cette page. <br>
![filter.JPG](./Images_Readme/filter.JPG) <br>
On peut voir que une fois qu'une personne arrive sur la page **/admin**, on va vérifier avec **filter** si cette personne fait partie du groupe **admin**. S'il ne fait pas partie de ce groupe, son accès sera refusé.
 
### Fichier app/Controllers & Views
Comme son nom l'indique, les **Controllers** vont nous permettre de contrôler ce que chaque URL du site web affiche. Comme on a vu avant, on dans les **Routes** on peut définir le contrôleur utiliser ainsi que sa fonction.<br>
![controller.JPG](./Images_Readme/controller.JPG) <br>
Un contrôleur est composé dans constructeur (**__construct**) ou on définir les données membres (si on veut importer un **Model** il faut le définir en dehors du contrôleur) <br>
![import.JPG](./Images_Readme/import.JPG) <br>
De plus, on peut aussi définir les fonctions qu'on veut que ce contrôler possède. On peut voir que la fonction **index** va récupérer quelques données avec **$data[]** et va afficher la page **Garniture-index.php**. Pour définir les paramètres (dans ce cas on a **$idPizza**), il faut aller dans les **Views** et consulter la page qu'on veut afficher. <br>
![parametre.JPG](./Images_Readme/parametre.JPG) <br>
![routeParametre.JPG](./Images_Readme/routeParametre.JPG) <br>
 
### Fichier app/Database/Migrations & Seeds
Ces 2 dossiers sont utilisés pour créer la base de données et insérer des données. Avec ça, on n'est plus obligé d'aller dans mysql pour créer une table et l'alimenter avec des données. <br>
Dans **/Migrations** on peut créer une base qu'on va créer avec une fonction proposé par **spark**. Ceci est un outil qui propose de nombreuses fonctions. <br>
![migration.JPG](./Images_Readme/migration.JPG) <br>
Dans **/Seeds** on peut ajouter des données dans la base de données qu'on choisit.<br>
![seeder.JPG](./Images_Readme/seeder.JPG)
 
# Composants logiciels à développer
 
## 1. Gérer les tâches
### Objectif 
**•** L'objectif est d'être capable qu'on utilisateur ajoute/modifier/supprime/fait une tâche et aussi réordonner ses propres tâches. 
### Cas Utilisation - Gérer les tâches
![image](https://plantuml.gitlab-static.net/png/U9nLKBrE0p4CtlCKdxe0GoNQYXLLkWeMM2fkOx4IjusQIqwsCo5UXetdw8kHme6e5t_IzsTvhKPYTKWOIk2qSEefCTe-nZoIq83S2EKHTxSkySvW1HBt1qE8mjvYoOwy5K5lCKKbuoeWHNKZ-IFj6O-dJs5vOdqvVVW3wvj3cwhiIHcpRjjlq3fWFpHUCwuxuPQ4BLD0FuOptd1YuvlPERpl5fSX3zIkGSqyfKogvQNgkOIuYon8LqL2C_ohdHmhz-ugvlFxxuvVjFn3AxVc7Dh7t1TDIsZ7)
```plantuml
@startuml model1
scale 1
skinparam nodesep 50
left to right direction
actor Utilisateur as u
package GérerLesTâches{
    usecase "CRUD des tâches \n (Create Read Update Delete)" as UC1
    usecase "Faire une tâche" as UC2
    usecase "Modifier l'ordre des tâches" as UC3
}
u --> UC1
u --> UC2
u --> UC3
@enduml
```
 
### Maquette - Gérer les tâches
![menuTaches.JPG](./Images_Readme/Taches/menuTaches.JPG)
![reordonnerTaches.JPG](./Images_Readme/Taches/reordonnerTaches.JPG)
![nouvelleTache.JPG](./Images_Readme/Taches/nouvelleTache.JPG)
![modifierTache.JPG](./Images_Readme/Taches/modifierTache.JPG)
 
### Enchaînement Textuel - Gérer les tâches 
**•** <i> **Visualer les tâches** </i> <br>
    1. On clique sur **Liste des tâches** dans la barre de navigation.<br>
<br>
**•** <i> **Ajouter une tâche** </i> <br>
    1. On clique sur le **+** bleu en bas de la page. <br>
    2. On décrit la tâche et on met un nombre pour définir son ordre parmi les autres tâches (plus petit le nombre, plus important) et on clique sur **Ajouter +**. <br>
<br>
**•** <i> **Modifier une tâche** </i> <br>
    1. On clique sur le bouton **bleu** de la tâche qu'on veut modifier <br>
    2. On modifier les données qu'on veut et on clique sur **Modifier**. <br>
<br>
**•** <i> **Supprimer une tâche** </i> <br>
    1. On clique sur le bouton **rouge** <br>
<br>
**•** <i> **Faire une tâche** </i> <br>
    1. On clique sur le bouton **gris** pour effectuer la tâche. Une fois que la tâche est faite, une ligne va apparaître à travers le texte de la tâche pour signifier qu'elle est fini. <br>
<br>
**•** <i> **Réordonner les tâches** </i> <br>
    1. On clique sur le bouton **Réordonner** pour afficher la page de réordonnancement. <br>
    2. On change l'ordre des tâches (plus petit = plus important =>plus haut sur la liste des tâches). <br>
<br>
 
## 2. Connexion
### Objectif 
**•** L'objectif est qu'un visiteur ait la possibilité de créer un compte et de se connecter pour pouvoir créer ses tâches. Pour les utilisateurs, il faut leur donner la possibilité de modifier leurs identifiants ou demander un nouveau mot de passe dans le cas d'un oubli.
### Cas Utilisation - Connexion
![image](https://plantuml.gitlab-static.net/png/U9nTKijE0p4ClEShh5uAKblHvm5Lgw9ovTYUa919t1AQnogF5HBmGVsE_XZUPLlOvkJOunbxabLC65As1gnNP2OYIZG4On4FsfKOq8BZGgGIvdV2q2v1yX3q_Ys1qe5aqju9bCa7sEge4-K06A5gSvkaZOvOfryUbDMkBcOK84gK1zmJhBrpzC4idmBuv4WI8q5l7Kv72f0TI6_BHBswSxCUTr7Rqp7edPPOpm4MjMbnaoksiqfRddRBZsJHgLyvvtD5cDaGNf6WnCY8PmStiQyDc3w2pwz6duwtBTUio_Na5K_4N94YQ4KkyHLTYWr9FUA0DIpaFsi67R4px_oAbpi1AvBmJecNBJrRNVtVl-rRY6zHmN1OD7Qn5J3Ae-O2zx1SQYTDLbGK5z1KP6p36UCNP_pi2dz1pPlG3ByAVkWLESKVIFm0rhEzhG00)

```plantuml
@startuml model2
scale 1
skinparam nodesep 50
left to right direction
actor Visiteur as v
actor Utilisateur_Admin as ua
 
package Connexion{
    usecase "Créer un compte" as UC1
    usecase "Vérification mail" as UC2
    usecase "Connexion" as UC3
    usecase "Demander un nouveau mot de passe \n (s'il l'a oublié)" as UC4
    usecase "Modifier ses identifiants \n (mail, nom utilisateur, mot de passe)" as UC5
    usecase "Mail avec jeton pour vérification" as UC6
}
v --> UC1
UC2 .u.> UC1 : <<include>>
v --> UC3
ua --> UC4
UC6 .u.> UC4 : <<include>>
ua --> UC5
ua -l-|> v
@enduml
```
 
### Maquette - Connexion
![creationCompte.JPG](./Images_Readme/Connexion/creationCompte.JPG)
![loginCompte.JPG](./Images_Readme/Connexion/loginCompte.JPG)
![forgotPasswordCompte.JPG](./Images_Readme/Connexion/forgotPasswordCompte.JPG)
![maildev.JPG](./Images_Readme/Connexion/maildev.JPG)
![modifierCompte.JPG](./Images_Readme/Connexion/modifierCompte.JPG) <br>
![menuCompteNonConnecter.JPG](./Images_Readme/Connexion/menuCompteNonConnecter.JPG)
![menuCompte.JPG](./Images_Readme/Connexion/menuCompte.JPG)
 
### Enchaînement Textuel - Connexion 
**Pour tout qui a besoin d'une vérification par mail, il faut saisir dans le terminal ``$ maildev`` pour démarrer le serveur SMTP et reçevoir les mails.** <br>
**•** <i> **Création d'un compte** </i> <br>
    1. On clique sur l'icône **user** pour afficher le menu. <br>
    2. On clique sur **Créer un compte**. <br>
    3. On saisie les informations nécessaires <br>
    4. On y va sur **maildev** pour activer notre compte <br>
<br>
**•** <i> **Connexion sur le site** </i> <br>
    1. On clique sur l'icône **user** pour afficher le menu <br>
    2. On clique sur **Connexion** <br>
    3. On se connecte avec ses identifiants (il faut avoir un compte activé) <br>
<br>
**•** <i> **Demander un nouveau mot de passe** </i> <br>
    1. On clique sur **Mot de passe oublié** dans **Se connecter**.<br>
    2. On saisit l'adresse mail. <br>
    3. On y va sur **maildev** pour réinitialiser notre mot de passe. <br>
    4. On saisit notre nouveau mot de passe. <br>
<br>
**•** <i> **Modifier ses identifiants** </i> <br>
    1. On clique sur l'icône **user** pour afficher le menu <br>
    2. On clique sur **Modifier compte** <br>
    3. On modifie les identifiants nécessaires (adresse mail, nom d'utilisateur, mot de passe). <br>
<br>
## 3. Administration
### Objectif 
**•** L'objectif est que l'administrateur du site vois les tâches de tous les utilisateurs. De plus, il doit être capable de les modifier ou les supprimer.
### Cas Utilisation - Administration
![image](https://plantuml.gitlab-static.net/png/U9nza3iAWa4CXFkS8jWBwe-jADPMedtOZHhS5vji9Lx6gtWnLqN1na1WIFBDG9PgLAt5W35x3WEeey0u1JrBAbGfOkeBvOBp2GG-65h6AiUJePVApYGd86Uvuif7IKYA10Y5t9cE_1wAMgNdvGMmLrDsf8oZlMZhSRLxDcF5qDlkDtTY7JsDTklfBx39NWxo3vZz0jjMIfNuZnZW2eJZyU8Lzr6phnfWoSdt5y43RTLZym00)

```plantuml
@startuml model3
scale 1
skinparam nodesep 50
left to right direction
actor Admin as a
 
package Administration{
    usecase "Visualer toutes les tâches" as UC1
    usecase "Modifier toutes les tâches" as UC2
    usecase "Supprimer toutes les tâches" as UC3
}
a --> UC1
a --> UC2
a --> UC3
@enduml
```
 
### Maquette - Administration
![adminTaches.JPG](./Images_Readme/adminTaches.JPG)
 
### Enchaînement Textuel - Administration 
**Pour accéder à toutes les tâches il faut être connecter en tant qu'admin.**<br>
**•** <i> **Visualiser toutes les tâches** </i> <br>
    1. On clique sur **Liste des tâches - ADMIN**. <br>
<br>
**•** <i> **Modifier toutes les tâches** </i> <br>
    1. On clique sur l'icône **bleu** pour modifier la tâche que l' on veut. <br>
<br>
**•** <i> **Supprimer toutes les tâches** </i> <br>
    1. On clique sur l'icône **rouge** pour supprimer la tâche que l' on veut. <br>
<br>
 
## Diagramme de classe
 ![image](https://plantuml.gitlab-static.net/png/U9p5Lzzhsp0GVlTVSUIf7Gia6trOdvfrRcVMkfkN54efHbZNnDI_aEIjCFg_xomxgHpBRhDbB12CTPzEtvtkFiadKZ6XoZI1DEUOJ1qPiGI1dWznLZ31KiZ88B603nCdmNi5AWSHBrSAU2mmKd6UEU142PCIMAbM8QEn7wmQ3vbIc1OIVZb0lvZ3CNZ-7Fmh-YykBc2sc5-5ddyQk9UkFwz1HSWu5qZUZk5w5fn-dWMtxuwExZQpDAoKA4Asn4mDmbJ-WDaMGXiYWKmX9uPa_JIRktFlqctF_HfubxFW1hwuDt0GyqFdgHtdKkHb8NS8BMCf3hAbF4SYBghK3U9UnomiKAInbEIjOQd7GyqrfiIrV3w3Um1wiRM7jotueGQSNGMkT-wtWOSGk6TkuFgdxdUJt85rLjjhPweHq43OLMcy8c1TGNPJAx-Ra9i9UmjsxS-SfBdROaloPPpjfv6q5LCM9pR3Srew9auTqzijieoYUgsvvzyGkTlfIrMxgIfDndZVP7eh2Ps2xcpVVsqxoZMgHlFKBWnjcz5U-j-h8knB5hNpNQANcD0naej1oYicLyYlMH9J5Rw07UXiV2peq9Al3svJaskMVzl8sj2jP3jdMxgsXRe_3oQv5mNR3A8Jmu1GxwBIXZBlgIygZrlz_Nvo1tKn5xJcprpmi2gUGJTrvrfWXhNL4iPujwIqiRa5OQzNkdYfqghDjILCgTkfbsq8xHm7jFO-5n66LG9gLI9eBzRQytLs2zvZeQiYsYtM3bhuthU5sn5xStYzarMzrDMYc7pOfLeKFfgoDvrCccChpzgfqgDK5rZ9o4Vlt6iSz8ZVvfWWFtssv_OrZ-K_aGhz1gFf2CPY3ACte-xTniGaO_sqIui9v8Qp-ZBHjrGjuAQrDkhz88O67nYNuxuhPnkNZ2rnDBwCIPfdZyCUT5_iu9nWnkdBnlaDw3xCg000)

```plantuml
@startuml model1
scale 1
skinparam nodesep 90
left to right direction
 
class auth_activation_attemps {
    id : INT NOT NULL AUTO_INCREMENT
    ip_address : VARCHAR[255] NOT NULL
    user_agent : VARCHAR[255] NOT NULL
    token : VARCHAR[255]
    created_at : DATETIME NOT NULL
    PRIMARY KEY (id)
}
 
class auth_groups{
    id : INT NOT NULL AUTO_INCREMENT
    name : VARCHAR[255] NOT NULL
    description : VARCHAR[255] NOT NULL
    PRIMARY KEY (id)
}
 
class auth_groups_permissions{
    group_id : int NOT NULL
    permission_id : int NOT NULL
    KEY (group_id,permission_id)
    FOREIGN KEY (group_id) REFERENCES auth_groups(id)
    FOREIGN KEY (permission_id) REFERENCES auth_permissions(id)
}
 
class auth_groups_users{
    group_id : int NOT NULL
    user_id : int NOT NULL
    PRIMARY KEY (group_id,user_id)
    FOREIGN KEY (group_id) REFERENCES auth_groups(id)
    FOREIGN KEY (user_id) REFERENCES users(id)
}
 
class auth_logins {
    id : INT NOT NULL AUTO_INCREMENT
    ip_address : VARCHAR[255]
    email : VARCHAR[255]
    user_id : VARCHAR[255]
    date : DATETIME NOT NULL
    success : TINYINT[1] NOT NULL
    PRIMARY KEY (id)
    KEY (email)
    KEY (user_id)
}
 
class auth_permissions{
    id : int NOT NULL AUTO_INCREMENT
    name : VARCHAR[255] NOT NULL
    description : VARCHAR[255] NOT NULL
    PRIMARY KEY (id)
}
 
class auth_reset_attempts{
    id : int NOT NULL AUTO_INCREMENT
    email : VARCHAR[255] NOT NULL
    ip_address : VARCHAR[255] NOT NULL
    user_agent : VARCHAR[255] NOT NULL
    token : VARCHAR[255] 
    created_at : DATETIME NOT NULL
    PRIMARY KEY (id)
}
 
class auth_tokens{
    id : int NOT NULL AUTO_INCREMENT
    selector : VARCHAR[255] NOT NULL
    hashedValidator : VARCHAR[255] NOT NULL
    user_id : int NOT NULL
    expires : DATETIME NOT NULL
    PRIMARY KEY (id)
    KEY (selector)
    FOREIGN KEY (user_id) REFERENCES users(id)
}
 
class auth_users_permissions{
    user_id : int NOT NULL AUTO_INCREMENT
    permission_id : VARCHAR[255] NOT NULL
    KEY (user_id,permission_id)
    FOREIGN KEY (user_id) REFRENCES users(id)
    FOREIGN KEY (permission) REFERENCES auth_permissions(id)
}
 
class users{
    id : int NOT NULL AUTO_INCREMENT
    email : VARCHAR[255] NOT NULL
    username : VARCHAR[30]  
    password_hash : VARCHAR[255] NOT NULL
    reset_hash : VARCHAR[255]
    reset_at : DATETIME
    reset_expires : DATETIME
    activate_hash : VARCHAR[255]
    status : VARCHAR[255]
    status_message : VARCHAR[255]
    active : TINYINT[1] NOT NULL
    force_pass_reset :  TINYINT[1] NOT NULL
    created_at : DATETIME
    updated_at : DATETIME
    deleted_at : DATETIME
    PRIMARY KEY (id)
    UNIQUE KEY (email)
    UNIQUE KEY (username)
}
class tasks{
    id : int NOT NULL AUTO_INCREMENT
    text : VARCHAR[100]
    done : TINYINT[1]
    order : BIGINT
    created_at : DATETIME NULL
    done_at : DATETIME NULL
    user_id : INT NOT NULL
    FOREIGN KEY (user_id) REFERENCES users(id)
}
 
users "1" -r- "*" auth_groups_users
users "1" -l- "1" auth_users_permissions
users "1" -d- "*" auth_logins
users "1" -r- "*" auth_tokens
users "1" -- "*" tasks
 
auth_groups -u- auth_groups_permissions
auth_groups -l- auth_groups_users
 
auth_permissions -d- auth_groups_permissions 
auth_permissions -d-  auth_users_permissions
 
@enduml
```
