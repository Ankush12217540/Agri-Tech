@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Land Holding</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('landholding.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="farmer_id" class="form-label">Farmer</label>
            <select name="farmer_id" id="farmer_id" class="form-select" required>
                <option value="">Select Farmer</option>
                @foreach($farmers as $farmer)
                    <option value="{{ $farmer->id }}" {{ old('farmer_id') == $farmer->id ? 'selected' : '' }}>
                        {{ $farmer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="region_id" class="form-label">Region</label>
            <select name="region_id" id="region_id" class="form-select" required>
                <option value="">Select Region</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="area" class="form-label">Area (in acres)</label>
            <input type="number" name="area" id="area" class="form-control" step="0.01" min="0" value="{{ old('area') }}" required>
        </div>

        <div class="mb-3">
            <label for="ownership_type" class="form-label">Ownership Type</label>
            <select name="ownership_type" id="ownership_type" class="form-select" required>
                <option value="">Select Ownership Type</option>
                <option value="Owned" {{ old('ownership_type') == 'Owned' ? 'selected' : '' }}>Owned</option>
                <option value="Leased" {{ old('ownership_type') == 'Leased' ? 'selected' : '' }}>Leased</option>
                <option value="Shared" {{ old('ownership_type') == 'Shared' ? 'selected' : '' }}>Shared</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Land Holding</button>
        <a href="{{ route('landholding.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
