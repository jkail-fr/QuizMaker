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

1) Mettre des "include" partout <=> au fur et à mesure : OK ;

3) dupliquer modèle catégorie pour questions.
3ter) lier les questions aux niveaux

4) vérifier les failles de sécurité (ce qu'on envoie comme texte dans le bouton "ajouter")

5) Partager un schéma de BDD sur github




DONE : 

2) création d'un formulaire de création de catégories ;
2bis) Formulaire pour choisir sa catégorie, puis choisir entre un champ "renommer" ou un bouton "supprimer" ;
2ter) Vérifier si la requête s'est bien exécutée (avant de dire qu'elle l'a été) ;

3bis) dupliquer modèle catégorie pour niveau.