@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">✏️ Edit Farmer Details</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('farmers.update', $farmer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Farmer Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Farmer Name</label>
                    <input type="text" name="name" id="name" class="form-control" 
                        value="{{ old('name', $farmer->name) }}" required>
                </div>

                <!-- Region Dropdown -->
                <div class="mb-3">
                    <label for="region_id" class="form-label">Region</label>
                    <select name="region_id" id="region_id" class="form-select" required>
                        <option value="">-- Select Region --</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" 
                                {{ old('region_id', $farmer->region_id) == $region->id ? 'selected' : '' }}>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Land Holding Area -->
                <div class="mb-3">
                    <label for="land_holding" class="form-label">Land Holding Area (in Ha)</label>
                    <input type="number" name="land_holding" id="land_holding" class="form-control" step="0.01"
                        value="{{ old('land_holding', $farmer->landHolding->area ?? '') }}" required>
                </div>

                <!-- Ownership Type -->
                <div class="mb-3">
                    <label for="ownership_type" class="form-label">Ownership Type</label>
                    <input type="text" name="ownership_type" id="ownership_type" class="form-control"
                        value="{{ old('ownership_type', $farmer->landHolding->ownership_type ?? '') }}" required>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Farmer Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="🟢 Active Farmer" {{ old('status', $farmer->status) == '🟢 Active Farmer' ? 'selected' : '' }}>
                            🟢 Active Farmer
                        </option>
                        <option value="🟡 Inactive Farmer" {{ old('status', $farmer->status) == '🟡 Inactive Farmer' ? 'selected' : '' }}>
                            🟡 Inactive Farmer
                        </option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Farmer
                    </button>
                    <a href="{{ route('farmers.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
