<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .glass-sidebar { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(16px); }
        .center-card { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .center-card:hover { transform: scale(1.02); shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }
        #map { filter: saturate(1.2) contrast(1.05); }
        .custom-popup .leaflet-popup-content-wrapper { border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
    </style>

    <div class="bg-slate-50 min-h-screen">
        <section class="max-w-[1600px] mx-auto p-4 md:p-8">

            <div class="flex flex-col lg:flex-row h-[88vh] bg-white rounded-[3rem] shadow-2xl shadow-indigo-100 overflow-hidden border border-slate-100">

                <aside class="w-full lg:w-[450px] flex flex-col glass-sidebar z-20 border-r border-slate-50">

                    <div class="p-8 pb-6">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-xl shadow-indigo-200">
                                    <i class="fas fa-church text-white text-lg"></i>
                                </div>
                                <div>
                                    <h1 class="text-2xl font-black text-slate-900 tracking-tight leading-none">Locator</h1>
                                    <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-[0.2em] mt-1">Midweek Service Centers</p>
                                </div>
                            </div>
                        </div>

                        <div class="relative group">
                            <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-600 transition-colors"></i>
                            <input type="text" id="searchInput"
                                   placeholder="Search areas (e.g. Lekki, VI)..."
                                   class="w-full pl-14 pr-6 py-5 bg-slate-100/50 border-2 border-transparent rounded-[1.5rem] focus:ring-0 focus:border-indigo-500/30 focus:bg-white outline-none text-sm font-semibold transition-all text-slate-700 placeholder:text-slate-400">
                        </div>
                    </div>

                    <div id="sidebarContent" class="flex-1 overflow-y-auto px-6 pb-8 no-scrollbar">
                        <div id="resultsList" class="space-y-4">
                            @foreach($centers as $center)
                                <div onclick="showDetails({{ json_encode($center) }})"
                                     class="center-card group p-6 bg-white border border-slate-100 rounded-[2rem] cursor-pointer hover:border-indigo-200 transition-all duration-300">
                                    <div class="flex justify-between items-start mb-3">
                                        <h4 class="font-extrabold text-slate-800 group-hover:text-indigo-600 transition-colors leading-tight pr-4 text-base">
                                            {{ str($center->name)->title() }}
                                        </h4>
                                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-indigo-50 transition-colors">
                                            <i class="fa-solid fa-arrow-right text-[10px] text-slate-300 group-hover:text-indigo-500 transition-transform group-hover:translate-x-0.5"></i>
                                        </div>
                                    </div>
                                    <div class="flex items-center text-slate-400">
                                        <i class="fa-solid fa-location-dot text-[10px] mr-2 text-indigo-400/60"></i>
                                        <p class="text-[12px] font-medium truncate italic">{{ $center->address }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <main class="flex-1 relative bg-slate-100">
                    <div id="map" class="h-full w-full"></div>

                    <div class="absolute bottom-10 right-10 z-[1000] flex flex-col gap-3">
                        <button onclick="map.zoomIn()" class="w-14 h-14 bg-white rounded-2xl shadow-2xl flex items-center justify-center text-slate-600 hover:text-indigo-600 hover:scale-110 transition-all active:scale-95">
                            <i class="fa-solid fa-plus text-lg"></i>
                        </button>
                        <button onclick="map.zoomOut()" class="w-14 h-14 bg-white rounded-2xl shadow-2xl flex items-center justify-center text-slate-600 hover:text-indigo-600 hover:scale-110 transition-all active:scale-95">
                            <i class="fa-solid fa-minus text-lg"></i>
                        </button>
                    </div>
                </main>
            </div>
        </section>
    </div>

    <script>
        // Store the original list HTML for the reset function
        const originalSidebarHTML = document.getElementById('sidebarContent').innerHTML;

        const map = L.map('map', {
            zoomControl: false,
            maxBounds: [[6.3, 3.2], [6.7, 3.8]] // Constrain to Lagos area
        }).setView([6.45, 3.47], 12);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; Christ Embassy'
        }).addTo(map);

        let allMarkers = {};

        const customIcon = L.divIcon({
            html: `<div class="w-10 h-10 bg-indigo-600 rounded-2xl border-4 border-white shadow-2xl flex items-center justify-center text-white transform rotate-45 hover:scale-110 transition-transform">
                     <i class="fa-solid fa-cross text-[12px] -rotate-45"></i>
                   </div>`,
            className: '',
            iconSize: [40, 40],
            iconAnchor: [20, 20]
        });

        const initialCenters = @json($centers);
        initialCenters.forEach(center => {
            const m = L.marker([center.lat, center.lng], { icon: customIcon }).addTo(map);
            m.bindPopup(`<div class="p-2 font-sans text-center"><h5 class="font-bold text-slate-900">${center.name}</h5><p class="text-xs text-slate-500 mt-1">Midweek Center</p></div>`, { className: 'custom-popup' });
            allMarkers[center.id] = m;
        });

        function showDetails(center) {
            const sidebar = document.getElementById('sidebarContent');

            sidebar.innerHTML = `
                <div class="animate-in fade-in slide-in-from-right-8 duration-500">
                    <button onclick="resetToListView()" class="group mb-8 text-slate-400 text-xs font-black flex items-center hover:text-indigo-600 transition-colors tracking-widest">
                        <i class="fas fa-chevron-left mr-2 group-hover:-translate-x-1 transition-transform"></i> BACK TO ALL CENTERS
                    </button>

                    <div class="relative bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-slate-300 overflow-hidden mb-10">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-500/20 rounded-full blur-[80px]"></div>
                        <i class="fa-solid fa-church text-indigo-400 text-4xl mb-6 block"></i>
                        <h2 class="text-2xl font-black leading-tight tracking-tight">${center.name}</h2>
                    </div>

                    <div class="space-y-10 px-4">
                        <div class="flex gap-6">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex-shrink-0 flex items-center justify-center">
                                <i class="fa-solid fa-location-arrow text-indigo-500 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Location Address</p>
                                <p class="text-slate-800 font-bold text-base leading-relaxed">${center.address || 'Address updated locally'}</p>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex-shrink-0 flex items-center justify-center">
                                <i class="fa-solid fa-user-check text-emerald-500 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Pastor in Charge</p>
                                <p class="text-slate-900 font-extrabold text-lg">${center.pastor_in_charge}</p>
                                <p class="text-slate-400 text-xs font-medium mt-1 italic">Contact Person</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 pt-4">
                            ${center.phone_number ? `
                                <a href="tel:${center.phone_number}" class="flex items-center justify-center w-full bg-indigo-600 text-white p-5 rounded-[1.5rem] font-bold shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all hover:-translate-y-1">
                                    <i class="fa-solid fa-phone-volume mr-3"></i> Call Center
                                </a>
                            ` : ''}

                            <a href="https://www.google.com/maps/dir/?api=1&destination=${center.lat},${center.lng}" target="_blank" class="flex items-center justify-center w-full bg-slate-100 text-slate-700 p-5 rounded-[1.5rem] font-bold hover:bg-slate-200 transition-all">
                                <i class="fa-solid fa-diamond-turn-right mr-3"></i> Get Directions
                            </a>
                        </div>
                    </div>
                </div>
            `;

            map.flyTo([center.lat, center.lng], 16, { animate: true, duration: 1.5 });
            allMarkers[center.id].openPopup();
        }

        // Improved Reset Function (No page reload)
        function resetToListView() {
            const sidebar = document.getElementById('sidebarContent');
            sidebar.innerHTML = originalSidebarHTML;

            // Re-attach the search listener since we replaced the HTML
            attachSearchListener();

            map.flyTo([6.45, 3.47], 12, { animate: true, duration: 1.5 });
            map.closePopup();
        }

        function attachSearchListener() {
            document.getElementById('searchInput').addEventListener('input', function(e) {
                const val = e.target.value.toLowerCase();
                document.querySelectorAll('#resultsList > div').forEach(el => {
                    const text = el.innerText.toLowerCase();
                    el.style.display = text.includes(val) ? 'block' : 'none';
                });
            });
        }

        // Initialize listener on load
        attachSearchListener();
    </script>
</x-app-layout>
