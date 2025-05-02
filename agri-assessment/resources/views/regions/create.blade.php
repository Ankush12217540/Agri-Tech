@extends('layouts.app')

@section('content')
    <h4>Add New Region</h4>

    <form method="POST" action="{{ route('regions.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Region Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
@endsection
