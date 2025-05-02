@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">🗺️ State-wise Agricultural Information</h1>

    <!-- Map container -->
    <div id="indiaMap" style="height: 400px; width: 100%; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.2);"></div>

    <!-- Region Info Card with Fade-in effect -->
    <div id="infoCard" class="card shadow mt-4 d-none" style="transition: opacity 0.5s ease-in-out; border-radius: 15px;">
        <div class="card-body p-4" style="background-color: var(--card-bg, #fff);">
            <!-- Title Section -->
            <h5 id="infoTitle" class="card-title text-primary" style="font-size: 1.75rem; font-weight: bold; color: var(--text-color, #333);">
                <!-- Title will be dynamically inserted here -->
            </h5>

            <!-- Description Section -->
            <p id="infoDescription" class="card-text" style="font-size: 1.15rem; color: var(--text-color, #333); line-height: 1.6;">
                <!-- Description will be dynamically inserted here -->
            </p>

            <!-- Information Breakdown -->
            <h6 class="text-success" style="font-weight: bold; font-size: 1.2rem;">Agricultural Information:</h6>
            <ul id="infoDetailsList" class="list-group list-group-flush" style="font-size: 1rem; padding-left: 0;">
                <!-- Information will be dynamically inserted here -->
            </ul>

            <!-- Inline CSS for Light and Dark Theme Compatibility -->
            <style>
                /* Global styles for light mode */
                :root {
                    --text-color: #333; /* Text color for card body in light */
                    --card-bg: #fff; /* Card background in light */
                    --heading-color: #28a745; /* Green color for heading */
                    --list-bg: #ffffff; /* List background white in light */
                    --list-text-color: #000000; /* List text black in light */
                    --list-border-color: rgba(0, 0, 0, 0.1); /* Light mode border */
                }

                /* Dark mode adjustments */
                @media (prefers-color-scheme: dark) {
                    :root {
                        --text-color: #eaeaea; /* Text color for card body in dark */
                        --card-bg: #333; /* Card background in dark */
                        --heading-color: #28a745;
                        --list-bg: #444; /* List background dark in dark */
                        --list-text-color: #ffffff; /* List text white in dark */
                        --list-border-color: rgba(255, 255, 255, 0.1); /* Dark mode border */
                    }
                }

                /* Card Body Styling */
                .card-body {
                    color: var(--text-color);
                    background-color: var(--card-bg);
                    font-size: 1rem;
                    line-height: 1.6;
                    border-radius: 8px;
                    padding: 20px;
                }

                /* Heading */
                h6.text-success {
                    color: var(--heading-color);
                    font-weight: bold;
                    font-size: 1.4rem;
                    margin-bottom: 1rem;
                }

                /* List Styling */
                #infoDetailsList {
                    list-style: none;
                    font-size: 1rem;
                    margin: 0;
                    padding: 0;
                    background-color: var(--list-bg);
                    color: var(--list-text-color);
                    border-radius: 8px;
                    overflow: hidden;
                }

                /* List items */
                #infoDetailsList li {
                    background-color: var(--list-bg);
                    color: var(--list-text-color);
                    padding: 12px 18px;
                    border-bottom: 1px solid var(--list-border-color);
                }

                /* Last item no border */
                #infoDetailsList li:last-child {
                    border-bottom: none;
                }
            </style>

            <!-- Reset Button Section -->
            <div class="text-center mt-3">
                <button class="btn btn-primary" onclick="window.location.reload();" style="font-weight: bold;">
                    <i class="bi bi-arrow-clockwise"></i> Reset Info
                </button>
            </div>
        </div>
    </div>

</div>

<!-- Leaflet.js CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Initialize the map centered on India
    var map = L.map('indiaMap', {
        zoomControl: false,
        attributionControl: false
    }).setView([22.5937, 78.9629], 5);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 8,
        minZoom: 4,
    }).addTo(map);

    // Data with details for each state
    var stateData = {
    "Punjab": { 
        lat: 30.9, 
        lng: 75.85, 
        description: "Punjab is a major agricultural state contributing significantly to India's GDP.", 
        details: { 
            "No of Farmers": 2000000, 
            "GDP Contribution": "17%", 
            "Main Crops": "Wheat, Rice", 
            "Total Farmland": "5,000,000 acres", 
            "Main Irrigation Source": "Canal Irrigation", 
            "Rainfall": "550mm" 
        }
    },
    "Rajasthan": { 
        lat: 27.02, 
        lng: 74.22, 
        description: "Rajasthan is one of the largest producers of pulses in India.", 
        details: { 
            "No of Farmers": 1500000, 
            "GDP Contribution": "12%", 
            "Main Crops": "Wheat, Barley", 
            "Total Farmland": "8,000,000 acres", 
            "Main Irrigation Source": "Wells and Tube Wells", 
            "Rainfall": "350mm" 
        }
    },
    "Maharashtra": { 
        lat: 19.75, 
        lng: 75.71, 
        description: "Maharashtra plays a major role in India's sugarcane and cotton production.", 
        details: { 
            "No of Farmers": 3000000, 
            "GDP Contribution": "14%", 
            "Main Crops": "Sugarcane, Cotton", 
            "Total Farmland": "6,000,000 acres", 
            "Main Irrigation Source": "Wells and Tube Wells", 
            "Rainfall": "800mm" 
        }
    },
    "Uttar Pradesh": { 
        lat: 27.17, 
        lng: 79.98, 
        description: "Uttar Pradesh is a major producer of sugarcane, rice, and wheat.", 
        details: { 
            "No of Farmers": 2500000, 
            "GDP Contribution": "10%", 
            "Main Crops": "Sugarcane, Rice, Wheat", 
            "Total Farmland": "6,500,000 acres", 
            "Main Irrigation Source": "Canal and Tube Wells", 
            "Rainfall": "900mm" 
        }
    },
    "Karnataka": { 
        lat: 15.3173, 
        lng: 75.7139, 
        description: "Karnataka is one of India's largest producers of coffee and cotton.", 
        details: { 
            "No of Farmers": 1200000, 
            "GDP Contribution": "8%", 
            "Main Crops": "Coffee, Cotton, Maize", 
            "Total Farmland": "5,500,000 acres", 
            "Main Irrigation Source": "River and Canal", 
            "Rainfall": "1200mm" 
        }
    },
    "Gujarat": { 
        lat: 22.2587, 
        lng: 71.1924, 
        description: "Gujarat is a major producer of groundnut and cotton.", 
        details: { 
            "No of Farmers": 1800000, 
            "GDP Contribution": "11%", 
            "Main Crops": "Cotton, Groundnut, Wheat", 
            "Total Farmland": "7,000,000 acres", 
            "Main Irrigation Source": "Canals", 
            "Rainfall": "800mm" 
        }
    },
    "Tamil Nadu": { 
        lat: 11.1276, 
        lng: 78.6569, 
        description: "Tamil Nadu is known for its extensive agriculture, including rice and cotton production.", 
        details: { 
            "No of Farmers": 1400000, 
            "GDP Contribution": "9%", 
            "Main Crops": "Rice, Cotton, Banana", 
            "Total Farmland": "6,800,000 acres", 
            "Main Irrigation Source": "Canals and Tanks", 
            "Rainfall": "1000mm" 
        }
    },
    "Andhra Pradesh": { 
        lat: 15.9129, 
        lng: 79.7400, 
        description: "Andhra Pradesh is a significant producer of rice, groundnut, and tobacco.", 
        details: { 
            "No of Farmers": 2200000, 
            "GDP Contribution": "7%", 
            "Main Crops": "Rice, Groundnut, Tobacco", 
            "Total Farmland": "8,000,000 acres", 
            "Main Irrigation Source": "Canals, River", 
            "Rainfall": "950mm" 
        }
    },
    "West Bengal": { 
        lat: 22.9868, 
        lng: 87.8550, 
        description: "West Bengal is a major producer of rice, jute, and tea.", 
        details: { 
            "No of Farmers": 1900000, 
            "GDP Contribution": "5%", 
            "Main Crops": "Rice, Jute, Tea", 
            "Total Farmland": "7,500,000 acres", 
            "Main Irrigation Source": "Canals and Tube Wells", 
            "Rainfall": "1200mm" 
        }
    },
    "Bihar": { 
        lat: 25.0961, 
        lng: 85.3131, 
        description: "Bihar is an important agricultural state known for its production of rice, wheat, and maize.", 
        details: { 
            "No of Farmers": 1600000, 
            "GDP Contribution": "6%", 
            "Main Crops": "Rice, Wheat, Maize", 
            "Total Farmland": "6,200,000 acres", 
            "Main Irrigation Source": "Tube Wells", 
            "Rainfall": "1100mm" 
        }
    },
    "Odisha": { 
        lat: 20.4625, 
        lng: 85.2985, 
        description: "Odisha is known for its rice, pulses, and oilseeds production.", 
        details: { 
            "No of Farmers": 1300000, 
            "GDP Contribution": "4%", 
            "Main Crops": "Rice, Pulses, Oilseeds", 
            "Total Farmland": "5,800,000 acres", 
            "Main Irrigation Source": "Canals", 
            "Rainfall": "1300mm" 
        }
    },
    "Haryana": { 
        lat: 29.0588, 
        lng: 76.0856, 
        description: "Haryana is a major producer of wheat, rice, and mustard.", 
        details: { 
            "No of Farmers": 1100000, 
            "GDP Contribution": "7%", 
            "Main Crops": "Wheat, Rice, Mustard", 
            "Total Farmland": "5,200,000 acres", 
            "Main Irrigation Source": "Canals", 
            "Rainfall": "600mm" 
        }
    },
    "Kerala": { 
        lat: 10.8505, 
        lng: 76.2711, 
        description: "Kerala is known for its tropical crops, including coconut, rubber, and spices.", 
        details: { 
            "No of Farmers": 1500000, 
            "GDP Contribution": "5%", 
            "Main Crops": "Coconut, Rubber, Spices", 
            "Total Farmland": "3,500,000 acres", 
            "Main Irrigation Source": "Rainwater and Rivers", 
            "Rainfall": "3000mm" 
        }
    },
    "Assam": { 
        lat: 26.2006, 
        lng: 92.9376, 
        description: "Assam is a major tea-producing state, alongside rice and jute.", 
        details: { 
            "No of Farmers": 1200000, 
            "GDP Contribution": "3%", 
            "Main Crops": "Tea, Rice, Jute", 
            "Total Farmland": "4,000,000 acres", 
            "Main Irrigation Source": "Rainwater and Rivers", 
            "Rainfall": "2200mm" 
        }
    },
    "Madhya Pradesh": { 
        lat: 23.4731, 
        lng: 77.9479, 
        description: "Madhya Pradesh is one of the largest producers of soybeans and pulses in India.", 
        details: { 
            "No of Farmers": 1600000, 
            "GDP Contribution": "9%", 
            "Main Crops": "Soybeans, Pulses, Wheat", 
            "Total Farmland": "7,800,000 acres", 
            "Main Irrigation Source": "Canals, Wells", 
            "Rainfall": "1100mm" 
        }
    },
    "Chhattisgarh": { 
        lat: 21.2787, 
        lng: 81.8661, 
        description: "Chhattisgarh is an important state for rice production and also known for its forestry resources.", 
        details: { 
            "No of Farmers": 800000, 
            "GDP Contribution": "4%", 
            "Main Crops": "Rice, Maize, Pulses", 
            "Total Farmland": "4,200,000 acres", 
            "Main Irrigation Source": "Wells and Rivers", 
            "Rainfall": "1200mm" 
        }
    },
    "Jharkhand": { 
        lat: 23.6100, 
        lng: 85.2799, 
        description: "Jharkhand has a significant agriculture sector, including rice, maize, and pulses.", 
        details: { 
            "No of Farmers": 1000000, 
            "GDP Contribution": "3%", 
            "Main Crops": "Rice, Maize, Pulses", 
            "Total Farmland": "4,500,000 acres", 
            "Main Irrigation Source": "Rainwater, Wells", 
            "Rainfall": "1300mm" 
        }
    }
};


    // Add markers
    for (var state in stateData) {
    var data = stateData[state];
    var marker = L.marker([data.lat, data.lng]).addTo(map);

    marker.on('click', function(e) {
        var clickedState = Object.keys(stateData).find(key => 
            stateData[key].lat === e.latlng.lat && stateData[key].lng === e.latlng.lng
        );

        if (clickedState) {
            var stateInfo = stateData[clickedState];

            // Fill card info
            document.getElementById('infoTitle').textContent = clickedState;
            document.getElementById('infoDescription').textContent = stateInfo.description;

            // Clear the existing list and add new items
            var infoDetailsList = document.getElementById('infoDetailsList');
            infoDetailsList.innerHTML = ''; // Clear previous data

            // Populate the details with icons
            for (var key in stateInfo.details) {
                var value = stateInfo.details[key];
                var listItem = document.createElement('li');
                listItem.classList.add('list-group-item');

                // Choose icon based on key
                var icon = '';
                if (key.toLowerCase().includes('farmer')) {
                    icon = '👨‍🌾';
                } else if (key.toLowerCase().includes('gdp')) {
                    icon = '💵';
                } else if (key.toLowerCase().includes('crop')) {
                    icon = '🌾';
                } else if (key.toLowerCase().includes('farmland')) {
                    icon = '🌍';
                } else if (key.toLowerCase().includes('irrigation')) {
                    icon = '💧';
                } else if (key.toLowerCase().includes('rainfall')) {
                    icon = '☔';
                } else {
                    icon = 'ℹ️'; // Default info icon
                }

                listItem.innerHTML = `<span style="font-size: 1.2rem; margin-right: 8px;">${icon}</span><strong>${key}:</strong> ${value}`;
                infoDetailsList.appendChild(listItem);
            }

            // Fade-in the card
            var card = document.getElementById('infoCard');
            card.classList.remove('d-none');
            card.style.opacity = '0'; // Start from 0 opacity
            setTimeout(function() {
                card.style.opacity = '1'; // Fade in
            }, 100); 

            // Zoom in on the marker's state
            map.setView([stateInfo.lat, stateInfo.lng], 6); // Zoom level 6 for better state view
        }
    });
}

});
</script>
@endsection
