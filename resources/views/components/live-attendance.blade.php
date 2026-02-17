<div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm"
    x-data="{
        attendance: [],
        attendanceSearch: '',
        loading: false,
        page: 1,
        lastPage: 1,

        async fetchAttendance(newPage = 1) {
            this.page = newPage;
            this.loading = true;
            try {
                const response = await fetch(`/admin/api/studio-data?search=${encodeURIComponent(this.attendanceSearch)}&page=${this.page}`);
                const data = await response.json();

                // If backend provides pagination object, use data.attendees.data
                // Otherwise, it uses your current structure
                this.attendance = data.attendees.data || data.attendees;
                this.lastPage = data.attendees.last_page || 1;
            } catch (error) {
                console.error('Attendance Load Error:', error);
            } finally {
                this.loading = false;
            }
        },

        exportToCSV() {
            if (this.attendance.length === 0) return;

            const headers = ['Name', 'Phone', 'Status', 'Attended At'];
            const rows = this.attendance.map(p => [
                `'${p.name}'`,
                `'${p.phone}'`,
                `'${p.status}'`,
                `'${p.full_date}'`
            ]);

            let csvContent = 'data:text/csv;charset=utf-8,'
                + headers.join(',') + '\n'
                + rows.map(e => e.join(',')).join('\n');

            const encodedUri = encodeURI(csvContent);
            const link = document.createElement('a');
            link.setAttribute('href', encodedUri);
            link.setAttribute('download', `attendance_export_${new Date().getTime()}.csv`);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },

        init() {
            this.fetchAttendance();
            setInterval(() => this.fetchAttendance(this.page), 30000);
            this.$watch('attendanceSearch', () => this.fetchAttendance(1));
        }
    }">

    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center">
                <i data-lucide="users" class="text-indigo-600 w-5 h-5"></i>
            </div>
            <div>
                <h2 class="font-bold text-slate-800">Live Attendance</h2>
                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wider">Real-time updates</p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <button @click="exportToCSV()" class="flex items-center gap-2 px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 text-xs font-bold rounded-xl transition-all">
                <i data-lucide="download" class="w-3.5 h-3.5"></i>
                Export
            </button>
            <div x-show="loading" class="animate-spin rounded-full h-4 w-4 border-2 border-indigo-500 border-t-transparent"></div>
        </div>
    </div>

    <div class="relative mb-6">
        <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
        <input type="text"
               x-model.debounce.500ms="attendanceSearch"
               placeholder="Filter by name or phone..."
               class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500/20 transition-all">
    </div>

    <div class="space-y-3 max-h-[450px] overflow-y-auto pr-2 custom-scrollbar">
        <template x-for="person in attendance" :key="person.id">
            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-transparent hover:border-indigo-100 hover:bg-white hover:shadow-md transition-all duration-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-xs" x-text="person.name.charAt(0)"></div>
                    <div>
                        <p class="font-bold text-sm text-slate-900" x-text="person.name"></p>
                        <div class="flex items-center gap-2 mt-0.5">
                            <p class="text-[11px] text-slate-500" x-text="person.phone"></p>
                            <span class="text-slate-300">|</span>
                            <p class="text-[11px] text-slate-400" x-text="person.attended_at"></p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-end gap-1">
                    <span :class="{
                        'bg-green-100 text-green-700': person.status === 'present',
                        'bg-blue-100 text-blue-700': person.status === 'online',
                        'bg-slate-200 text-slate-600': person.status === 'away'
                    }" class="text-[9px] font-black px-2.5 py-1 rounded-lg uppercase tracking-widest shadow-sm" x-text="person.status"></span>
                </div>
            </div>
        </template>

        <div x-show="attendance.length === 0 && !loading"
             x-transition
             class="py-12 flex flex-col items-center justify-center bg-slate-50 rounded-[32px] border border-dashed border-slate-200">
            <i data-lucide="user-minus" class="w-8 h-8 text-slate-300 mb-2"></i>
            <p class="text-sm text-slate-400 font-medium">No attendees found</p>
        </div>
    </div>

    <div class="flex items-center justify-between mt-6 pt-4 border-t border-slate-50">
        <span class="text-[11px] text-slate-400 font-medium">
            Page <span x-text="page"></span> of <span x-text="lastPage"></span>
        </span>
        <div class="flex gap-2">
            <button
                @click="fetchAttendance(page - 1)"
                :disabled="page <= 1"
                class="p-2 rounded-lg bg-slate-50 hover:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed transition-all">
                <i data-lucide="chevron-left" class="w-4 h-4 text-slate-600"></i>
            </button>
            <button
                @click="fetchAttendance(page + 1)"
                :disabled="page >= lastPage"
                class="p-2 rounded-lg bg-slate-50 hover:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed transition-all">
                <i data-lucide="chevron-right" class="w-4 h-4 text-slate-600"></i>
            </button>
        </div>
    </div>
</div>
