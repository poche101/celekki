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
            <form id="accessForm" action="{{ route('higher-life.access') }}" method="POST" class="space-y-6">
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
    // Initialize Lucide Icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    const form = document.getElementById('accessForm');
    const toast = document.getElementById('toast');
    const toastMsg = document.getElementById('toastMessage');

    /**
     * Display a temporary notification to the user
     */
    function showToast(msg, isError = false) {
        toastMsg.textContent = msg;
        toastMsg.className = isError ?
            "px-6 py-4 rounded-2xl shadow-2xl font-medium border bg-red-900/80 border-red-500 text-white backdrop-blur-md" :
            "px-6 py-4 rounded-2xl shadow-2xl font-medium border bg-green-900/80 border-green-500 text-white backdrop-blur-md";

        toast.classList.remove('hidden');

        // Auto-hide toast if it's an error (Success toasts handle their own redirect)
        if (isError) {
            setTimeout(() => toast.classList.add('hidden'), 4000);
        }
    }

    form.onsubmit = async (e) => {
        e.preventDefault();
        const btn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const originalText = btnText.textContent;

        // UI State: Loading
        btn.disabled = true;
        btnText.textContent = "Authorizing Access...";

        try {
            const formData = new FormData(form);

            // Get CSRF Token safely
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
                // UI State: Success
                showToast("Access Granted! Redirecting to episode...");
                btnText.textContent = "Redirecting...";

                // Redirect to the URL provided by the HigherLifeController
                setTimeout(() => {
                    window.location.href = result.redirect_url;
                }, 1200);

            } else {
                // Handle Validation errors or logic errors from Controller
                let errorMsg = result.message || "Unable to authorize. Please check your details.";

                // If Laravel returns validation object (422), get the first error
                if (result.errors) {
                    errorMsg = Object.values(result.errors)[0][0];
                }

                throw new Error(errorMsg);
            }

        } catch (err) {
            // UI State: Error Reset
            showToast(err.message, true);
            btn.disabled = false;
            btnText.textContent = originalText;
        }
    };
</script>
</body>

</html>
