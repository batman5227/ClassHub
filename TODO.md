# Classe Controller - Résumé des modifications

## Fichiers créés/modifiés

### 1. app/Models/Classe.php
- Modèle corrigé avec :
  - Relationship `sites()` (BelongsTo) - relation avec Sites
  - Relationship `classeMatiereGroupes()` (HasMany) - relation avec ClasseMatiereGroupe

### 2. app/Http/Controllers/ClasseController.php
- Contrôleur complet avec :
  - Méthodes CRUD : index, create, store, show, edit, update, destroy
  - Méthode `bySite($idSites)` pour filtrer les classes par site
  - Eager loading des relations pour optimiser les requêtes

### 3. app/Http/Requests/StoreClasseRequest.php
- Règles de validation :
  - `nom` : required|string|max:255
  - `idSites` : required|uuid|exists:sites,id

### 4. app/Http/Requests/UpdateClasseRequest.php
- Règles de validation identiques

### 5. app/Http/Controllers/RoleUsersController.php
- Correction des noms de routes (role-users au lieu de role_users)

### 6. app/Http/Controllers/RoleController.php
- Correction des noms de routes (roles.index au lieu de role.index)

### 7. Vues role_users
- Créées : index, create, edit, show avec les noms de champs corrects (idUsers au lieu de idUser)
