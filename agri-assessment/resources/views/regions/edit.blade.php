@extends('layouts.app')

@section('content')
    <h4>Edit Region</h4>

    <form method="POST" action="{{ route('regions.update', $region->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Region Name</label>
            <input type="text" name="name" class="form-control" value="{{ $region->name }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
@endsection
