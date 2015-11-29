Bienvenue sur le Github du Blog de Stefan ANGOSO et St�phane BALA

Le site est � l'adresse : mdcfever.hol.es


!!! Important : Pour simplifier votre navigation et pouvoir utiliser les CRUD, connectez-vous en tant qu'admin � l'aide des identifiants donn�s
dans le mail du 29/11 par angoso@et.esiea.fr nomm� "Rendu de projet Blog - ANGOSO-BALA"
!!!


Objectif :
Notre objectif �tait de cr�er un blog sur tout ce qui d�rive des comics, c'est-�-dire les films et les s�ries avec leurs acteurs,
les figurines, et m�me des articles �crits par nos soins, o� nos fans peuvent commenter.

Technique :
On a les actions d'affichage, ajout, modification, suppression pour les diff�rents �l�ments, et donc des tables associ�es en BDD.

Fonctionnement :
Il est possible de s'inscrire pour poster des commentaires � l'aide de l'onglet Inscription en haut � droite de la page.


Ce qui a �t� fait :


~~ Les frameworks et autres outils ~~

- Utilisation du framework Symfony
- Utilisation de Twig : html en trois parties, avec h�ritage : base-layout-"sous-couche"
- Utilisation de Bootstrap : le site est utilisable sur petit �cran
- Utilisation de Lightbox pour afficher les images (films, s�ries et figurines) au centre de l'�cran


~~ Les entit�s ~~

- Base de donn�es MySQL
- Utilisation de l'ORM doctrine pour g�rer les entit�s
- Affichage/Ajout/Suppression/Modification de ces entit�s gr�ce aux controlleurs
- Possibilit� de filtrer les films, s�ries, par leur premi�re lettre


~~ Les utilisateurs ~~

- Gestion des utilisateurs et de leurs droits avec FOSuser
- Possibilit� de s'inscrire, de mettre sa photo

- Compte anonyme avec la possibilit� de voir le contenu
- Compte user (h�rite de anonyme) qui peut ajouter des commentaires avec sa photo
- Compte admin (h�rite de user) qui peut manipuler les entit�s

- On a donc une s�curisation des routes accessibles


Bonne visite !