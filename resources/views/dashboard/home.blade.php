@extends('layouts.master')
@section('title', 'Dashboard - ClassHub')
@section('content')
    <!-- Page-content -->
    <div class="container-fluid dashboard-cyber page-content-cyber">
        <div class="row">
            <div class="col">
                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1 glow-text">Bonjour !</h4>
                                    <p class="text-muted mb-0">Bienvenue sur votre tableau de bord ClassHub.</p>
                                </div>
                                <div class="mt-3 mt-lg-0">
                                    <a href="{{ route('classes.create') }}" class="btn btn-cyber btn-cyber-primary">
                                        <i class="ri-add-circle-line align-middle me-1"></i> Ajouter une classe
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="stat-card-cyber">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Classes</p>
                                        <h4 class="stat-value-cyber">{{ $stats['totalClasses'] }}</h4>
                                    </div>
                                    <div class="stat-icon-cyber">
                                        <i class="ri-school-line"></i>
                                    </div>
                                </div>
                                <a href="{{ route('classes.index') }}" class="btn btn-cyber btn-cyber-primary btn-sm mt-3">
                                    Voir les classes
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="stat-card-cyber">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Élèves</p>
                                        <h4 class="stat-value-cyber">{{ $stats['totalEleves'] }}</h4>
                                    </div>
                                    <div class="stat-icon-cyber">
                                        <i class="ri-user-3-line"></i>
                                    </div>
                                </div>
                                <a href="{{ route('eleves.index') }}" class="btn btn-cyber btn-cyber-primary btn-sm mt-3">
                                    Voir les élèves
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="stat-card-cyber">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Sites</p>
                                        <h4 class="stat-value-cyber">{{ $stats['totalSites'] }}</h4>
                                    </div>
                                    <div class="stat-icon-cyber">
                                        <i class="ri-map-pin-line"></i>
                                    </div>
                                </div>
                                <a href="{{ route('sites.index') }}" class="btn btn-cyber btn-cyber-primary btn-sm mt-3">
                                    Voir les sites
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="stat-card-cyber">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Matières</p>
                                        <h4 class="stat-value-cyber">{{ $stats['totalMatieres'] }}</h4>
                                    </div>
                                    <div class="stat-icon-cyber">
                                        <i class="ri-book-2-line"></i>
                                    </div>
                                </div>
                                <a href="{{ route('matieres.index') }}" class="btn btn-cyber btn-cyber-primary btn-sm mt-3">
                                    Voir les matières
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row: Groupes, Cours, Documents -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="stat-card-cyber">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Groupes</p>
                                        <h4 class="stat-value-cyber">{{ $stats['totalGroupes'] }}</h4>
                                    </div>
                                    <div class="stat-icon-cyber">
                                        <i class="ri-group-line"></i>
                                    </div>
                                </div>
                                <a href="{{ route('groupes.index') }}" class="btn btn-cyber btn-cyber-primary btn-sm mt-3">
                                    Voir les groupes
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="stat-card-cyber">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Cours</p>
                                        <h4 class="stat-value-cyber">{{ $stats['totalCours'] }}</h4>
                                    </div>
                                    <div class="stat-icon-cyber">
                                        <i class="ri-book-open-line"></i>
                                    </div>
                                </div>
                                <a href="{{ route('cours.index') }}" class="btn btn-cyber btn-cyber-primary btn-sm mt-3">
                                    Voir les cours
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="stat-card-cyber">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Documents</p>
                                        <h4 class="stat-value-cyber">{{ $stats['totalDocuments'] }}</h4>
                                    </div>
                                    <div class="stat-icon-cyber">
                                        <i class="ri-file-line"></i>
                                    </div>
                                </div>
                                <a href="{{ route('documents.index') }}" class="btn btn-cyber btn-cyber-primary btn-sm mt-3">
                                    Voir les documents
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="holo-card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1 glow-text">Statistiques</h4>
                                    <div>
                                        <button type="button" class="btn btn-cyber btn-cyber-primary btn-sm">
                                            ALL
                                        </button>
                                        <button type="button" class="btn btn-cyber btn-cyber-primary btn-sm">
                                            1M
                                        </button>
                                        <button type="button" class="btn btn-cyber btn-cyber-primary btn-sm">
                                            6M
                                        </button>
                                        <button type="button" class="btn btn-cyber btn-cyber-primary btn-sm">
                                            1Y
                                        </button>
                                    </div>
                                </div>

                                <div class="card-header p-0 border-0 bg-transparent">
                                    <div class="row g-0 text-center">
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1 glow-text">{{ $stats['totalClasses'] }}</h5>
                                                <p class="text-muted mb-0">Classes</p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1 glow-text">{{ $stats['totalEleves'] }}</h5>
                                                <p class="text-muted mb-0">Élèves</p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1 glow-text">{{ $stats['totalCours'] }}</h5>
                                                <p class="text-muted mb-0">Cours</p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                <h5 class="mb-1 glow-text-green">{{ $stats['totalSites'] }}</h5>
                                                <p class="text-muted mb-0">Sites</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-0 pb-2">
                                    <div class="w-100">
                                        <div id="customer_impression_charts" data-colors='["--vz-primary", "--vz-success", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="holo-card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1 glow-text">Répartition</h4>
                                </div>
                                <div class="card-body">
                                    <div id="sales-by-locations" data-colors='["--vz-light", "--vz-success", "--vz-primary"]' style="height: 269px" dir="ltr"></div>
                                    <div class="px-2 py-2 mt-1">
                                        <p class="mb-1">Classes <span class="float-end">{{ $stats['totalClasses'] }}</span></p>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: {{ $stats['totalClasses'] > 0 ? 75 : 0 }}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-3 mb-1">Élèves <span class="float-end">{{ $stats['totalEleves'] }}</span></p>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $stats['totalEleves'] > 0 ? 47 : 0 }}%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-3 mb-1">Sites <span class="float-end">{{ $stats['totalSites'] }}</span></p>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {{ $stats['totalSites'] > 0 ? 82 : 0 }}%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Donut Chart Row -->
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="holo-card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1 glow-text">Distribution par Type</h4>
                                </div>
                                <div class="card-body">
                                    <div id="donut-chart" style="height: 280px" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="holo-card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1 glow-text">Proportions</h4>
                                </div>
                                <div class="card-body">
                                    <div id="pie-chart" style="height: 280px" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Data -->
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="holo-card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1 glow-text">Classes Récentes</h4>
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('classes.index') }}" class="btn btn-cyber btn-cyber-primary btn-sm">
                                            Voir tout
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if($recentClasses->isEmpty())
                                        <div class="text-center py-4">
                                            <div class="avatar-sm mx-auto mb-3">
                                                <span class="avatar-title bg-light rounded-circle fs-1">
                                                    <i class="ri-school-line text-muted"></i>
                                                </span>
                                            </div>
                                            <h5 class="text-muted">Aucune classe trouvée</h5>
                                            <p class="text-muted">Commencez par ajouter votre première classe</p>
                                            <a href="{{ route('classes.create') }}" class="btn btn-cyber btn-cyber-primary btn-sm">
                                                <i class="ri-add-line me-1"></i> Ajouter une classe
                                            </a>
                                        </div>
                                    @else
                                        <div class="table-responsive table-card">
                                            <table class="table table-hover table-centered align-middle table-nowrap mb-0 table-cyber">
                                                <tbody>
                                                    @foreach($recentClasses as $classe)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-2 me-2">
                                                                    <i class="ri-school-line text-muted fs-5"></i>
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a href="{{ route('classes.show', $classe->id) }}" class="text-reset glow-text">{{ $classe->nom }}</a></h5>
                                                                    <span class="text-muted">{{ $classe->sites->nom ?? 'N/A' }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-cyber badge-cyber-primary">{{ $classe->sites->localisation ?? '' }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">{{ $classe->created_at->format('d/m/Y') }}</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="holo-card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1 glow-text">Élèves Récents</h4>
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('eleves.index') }}" class="btn btn-cyber btn-cyber-primary btn-sm">
                                            Voir tout
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if($recentEleves->isEmpty())
                                        <div class="text-center py-4">
                                            <div class="avatar-sm mx-auto mb-3">
                                                <span class="avatar-title bg-light rounded-circle fs-1">
                                                    <i class="ri-user-3-line text-muted"></i>
                                                </span>
                                            </div>
                                            <h5 class="text-muted">Aucun élève trouvé</h5>
                                            <p class="text-muted">Commencez par ajouter votre premier élève</p>
                                            <a href="{{ route('eleves.create') }}" class="btn btn-cyber btn-cyber-primary btn-sm">
                                                <i class="ri-add-line me-1"></i> Ajouter un élève
                                            </a>
                                        </div>
                                    @else
                                        <div class="table-responsive table-card">
                                            <table class="table table-hover table-centered align-middle table-nowrap mb-0 table-cyber">
                                                <tbody>
                                                    @foreach($recentEleves as $eleve)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded-circle p-2 me-2">
                                                                    <i class="ri-user-3-line text-muted fs-5"></i>
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a href="{{ route('eleves.show', $eleve->id) }}" class="text-reset glow-text">{{ $eleve->nom }} {{ $eleve->prenom }}</a></h5>
                                                                    <span class="text-muted">{{ $eleve->matricule ?? '' }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">{{ $eleve->created_at->format('d/m/Y') }}</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row">
                        <div class="col-12">
                            <div class="holo-card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0 glow-text">Actions Rapides</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <a href="{{ route('classes.create') }}" class="btn btn-cyber btn-cyber-primary w-100 h-100 p-3">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="ri-school-line fs-2 mb-2"></i>
                                                    <span>Classe</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('eleves.create') }}" class="btn btn-cyber btn-cyber-success w-100 h-100 p-3">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="ri-user-add-line fs-2 mb-2"></i>
                                                    <span>Élève</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('sites.create') }}" class="btn btn-cyber btn-cyber-danger w-100 h-100 p-3">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="ri-map-pin-add-line fs-2 mb-2"></i>
                                                    <span>Site</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('matieres.create') }}" class="btn btn-cyber btn-cyber-primary w-100 h-100 p-3">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="ri-book-add-line fs-2 mb-2"></i>
                                                    <span>Matière</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('cours.create') }}" class="btn btn-cyber btn-cyber-primary w-100 h-100 p-3">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="ri-video-add-line fs-2 mb-2"></i>
                                                    <span>Cours</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('documents.create') }}" class="btn btn-cyber btn-cyber-primary w-100 h-100 p-3">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="ri-file-add-line fs-2 mb-2"></i>
                                                    <span>Document</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @section('script')
        <!-- Dashboard init -->
        <script src="{{ asset('assets/js/dashboard-ecommerce.init.js') }}"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Line + Column Mixed Chart
                function renderMixedChart(elementId, orders, earnings, refunds) {
                    const options = {
                        series: [
                            { name: "Classes", type: "line", data: orders },
                            { name: "Élèves", type: "column", data: earnings },
                            { name: "Cours", type: "line", data: refunds }
                        ],
                        chart: {
                            type: "line",
                            height: 350,
                            toolbar: { show: false },
                            background: 'transparent'
                        },
                        stroke: {
                            width: [3, 0, 3],
                            dashArray: [0, 0, 4]
                        },
                        fill: { opacity: [0.25, 1, 1] },
                        colors: ["#00f5ff", "#9f00ff", "#00ff88"],
                        markers: {
                            size: 3,
                            strokeWidth: 2,
                            colors: ["#00f5ff", "#9f00ff", "#00ff88"]
                        },
                        xaxis: {
                            categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
                            axisTicks: { show: false },
                            axisBorder: { show: false },
                            labels: { style: { colors: '#ffffff' } }
                        },
                        yaxis: {
                            labels: {
                                formatter: val => val.toFixed(0),
                                style: { colors: '#ffffff' }
                            }
                        },
                        tooltip: {
                            shared: true,
                            intersect: false,
                            y: [
                                { formatter: val => val + " Classes" },
                                { formatter: val => val + " Élèves" },
                                { formatter: val => val + " Cours" }
                            ]
                        },
                        legend: {
                            show: true,
                            position: "bottom",
                            horizontalAlign: "center",
                            labels: { colors: '#ffffff' }
                        },
                        grid: {
                            borderColor: 'rgba(255,255,255,0.1)'
                        }
                    };
                    new ApexCharts(document.querySelector("#" + elementId), options).render();
                }

                // Horizontal Bar Chart
                function renderHorizontalBarChart(elementId, data, labels) {
                    const options = {
                        series: [{ name: "Total", data }],
                        chart: {
                            type: "bar",
                            height: 220,
                            toolbar: { show: false },
                            background: 'transparent'
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                borderRadius: 5,
                                barHeight: "55%",
                            }
                        },
                        colors: ["#00f5ff", "#9f00ff", "#00ff88"],
                        xaxis: {
                            categories: labels,
                            labels: { style: { fontSize: "10px", colors: '#ffffff' } }
                        },
                        grid: { show: false },
                        dataLabels: { enabled: false },
                        tooltip: {
                            y: { formatter: val => val }
                        }
                    };
                    new ApexCharts(document.querySelector("#" + elementId), options).render();
                }

                // Donut Chart
                function renderDonutChart(elementId, data, labels, colorsList) {
                    const options = {
                        chart: {
                            type: "donut",
                            height: 280,
                            background: 'transparent'
                        },
                        series: data,
                        labels: labels,
                        colors: colorsList,
                        dataLabels: {
                            enabled: true,
                            formatter: val => val.toFixed(1) + "%",
                            style: {
                                fontSize: "12px",
                                fontWeight: "500",
                                colors: ["#fff"]
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: value => value
                            }
                        },
                        legend: {
                            position: "bottom",
                            labels: { colors: '#ffffff' }
                        },
                        plotOptions: {
                            pie: {
                                donut: { size: "65%" }
                            }
                        }
                    };
                    new ApexCharts(document.querySelector("#" + elementId), options).render();
                }

                // Pie Chart
                function renderPieChart(elementId, data, labels, colorsList) {
                    const options = {
                        chart: {
                            type: "pie",
                            height: 280,
                            background: 'transparent'
                        },
                        series: data,
                        labels: labels,
                        colors: colorsList,
                        dataLabels: {
                            enabled: true,
                            formatter: val => val.toFixed(1) + "%",
                            style: {
                                fontSize: "12px",
                                fontWeight: "500"
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: value => value
                            }
                        },
                        legend: {
                            position: "bottom",
                            labels: { colors: '#ffffff' }
                        }
                    };
                    new ApexCharts(document.querySelector("#" + elementId), options).render();
                }

                // Render Charts
                renderMixedChart(
                    "customer_impression_charts",
                    [{{ $stats['totalClasses'] }}, {{ $stats['totalClasses'] + 2 }}, {{ $stats['totalClasses'] + 5 }}, {{ $stats['totalClasses'] + 3 }}, {{ $stats['totalClasses'] + 8 }}, {{ $stats['totalClasses'] + 4 }}, {{ $stats['totalClasses'] + 6 }}, {{ $stats['totalClasses'] + 7 }}, {{ $stats['totalClasses'] + 10 }}, {{ $stats['totalClasses'] + 5 }}, {{ $stats['totalClasses'] + 9 }}, {{ $stats['totalClasses'] + 12 }}],
                    [{{ $stats['totalEleves'] }}, {{ $stats['totalEleves'] + 5 }}, {{ $stats['totalEleves'] + 10 }}, {{ $stats['totalEleves'] + 8 }}, {{ $stats['totalEleves'] + 15 }}, {{ $stats['totalEleves'] + 12 }}, {{ $stats['totalEleves'] + 18 }}, {{ $stats['totalEleves'] + 20 }}, {{ $stats['totalEleves'] + 25 }}, {{ $stats['totalEleves'] + 22 }}, {{ $stats['totalEleves'] + 28 }}, {{ $stats['totalEleves'] + 30 }}],
                    [{{ $stats['totalCours'] }}, {{ $stats['totalCours'] + 1 }}, {{ $stats['totalCours'] + 2 }}, {{ $stats['totalCours'] + 3 }}, {{ $stats['totalCours'] + 2 }}, {{ $stats['totalCours'] + 4 }}, {{ $stats['totalCours'] + 3 }}, {{ $stats['totalCours'] + 5 }}, {{ $stats['totalCours'] + 4 }}, {{ $stats['totalCours'] + 6 }}, {{ $stats['totalCours'] + 5 }}, {{ $stats['totalCours'] + 7 }}]
                );

                renderHorizontalBarChart(
                    "sales-by-locations",
                    [{{ $stats['totalClasses'] }}, {{ $stats['totalEleves'] }}, {{ $stats['totalSites'] }}],
                    ["Classes", "Élèves", "Sites"]
                );

                // Donut Chart - Distribution
                renderDonutChart(
                    "donut-chart",
                    [{{ $stats['totalClasses'] }}, {{ $stats['totalEleves'] }}, {{ $stats['totalMatieres'] }}, {{ $stats['totalGroupes'] }}, {{ $stats['totalCours'] }}],
                    ["Classes", "Élèves", "Matières", "Groupes", "Cours"],
                    ["#00f5ff", "#9f00ff", "#00ff88", "#ff4757", "#ffc107"]
                );

                // Pie Chart - Proportions
                renderPieChart(
                    "pie-chart",
                    [{{ $stats['totalSites'] }}, {{ $stats['totalDocuments'] }}, {{ $stats['totalGroupes'] }}],
                    ["Sites", "Documents", "Groupes"],
                    ["#00f5ff", "#9f00ff", "#00ff88"]
                );
            });
        </script>
    @endsection
@endsection
