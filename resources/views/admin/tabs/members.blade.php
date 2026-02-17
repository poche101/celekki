<div class="p-8 bg-slate-50 min-h-screen">
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Administration Portal</h1>
            <p class="text-slate-500 font-medium">Lekki Zone 5 Member Management</p>
        </div>

        <form action="{{ route('admin.dashboard') }}" method="GET" class="relative group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i data-lucide="search" class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 transition-colors"></i>
            </div>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search name, email, or code..."
                class="block w-full md:w-80 pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-medium focus:ring-4 focus:ring-blue-100 focus:border-blue-600 transition-all outline-none shadow-sm"
            >
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-black uppercase tracking-widest text-slate-400 mb-1">Registered Users</p>
                <h3 class="text-5xl font-black text-slate-900">{{ number_format($totalMembers ?? 0) }}</h3>
            </div>
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                <i data-lucide="users" class="w-8 h-8"></i>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm font-black uppercase tracking-widest text-slate-400 mb-1">Target Progress</p>
                    <h3 class="text-2xl font-black text-slate-900">{{ number_format($target ?? 30000) }} <span class="text-slate-300 font-medium">Goal</span></h3>
                </div>
                <div class="text-right">
                    <span class="text-blue-600 font-black text-xl">{{ number_format($progressPercent ?? 0, 1) }}%</span>
                </div>
            </div>
            <div class="w-full bg-slate-100 h-4 rounded-full overflow-hidden">
                <div class="bg-blue-600 h-full transition-all duration-1000" style="width: {{ $progressPercent ?? 0 }}%"></div>
            </div>
        </div>
    </div>

    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-xl font-black text-slate-900">Member Directory</h2>
        <span class="bg-slate-200 text-slate-700 px-4 py-1 rounded-full text-xs font-bold uppercase">Live Updates</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($members as $member)
        <div class="group bg-white border border-slate-100 rounded-[2.5rem] p-6 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-1 flex flex-col justify-between">
            <div>
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center gap-4">
                        @if($member->profile_photo_path)
                            <img src="{{ asset('storage/' . $member->profile_photo_path) }}" class="w-14 h-14 rounded-2xl object-cover shadow-lg border-2 border-white">
                        @else
                            <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h4 class="font-black text-slate-900 text-lg leading-tight">{{ $member->title ?? 'Brother' }} {{ $member->name }}</h4>
                            <p class="text-blue-600 text-[10px] font-black uppercase tracking-widest mt-1">{{ $member->member_id ?? $member->membership_code ?? 'NO ID' }}</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 mb-6">
                    <div class="space-y-2">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Contact Information</p>
                        <div class="flex items-center gap-3 text-slate-600">
                            <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                            <span class="text-sm font-medium truncate">{{ $member->email }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-600">
                            <i data-lucide="phone" class="w-4 h-4 text-slate-400"></i>
                            <span class="text-sm font-medium">{{ $member->phone ?? 'Not Provided' }}</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Church Info</p>
                        <div class="flex items-center gap-3 text-slate-600">
                            <i data-lucide="church" class="w-4 h-4 text-slate-400"></i>
                            <span class="text-[10px] font-black uppercase text-slate-300">Church</span>
                            <span class="text-sm font-medium">{{ $member->central_church ?? $member->church ?? 'Unassigned' }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-600">
                            <i data-lucide="layers" class="w-4 h-4 text-slate-400"></i>
                            <span class="text-[10px] font-black uppercase text-slate-300">Group</span>
                            <span class="text-sm font-medium">{{ $member->church_group ?? $member->group ?? 'No Group' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-50 flex items-center justify-between mt-auto">
                <div class="flex flex-col">
                    <span class="text-[10px] font-black uppercase text-slate-300">Cell</span>
                    <span class="text-xs font-bold text-slate-700">{{ $member->assigned_cell ?? $member->cell ?? 'Not Assigned' }}</span>
                </div>
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors cursor-pointer shadow-sm">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-24 text-center bg-white rounded-[3rem] border border-dashed border-slate-200">
            <i data-lucide="user-x" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
            <h3 class="text-xl font-bold text-slate-900">No members found</h3>
            <p class="text-slate-500">We couldn't find any results matching your search criteria.</p>
            <a href="{{ route('admin.dashboard') }}" class="inline-block mt-4 text-blue-600 font-bold hover:underline">Clear all filters</a>
        </div>
        @endforelse
    </div>

    <div class="mt-12 flex justify-center">
        <div class="bg-white px-4 py-2 rounded-2xl shadow-sm border border-slate-100">
            {{ $members->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>
