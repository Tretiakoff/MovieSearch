MovieSearch
===========

Sur la base du modèle existant, proposer un moteur de recherche en ajax parmis les films.  

Champs de recherche
-------------------

- Titre : champs libre : les films doivent contenir la chaîne demandée  
- Durée : SELECT 
- Année : les films doivent être sortis après "Entre" et avant "et"

Si un champs est omis, il ne doit pas en être tenu compte dans la recherche


Barême
------
- La recherche s'effectue en Ajax au clic : 2 pts 
- La réponse tient compte des champs remplis : 2pts x 4
- La réponse ne tient pas compte des champs vides : 2pts
- Rajouter le prénom/nom du réalisateur dans une colonne du chams de recherche : 2pts
- Rajouter un champs de recherche libre unique pour trouver par réalisateur : 4pts
- Chercher par le genre du réalisateur : 2pts

- Bonus : paginer à 10 résultats par page (toujours en AJAX) : 5pts


Contraintes
-----------
- Les identifiants de BDD doivent se trouver à part : sinon, -5
- Les films peuvent contenir des emojis : sinon, -3