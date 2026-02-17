<x-app-layout>
    <div class="bg-gray-900 min-h-screen text-gray-100 py-10" x-data="{
        activeVideo: '',
        activeTitle: 'Loading...',
        activeEpisode: '',
        activeDate: '',

        currentPage: 1,
        itemsPerPage: 5,
        videos: [], // Initially empty

        async fetchVideos() {
            try {
                const response = await fetch('/api/videos');
                const result = await response.json();
                this.videos = result.data;

                // Set the first video as active by default if archive is not empty
                if (this.videos.length > 0) {
                    const first = this.videos[0];
                    this.playVideo(first.video_path, first.title, `Episode ${first.episode}`, first.created_at);
                }
            } catch (error) {
                console.error('Failed to load archive:', error);
            }
        },

        get paginatedVideos() {
            let start = (this.currentPage - 1) * this.itemsPerPage;
            let end = start + this.itemsPerPage;
            return this.videos.slice(start, end);
        },

        get totalPages() {
            return Math.ceil(this.videos.length / this.itemsPerPage) || 1;
        },

        playVideo(url, title, ep, date) {
            this.activeVideo = url;
            this.activeTitle = title;
            this.activeEpisode = ep;
            // Formatting the date for display
            this.activeDate = new Date(date).toLocaleDateString('en-US', {
                month: 'short', day: 'numeric', year: 'numeric'
            });
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }" x-init="fetchVideos()"> <div class="container mx-auto px-4 lg:px-8">
            <header class="mb-8">
                <h1 class="text-3xl font-bold tracking-tight text-white flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.934a.5.5 0 0 0-.777-.416L16 11"></path><rect width="14" height="12" x="2" y="6" rx="2"></rect></svg>
                    Watch The Higher Life
                </h1>
                <p class="text-gray-400 mt-2">With Pastor Deola Phillips</p>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="relative rounded-2xl overflow-hidden bg-black shadow-2xl border border-gray-800">
                        <video
                            x-ref="videoPlayer"
                            :src="activeVideo"
                            controls
                            autoplay
                            controlsList="nodownload"
                            oncontextmenu="return false;"
                            class="w-full aspect-video object-cover">
                        </video>
                    </div>

                    <div class="mt-6">
                        <div class="flex items-center gap-3 text-indigo-400 font-medium text-sm mb-1">
                            <span x-text="activeEpisode"></span>
                            <span class="w-1 h-1 rounded-full bg-gray-600"></span>
                            <span x-text="activeDate"></span>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold text-white" x-text="activeTitle"></h2>
                    </div>
                </div>

                <div class="lg:col-span-1 flex flex-col">
                    <h3 class="text-lg font-semibold mb-4 flex items-center justify-between">
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"></rect><rect width="7" height="7" x="14" y="3" rx="1"></rect><rect width="7" height="7" x="14" y="14" rx="1"></rect><rect width="7" height="7" x="3" y="14" rx="1"></rect></svg>
                            Up Next
                        </span>
                        <span class="text-xs text-gray-500 font-normal" x-text="`Page ${currentPage} of ${totalPages}`"></span>
                    </h3>

                    <div class="space-y-4 mb-6">
                        <template x-for="video in paginatedVideos" :key="video.id">
                            <button
                                @@click="playVideo(video.video_path, video.title, `Episode ${video.episode}`, video.created_at)"
                                class="flex w-full text-left group gap-4 p-3 rounded-xl transition-all duration-300 hover:bg-gray-800 border border-transparent hover:border-gray-700"
                                :class="activeTitle === video.title ? 'bg-gray-800/50 border-gray-700 ring-1 ring-indigo-500/30' : ''">

                                <div class="relative flex-shrink-0 w-32 aspect-video rounded-lg overflow-hidden shadow-lg bg-gray-800">
                                    <img :src="video.poster_url" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Thumbnail">
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>

                                <div class="flex flex-col justify-center overflow-hidden">
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-400 mb-1" x-text="`Ep. ${video.episode}`"></span>
                                    <h4 class="text-sm font-semibold text-white line-clamp-2 leading-snug group-hover:text-indigo-300 transition-colors" x-text="video.title"></h4>
                                    <p class="text-[11px] text-gray-500 mt-1" x-text="new Date(video.created_at).toLocaleDateString()"></p>
                                </div>
                            </button>
                        </template>
                    </div>

                    <div class="flex items-center justify-center gap-2 mt-auto py-4 border-t border-gray-800">
                        <button
                            @@click="currentPage > 1 ? currentPage-- : null"
                            :disabled="currentPage === 1"
                            class="p-2 rounded-lg bg-gray-800 hover:bg-gray-700 disabled:opacity-30 disabled:cursor-not-allowed transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        </button>

                        <div class="flex gap-1">
                            <template x-for="p in totalPages" :key="p">
                                <button
                                    @@click="currentPage = p"
                                    class="w-8 h-8 rounded-lg text-xs font-bold transition-all"
                                    :class="currentPage === p ? 'bg-indigo-600 text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700'"
                                    x-text="p">
                                </button>
                            </template>
                        </div>

                        <button
                            @@click="currentPage < totalPages ? currentPage++ : null"
                            :disabled="currentPage === totalPages"
                            class="p-2 rounded-lg bg-gray-800 hover:bg-gray-700 disabled:opacity-30 disabled:cursor-not-allowed transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
