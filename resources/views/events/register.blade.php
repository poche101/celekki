<div class="min-h-screen bg-slate-50 pb-12">
    <div class="bg-blue-800 p-6 flex items-center gap-4 text-white shadow-lg shadow-blue-100">
        <a href="javascript:history.back()" class="hover:bg-white/10 p-2 rounded-full transition-colors">
            <i data-lucide="arrow-left" class="w-6 h-6"></i>
        </a>
        <h1 class="text-lg font-bold uppercase tracking-tight">Event Registration</h1>
    </div>

    <div class="p-6 max-w-lg mx-auto mt-4">
        <span class="text-slate-400 text-xs font-black uppercase tracking-[0.2em]">You are registering for:</span>
        <h2 class="text-3xl font-black text-slate-900 mt-1 leading-tight">{{ $event->title }}</h2>

        <form action="{{ route('events.register.store', $event->id) }}" method="POST" class="mt-10 space-y-6">
            @csrf

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Full Name</label>
                <div class="relative">
                    <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Enter your full name" required
                           class="w-full pl-12 pr-4 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all @error('full_name') border-red-500 @enderror">
                </div>
                @error('full_name') <p class="text-red-500 text-xs mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Email Address</label>
                <div class="relative">
                    <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" required
                           class="w-full pl-12 pr-4 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all @error('email') border-red-500 @enderror">
                </div>
                @error('email') <p class="text-red-500 text-xs mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Phone Number</label>
                <div class="relative">
                    <i data-lucide="phone" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="e.g. +234..." required
                           class="w-full pl-12 pr-4 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all @error('phone') border-red-500 @enderror">
                </div>
                @error('phone') <p class="text-red-500 text-xs mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Church / Branch</label>
                <div class="relative">
                    <i data-lucide="church" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    <input type="text" name="church" value="{{ old('church') }}" placeholder="Which branch do you attend?" required
                           class="w-full pl-12 pr-4 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all @error('church') border-red-500 @enderror">
                </div>
                @error('church') <p class="text-red-500 text-xs mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Home Group / Cell</label>
                <div class="relative">
                    <i data-lucide="users" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    <input type="text" name="group" value="{{ old('group') }}" placeholder="e.g. Grace Fellowship B" required
                           class="w-full pl-12 pr-4 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all @error('group') border-red-500 @enderror">
                </div>
                @error('group') <p class="text-red-500 text-xs mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-800 hover:bg-blue-900 text-white font-black py-5 rounded-[1.5rem] shadow-xl shadow-blue-100 transition-all transform active:scale-95 mt-6 flex items-center justify-center gap-3">
                <span>Submit Registration</span>
                <i data-lucide="send" class="w-5 h-5"></i>
            </button>
        </form>
    </div>
</div>

<script>
    // Initialize Lucide icons on this page
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
