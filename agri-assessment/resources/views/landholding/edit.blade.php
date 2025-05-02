@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Title Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-pencil-square"></i> Edit Landholding</h2>
        <a href="{{ route('landholding.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Form -->
    <div class="card shadow-sm border-light">
        <div class="card-body">
            <form action="{{ route('landholding.update', $landholding->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Farmer Selection -->
                <div class="mb-3">
                    <label for="farmer_id" class="form-label"><strong>Farmer</strong></label>
                    <select name="farmer_id" id="farmer_id" class="form-select" required>
                        <option value="">-- Select Farmer --</option>
                        @foreach($farmers as $farmer)
                            <option value="{{ $farmer->id }}" {{ $landholding->farmer_id == $farmer->id ? 'selected' : '' }}>
                                {{ $farmer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Region Selection -->
                <div class="mb-3">
                    <label for="region_id" class="form-label"><strong>Region</strong></label>
                    <select name="region_id" id="region_id" class="form-select" required>
                        <option value="">-- Select Region --</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ $landholding->region_id == $region->id ? 'selected' : '' }}>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Area Input -->
                <div class="mb-3">
                    <label for="area" class="form-label"><strong>Land Area (in Acres)</strong></label>
                    <input type="number" step="0.01" name="area" id="area" class="form-control" value="{{ old('area', $landholding->area) }}" required>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Landholding
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Optional Styling Enhancements -->
<style>
    /* Form styling */
    .form-label {
        font-weight: 600;
    }

    .form-select, .form-control {
        border-radius: 8px;
    }

    .card {
        border-radius: 8px;
    }

    .card-body {
        padding: 2rem;
    }

    .btn-primary {
        padding: 0.5rem 1.5rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 8px;
    }
</style>
@endsection
