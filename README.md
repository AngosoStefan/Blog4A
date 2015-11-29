Bienvenue sur le Github du Blog de Stefan ANGOSO et Stéphane BALA

Le site est à l'adresse : mdcfever.hol.es


!!! Important : Pour simplifier votre navigation et pouvoir utiliser les CRUD, connectez-vous en tant qu'admin à l'aide des identifiants donnés
dans le mail du 29/11 par angoso@et.esiea.fr nommé "Rendu de projet Blog - ANGOSO-BALA"
!!!


Objectif :
Notre objectif était de créer un blog sur tout ce qui dérive des comics, c'est-à-dire les films et les séries avec leurs acteurs,
les figurines, et même des articles écrits par nos soins, où nos fans peuvent commenter.

Technique :
On a les actions d'affichage, ajout, modification, suppression pour les différents éléments, et donc des tables associées en BDD.

Fonctionnement :
Il est possible de s'inscrire pour poster des commentaires à l'aide de l'onglet Inscription en haut à droite de la page.


Ce qui a été fait :


~~ Les frameworks et autres outils ~~

- Utilisation du framework Symfony
- Utilisation de Twig : html en trois parties, avec héritage : base-layout-"sous-couche"
- Utilisation de Bootstrap : le site est utilisable sur petit écran
- Utilisation de Lightbox pour afficher les images (films, séries et figurines) au centre de l'écran


~~ Les entités ~~

- Base de données MySQL
- Utilisation de l'ORM doctrine pour gérer les entités
- Affichage/Ajout/Suppression/Modification de ces entités grâce aux controlleurs
- Possibilité de filtrer les films, séries, par leur première lettre


~~ Les utilisateurs ~~

- Gestion des utilisateurs et de leurs droits avec FOSuser
- Possibilité de s'inscrire, de mettre sa photo

- Compte anonyme avec la possibilité de voir le contenu
- Compte user (hérite de anonyme) qui peut ajouter des commentaires avec sa photo
- Compte admin (hérite de user) qui peut manipuler les entités

- On a donc une sécurisation des routes accessibles


Bonne visite !