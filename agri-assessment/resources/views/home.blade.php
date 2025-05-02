@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-bg py-5 text-center">
        <div class="container">
            <h1 class="display-5 fw-bold">Agricultural Data Insights for India</h1>
            <p class="lead mt-3">
                Comprehensive analysis of land holding patterns, irrigation sources, cropping patterns, and farmer data across different regions of India.
            </p>
            <a href="{{ route('regions.index') }}" class="btn btn-light mt-4">
                <i class="bi bi-map"></i> Explore Regional Map
            </a>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="container my-3 mt-5">
        <h2 class="text-success mb-1">Key Agricultural Statistics</h2>
    </section>
    <hr class="mb-1" style="border-top: 3px solid rgba(0, 128, 0, 0.2);">

    <section class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm card-stat">
                    <div class="card-body">
                        <h6 class="text-muted">Agricultural Land</h6>
                        <h3 class="fw-bold">140.1M Ha</h3>
                        <small class="text-danger">-1.2% from previous year</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm card-stat">
                    <div class="card-body">
                        <h6 class="text-muted">Irrigated Area</h6>
                        <h3 class="fw-bold">68.4M Ha</h3>
                        <small class="text-success">+3.5% from previous year</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm card-stat">
                    <div class="card-body">
                        <h6 class="text-muted">Avg. Land Holding</h6>
                        <h3 class="fw-bold">1.08 Ha</h3>
                        <small class="text-danger">-2.3% from previous year</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm card-stat">
                    <div class="card-body">
                        <h6 class="text-muted">Total Farmers</h6>
                        <h3 class="fw-bold">94.6M</h3>
                        <small class="text-success">+1.9% from previous year</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Categories Section -->
    <section class="container my-3 mt-5">
        <h2 class="text-success mb-1">Explore Data Categories</h2>
    </section>
    <hr class="mb-1" style="border-top: 3px solid rgba(0, 128, 0, 0.2);">

    <section class="container">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-3">
                                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" width="24" alt="Land Icon">
                            </div>
                        </div>
                        <h5 class="card-title">Land Holding Patterns</h5>
                        <p class="card-text text-muted">
                            Analysis of land distribution, average holding sizes, and ownership patterns.
                        </p>
                        <a href="{{ route('landholding.index') }}" class="btn btn-outline-success d-flex justify-content-between align-items-center">
                            Explore
                            <span class="ms-2">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3">
                                <img src="https://cdn-icons-png.flaticon.com/512/728/728093.png" width="24" alt="Irrigation Icon">
                            </div>
                        </div>
                        <h5 class="card-title">Irrigation Sources</h5>
                        <p class="card-text text-muted">
                            Details on irrigation coverage, water sources, and irrigation infrastructure availability.
                        </p>
                        <a href="{{ route('irrigationsources.index') }}" class="btn btn-outline-primary d-flex justify-content-between align-items-center">
                            Explore
                            <span class="ms-2">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="bg-warning bg-opacity-25 rounded-circle d-inline-flex p-3">
                                <img src="https://cdn-icons-png.flaticon.com/512/1075/1075999.png" width="24" alt="Crop Icon">
                            </div>
                        </div>
                        <h5 class="card-title">Cropping Patterns</h5>
                        <p class="card-text text-muted">
                            Insights into seasonal crops, rotation practices, and crop diversity across different states.
                        </p>
                        <a href="{{ route('croppingpatterns.index') }}" class="btn btn-outline-warning d-flex justify-content-between align-items-center">
                            Explore
                            <span class="ms-2">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex p-3">
                                <img src="https://cdn-icons-png.flaticon.com/512/599/599995.png" width="24" alt="Farmer Icon">
                            </div>
                        </div>
                        <h5 class="card-title">Farmer Data</h5>
                        <p class="card-text text-muted">
                            Profiles of farmers including demographics, regions, and landholding details.
                        </p>
                        <a href="{{ route('farmers.index') }}" class="btn btn-outline-info d-flex justify-content-between align-items-center">
                            Explore
                            <span class="ms-2">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>
@endsection
