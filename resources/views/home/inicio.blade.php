@extends('layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-body p-5 position-relative">
                    <div class="position-absolute top-0 end-0 opacity-10">
                        <i class="fas fa-running fa-10x text-primary"></i>
                    </div>
                    
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="fw-bold mb-2" style="color: #0d47a1;">
                                Panel Principal
                            </h1>
                            <p class="lead text-muted mb-3">
                                Sistema integral de gestión para administrar deportistas, países y disciplinas deportivas
                            </p>
                            <div class="d-flex gap-2">
                                <span class="badge bg-primary px-3 py-2">
                                    <i class="fas fa-user me-1"></i> {{ Auth::user()->name ?? 'Admin' }}
                                </span>
                                <span class="badge bg-success px-3 py-2">
                                    <i class="fas fa-calendar-alt me-1"></i> 
                                    {{ now()->setTimezone('America/Guayaquil')->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <i class="fas fa-medal fa-4x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">
                                <i class="fas fa-running me-1"></i> Deportistas
                            </span>
                            <h2 class="fw-bold mb-1" style="color: #1976d2;">{{ $totalDeportistas ?? 0 }}</h2>
                            <p class="text-muted mb-0">Atletas registrados</p>
                        </div>
                        <div class="avatar avatar-lg bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('deportistas.index') }}" class="btn btn-outline-primary px-4 rounded-pill w-100">
                            Gestionar Deportistas
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill mb-3">
                                <i class="fas fa-globe-americas me-1"></i> Países
                            </span>
                            <h2 class="fw-bold mb-1" style="color: #2e7d32;">{{ $totalPaises ?? 0 }}</h2>
                            <p class="text-muted mb-0">Nacionalidades registradas</p>
                        </div>
                        <div class="avatar avatar-lg bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-flag fa-2x text-success"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('paises.index') }}" class="btn btn-outline-success px-4 rounded-pill w-100">
                            Gestionar Países
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill mb-3">
                                <i class="fas fa-dumbbell me-1"></i> Disciplinas
                            </span>
                            <h2 class="fw-bold mb-1" style="color: #ff9800;">{{ $totalDisciplinas ?? 0 }}</h2>
                            <p class="text-muted mb-0">Deportes registrados</p>
                        </div>
                        <div class="avatar avatar-lg bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-trophy fa-2x text-warning"></i>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('disciplinas.index') }}" class="btn btn-outline-warning px-4 rounded-pill w-100">
                            Gestionar Disciplinas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hover-lift {
        transition: all 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .action-card {
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }
    .action-card:hover {
        border-color: #1976d2;
        background-color: rgba(25, 118, 210, 0.02);
        transform: translateY(-3px);
    }
    
    .avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .icon-wrapper {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .badge {
        font-weight: 500;
    }
</style>
@endpush