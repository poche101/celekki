<div x-data="broadcastStudio()" class="p-8 bg-slate-50 min-h-screen">
    <div x-show="showToast" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-10 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         class="fixed bottom-8 right-8 z-[100] bg-slate-900 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4 border border-slate-700">
        <div :class="toastType === 'live' ? 'bg-red-500' : 'bg-green-500'" class="w-3 h-3 rounded-full animate-pulse"></div>
        <div>
            <p class="font-bold text-sm" x-text="toastTitle"></p>
            <p class="text-xs text-slate-400" x-text="toastMessage"></p>
        </div>
        <button @click="showToast = false" class="ml-4 text-slate-500 hover:text-white transition-colors">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Broadcast Studio</h1>
            <p class="text-slate-500 text-sm">Manage scheduled meetings and monitor live engagement</p>
        </div>

        <div :class="isLive ? 'bg-red-50 border-red-200' : 'bg-slate-100 border-slate-300'"
             class="flex items-center gap-4 px-4 py-2 rounded-xl border transition-colors duration-300">
            <i data-lucide="radio" :class="isLive ? 'text-red-600 animate-pulse' : 'text-slate-400'"></i>
            <span class="font-bold text-xs tracking-wider" :class="isLive ? 'text-red-600' : 'text-slate-600'" x-text="isLive ? 'BROADCAST ACTIVE' : 'STUDIO OFFLINE'"></span>
            <button @click="toggleLiveStatus()" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none" :class="isLive ? 'bg-red-600' : 'bg-slate-300'">
                <span class="inline-block h-4 w-4 transform rounded-full bg-white transition duration-200" :class="isLive ? 'translate-x-6' : 'translate-x-1'"></span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
        <div class="lg:col-span-3 space-y-8">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <i data-lucide="calendar-plus" class="text-indigo-600 w-5 h-5"></i>
                    <h2 class="font-bold text-slate-800">Stream Scheduling</h2>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Meeting Title</label>
                        <input type="text" x-model="stream.title" class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <input type="date" x-model="stream.scheduled_date" class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500">
                        <input type="time" x-model="stream.scheduled_time" class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <input type="url" x-model="stream.stream_link" placeholder="Stream URL" class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500">
                    <button @click="openModal('update_broadcast')" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-xl hover:bg-indigo-700 transition">Update Details</button>
                </div>
            </div>

           <x-live-attendance />
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm sticky top-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <i data-lucide="message-circle" class="text-indigo-600 w-5 h-5"></i>
                        <h2 class="font-bold text-slate-800">Live Engagement</h2>
                    </div>
                    <button @click="fetchComments()" class="text-slate-400 hover:text-indigo-600 transition-all active:rotate-180" :disabled="isLoadingComments">
                        <i data-lucide="refresh-cw" class="w-4 h-4" :class="isLoadingComments ? 'animate-spin' : ''"></i>
                    </button>
                </div>

                <div class="space-y-6 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                    <template x-for="(comment, index) in comments" :key="comment.id">
                        <div class="border-b border-slate-50 pb-4 last:border-0" x-transition:enter="transition ease-out duration-300">
                            <div class="flex gap-4">
                                <div class="shrink-0 w-9 h-9 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-black text-xs"
                                     x-text="comment.user_name ? comment.user_name.substring(0,1).toUpperCase() : '?'"></div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-center mb-1">
                                        <h4 class="font-bold text-slate-900 text-[13px] truncate" x-text="comment.user_name || 'Anonymous'"></h4>
                                        <span class="text-[10px] text-slate-400 font-medium bg-slate-50 px-2 py-0.5 rounded-full" x-text="comment.time_formatted || 'Just now'"></span>
                                    </div>
                                    <p class="text-slate-600 text-sm leading-relaxed break-words" x-text="comment.comment_text"></p>

                                    <template x-if="comment.admin_reply">
                                        <div class="mt-3 p-3 bg-slate-900 rounded-2xl text-[12px] text-slate-100 relative">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                                                <span class="font-bold text-indigo-300 uppercase tracking-widest text-[9px]">Admin Response</span>
                                            </div>
                                            <p class="italic opacity-90" x-text="comment.admin_reply"></p>
                                        </div>
                                    </template>

                                    <div class="flex gap-4 mt-3 pt-1">
                                        <button @click="openModal('reply', index)" class="flex items-center gap-1.5 text-indigo-600 text-[11px] font-bold hover:text-indigo-700 transition-colors uppercase tracking-wider">
                                            <i data-lucide="corner-up-left" class="w-3 h-3"></i>
                                            <span x-text="comment.admin_reply ? 'Edit Reply' : 'Reply'"></span>
                                        </button>
                                        <button @click="openModal('delete', index)" class="flex items-center gap-1.5 text-red-400 text-[11px] font-bold hover:text-red-600 transition-colors uppercase tracking-wider">
                                            <i data-lucide="trash-2" class="w-3 h-3"></i>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div x-show="comments.length === 0 && !isLoadingComments" class="text-center py-16 px-4">
                        <div class="bg-slate-50 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="message-square-off" class="text-slate-300 w-6 h-6"></i>
                        </div>
                        <p class="text-slate-400 text-sm font-medium">No engagement yet.</p>
                        <p class="text-slate-300 text-[11px]">Comments from the live stream will appear here.</p>
                    </div>

                    <div x-show="isLoadingComments" class="text-center py-16">
                        <div class="inline-block animate-spin rounded-full h-6 w-6 border-2 border-indigo-600 border-t-transparent"></div>
                        <p class="text-slate-400 text-[10px] mt-4 font-bold uppercase tracking-widest">Fetching Comments...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="modal.open" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak>
        <div @click.away="modal.open = false" class="bg-white w-full max-w-md rounded-3xl overflow-hidden shadow-2xl border border-white/20">
            <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-900" x-text="modal.title"></h3>
                <button @click="modal.open = false" class="text-slate-400 hover:text-slate-600"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <div class="p-6">
                <template x-if="modal.type === 'reply'">
                    <div class="space-y-4">
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <p class="text-[10px] font-black uppercase text-slate-400 mb-1">Replying to Comment</p>
                            <p class="text-xs text-slate-600 italic" x-text="comments[modal.index]?.comment_text"></p>
                        </div>
                        <textarea x-model="modal.replyContent" rows="4" class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-indigo-500 text-sm" placeholder="Type your official response..."></textarea>
                    </div>
                </template>
                <template x-if="modal.type === 'delete'">
                    <div class="text-center py-4">
                        <div class="w-12 h-12 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                        </div>
                        <p class="text-slate-900 font-bold">Delete this comment?</p>
                        <p class="text-slate-500 text-sm mt-1">This action cannot be undone and will remove the comment from the live feed.</p>
                    </div>
                </template>
                <template x-if="modal.type === 'update_broadcast'">
                    <p class="text-slate-600 text-sm">Are you sure you want to update the broadcast details?</p>
                </template>
            </div>
            <div class="p-6 bg-slate-50 flex gap-3">
                <button @click="modal.open = false" class="flex-1 py-3 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold text-sm hover:bg-slate-100 transition">Cancel</button>
                <button @click="confirmModalAction"
                        :class="modal.type === 'delete' ? 'bg-red-500 hover:bg-red-600' : 'bg-indigo-600 hover:bg-indigo-700'"
                        class="flex-1 py-3 text-white rounded-xl font-bold text-sm shadow-lg shadow-indigo-200 transition">Confirm Action</button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('broadcastStudio', () => ({
                isLive: false,
                showToast: false,
                toastType: 'live',
                toastTitle: '',
                toastMessage: '',
                attendanceSearch: '',
                stream: { id: 1, title: '', scheduled_date: '', scheduled_time: '', stream_link: '' }, // Hardcoded ID 1
                attendees: [],
                comments: [],
                isLoadingComments: false,
                modal: { open: false, type: '', title: '', index: null, replyContent: '' },

                async init() {
                    // Start by fetching current stream details
                    await this.fetchStream();

                    // Immediately fetch comments for Stream 1 as requested
                    await this.fetchComments();

                    this.refreshIcons();

                    if (window.Echo) {
                        window.Echo.channel('broadcast-studio').listen('.MessageSent', () => {
                            this.fetchComments();
                        });
                    }
                },

                refreshIcons() {
                    this.$nextTick(() => lucide.createIcons());
                },

                triggerToast(type, title, message) {
                    this.toastType = type;
                    this.toastTitle = title;
                    this.toastMessage = message;
                    this.showToast = true;
                    setTimeout(() => this.showToast = false, 5000);
                },

                async fetchStream() {
                    try {
                        const res = await fetch('/api/studio/stream');
                        if (res.ok) {
                            const data = await res.json();
                            // If API returns an ID, use it, otherwise keep default 1
                            this.stream.id = data.id || 1;
                            this.stream.title = data.title || '';
                            this.stream.scheduled_date = data.scheduled_date || '';
                            this.stream.scheduled_time = data.scheduled_time || '';
                            this.stream.stream_link = data.stream_link || '';

                            this.isLive = !!data.is_live;
                            this.attendees = data.attendees || [];
                        }
                    } catch (e) { console.error("Stream Fetch Error:", e); }
                },

                async fetchComments() {
                    // Directly target ID 1 if stream.id isn't ready
                    const targetId = this.stream.id || 1;
                    this.isLoadingComments = true;

                    try {
                        const res = await fetch(`/api/comments/stream/${targetId}`);
                        if (res.ok) {
                            this.comments = await res.json();
                        }
                    } catch (e) {
                        console.error("Comment fetch failed", e);
                    } finally {
                        this.isLoadingComments = false;
                        this.refreshIcons();
                    }
                },

                async toggleLiveStatus() {
                    const newStatus = !this.isLive;
                    try {
                        const res = await fetch('/api/studio/toggle-live', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content },
                            body: JSON.stringify({ is_live: newStatus })
                        });
                        if (res.ok) {
                            this.isLive = newStatus;
                            this.triggerToast(
                                'live',
                                this.isLive ? 'Studio is now LIVE' : 'Studio is OFFLINE',
                                this.isLive ? 'Public broadcast has started.' : 'The stream has been disconnected.'
                            );
                        }
                    } catch (e) { console.error(e); }
                },

                filteredAttendees() {
                    return this.attendees.filter(p => p.name.toLowerCase().includes(this.attendanceSearch.toLowerCase()));
                },

                openModal(type, index = null) {
                    let title = type.replace('_', ' ').toUpperCase();
                    this.modal = {
                        open: true,
                        type,
                        index,
                        title,
                        replyContent: (index !== null && this.comments[index]) ? (this.comments[index].admin_reply || '') : ''
                    };
                    this.refreshIcons();
                },

                async confirmModalAction() {
                    const { type, index, replyContent } = this.modal;

                    try {
                        if (type === 'update_broadcast') {
                            const res = await fetch('/api/studio/update', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content },
                                body: JSON.stringify(this.stream)
                            });
                            if (res.ok) this.triggerToast('success', 'Details Updated', 'Broadcast schedule updated.');
                        }
                        else if (type === 'reply') {
                            const comment = this.comments[index];
                            const res = await fetch(`/api/comments/${comment.id}/reply`, {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content },
                                body: JSON.stringify({ admin_reply: replyContent })
                            });
                            if (res.ok) await this.fetchComments();
                        }
                        else if (type === 'delete') {
                            const comment = this.comments[index];
                            const res = await fetch(`/api/comments/${comment.id}`, {
                                method: 'DELETE',
                                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content }
                            });
                            if (res.ok) await this.fetchComments();
                        }
                    } catch (e) { console.error("Action failed", e); }

                    this.modal.open = false;
                }
            }));
        });
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
    </style>
</div>
