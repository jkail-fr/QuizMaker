# QuizMaker
QuizMaker : conception de quiz

##Etape 1 : SQL - conception DB
créer catégories + questions types
Table Catégorie
Table niveau
Table question (texte question, réponses, categorieS et niveauX)

##Etape 2 : PHP/SQL - Interace de création des questions et des categories
Gérer les question et ajouter / supprimer des catégories ou niveaux ([array envoyé a la DB)])

##Etape 3  : PHP - afficher contenu DB
pdo requete sur niveaux + categ

##Etape 4 : JS - Masquer le contenu et gérer les animations et feedbacks

##Etape facultative : JS - Essayer le drag and drop


PROCHAINE SESSION :
0) gérer .gitignore to sqlconnect ;

1) Mettre des "include" partout ;

2) création d'un formulaire de création de catégories <=> OK ;
2bis) Formulaire pour choisir sa catégorie, puis choisir entre un champ "renommer" ou un bouton "supprimer" (alert js pour valider la suppression).

3) création d'un formulaire de modification de catégories ;

4) dupliquer modèle catégorie pour niveau et questions.
4bis) lier les questions aux niveaux

5) vérifier les failles de sécurité (ce qu'on envoie comme texte dans le bouton "ajouter")