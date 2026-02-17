<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-6">
        <div class="max-w-md w-full bg-white rounded-[32px] shadow-2xl p-10 text-center border border-slate-100">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h2 class="text-2xl font-black text-slate-900 mb-2">Registration Successful!</h2>
            <p class="text-slate-500 text-sm mb-8">Welcome to Christ Embassy Lekki. Your digital ID has been generated.</p>

            <div class="bg-slate-50 rounded-2xl p-6 mb-8 border border-dashed border-slate-300">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Your Membership Code</p>
                <span class="text-2xl font-mono font-bold text-[#0A192F] tracking-wider">{{ $user->membership_code }}</span>
            </div>

            <a href="{{ route('profile') }}"
               class="block w-full bg-[#0A192F] text-white py-4 rounded-xl font-bold text-sm shadow-xl hover:bg-[#122b50] transition-all">
                Go to My Profile
            </a>
        </div>
    </div>
</x-app-layout>
