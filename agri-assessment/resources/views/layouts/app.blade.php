<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agri Assessment System</title>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .hero-bg {
            background: linear-gradient(90deg, #1e7c35, #0b74c0);
            color: white;
        }

        .card-stat {
            border-left: 5px solid #198754;
        }

        .text-blue {
            color: blue;
        }

        .nav-hover:hover {
            text-decoration: underline;
        }

        .navbar {
            background-color: white;
        }

        .navbar-nav .nav-link {
            color: #000;
        }

        html[data-bs-theme="dark"] .navbar {
            background-color: #222;
        }

        html[data-bs-theme="dark"] .navbar-nav .nav-link {
            color: #f8f9fa;
        }

        .content {
            color: inherit;
        }

        .theme-icon {
            width: 24px;
            cursor: pointer;
        }

        footer .text-muted {
            color: rgba(0, 0, 0, 0.6) !important;
        }

        html[data-bs-theme="dark"] footer .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        footer a.text-muted:hover {
            color: rgba(0, 0, 0, 0.85) !important;
        }

        html[data-bs-theme="dark"] footer a.text-muted:hover {
            color: rgba(255, 255, 255, 0.85) !important;
        }

        html[data-bs-theme="dark"] footer {
            background-color: #1e1e1e;
            color: #ccc;
        }

        html[data-bs-theme="dark"] footer hr {
            border-color: #444;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-success d-flex align-items-center" href="{{ url('/') }}">
                <img src="https://cdn-icons-png.flaticon.com/512/4149/4149658.png" width="30" class="me-2">
                AgriData<span class="text-blue">Insights</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link nav-hover" href="{{ route('farmers.index') }}">Farmer</a></li>
                    
<li class="nav-item"><a class="nav-link nav-hover" href="{{ route('landholding.index') }}">Land Holdings</a></li>
<li class="nav-item"><a class="nav-link nav-hover" href="{{ route('irrigationsources.index') }}">Irrigation</a></li>
<li class="nav-item"><a class="nav-link nav-hover" href="{{ route('croppingpatterns.index') }}">Cropping Patterns</a></li>

<li class="nav-item"><a class="nav-link nav-hover" href="{{ route('regions.index') }}">Regional Map</a></li>

                    <li class="nav-item">
                        <img id="themeIcon" class="theme-icon ms-3" src="https://cdn-icons-png.flaticon.com/512/979/979585.png" alt="Toggle Theme">
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="content">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-auto border-top pt-4 pb-3" style="font-size: 0.95rem;">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <h5 class="fw-bold text-success d-flex align-items-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/4149/4149658.png" width="24" class="me-2">
                        AgriData<span class="text-blue">Insights</span>
                    </h5>
                    <p class="text-muted">
                        Comprehensive agricultural data insights for policy-making and resource allocation across India.
                    </p>
                </div>
                <div class="col">
                    <h6 class="fw-bold">Data Categories</h6>
                    <ul class="list-unstyled text-muted">
                        <li>Land Holdings</li>
                        <li>Irrigation Sources</li>
                        <li>Cropping Patterns</li>
                        <li>Farmers Data Analysis</li>
                    </ul>
                </div>
                <div class="col">
                    <h6 class="fw-bold">Resources</h6>
                    <ul class="list-unstyled text-muted">
                        <li>Methodology</li>
                        <li>Data Sources</li>
                        <li>Publications</li>
                        <li>API Documentation</li>
                    </ul>
                </div>
                <div class="col">
                    <h6 class="fw-bold">Contact</h6>
                    <p class="text-muted mb-1">Ministry of Agriculture & Farmers Welfare</p>
                    <p class="text-muted mb-1">Krishi Bhavan, New Delhi</p>
                    <p class="text-muted mb-1">contact@agridata.gov.in</p>
                    <p class="text-muted mb-0">+91 11 2338 2629</p>
                </div>
            </div>
            <hr class="my-3">
            <div class="d-flex flex-wrap justify-content-between text-muted small">
                <div>© 2025 AgriDataInsights. All rights reserved.</div>
                <div>
                    <a href="#" class="text-muted me-3">Privacy Policy</a>
                    <a href="#" class="text-muted me-3">Terms of Service</a>
                    <a href="#" class="text-muted">Data Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const html = document.documentElement;
        const themeIcon = document.getElementById('themeIcon');

        const sunIcon = "https://cdn-icons-png.flaticon.com/512/979/979585.png";
        const moonIcon = "https://cdn-icons-png.flaticon.com/512/1146/1146869.png";

        function setTheme(theme) {
            html.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);
            themeIcon.src = theme === 'dark' ? moonIcon : sunIcon;
        }

        // Initial load
        if (localStorage.getItem('theme') === 'dark') {
            setTheme('dark');
        } else {
            setTheme('light');
        }

        // Toggle on icon click
        themeIcon.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            setTheme(newTheme);
        });
    </script>
</body>
</html>
