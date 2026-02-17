<div class="space-y-10">
    <div class="flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Analytics Overview</h2>
            <p class="text-slate-500">Monitoring engagement</p>
        </div>
        <div class="bg-slate-100 p-1 rounded-xl flex items-center">
            <button class="px-4 py-2 text-sm font-bold bg-white rounded-lg shadow-sm">Weekly</button>
            <button class="px-4 py-2 text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors">Monthly</button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center gap-5 shadow-sm">
            <div class="w-12 h-12 bg-indigo-50 rounded-full flex items-center justify-center">
                <i data-lucide="users" class="text-indigo-500 w-6 h-6"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-900">12,840</p>
                <p class="text-xs text-slate-400 font-semibold uppercase">Total Members</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center gap-5 shadow-sm">
            <div class="w-12 h-12 bg-red-50 rounded-full flex items-center justify-center">
                <i data-lucide="play" class="text-red-500 w-6 h-6"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-900">3,102</p>
                <p class="text-xs text-slate-400 font-semibold uppercase">Active Streams</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200 flex items-center gap-5 shadow-sm">
            <div class="w-12 h-12 bg-amber-50 rounded-full flex items-center justify-center">
                <i data-lucide="heart" class="text-amber-500 w-6 h-6"></i>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-900">14</p>
                <p class="text-xs text-slate-400 font-semibold uppercase">Testimonies</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm h-[400px]">
            <canvas id="attendanceChart"></canvas>
        </div>

        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col items-center justify-center relative">
            <div class="relative w-48 h-48 flex items-center justify-center">
                <svg class="w-full h-full transform -rotate-90">
                    <circle cx="96" cy="96" r="80" stroke="#F1F5F9" stroke-width="20" fill="transparent" />
                    <circle cx="96" cy="96" r="80" stroke="#6366F1" stroke-width="20" fill="transparent" stroke-dasharray="502" stroke-dashoffset="180" stroke-linecap="round" />
                </svg>
                <div class="absolute text-center">
                    <span class="text-3xl font-black text-slate-900">12.8k</span>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Goal</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 grid grid-cols-2 gap-4">
            <button class="bg-blue-50/50 p-4 rounded-2xl border border-blue-100 flex items-center gap-4 hover:bg-blue-50 transition-colors">
                <i data-lucide="video" class="text-blue-500 w-5 h-5"></i>
                <span class="font-bold text-slate-800">Meeting</span>
            </button>
            <button class="bg-pink-50/50 p-4 rounded-2xl border border-pink-100 flex items-center gap-4 hover:bg-pink-50 transition-colors">
                <i data-lucide="film" class="text-pink-500 w-5 h-5"></i>
                <span class="font-bold text-slate-800">Content</span>
            </button>
            <button class="bg-green-50/50 p-4 rounded-2xl border border-green-100 flex items-center gap-4 hover:bg-green-50 transition-colors">
                <i data-lucide="layout" class="text-green-500 w-5 h-5"></i>
                <span class="font-bold text-slate-800">Layout</span>
            </button>
            <button class="bg-slate-50 p-4 rounded-2xl border border-slate-200 flex items-center gap-4 hover:bg-slate-100 transition-colors">
                <i data-lucide="settings" class="text-slate-500 w-5 h-5"></i>
                <span class="font-bold text-slate-800">Settings</span>
            </button>
        </div>

        <div class="bg-[#0F172A] p-6 rounded-[2rem] flex items-center gap-4">
            <div class="w-10 h-10 bg-green-500/10 rounded-full flex items-center justify-center">
                <i data-lucide="shield-check" class="text-green-500 w-6 h-6"></i>
            </div>
            <span class="text-white font-bold">System Secure</span>
        </div>
    </div>
</div>