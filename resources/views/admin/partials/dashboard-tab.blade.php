<div class="p-6 lg:p-10 bg-slate-50 min-h-screen">
    @if (app()->environment('production') && config('services.google.analytics_id'))
        @include('admin.partials.analytics')
    @endif

    <div class="max-w-7xl mx-auto space-y-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol
                        class="flex items-center space-x-2 text-xs font-semibold uppercase tracking-wider text-slate-400">
                        <li>Admin</li>
                        <li><i data-lucide="chevron-right" class="w-3 h-3"></i></li>
                        <li class="text-indigo-600">Analytics</li>
                    </ol>
                </nav>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Engagement Overview</h2>
                <p class="text-slate-500 font-medium">Insights for the last
                    {{ ($filter ?? 'weekly') === 'monthly' ? '30 days' : '7 days' }}</p>
            </div>

            <div class="bg-white p-1.5 rounded-2xl border border-slate-200 shadow-sm flex items-center">
                <a href="{{ route('admin.analytics', ['filter' => 'weekly']) }}"
                    class="px-6 py-2.5 text-sm font-bold rounded-xl transition-all duration-200 {{ ($filter ?? 'weekly') !== 'monthly' ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                    Weekly
                </a>
                <a href="{{ route('admin.analytics', ['filter' => 'monthly']) }}"
                    class="px-6 py-2.5 text-sm font-bold rounded-xl transition-all duration-200 {{ ($filter ?? 'weekly') === 'monthly' ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                    Monthly
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="group bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="eye" class="text-indigo-600 w-7 h-7"></i>
                    </div>
                    <span class="text-green-500 text-xs font-bold bg-green-50 px-2 py-1 rounded-lg">+12.5%</span>
                </div>
                <p class="text-3xl font-black text-slate-900">{{ number_format($totalViews ?? 0) }}</p>
                <p class="text-sm text-slate-400 font-bold uppercase tracking-widest mt-1">Total Impressions</p>
            </div>

            <div
                class="group bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="zap" class="text-blue-600 w-7 h-7"></i>
                    </div>
                    <span class="flex items-center gap-1 text-blue-500 text-xs font-bold">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                        </span> Live
                    </span>
                </div>
                <p class="text-3xl font-black text-slate-900">{{ number_format($activeStreams ?? 0) }}</p>
                <p class="text-sm text-slate-400 font-bold uppercase tracking-widest mt-1">Active Visitors</p>
            </div>

            <div
                class="group bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-rose-500/5 transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="w-14 h-14 bg-rose-50 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="heart" class="text-rose-600 w-7 h-7"></i>
                    </div>
                </div>
                <p class="text-3xl font-black text-slate-900">{{ $testimoniesCount ?? 0 }}</p>
                <p class="text-sm text-slate-400 font-bold uppercase tracking-widest mt-1">Community Feedback</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div
                class="lg:col-span-2 bg-white p-8 rounded-[3rem] border border-slate-200 shadow-sm relative overflow-hidden">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-bold text-slate-900">Traffic Distribution</h3>
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-400">
                        <span class="w-3 h-3 bg-indigo-500 rounded-full"></span> Page Views
                    </div>
                </div>
                <div class="h-[320px]">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>

            <div
                class="bg-slate-900 p-8 rounded-[3rem] shadow-2xl flex flex-col items-center justify-center text-center relative overflow-hidden group">
                <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-indigo-500/10 rounded-full blur-3xl">
                </div>

                <h3 class="text-white font-bold mb-6">Monthly Target</h3>
                <div class="relative w-52 h-52 flex items-center justify-center">
                    <svg class="w-full h-full transform -rotate-90">
                        <circle cx="104" cy="104" r="85" stroke="rgba(255,255,255,0.05)" stroke-width="16"
                            fill="transparent" />
                        <circle cx="104" cy="104" r="85" stroke="#6366F1" stroke-width="16"
                            fill="transparent" stroke-dasharray="534"
                            stroke-dashoffset="{{ 534 - (534 * ($progressPercent ?? 0)) / 100 }}" stroke-linecap="round"
                            class="transition-all duration-1000 ease-out drop-shadow-[0_0_8px_rgba(99,102,241,0.5)]" />
                    </svg>
                    <div class="absolute text-center">
                        <span class="text-4xl font-black text-white">{{ $goalLabel ?? '0' }}</span>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em]">Achieved</p>
                    </div>
                </div>
                <p class="mt-6 text-slate-400 text-sm font-medium px-4 leading-relaxed">
                    You are <span class="text-white font-bold">{{ $progressPercent ?? 0 }}%</span> closer to your
                    monthly engagement goal.
                </p>
            </div>
        </div>

        @if (session('error'))
            <div
                class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-600 rounded-2xl flex items-center gap-3 animate-bounce">
                <i data-lucide="alert-circle" class="w-5 h-5"></i>
                <span class="font-bold text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <div
            class="bg-indigo-600 rounded-[2.5rem] p-4 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl shadow-indigo-200">
            <div class="flex items-center gap-4 pl-4 text-white">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-md">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="font-bold leading-tight">System Integrity Secure</p>
                    <p class="text-xs text-indigo-100 opacity-80">Last synced: Just now</p>
                </div>
            </div>
            <div class="flex items-center gap-2 pr-2">
                <a href="{{ route('admin.analytics.export', ['filter' => $filter ?? 'weekly']) }}" download
                    target="_self"
                    class="px-6 py-3 bg-white text-indigo-600 font-bold rounded-2xl hover:scale-105 transition-all shadow-lg flex items-center gap-2">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    Generate Report
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const labels = {!! json_encode($dates ?? []) !!};
        const dataValues = {!! json_encode($views ?? []) !!};

        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.25)');
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
                    borderWidth: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6366F1',
                    pointBorderWidth: 3,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0F172A',
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        padding: 16,
                        cornerRadius: 12,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        grid: {
                            color: '#F1F5F9',
                            borderDash: [5, 5]
                        },
                        ticks: {
                            color: '#94A3B8',
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94A3B8',
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    }
                }
            }
        });
    });
</script>
