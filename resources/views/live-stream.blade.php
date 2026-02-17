@php
    // Use the direct link provided in the database (e.g., .mp4 or .m3u8)
    $videoUrl = $stream->stream_link ?? ''; 
@endphp

<x-app-layout>
    <div x-data="liveStream({
            isLive: {{ $stream->is_live ? 'true' : 'false' }},
            videoUrl: '{{ $videoUrl }}'
         })"
         class="min-h-screen bg-[#fafafa] font-sans antialiased text-slate-900">

        <br><br>

        <main class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-20">

                <div class="lg:col-span-8 space-y-8 lg:space-y-16">
                    <div class="relative group shadow-[0_48px_100px_rgba(0,0,0,0.12)] rounded-[24px] lg:rounded-[40px] overflow-hidden bg-black aspect-video ring-1 ring-slate-200">
                        
                        <template x-if="status === 'live'">
                            <div class="absolute top-4 left-4 lg:top-8 lg:left-8 z-20 flex items-center gap-2.5 bg-red-600 px-3 py-1 lg:px-4 lg:py-1.5 rounded-full shadow-2xl">
                                <span class="w-1.5 h-1.5 lg:w-2 lg:h-2 rounded-full bg-white animate-pulse"></span>
                                <span class="text-[9px] lg:text-[10px] font-black text-white uppercase tracking-widest">Live</span>
                            </div>
                        </template>

                        <div class="w-full h-full" wire:ignore>
                            <video 
                                id="broadcast-player" 
                                class="video-js vjs-big-play-centered vjs-fluid w-full h-full"
                                controls 
                                preload="auto" 
                                playsinline
                                data-setup='{}'>
                                <source src="{{ $videoUrl }}" type="application/x-mpegURL">
                                <p class="vjs-no-js">To view this broadcast, please enable JavaScript.</p>
                            </video>
                        </div>
                    </div>

                    <div class="max-w-5xl flex flex-col lg:flex-row lg:items-end justify-between gap-8 lg:gap-10">
                        <div class="relative flex-1">
                            <span class="inline-block px-4 py-1.5 mb-4 lg:mb-6 rounded-full bg-slate-900 text-[10px] font-black uppercase tracking-[0.3em] text-white">
                                Special Broadcast
                            </span>
                            <h4 class="text-2xl sm:text-2xl lg:text-4xl font-black tracking-[-0.04em] text-slate-900 leading-[0.95]">
                                {{ $stream->title }}
                            </h4>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center rounded-[24px] lg:rounded-[32px] bg-white border border-slate-200/60 p-2 shadow-[0_8px_30px_rgb(0,0,0,0.04)] backdrop-blur-sm h-fit w-full lg:w-auto">
                            <div class="flex items-center gap-4 pl-4 pr-6 lg:pl-6 lg:pr-10 py-3 whitespace-nowrap border-b sm:border-b-0 sm:border-r border-slate-100 w-full sm:w-auto">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-slate-900 blur-xl opacity-10 rounded-full"></div>
                                    <div class="relative w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center bg-slate-900 rounded-2xl text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2" /><line x1="16" x2="16" y1="2" y2="6" /><line x1="8" x2="8" y1="2" y2="6" /><line x1="3" x2="21" y1="10" y2="10" /></svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[9px] lg:text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-0.5">Air Date</p>
                                    <p class="text-[13px] lg:text-[15px] font-bold text-slate-900 italic">
                                        {{ \Carbon\Carbon::parse($stream->scheduled_date)->format('F d, Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 pl-4 pr-6 lg:pl-6 lg:pr-10 py-3 whitespace-nowrap w-full sm:w-auto">
                                <div class="w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center bg-slate-50 border border-slate-100 rounded-2xl text-slate-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" /></svg>
                                </div>
                                <div>
                                    <p class="text-[9px] lg:text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-0.5">Schedule</p>
                                    <span class="text-[13px] lg:text-[15px] font-bold text-slate-900 uppercase">
                                        {{ \Carbon\Carbon::parse($stream->scheduled_time)->format('h:i A') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-comments />
            </div>
        </main>
    </div>

    @push('styles')
        <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
        <style>
            /* Customizing Video.js to match your sleek UI */
            .video-js {
                width: 100% !important;
                height: 100% !important;
                border-radius: inherit;
            }
            .vjs-big-play-button {
                top: 50% !important;
                left: 50% !important;
                transform: translate(-50%, -50%) !important;
                background-color: rgba(15, 23, 42, 0.9) !important;
                border: none !important;
                width: 80px !important;
                height: 80px !important;
                line-height: 80px !important;
                border-radius: 50% !important;
            }
            .vjs-control-bar {
                background: rgba(15, 23, 42, 0.7) !important;
                backdrop-filter: blur(10px);
            }
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .custom-scrollbar::-webkit-scrollbar { width: 4px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        </style>
    @endpush

    @push('scripts')
        <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
        <script>
            function liveStream(config) {
                return {
                    status: config.isLive ? 'live' : 'offline',
                    videoUrl: config.videoUrl,
                    player: null,

                    init() {
                        this.$nextTick(() => {
                            this.initPlayer();
                        });
                    },

                    initPlayer() {
                        this.player = videojs('broadcast-player', {
                            autoplay: this.status === 'live',
                            muted: this.status === 'live', // Autoplay often requires mute
                            controls: true,
                            responsive: true,
                            fluid: true
                        });

                        // Set source dynamically if needed
                        if (this.videoUrl) {
                            const isHLS = this.videoUrl.includes('.m3u8');
                            this.player.src({
                                src: this.videoUrl,
                                type: isHLS ? 'application/x-mpegURL' : 'video/mp4'
                            });
                        }
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>