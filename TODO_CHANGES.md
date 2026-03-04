# Plan de correction - Eleve, Document, Classe, Matiere, Groupe, ClasseMatiereGroupe

## 1. ELEVE - Attributs: nom, prenom, numParents (sans idClasse)

### Migration
- [x] Ajouter numParents à la migration eleves
- [x] Supprimer email, idClasse, idSites, idCoursDappuie de la migration

### Model
- [x] Mettre à jour $fillable avec: nom, prenom, numParents (sans idClasse)
- [x] Supprimer la relation classe()

### Requests
- [x] StoreelevesRequest: valider nom, prenom, numParents
- [x] UpdateelevesRequest: valider nom, prenom, numParents

### Controller
- [x] Simplifier le controller - plus de relations avec classe, sites, coursdappuie

### Routes
- [x] Supprimer toutes les routes de filtrage

### Views
- [x] create.blade.php: ajouter numParents, supprimer idClasse
- [x] edit.blade.php: ajouter numParents, supprimer idClasse
- [x] index.blade.php: ajouter colonne numParents, supprimer Classe
- [x] show.blade.php: ajouter numParents, supprimer Classe

---

## 2. CLASSE MATIERE GROUPE - Alignement des noms d'attributs

### Views
- [x] create.blade.php: utiliser idClasse, idMatiere, idGroupe
- [x] edit.blade.php: utiliser idClasse, idMatiere, idGroupe
- [x] index.blade.php: déjà correct
- [x] show.blade.php: déjà correct

---

## STATUT: TERMINÉ ✅

