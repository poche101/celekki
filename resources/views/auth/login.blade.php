<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-4 md:p-8">

        <div
            class="max-w-6xl w-full bg-white rounded-[40px] shadow-2xl shadow-slate-200/60 overflow-hidden flex flex-col md:flex-row min-h-[700px]">

            <div class="hidden md:flex md:w-1/2 bg-[#0A192F] relative items-center justify-center p-12 overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500/10 rounded-full blur-3xl -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl -ml-48 -mb-48"></div>

                <div class="relative z-10 max-w-md text-center">
                    <div
                        class="mb-8 inline-flex items-center justify-center w-20 h-20 bg-white/5 backdrop-blur-2xl rounded-[32px] border border-white/10 shadow-2xl">
                        <img src="{{ asset('images/logo.png') }}" alt="CE Lekki Logo" class="w-12 h-12 object-contain">
                    </div>
                    <h2 class="text-4xl font-extrabold text-white leading-tight mb-4 tracking-tight">Welcome To CE Lekki
                    </h2>
                    <p class="text-slate-400 text-lg font-medium">Stay connected with the Word, track your growth</p>
                </div>
            </div>

            <div class="w-full md:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-[#FDFDFD]">
                <div class="max-w-sm w-full">
                    <div class="mb-10">
                        <h3 class="text-3xl font-black text-slate-900 tracking-tight">Welcome Back</h3>
                        <p class="text-slate-500 mt-2 font-medium">Please sign in to your membership account.</p>
                    </div>

                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label
                                class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1">Email
                                Address</label>
                            <div class="relative group">
                                <span
                                    class="absolute inset-y-0 left-5 flex items-center text-slate-400 group-focus-within:text-[#0A192F] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        stroke-width="2">
                                        <path
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                                    </svg>
                                </span>
                                <input name="email" type="email" value="{{ old('email') }}" required
                                    placeholder="your@email.com"
                                    class="w-full pl-12 pr-5 py-4 bg-slate-100 border-2 border-transparent rounded-2xl focus:bg-white focus:border-[#0A192F] focus:ring-0 transition-all font-medium outline-none">
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-2 font-semibold ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-2 ml-1">
                                <label
                                    class="text-xs font-bold text-slate-500 uppercase tracking-widest">Password</label>
                            </div>
                            <div class="relative group">
                                <span
                                    class="absolute inset-y-0 left-5 flex items-center text-slate-400 group-focus-within:text-[#0A192F] transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                </span>
                                <input name="password" type="password" required placeholder="••••••••"
                                    class="w-full pl-12 pr-5 py-4 bg-slate-100 border-2 border-transparent rounded-2xl focus:bg-white focus:border-[#0A192F] focus:ring-0 transition-all font-medium outline-none">
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-2 font-semibold ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center ml-1">
                            <input type="checkbox" name="remember" id="remember"
                                class="w-4 h-4 text-[#0A192F] border-slate-300 rounded focus:ring-[#0A192F] cursor-pointer">
                            <label for="remember" class="ml-2 text-sm font-semibold text-slate-500 cursor-pointer">Keep
                                me signed in</label>
                        </div>

                        <button type="submit"
                            class="w-full bg-[#0A192F] text-white py-5 rounded-2xl font-bold text-lg shadow-xl shadow-blue-900/20 hover:bg-[#0d2242] active:scale-[0.98] transition-all flex items-center justify-center space-x-3 group">
                            <span>Sign In</span>
                            <svg class="w-5 h-5 text-orange-500 group-hover:translate-x-1 transition-transform"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </form>

                    <div class="mt-12 text-center">
                        <p class="text-slate-500 text-sm font-medium">
                            Don't have an account?
                            <a href="{{ route('register') }}"
                                class="block mt-2 text-[#0A192F] font-extrabold text-base hover:text-orange-600 transition-colors">
                                Create an account <span class="text-orange-500 ml-1">→</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
