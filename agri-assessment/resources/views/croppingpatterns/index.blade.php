@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-success">🌱 Cropping Patterns Overview</h1>
        <a href="{{ route('croppingpatterns.create') }}" class="btn btn-outline-success rounded-4">
            <i class="bi bi-plus-circle"></i> Add New Pattern
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('croppingpatterns.index') }}" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control rounded-4" placeholder="🔍 Search by Crop or Farmer..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="season" class="form-select rounded-4">
                        <option value="">🌦️ Filter by Season</option>
                        <option value="kharif" {{ request('season') == 'kharif' ? 'selected' : '' }}>Kharif</option>
                        <option value="rabi" {{ request('season') == 'rabi' ? 'selected' : '' }}>Rabi</option>
                        <option value="zaid" {{ request('season') == 'zaid' ? 'selected' : '' }}>Zaid</option>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-success rounded-4">
                        <i class="bi bi-funnel-fill"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cropping Patterns Cards Grid -->
    <div class="row g-4">
        @forelse($patterns as $pattern)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 h-100 card-hover cropping-card">
                    <div class="card-body d-flex flex-column justify-content-between">
                        
                        <!-- Region Name -->
                        <h5 class="card-title fw-bold mb-3 text-success">
                            <i class="bi bi-geo-alt-fill"></i> {{ $pattern->region->name }}
                        </h5>

                        <!-- Farmer and Crop -->
                        <p class="card-text mb-2 text-body">
                            <i class="bi bi-person-fill"></i> <strong>Farmer:</strong> {{ $pattern->farmer->name }}
                        </p>
                        <p class="card-text mb-2 text-body">
                            <i class="bi bi-seedling"></i> <strong>Crop:</strong> {{ $pattern->crop_name }}
                        </p>

                        <!-- Season Badge -->
                        <div>
                            <span class="badge 
                                {{ strtolower($pattern->season) == 'kharif' ? 'bg-success' : (strtolower($pattern->season) == 'rabi' ? 'bg-primary' : 'bg-warning text-dark') }} 
                                rounded-pill px-3 py-2">
                                🌾 {{ ucfirst($pattern->season) }} Season
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p class="mt-5">No cropping patterns found matching your search criteria.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $patterns->withQueryString()->links() }}
    </div>
    
</div>

<!-- Custom Styles -->
<style>
    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Keep the light green background */
    .cropping-card {
        background: linear-gradient(to bottom right, #e9f7ef, #d4efdf);
    }

    /* In dark mode, only adjust text color */
    @media (prefers-color-scheme: dark) {
        .cropping-card {
            background: linear-gradient(to bottom right, #e9f7ef, #d4efdf); /* Same light background */
        }
        .cropping-card .card-title,
        .cropping-card .card-text,
        .cropping-card .badge {
            color: #0c3c26 !important; /* Dark green text color for dark mode */
        }
    }
</style>

@endsection
