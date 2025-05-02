@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Title Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-geo-alt"></i> Land Holdings</h2>
        <a href="{{ route('landholding.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Add New Landholding
        </a>
    </div>

    <!-- Success or Warning Message -->
    @if(session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    @if($landholdings->isEmpty())
        <div class="alert alert-warning mb-3">No landholding records found.</div>
    @else
        <!-- Cards Layout for Land Holdings -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($landholdings as $land)
                <div class="col">
                    <div class="card shadow-sm border-light">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-person-circle"></i> {{ $land->farmer->name ?? 'N/A' }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-map"></i> {{ $land->region->name ?? 'N/A' }}</h6>

                            <div class="mb-3">
                                <strong>Land Area:</strong> 
                                <span class="fs-5">{{ number_format($land->area, 2) }} Acres</span>
                            </div>

                            <!-- Land Size Category Badge -->
                            <div class="mb-2">
                                <strong>Land Size: </strong>
                                @if($land->area < 2)
                                    <span class="badge bg-warning text-dark">Small</span>
                                @elseif($land->area <= 5)
                                    <span class="badge bg-info text-dark">Medium</span>
                                @else
                                    <span class="badge bg-success">Large</span>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('landholding.edit', $land->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form action="{{ route('landholding.destroy', $land->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this landholding?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Optional Styling Enhancements -->
<style>
    /* Card styling for a modern look */
    .card {
        border-radius: 8px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Badge styles */
    .badge {
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.3em 0.6em;
        border-radius: 12px;
    }

    /* Aligning the action buttons */
    .btn-sm {
        font-size: 0.85rem;
        padding: 0.25rem 0.5rem;
    }

    /* Adjusting the card title and subtitle */
    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
    }

    .card-subtitle {
        font-size: 1rem;
    }

    /* Styling for the card body */
    .card-body {
        padding: 1.5rem;
    }

    .row-cols-1 {
        margin-top: 2rem;
    }
</style>
@endsection
