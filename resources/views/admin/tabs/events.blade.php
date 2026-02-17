<div x-data="eventManager()" x-init="init()" x-cloak class="min-h-screen bg-slate-50">

    <div class="fixed top-5 right-5 z-[100] space-y-3 pointer-events-none">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="translate-x-full opacity-0"
                 x-transition:enter-end="translate-x-0 opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 :class="toast.type === 'success' ? 'bg-emerald-600' : 'bg-red-600'"
                 class="flex items-center gap-3 px-6 py-4 rounded-2xl text-white shadow-2xl min-w-[300px] pointer-events-auto">
                <i :data-lucide="toast.type === 'success' ? 'check-circle' : 'alert-circle'" class="w-5 h-5"></i>
                <span class="font-bold text-sm" x-text="toast.message"></span>
            </div>
        </template>
    </div>

    <div class="bg-white border-b border-slate-200 px-10 py-8">
        <div class="flex items-center justify-between max-w-[1600px] mx-auto">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Event Management</h1>
                <p class="text-slate-500 font-medium mt-1">Create, edit and manage your church events schedule.</p>
            </div>
            <button x-on:click="openModal()" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-md shadow-blue-100">
                <i data-lucide="plus" class="w-5 h-5"></i>
                Create New Event
            </button>
        </div>
    </div>

    <div class="p-10 max-w-[1600px] mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center gap-5 shadow-sm">
                <div class="p-4 bg-blue-50 rounded-2xl text-blue-600">
                    <i data-lucide="calendar-days" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-3xl font-black text-slate-900" x-text="events.length"></p>
                    <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest">Total Events</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center gap-5 shadow-sm">
                <div class="p-4 bg-red-50 rounded-2xl text-red-600">
                    <i data-lucide="radio" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-3xl font-black text-slate-900" x-text="events.filter(e => e.isLive).length"></p>
                    <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest">Live Now</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center gap-5 shadow-sm">
                <div class="p-4 bg-emerald-50 rounded-2xl text-emerald-600">
                    <i data-lucide="clock" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-3xl font-black text-slate-900" x-text="events.filter(e => !e.isLive).length"></p>
                    <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest">Upcoming</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h3 class="font-bold text-slate-800 text-xl tracking-tight">All Scheduled Events</h3>
                <div class="relative w-full md:w-80">
                    <i data-lucide="search" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" x-model="searchQuery" x-on:input="currentPage = 1" placeholder="Search events..."
                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                </div>
            </div>

            <div class="overflow-x-auto relative min-h-[400px]">
                <div x-show="isLoading" class="absolute inset-0 bg-white/50 backdrop-blur-[1px] z-10 flex items-center justify-center">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-slate-400 text-[10px] font-black uppercase tracking-[0.15em]">
                            <th class="px-8 py-5">Event Detail</th>
                            <th class="px-8 py-5">Schedule</th>
                            <th class="px-8 py-5">Venue</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5 text-right">Management</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <template x-for="event in paginatedEvents()" :key="event.id">
                            <tr class="hover:bg-slate-50/80 transition-all group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="relative flex-shrink-0">
                                            <img :src="event.image || 'https://via.placeholder.com/100?text=Event'"
                                                 class="w-12 h-12 rounded-xl object-cover bg-slate-100"
                                                 x-on:error="$event.target.src='https://via.placeholder.com/100?text=No+Image'">
                                            <div x-show="event.isLive" class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 border-2 border-white rounded-full animate-pulse"></div>
                                        </div>
                                        <span class="font-bold text-slate-700 text-sm" x-text="event.title"></span>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-sm text-slate-700 font-semibold" x-text="event.date"></span>
                                        <span class="text-[11px] text-slate-400 font-medium" x-text="event.time"></span>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-2 text-slate-500">
                                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                                        <span class="text-sm font-medium" x-text="event.location"></span>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span :class="event.isLive ? 'bg-red-50 text-red-600' : 'bg-slate-100 text-slate-500'"
                                          class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase"
                                          x-text="event.isLive ? 'Live' : 'Scheduled'"></span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button x-on:click="editEvent(event)" class="p-2.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </button>
                                        <button x-on:click="triggerDelete(event)" class="p-2.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

                <div x-show="filteredEvents().length === 0 && !isLoading" class="p-20 text-center">
                    <p class="text-slate-400 font-medium">No events found matching your search.</p>
                </div>
            </div>

            <div class="p-6 border-t border-slate-100 flex items-center justify-between bg-slate-50/30">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                    Showing <span class="text-slate-900" x-text="startRange()"></span> to <span class="text-slate-900" x-text="endRange()"></span> of <span class="text-slate-900" x-text="filteredEvents().length"></span>
                </p>
                <div class="flex gap-2">
                    <button x-on:click="prevPage()" :disabled="currentPage === 1" class="p-2 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 disabled:opacity-50 transition-colors">
                        <i data-lucide="chevron-left" class="w-5 h-5"></i>
                    </button>
                    <button x-on:click="nextPage()" :disabled="currentPage === totalPages()" class="p-2 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 disabled:opacity-50 transition-colors">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="isModalOpen"
         class="fixed inset-0 z-[120] flex items-center justify-center p-6"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         style="display: none;">

        <div x-on:click="closeModal()" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <div x-show="isModalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             class="bg-white rounded-[2rem] w-full max-w-2xl shadow-2xl relative overflow-hidden flex flex-col max-h-[90vh]">

            <div class="p-10 overflow-y-auto">
                <h2 class="text-2xl font-black text-slate-900 mb-8 tracking-tight" x-text="editingEvent ? 'Edit Event Details' : 'New Event Schedule'"></h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Event Cover Image</label>
                        <div x-on:click="$refs.fileInput.click()"
                             class="relative aspect-video rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50 flex flex-col items-center justify-center cursor-pointer hover:border-blue-400 transition-all overflow-hidden group">

                            <template x-if="imagePreview">
                                <img :src="imagePreview" class="absolute inset-0 w-full h-full object-cover">
                            </template>

                            <div x-show="!imagePreview" class="text-center p-6">
                                <i data-lucide="image-plus" class="w-10 h-10 text-slate-300 mx-auto mb-2"></i>
                                <p class="text-xs font-bold text-slate-400">Click to upload photo</p>
                            </div>
                        </div>
                        <input type="file" x-ref="fileInput" class="hidden" x-on:change="handleFileUpload($event)" accept="image/*">
                    </div>

                    <div class="space-y-5">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Event Title</label>
                            <input type="text" x-model="formData.title" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none font-medium text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Date</label>
                                <input type="date" x-model="formData.date" class="w-full px-4 py-4 rounded-2xl border border-slate-200 outline-none text-sm focus:border-blue-500 transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Time</label>
                                <input type="text" x-model="formData.time" placeholder="09:00 AM" class="w-full px-4 py-4 rounded-2xl border border-slate-200 outline-none text-sm focus:border-blue-500 transition-all">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Venue / Location</label>
                        <input type="text" x-model="formData.location" class="w-full px-5 py-4 rounded-2xl border border-slate-200 outline-none focus:border-blue-500 transition-all text-sm">
                    </div>

                    <div class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-3">
                            <div :class="formData.isLive ? 'bg-red-500' : 'bg-slate-300'" class="p-2 rounded-lg transition-colors">
                                <i data-lucide="radio" class="w-4 h-4 text-white"></i>
                            </div>
                            <span class="text-sm font-bold text-slate-700 uppercase tracking-tighter">Live Broadcast</span>
                        </div>
                        <button x-on:click="formData.isLive = !formData.isLive" :class="formData.isLive ? 'bg-red-500' : 'bg-slate-200'" class="w-11 h-6 rounded-full relative transition-all duration-300">
                            <span :class="formData.isLive ? 'translate-x-6' : 'translate-x-1'" class="absolute top-1 left-0 w-4 h-4 bg-white rounded-full shadow-sm transition-transform"></span>
                        </button>
                    </div>
                </div>

                <div class="mt-10 flex gap-4">
                    <button x-on:click="closeModal()" class="flex-1 px-8 py-4 rounded-2xl font-bold text-slate-500 hover:bg-slate-50 uppercase text-xs tracking-widest transition-all border border-transparent">Cancel</button>
                    <button x-on:click="saveEvent()" :disabled="isLoading" class="flex-1 px-8 py-4 rounded-2xl font-bold bg-slate-900 text-white hover:bg-slate-800 disabled:opacity-50 uppercase text-xs tracking-widest transition-all shadow-xl shadow-slate-200">
                        <span x-text="isLoading ? 'Processing...' : (editingEvent ? 'Update Event' : 'Save Event')"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="showDeleteModal"
         class="fixed inset-0 z-[130] flex items-center justify-center p-6"
         style="display: none;">
        <div x-on:click="showDeleteModal = false" class="absolute inset-0 bg-slate-900/80 backdrop-blur-md"></div>
        <div class="bg-white rounded-[2.5rem] w-full max-w-md p-10 shadow-2xl relative text-center">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <i data-lucide="trash-2" class="w-10 h-10"></i>
            </div>
            <h3 class="text-2xl font-black mb-2 text-slate-900">Delete Event?</h3>
            <p class="text-slate-500 mb-8">This action is permanent and cannot be undone.</p>
            <div class="flex flex-col gap-2">
                <button x-on:click="confirmDelete()" class="w-full py-4 rounded-2xl font-bold bg-red-500 text-white hover:bg-red-600 uppercase text-xs tracking-widest transition-all shadow-lg shadow-red-100">Yes, Delete Permanently</button>
                <button x-on:click="showDeleteModal = false" class="w-full py-4 text-slate-400 font-bold uppercase text-xs tracking-widest hover:text-slate-600 transition-all">Cancel</button>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>

<script>
function eventManager() {
    return {
        events: [],
        toasts: [],
        searchQuery: '',
        currentPage: 1,
        rowsPerPage: 5,
        isLoading: false,
        isModalOpen: false,
        showDeleteModal: false,
        editingEvent: null,
        eventToDelete: null,
        imagePreview: null,
        selectedFile: null,
        formData: { title: '', date: '', time: '', location: '', isLive: false },

        async init() {
            await this.fetchEvents();
        },

        addToast(message, type = 'success') {
            const id = Date.now();
            this.toasts.push({ id, message, type });
            this.refreshIcons();
            setTimeout(() => this.toasts = this.toasts.filter(t => t.id !== id), 4000);
        },

        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.selectedFile = file;
                const reader = new FileReader();
                reader.onload = (e) => this.imagePreview = e.target.result;
                reader.readAsDataURL(file);
            }
        },

        async fetchEvents() {
            this.isLoading = true;
            try {
                const res = await fetch('/admin/api/events');
                if (!res.ok) throw new Error();
                const data = await res.json();

                this.events = data.map(event => ({
                    ...event,
                    isLive: Boolean(Number(event.isLive)),
                    image: event.image && event.image.includes('/storage/http')
                           ? event.image.split('/storage/')[1]
                           : event.image
                }));
            } catch (e) {
                this.addToast("Could not sync with server", "error");
            } finally {
                this.isLoading = false;
                this.refreshIcons();
            }
        },

        async saveEvent() {
            if(!this.formData.title || !this.formData.date) {
                this.addToast("Title and Date are required", "error");
                return;
            }

            this.isLoading = true;
            const data = new FormData();
            data.append('title', this.formData.title);
            data.append('date', this.formData.date);
            data.append('time', this.formData.time || '');
            data.append('location', this.formData.location || '');
            data.append('isLive', this.formData.isLive ? 1 : 0);

            if (this.selectedFile) data.append('image', this.selectedFile);

            // Handle Laravel PUT spoofing for updates
            if (this.editingEvent) {
                data.append('_method', 'PUT');
            }

            const url = this.editingEvent ? `/admin/api/events/${this.editingEvent}` : '/admin/api/events';

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const response = await fetch(url, {
                    method: 'POST', // Always POST, _method handles the logic
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: data
                });

                if (response.ok) {
                    await this.fetchEvents();
                    this.addToast(this.editingEvent ? "Updated Successfully!" : "Created Successfully!");
                    this.closeModal();
                } else {
                    const err = await response.json();
                    throw new Error(err.message || "Server Error");
                }
            } catch (e) {
                this.addToast(e.message, "error");
            } finally {
                this.isLoading = false;
            }
        },

        async confirmDelete() {
            this.isLoading = true;
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const res = await fetch(`/admin/api/events/${this.eventToDelete.id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                if(res.ok) {
                    this.events = this.events.filter(e => e.id !== this.eventToDelete.id);
                    this.addToast("Event deleted permanently");
                } else {
                    throw new Error();
                }
            } catch (e) {
                this.addToast("Delete failed", "error");
            } finally {
                this.isLoading = false;
                this.showDeleteModal = false;
                this.refreshIcons();
            }
        },

        openModal(event = null) {
            if (event) {
                this.editingEvent = event.id;
                this.formData = {
                    title: event.title,
                    date: event.date,
                    time: event.time,
                    location: event.location,
                    isLive: event.isLive
                };
                this.imagePreview = event.image;
            } else {
                this.editingEvent = null;
                this.formData = { title: '', date: '', time: '', location: '', isLive: false };
                this.imagePreview = null;
            }
            this.selectedFile = null;
            this.isModalOpen = true;
            this.refreshIcons();
        },

        closeModal() { this.isModalOpen = false; },
        triggerDelete(event) { this.eventToDelete = event; this.showDeleteModal = true; this.refreshIcons(); },
        editEvent(event) { this.openModal(event); },
        refreshIcons() {
            this.$nextTick(() => {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            });
        },
        filteredEvents() {
            return this.events
                .filter(e =>
                    e.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    (e.location && e.location.toLowerCase().includes(this.searchQuery.toLowerCase()))
                )
                .sort((a, b) => b.id - a.id);
        },
        paginatedEvents() {
            const start = (this.currentPage - 1) * this.rowsPerPage;
            return this.filteredEvents().slice(start, start + this.rowsPerPage);
        },
        totalPages() { return Math.ceil(this.filteredEvents().length / this.rowsPerPage) || 1; },
        startRange() { return this.filteredEvents().length === 0 ? 0 : (this.currentPage - 1) * this.rowsPerPage + 1; },
        endRange() { return Math.min(this.currentPage * this.rowsPerPage, this.filteredEvents().length); },
        nextPage() { if(this.currentPage < this.totalPages()) { this.currentPage++; this.refreshIcons(); } },
        prevPage() { if(this.currentPage > 1) { this.currentPage--; this.refreshIcons(); } }
    }
}
</script>
