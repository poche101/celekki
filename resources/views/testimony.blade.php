<x-app-layout>
    <div x-data="testimonyManager()" x-init="init()" class="bg-[#F8FAFC] min-h-screen pb-20">

        <header class="relative pt-20 pb-16 overflow-hidden bg-white">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:32px_32px] [mask-image:radial-gradient(ellipse_50%_50%_at_50%_50%,#000_70%,transparent_100%)] opacity-30"></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-xs font-bold tracking-widest uppercase text-indigo-600">The Wall of Grace</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tight mb-6">
                    Real Stories. <span class="text-indigo-600">Real Impact.</span>
                </h1>
                <p class="max-w-2xl mx-auto text-lg text-slate-500 leading-relaxed mb-10">
                    A collection of modern-day miracles and community milestones. Witness the transformation within our global family.
                </p>
                <button @click="openModal()" class="group relative inline-flex items-center justify-center px-8 py-4 font-bold text-white transition-all duration-200 bg-slate-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 hover:bg-indigo-600 shadow-xl shadow-indigo-200/50">
                    Share Your Testimony
                </button>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-6">
            <template x-if="videoTestimonies.length > 0">
                <section class="py-12">
                    <div class="flex items-end justify-between mb-10">
                        <div>
                            <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Featured Films</h2>
                            <p class="text-slate-500 mt-1">Video accounts of extraordinary faith.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <template x-for="video in videoTestimonies" :key="video.id">
                            <div class="group relative bg-white rounded-[2rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500">
                                <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                                    <img :src="`https://img.youtube.com/vi/${getYouTubeID(video.video_url)}/maxresdefault.jpg`"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>

                                    <a :href="video.video_url" target="_blank" class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center group-hover:scale-110 group-hover:bg-indigo-600 transition-all duration-300">
                                            <i data-lucide="play" class="w-8 h-8 text-white fill-current"></i>
                                        </div>
                                    </a>

                                    <div class="absolute bottom-6 left-6 right-6">
                                        <span class="px-3 py-1 bg-white/10 backdrop-blur-md border border-white/20 text-white text-[10px] font-bold uppercase tracking-[0.2em] rounded-lg" x-text="video.group"></span>
                                        <h3 class="text-xl font-bold text-white mt-3" x-text="video.name"></h3>
                                    </div>
                                </div>
                                <div class="p-8">
                                    <p class="text-slate-600 leading-relaxed text-lg font-medium" x-text="video.content"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </section>
            </template>

            <section class="py-20 border-t border-slate-100">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Written Reflections</h2>
                    <p class="text-slate-500 mt-2">Voices from across our various groups.</p>
                </div>

                <div class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8">
                    <template x-for="testimony in textTestimonies" :key="testimony.id">
                        <div class="break-inside-avoid relative group" x-data="{ expanded: false }">
                            <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-violet-500 rounded-[2rem] blur opacity-0 group-hover:opacity-10 transition duration-500"></div>
                            <div class="relative bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm transition-all duration-300">
                                <i data-lucide="quote" class="w-8 h-8 text-indigo-100 mb-6"></i>

                                <p class="text-slate-700 leading-relaxed text-lg mb-8"
                                   :class="expanded ? '' : 'line-clamp-6'"
                                   x-text="testimony.content"></p>

                                <button x-show="testimony.content.length > 200"
                                        @click="expanded = !expanded"
                                        class="text-indigo-600 font-bold text-sm mb-6 hover:underline"
                                        x-text="expanded ? 'Show Less' : 'Read Full Story'"></button>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-indigo-600 font-black border border-slate-100" x-text="testimony.name.charAt(0)"></div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm tracking-tight" x-text="testimony.name"></h4>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest" x-text="testimony.group"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </section>
        </main>

        <div x-show="modalOpen"
             class="fixed inset-0 z-[100] overflow-y-auto"
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100">

            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-sm" @click="modalOpen = false"></div>

                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-[2.5rem] shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100">

                    <div class="p-8 sm:p-12">
                        <div class="flex justify-between items-center mb-8">
                            <h2 class="text-3xl font-black text-slate-900">Share Miracle</h2>
                            <button @click="modalOpen = false" class="text-slate-400 hover:text-slate-600">
                                <i data-lucide="x" class="w-6 h-6"></i>
                            </button>
                        </div>

                        <form @submit.prevent="submitTestimonyUI" class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Full Name</label>
                                <input type="text" x-model="form.name" required
                                       class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 text-slate-900 font-medium">
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Home Group / Center</label>
                                <input type="text" x-model="form.group" required
                                       class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 text-slate-900 font-medium">
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Your Story</label>
                                <textarea x-model="form.content" required rows="4"
                                          class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 text-slate-900 font-medium"></textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">YouTube Link (Optional)</label>
                                <input type="url" x-model="form.video_url"
                                       placeholder="https://youtube.com/watch?v=..."
                                       class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 text-slate-900 font-medium">
                            </div>

                            <button type="submit"
                                    :disabled="loading"
                                    class="w-full py-5 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all flex items-center justify-center gap-3">
                                <span x-show="!loading">Submit Testimony</span>
                                <span x-show="loading" class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Processing...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="showToast"
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-20 opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0 opacity-100"
             x-transition:leave-end="translate-y-20 opacity-0"
             class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[110]">
            <div class="bg-slate-900 text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4">
                <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center">
                    <i data-lucide="check" class="w-5 h-5 text-white"></i>
                </div>
                <p class="font-bold tracking-tight">Your story has been submitted for review!</p>
            </div>
        </div>
    </div>

    <script>
    function testimonyManager() {
        return {
            modalOpen: false,
            loading: false,
            showToast: false,
            form: {
                name: '',
                group: '',
                content: '',
                video_url: ''
            },

            // Data from Controller
            videoTestimonies: @json($videoTestimonies ?? []),
            textTestimonies: @json($textTestimonies ?? []),

            init() {
                this.refreshIcons();
            },

            refreshIcons() {
                this.$nextTick(() => {
                    if (window.lucide) lucide.createIcons();
                });
            },

            openModal() {
                this.modalOpen = true;
                this.refreshIcons();
            },

            getYouTubeID(url) {
                if (!url) return '';
                const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                const match = url.match(regExp);
                return (match && match[2].length === 11) ? match[2] : '';
            },

            async submitTestimonyUI() {
                if (this.loading) return;
                this.loading = true;

                try {
                    const response = await fetch("{{ route('testimonies.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(this.form)
                    });

                    const result = await response.json();

                    if (response.ok) {
                        // Success: The data is now in the database.
                        // We do NOT update videoTestimonies or textTestimonies here.
                        // This prevents the new testimony from appearing on the page immediately.

                        // Close and Reset
                        this.modalOpen = false;
                        this.form = { name: '', group: '', content: '', video_url: '' };

                        // Toast Notification (Updated message to indicate review process)
                        this.showToast = true;
                        this.refreshIcons();
                        setTimeout(() => this.showToast = false, 4000);
                    } else {
                        alert(result.message || 'Please check your input fields.');
                    }
                } catch (error) {
                    console.error("Submission Error:", error);
                    alert('Could not connect to server.');
                } finally {
                    this.loading = false;
                }
            }
        }
    }
    </script>
</x-app-layout>
