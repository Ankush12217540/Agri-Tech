@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">👨‍🌾 Farmers Overview</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('farmers.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Add New Farmer
        </a>

        <!-- Basic Statistics Card -->
        <div class="card shadow-sm p-2" style="min-width: 250px;">
            <div class="card-body text-center">
                <h5 class="card-title">Total Farmers</h5>
                <h2 class="text-success">{{ $farmers->count() }}</h2>
            </div>
        </div>
    </div>

    <!-- Search / Filter -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search by Farmer Name..." onkeyup="filterTable()">
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered" id="farmersTable">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Region</th>
                    <th>Land Holding (Ha)</th>
                    <th>Land Size Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($farmers as $farmer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $farmer->name }}</td>
                        <td>{{ $farmer->region->name }}</td>
                        <td>
                            @if($farmer->landHolding)
                                {{ number_format($farmer->landHolding->area, 2) }} Ha
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if($farmer->landHolding)
                                @if($farmer->landHolding->area < 2)
                                    <span class="badge bg-warning text-dark">Small</span>
                                @elseif($farmer->landHolding->area <= 5)
                                    <span class="badge bg-info text-dark">Medium</span>
                                @else
                                    <span class="badge bg-success">Large</span>
                                @endif
                            @else
                                <span class="badge bg-secondary">N/A</span>
                            @endif
                        </td>
                        <td>
                            <!-- Farmer's Status Indicator with Tooltip -->
                            <span class="badge {{ $farmer->status == '🟢 Active Farmer' ? 'bg-success' : 'bg-warning' }}" 
                                  data-bs-toggle="tooltip" title="{{ $farmer->status == '🟢 Active Farmer' ? 'This farmer has complete data' : 'Missing cropping data or land holding' }}">
                                {{ $farmer->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('farmers.edit', $farmer->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('farmers.destroy', $farmer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Search Filter Script -->
<script>
function filterTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("farmersTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) { // start from 1 to skip header
        td = tr[i].getElementsByTagName("td")[1]; // search in 'Name' column
        if (td) {
            txtValue = td.textContent || td.innerText;
            tr[i].style.display = (txtValue.toUpperCase().indexOf(filter) > -1) ? "" : "none";
        }
    }
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});
</script>

@endsection
