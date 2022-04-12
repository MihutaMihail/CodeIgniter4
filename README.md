# C'est quoi CodeIgniter ?

CodeIgniter est un framework écrit en PHP open source créer par EllisLab (une société de logiciels américaine) sortie en février 2006. Son principal objectif est de permettre aux développeurs de créer des site web plus facilement et plus rapide. En ce moment, on travaille avec la version 4 du CodeIgniter.

# Préparer l'environnement
Afin que le site web fonctionnne correctement, il y a quelques chose à préparer <br>
### .env & création base de données
Premièrement, il faut configurer le fichier **.env**. Voici la configuration : <br>
![environnement.JPG](./Images_Readme/environnement.JPG) <br>
![bdd.JPG](./Images_Readme/bdd.JPG) <br>
Dans mon cas, ma base de données est appeller **dbTodo**. 
Maintenant qu'on a dit quel base de données CodeIgniter doit utiliser, il faut la créer. On y va dans le terminal et on saisie `` $ mysql -u root -p 
`` pour se connecter (il faut saisir le mot de passe). <br>
Ensuite, on saisie ``$ create database <nom_base_de_données>`` (sans les < >) pour créer la base de données.
### Migration
Pour faire les migrations, on saisie dans le terminal ``$ php spark migrate --all`` pour les exécuter et donc créer les tables nécessaires dans la base de données (ici on a les tables du *myth/auth* et la table *task*) <br>
### Seeder
Pour ne pas créer les utilisateurs, groupes, tâches, etc, j'ai créer 3 seeders pour que toutes ces choses sont créer automatiquement. Les seeders doivent être exécuter dans un certain ordre sinon ça fonctionne pas. Voici l'ordre : <br>
1) UsersAdmin (création d'un admin et de 2 utilisateurs) <br>
2) UsersGroups (création d'un groupe admin et d'un groupe utilisateur + association d'un utilisateur dans un groupe) <br>
3) TaskSeeder (création des tâches pour les 2 utilisateurs) <br>

Pour exécuter un seeder on saisie ``$ php spark db:seed nom_seeder``
### Attention
**Les seeders ne vont pas fonctionner si vous avez créer déjà un groupe,utilisateur,etc. Comme les *id* sont en auto_increment, si vous avez créer un groupe,etc, le prochain *id* sera 2 et pas 1. Les seeders ont été créer avec l'idée qu'il a eu aucune modification sur la base de données. Dans le cas où 1 groupe/utilisateur a été créer, pour ne pas recréer une autre base de données, on peut saisir ``alter table nom_table auto_increment = 0;`` pour que le auto_increment recommencera à 0**.<br>


# La structure du CodeIgniter
CodeIgniter utilise une structur qui s'appelle **Model View Controller (MVC)**. Le principe est de séparer le code de programme et le code de présentation. <br>
<br>
**Model →** Le **Model** signifie le modèle de données. Avec ceci, on peut consulter les données stockées dans la base de données ou les mettre à jour. Le **Model** propose plusieurs fonctions qui intéragir avec la base de données pour éviter de le faire nous même. <br>
**View →** Le **View** est la partie de l'application qui est présentée aux utilisateurs. Généralement, c'est du HTML dans lequel le contenu est intégré dynamiquement via PHP. On a aussi la possibilité de définir des éléments de la page comme l'en-tête (header) ou le pied de page (footet) <br>
**Controller →** Le **Controller** (contrôleur) sert comme lien entre le modèle, la vue et toute autre ressource qui est utilisé pour générer dynamiquement un site Web. Ce composant prend les demandes entrantes, valide l'entrée et sélectionne la vue souhaitée et transmet le contenu que le modèle de données a chargé à partir d'une base de données. <br>

# Code important/utile
### Fichier .env
![bdd.JPG](./Images_Readme/bdd.JPG) <br>
Le fichier **.env** (et pas **env**), est le fichier qui contient le code pour se connecter à la base de données. Dans ce exemple, on se connecte en tant que **root** sur la base de données **dbTodo** sur **localhost**. Il doit être configurer avant de créer la base de données.<br>
![environnement.JPG](./Images_Readme/environnement.JPG) <br>
Dans la phase de développement, c'est important de mettre la valeur de ce paramêtre à **development** (**production** par défaut). Ceci va nous permettre de visualer les erreurs produites par le site web et potentiellement les résoudre. <br>

### Fichier app/Config/Routes.php
![routes.JPG](./Images_Readme/routes.JPG) <br>
Ce fichier va nous permettre de configurer les liens URL de notre site web. <br>
![routes2.JPG](./Images_Readme/routes2.JPG) <br>
Premièrement on va définir quel page on va configurer (ici c'est **/pizzas**). Ensuite, on définit le contrôleur avec la fonctionne désiré. Dans notre exemple, quand on arrive sur la page **/pizzas**, le contrôleur **PizzaController** va appeller la fonctionne **index** qui est ici une page de présentation. Avec les **routes** en combinaison avec **AuthMyth** (une extension qui permet d'avoir des comptes et donc une connexion), on peut définir quels personnes peuvent accèder cette page. <br>
![filter.JPG](./Images_Readme/filter.JPG) <br>
On peut voir que une fois qu'une personne arrive sur la page **/admin**, on va vérifier avec **filter** si cette personne fait partie du groupe **admin**. S'il ne fait pas partie de ce groupe, son accès sera réfuser.

### Fichier app/Controllers & Views
Comme son nom l'indique, les **Controllers** vont nous permettre de contrôler ce que chaque URL du site web affiche. Comme on a vu avant, on dans les **Routes** on peut définir le contrôleur utiliser ainsi que sa fonction.<br>
![controller.JPG](./Images_Readme/controller.JPG) <br>
Un contrôleur est composé dans constructeur (**__construct**) ou on définir les données membres (si on veut importer un **Model** il faut le définir en dehours du contrôleur) <br>
![import.JPG](./Images_Readme/import.JPG) <br>
De plus, on peut aussi définir les fonctions qu'on veut que ce contrôler possède. On peut voir que la fonction **index** va récupérer quelques données avec **$data[]** et va afficher la page **Garniture-index.php**. Pour définir les paramêtres (dans ce cas on a **$idPizza**), il faut aller dans les **Views** et consulter la page qu'on veut afficher. <br>
![parametre.JPG](./Images_Readme/parametre.JPG) <br>
![routeParametre.JPG](./Images_Readme/routeParametre.JPG) <br>

### Fichier app/Database/Migrations & Seeds
Ces 2 dossiers sont utiliser pour créer la base de données et insérer des données. Avec ça, on n'est plus obliger de aller dans mysql pour créer une table et l'alimenter avec des données. <br>
Dans **/Migrations** on peut créer une base qu'on va créer avec une fonction proposé par **spark**. Ceci est un outil qui propose de nombreuses fonctions. <br>
![migration.JPG](./Images_Readme/migration.JPG) <br>
Dans **/Seeds** on peut ajouter des données dans la base de données qu'on choisi.<br>
![seeder.JPG](./Images_Readme/seeder.JPG)

# Composants logiciels à developper

## 1. Gérer les tâches
### Objectif 
**•** L'objectif est d'être capable d'ajouter/modifier/supprimer un tâche. 
### Cas Utilisation - Gérer les colocataires
```plantuml
@startuml model1
scale 1
skinparam nodesep 50
left to right direction
actor Colocataire as c
package GerezLesColocataires{
    usecase "Ajouter une tâche" as UC1
    usecase "Modifier une tâche" as UC2
    usecase "Supprimer une tâche" as UC3
}
c --> UC1
c --> UC2
c --> UC3
@enduml
```

### Maquette - Gérer les tâches

### Enchaînement Textuel - Gérer les tâches 



cas utilisations à faire
1)   gérer les tâches (visualiser, ajouter, modifier, supprimer, finir une tâche)   <br>
2)   réordonnancement (modifier l'ordre d'une tâche, afficher le nouveau ordre)   <br>
3)   connexion (créer un compte => include vérification mail, se connecter, mot de passe oublié )   <br>
4)   adminitration (visualer toutes les tâches, modifier toutes les tâches, supprimer toutes les tâches)   <br>


montre le diagramme de classe → codeigniter4_authmyth + table task





