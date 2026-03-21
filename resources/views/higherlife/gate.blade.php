<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access The Higher Life | Gateway</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top right, #1e1135, #0a0f1a);
            /* Prevents layout shift on small screens */
            min-height: 100vh;
            margin: 0;
        }

        .glass-card {
            background: rgba(10, 15, 26, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px); /* Safari support */
            border: 1px solid rgba(167, 139, 250, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
        }

        .input-glow:focus {
            box-shadow: 0 0 20px rgba(167, 139, 250, 0.4);
            border-color: #a78bfa;
            background: #000000;
        }

        /* Ensure input heights are consistent in production */
        input, select {
            height: 64px;
        }

        ::placeholder {
            color: #4b5563 !important;
            opacity: 1;
        }

        /* Custom scrollbar for the glass card if content overflows */
        .glass-card::-webkit-scrollbar {
            width: 5px;
        }
        .glass-card::-webkit-scrollbar-thumb {
            background: rgba(167, 139, 250, 0.2);
            border-radius: 10px;
        }
    </style>
</head>

<body class="flex items-center justify-center p-6 text-gray-900 overflow-x-hidden">

    <div class="w-full max-w-[512px] min-w-[320px] transition-all duration-300">

        <div id="toast" class="fixed top-5 right-5 z-[100] hidden animate-bounce">
            <div id="toastMessage" class="px-6 py-4 rounded-2xl shadow-2xl font-bold border flex items-center gap-3">
            </div>
        </div>

        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-28 h-28 rounded-[32px] bg-gradient-to-tr from-purple-500 via-indigo-500 to-amber-400 p-0.5 mb-8 shadow-2xl transform hover:scale-105 transition-transform duration-500">
                <div class="w-full h-full bg-black rounded-[calc(2rem-2px)] flex items-center justify-center overflow-hidden p-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Higher Life Logo" class="w-full h-full object-contain">
                </div>
            </div>
            <h1 class="text-5xl font-extrabold tracking-tight text-white drop-shadow-md">
                The Higher Life
            </h1>
            <p class="text-purple-200 mt-4 text-lg font-medium opacity-90">Enter your details to begin the journey</p>
        </div>

        <div class="glass-card rounded-[3rem] p-8 md:p-12 w-full">
            <form id="accessForm" action="{{ route('higher-life.access') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="episode_slug" value="{{ $slug }}">

                <div class="space-y-3">
                    <label class="text-xs font-bold text-gray-300 ml-1 uppercase tracking-[0.15em]">Full Name</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-500 group-focus-within:text-purple-400 transition-colors">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <input type="text" name="name" required placeholder="John Doe"
                            class="w-full bg-black border-2 border-gray-800 rounded-2xl pl-14 pr-4 text-white font-semibold focus:outline-none input-glow transition-all">
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-xs font-bold text-gray-300 ml-1 uppercase tracking-[0.15em]">
                        Phone Number <span class="text-purple-400 font-normal lowercase tracking-normal opacity-70">(Optional)</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-500 group-focus-within:text-purple-400 transition-colors">
                            <i data-lucide="phone" class="w-5 h-5"></i>
                        </div>
                        <input type="tel" name="phone" placeholder="+234 ..."
                            class="w-full bg-black border-2 border-gray-800 rounded-2xl pl-14 pr-4 text-white font-semibold focus:outline-none input-glow transition-all">
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-xs font-bold text-gray-300 ml-1 uppercase tracking-[0.15em]">
                        Location <span class="text-purple-400 font-normal lowercase tracking-normal opacity-70">(Optional)</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-500 group-focus-within:text-purple-400 transition-colors">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                        </div>
                        <select name="location"
                            class="w-full bg-black border-2 border-gray-800 rounded-2xl pl-14 pr-10 text-white font-semibold focus:outline-none input-glow transition-all appearance-none cursor-pointer">
                            <option value="" class="bg-gray-900">Select your area</option>
                            <option value="Mainland" class="bg-gray-900">Mainland</option>
                            <option value="Island" class="bg-gray-900">Island</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-purple-400">
                            <i data-lucide="chevron-down" class="w-5 h-5"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" id="submitBtn"
                    class="w-full mt-6 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-black text-xl py-6 rounded-2xl shadow-2xl shadow-purple-900/40 transform transition-all active:scale-[0.97] flex justify-center items-center gap-3 group">
                    <span id="btnText">Access Episodes</span>
                    <i data-lucide="arrow-right" id="btnIcon" class="w-6 h-6 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>
        </div>

        <p class="text-center text-gray-500 mt-12 text-sm font-bold tracking-widest uppercase opacity-60">
            © 2026 The Higher Life <br class="md:hidden"> with Pastor Deola Phillips
        </p>
    </div>

    <script>
        // Initialize Lucide Icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        const form = document.getElementById('accessForm');
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toastMessage');

        function showToast(msg, isError = false) {
            toastMsg.textContent = msg;
            toastMsg.className = isError ?
                "px-6 py-4 rounded-2xl shadow-2xl font-bold border-2 bg-red-600 border-red-400 text-white" :
                "px-6 py-4 rounded-2xl shadow-2xl font-bold border-2 bg-green-600 border-green-400 text-white";

            toast.classList.remove('hidden');
            if (isError) {
                setTimeout(() => toast.classList.add('hidden'), 4000);
            }
        }

        form.onsubmit = async (e) => {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const originalText = btnText.textContent;

            btn.disabled = true;
            btnText.textContent = "Authorizing Access...";

            try {
                const formData = new FormData(form);
                const csrfToken = document.querySelector('input[name="_token"]')?.value;

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const result = await response.json();

                if (response.ok && result.status === 'success') {
                    showToast("Access Granted! Redirecting...");
                    btnText.textContent = "Redirecting...";
                    setTimeout(() => {
                        window.location.href = result.redirect_url;
                    }, 1200);
                } else {
                    let errorMsg = result.message || "Unable to authorize. Please check your details.";
                    if (result.errors) {
                        errorMsg = Object.values(result.errors)[0][0];
                    }
                    throw new Error(errorMsg);
                }
            } catch (err) {
                showToast(err.message, true);
                btn.disabled = false;
                btnText.textContent = originalText;
            }
        };
    </script>
</body>

</html>
