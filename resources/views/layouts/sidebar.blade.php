<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">ClassHub</div>
        <button class="toggle-btn" id="toggleSidebar" aria-label="Toggle Sidebar">
            <i class="ri-arrow-left-right-line"></i>
        </button>
    </div>

    <ul class="menu">
        <!-- Dashboard -->
        <li class="menu-item" data-label="Dashboard">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <div class="menu-left">
                    <i class="ri-dashboard-line"></i>
                    <span class="menu-text">Dashboard</span>
                </div>
            </a>
        </li>

        <!-- ClasseMatiereGroupe (Relation: Classe + Matiere + Groupe) -->
        <li class="menu-item" data-label="Associations">
            <a href="#" class="menu-link">
                <div class="menu-left">
                    <i class="ri-links-line"></i>
                    <span class="menu-text">Associations</span>
                </div>
                <i class="ri-arrow-down-s-line arrow"></i>
            </a>
            <div class="submenu">
                <a href="{{ route('classe-matiere-groupe.index') }}">Liste des Associations</a>
                <a href="{{ route('classe-matiere-groupe.create') }}">Créer une Association</a>
            </div>
        </li>

        <!-- Élèves -->
        <li class="menu-item" data-label="Élèves">
            <a href="#" class="menu-link">
                <div class="menu-left">
                    <i class="ri-user-smile-line"></i>
                    <span class="menu-text">Élèves</span>
                </div>
                <i class="ri-arrow-down-s-line arrow"></i>
            </a>
            <div class="submenu">
                <a href="{{ route('eleves.index') }}">Liste des Élèves</a>
                <a href="{{ route('eleves.create') }}">Ajouter un Élève</a>
            </div>
        </li>

        <!-- Documents -->
        <li class="menu-item" data-label="Documents">
            <a href="#" class="menu-link">
                <div class="menu-left">
                    <i class="ri-file-chart-line"></i>
                    <span class="menu-text">Documents</span>
                </div>
                <i class="ri-arrow-down-s-line arrow"></i>
            </a>
            <div class="submenu">
                <a href="{{ route('documents.index') }}">Liste des Documents</a>
                <a href="{{ route('documents.create') }}">Ajouter un Document</a>
            </div>
        </li>

    </ul>
</aside>
