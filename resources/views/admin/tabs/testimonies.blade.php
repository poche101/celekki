<div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100"
    x-data="{
        openDeleteModal: false,
        openEditModal: false,
        deleteUrl: '',
        editUrl: '',
        editData: {
            name: '',
            group: '',
            content: ''
        }
    }">

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
                            <button type="button"
                                @click="
                                    editUrl = '{{ route('admin.testimonies.update', $item->id) }}';
                                    editData.name = '{{ addslashes($item->name) }}';
                                    editData.group = '{{ addslashes($item->group) }}';
                                    editData.content = '{{ addslashes($item->content) }}';
                                    openEditModal = true;
                                "
                                class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-white rounded-lg border border-transparent hover:border-gray-100 shadow-none hover:shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </button>

                            @if($item->video_url)
                                <a href="{{ $item->video_url }}" target="_blank" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-white rounded-lg border border-transparent hover:border-gray-100 shadow-none hover:shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            @endif

                            <button type="button"
                                @click="deleteUrl = '{{ route('admin.testimonies.destroy', $item->id) }}'; openDeleteModal = true"
                                class="p-2 text-gray-400 hover:text-red-600 hover:bg-white rounded-lg border border-transparent hover:border-gray-100 shadow-none hover:shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
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

    <div x-show="openEditModal"
         class="fixed inset-0 z-[99] flex items-center justify-center overflow-y-auto"
         x-cloak>
        <div x-show="openEditModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="openEditModal = false"
             class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>

        <div x-show="openEditModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 m-4 overflow-hidden">

            <div class="mb-6">
                <h3 class="text-xl font-bold text-gray-900">Edit Testimony</h3>
                <p class="text-sm text-gray-500 mt-1">Modify the content before it appears on the public page.</p>
            </div>

            <form :action="editUrl" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Author Name</label>
                    <input type="text" name="name" x-model="editData.name" required
                        class="block w-full px-4 py-2 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:bg-white transition-all sm:text-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Group / Church</label>
                    <input type="text" name="group" x-model="editData.group"
                        class="block w-full px-4 py-2 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:bg-white transition-all sm:text-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Testimony Content</label>
                    <textarea name="content" x-model="editData.content" rows="6" required
                        class="block w-full px-4 py-2 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:bg-white transition-all sm:text-sm resize-none"></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" @click="openEditModal = false"
                            class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex-1 px-4 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 shadow-sm shadow-indigo-200 transition-all">
                        Update Record
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="openDeleteModal"
         class="fixed inset-0 z-[99] flex items-center justify-center overflow-y-auto"
         x-cloak>
        <div x-show="openDeleteModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="openDeleteModal = false"
             class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"></div>

        <div x-show="openDeleteModal"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6 m-4 overflow-hidden">

            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-50 rounded-full mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>

            <div class="text-center mb-6">
                <h3 class="text-lg font-bold text-gray-900">Confirm Delete</h3>
                <p class="text-sm text-gray-500 mt-2">Are you sure you want to delete this testimony? This action cannot be undone.</p>
            </div>

            <div class="flex gap-3">
                <button @click="openDeleteModal = false"
                        class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">
                    Cancel
                </button>
                <form :action="deleteUrl" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full px-4 py-2.5 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 shadow-sm shadow-red-200 transition-all">
                        Delete Forever
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }

    .admin-pagination nav div:first-child { display: none; }
    .admin-pagination nav span[aria-current="page"] span {
        @apply bg-indigo-600 text-white border-indigo-600 rounded-lg mx-1;
    }
    .admin-pagination nav a, .admin-pagination nav span {
        @apply rounded-lg mx-1 border-gray-200 text-gray-600 transition-all hover:bg-indigo-50 hover:text-indigo-600;
    }
</style>
