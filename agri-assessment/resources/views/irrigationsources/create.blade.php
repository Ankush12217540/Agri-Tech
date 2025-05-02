@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Add New Irrigation Source</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('irrigationsources.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="region_id">Region</label>
                <select name="region_id" id="region_id" class="form-control" required>
                    <option value="">-- Select Region --</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="farmer_id">Farmer</label>
                <select name="farmer_id" id="farmer_id" class="form-control" required>
                    <option value="">-- Select Farmer --</option>
                    @foreach($farmers as $farmer)
                        <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="source_type">Source Type</label>
                <input type="text" name="source_type" class="form-control" id="source_type" placeholder="e.g., Canal, Dam, Well" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
