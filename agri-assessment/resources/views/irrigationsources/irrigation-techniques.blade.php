@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">💧 Irrigation Techniques Overview</h1>

    <div class="card p-4 shadow-sm">
        <p>Learn about different irrigation techniques, their water requirements, and suitable crops.</p>

        <form action="{{ route('irrigation.techniques.submit') }}" method="POST">
            @csrf

            <!-- Irrigation Techniques -->
            <h3 class="mt-4">Select the irrigation techniques you want to know more about:</h3>
            
            <div class="form-group">
                <label for="techniques">Irrigation Techniques</label>
                <div class="form-check">
                    <input type="checkbox" name="techniques[]" value="Drip Irrigation" class="form-check-input" id="dripIrrigation">
                    <label class="form-check-label" for="dripIrrigation">
                        Drip Irrigation (Water: 4-5 liters/hr, Suitable for: Tomatoes, Peppers, Lettuce)
                    </label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="techniques[]" value="Sprinkler Irrigation" class="form-check-input" id="sprinklerIrrigation">
                    <label class="form-check-label" for="sprinklerIrrigation">
                        Sprinkler Irrigation (Water: 5-8 liters/hr, Suitable for: Wheat, Barley, Rice)
                    </label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="techniques[]" value="Surface Irrigation" class="form-check-input" id="surfaceIrrigation">
                    <label class="form-check-label" for="surfaceIrrigation">
                        Surface Irrigation (Water: 8-12 liters/hr, Suitable for: Corn, Soybeans, Alfalfa)
                    </label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="techniques[]" value="Furrow Irrigation" class="form-check-input" id="furrowIrrigation">
                    <label class="form-check-label" for="furrowIrrigation">
                        Furrow Irrigation (Water: 10-15 liters/hr, Suitable for: Cotton, Potatoes, Melons)
                    </label>
                </div>
            </div>

            <!-- User Information -->
            <h3 class="mt-4">Provide Your Details</h3>
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>
@endsection
