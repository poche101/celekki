
@section('content')
<div class="min-h-screen bg-[#F8FAFC] p-6 lg:p-10">
    {{-- Google Analytics Script --}}
    @if(app()->environment('production') && config('services.google.analytics_id'))
        @include('partials.analytics')
    @endif

    <div class="max-w-7xl mx-auto space-y-10">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
            <div class="animate-in fade-in slide-in-from-left duration-700">
                <nav class="flex mb-3" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 text-xs font-bold uppercase tracking-[0.15em] text-slate-400">
                        <li>Admin</li>
                        <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-300"></i></li>
                        <li class="text-indigo-600">Analytics</li>
                    </ol>
                </nav>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight leading-none">
                    Engagement Overview
                </h2>
                <p class="text-slate-500 font-medium mt-2 flex items-center gap-2">
                    <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i>
                    Real-time insights for the last {{ ($filter ?? 'weekly') === 'monthly' ? '30 days' : '7 days' }}
                </p>
            </div>

            <div class="bg-white/60 backdrop-blur-md p-1.5 rounded-2xl border border-slate-200 shadow-sm flex items-center group">
                <a href="{{ route('admin.analytics', ['filter' => 'weekly']) }}"
                   class="px-8 py-3 text-sm font-bold rounded-xl transition-all duration-300 {{ ($filter ?? 'weekly') !== 'monthly' ? 'bg-slate-900 text-white shadow-xl scale-105' : 'text-slate-500 hover:text-slate-900' }}">
                    Weekly
                </a>
                <a href="{{ route('admin.analytics', ['filter' => 'monthly']) }}"
                   class="px-8 py-3 text-sm font-bold rounded-xl transition-all duration-300 {{ ($filter ?? 'weekly') === 'monthly' ? 'bg-slate-900 text-white shadow-xl scale-105' : 'text-slate-500 hover:text-slate-900' }}">
                    Monthly
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-500">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center group-hover:bg-indigo-600 group-hover:rotate-6 transition-all duration-500">
                        <i data-lucide="eye" class="text-indigo-600 group-hover:text-white w-7 h-7"></i>
                    </div>
                    <span class="text-emerald-600 text-xs font-black bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-100">+12.5%</span>
                </div>
                <p class="text-4xl font-black text-slate-900 tracking-tighter">{{ number_format($totalViews ?? 0) }}</p>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-2">Total Impressions</p>
            </div>

            <div class="group bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-500">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center group-hover:bg-blue-600 group-hover:-rotate-6 transition-all duration-500">
                        <i data-lucide="zap" class="text-blue-600 group-hover:text-white w-7 h-7"></i>
                    </div>
                    <span class="flex items-center gap-1.5 text-blue-600 text-xs font-black bg-blue-50 px-3 py-1.5 rounded-full border border-blue-100">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                        </span> Live
                    </span>
                </div>
                <p class="text-4xl font-black text-slate-900 tracking-tighter">{{ number_format($activeStreams ?? 0) }}</p>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-2">Active Visitors</p>
            </div>

            <div class="group bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-2xl hover:shadow-rose-500/10 transition-all duration-500">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-14 h-14 bg-rose-50 rounded-2xl flex items-center justify-center group-hover:bg-rose-600 group-hover:scale-110 transition-all duration-500">
                        <i data-lucide="heart" class="text-rose-600 group-hover:text-white w-7 h-7"></i>
                    </div>
                </div>
                <p class="text-4xl font-black text-slate-900 tracking-tighter">{{ $testimoniesCount ?? 0 }}</p>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-2">Community Feedback</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white p-10 rounded-[3rem] border border-slate-200 shadow-sm relative overflow-hidden">
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Traffic Distribution</h3>
                        <p class="text-sm text-slate-400 font-medium">Daily page view trends</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="flex items-center gap-2 text-xs font-bold text-slate-500">
                            <span class="w-3 h-3 bg-indigo-500 rounded-full"></span> Views
                        </span>
                    </div>
                </div>
                <div class="h-[350px]">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>

            <div class="bg-[#0F172A] p-10 rounded-[3rem] shadow-2xl flex flex-col items-center justify-center text-center relative overflow-hidden group">
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-indigo-500/10 rounded-full blur-[80px]"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 bg-blue-500/10 rounded-full blur-[80px]"></div>

                <h3 class="text-white font-bold text-lg mb-8 tracking-tight">Growth Target</h3>
                <div class="relative w-56 h-56 flex items-center justify-center">
                    <svg class="w-full h-full transform -rotate-90">
                        <circle cx="112" cy="112" r="95" stroke="rgba(255,255,255,0.03)" stroke-width="16" fill="transparent" />
                        <circle cx="112" cy="112" r="95" stroke="#6366F1" stroke-width="16" fill="transparent"
                                stroke-dasharray="597"
                                stroke-dashoffset="{{ 597 - (597 * ($progressPercent ?? 0) / 100) }}"
                                stroke-linecap="round"
                                class="transition-all duration-[1500ms] ease-out drop-shadow-[0_0_12px_rgba(99,102,241,0.6)]"/>
                    </svg>
                    <div class="absolute flex flex-col items-center animate-in zoom-in duration-1000">
                        <span class="text-5xl font-black text-white tracking-tighter">{{ $goalLabel ?? '0' }}</span>
                        <p class="text-[10px] text-slate-500 font-black uppercase tracking-[0.3em] mt-1">Achieved</p>
                    </div>
                </div>
                <p class="mt-10 text-slate-400 text-sm font-medium leading-relaxed px-4">
                    Your platform is currently at <span class="text-white font-black">{{ $progressPercent ?? 0 }}%</span> of the monthly milestone.
                </p>
            </div>
        </div>

        <div class="bg-indigo-600 rounded-[2.5rem] p-5 flex flex-col md:flex-row items-center justify-between gap-6 shadow-2xl shadow-indigo-200">
            <div class="flex items-center gap-5 pl-4 text-white">
                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-xl border border-white/20">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-lg font-bold leading-tight tracking-tight">System Identity Verified</p>
                    <p class="text-xs text-indigo-100/70 font-medium">All data encrypted and synced with Google Cloud Console</p>
                </div>
            </div>
            <button class="group flex items-center gap-2 px-8 py-4 bg-white text-indigo-600 font-black rounded-[1.5rem] hover:bg-slate-50 transition-all duration-300 hover:shadow-xl active:scale-95">
                <i data-lucide="download" class="w-5 h-5 group-hover:translate-y-0.5 transition-transform"></i>
                Generate Intelligence Report
            </button>
        </div>
    </div>
</div>

{{-- External Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Icons
        lucide.createIcons();

        // Chart Configuration
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const labels = {!! json_encode($dates ?? []) !!};
        const dataValues = {!! json_encode($views ?? []) !!};

        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.28)');
        gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: '#6366F1',
                    borderWidth: 5,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6366F1',
                    pointBorderWidth: 4,
                    pointRadius: labels.length > 10 ? 3 : 6,
                    pointHoverRadius: 10,
                    pointHoverBorderWidth: 4,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { intersect: false, mode: 'index' },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0F172A',
                        titleFont: { size: 14, weight: '800', family: 'Inter' },
                        bodyFont: { size: 13, family: 'Inter' },
                        padding: 18,
                        cornerRadius: 16,
                        displayColors: false,
                        caretSize: 8
                    }
                },
                scales: {
                    y: {
                        grid: { color: '#F1F5F9', borderDash: [6, 6] },
                        ticks: { color: '#94A3B8', font: { size: 12, weight: '700' }, padding: 10 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94A3B8', font: { size: 12, weight: '700' }, padding: 10 }
                    }
                }
            }
        });
    });
</script>
@endsection
