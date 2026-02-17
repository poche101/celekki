<x-app-layout>
    <script src="https://unpkg.com/lucide@latest"></script>

    <div x-data="churchEvents()" class="min-h-screen bg-slate-50 pb-20">
        <div class="relative h-[280px] w-full overflow-hidden flex items-end p-8 bg-blue-900">
            <img src="https://images.unsplash.com/photo-1544427920-c49ccfb85579?q=80&w=1200"
                 class="absolute inset-0 w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900 via-blue-900/40 to-transparent"></div>
            <div class="relative z-10">
                <h1 class="text-5xl font-black text-white leading-tight tracking-tighter">CHURCH<br>EVENTS</h1>
                <div class="flex gap-1.5 mt-4">
                    <div class="w-12 h-1.5 bg-orange-400 rounded-full"></div>
                    <div class="w-4 h-1.5 bg-orange-400 rounded-full"></div>
                </div>
            </div>
        </div>

        <div class="px-6 py-8 flex justify-between items-end">
            <div>
                <h2 class="text-2xl font-black text-slate-900">Upcoming Moments</h2>
                <p class="text-slate-500 text-sm font-medium">Join our community in faith and fellowship</p>
            </div>
        </div>

        <div class="px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-if="isLoading">
                <div class="col-span-full flex flex-col items-center py-20 text-slate-400">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mb-4"></div>
                    <p class="font-bold">Gathering events...</p>
                </div>
            </template>

            <template x-if="!isLoading && events.length === 0">
                <div class="col-span-full flex flex-col items-center py-20 text-slate-400 text-center">
                    <i data-lucide="calendar-off" class="w-12 h-12 mb-4 opacity-20"></i>
                    <p class="font-bold text-lg text-slate-600">No events scheduled yet.</p>
                    <p class="text-sm">Check back soon for updates!</p>
                </div>
            </template>

            <template x-for="event in paginatedEvents" :key="event.id">
                <div @click="openRegistration(event)"
                     class="group bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-slate-100 cursor-pointer hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col">

                    <div class="relative h-56 bg-slate-200 overflow-hidden">
                        <img :src="event.image || 'https://images.unsplash.com/photo-1544427920-c49ccfb85579'"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full shadow-sm">
                            <span class="text-[10px] font-black text-blue-700 tracking-widest uppercase" x-text="event.category || 'Faith'"></span>
                        </div>

                        <template x-if="event.isLive">
                            <div class="absolute top-4 left-4 flex items-center gap-2 bg-red-600 text-white px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest animate-pulse shadow-lg">
                                <span class="w-2 h-2 bg-white rounded-full"></span> LIVE
                            </div>
                        </template>
                    </div>

                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="text-2xl font-black text-slate-800 leading-tight group-hover:text-blue-700 transition-colors" x-text="event.title"></h3>
                        <p class="mt-3 text-slate-500 text-sm line-clamp-2" x-text="event.description"></p>

                        <div class="mt-auto pt-6 space-y-3">
                            <div class="flex items-center gap-3 text-slate-600">
                                <div class="bg-blue-50 p-2 rounded-lg">
                                    <i data-lucide="calendar" class="w-4 h-4 text-blue-600"></i>
                                </div>
                                <span class="text-xs font-bold" x-text="event.date"></span>
                            </div>
                            <div class="flex items-center gap-3 text-slate-600">
                                <div class="bg-orange-50 p-2 rounded-lg">
                                    <i data-lucide="map-pin" class="w-4 h-4 text-orange-600"></i>
                                </div>
                                <span class="text-xs font-bold truncate" x-text="event.location"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <div x-show="isModalOpen"
             class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-md"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-cloak>

            <div @click.away="isModalOpen = false"
                 class="bg-white w-full max-w-lg rounded-[3.5rem] overflow-hidden shadow-2xl transform transition-all"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100">

                <div class="relative h-64">
                    <img :src="selectedEvent?.image || 'https://images.unsplash.com/photo-1544427920-c49ccfb85579'" class="w-full h-full object-cover">
                    <button @click="isModalOpen = false" class="absolute top-6 right-6 bg-white/20 backdrop-blur-md p-3 rounded-full text-white hover:bg-white/40 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <div class="p-10">
                    <span class="text-blue-600 font-black text-xs tracking-widest uppercase mb-2 block" x-text="selectedEvent?.date"></span>
                    <h3 class="text-3xl font-black text-slate-900 mb-4" x-text="selectedEvent?.title"></h3>
                    <p class="text-slate-600 leading-relaxed mb-8" x-text="selectedEvent?.description"></p>

                    <div class="grid grid-cols-2 gap-4 mb-10">
                        <div class="bg-slate-50 p-4 rounded-3xl border border-slate-100">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Time</p>
                            <p class="font-black text-slate-800" x-text="selectedEvent?.time"></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-3xl border border-slate-100">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Location</p>
                            <p class="font-black text-slate-800 truncate" x-text="selectedEvent?.location"></p>
                        </div>
                    </div>

                    <button @click="viewDetails()" class="w-full bg-blue-700 text-white font-black py-5 rounded-[2rem] shadow-xl shadow-blue-200 flex items-center justify-center gap-3 active:scale-95 hover:bg-blue-800 transition-all">
                        <span>Register & Details</span>
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
      <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('churchEvents', () => ({
            events: [],
            isLoading: true,
            itemsToShow: 12,
            isModalOpen: false,
            selectedEvent: null,

            async init() {
                try {
                    // Using the exact URL that worked in your browser
                    const response = await fetch("/api/events-data");
                    if (!response.ok) throw new Error('Failed to fetch');

                    const data = await response.json();

                    // Sanitize data: Ensure description isn't null so it doesn't break the UI
                    this.events = data.map(event => ({
                        ...event,
                        description: event.description || 'No description provided for this event.',
                        category: event.category || 'General'
                    }));

                } catch (e) {
                    console.error("Fetch Error:", e);
                } finally {
                    this.isLoading = false;
                    this.$nextTick(() => { this.refreshIcons(); });
                }
            },

            get paginatedEvents() {
                // Return events sorted by ID descending (Newest first)
                return [...this.events]
                    .sort((a, b) => b.id - a.id)
                    .slice(0, this.itemsToShow);
            },

            openRegistration(event) {
                this.selectedEvent = event;
                this.isModalOpen = true;
                this.$nextTick(() => { this.refreshIcons(); });
            },

            viewDetails() {
                if (this.selectedEvent) {
                    window.location.href = `/events/${this.selectedEvent.id}`;
                }
            },

            refreshIcons() {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }
        }));
    });
</script>
    </x-slot>
</x-app-layout>
