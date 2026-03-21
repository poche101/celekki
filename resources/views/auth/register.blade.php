<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-4 md:p-8 overflow-y-auto">

        <div class="max-w-6xl w-full bg-white rounded-[40px] shadow-2xl shadow-slate-200/60 overflow-hidden flex flex-col md:flex-row min-h-[850px] border border-slate-100 transition-all duration-500">

            {{-- LEFT PANEL: Branding & Visuals --}}
            <div class="hidden md:flex md:w-5/12 bg-[#0A192F] p-12 flex-col justify-between relative overflow-hidden shrink-0">
                <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500/10 rounded-full blur-3xl -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl -ml-40 -mb-40"></div>

                <div class="relative z-10">
                    <div class="mb-12 inline-flex items-center justify-center w-24 h-24 bg-white/5 backdrop-blur-2xl rounded-[32px] border border-white/10 shadow-2xl transition-transform hover:scale-105 duration-300">
                        <img src="{{ asset('images/logo.png') }}" alt="CE Lekki Logo" class="w-14 h-14 object-contain">
                    </div>

                    <h2 class="text-4xl font-extrabold text-white mb-6 leading-tight tracking-tight">
                        Christ Embassy <br><span class="text-orange-500">Lekki</span>
                    </h2>

                    <p class="text-slate-400 text-lg font-medium leading-relaxed max-w-sm">
                        Complete your membership registration to stay connected with fellowship,
                        ministry activities, and official church communications.
                    </p>
                </div>

                <div class="relative z-10">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.3em] bg-white/5 inline-block py-2 px-4 rounded-full border border-white/5">
                        Secured Membership Platform
                    </p>
                </div>
            </div>

            {{-- RIGHT PANEL: Registration Form --}}
            <div class="w-full md:w-7/12 p-8 lg:p-16 bg-[#FDFDFD] overflow-y-auto">
                <div class="max-w-[550px] mx-auto">
                    <div class="mb-10 text-center md:text-left">
                        <h3 class="text-3xl font-black text-slate-900 tracking-tight">Member Registration</h3>
                        <p class="text-slate-500 mt-2 font-medium">
                            Kindly fill in the details below accurately to create your profile.
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl text-red-700">
                            <ul class="list-disc ml-5 text-xs font-bold uppercase tracking-tight">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="md:col-span-1">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 block ml-1">Title</label>
                                <select name="title"
                                    class="w-full rounded-2xl border-2 border-transparent bg-slate-100 px-4 py-4 text-sm font-semibold text-slate-700 focus:bg-white focus:border-[#0A192F] focus:ring-0 transition-all outline-none">
                                    <option>Brother</option>
                                    <option>Sister</option>
                                    <option>Pastor</option>
                                    <option>Deacon</option>
                                    <option>Deaconess</option>
                                </select>
                            </div>

                            <div class="md:col-span-3">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 block ml-1">Full Name</label>
                                <input name="name" value="{{ old('name') }}" required
                                    placeholder="Johnathan Doe"
                                    class="w-full rounded-2xl border-2 border-transparent bg-slate-100 px-5 py-4 text-sm font-semibold focus:bg-white focus:border-[#0A192F] focus:ring-0 transition-all outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 block ml-1">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    placeholder="name@email.com"
                                    class="w-full rounded-2xl border-2 border-transparent bg-slate-100 px-5 py-4 text-sm font-semibold focus:bg-white focus:border-[#0A192F] focus:ring-0 transition-all outline-none">
                            </div>

                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 block ml-1">Phone Number</label>
                                <input name="phone" value="{{ old('phone') }}" required
                                    placeholder="+234..."
                                    class="w-full rounded-2xl border-2 border-transparent bg-slate-100 px-5 py-4 text-sm font-semibold focus:bg-white focus:border-[#0A192F] focus:ring-0 transition-all outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 block ml-1">Group</label>
                                <input name="group" placeholder="Enter Group"
                                    class="w-full rounded-2xl border-2 border-transparent bg-slate-100 px-5 py-4 text-sm font-semibold focus:bg-white focus:border-[#0A192F] focus:ring-0 transition-all outline-none">
                            </div>

                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 block ml-1">Church</label>
                                <input name="church" value="Christ Embassy Lekki"
                                    class="w-full rounded-2xl border-2 border-transparent bg-slate-100 px-5 py-4 text-sm font-semibold focus:bg-white focus:border-[#0A192F] focus:ring-0 transition-all outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 block ml-1">Cell Group</label>
                            <input name="cell" placeholder="Enter Cell Group"
                                class="w-full rounded-2xl border-2 border-transparent bg-slate-100 px-5 py-4 text-sm font-semibold focus:bg-white focus:border-[#0A192F] focus:ring-0 transition-all outline-none">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 block ml-1">Password</label>
                                <input type="password" name="password" required placeholder="••••••••"
                                    class="w-full rounded-2xl border-2 border-transparent bg-slate-100 px-5 py-4 text-sm font-semibold focus:bg-white focus:border-[#0A192F] focus:ring-0 transition-all outline-none">
                            </div>

                            <div>
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 block ml-1">Confirm Password</label>
                                <input type="password" name="password_confirmation" required placeholder="••••••••"
                                    class="w-full rounded-2xl border-2 border-transparent bg-slate-100 px-5 py-4 text-sm font-semibold focus:bg-white focus:border-[#0A192F] focus:ring-0 transition-all outline-none">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-[#0A192F] text-white py-5 rounded-2xl font-bold text-lg shadow-xl shadow-blue-900/20 hover:bg-[#0d2242] active:scale-[0.98] transition-all flex items-center justify-center space-x-3 group mt-4">
                            <span>Register Membership</span>
                            <svg class="w-5 h-5 text-orange-500 group-hover:translate-x-1 transition-transform"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </form>

                    <div class="mt-10 text-center">
                        <p class="text-slate-500 text-sm font-medium">
                            Already registered?
                            <a href="{{ route('login') }}"
                                class="block mt-2 text-[#0A192F] font-extrabold text-base hover:text-orange-600 transition-colors">
                                Login here <span class="text-orange-500 ml-1">→</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
