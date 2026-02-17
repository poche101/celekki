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
                <h2 class="text-2xl font-black text-slate-900">Upcoming Events</h2>
                <p class="text-slate-500 text-sm font-medium">Join our community in faith and fellowship</p>
            </div>
        </div>

        <br>
        <br>

       <div x-data="eventManager()" x-init="init()" x-cloak>
   <div x-data="eventManager()" x-init="init()" x-cloak class="bg-slate-50/50 py-12">
    <div class="max-w-[1600px] mx-auto px-6">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

            <template x-if="isLoading">
                <div class="col-span-full flex flex-col items-center py-24">
                    <div class="relative w-12 h-12">
                        <div class="absolute inset-0 border-4 border-blue-100 rounded-full"></div>
                        <div class="absolute inset-0 border-4 border-blue-600 rounded-full border-t-transparent animate-spin"></div>
                    </div>
                    <p class="mt-4 text-slate-500 font-medium tracking-wide">Securing event details...</p>
                </div>
            </template>

            <template x-if="!isLoading && events.length === 0">
                <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border border-dashed border-slate-200">
                    <i data-lucide="calendar-days" class="w-12 h-12 mx-auto text-slate-300 mb-4"></i>
                    <h3 class="text-xl font-bold text-slate-800">Your calendar is clear</h3>
                    <p class="text-slate-500">No upcoming events found. Check back soon!</p>
                </div>
            </template>

            <template x-for="event in paginatedEvents" :key="event.id">
                <div class="group bg-white rounded-[2rem] overflow-hidden border border-slate-100 hover:border-blue-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_50px_rgba(59,130,246,0.12)] transition-all duration-500 flex flex-col h-full relative">

                    <div class="relative h-48 overflow-hidden">
                        <img :src="event.image || 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=800'"
                             class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">

                        <div class="absolute top-4 right-4 bg-white/80 backdrop-blur-md px-3 py-1 rounded-xl shadow-sm border border-white/20">
                            <span class="text-[10px] font-bold text-slate-900 uppercase tracking-tighter" x-text="event.category || 'General'"></span>
                        </div>

                        <template x-if="event.isLive">
                            <div class="absolute top-4 left-4 flex items-center gap-1.5 bg-green-500 text-white px-3 py-1 rounded-full text-[9px] font-black tracking-widest animate-pulse shadow-lg">
                                <span class="w-1.5 h-1.5 bg-white rounded-full animate-ping"></span> LIVE
                            </div>
                        </template>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-slate-900 leading-snug group-hover:text-blue-600 transition-colors duration-300" x-text="event.title"></h3>

                            <div class="mt-4 space-y-2">
                                <div class="flex items-center gap-3 text-slate-500">
                                    <i data-lucide="calendar-range" class="w-4 h-4 text-blue-500"></i>
                                    <span class="text-xs font-semibold italic" x-text="event.date"></span>
                                </div>
                                <div class="flex items-center gap-3 text-slate-500">
                                    <i data-lucide="timer" class="w-4 h-4 text-emerald-500"></i>
                                    <span class="text-xs font-semibold" x-text="event.time || 'TBA'"></span>
                                </div>
                                <div class="flex items-center gap-3 text-slate-500">
                                    <i data-lucide="map-pin-check" class="w-4 h-4 text-orange-500"></i>
                                    <span class="text-xs font-semibold truncate" x-text="event.location"></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-5 border-t border-slate-50 flex items-center justify-between">
                            <button @click="openRegistration(event)"
                                    class="w-full bg-slate-900 hover:bg-blue-600 text-white text-xs font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 group/btn shadow-md hover:shadow-blue-200">
                                <span>Register Now</span>
                                <i data-lucide="arrow-up-right" class="w-3 h-3 group-hover/btn:translate-x-0.5 group-hover/btn:-translate-y-0.5 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
function eventManager() {
    return {
        events: [],
        isLoading: true,

        async init() {
            try {
                const response = await fetch('/api/events-data');
                this.events = await response.json();
            } catch (error) {
                console.error("API Error:", error);
            } finally {
                this.isLoading = false;
                this.$nextTick(() => {
                    if (window.lucide) {
                        lucide.createIcons();
                    }
                });
            }
        },

        get paginatedEvents() {
            return this.events;
        },

        openRegistration(event) {
            // Logic to handle registration or redirection
            window.location.href = `/events/${event.id}/register`;
        }
    }
}
</script>
</div>

<script>
function eventManager() {
    return {
        events: [],
        isLoading: true,

        async init() {
            try {
                // Fetch from the route we created in the Controller
                const response = await fetch('/api/events-data');
                this.events = await response.json();
            } catch (error) {
                console.error("Failed to load events:", error);
            } finally {
                this.isLoading = false;

                // Re-initialize Lucide icons after DOM update
                this.$nextTick(() => {
                    if (window.lucide) {
                        lucide.createIcons();
                    }
                });
            }
        },

        // This getter is what x-for="event in paginatedEvents" uses
        get paginatedEvents() {
            return this.events;
        },

        openRegistration(event) {
            // Redirect to the show page we set up
            window.location.href = `/events/${event.id}`;
        }
    }
}
</script>

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
