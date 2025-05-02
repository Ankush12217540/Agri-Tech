@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Add New Farmer</h1>

        <!-- Display Validation Errors -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('farmers.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Farmer Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    required
                >
            </div>

            <div class="form-group mt-3">
                <label for="region_id">Region</label>
                <select name="region_id" id="region_id" class="form-control" required>
                    <option value="">Select Region</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Land Holding Input -->
            <div class="form-group mt-3">
                <label for="land_holding">Land Holding Area (Ha)</label>
                <input
                    type="number"
                    name="land_holding"
                    id="land_holding"
                    class="form-control"
                    value="{{ old('land_holding') }}"
                    step="0.01"
                    required
                >
            </div>

            <!-- Ownership Type Input -->
            <div class="form-group mt-3">
                <label for="ownership_type">Ownership Type</label>
                <select name="ownership_type" id="ownership_type" class="form-control" required>
                    <option value="">Select Ownership Type</option>
                    <option value="private" {{ old('ownership_type') == 'private' ? 'selected' : '' }}>Private</option>
                    <option value="public" {{ old('ownership_type') == 'public' ? 'selected' : '' }}>Public</option>
                    <option value="leased" {{ old('ownership_type') == 'leased' ? 'selected' : '' }}>Leased</option>
                </select>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-check-circle"></i> Save
                </button>
            </div>
        </form>
    </div>
@endsection
