@extends('layouts.app')

@section('content')
    <style>
        /* Dark Theme Styles */
        html[data-bs-theme="dark"] {
            background-color: #0d1b0d;
            color: #d2f5d0;
        }

        html[data-bs-theme="dark"] .agri-card {
            background: #1e2b1e;
            border: 1px solid #2e5032;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 8px 16px rgba(0, 255, 0, 0.05);
        }

        html[data-bs-theme="dark"] .agri-table {
            background-color: #1e2b1e;
        }

        html[data-bs-theme="dark"] .agri-table thead {
            background-color: #263d29;
            color: #c1f7c0;
        }

        html[data-bs-theme="dark"] .agri-table tbody {
            color: #d2f5d0;
        }

        html[data-bs-theme="dark"] .agri-table tbody tr {
            border-bottom: 1px solid #2e5032;
        }

        html[data-bs-theme="dark"] .agri-table tbody tr:hover {
            background-color: #2e4d2f;
        }

        html[data-bs-theme="dark"] .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        html[data-bs-theme="dark"] .btn-success:hover {
            background-color: #218838;
        }

        /* Light Theme Styles */
        html[data-bs-theme="light"] {
            background-color: #f8f9fa;
            color: #212529;
        }

        body[data-bs-theme="light"] {
        background-color: #f0f9f4; /* Light greenish background for a fresh, agricultural feel */
        color: #4e5b42; /* Darker green text for readability */
    }

        html[data-bs-theme="light"] .agri-card {
            background: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
        }

        html[data-bs-theme="light"] .agri-table {
            background-color: #ffffff;
        }

        html[data-bs-theme="light"] .agri-table thead {
            background-color: #e9ecef;
            color: #495057;
        }

        html[data-bs-theme="light"] .agri-table tbody {
            color: #495057;
        }

        html[data-bs-theme="light"] .agri-table tbody tr {
            border-bottom: 1px solid #dee2e6;
        }

        html[data-bs-theme="light"] .agri-table tbody tr:hover {
            background-color: #f1f3f5;
        }

        html[data-bs-theme="light"] .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        html[data-bs-theme="light"] .btn-success:hover {
            background-color: #218838;
        }

    </style>

    <div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">
            🌿 Irrigation Techniques & Crops
        </h1>
        <p class="text-muted">Choose sustainable methods for better yields 🌱</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show agri-card" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form for submitting the selected crops and techniques -->
    <form method="POST" action="{{ route('irrigationsources.submit') }}">
        @csrf

        <!-- Farmer Info Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="farmer_name" class="form-label">👨‍🌾 Farmer's Name</label>
                <input type="text" id="farmer_name" name="farmer_name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="farmer_email" class="form-label">📧 Farmer's Email</label>
                <input type="email" id="farmer_email" name="farmer_email" class="form-control" required>
            </div>
        </div>

        <!-- Irrigation Techniques and Crops Table -->
        <div class="table-responsive agri-card">
            <table class="table agri-table align-middle mb-0">
                <thead class="text-center">
                    <tr>
                        <th>Water Needed</th>
                        <th>Technique</th>
                        <th>Crops</th>
                        <th>Description</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- Drip Irrigation -->
                    <tr>
                        <td class="text-center">
                            <span class="badge bg-info">Low</span>
                        </td>
                        <td>
                            <div class="fw-semibold">💧 Drip Irrigation</div>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                <li>🍅 Tomato</li>
                                <li>🍇 Grape</li>
                                <li>🍓 Strawberry</li>
                            </ul>
                        </td>
                        <td>
                            Allows water to drip slowly to the roots, saving water and fertilizer.
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="selected_techniques[]" value="1" class="form-check-input">
                            <input type="hidden" name="selected_crops[1][]" value="1"> <!-- Tomato -->
                            <input type="hidden" name="selected_crops[1][]" value="2"> <!-- Grape -->
                            <input type="hidden" name="selected_crops[1][]" value="3"> <!-- Strawberry -->
                        </td>
                    </tr>

                    <!-- Sprinkler Irrigation -->
                    <tr>
                        <td class="text-center">
                            <span class="badge bg-success">Moderate</span>
                        </td>
                        <td>
                            <div class="fw-semibold">💦 Sprinkler Irrigation</div>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                <li>🌾 Wheat</li>
                                <li>🌽 Corn</li>
                                <li>🌱 Pulses</li>
                            </ul>
                        </td>
                        <td>
                            Sprays water overhead like rainfall using pumps and pipes.
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="selected_techniques[]" value="2" class="form-check-input">
                            <input type="hidden" name="selected_crops[2][]" value="4"> <!-- Wheat -->
                            <input type="hidden" name="selected_crops[2][]" value="5"> <!-- Corn -->
                            <input type="hidden" name="selected_crops[2][]" value="6"> <!-- Pulses -->
                        </td>
                    </tr>

                    <!-- Solar Irrigation -->
                    <tr>
                        <td class="text-center">
                            <span class="badge bg-warning text-dark">Low to Moderate</span>
                        </td>
                        <td>
                            <div class="fw-semibold">☀️ Solar Irrigation</div>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                <li>🥬 Vegetables</li>
                                <li>🍊 Orchards</li>
                                <li>🌾 Rice</li>
                            </ul>
                        </td>
                        <td>
                            Solar-powered pumps draw water, ideal for sustainable farming.
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="selected_techniques[]" value="3" class="form-check-input">
                            <input type="hidden" name="selected_crops[3][]" value="7"> <!-- Vegetables -->
                            <input type="hidden" name="selected_crops[3][]" value="8"> <!-- Orchards -->
                            <input type="hidden" name="selected_crops[3][]" value="9"> <!-- Rice -->
                        </td>
                    </tr>

                    <!-- Surface Irrigation -->
                    <tr>
                        <td class="text-center">
                            <span class="badge bg-danger">High</span>
                        </td>
                        <td>
                            <div class="fw-semibold">🌊 Surface Irrigation</div>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                <li>🌾 Rice</li>
                                <li>🍬 Sugarcane</li>
                                <li>👕 Cotton</li>
                            </ul>
                        </td>
                        <td>
                            Gravity-fed water flow, traditional but water-intensive.
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="selected_techniques[]" value="4" class="form-check-input">
                            <input type="hidden" name="selected_crops[4][]" value="10"> <!-- Rice -->
                            <input type="hidden" name="selected_crops[4][]" value="11"> <!-- Sugarcane -->
                            <input type="hidden" name="selected_crops[4][]" value="12"> <!-- Cotton -->
                        </td>
                    </tr>

                    <!-- Subsurface Irrigation -->
                    <tr>
                        <td class="text-center">
                            <span class="badge bg-secondary">Very Low</span>
                        </td>
                        <td>
                            <div class="fw-semibold">🌱 Subsurface Irrigation</div>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                <li>🥬 Lettuce</li>
                                <li>🥕 Carrot</li>
                                <li>🧅 Onion</li>
                            </ul>
                        </td>
                        <td>
                            Water delivered directly to the root zone beneath soil surface.
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="selected_techniques[]" value="5" class="form-check-input">
                            <input type="hidden" name="selected_crops[5][]" value="13"> <!-- Lettuce -->
                            <input type="hidden" name="selected_crops[5][]" value="14"> <!-- Carrot -->
                            <input type="hidden" name="selected_crops[5][]" value="15"> <!-- Onion -->
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- Submit button -->
        <div class="text-center mt-5">
            <button type="submit" class="btn btn-success btn-lg px-5 py-3 rounded-pill shadow-sm">
                🌻 Submit Selections
            </button>
        </div>
    </form>
</div>

@endsection
