<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div x-data="{ show: {{ session('success') ? 'true' : 'false' }} }"
         x-show="show"
         x-init="setTimeout(() => show = false, 4000)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-2 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed top-20 right-5 z-[200] flex items-center p-4 mb-4 w-full max-w-xs text-slate-800 bg-white rounded-2xl shadow-2xl border border-slate-100"
         role="alert"
         x-cloak>
        <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-green-500 bg-green-50 rounded-xl">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="ml-3 text-sm font-bold">{{ session('success') }}</div>
        <button @click="show = false" class="ml-auto -mx-1.5 -my-1.5 bg-white text-slate-400 hover:text-slate-900 rounded-lg p-1.5 inline-flex h-8 w-8">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>

    <div class="min-h-screen bg-[#F8FAFC] font-sans text-slate-900 pb-12" x-data="{ showEditModal: false, showDeleteModal: false }">
        
        <div class="relative h-64 md:h-80 w-full overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A192F] via-[#0D47A1] to-[#0A192F]"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-32 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-[32px] shadow-xl shadow-slate-200/50 overflow-hidden border border-white">
                        <div class="p-8 text-center">
                            <div class="relative inline-block">
                                <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden ring-4 ring-slate-50 shadow-inner bg-slate-100">
                                    @if(auth()->user()->profile_photo_path)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}&background=0D47A1&color=fff&size=256" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                
                                <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                                    @csrf
                                    <label class="absolute bottom-1 right-1 bg-orange-500 hover:bg-orange-600 p-3 rounded-full cursor-pointer shadow-lg transition-all text-white">
                                        <input type="file" name="photo" class="hidden" onchange="document.getElementById('photoForm').submit()">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </label>
                                </form>
                            </div>

                            <h1 class="mt-6 text-2xl font-bold text-slate-800">{{ $user['title'] }} {{ $user['name'] }}</h1>
                            <p class="text-orange-500 font-bold tracking-widest text-sm mt-1">{{ $user['code'] }}</p>
                        </div>

                      <div class="bg-slate-50 p-8 border-t border-slate-100 text-center">
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Membership Token</p>
                        
                        <div class="inline-block p-4 bg-white rounded-2xl shadow-sm border border-slate-100">
                            {{-- Force the value to a string to ensure the QR code reads it correctly --}}
                            {!! QrCode::size(140)
                                ->color(13, 71, 161)
                                ->generate(strval(Auth::user()->membership_code)) 
                            !!}
                        </div>

                        <div class="mt-4">
                            <p class="text-lg font-mono font-bold text-slate-700 tracking-wider">
                                {{ Auth::user()->membership_code }}
                            </p>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-8">
                    <div class="bg-white rounded-[40px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100/80 overflow-hidden relative">
                        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-slate-50 rounded-full blur-3xl opacity-50"></div>

                        <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center relative z-10">
                            <div>
                                <h2 class="font-extrabold text-slate-900 text-xl tracking-tight">Personal Profile</h2>
                                <p class="text-slate-400 text-xs mt-1 font-medium">Manage your verified church identity details</p>
                            </div>
                            <button @click="showEditModal = true"
                                class="group flex items-center space-x-2 px-5 py-2.5 bg-[#0A192F] hover:bg-[#0D47A1] text-white rounded-2xl text-sm font-bold transition-all shadow-lg shadow-blue-900/20 active:scale-95">
                                <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <span>Edit Details</span>
                            </button>
                        </div>

                        <div class="p-10 relative z-10">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-10">
                                <div class="group">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 block group-hover:text-blue-600 transition-colors">Full Name</label>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                                        <p class="text-slate-700 font-bold text-lg">{{ $user['title'] }} {{ $user['name'] }}</p>
                                    </div>
                                </div>

                                <div class="group">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 block group-hover:text-blue-600 transition-colors">Email Address</label>
                                    <div class="flex items-center space-x-3 text-slate-700">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                        <p class="font-bold text-lg">{{ $user['email'] }}</p>
                                    </div>
                                </div>

                                <div class="group">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 block group-hover:text-blue-600 transition-colors">Contact Number</label>
                                    <div class="flex items-center space-x-3 text-slate-700">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                        <p class="font-bold text-lg">{{ $user['phone'] }}</p>
                                    </div>
                                </div>

                                <div class="group">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 block group-hover:text-blue-600 transition-colors">Group</label>
                                    <p class="text-slate-700 font-bold text-lg pl-4 border-l-2 border-slate-100 group-hover:border-blue-500 transition-all">{{ $user['group'] }}</p>
                                </div>

                                <div class="group">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 block group-hover:text-blue-600 transition-colors">Church</label>
                                    <p class="text-slate-700 font-bold text-lg pl-4 border-l-2 border-slate-100 group-hover:border-blue-500 transition-all">{{ $user['church'] }}</p>
                                </div>

                                <div class="group">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-2 block group-hover:text-blue-600 transition-colors">Cell</label>
                                    <p class="text-slate-700 font-bold text-lg pl-4 border-l-2 border-slate-100 group-hover:border-blue-500 transition-all">{{ $user['cell'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-2 rounded-[32px] shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between p-5 bg-slate-50/50 rounded-[24px]">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-white text-blue-600 rounded-2xl shadow-sm flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                                    </div>
                                    <div>
                                        <span class="block font-bold text-slate-800">Alerts</span>
                                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-tighter">Push Notifications</p>
                                    </div>
                                </div>
                                <form action="{{ route('profile.notifications') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="relative inline-flex h-8 w-16 items-center rounded-full transition-all duration-300 focus:outline-none shadow-inner {{ auth()->user()->notifications_enabled ? 'bg-orange-500' : 'bg-slate-300' }}">
                                        <span class="inline-block h-6 w-6 transform rounded-full bg-white shadow-md transition-transform duration-300 ease-in-out {{ auth()->user()->notifications_enabled ? 'translate-x-9' : 'translate-x-1' }}"></span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div @click="showDeleteModal = true" class="bg-white p-2 rounded-[32px] shadow-sm border border-slate-100 hover:border-red-100 group cursor-pointer transition-all">
                            <div class="flex items-center justify-between p-5 bg-red-50/30 group-hover:bg-red-50/80 rounded-[24px] transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-white text-red-500 rounded-2xl shadow-sm flex items-center justify-center group-hover:bg-red-500 group-hover:text-white transition-all">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </div>
                                    <div>
                                        <span class="block font-bold text-slate-800 group-hover:text-red-700">Security</span>
                                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-tighter group-hover:text-red-400">Deactivate Account</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-slate-300 group-hover:text-red-300 transform group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-center lg:justify-end">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="group flex items-center space-x-3 px-6 py-3 rounded-2xl border border-slate-200 bg-white text-slate-500 font-bold text-sm transition-all duration-300 hover:border-red-200 hover:bg-red-50 hover:text-red-600 hover:shadow-md active:scale-95">
                                <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                <span class="tracking-wide">Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="showEditModal" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100"
             class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak>
            
            <div class="bg-white w-full max-w-2xl rounded-[32px] p-8 shadow-2xl" @click.away="showEditModal = false">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800">Edit Profile</h3>
                        <p class="text-slate-400 text-sm font-medium">Update your personal and church affiliation details</p>
                    </div>
                    <button @click="showEditModal = false" class="p-2 hover:bg-slate-100 rounded-full transition text-slate-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-5 max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Title</label>
                            <select name="title" class="w-full mt-1 px-5 py-4 bg-slate-100 border-none rounded-2xl focus:ring-2 focus:ring-[#0A192F]">
                                @foreach(['Brother', 'Sister', 'Deacon', 'Deaconess', 'Pastor'] as $title)
                                    <option value="{{ $title }}" {{ $user['title'] == $title ? 'selected' : '' }}>{{ $title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Full Name</label>
                            <input type="text" name="name" value="{{ $user['name'] }}" class="w-full mt-1 px-5 py-4 bg-slate-100 border-none rounded-2xl focus:ring-2 focus:ring-[#0A192F]">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Address</label>
                            <input type="email" name="email" value="{{ $user['email'] }}" class="w-full mt-1 px-5 py-4 bg-slate-100 border-none rounded-2xl focus:ring-2 focus:ring-[#0A192F]">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Phone Number</label>
                            <input type="text" name="phone" value="{{ $user['phone'] }}" class="w-full mt-1 px-5 py-4 bg-slate-100 border-none rounded-2xl focus:ring-2 focus:ring-[#0A192F]">
                        </div>
                        <div class="md:col-span-2 pt-2 pb-1">
                            <div class="h-px bg-slate-100 w-full"></div>
                            <p class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em] mt-4 ml-1">Church Affiliation</p>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Group</label>
                            <input type="text" name="group" value="{{ $user['group'] }}" class="w-full mt-1 px-5 py-4 bg-slate-100 border-none rounded-2xl focus:ring-2 focus:ring-[#0A192F]">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Church</label>
                            <input type="text" name="church" value="{{ $user['church'] }}" class="w-full mt-1 px-5 py-4 bg-slate-100 border-none rounded-2xl focus:ring-2 focus:ring-[#0A192F]">
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Assigned Cell</label>
                            <input type="text" name="cell" value="{{ $user['cell'] }}" class="w-full mt-1 px-5 py-4 bg-slate-100 border-none rounded-2xl focus:ring-2 focus:ring-[#0A192F]">
                        </div>
                    </div>
                    <button type="submit" class="mt-8 w-full bg-[#0A192F] text-white py-5 rounded-[24px] font-bold text-lg shadow-lg shadow-blue-900/20 hover:bg-[#0D47A1] active:scale-[0.98] transition-all">
                        Update Profile
                    </button>
                </form>
            </div>
        </div>

        <div x-show="showDeleteModal" x-transition class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-red-950/40 backdrop-blur-sm" x-cloak>
            <div class="bg-white w-full max-w-md rounded-[32px] p-8 shadow-2xl text-center" @click.away="showDeleteModal = false">
                <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-800">Delete Account?</h3>
                <p class="text-slate-500 mt-2">This action is permanent and your membership token will be invalidated.</p>
                <div class="mt-10 flex flex-col space-y-3">
                    <form action="{{ route('profile.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white py-4 rounded-2xl font-bold hover:bg-red-700 transition active:scale-95">
                            Confirm Delete
                        </button>
                    </form>
                    <button @click="showDeleteModal = false" class="w-full py-4 text-slate-500 font-bold hover:bg-slate-100 rounded-2xl transition">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</x-app-layout>