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
            background: radial-gradient(circle at top right, #2d1b4e, #111827);
        }

        .glass-card {
            background: rgba(17, 24, 39, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .input-glow:focus {
            box-shadow: 0 0 15px rgba(167, 139, 250, 0.3);
            border-color: #a78bfa;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-6 text-white">

    <div class="w-full max-w-lg">
        <div id="toast" class="fixed top-5 right-5 z-[100] hidden animate-bounce">
            <div id="toastMessage" class="px-6 py-4 rounded-2xl shadow-2xl font-medium border flex items-center gap-3">
            </div>
        </div>

        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-tr from-purple-600 to-amber-500 p-0.5 mb-4 shadow-2xl">
                <div
                    class="w-full h-full bg-gray-900 rounded-[calc(1.5rem-2px)] flex items-center justify-center overflow-hidden p-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Higher Life Logo"
                        class="w-full h-full object-contain">
                </div>
            </div>
            <h1
                class="text-4xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-purple-300 via-white to-amber-200">
                The Higher Life
            </h1>
            <p class="text-gray-400 mt-2 text-lg font-light tracking-wide">Enter your details to begin the journey</p>
        </div>

        <div class="glass-card rounded-[2.5rem] p-8 md:p-10 shadow-3xl">
            <form id="accessForm" action="/higher-life/access" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="episode_slug" value="{{ $slug }}">

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-300 ml-1">Full Name</label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-purple-400 transition-colors">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <input type="text" name="name" required placeholder="John Doe"
                            class="w-full bg-gray-900/50 border border-gray-700 rounded-2xl py-4 pl-12 pr-4 focus:outline-none input-glow transition-all placeholder:text-gray-600">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-300 ml-1">Phone Number <span
                            class="text-gray-500 font-normal">(Optional)</span></label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-purple-400 transition-colors">
                            <i data-lucide="phone" class="w-5 h-5"></i>
                        </div>
                        <input type="tel" name="phone" placeholder="+234 ..."
                            class="w-full bg-gray-900/50 border border-gray-700 rounded-2xl py-4 pl-12 pr-4 focus:outline-none input-glow transition-all placeholder:text-gray-600">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-300 ml-1">Location <span
                            class="text-gray-500 font-normal">(Optional)</span></label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-purple-400 transition-colors">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                        </div>
                        <select name="location"
                            class="w-full bg-gray-900/50 border border-gray-700 rounded-2xl py-4 pl-12 pr-10 focus:outline-none input-glow transition-all appearance-none text-gray-300">
                            <option value="" class="bg-gray-900">Select your area</option>
                            <option value="Mainland" class="bg-gray-900">Mainland</option>
                            <option value="Island" class="bg-gray-900">Island</option>
                        </select>
                        <div
                            class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-500">
                            <i data-lucide="chevron-down" class="w-5 h-5"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" id="submitBtn"
                    class="w-full mt-4 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-bold py-5 rounded-2xl shadow-xl shadow-purple-900/20 transform transition-all active:scale-[0.98] flex justify-center items-center gap-3">
                    <span id="btnText">Access Episodes</span>
                    <i data-lucide="arrow-right" id="btnIcon" class="w-5 h-5"></i>
                </button>
            </form>
        </div>

        <p class="text-center text-gray-500 mt-8 text-sm">
            © 2026 The Higher Life with Pastor Deola Phillips
        </p>
    </div>

    <script>
        // Initialize Icons
        lucide.createIcons();

        const form = document.getElementById('accessForm');
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toastMessage');

        function showToast(msg, isError = false) {
            toastMsg.textContent = msg;
            toastMsg.className = isError ?
                "px-6 py-4 rounded-2xl shadow-2xl font-medium border bg-red-900/80 border-red-500 text-white backdrop-blur-md" :
                "px-6 py-4 rounded-2xl shadow-2xl font-medium border bg-green-900/80 border-green-500 text-white backdrop-blur-md";
            toast.classList.remove('hidden');
        }

        form.onsubmit = async (e) => {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');

            // UI State: Loading
            btn.disabled = true;
            btnText.textContent = "Authorizing...";

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const result = await response.json();
                    showToast("Access Granted. Redirecting...");
                    setTimeout(() => {
                        window.location.href = result.redirect_url; // Use the URL from the controller
                    }, 1500);
                } else {
                    throw new Error("Validation failed");
                }
            } catch (err) {
                showToast("Something went wrong. Please check your details.", true);
                btn.disabled = false;
                btnText.textContent = "Access Episodes";
                setTimeout(() => toast.classList.add('hidden'), 3000);
            }
        };
    </script>
</body>

</html>
