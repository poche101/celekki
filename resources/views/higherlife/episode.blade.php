<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $episode->title }} | The Higher Life</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        #mainPlayer { object-fit: cover; background-color: #1f2937; }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen">

    <div class="max-w-5xl mx-auto px-4 py-8">
        <div id="toast" class="fixed top-5 right-5 z-[100] hidden transform transition-all duration-300 opacity-0">
            <div id="toastMessage" class="px-6 py-3 rounded-lg shadow-2xl font-semibold border"></div>
        </div>

        <header class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
           <div>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r {{ $episode->title === 'Sunday Service' ? 'from-blue-400 to-blue-600' : 'from-purple-400 to-orange-500' }}">
            {{ $episode->title === 'Sunday Service' ? 'Sunday Service' : 'The Higher Life' }}
        </h1>
        <p class="text-gray-400 mt-2 text-lg">
            {{ $episode->title === 'Sunday Service' ? 'Join us for a glorious time in God\'s presence' : 'With Pastor Deola Phillips' }}
        </p>
    </div>

            <button id="openPrayerModal" class="flex items-center gap-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-8 py-3 rounded-full font-semibold transition-all shadow-lg transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                Send Prayer Request
            </button>
        </header>

        <div class="space-y-8">
            <div class="relative rounded-3xl overflow-hidden bg-black shadow-2xl border border-gray-800">
                <div class="aspect-video">
                    <div class="w-full h-full flex items-center justify-center bg-gray-800">
                        <video id="mainPlayer" controls playsinline class="w-full h-full" poster="{{ asset($episode->poster) }}">
                            <source src="{{ $episode->video_url }}" type="application/x-mpegURL">
                        </video>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-start gap-8">
                <div class="flex-1">
                    <span class="text-purple-400 font-mono text-sm uppercase tracking-widest">Episode {{ $id }}</span>
                    <h2 class="text-3xl font-bold mt-2">{{ $episode->title }}</h2>
                    <p class="text-gray-400 mt-4 leading-relaxed text-lg max-w-2xl">
                        With Pastor Deola Phillips
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="prayerModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
        <div class="bg-gray-900 border border-gray-700 w-full max-w-lg rounded-2xl shadow-2xl transform transition-all">
            <div class="p-6 border-b border-gray-800 flex justify-between items-center">
                <h3 class="text-xl font-bold">Submit Prayer Request</h3>
                <button id="closeModal" class="text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form id="prayerForm" action="{{ route('prayer.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="episode_slug" value="{{ $slug }}">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Full Name</label>
                    <input type="text" name="name" id="userName" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Your Request</label>
                    <textarea name="request" id="userRequest" rows="4" required class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none transition-all" placeholder="How can we pray for you?"></textarea>
                </div>
                <button type="submit" id="submitBtn" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-bold py-3 rounded-lg shadow-lg transition-colors flex justify-center items-center">
                    <span id="btnText">Send to Pastor</span>
                </button>
            </form>
        </div>
    </div>

    <script>
    // --- VIDEO PLAYER (DYNAMIC) ---
    const video = document.getElementById('mainPlayer');
    const videoSrc = "{{ $episode->video_url }}";

    if (Hls.isSupported()) {
        const hls = new Hls({ autoStartLoad: false });
        hls.loadSource(videoSrc);
        hls.attachMedia(video);
        video.addEventListener('play', () => hls.startLoad(), { once: true });
    } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
        video.src = videoSrc;
    }

    // --- MODAL & FORM LOGIC ---
    const modal = document.getElementById('prayerModal');
    const prayerForm = document.getElementById('prayerForm');
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');

    function showToast(msg, isError = false) {
        toastMessage.textContent = msg;
        toastMessage.className = isError
            ? "px-6 py-3 rounded-lg shadow-2xl font-semibold border bg-red-900 border-red-500 text-white"
            : "px-6 py-3 rounded-lg shadow-2xl font-semibold border bg-green-900 border-green-500 text-white";

        toast.classList.remove('hidden', 'opacity-0');
        toast.classList.add('opacity-100');

        setTimeout(() => {
            toast.classList.add('opacity-0');
            setTimeout(() => toast.classList.add('hidden'), 300);
        }, 5000);
    }

    document.getElementById('openPrayerModal').onclick = () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    const closeModal = () => {
        modal.classList.replace('flex', 'hidden');
        document.body.style.overflow = 'auto';
    };

    document.getElementById('closeModal').onclick = closeModal;

    prayerForm.onsubmit = async (e) => {
        e.preventDefault();
        const btn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const originalText = btnText.textContent;

        btn.disabled = true;
        btnText.textContent = "Sending...";

        try {
            const formData = new FormData(prayerForm);
            const response = await fetch(prayerForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            const result = await response.json();

            if (response.ok) {
                showToast("Your prayer request has been sent successfully!");
                prayerForm.reset();
                setTimeout(closeModal, 1000);
            } else {
                showToast(result.message || "Something went wrong.", true);
            }
        } catch (err) {
            showToast("Connection error. Please try again later.", true);
        } finally {
            btn.disabled = false;
            btnText.textContent = originalText;
        }
    };
</script>

</body>
</html>
