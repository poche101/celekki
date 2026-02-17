@props([
    'videoUrl',
    'thumbnailUrl' => null,
    'title' => 'Untitled Video',
    'description' => '',
    'category' => 'Tutorial',
    'duration' => '0:00'
])

<div {{ $attributes->merge(['class' => 'group relative overflow-hidden rounded-2xl bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl border border-slate-100']) }}>

    {{-- Video Container --}}
    <div class="relative aspect-video overflow-hidden">
        {{-- Custom Video Player --}}
        <video
            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
            poster="{{ $thumbnailUrl }}"
            controls
            preload="metadata">
            <source src="{{ $videoUrl }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        {{-- Top Badge & Duration --}}
        <div class="absolute inset-x-0 top-0 flex justify-between p-4 opacity-100 transition-opacity duration-300 group-hover:opacity-0">
            <span class="rounded-full bg-white/90 px-3 py-1 text-xs font-bold uppercase tracking-wider text-slate-800 backdrop-blur-md">
                {{ $category }}
            </span>
            <span class="rounded-lg bg-slate-900/60 px-2 py-1 text-xs font-medium text-white backdrop-blur-md">
                {{ $duration }}
            </span>
        </div>
    </div>

    {{-- Content Section --}}
    <div class="p-5">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-lg font-bold leading-tight text-slate-900 transition-colors group-hover:text-indigo-600">
                    {{ $title }}
                </h3>
                <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-slate-600">
                    {{ $description }}
                </p>
            </div>
        </div>

        {{-- Footer/Actions --}}
        <div class="mt-6 flex items-center justify-between border-t border-slate-50 pt-4">
            <div class="flex items-center space-x-3">
                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                </div>
                <span class="text-xs font-semibold text-slate-500">Admin</span>
            </div>
            <button class="flex items-center gap-1 text-xs font-bold text-indigo-600 hover:text-indigo-700">
                WATCH NOW
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</div>
