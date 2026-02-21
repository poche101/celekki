<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Celekki Church</title>

    <meta name="theme-color" content="#006eb5">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>

    @if(app()->environment('production') && config('services.google.analytics_id'))
        @include('admin.partials.analytics')
    @endif

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }

        .nav-link-ltr { position: relative; cursor: pointer; }
        .nav-link-ltr::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 5px;
            right: 0;
            background: #006eb5;
            transition: width .3s ease;
        }
        .nav-link-ltr:hover::after { width: 100%; left: 0; }
        .nav-force-white { background-color: #ffffff !important; }
        .text-brand-blue { color: #006eb5 !important; }
        .border-brand-blue { border-color: #006eb5 !important; }
        .bg-brand-blue { background-color: #006eb5 !important; }

        /* Smooth Dropdown Animation */
        .dropdown-animate {
            transform-origin: top;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .modal-backdrop { background-color: rgba(15, 23, 42, 0.5); backdrop-filter: blur(8px); }

        /* PWA Install Banner Style */
        #pwa-install-banner {
            display: none;
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 450px;
            background: #006eb5;
            color: white;
            padding: 20px;
            border-radius: 24px;
            z-index: 9999;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body class="bg-white text-black antialiased"
    x-data="{
        mobileMenuOpen: false,
        mobilePagesOpen: false,
        pagesDropdown: false,
        profileDropdown: false,
        isLoggingOut: false,
        liveModalOpen: {{ session('show_live_modal') ? 'true' : 'false' }},
        hasLiveAccess: {{ session('live_access_granted') ? 'true' : 'false' }},
        isSubmitting: false,
        toasts: [],
        liveForm: {
            name: '{{ auth()->check() ? auth()->user()->name : '' }}',
            phone: '{{ auth()->check() ? auth()->user()->phone : '' }}'
        },

        init() {
            this.$watch('liveModalOpen', value => {
                if (value) {
                    this.$nextTick(() => { lucide.createIcons(); });
                }
            });
            this.$watch('mobileMenuOpen', value => {
                if (value) {
                    this.$nextTick(() => { lucide.createIcons(); });
                }
            });
        },

        addToast(message, type = 'success') {
            const id = Date.now();
            this.toasts.push({ id, message, type });
            setTimeout(() => {
                this.toasts = this.toasts.filter(t => t.id !== id);
            }, 4000);
        },

        checkLiveAccess(e) {
            if (e) e.preventDefault();
            if (this.hasLiveAccess) {
                window.location.href = '/live';
            } else {
                this.liveModalOpen = true;
                this.mobileMenuOpen = false;
            }
        },

        async submitLiveForm() {
            this.isSubmitting = true;
            try {
                const response = await fetch('/api/live/attendance', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.liveForm)
                });

                if (response.ok) {
                    this.hasLiveAccess = true;
                    this.addToast('Verification successful! Joining stream...');
                    setTimeout(() => { window.location.href = '/live'; }, 1000);
                } else {
                    const data = await response.json();
                    this.addToast(data.message || 'Verification failed.', 'error');
                }
            } catch (error) {
                this.addToast('Connection error.', 'error');
            } finally {
                this.isSubmitting = false;
            }
        },

        async handleLogout() {
            this.isLoggingOut = true;
            this.profileDropdown = false;
            this.mobileMenuOpen = false;
            this.hasLiveAccess = false;

            try {
                const response = await fetch('{{ route('logout') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                });

                if (response.ok) {
                    window.location.href = '/';
                } else {
                    this.isLoggingOut = false;
                    this.addToast('Logout failed.', 'error');
                }
            } catch (error) {
                this.isLoggingOut = false;
                this.addToast('Server error.', 'error');
            }
        }
    }">

    <div id="pwa-install-banner">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-white rounded-xl flex-shrink-0 flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" class="h-6 w-auto">
            </div>
            <div>
                <h3 class="font-bold text-lg leading-tight">Install CE Lekki App</h3>
                <p class="text-sm opacity-90">Add to home screen for quick access</p>
            </div>
        </div>
        <div class="flex space-x-3">
            <button id="btn-install" class="flex-1 bg-white text-brand-blue font-bold py-3 rounded-xl active:scale-95 transition-transform">Install Now</button>
            <button id="btn-close" class="px-5 py-3 border border-white/30 rounded-xl font-medium active:scale-95 transition-transform">Later</button>
        </div>
    </div>

    <div class="fixed bottom-6 right-6 z-[300] flex flex-col space-y-3">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                :class="toast.type === 'success' ? 'bg-slate-900' : 'bg-red-600'"
                class="px-6 py-4 rounded-2xl shadow-2xl text-white flex items-center space-x-3 min-w-[300px]">
                <template x-if="toast.type === 'success'"><i data-lucide="check-circle" class="w-5 h-5 text-green-400"></i></template>
                <template x-if="toast.type === 'error'"><i data-lucide="alert-circle" class="w-5 h-5 text-white"></i></template>
                <span class="font-semibold text-[15px]" x-text="toast.message"></span>
            </div>
        </template>
    </div>

    <nav class="sticky top-0 z-50 bg-white border-b border-slate-100 shadow-sm">
        <div class="container-fluid px-6 lg:px-12 mx-auto">
            <div class="flex justify-between h-24 items-center">
                <div class="flex-shrink-0">
                    <a href="/"><img src="{{ asset('images/logo.png') }}" alt="Celekki Logo" class="h-20 "></a>
                </div>

                <div class="hidden lg:flex items-center space-x-12">
                    <div class="flex space-x-10 text-[22px] font-medium tracking-tight text-black items-center">
                        <a href="/" class="nav-link-ltr">Home</a>
                        <a href="/about" class="nav-link-ltr">About</a>

                        <div class="relative group"
                             @mouseenter="pagesDropdown = true"
                             @mouseleave="pagesDropdown = false">
                            <button class="nav-link-ltr flex items-center gap-1 py-4 focus:outline-none">
                                Pages
                                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180"></i>
                            </button>

                            <div x-show="pagesDropdown"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                 class="absolute left-0 w-72 bg-white rounded-[24px] shadow-2xl border border-slate-50 py-4 overflow-hidden" x-cloak>

                                <a href="{{ url('/find-center') }}" class="group flex items-center gap-4 px-6 py-4 hover:bg-slate-50 transition-colors">
                                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-[17px] font-bold text-slate-900">Mid-WeekService Centers</p>
                                        <p class="text-xs text-slate-500">Find a center near you</p>
                                    </div>
                                </a>

                                <a href="{{ route('testimonies.index') }}" class="group flex items-center gap-4 px-6 py-4 hover:bg-slate-50 transition-colors">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all">
                                        <i data-lucide="heart-handshake" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-[17px] font-bold text-slate-900">Testimonies</p>
                                        <p class="text-xs text-slate-500">Voices of impact</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <a href="{{ route('events.index') }}" class="nav-link-ltr">Events</a>
                        <a href="/h-life" class="nav-link-ltr">Higher Life</a>
                    </div>

                    <div class="flex items-center space-x-8">
                        <button @click="checkLiveAccess" class="text-[20px] font-semibold text-black hover:opacity-70 transition flex items-center cursor-pointer focus:outline-none">
                            <span class="relative flex h-3 w-3 mr-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-600"></span>
                            </span>
                            Live Stream
                        </button>

                        @guest
                            <a href="/login" class="flex items-center space-x-3 text-[18px] font-bold text-brand-blue border-2 border-brand-blue px-7 py-2.5 rounded-full hover:bg-brand-blue hover:text-white transition-all active:scale-95">
                                <i data-lucide="user" class="w-5 h-5"></i>
                                <span>Login</span>
                            </a>
                        @endguest

                        @auth
                            <div class="relative" x-show="!isLoggingOut">
                                <button @click.stop="profileDropdown = !profileDropdown" @click.away="profileDropdown = false" class="focus:outline-none group">
                                    <div class="w-14 h-14 bg-slate-50 border border-slate-200 rounded-full flex items-center justify-center group-hover:border-brand-blue group-hover:shadow-lg transition-all duration-300 overflow-hidden">
                                        @if(auth()->user()->profile_photo_path)
                                            <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="w-full h-full object-cover">
                                        @else
                                            <i data-lucide="user" class="w-8 h-8 text-brand-blue"></i>
                                        @endif
                                    </div>
                                </button>
                                <div x-show="profileDropdown" x-transition class="absolute right-0 mt-6 w-64 bg-white border border-slate-100 rounded-[24px] shadow-2xl py-3 z-[100]">
                                    <a href="/profile" class="block px-6 py-4 text-[17px] font-semibold text-black hover:bg-slate-50">My Profile</a>
                                    <button @click="handleLogout()" class="w-full text-left px-6 py-4 text-[17px] font-semibold text-red-600 hover:bg-red-50">Sign Out</button>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="lg:hidden">
                    <button @click="mobileMenuOpen = true" class="flex flex-col items-end space-y-1.5 p-2 focus:outline-none">
                        <span class="w-8 h-0.5 bg-brand-blue rounded-full"></span>
                        <span class="w-8 h-0.5 bg-brand-blue rounded-full"></span>
                        <span class="w-5 h-0.5 bg-brand-blue rounded-full"></span>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen" class="fixed inset-0 z-[100]" x-cloak>
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md" @click="mobileMenuOpen = false"></div>
            <div x-show="mobileMenuOpen"
                 x-transition:enter="transform transition duration-500"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 class="absolute right-0 h-full w-[85%] max-w-sm bg-brand-blue shadow-2xl flex flex-col z-[110]">

                <div class="bg-white px-10 py-8 flex justify-between items-center shadow-md">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20">
                    <button @click="mobileMenuOpen = false" class="text-brand-blue focus:outline-none">
                        <i data-lucide="x" class="w-9 h-9"></i>
                    </button>
                </div>

                <div class="flex-grow flex flex-col p-10 space-y-6 overflow-y-auto">
                    @auth
                        <div class="pb-6 border-b border-white/20 mb-2">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-white/10 rounded-full border-2 border-white/30 flex items-center justify-center overflow-hidden">
                                    @if(auth()->user()->profile_photo_path)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="w-full h-full object-cover">
                                    @else
                                        <i data-lucide="user" class="w-8 h-8 text-white"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-white font-medium text-xl">{{ auth()->user()->name }}</p>
                                    <a href="/profile" class="text-white/60 text-sm flex items-center hover:text-white">
                                        View Profile <i data-lucide="chevron-right" class="w-3 h-3 ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endauth

                    <a href="/" class="text-[20px] text-white">Home</a>
                    <a href="/about" class="text-[20px] text-white">About</a>

                    <div class="space-y-4">
                        <button @click="mobilePagesOpen = !mobilePagesOpen" class="w-full flex justify-between items-center text-[20px] text-white focus:outline-none">
                            Pages
                            <i data-lucide="chevron-down" class="transition-transform" :class="mobilePagesOpen ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="mobilePagesOpen" x-collapse class="pl-6 space-y-4">
                            <a href="{{ url('/find-center') }}" class="block text-[20px] text-white/80">Mid-Week Centers</a>
                            <a href="{{ route('testimonies.index') }}" class="block text-[20px] text-white/80">Testimonies</a>
                        </div>
                    </div>

                    <a href="{{ route('events.index') }}" class="text-[20px] text-white">Events</a>
                    <a href="/h-life" class="text-[20px] text-white">Higher Life</a>

                    <button @click="checkLiveAccess" class="text-[20px] font-medium text-white flex items-center focus:outline-none">
                        <span class="w-2.5 h-2.5 bg-red-500 rounded-full mr-3 animate-pulse"></span>Live Stream
                    </button>

                    <div class="pt-10">
                        @auth
                            <button @click="handleLogout()" class="w-full border-2 border-white text-white py-4 rounded-2xl font-bold flex items-center justify-center space-x-2">
                                <i data-lucide="log-out" class="w-5 h-5"></i>
                                <span>Sign Out</span>
                            </button>
                        @else
                            <a href="/login" class="w-full border-2 border-white text-white py-4 rounded-2xl block text-center font-bold">Login</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div x-show="liveModalOpen" class="fixed inset-0 z-[200] flex items-center justify-center p-4" x-cloak>
        <div class="absolute inset-0 modal-backdrop" @click="liveModalOpen = false"></div>
        <div class="relative bg-white w-full max-w-lg rounded-[32px] shadow-2xl overflow-hidden p-8 md:p-12">
            <div class="flex flex-col items-center text-center mb-10">
                <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mb-6">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
                </div>
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Join Our Service</h2>
                <p class="text-slate-500">Please provide your details to access the live stream.</p>
            </div>
            <form @submit.prevent="submitLiveForm" class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">Full Name</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                        <input type="text" x-model="liveForm.name" required class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:border-brand-blue" placeholder="Enter name">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">Phone Number</label>
                    <div class="relative">
                        <i data-lucide="phone" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                        <input type="tel" x-model="liveForm.phone" required class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl outline-none focus:border-brand-blue" placeholder="+234...">
                    </div>
                </div>
                <button type="submit" :disabled="isSubmitting" class="w-full bg-brand-blue text-white py-5 rounded-2xl font-bold text-lg shadow-xl hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center space-x-3 disabled:opacity-70">
                    <span x-text="isSubmitting ? 'Verifying...' : 'Access Live Stream'"></span>
                    <i x-show="!isSubmitting" data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
            </form>
        </div>
    </div>

    <main>{{ $slot }}</main>

    <script>
        let deferredPrompt;
        const installBanner = document.getElementById('pwa-install-banner');
        const installBtn = document.getElementById('btn-install');
        const closeBtn = document.getElementById('btn-close');

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            // Check if user has already dismissed it this session
            if (!sessionStorage.getItem('pwa-banner-dismissed')) {
                installBanner.style.display = 'block';
            }
        });

        installBtn.addEventListener('click', async () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;
                if (outcome === 'accepted') {
                    console.log('User accepted install');
                }
                deferredPrompt = null;
                installBanner.style.display = 'none';
            }
        });

        closeBtn.addEventListener('click', () => {
            installBanner.style.display = 'none';
            sessionStorage.setItem('pwa-banner-dismissed', 'true');
        });

        window.addEventListener('appinstalled', () => {
            installBanner.style.display = 'none';
        });

        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
</body>
</html>
