<x-app-layout>
    <div x-data="testimonyManager()" class="bg-[#F8FAFC] min-h-screen pb-20 relative font-sans">

        <div x-show="showToast" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="translate-y-10 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed bottom-24 right-4 left-4 md:left-auto md:right-10 z-[110] flex items-center gap-3 bg-emerald-500 text-white px-6 py-4 rounded-2xl shadow-2xl shadow-emerald-200"
            x-cloak>
            <div class="bg-white/20 p-1 rounded-full">
                <i data-lucide="check-circle-2" class="w-5 h-5"></i>
            </div>
            <span class="font-bold">Testimony submitted!</span>
        </div>

        <button @click="openModal()"
            class="fixed bottom-10 right-6 md:right-10 z-[90] group flex items-center gap-3 bg-slate-900 hover:bg-indigo-600 text-white pl-4 pr-6 py-4 rounded-2xl shadow-2xl shadow-indigo-200 transition-all duration-500 transform hover:-translate-y-2 active:scale-95">
            <div
                class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center group-hover:bg-white group-hover:rotate-12 transition-all duration-500">
                <i data-lucide="sparkles" class="w-4 h-4 text-white group-hover:text-indigo-600"></i>
            </div>
            <span class="font-bold tracking-tight">Share Your Testimony</span>
        </button>

        <div class="relative h-[60vh] w-full overflow-hidden bg-slate-900">
            <img src="/images/healing.jpg" alt="Healing" class="w-full h-full object-cover object-center scale-105">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-950/90 via-indigo-900/40 to-transparent"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-6 w-full">
                    <div class="max-w-2xl" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
                        <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                            x-transition:enter-start="opacity-0 -translate-x-10"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6">
                            <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-white">The Miracles Gallery</span>
                        </div>
                        <h2 x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
                            x-transition:enter-start="opacity-0 -translate-x-10"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            class="text-5xl md:text-7xl font-black text-white tracking-tighter leading-none mb-6">
                            Miracles <br>
                            <span class="text-indigo-300">Still Happen.</span>
                        </h2>
                        <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-500"
                            x-transition:enter-start="opacity-0 scale-x-0"
                            x-transition:enter-end="opacity-100 scale-x-100"
                            class="h-1.5 w-24 bg-indigo-500 rounded-full origin-left"></div>
                    </div>
                </div>
            </div>
        </div>

        <main class="max-w-7xl mx-auto px-6 -mt-20 relative z-20">
            <section class="py-16">
                <div class="flex flex-col items-center mb-16 text-center">
                    <div class="flex items-center gap-3 text-indigo-600 font-black uppercase tracking-[0.3em] text-[10px] mb-4">
                        <span class="w-8 h-[2px] bg-indigo-600"></span>
                        Cinema of Faith
                        <span class="w-8 h-[2px] bg-indigo-600"></span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight">Featured Miracles</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <template x-for="video in paginatedVideos" :key="video.id">
                        <div x-data="{ playing: false }"
                            class="group flex flex-col relative bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-[0_20px_50px_rgba(0,0,0,0.02)] hover:shadow-[0_40px_80px_rgba(99,102,241,0.12)] transition-all duration-700 h-full">

                            <div class="relative aspect-video overflow-hidden bg-slate-900">
                                <div x-show="!playing" class="absolute inset-0 z-10">
                                    <img :src="getPoster(video)"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s]">

                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/20 to-transparent opacity-60"></div>

                                    <button @click="playing = true"
                                        class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-16 h-16 bg-white/10 backdrop-blur-md border border-white/30 text-white rounded-full flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-all duration-500">
                                            <div class="w-10 h-10 bg-white text-indigo-600 rounded-full flex items-center justify-center shadow-xl">
                                                <i data-lucide="play" class="w-4 h-4 fill-current translate-x-0.5"></i>
                                            </div>
                                        </div>
                                    </button>

                                    <div class="absolute top-3 left-3">
                                        <div class="px-2.5 py-1 bg-indigo-600/90 backdrop-blur-sm border border-indigo-400/50 rounded-lg shadow-lg">
                                            <span class="text-[9px] font-black text-white uppercase tracking-wider" x-text="video.group"></span>
                                        </div>
                                    </div>
                                </div>

                                <template x-if="playing">
                                    <div class="w-full h-full">
                                        <template x-if="getYouTubeID(video.video_url)">
                                            <iframe class="w-full h-full" :src="`https://www.youtube.com/embed/${getYouTubeID(video.video_url)}?autoplay=1`" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        </template>
                                        <template x-if="!getYouTubeID(video.video_url)">
                                            <video class="w-full h-full object-cover" controls autoplay controlsList="nodownload" oncontextmenu="return false">
                                                <source :src="video.video_url" type="video/mp4">
                                            </video>
                                        </template>
                                    </div>
                                </template>
                            </div>

                            <div class="p-8 flex flex-col flex-grow">
                                <div class="flex items-center gap-2 mb-3 text-indigo-500">
                                    <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                                    <span class="text-[10px] font-bold uppercase tracking-tighter">Verified Testimony</span>
                                </div>
                                <h3 class="text-xl font-black text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors"
                                    x-text="video.name"></h3>
                                <p class="text-slate-500 text-sm leading-relaxed font-medium italic"
                                    x-text="`“${video.content}”`"></p>
                            </div>
                        </div>
                    </template>
                </div>

                <div x-show="videoLimit < videoTestimonies.length" class="mt-16 flex justify-center">
                    <button @click="videoLimit += 3; refreshIcons()"
                        class="px-8 py-4 bg-white border border-slate-200 rounded-2xl font-black text-xs uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:border-indigo-200 transition-all">
                        Load More Videos
                    </button>
                </div>
            </section>

            <section class="py-24">
                <div class="flex flex-col items-center mb-16 text-center">
                    <div class="flex items-center gap-3 text-slate-400 font-black uppercase tracking-[0.3em] text-[10px] mb-4">
                        <span class="w-8 h-[1px] bg-slate-200"></span>
                        The Written Testimonies
                        <span class="w-8 h-[1px] bg-slate-200"></span>
                    </div>
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight">Stories of God's Love</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <template x-for="testimony in paginatedText" :key="testimony.id">
                        <div class="group h-full">
                            <div class="relative bg-white p-10 rounded-[3rem] border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.02)] hover:border-indigo-100 hover:shadow-[0_30px_60px_rgba(99,102,241,0.08)] transition-all duration-500 group-hover:-translate-y-3 h-full flex flex-col">
                                <div class="absolute top-8 right-10">
                                    <i data-lucide="quote" class="w-12 h-12 text-slate-50 group-hover:text-indigo-50 transition-colors"></i>
                                </div>

                                <div class="relative z-10 flex flex-col h-full">
                                    <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center mb-8">
                                        <i data-lucide="feather" class="w-5 h-5 text-indigo-600"></i>
                                    </div>

                                    <p class="text-slate-600 leading-relaxed text-lg mb-10 font-medium flex-grow" x-text="testimony.content"></p>

                                    <div class="flex items-center gap-4 pt-8 border-t border-slate-50 mt-auto">
                                        <div class="relative">
                                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-indigo-100"
                                                x-text="testimony.name.charAt(0)"></div>
                                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 border-2 border-white rounded-full flex items-center justify-center">
                                                <i data-lucide="check" class="w-3 h-3 text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="font-black text-slate-900 text-base leading-tight" x-text="testimony.name"></h4>
                                            <div class="flex items-center gap-1.5 mt-1">
                                                <i data-lucide="map-pin" class="w-3 h-3 text-indigo-400"></i>
                                                <p class="text-[10px] text-indigo-500 font-black uppercase tracking-widest" x-text="testimony.group"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <div x-show="textLimit < textTestimonies.length" class="mt-16 flex justify-center">
                    <button @click="textLimit += 3; refreshIcons()"
                        class="px-8 py-4 bg-white border border-slate-200 rounded-2xl font-black text-xs uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:border-indigo-200 transition-all">
                        Load More Stories
                    </button>
                </div>
            </section>
        </main>

        <div x-show="modalOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-6" x-cloak>
            <div x-show="modalOpen" x-transition.opacity @click="modalOpen = false"
                class="absolute inset-0 bg-slate-900/80 backdrop-blur-xl"></div>

            <div x-show="modalOpen" x-transition:enter="transition ease-out duration-500 transform"
                x-transition:enter-start="opacity-0 translate-y-20 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                class="bg-white w-full max-w-2xl rounded-[2.5rem] md:rounded-[3rem] shadow-2xl relative z-10 overflow-hidden max-h-[90vh] flex flex-col">

                <div class="p-8 md:p-12 overflow-y-auto custom-scrollbar">
                    <div class="flex justify-between items-start mb-8 md:mb-10">
                        <div>
                            <div class="flex items-center gap-2 text-indigo-600 mb-2">
                                <i data-lucide="heart" class="w-5 h-5 fill-current"></i>
                                <span class="font-black text-xs uppercase tracking-widest">Contribute</span>
                            </div>
                            <h3 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tighter">Tell Your Story</h3>
                        </div>
                        <button @click="modalOpen = false"
                            class="p-3 bg-slate-50 hover:bg-red-50 hover:text-red-500 rounded-2xl transition-all text-slate-400">
                            <i data-lucide="x" class="w-6 h-6"></i>
                        </button>
                    </div>

                    <form @submit.prevent="submitTestimonyUI" class="space-y-6 md:space-y-8">
                        <template x-if="getYouTubeID(form.video_url)">
                            <div class="relative rounded-[1.5rem] md:rounded-[2rem] overflow-hidden group border-4 border-indigo-50">
                                <img :src="`https://img.youtube.com/vi/${getYouTubeID(form.video_url)}/maxresdefault.jpg`"
                                    class="w-full aspect-video object-cover">
                                <div class="absolute inset-0 bg-indigo-600/20 flex items-center justify-center">
                                    <div class="bg-white/90 backdrop-blur px-4 py-2 rounded-full flex items-center gap-2">
                                        <i data-lucide="video" class="w-4 h-4 text-indigo-600"></i>
                                        <span class="text-[10px] font-black uppercase text-indigo-600 tracking-widest">Preview Detected</span>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Full Name</label>
                                <input type="text" x-model="form.name" required
                                    class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-100 focus:bg-white rounded-[1.2rem] md:rounded-[1.5rem] px-6 py-4 focus:ring-0 transition-all">
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Group</label>
                                <input type="text" x-model="form.group" required
                                    class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-100 focus:bg-white rounded-[1.2rem] md:rounded-[1.5rem] px-6 py-4 focus:ring-0 transition-all">
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">YouTube Link (Optional)</label>
                            <div class="relative">
                                <i data-lucide="link" class="absolute left-6 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-300"></i>
                                <input type="url" x-model="form.video_url" placeholder="https://youtube.com/..."
                                    class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-100 focus:bg-white rounded-[1.2rem] md:rounded-[1.5rem] pl-14 pr-6 py-4 focus:ring-0 transition-all">
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Your Story</label>
                            <textarea x-model="form.content" required rows="4"
                                class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-100 focus:bg-white rounded-[1.5rem] md:rounded-[2rem] px-6 py-5 focus:ring-0 transition-all resize-none"></textarea>
                        </div>

                        <button type="submit" :disabled="loading"
                            class="w-full group bg-indigo-600 hover:bg-indigo-700 text-white py-5 md:py-6 rounded-[1.2rem] md:rounded-[1.5rem] font-black text-base md:text-lg transition-all shadow-xl shadow-indigo-100 flex items-center justify-center gap-3">
                            <i data-lucide="send" class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                            <span x-text="loading ? 'Processing...' : 'Submit Testimony'"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>

    <script src="https://unpkg.com/lucide@latest"></script>
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

                posters: {
                    'Kemi': '/images/kemi.png',
                    'Precious': '/images/precious.png',
                    'Oluwaseun': '/images/seun.png'
                },

                videoTestimonies: @json($videoTestimonies),
                textTestimonies: @json($textTestimonies),

                videoLimit: 3,
                textLimit: 3,

                get paginatedVideos() {
                    return this.videoTestimonies.slice(0, this.videoLimit);
                },

                get paginatedText() {
                    return this.textTestimonies.slice(0, this.textLimit);
                },

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

                getPoster(video) {
                    for (const key in this.posters) {
                        if (video.name.toLowerCase().includes(key.toLowerCase())) {
                            return this.posters[key];
                        }
                    }
                    const ytId = this.getYouTubeID(video.video_url);
                    if (ytId) return `https://img.youtube.com/vi/${ytId}/maxresdefault.jpg`;
                    return '/images/video-placeholder.jpg';
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
                            this.modalOpen = false;
                            this.form = { name: '', group: '', content: '', video_url: '' };
                            this.showToast = true;
                            this.refreshIcons();
                            setTimeout(() => this.showToast = false, 5000);
                        } else {
                            alert(result.message || 'Validation failed.');
                        }
                    } catch (error) {
                        alert('A connection error occurred.');
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }
    </script>
</x-app-layout>
