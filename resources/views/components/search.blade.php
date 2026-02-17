<div class="flex h-screen bg-gray-50">
    <div class="w-1/3 p-6 overflow-y-auto shadow-xl bg-white z-10">
        <h1 class="text-2xl font-bold text-blue-900 mb-2">Service Center Finder</h1>
        <p class="text-gray-500 mb-6 text-sm">Find a Christ Embassy Midweek Center near you.</p>

        <div class="relative mb-6">
            <input type="text" id="searchInput" placeholder="Search by area or name..."
                   class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
            <span class="absolute left-3 top-3.5 text-gray-400">
                <i class="fas fa-search"></i>
            </span>
        </div>

        <div id="resultsList" class="space-y-4">
            </div>
    </div>

    <div id="map" class="flex-1"></div>
</div>

<script>
    // Initialize Leaflet Map
    var map = L.map('map').setView([6.45, 3.47], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // Modern Marker Icon
    var churchIcon = L.icon({
        iconUrl: '/icons/church-marker.png',
        iconSize: [38, 45],
    });

    // JavaScript to handle search, AJAX, and Pin dropping would go here.
</script>
