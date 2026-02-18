<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .glass-sidebar { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(16px); }
        .center-card { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .center-card:hover { transform: scale(1.02); shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }
        #map { filter: saturate(1.2) contrast(1.05); min-height: 400px; }
        .custom-popup .leaflet-popup-content-wrapper { border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }

        /* Mobile height adjustments */
        @media (max-width: 1024px) {
            .main-container { height: auto !important; flex-direction: column-reverse !important; }
            .sidebar-area { height: auto !important; width: 100% !important; max-height: none !important; border-r: none; border-t: 1px solid #f1f5f9; }
            .map-area { height: 50vh !important; width: 100% !important; position: sticky; top: 0; z-index: 30; }
        }
    </style>

    <div class="bg-slate-50 min-h-screen">
        <section class="max-w-[1600px] mx-auto p-4 md:p-8">

            <div class="main-container flex flex-col lg:flex-row h-[88vh] bg-white rounded-[2rem] md:rounded-[3rem] shadow-2xl shadow-indigo-100 overflow-hidden border border-slate-100">

                <aside class="sidebar-area w-full lg:w-[450px] flex flex-col glass-sidebar z-20 border-r border-slate-50 overflow-hidden">

                    <div class="p-6 md:p-8 pb-4">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 md:w-12 md:h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-xl shadow-indigo-200">
                                    <i class="fas fa-church text-white text-base md:text-lg"></i>
                                </div>
                                <div>
                                    <h1 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight leading-none">Locator</h1>
                                    <p class="text-[9px] md:text-[10px] font-bold text-indigo-600 uppercase tracking-[0.2em] mt-1">Midweek Centers</p>
                                </div>
                            </div>
                        </div>

                        <div class="relative group">
                            <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-600 transition-colors"></i>
                            <input type="text" id="searchInput"
                                   placeholder="Search areas (e.g. Lekki)..."
                                   class="w-full pl-14 pr-6 py-4 md:py-5 bg-slate-100/50 border-2 border-transparent rounded-[1.25rem] md:rounded-[1.5rem] focus:ring-0 focus:border-indigo-500/30 focus:bg-white outline-none text-sm font-semibold transition-all text-slate-700 placeholder:text-slate-400">
                        </div>
                    </div>

                    <div id="sidebarContent" class="flex-1 overflow-y-auto px-4 md:px-6 pb-8 no-scrollbar">
                        <div id="resultsList" class="space-y-4">
                            @foreach($centers as $center)
                                <div onclick="showDetails({{ json_encode($center) }})"
                                     class="center-card group p-5 md:p-6 bg-white border border-slate-100 rounded-[1.5rem] md:rounded-[2rem] cursor-pointer hover:border-indigo-200 transition-all duration-300">
                                    <div class="flex justify-between items-start mb-3">
                                        <h4 class="font-extrabold text-slate-800 group-hover:text-indigo-600 transition-colors leading-tight pr-4 text-sm md:text-base">
                                            {{ str($center->name)->title() }}
                                        </h4>
                                        <div class="w-8 h-8 rounded-full bg-slate-50 flex-shrink-0 flex items-center justify-center group-hover:bg-indigo-50 transition-colors">
                                            <i class="fa-solid fa-arrow-right text-[10px] text-slate-300 group-hover:text-indigo-500 transition-transform group-hover:translate-x-0.5"></i>
                                        </div>
                                    </div>
                                    <div class="flex items-center text-slate-400">
                                        <i class="fa-solid fa-location-dot text-[10px] mr-2 text-indigo-400/60"></i>
                                        <p class="text-[11px] md:text-[12px] font-medium truncate italic">{{ $center->address }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <main class="map-area flex-1 relative bg-slate-100">
                    <div id="map" class="h-full w-full"></div>

                    <div class="absolute bottom-6 right-6 md:bottom-10 md:right-10 z-[1000] flex flex-col gap-3">
                        <button onclick="map.zoomIn()" class="w-12 h-12 md:w-14 md:h-14 bg-white rounded-2xl shadow-2xl flex items-center justify-center text-slate-600 hover:text-indigo-600 hover:scale-110 transition-all active:scale-95">
                            <i class="fa-solid fa-plus text-base md:text-lg"></i>
                        </button>
                        <button onclick="map.zoomOut()" class="w-12 h-12 md:w-14 md:h-14 bg-white rounded-2xl shadow-2xl flex items-center justify-center text-slate-600 hover:text-indigo-600 hover:scale-110 transition-all active:scale-95">
                            <i class="fa-solid fa-minus text-base md:text-lg"></i>
                        </button>
                    </div>
                </main>
            </div>
        </section>
    </div>

    <script>
        const originalSidebarHTML = document.getElementById('sidebarContent').innerHTML;

        // Initialize Map
        const map = L.map('map', {
            zoomControl: false,
            // Constraints for Lagos
            maxBounds: [[6.2, 3.1], [6.8, 3.9]]
        }).setView([6.45, 3.47], 12);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '© Christ Embassy'
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
                <div id="detailView" class="animate-in fade-in slide-in-from-right-8 duration-500">
                    <button onclick="resetToListView()" class="group mb-6 md:mb-8 text-slate-400 text-[10px] font-black flex items-center hover:text-indigo-600 transition-colors tracking-widest">
                        <i class="fas fa-chevron-left mr-2 group-hover:-translate-x-1 transition-transform"></i> BACK TO ALL CENTERS
                    </button>

                    <div class="relative bg-slate-900 rounded-[2rem] md:rounded-[2.5rem] p-8 md:p-10 text-white shadow-2xl shadow-slate-300 overflow-hidden mb-8 md:mb-10">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-500/20 rounded-full blur-[80px]"></div>
                        <i class="fa-solid fa-church text-indigo-400 text-3xl md:text-4xl mb-4 md:mb-6 block"></i>
                        <h2 class="text-xl md:text-2xl font-black leading-tight tracking-tight">${center.name}</h2>
                    </div>

                    <div class="space-y-8 md:space-y-10 px-2 md:px-4">
                        <div class="flex gap-4 md:gap-6">
                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl bg-indigo-50 flex-shrink-0 flex items-center justify-center">
                                <i class="fa-solid fa-location-arrow text-indigo-500 text-xs md:text-sm"></i>
                            </div>
                            <div>
                                <p class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 md:mb-2">Location Address</p>
                                <p class="text-slate-800 font-bold text-sm md:text-base leading-relaxed">${center.address || 'Address on file'}</p>
                            </div>
                        </div>

                        <div class="flex gap-4 md:gap-6">
                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl bg-emerald-50 flex-shrink-0 flex items-center justify-center">
                                <i class="fa-solid fa-user-check text-emerald-500 text-xs md:text-sm"></i>
                            </div>
                            <div>
                                <p class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 md:mb-2">Pastor in Charge</p>
                                <p class="text-slate-900 font-extrabold text-base md:text-lg">${center.pastor_in_charge}</p>
                                <p class="text-slate-400 text-[10px] md:text-xs font-medium mt-1 italic">Contact Person</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 pt-4 pb-10">
                            ${center.phone_number ? `
                                <a href="tel:${center.phone_number}" class="flex items-center justify-center w-full bg-indigo-600 text-white p-4 md:p-5 rounded-[1.25rem] md:rounded-[1.5rem] font-bold shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-95">
                                    <i class="fa-solid fa-phone-volume mr-3"></i> Call Center
                                </a>
                            ` : ''}

                            <a href="https://www.google.com/maps/dir/?api=1&destination=${center.lat},${center.lng}" target="_blank" class="flex items-center justify-center w-full bg-slate-100 text-slate-700 p-4 md:p-5 rounded-[1.25rem] md:rounded-[1.5rem] font-bold hover:bg-slate-200 transition-all active:scale-95">
                                <i class="fa-solid fa-diamond-turn-right mr-3"></i> Get Directions
                            </a>
                        </div>
                    </div>
                </div>
            `;

            // Mobile specific: Scroll the detail view into focus
            if (window.innerWidth < 1024) {
                document.getElementById('detailView').scrollIntoView({ behavior: 'smooth' });
            }

            map.flyTo([center.lat, center.lng], 16, { animate: true, duration: 1.5 });
            allMarkers[center.id].openPopup();
        }

        function resetToListView() {
            const sidebar = document.getElementById('sidebarContent');
            sidebar.innerHTML = originalSidebarHTML;

            attachSearchListener();

            // Reset Map View
            map.flyTo([6.45, 3.47], 12, { animate: true, duration: 1.5 });
            map.closePopup();

            // Mobile specific: Scroll back to top of search
            if (window.innerWidth < 1024) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        function attachSearchListener() {
            const input = document.getElementById('searchInput');
            if(input) {
                input.addEventListener('input', function(e) {
                    const val = e.target.value.toLowerCase();
                    document.querySelectorAll('#resultsList > div').forEach(el => {
                        const text = el.innerText.toLowerCase();
                        el.style.display = text.includes(val) ? 'block' : 'none';
                    });
                });
            }
        }

        attachSearchListener();
    </script>
</x-app-layout>
