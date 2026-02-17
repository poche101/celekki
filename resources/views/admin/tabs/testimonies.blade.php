<div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">User Testimonies</h2>
            <p class="text-sm text-gray-500 mt-1">Manage and moderate community stories and videos.</p>
        </div>

        <div class="flex gap-3">
            <div class="px-4 py-2 bg-indigo-50 rounded-lg border border-indigo-100">
                <span class="block text-xs text-indigo-500 font-semibold uppercase tracking-wider">Pending</span>
                <span class="text-xl font-bold text-indigo-700">{{ $stats['pending'] }}</span>
            </div>
            <div class="px-4 py-2 bg-emerald-50 rounded-lg border border-emerald-100">
                <span class="block text-xs text-emerald-500 font-semibold uppercase tracking-wider">Total</span>
                <span class="text-xl font-bold text-emerald-700">{{ $stats['total'] }}</span>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
        <form method="GET" action="{{ route('admin.dashboard') }}" class="relative flex-1 max-w-md">
            <input type="hidden" name="tab" value="testimonies">

            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input type="text" name="testimony_search" value="{{ request('testimony_search') }}"
                placeholder="Search by name, group or content..."
                class="block w-full pl-10 pr-10 py-2 border border-gray-200 rounded-xl leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">

            @if(request('testimony_search'))
                <a href="{{ route('admin.dashboard', ['tab' => 'testimonies']) }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-red-500">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </a>
            @endif
        </form>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.testimonies.export') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-200 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-all hover:border-indigo-200">
                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Export CSV
            </a>
        </div>
    </div>

    <div class="overflow-x-auto relative">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="pb-4 font-semibold text-gray-600 text-sm">Author & Group</th>
                    <th class="pb-4 font-semibold text-gray-600 text-sm">Testimony</th>
                    <th class="pb-4 font-semibold text-gray-600 text-sm text-center">Type</th>
                    <th class="pb-4 font-semibold text-gray-600 text-sm text-center">Status</th>
                    <th class="pb-4 font-semibold text-gray-600 text-sm text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($testimonies as $item)
                <tr class="group hover:bg-gray-50/50 transition-all duration-200">
                    <td class="py-5">
                        <div class="font-bold text-gray-900">{{ $item->name }}</div>
                        <div class="text-xs text-gray-400 font-medium">{{ $item->group }}</div>
                    </td>
                    <td class="py-5 max-w-xs">
                        <p class="text-sm text-gray-600 line-clamp-2 leading-relaxed">
                            {{ $item->content }}
                        </p>
                    </td>
                    <td class="py-5 text-center">
                        @if($item->video_url)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                                Video
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path></svg>
                                Text
                            </span>
                        @endif
                    </td>
                    <td class="py-5 text-center">
                        <form action="{{ route('admin.testimonies.toggle', $item->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="cursor-pointer focus:outline-none">
                                @if($item->is_approved)
                                    <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-700 uppercase tracking-tighter">Approved</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700 uppercase tracking-tighter">Pending</span>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td class="py-5 text-right">
                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            @if($item->video_url)
                                <a href="{{ $item->video_url }}" target="_blank" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-white rounded-lg border border-transparent hover:border-gray-100 shadow-none hover:shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            @endif

                            <form action="{{ route('admin.testimonies.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this testimony forever?')">
                                @csrf @method('DELETE')
                                <button class="p-2 text-gray-400 hover:text-red-600 hover:bg-white rounded-lg border border-transparent hover:border-gray-100 shadow-none hover:shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-4 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-sm">No testimonies found matching your criteria.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8 border-t border-gray-50 pt-6">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500">
                Showing <span class="font-medium text-gray-700">{{ $testimonies->firstItem() }}</span>
                to <span class="font-medium text-gray-700">{{ $testimonies->lastItem() }}</span>
                of <span class="font-medium text-gray-700">{{ $testimonies->total() }}</span> results
            </div>

            <div class="admin-pagination">
                {{ $testimonies->appends([
                    'testimony_search' => request('testimony_search'),
                    'tab' => 'testimonies'
                ])->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling to make default Laravel tailwind pagination look consistent with your UI */
    .admin-pagination nav div:first-child { display: none; } /* Hide the 'Showing X to Y' repeat */
    .admin-pagination nav span[aria-current="page"] span {
        @apply bg-indigo-600 text-white border-indigo-600 rounded-lg mx-1;
    }
    .admin-pagination nav a, .admin-pagination nav span {
        @apply rounded-lg mx-1 border-gray-200 text-gray-600 transition-all hover:bg-indigo-50 hover:text-indigo-600;
    }
</style>
