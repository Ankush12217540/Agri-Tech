@extends('layouts.app')

@section('content')
    <h4>Region Details</h4>

    <p><strong>ID:</strong> {{ $region->id }}</p>
    <p><strong>Name:</strong> {{ $region->name }}</p>
    <a href="{{ route('regions.index') }}" class="btn btn-secondary">Back</a>
@endsection
