<!DOCTYPE html>
<html>
<head>
    <title>Irrigation Recommendation</title>
</head>
<body>
    <h1>Recommendation for {{$farmerName}} ({{$farmerEmail}})</h1>

    <h2>Selected Crops:</h2>
    <ul>
        @foreach($selectedCrops as $crop)
            <li>{{ $crop }}</li>
        @endforeach
    </ul>

    <h2>Selected Techniques:</h2>
    <ul>
        @foreach($selectedTechniques as $technique)
            <li>{{ $technique }}</li>
        @endforeach
    </ul>

    <p>We hope this helps with your irrigation planning! 🌾</p>
</body>
</html>
