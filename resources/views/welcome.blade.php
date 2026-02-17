<x-app-layout>
    <style>
        /* Custom Two-Part Thick Blue Underline */
        .premium-underline {
            position: relative;
            display: inline-block;
            padding-bottom: 24px; /* Space for the underline */
        }

        /* The Longer Part */
        .premium-underline::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-110%);
            width: 80px;
            height: 6px; /* Thicker height */
            background-color: #2563eb; /* Tailwind blue-600 */
            border-radius: 99px;
        }

        /* The Shorter Part */
        .premium-underline::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(20%);
            width: 30px;
            height: 6px; /* Thicker height */
            background-color: #2563eb; /* Tailwind blue-600 */
            border-radius: 99px;
        }

        /* Left-aligned version for the CTA section */
        .premium-underline-left {
            position: relative;
            display: inline-block;
            padding-bottom: 24px;
        }

        .premium-underline-left::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 6px;
            background-color: #ffffff; /* White for dark background */
            border-radius: 99px;
        }

        .premium-underline-left::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 95px;
            width: 30px;
            height: 6px;
            background-color: #ffffff; /* White for dark background */
            border-radius: 99px;
            opacity: 0.6; /* Slightly transparent for the short part on dark bg */
        }
    </style>

<header class="relative w-full h-auto lg:h-[80vh] lg:min-h-[600px] flex items-center justify-center overflow-hidden bg-white">
    <div class="relative lg:absolute lg:inset-0 z-0 w-full">
        <img src="/images/hero.png"
             class="w-full h-auto lg:h-full object-contain lg:object-cover"
             alt="Church Sanctuary">

        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/10 to-transparent pointer-events-none"></div>
    </div>
</header>

    <section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            <div class="group cursor-pointer flex flex-col">
                <div class="relative h-80 mb-8 overflow-hidden rounded-[2rem] shadow-2xl shadow-blue-900/10">
                    <img src="/images/ce3.jpeg"
                         class="w-full h-full object-cover transition duration-1000 ease-out group-hover:scale-110"
                         alt="Fellowship">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-950/80 via-transparent to-transparent opacity-60"></div>
                </div>

                <div class="flex-grow">
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors duration-300">
                        Worship With Us
                    </h3>
                    <p class="text-slate-600 leading-relaxed font-normal mb-6 line-clamp-4">
                        The Lord has called us to do big things for Him and His Kingdom, and we want to do them together with you. Join us and let’s serve Him together as a vital part of our vision.
                    </p>
                </div>

                <a href="/about" class="inline-flex items-center text-sm font-bold tracking-wider uppercase text-blue-600 group/link">
                    <span class="mr-2">Learn More</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-300 transform group-hover/link:translate-x-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <div class="group cursor-pointer flex flex-col">
                <div class="relative h-80 mb-8 overflow-hidden rounded-[2rem] shadow-2xl shadow-blue-900/10">
                    <img src="/images/ce1.jpeg"
                         class="w-full h-full object-cover transition duration-1000 ease-out group-hover:scale-110"
                         alt="Global Impact">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-950/80 via-transparent to-transparent opacity-60"></div>
                </div>

                <div class="flex-grow">
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors duration-300">
                        Our Vision
                    </h3>
                    <p class="text-slate-600 leading-relaxed font-normal mb-6 line-clamp-4">
                        To take His divine presence to the peoples and nations of the world, and to demonstrate the character of His Spirit everywhere. Fulfilling a definite and divine purpose.
                    </p>
                </div>

                <a href="/about" class="inline-flex items-center text-sm font-bold tracking-wider uppercase text-blue-600 group/link">
                    <span class="mr-2">LEARN MORE</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-300 transform group-hover/link:translate-x-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <div class="group cursor-pointer flex flex-col">
                <div class="relative h-80 mb-8 overflow-hidden rounded-[2rem] shadow-2xl shadow-blue-900/10">
                    <img src="/images/online.jpg"
                         class="w-full h-full object-cover transition duration-1000 ease-out group-hover:scale-110"
                         alt="Digital Ministry">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-950/80 via-transparent to-transparent opacity-60"></div>
                </div>

                <div class="flex-grow">
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors duration-300">
                        Worship Online
                    </h3>
                    <p class="text-slate-600 leading-relaxed font-normal mb-6 line-clamp-4">
                        A welcoming space where worship, teaching, and fellowship come together—no matter where you are. Join us live from the comfort of your home and grow in God’s Word.
                    </p>
                </div>

                <a href="" class="inline-flex items-center text-sm font-bold tracking-wider uppercase text-blue-600 group/link">
                    <span class="mr-2">Join Stream</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-300 transform group-hover/link:translate-x-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>



    <section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        {{-- The Master Banner --}}
        <div class="bg-blue-900 rounded-[40px] p-8 lg:p-16 shadow-2xl relative overflow-hidden">

            {{-- Decorative Background Elements --}}
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-400/10 rounded-full -mr-48 -mt-48 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-500/10 rounded-full -ml-32 -mb-32 blur-3xl"></div>

            <div class="relative z-10 flex flex-col lg:flex-row items-center gap-12">

                {{-- Left Side: Text Content --}}
                <div class="flex-1 text-center lg:text-left">
                    <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest text-blue-200 uppercase bg-blue-800/50 rounded-full border border-blue-700/50">
                        Featured Broadcast
                    </span>
                    <h2 class="text-4xl md:text-6xl font-extrabold text-white mb-8 leading-[1.1]">
                        Take the Word <br>
                        <span class="text-blue-400">On The Go</span>
                    </h2>
                    <p class="text-blue-100/70 text-lg mb-10 max-w-lg mx-auto lg:mx-0 leading-relaxed">
                        Watch The Higher Life With Pastor Deola Phillips. Stay updated by scanning the portal. Your spiritual life, simplified.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center gap-6 justify-center lg:justify-start">
                        <a href="/h-life" class="px-8 py-4 bg-white text-blue-900 rounded-2xl font-bold hover:bg-blue-50 transition-colors shadow-lg shadow-blue-900/20">
                            Watch More Episodes
                        </a>
                        <button class="flex items-center text-white/80 font-medium hover:text-white transition-colors group">
                            <span class="w-10 h-10 flex items-center justify-center rounded-full border border-white/20 mr-3 group-hover:bg-white/10">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"/></svg>
                            </span>
                            Live Stream Schedule
                        </button>
                    </div>
                </div>

                {{-- Right Side: The Interactive Video Card --}}
                <div class="flex-1 w-full max-w-2xl relative">
                    {{-- The Card --}}
                    <div class="bg-white rounded-[32px] p-3 shadow-2xl transform lg:rotate-2 hover:rotate-0 transition-transform duration-700">

                        {{-- Video Player Container --}}
                        <div class="relative rounded-[24px] overflow-hidden bg-slate-900 aspect-video group">
                            <video
                                class="w-full h-full object-cover"
                                poster="/images/sons.png"
                                controls>
                                <source src="https://8v4o6w73awqp-hls-push.5centscdn.com/EPISODE%205%20Repackaged.mp4/playlist.m3u8" type="application/x-mpegURL">
                            </video>
                        </div>

                        {{-- Metadata below video inside card --}}
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-blue-600 font-bold text-xs uppercase tracking-widest">Now Streaming</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">The Higher Life — Episode 13</h3>
                        </div>
                    </div>

                    {{-- Abstract glass element behind card --}}
                    <div class="absolute -bottom-6 -right-6 w-full h-full bg-white/10 rounded-[32px] -z-10 blur-sm"></div>
                </div>

            </div>
        </div>

    </div>
</section>


<section class="py-24 bg-slate-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="max-w-2xl">
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-8 leading-tight">
                    <span class="premium-underline-container">Life Transforming Testimonies</span>
                </h2>
                <p class="text-slate-500 text-lg font-medium">
                    Hear from our global family about the impact of the Word and the supernatural experience at Christ Embassy Lagos Zone 5.
                </p>
            </div>

            <div class="flex gap-3">
                <button class="v-prev bg-white border border-slate-200 text-slate-900 p-4 rounded-full hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="v-next bg-white border border-slate-200 text-slate-900 p-4 rounded-full hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <div class="swiper testimonial-slider !overflow-visible">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="bg-white p-10 rounded-[3rem] h-full shadow-xl shadow-blue-900/5 border border-slate-100 flex flex-col">
                        <div class="flex text-blue-600 mb-6 gap-1">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-xl text-slate-700 leading-relaxed font-medium mb-10 flex-grow">
                            For over a month, I suffered from severe headaches and unbearable toothaches. Thankfully, I was able to attend “A Day of Blessings.” When our esteemed pastor prayed for us during the program, I received immediate healing. The headache and toothache completely disappeared! Now I’m pain-free. Glory be to God!
                        </p>
                        <div class="flex items-center gap-5 pt-6 border-t border-slate-100">
                            <div class="w-14 h-14 rounded-2xl bg-blue-600 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-200">E</div>
                            <div>
                                <h4 class="font-black text-slate-900 text-lg">Esther</h4>
                                <p class="text-xs font-black text-blue-600 uppercase tracking-[0.2em]">Healed from Severe Headache and Toothache</p>
                            </div>
                        </div>
                    </div>
                </div>

               <div class="swiper-slide">
                    <div class="bg-white p-10 rounded-[3rem] h-full shadow-xl shadow-blue-900/5 border border-slate-100 flex flex-col">
                        <div class="flex text-blue-600 mb-6 gap-1">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-xl text-slate-700 leading-relaxed font-medium mb-10 flex-grow">
                            For over a year, I had been experiencing involuntary discharge of blood. From time to time, I would just find myself bleeding. Glory to God, at “A Day of Blessings” program, I was healed by the power of God. Hallelujah, hallelujah!
                        </p>
                        <div class="flex items-center gap-5 pt-6 border-t border-slate-100">
                            <div class="w-14 h-14 rounded-2xl bg-blue-600 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-200">T</div>
                            <div>
                                <h4 class="font-black text-slate-900 text-lg">Tosin</h4>
                                <p class="text-xs font-black text-blue-600 uppercase tracking-[0.2em]">Healed from a Year of Involuntary Bleeding</p>
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="swiper-slide">
                    <div class="bg-white p-10 rounded-[3rem] h-full shadow-xl shadow-blue-900/5 border border-slate-100 flex flex-col">
                        <div class="flex text-blue-600 mb-6 gap-1">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-xl text-slate-700 leading-relaxed font-medium mb-10 flex-grow">
                            Prior to this time, bending down or sitting was quite difficult for me because I would experience severe pains around my waist in the process. This also made sleeping difficult. As I participated in 'A Day of Blessings,' I received my healing completely. Right now, all the pains are gone. I can bend and sit now without pain, and I sleep soundly like a baby. Glory to God!
                        </p>
                        <div class="flex items-center gap-5 pt-6 border-t border-slate-100">
                            <div class="w-14 h-14 rounded-2xl bg-blue-600 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-200">W</div>
                            <div>
                                <h4 class="font-black text-slate-900 text-lg">Wealth</h4>
                                <p class="text-xs font-black text-blue-600 uppercase tracking-[0.2em]">Healed from Waist Pain</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    /* 1. FIXED PREMIUM UNDERLINE - Placed properly under the text */
    .premium-underline-container {
        position: relative;
        padding-bottom: 24px;
        display: inline-block;
    }

    .premium-underline-container::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 70px;
        height: 7px;
        background-color: #2563eb;
        border-radius: 99px;
    }

    .premium-underline-container::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 82px;
        width: 25px;
        height: 7px;
        background-color: #2563eb;
        border-radius: 99px;
        opacity: 0.4;
    }

    /* 2. SLIDER SPACING - Making it look industry standard */
    .swiper-slide {
        height: auto !important; /* Forces slides to equal height */
        padding: 10px; /* Prevents shadow clipping */
    }

    .testimonial-slider {
        cursor: grab;
    }

    .testimonial-slider:active {
        cursor: grabbing;
    }
</style>


<div class="fixed bottom-8 right-8 z-[100] flex flex-col-reverse items-center gap-4 group">

    <button id="socialToggle"
            class="w-16 h-16 bg-blue-600 text-white rounded-full shadow-2xl shadow-blue-900/40 flex items-center justify-center transition-all duration-500 hover:scale-110 active:scale-95 z-20 relative">
        <i data-lucide="message-circle" id="chatIcon" class="w-8 h-8 absolute transition-all duration-500"></i>
        <i data-lucide="x" id="closeIcon" class="w-8 h-8 absolute transition-all duration-500 opacity-0 rotate-[-90deg]"></i>
    </button>

    <div id="socialList" class="flex flex-col-reverse items-center gap-4 mb-2 pointer-events-none opacity-0 translate-y-10 transition-all duration-500">

        <a href="https://wa.me/yourlink" target="_blank"
           class="social-item w-12 h-12 bg-green-500 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
           title="WhatsApp">
            <i data-lucide="message-square" class="w-5 h-5"></i>
        </a>

        <a href="https://www.instagram.com/celekki?igsh=MWVvZGY1cDN4bHo4bw==" target="_blank"
           class="social-item w-12 h-12 bg-gradient-to-tr from-yellow-500 via-red-500 to-purple-600 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
           title="Instagram">
            <i data-lucide="instagram" class="w-5 h-5"></i>
        </a>

        <a href="tiktok.com/@christembassylekki" target="_blank"
           class="social-item w-12 h-12 bg-black text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
           title="TikTok">
            <i data-lucide="music-2" class="w-5 h-5"></i>
        </a>

        <a href="https://x.com/celagoszone5" target="_blank"
           class="social-item w-12 h-12 bg-slate-900 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
           title="X (Twitter)">
            <i data-lucide="twitter" class="w-5 h-5"></i>
        </a>

        <a href="https://www.facebook.com/share/1XmcTZrjPe/" target="_blank"
           class="social-item w-12 h-12 bg-blue-700 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
           title="Facebook">
            <i data-lucide="facebook" class="w-5 h-5"></i>
        </a>

        <a href="" target="_blank"
           class="social-item w-12 h-12 bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
           title="YouTube">
            <i data-lucide="youtube" class="w-5 h-5"></i>
        </a>

        <a href="https://www.kingsch.at/p/eUM3MVd" target="_blank"
           class="social-item w-12 h-12 bg-blue-400 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform"
           title="KingsChat">
            <img src="/images/kingschat.png" alt="">
        </a>
    </div>
</div>

<style>
    /* Class applied via JS to show the menu */
    .menu-active #socialList {
        opacity: 1 !important;
        translate: 0 0 !important;
        pointer-events: auto !important;
    }

    /* Rotate and Swap Main Icons */
    .menu-active #chatIcon {
        opacity: 0;
        rotate: 90deg;
    }
    .menu-active #closeIcon {
        opacity: 1;
        rotate: 0deg;
    }

    /* Staggered entrance for each icon */
    .menu-active .social-item:nth-child(1) { transition-delay: 50ms; }
    .menu-active .social-item:nth-child(2) { transition-delay: 100ms; }
    .menu-active .social-item:nth-child(3) { transition-delay: 150ms; }
    .menu-active .social-item:nth-child(4) { transition-delay: 200ms; }
    .menu-active .social-item:nth-child(5) { transition-delay: 250ms; }
</style>


<section class="py-20 bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row bg-white rounded-[3rem] shadow-2xl shadow-blue-900/10 overflow-hidden border border-slate-100">

            <div class="w-full lg:w-1/2 p-10 md:p-16 flex flex-col justify-center order-2 lg:order-1">
                <div class="mb-8">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-blue-200">
                        <i data-lucide="map-pin" class="w-7 h-7"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-4 tracking-tight">Worship With Us</h2>
                    <div class="space-y-1">
                        <p class="text-xl font-black text-blue-600">Christ Embassy Lekki</p>
                        <p class="text-slate-500 font-medium leading-relaxed">
                            LoveWorld Arena, Aare Bashiru Street, Chisco B/S<br>
                            Lekki-Epe Expressway, Lagos
                        </p>
                    </div>
                </div>

                <div class="bg-slate-50 p-8 rounded-[2rem] mb-8 border border-slate-100">
                    <label class="block text-sm font-black uppercase tracking-widest text-slate-400 mb-4">Plan Your Visit</label>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <input type="text"
                               id="userLocation"
                               placeholder="Enter your current location..."
                               class="flex-1 px-6 py-4 rounded-xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-blue-600 transition-all text-slate-900 placeholder:text-slate-300 font-medium">

                        <button onclick="calculateRoute()"
                                class="bg-slate-900 text-white px-8 py-4 rounded-xl font-black hover:bg-blue-600 transition-all duration-300 flex items-center justify-center gap-2 group">
                            Directions
                            <i data-lucide="navigation" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                    <p class="mt-4 text-xs text-slate-400 font-medium">We'll open your route in a new tab using Google Maps.</p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-6 justify-between pt-6 border-t border-slate-100">
                    <div class="flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i data-lucide="phone" class="w-5 h-5"></i>
                        </div>
                        <span class="font-black text-slate-900">+234 907 641 5312</span>
                    </div>

                    <a href="https://www.celz5.org/locator"
                       target="_blank"
                       class="text-sm font-black text-blue-600 hover:text-slate-900 flex items-center gap-2 transition-colors">
                        <i data-lucide="globe" class="w-4 h-4"></i>
                        Locate Other Churches
                    </a>
                </div>
            </div>

            <div class="w-full lg:w-1/2 min-h-[450px] order-1 lg:order-2 relative group">
                <div class="absolute inset-0 bg-blue-600/5 pointer-events-none group-hover:bg-transparent transition-colors duration-500"></div>

                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.717520004526!2d3.47353937583688!3d6.430349324209681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bf44db9198647%3A0x6334f5a3e143896!2sChrist%20Embassy%20Lekki!5e0!3m2!1sen!2sng!4v1710000000000!5m2!1sen!2sng"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    class="grayscale-[20%] hover:grayscale-0 transition-all duration-700">
                </iframe>
            </div>
        </div>
    </div>
</section>


<footer class="bg-slate-900 text-slate-300 pt-20 pb-10 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-16 mb-20">

            <div class="space-y-6 reveal-fade">
                <h3 class="text-white text-xl font-bold">
                    <span class="footer-underline">About Us</span>
                </h3>
                <p class="leading-relaxed text-slate-400 font-medium">
                    We are a global ministry with a vision to take the divine presence of God to the peoples and nations of the world. At Christ Embassy, we demonstrate the character of the Spirit and empower lives through the Word.
                </p>
                <div class="pt-4">
                    <div class="inline-flex items-center space-x-2 bg-blue-600/10 text-blue-400 px-4 py-2 rounded-full text-sm font-bold border border-blue-500/20">
                        <i data-lucide="globe" class="w-4 h-4"></i>
                        <span>Fulfilling Divine Purpose</span>
                    </div>
                </div>
            </div>

            <div class="space-y-6 reveal-fade" style="transition-delay: 150ms;">
                <h3 class="text-white text-xl font-bold">
                    <span class="footer-underline">Quick Links</span>
                </h3>
                <ul class="space-y-4">
                    <li>
                        <a href="#" class="flex items-center group text-slate-400 hover:text-blue-400 transition-colors duration-300">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i>
                            Our Vision & Mission
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center group text-slate-400 hover:text-blue-400 transition-colors duration-300">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i>
                            Upcoming Events
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center group text-slate-400 hover:text-blue-400 transition-colors duration-300">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i>
                            Give Online
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center group text-slate-400 hover:text-blue-400 transition-colors duration-300">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i>
                            Partnership
                        </a>
                    </li>
                </ul>
            </div>

            <div class="space-y-6 reveal-fade" style="transition-delay: 300ms;">
                <h3 class="text-white text-xl font-bold">
                    <span class="footer-underline">Contact Us</span>
                </h3>
                <ul class="space-y-6">
                    <li class="flex items-start">
                        <div class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center mr-4 shrink-0 text-blue-500 shadow-lg shadow-blue-500/5">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                        </div>
                        <span class="text-slate-400 pt-1 font-medium"> Loveworld Arena Lekki,
                             Aare Bashiru street, Chisco B/S, Lekki-Epe Express Way</span>
                    </li>
                    <li class="flex items-start">
                        <div class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center mr-4 shrink-0 text-blue-500 shadow-lg shadow-blue-500/5">
                            <i data-lucide="phone" class="w-5 h-5"></i>
                        </div>
                        <span class="text-slate-400 pt-1 font-medium">+234 907 641 5312</span>
                    </li>
                    <li class="flex items-start">
                        <div class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center mr-4 shrink-0 text-blue-500 shadow-lg shadow-blue-500/5">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <span class="text-slate-400 pt-1 font-medium text-blue-400">contact@celekki.org</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-10 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-sm font-medium text-slate-500 italic">
                &copy; 2026 Christ Embassy. All rights reserved.
            </p>
            <div class="text-sm font-bold tracking-widest uppercase text-slate-600">
                Lekki church
            </div>
        </div>
    </div>
</footer>

<style>
    /* Premium Footer Underline Styles */
    .footer-underline {
        position: relative;
        padding-bottom: 12px;
        display: inline-block;
    }

    .footer-underline::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 4px;
        background-color: #2563eb; /* Blue-600 */
        border-radius: 99px;
    }

    .footer-underline::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 48px;
        width: 12px;
        height: 4px;
        background-color: #2563eb;
        border-radius: 99px;
        opacity: 0.4;
    }

    /* Animation: Fade Up Effect */
    .reveal-fade {
        opacity: 0;
        transform: translateY(20px);
        animation: revealFadeUp 0.8s ease-out forwards;
    }

    @keyframes revealFadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>



<script>
    function calculateRoute() {
        const start = document.getElementById('userLocation').value;
        const destination = "Christ Embassy Lekki, Aare Bashiru Street, Chisco B/S, Lagos";

        if (!start) {
            alert("Please enter your current location to get directions.");
            return;
        }

        // Encodes the URL for a direct Google Maps Navigation Route
        const url = `https://www.google.com/maps/dir/?api=1&origin=${encodeURIComponent(start)}&destination=${encodeURIComponent(destination)}&travelmode=driving`;

        window.open(url, '_blank');
    }
</script>


<script>
    // Initialize Icons
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize Lucide Icons
        lucide.createIcons();

        const toggleBtn = document.getElementById('socialToggle');
        const container = toggleBtn.parentElement;

        toggleBtn.addEventListener('click', () => {
            container.classList.toggle('menu-active');
        });

        // Optional: Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!container.contains(e.target) && container.classList.contains('menu-active')) {
                container.classList.remove('menu-active');
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    // 3. INITIALIZATION - The "Engine" that makes it slide
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.testimonial-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            speed: 800,
            grabCursor: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.v-next',
                prevEl: '.v-prev',
            },
            breakpoints: {
                768: { slidesPerView: 2 },
                1280: { slidesPerView: 2.5 }
            }
        });
    });
</script>
<script src="https://unpkg.com/lucide@latest"></script>


{{-- MIDWEEK SERVICE --}}

</x-app-layout>
