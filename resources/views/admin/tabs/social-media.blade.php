<div class="space-y-8 pb-12">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Social Engagement</h2>
            <p class="text-slate-500 text-sm">Real-time tracking of viewers, prayers, and episode traffic.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.social.export') }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-all">
                <i data-lucide="download" class="w-4 h-4"></i> Export Data
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <p class="text-slate-500 text-sm font-medium">Total Logins</p>
            <h3 class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['total_logins'] }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-4">
                <i data-lucide="message-square" class="w-6 h-6"></i>
            </div>
            <p class="text-slate-500 text-sm font-medium">Prayer Requests</p>
            <h3 class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['total_prayers'] }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-4">
                <i data-lucide="clapperboard" class="w-6 h-6"></i>
            </div>
            <p class="text-slate-500 text-sm font-medium">Active Episodes</p>
            <h3 class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['total_episodes'] }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="border-b border-slate-100 bg-slate-50/50 px-8 py-4 flex justify-between items-center">
            <h3 class="font-bold text-slate-800">Recent Activity Feed</h3>
            <span class="text-xs text-slate-500">Showing {{ $viewers->firstItem() }}-{{ $viewers->lastItem() }} of {{ $viewers->total() }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-slate-400 text-xs uppercase tracking-widest border-b border-slate-100">
                        <th class="px-8 py-5 font-semibold">Viewer / User</th>
                        <th class="px-8 py-5 font-semibold">Location</th>
                        <th class="px-8 py-5 font-semibold">Prayer Request</th>
                        <th class="px-8 py-5 font-semibold">Access Details</th>
                        <th class="px-8 py-5 font-semibold text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($viewers as $viewer)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center text-slate-600 font-bold text-xs">
                                    {{ substr($viewer->name, 0, 2) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $viewer->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $viewer->phone }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $viewer->location === 'Mainland' ? 'bg-indigo-50 text-indigo-600' : 'bg-emerald-50 text-emerald-600' }}">
                                {{ $viewer->location ?? 'Global' }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            @php
                                $prayer = $prayers->where('name', $viewer->name)->first();
                            @endphp
                            @if($prayer)
                                <div class="flex items-center gap-2 text-slate-600">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-500"></i>
                                    <span class="text-sm truncate max-w-[200px]">{{ Str::limit($prayer->request, 40) }}</span>
                                </div>
                            @else
                                <span class="text-slate-300 text-xs italic">No request</span>
                            @endif
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex flex-col">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="link" class="w-3 h-3 text-amber-500"></i>
                                    <span class="text-xs font-mono text-slate-500">{{ $viewer->episode_slug ?? 'Unknown' }}</span>
                                </div>
                                <span class="text-[10px] text-slate-400 mt-1">
                                    {{ $viewer->created_at->format('d M Y') }} • {{ $viewer->created_at->format('h:i A') }}
                                </span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div x-data="{ open: false }" class="relative inline-block text-left">
                                <button @click="open = !open" @click.away="open = false" class="p-2 hover:bg-white rounded-lg border border-transparent hover:border-slate-200 transition-all focus:outline-none">
                                    <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-400"></i>
                                </button>

                                <div x-show="open"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-cloak
                                     class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-xl bg-white shadow-xl ring-1 ring-black ring-opacity-5 divide-y divide-slate-100 focus:outline-none">
                                    <div class="py-1">
                                        <button class="flex items-center w-full px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                                            <i data-lucide="eye" class="w-4 h-4 mr-3 text-slate-400"></i> View Details
                                        </button>
                                        <button class="flex items-center w-full px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                                            <i data-lucide="phone" class="w-4 h-4 mr-3 text-slate-400"></i> Call Viewer
                                        </button>
                                    </div>
                                    <div class="py-1">
                                        <button class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                            <i data-lucide="trash-2" class="w-4 h-4 mr-3 text-red-400"></i> Delete Record
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-8 py-5 border-t border-slate-100 bg-slate-50/30">
            {{ $viewers->links() }}
        </div>
    </div>
</div>

<style>
    /* Ensure dropdowns don't get cut off by overflow-x-auto on small screens */
    [x-cloak] { display: none !important; }
</style>
