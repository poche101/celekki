<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - CE Lagos Zone 5</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>

<div class="flex h-screen bg-[#F1F5F9] font-sans overflow-hidden"
     x-data="{ selectedIndex: $persist(0) }"
     x-init="$nextTick(() => lucide.createIcons())">

    <aside class="w-64 bg-[#0A192F] flex flex-col shrink-0">
        <div class="p-8 flex items-center gap-3">
            <div class="w-8 h-8 flex items-center justify-center bg-amber-500 rounded-lg">
                <i data-lucide="layout-template" class="text-white w-5 h-5"></i>
            </div>
            <span class="text-white text-lg font-black tracking-widest uppercase">Admin</span>
        </div>

        <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">
            <template x-for="(item, index) in [
                { label: 'Dashboard', icon: 'layout-dashboard' },      /* 0 */
                { label: 'Blog Posts', icon: 'file-text' },           /* 1 */
                { label: 'Testimonies', icon: 'heart-handshake' },    /* 2 */
                { label: 'Events', icon: 'calendar' },                 /* 3 */
                { label: 'Higher Life Videos', icon: 'video' },        /* 4 */
                { label: 'Live Stream', icon: 'radio' },              /* 5 */
                { label: 'Members', icon: 'users' }                   /* 6 */
            ]" :key="index">
                <button
                    @click="selectedIndex = index; $nextTick(() => lucide.createIcons());"
                    class="w-full flex items-center px-4 py-3 rounded-xl transition-all duration-200"
                    :class="selectedIndex === index ? 'bg-white/10 text-white' : 'text-white/60 hover:text-white hover:bg-white/5'">
                    <i :data-lucide="item.icon" class="w-5 h-5 mr-4" :class="selectedIndex === index ? 'text-amber-500' : ''"></i>
                    <span class="text-sm font-semibold" x-text="item.label"></span>
                </button>
            </template>
        </nav>

        <div class="p-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-white/60 hover:text-white rounded-xl transition-colors">
                    <i data-lucide="log-out" class="w-5 h-5 mr-4"></i>
                    <span class="text-sm font-semibold">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-20 bg-white border-b border-slate-200 px-10 flex items-center justify-between shrink-0">
            <div>
                <h1 class="text-lg font-bold text-slate-900">Welcome back, Admin</h1>
                <p class="text-xs text-slate-500 font-medium">CE Lagos Zone 5 Dashboard</p>
            </div>

            <div class="flex items-center gap-6">
                <div class="w-9 h-9 bg-[#0A192F] rounded-full flex items-center justify-center">
                    <i data-lucide="user" class="text-white w-4 h-4"></i>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto bg-[#F8FAFC] p-6">
            <div x-show="selectedIndex === 0" x-transition.opacity.duration.300ms x-cloak>
                @include('admin.partials.dashboard-tab')
            </div>

            <div x-show="selectedIndex === 1" x-transition.opacity.duration.300ms x-cloak>
                @include('admin.tabs.blog-posts')
            </div>

            <div x-show="selectedIndex === 2" x-transition.opacity.duration.300ms x-cloak>
                @include('admin.tabs.testimonies')
            </div>

            <div x-show="selectedIndex === 3" x-transition.opacity.duration.300ms x-cloak>
                @include('admin.tabs.events')
            </div>

            <div x-show="selectedIndex === 4" x-transition.opacity.duration.300ms x-cloak>
                @include('admin.tabs.h-life')
            </div>

            <div x-show="selectedIndex === 5" x-transition.opacity.duration.300ms x-cloak>
                @include('admin.tabs.live-stream')
            </div>

            <div x-show="selectedIndex === 6" x-transition.opacity.duration.300ms x-cloak>
                @include('admin.tabs.members')
            </div>

            <div x-show="![0,1,2,3,4,5,6].includes(selectedIndex)" x-transition.opacity.duration.300ms class="p-10" x-cloak>
                <div class="bg-white p-20 rounded-3xl text-center border border-slate-200 shadow-sm">
                    <i data-lucide="construction" class="w-12 h-12 text-slate-300 mx-auto mb-4"></i>
                    <h2 class="text-xl font-bold text-slate-800" x-text="'Tab Content for ' + selectedIndex + ' Coming Soon'"></h2>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    lucide.createIcons();
</script>
<style>
    [x-cloak] { display: none !important; }
</style>
</body>
</html>
