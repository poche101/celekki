<div x-data="broadcastStudio()" class="p-8 bg-slate-50 min-h-screen">
    <div x-show="showToast" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-10 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         class="fixed bottom-8 right-8 z-[100] bg-slate-900 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4 border border-slate-700">
        <div :class="toastType === 'success' ? 'bg-green-500' : 'bg-red-500'" class="w-3 h-3 rounded-full animate-pulse"></div>
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
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Broadcast Studio</h1>
            <p class="text-slate-500 text-sm font-medium">Managing Live Stream Engagement</p>
        </div>

        <div :class="isLive ? 'bg-red-50 border-red-200' : 'bg-white border-slate-200'"
             class="flex items-center gap-4 px-5 py-2.5 rounded-2xl border shadow-sm transition-all duration-300">
            <i data-lucide="radio" :class="isLive ? 'text-red-600 animate-pulse' : 'text-slate-400'"></i>
            <span class="font-black text-[10px] tracking-widest" :class="isLive ? 'text-red-600' : 'text-slate-600'" x-text="isLive ? 'BROADCAST LIVE' : 'STUDIO OFFLINE'"></span>
            <button @click="toggleLiveStatus()" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none" :class="isLive ? 'bg-red-600' : 'bg-slate-300'">
                <span class="inline-block h-4 w-4 transform rounded-full bg-white transition duration-200 shadow-sm" :class="isLive ? 'translate-x-6' : 'translate-x-1'"></span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-8">
        <div class="col-span-12 lg:col-span-8 space-y-8">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <div class="p-2 bg-indigo-600 rounded-xl shadow-lg shadow-indigo-100">
                        <i data-lucide="calendar-days" class="text-white w-5 h-5"></i>
                    </div>
                    <h2 class="font-black text-slate-800 uppercase text-xs tracking-[0.2em]">Stream Configuration</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Current Stream ID (Required)</label>
                        <input type="number" x-model="stream.id" @change="fetchComments()" class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-500 transition-all font-bold text-slate-700" placeholder="e.g. 1">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Broadcast Title</label>
                        <input type="text" x-model="stream.title" class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-500 transition-all font-bold text-slate-700">
                    </div>
                    <div class="md:col-span-2 pt-4">
                        <button @click="saveStreamSettings()" class="w-full bg-slate-900 text-white font-black py-4 rounded-2xl hover:bg-indigo-600 transition-all">
                            SAVE SETTINGS
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl flex flex-col h-[calc(100vh-12rem)] sticky top-8">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></div>
                        <h2 class="font-black text-slate-800 uppercase text-xs tracking-[0.2em]">Live Feed</h2>
                    </div>
                    <button @click="fetchComments()" class="p-2 bg-slate-50 rounded-lg text-slate-400 hover:text-indigo-600 transition-all">
                        <i data-lucide="refresh-cw" class="w-4 h-4" :class="isLoadingComments ? 'animate-spin' : ''"></i>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-6 custom-scrollbar" id="comment-container">
                    <template x-for="comment in comments" :key="comment.id">
                        <div class="group relative">
                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-slate-900 shrink-0 flex items-center justify-center font-black text-white text-xs" x-text="comment.user_name[0]"></div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-baseline mb-1">
                                        <h4 class="font-black text-slate-900 text-sm truncate" x-text="comment.user_name"></h4>
                                        <span class="text-[9px] font-bold text-slate-300" x-text="comment.time_formatted"></span>
                                    </div>
                                    <p class="text-slate-600 text-sm leading-relaxed" x-text="comment.comment_text"></p>
                                    
                                    <template x-if="comment.admin_reply">
                                        <div class="mt-3 p-3 bg-indigo-50 border border-indigo-100 rounded-xl">
                                            <p class="text-indigo-900 text-xs italic" x-text="'Admin: ' + comment.admin_reply"></p>
                                        </div>
                                    </template>

                                    <div class="flex gap-4 mt-3 opacity-0 group-hover:opacity-100 transition-all">
                                        <button @click="openModal('reply', comment)" class="text-[10px] font-black text-indigo-600 flex items-center gap-1">
                                            <i data-lucide="reply" class="w-3 h-3"></i> REPLY
                                        </button>
                                        <button @click="deleteComment(comment.id)" class="text-[10px] font-black text-red-400 flex items-center gap-1">
                                            <i data-lucide="trash-2" class="w-3 h-3"></i> DELETE
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div x-show="comments.length === 0 && !isLoadingComments" class="text-center py-20 text-slate-300 uppercase text-[10px] font-black tracking-widest">
                        No Comments Found
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="modal.open" x-cloak class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-md">
        <div @click.away="modal.open = false" class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl">
            <h3 class="font-black text-slate-800 uppercase mb-4">Reply to Viewer</h3>
            <textarea x-model="modal.content" class="w-full p-4 bg-slate-50 border-none rounded-2xl mb-4" rows="4"></textarea>
            <div class="flex gap-3">
                <button @click="modal.open = false" class="flex-1 py-4 font-black text-slate-400">Cancel</button>
                <button @click="submitReply()" class="flex-1 bg-slate-900 text-white py-4 rounded-2xl font-black">SEND REPLY</button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('broadcastStudio', () => ({
                isLive: false,
                isLoadingComments: false,
                showToast: false,
                toastType: 'success',
                toastTitle: '',
                toastMessage: '',
                stream: { id: 1, title: '' }, // Defaulting to 1 for testing
                comments: [],
                modal: { open: false, content: '', activeCommentId: null },

                async init() {
                    this.refreshIcons();
                    await this.fetchComments();

                    // Pusher Real-time integration
                    if (window.Echo) {
                        window.Echo.channel('public-broadcast')
                            .listen('.MessageSent', (e) => {
                                this.fetchComments(); // Refresh list on new message
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
                    setTimeout(() => this.showToast = false, 4000);
                },

                // MAIN FETCH LOGIC
                async fetchComments() {
                    if (!this.stream.id) return;
                    
                    this.isLoadingComments = true;
                    try {
                        // This matches your index($streamId) controller route
                        const response = await fetch(`/api/comments/stream/${this.stream.id}`);
                        if (response.ok) {
                            // The map in your controller ensures this is the correct structure
                            this.comments = await response.json();
                        }
                    } catch (error) {
                        console.error("Fetch error:", error);
                    } finally {
                        this.isLoadingComments = false;
                        this.refreshIcons();
                    }
                },

                openModal(type, comment) {
                    this.modal.activeCommentId = comment.id;
                    this.modal.content = comment.admin_reply || '';
                    this.modal.open = true;
                },

                async submitReply() {
                    try {
                        const res = await fetch(`/api/comments/${this.modal.activeCommentId}/reply`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ admin_reply: this.modal.content })
                        });

                        if (res.ok) {
                            this.triggerToast('success', 'Replied', 'Admin response updated.');
                            this.modal.open = false;
                            await this.fetchComments();
                        }
                    } catch (e) {
                        this.triggerToast('error', 'Error', 'Failed to save reply.');
                    }
                },

                async deleteComment(id) {
                    if (!confirm('Delete this comment?')) return;
                    try {
                        const res = await fetch(`/api/comments/${id}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                        });
                        if (res.ok) {
                            this.triggerToast('success', 'Deleted', 'Comment removed.');
                            await this.fetchComments();
                        }
                    } catch (e) {
                        console.error(e);
                    }
                }
            }));
        });
    </script>
</div>