<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="{{ asset('assets/images/avatar-1.jpg') }}" alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">StarCode Kh</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <h6 class="dropdown-header">Welcome StarCode Kh!</h6>
            <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
            <a class="dropdown-item" href="auth-lockscreen-basic.html"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a>
            <a class="dropdown-item" href="auth-logout-basic.html"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
        </div>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Dashboards</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link" data-key="t-analytics"> Dashboard Principal</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- GESTION DES UTILISATEURS ET RÔLES -->
                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-users">Gestion des utilisateurs</span></li>

                <!-- Utilisateurs -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarUsers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUsers">
                        <i class="ri-user-line"></i> <span data-key="t-users">Utilisateurs</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarUsers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link" data-key="t-list-users">
                                    <i class="ri-list-check me-2"></i> Liste des utilisateurs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}" class="nav-link" data-key="t-create-user">
                                    <i class="ri-add-circle-line me-2"></i> Ajouter un utilisateur
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Rôles -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarRoles" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarRoles">
                        <i class="ri-shield-user-line"></i> <span data-key="t-roles">Rôles</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarRoles">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link" data-key="t-list-roles">
                                    <i class="ri-list-check me-2"></i> Liste des rôles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles.create') }}" class="nav-link" data-key="t-create-role">
                                    <i class="ri-add-circle-line me-2"></i> Ajouter un rôle
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Permissions -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPermissions" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPermissions">
                        <i class="ri-key-line"></i> <span data-key="t-permissions">Permissions</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPermissions">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}" class="nav-link" data-key="t-list-permissions">
                                    <i class="ri-list-check me-2"></i> Liste des permissions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permissions.create') }}" class="nav-link" data-key="t-create-permission">
                                    <i class="ri-add-circle-line me-2"></i> Ajouter une permission
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- GESTION PÉDAGOGIQUE -->
                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pedagogie">Gestion pédagogique</span></li>

                <!-- Cours d'appui -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCours" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCours">
                        <i class="ri-book-open-line"></i> <span data-key="t-cours">Cours d'appui</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCours">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('coursdappuies.index') }}" class="nav-link" data-key="t-list-cours">
                                    <i class="ri-list-check me-2"></i> Liste des cours
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('coursdappuies.create') }}" class="nav-link" data-key="t-create-cours">
                                    <i class="ri-add-circle-line me-2"></i> Ajouter un cours
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Sites -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSites" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSites">
                        <i class="ri-map-pin-line"></i> <span data-key="t-sites">Sites</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSites">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('sites.index') }}" class="nav-link" data-key="t-list-sites">
                                    <i class="ri-list-check me-2"></i> Liste des sites
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sites.create') }}" class="nav-link" data-key="t-create-site">
                                    <i class="ri-add-circle-line me-2"></i> Ajouter un site
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Classes -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarClasses" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarClasses">
                        <i class="ri-group-line"></i> <span data-key="t-classes">Classes</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarClasses">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('classes.index') }}" class="nav-link" data-key="t-list-classes">
                                    <i class="ri-list-check me-2"></i> Liste des classes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('classes.create') }}" class="nav-link" data-key="t-create-classe">
                                    <i class="ri-add-circle-line me-2"></i> Ajouter une classe
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Groupes -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarGroupes" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarGroupes">
                        <i class="ri-team-line"></i> <span data-key="t-groupes">Groupes</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarGroupes">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('groupes.index') }}" class="nav-link" data-key="t-list-groupes">
                                    <i class="ri-list-check me-2"></i> Liste des groupes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('groupes.create') }}" class="nav-link" data-key="t-create-groupe">
                                    <i class="ri-add-circle-line me-2"></i> Ajouter un groupe
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Élèves -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarEleves" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEleves">
                        <i class="ri-user-smile-line"></i> <span data-key="t-eleves">Eleves</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarEleves">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('eleves.index') }}" class="nav-link" data-key="t-list-eleves">
                                    <i class="ri-list-check me-2"></i> Liste des eleves
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('eleves.create') }}" class="nav-link" data-key="t-create-eleve">
                                    <i class="ri-add-circle-line me-2"></i> Ajouter un eleve
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Documents -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDocuments" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDocuments">
                        <i class="ri-file-chart-line"></i> <span data-key="t-documents">Documents</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDocuments">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('documents.index') }}" class="nav-link" data-key="t-list-documents">
                                    <i class="ri-list-check me-2"></i> Liste des documents
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('documents.create') }}" class="nav-link" data-key="t-create-document">
                                    <i class="ri-add-circle-line me-2"></i> Ajouter un document
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Classe-Matiere-Groupe -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarclasse-matiere-groupe" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarclasse-matiere-groupe">
                        <i class="ri-links-line"></i> <span data-key="t-classe-matiere-groupe">classe matiere groupe</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarclasse-matiere-groupe">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('classe-matiere-groupe.index') }}" class="nav-link" data-key="t-list-associations">
                                    <i class="ri-list-check me-2"></i> Liste des associations classe-matière-groupe
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('classe-matiere-groupe.create') }}" class="nav-link" data-key="t-create-association">
                                    <i class="ri-add-circle-line me-2"></i> Ajouter une association classe-matière-groupe
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>

