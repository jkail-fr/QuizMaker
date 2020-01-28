# QuizMaker
QuizMaker : conception de quiz

##Etape 1 : SQL - conception DB
créer catégories + questions types
Table question (texte question, réponses, categorieS et niveauX)

##Etape 2 : PHP/SQL - Inteface de création des questions et des categories
Gérer les question et ajouter / supprimer des catégories ou niveaux ([array envoyé a la DB)])

##Etape 3  : PHP - afficher contenu DB
pdo requete sur niveaux + categ

##Etape 4 : JS - Masquer le contenu et gérer les animations et feedbacks

##Etape facultative : JS - Essayer le drag and drop




PROCHAINE SESSION :
0) gérer .gitignore to sqlconnect ;

4) vérifier les failles de sécurité (ce qu'on envoie comme texte dans le bouton "ajouter") ;

5) Partager un schéma de BDD sur github ;

6) créer 2 pages différentes pour les questions :

- une page de gestion des questions avec option de recherche (page autonome qui fait une requête : on choisit parmi une thématique ou un niveau et ça sort toutes les questions associées ; prévoir une barre de recherche).

19) clic de l'utilisateur pour valider chacune de ses réponses ; afficher le résultat (bonne réponse = vert ; mauvaise réponse (si sélectionnée) en rouge) ; donner le feedback ! En JS
Bouton submit à faire pour envoyer les réponses ; comparer les réponses avec la colonne "bonne_reponse" ; renvoyer le résultat et afficher le feedback.
Boucler si la même page ou renvoyer sur une autre ? 

20) afficher les propositions de réponse dans un ordre aléatoire ;-) (pour éviter que qq'un clique toujours sur la 1re réponse)


DONE : 

1) Mettre des "include" partout <=> au fur et à mesure : OK ;

2) création d'un formulaire de création de catégories ;
2bis) Formulaire pour choisir sa catégorie, puis choisir entre un champ "renommer" ou un bouton "supprimer" ;
2ter) Vérifier si la requête s'est bien exécutée (avant de dire qu'elle l'a été) ;

3) dupliquer modèle catégorie pour questions.
3bis) dupliquer modèle catégorie pour niveau.
3ter) lier les questions aux niveaux.

6) création d'une page de création de questions (avec case à cocher pour sélectionner les différentes catégories) ;
6bis) lors de la création des questions, on doit pouvoir attribuer un niveau parmi ceux déjà définis sur la page correspondante (facile, intermediaire, expert) ;
6ter) lors de la création des questions, on doit pouvoir attribuer une ou plusieurs catégories parmi celles déjà définies sur la apge correspondante (divinités, vie quotidienne, etc.) ;

7) créer la page d'affichage du quizz ;

8) Prévoir le cas des questions sans niveau et/ou sans categorie = pas prévu au final ;-) ;

9) Prévoir des boutons de retour à l'accueil... (sur toutes les pages !)

10) Fonction qui va récupérer l'ID de la catégorie qui se trouve dans l'array et qui va trouver le nom de la catégorie associé à l'ID, pour ensuite nous retourner le nom.
10bis) même chose pour les niveaux.

11) chaque bouton "modifier" sera un formulaire avec un bouton "submit" qui va renvoyer à une autre page. Le formulaire aura un champ "hidden" qui contiendra l'ID de la question et quand on va cliquer sur le bouton modifier, cela va balancer l'ID à la page qui va récupérer les données (les afficher) puis les mettre dans un champ texte puis avoir un bouton pour faire l'update et enfin avoir un code qui vérifier si le champ est identique à celui déjà en BDD (pour éviter de charger la page avec des requêtes).

12) le bouton "supprimer" va être un "onsubmit" en Javascript qui va lancer un "delete" si la personne dit "oui".

14) edit_question : Faire même code pour les niveaux.

15) Quand on a les niveaux d'affichés, il faudra faire un bouton submit pour faire en sorte que lorsqu'on clique dessus, cela vérifie les données d'origine avec les nouvelles données et cela ne va update que les données modifiées. Vérifier si + simple de tout modifier (écraser les données) ou non.

17) Ajouter des "required" pour les éléments qui sont obligatoires (le texte de la question, la bonne réponse, le feedback, ...).

18) if isset pour niveau et catégorie ; un if isset catégorie aléatoire ; un if isset rien. 