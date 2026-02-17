<div class="lg:col-span-4 lg:col-start-9 xl:col-start-10 xl:col-span-4 lg:pl-4" x-data="liveStream()">
    <div class="flex flex-col h-[60vh] lg:h-[85vh] sticky top-8 bg-white rounded-[32px] border border-slate-200 shadow-sm overflow-hidden">

        <div class="px-6 lg:px-8 py-5 border-b border-slate-100 flex items-center justify-between bg-white">
            <h2 class="text-[12px] font-black uppercase tracking-[0.2em] text-slate-900">Live Feedback</h2>
            <div class="flex items-center gap-2">
                <span class="flex h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                <span class="text-[11px] font-bold text-slate-500">Active</span>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto px-6 lg:px-8 py-4 space-y-6 custom-scrollbar"
             id="chat-window" x-ref="chatWindow">

            <template x-if="messages.length === 0">
                <div class="flex flex-col items-center justify-center h-full text-slate-400 space-y-2">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <p class="text-[10px] uppercase tracking-widest font-bold">Loading Chat...</p>
                </div>
            </template>

            <template x-for="(msg, index) in messages" :key="index">
                <div class="flex gap-4 group" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2">
                    <div class="shrink-0 w-8 h-8 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-600 group-hover:bg-slate-900 group-hover:text-white transition-all"
                         x-text="msg.user_name ? msg.user_name.substring(0,1).toUpperCase() : '?'"></div>

                    <div class="flex-1 min-w-0 border-b border-slate-50 pb-4 group-last:border-0">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-[13px] font-bold text-slate-900" x-text="msg.user_name || 'Anonymous'"></span>
                            <span class="text-[10px] text-slate-300" x-text="msg.time_formatted || 'Just now'"></span>
                        </div>
                        <p class="text-[14px] text-slate-600 leading-relaxed" x-text="msg.comment_text"></p>

                        <template x-if="msg.admin_reply">
                            <div class="mt-2 p-2 bg-slate-50 rounded-lg border-l-2 border-slate-900">
                                <p class="text-[11px] font-bold text-slate-900 mb-0.5">Admin Response</p>
                                <p class="text-[12px] text-slate-600 italic" x-text="msg.admin_reply"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <div class="p-4 lg:p-6 bg-slate-50/80 border-t border-slate-100">
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden focus-within:border-slate-900 transition-all shadow-sm">
                <textarea
                    x-model="messageText"
                    @keydown.enter.prevent="sendMessage()"
                    placeholder="Post a comment..."
                    class="w-full bg-transparent border-none py-3 px-4 text-[14px] font-medium placeholder:text-slate-400 focus:ring-0 resize-none min-h-[45px] outline-none"></textarea>

                <div class="flex items-center justify-between px-3 py-2 bg-slate-50/50 border-t border-slate-50">
                    <div class="flex items-center gap-0.5 overflow-x-auto no-scrollbar py-0.5">
                        <template x-for="emoji in emojis">
                            <button @click="messageText += emoji"
                                    class="p-1 grayscale hover:grayscale-0 hover:scale-125 transition-all text-sm leading-none">
                                <span x-text="emoji"></span>
                            </button>
                        </template>
                    </div>

                    <button @click="sendMessage()"
                            :disabled="!messageText.trim()"
                            :class="!messageText.trim() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-black'"
                            class="flex items-center gap-2 bg-slate-900 text-white px-4 py-1.5 rounded-xl text-[10px] lg:text-[11px] font-black uppercase tracking-widest transition-all shadow-md">
                        <span class="hidden sm:inline">Send</span>
                        <span class="sm:hidden">Post</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m22 2-7 20-4-9-9-4Z" /><path d="M22 2 11 13" />
                        </svg>
                    </button>
                </div>
            </div>
            <p class="mt-3 text-[9px] text-center text-slate-400 font-medium tracking-tight">
                Read our <span class="underline cursor-pointer">Guidelines</span>.
            </p>
        </div>
    </div>
</div>

<script>
    function liveStream() {
        return {
            messageText: '',
            streamId: 1, // Matches your working API endpoint /stream/1
            userName: "{{ auth()->user()->name ?? 'Guest User' }}",
            emojis: ["🙏", "🔥", "🙌", "❤️", "✨", "👏"],
            messages: [],

            init() {
                this.fetchComments();
                this.listenForMessages();
            },

            async fetchComments() {
                try {
                    const response = await axios.get(`/api/comments/stream/${this.streamId}`);
                    // Ensure we are working with an array. Controller order is likely latest first,
                    // so we reverse to show chronological order (oldest at top).
                    this.messages = Array.isArray(response.data) ? response.data.reverse() : [];
                    this.scrollToBottom();
                } catch (e) {
                    console.error("Chat fetch failed:", e);
                }
            },

            listenForMessages() {
                if (window.Echo) {
                    window.Echo.channel('broadcast-studio')
                        .listen('.MessageSent', (e) => {
                            // Avoid duplicate messages if the user is the one who sent it
                            this.messages.push({
                                user_name: e.user_name,
                                comment_text: e.comment_text,
                                admin_reply: e.admin_reply,
                                time_formatted: e.time_formatted || 'Just now'
                            });
                            this.scrollToBottom();
                        });
                } else {
                    console.warn("Laravel Echo not found. Real-time updates disabled.");
                }
            },

            async sendMessage() {
                const text = this.messageText.trim();
                if (!text) return;

                const payload = {
                    live_stream_id: this.streamId,
                    user_name: this.userName,
                    comment_text: text
                };

                // Clear input immediately for better UX
                this.messageText = '';

                try {
                    await axios.post('/api/comments', payload);
                    // No need to manually push to messages array here;
                    // Laravel Echo will broadcast it back to us via listenForMessages().
                } catch (e) {
                    console.error("Message send failed:", e);
                    alert("Could not post comment. Please try again.");
                }
            },

            scrollToBottom() {
                this.$nextTick(() => {
                    const el = this.$refs.chatWindow;
                    if (el) {
                        el.scrollTo({
                            top: el.scrollHeight,
                            behavior: 'smooth'
                        });
                    }
                });
            }
        }
    }
</script>
