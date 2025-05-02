@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Cropping Pattern</h1>
    <form action="{{ route('croppingpatterns.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Region</label>
            <select name="region_id" class="form-control">
                @foreach($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Farmer</label>
            <select name="farmer_id" class="form-control">
                @foreach($farmers as $farmer)
                    <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Crop Name</label>
            <input type="text" name="crop_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Season</label>
            <input type="text" name="season" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
