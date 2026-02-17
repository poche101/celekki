<div x-data="videoManager()" x-init="fetchVideos()" class="bg-slate-50 min-h-screen p-8 text-slate-900 relative">

    <div class="fixed top-5 right-5 z-[100] space-y-3">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-10"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 :class="toast.type === 'success' ? 'bg-emerald-500' : 'bg-red-500'"
                 class="flex items-center gap-3 px-6 py-4 rounded-2xl shadow-2xl text-white min-w-[300px]">
                <i :class="toast.type === 'success' ? 'check-circle' : 'alert-circle'" class="w-5 h-5" x-init="$nextTick(() => typeof lucide !== 'undefined' && lucide.createIcons())"></i>
                <span class="font-medium" x-text="toast.message"></span>
            </div>
        </template>
    </div>

    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-800">H-Life Archive</h1>
            <p class="text-slate-500 mt-1">Search and manage your library of recordings.</p>
        </div>
        <button x-on:click="openModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold flex items-center gap-2 transition shadow-sm">
            <i data-lucide="clapperboard" class="w-5 h-5"></i>
            Post New Video
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <template x-for="stat in stats" :key="stat.label">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center gap-4 shadow-sm">
                <div :class="`p-3 rounded-full ${stat.bgColor}`">
                    <i :data-lucide="stat.icon" :class="`w-6 h-6 ${stat.iconColor}`"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-800" x-text="stat.value"></p>
                    <p class="text-sm text-slate-500" x-text="stat.label"></p>
                </div>
            </div>
        </template>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="text-lg font-bold text-slate-800">Recent Uploads</h2>
            <div class="relative w-full md:w-80">
                <span class="absolute left-3 top-2.5 text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </span>
                <input type="text" x-model="searchQuery" placeholder="Search title or episode..."
                    class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-6 py-4">Content</th>
                        <th class="px-6 py-4">Episode</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="video in paginatedVideos" :key="video.id">
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img :src="video.poster_url" class="w-12 h-8 rounded object-cover bg-slate-200"
                                         x-on:error="$el.src='https://placehold.co/48x32?text=No+Thumb'">
                                    <div>
                                        <p class="font-semibold text-slate-800" x-text="video.title"></p>
                                        <p class="text-xs text-slate-400" x-text="'ID: ' + video.id"></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 font-medium" x-text="'Episode ' + video.episode"></td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button x-on:click="openModal(video)" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <button x-on:click="openDeleteModal(video)" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-6 text-sm text-slate-500">
                <div class="flex items-center gap-2">
                    <span>Rows per page:</span>
                    <select x-model="rowsPerPage" x-on:change="currentPage = 1" class="border-none bg-transparent font-bold text-slate-700 outline-none cursor-pointer">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                </div>
                <span x-text="`Page ${currentPage} of ${totalPages}`"></span>
            </div>
            <div class="flex gap-2">
                <button x-on:click="currentPage--" :disabled="currentPage <= 1" class="p-2 border border-slate-200 rounded-lg disabled:opacity-30 hover:bg-slate-50 transition">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </button>
                <button x-on:click="currentPage++" :disabled="currentPage >= totalPages" class="p-2 border border-slate-200 rounded-lg disabled:opacity-30 hover:bg-slate-50 transition">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>

    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-cloak>
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" x-on:click="modalOpen = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"></div>
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl relative z-10 overflow-hidden" x-show="modalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-slate-800" x-text="isEdit ? 'Edit Archive Entry' : 'Post New Video'"></h3>
                <button x-on:click="modalOpen = false" class="text-slate-400 hover:text-slate-600"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <form x-on:submit.prevent="saveVideo" class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Video Title</label>
                    <input type="text" x-model="form.title" required placeholder="e.g. Love Smells" class="w-full border border-slate-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Episode Number</label>
                        <input type="number" x-model="form.episode" required class="w-full border border-slate-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Stream URL</label>
                        <input type="text" x-model="form.video_path" required class="w-full border border-slate-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Thumbnail Image</label>
                    <div class="border-2 border-dashed border-slate-200 rounded-2xl p-8 text-center hover:border-indigo-400 transition cursor-pointer bg-slate-50" x-on:click="$refs.fileInput.click()">
                        <input type="file" x-ref="fileInput" class="hidden" x-on:change="handleFileUpload" accept="image/*">
                        <div x-show="!form.poster_path && !isEdit" class="space-y-2">
                             <i data-lucide="image-plus" class="w-8 h-8 mx-auto text-indigo-600"></i>
                             <p class="text-sm text-slate-500">Click to upload thumbnail</p>
                        </div>
                        <div x-show="form.poster_path || isEdit" class="flex items-center justify-center gap-3">
                            <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500"></i>
                            <p class="text-sm font-medium text-slate-700" x-text="form.poster_name"></p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-8">
                    <button type="button" x-on:click="modalOpen = false" class="px-6 py-2 text-slate-500 font-semibold hover:text-slate-700">Cancel</button>
                    <button type="submit" class="bg-indigo-600 text-white px-8 py-2 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                        <span x-text="isEdit ? 'Update Entry' : 'Post Video'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="deleteModalOpen" class="fixed inset-0 z-[60] flex items-center justify-center p-4" x-cloak>
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" x-on:click="deleteModalOpen = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"></div>
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl relative z-10 p-8 text-center" x-show="deleteModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="alert-triangle" class="w-8 h-8"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Confirm Deletion</h3>
            <p class="text-slate-500 mb-8">Are you sure you want to remove <span class="font-bold text-slate-700" x-text="videoToDelete?.title"></span>? This action cannot be undone.</p>
            <div class="flex gap-3">
                <button x-on:click="deleteModalOpen = false" class="flex-1 px-6 py-3 border border-slate-200 rounded-xl font-semibold text-slate-600 hover:bg-slate-50 transition">Cancel</button>
                <button x-on:click="confirmDelete()" class="flex-1 px-6 py-3 bg-red-500 text-white rounded-xl font-bold hover:bg-red-600 transition shadow-lg shadow-red-100">Delete Video</button>
            </div>
        </div>
    </div>
</div>

<script>
function videoManager() {
    return {
        videoArchive: [],
        toasts: [],
        searchQuery: '',
        currentPage: 1,
        rowsPerPage: 5,
        modalOpen: false,
        deleteModalOpen: false,
        videoToDelete: null,
        isEdit: false,
        form: { id: null, title: '', episode: '', video_path: '', poster_path: null, poster_name: '' },

        get stats() {
            return [
                { label: 'Total Videos', value: this.videoArchive.length, icon: 'video', bgColor: 'bg-blue-50', iconColor: 'text-blue-500' },
                { label: 'Unique Episodes', value: [...new Set(this.videoArchive.map(v => v.episode))].length, icon: 'layers', bgColor: 'bg-orange-50', iconColor: 'text-orange-500' },
                { label: 'Cloud Storage', value: 'Active', icon: 'cloud', bgColor: 'bg-green-50', iconColor: 'text-green-500' },
            ];
        },

        get filteredVideos() {
            if (!this.searchQuery) return this.videoArchive;
            const query = this.searchQuery.toLowerCase();
            return this.videoArchive.filter(v =>
                v.title.toLowerCase().includes(query) ||
                v.episode.toString().includes(query)
            );
        },

        get totalPages() {
            return Math.ceil(this.filteredVideos.length / this.rowsPerPage) || 1;
        },

        get paginatedVideos() {
            const start = (this.currentPage - 1) * parseInt(this.rowsPerPage);
            return this.filteredVideos.slice(start, start + parseInt(this.rowsPerPage));
        },

        notify(message, type = 'success') {
            const id = Date.now();
            this.toasts.push({ id, message, type });
            setTimeout(() => {
                this.toasts = this.toasts.filter(t => t.id !== id);
            }, 3000);
        },

        async fetchVideos() {
            try {
                const res = await fetch('/admin/api/videos', {
                    headers: { 'Accept': 'application/json' }
                });
                if (!res.ok) throw new Error('Failed to load archive');
                const json = await res.json();
                this.videoArchive = json.data;
                this.$nextTick(() => typeof lucide !== 'undefined' && lucide.createIcons());
            } catch (err) {
                this.notify(err.message, 'error');
            }
        },

        openModal(video = null) {
            this.isEdit = !!video;
            if (video) {
                this.form = {
                    id: video.id,
                    title: video.title,
                    episode: video.episode,
                    video_path: video.video_path,
                    poster_path: null,
                    poster_name: 'Existing Thumbnail'
                };
            } else {
                this.form = { id: null, title: '', episode: '', video_path: '', poster_path: null, poster_name: '' };
            }
            this.modalOpen = true;
            this.$nextTick(() => typeof lucide !== 'undefined' && lucide.createIcons());
        },

        openDeleteModal(video) {
            this.videoToDelete = video;
            this.deleteModalOpen = true;
            this.$nextTick(() => typeof lucide !== 'undefined' && lucide.createIcons());
        },

        handleFileUpload(e) {
            const file = e.target.files[0];
            if (file) {
                this.form.poster_path = file;
                this.form.poster_name = file.name;
            }
        },

        async saveVideo() {
            if(!this.form.title || !this.form.episode || !this.form.video_path) {
                this.notify('Please fill in all required fields', 'error');
                return;
            }

            const formData = new FormData();
            formData.append('title', this.form.title);
            formData.append('episode', this.form.episode);
            formData.append('video_path', this.form.video_path);

            if (this.form.poster_path instanceof File) {
                formData.append('poster_path', this.form.poster_path);
            }

            let url = '/admin/api/videos';
            if (this.isEdit) {
                url = `/admin/api/videos/${this.form.id}`;
                formData.append('_method', 'POST');
            }

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    }
                });

                if (response.ok) {
                    this.notify(this.isEdit ? 'Video updated successfully' : 'Video posted to archive');
                    this.modalOpen = false;
                    this.fetchVideos();
                } else {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Server error occurred');
                }
            } catch (err) {
                this.notify(err.message, 'error');
            }
        },

        async confirmDelete() {
            if(!this.videoToDelete) return;
            try {
                const response = await fetch(`/admin/api/videos/${this.videoToDelete.id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    }
                });

                if(response.ok) {
                    this.notify('Video removed from archive');
                    this.deleteModalOpen = false;
                    this.videoToDelete = null;
                    this.fetchVideos();
                } else {
                    throw new Error('Could not delete video');
                }
            } catch (err) {
                this.notify(err.message, 'error');
            }
        }
    }
}
</script>
