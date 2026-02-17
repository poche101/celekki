<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-6">
        <div
            class="max-w-5xl w-full bg-white rounded-[32px] shadow-2xl shadow-slate-200/60 overflow-hidden flex flex-col md:flex-row min-h-[850px] border border-slate-100">

            {{-- LEFT PANEL --}}
            <div
                class="md:w-5/12 bg-[#0A192F] p-12 flex flex-col justify-between relative overflow-hidden shrink-0">
                <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500/10 rounded-full blur-2xl -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl -ml-24 -mb-24"></div>

                <div class="relative z-10">
                    <!-- LOGO -->
                    <div class="mb-10">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="Christ Embassy Lekki"
                             class="h-16 w-auto">
                    </div>

                    <h2 class="text-3xl font-extrabold text-white mb-6 leading-tight">
                        Christ Embassy <span class="text-orange-500">Lekki</span>
                    </h2>

                    <p class="text-slate-400 text-sm leading-relaxed mb-8">
                        Complete your membership registration to stay connected with fellowship,
                        ministry activities, and official church communications.
                    </p>
                </div>

                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">
                    Secured Membership Platform
                </p>
            </div>

            {{-- RIGHT PANEL --}}
            <div class="md:w-7/12 p-12 bg-[#FDFDFD] overflow-y-auto">
                <div class="mb-10">
                    <h3 class="text-2xl font-bold text-slate-900">Member Registration</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Kindly fill in the details below accurately.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                        <ul class="list-disc ml-5 text-xs font-bold uppercase">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM --}}
                <form action="{{ route('register') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- TITLE & NAME -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                        <div>
                            <label class="text-xs font-semibold text-slate-600">Title</label>
                            <select name="title"
                                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-[#0A192F] focus:ring-0">
                                <option>Brother</option>
                                <option>Sister</option>
                                <option>Pastor</option>
                                <option>Deacon</option>
                                <option>Deaconess</option>
                            </select>
                        </div>

                        <div class="md:col-span-3">
                            <label class="text-xs font-semibold text-slate-600">Full Name</label>
                            <input name="name" value="{{ old('name') }}" required
                                placeholder="Johnathan Doe"
                                class="mt-2 w-full rounded-xl border border-slate-200 px-5 py-3 text-sm shadow-sm focus:border-[#0A192F] focus:ring-0">
                        </div>
                    </div>

                    <!-- EMAIL & PHONE -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-xs font-semibold text-slate-600">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="name@email.com"
                                class="mt-2 w-full rounded-xl border border-slate-200 px-5 py-3 text-sm shadow-sm focus:border-[#0A192F] focus:ring-0">
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-slate-600">Phone Number</label>
                            <input name="phone" value="{{ old('phone') }}"
                                placeholder="+234..."
                                class="mt-2 w-full rounded-xl border border-slate-200 px-5 py-3 text-sm shadow-sm focus:border-[#0A192F] focus:ring-0">
                        </div>
                    </div>

                    <!-- GROUP & CHURCH -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-xs font-semibold text-slate-600">Group</label>
                            <input name="group"
                                class="mt-2 w-full rounded-xl border border-slate-200 px-5 py-3 text-sm shadow-sm focus:border-[#0A192F] focus:ring-0">
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-slate-600">Church</label>
                            <input name="church"
                                value="Christ Embassy Lekki"
                                class="mt-2 w-full rounded-xl border border-slate-200 px-5 py-3 text-sm shadow-sm focus:border-[#0A192F] focus:ring-0">
                        </div>
                    </div>

                    <!-- CELL -->
                    <div>
                        <label class="text-xs font-semibold text-slate-600">Cell Group</label>
                        <input name="cell"
                            class="mt-2 w-full rounded-xl border border-slate-200 px-5 py-3 text-sm shadow-sm focus:border-[#0A192F] focus:ring-0">
                    </div>

                    <!-- PASSWORD -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-xs font-semibold text-slate-600">Password</label>
                            <input type="password" name="password"
                                class="mt-2 w-full rounded-xl border border-slate-200 px-5 py-3 text-sm shadow-sm focus:border-[#0A192F] focus:ring-0">
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-slate-600">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="mt-2 w-full rounded-xl border border-slate-200 px-5 py-3 text-sm shadow-sm focus:border-[#0A192F] focus:ring-0">
                        </div>
                    </div>

                    <!-- SUBMIT -->
                    <button
                        class="w-full rounded-xl bg-[#0A192F] py-4 text-sm font-semibold uppercase tracking-wide text-white shadow-lg hover:bg-[#122b50] transition">
                        Submit
                    </button>
                </form>

                <!-- LOGIN LINK -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-slate-500">
                        Already registered?
                        <a href="{{ route('login') }}"
                           class="font-semibold text-[#0A192F] hover:underline">
                            Login here
                        </a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
