<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sign Up - JeevanSetu</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Outfit"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9f7',
                            100: '#d9f1eb',
                            500: '#006b55', 
                            600: '#005644',
                            900: '#061a1a', 
                        },
                        accent: {
                            400: '#6dfad2', 
                            500: '#4ce1b6', 
                            600: '#3bb592',
                        },
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(-5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .float-icon {
            animation: float 8s ease-in-out infinite;
        }
        .mesh-bg {
            background-color: #f8f9fa;
            background-image: 
                radial-gradient(at 0% 0%, rgba(76, 225, 182, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(0, 107, 85, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(76, 225, 182, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(0, 107, 85, 0.15) 0px, transparent 50%);
        }
    </style>
</head>
<body class="font-sans text-slate-800 antialiased mesh-bg min-h-screen flex items-center justify-center p-0 md:p-4 overflow-x-hidden">

    <!-- Background Elements -->
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute top-[-10%] right-[-5%] w-[40%] h-[40%] bg-accent-400/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[40%] h-[40%] bg-brand-500/20 rounded-full blur-[120px]"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 w-full max-w-6xl h-auto md:h-[800px] md:max-h-[90vh] bg-white/40 backdrop-blur-xl md:rounded-[40px] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] border border-white/50 flex flex-col md:flex-row overflow-y-auto md:overflow-hidden m-0">
        
        <!-- Left Side: Hero/Branding -->
        <div class="hidden md:flex flex-1 bg-brand-900 relative p-12 flex-col justify-between overflow-hidden">
            <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-br from-brand-500/20 to-transparent"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-accent-500/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-16">
                    <div class="w-12 h-12 bg-accent-500 rounded-2xl flex items-center justify-center shadow-[0_0_20px_rgba(76,225,182,0.3)]">
                        <span class="material-symbols-outlined text-brand-900 fill-current text-2xl" style="font-variation-settings: 'FILL' 1;">medical_services</span>
                    </div>
                    <span class="text-3xl font-display font-bold tracking-tight text-white">JEEVAN<span class="text-accent-500">setu</span></span>
                </div>

                <div class="space-y-6 max-w-md">
                    <h1 class="text-5xl font-display font-extrabold text-white leading-tight">
                        Empowering <span class="text-accent-500 text-6xl">Lives</span> through technology.
                    </h1>
                    <p class="text-slate-400 text-lg leading-relaxed">
                        Join our digital healthcare ecosystem. Manage appointments, medical history, and emergency services in one unified platform.
                    </p>
                </div>
            </div>

            <div class="relative z-10 flex flex-wrap gap-8">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-accent-500">verified</span>
                    <span class="text-white font-medium">Verified Doctors</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-accent-500">security</span>
                    <span class="text-white font-medium">Secure Data</span>
                </div>
            </div>

            <!-- Floating Medical Icon -->
            <div class="absolute left-[-30px] bottom-[15%] float-icon opacity-20 transform -scale-x-100">
                <span class="material-symbols-outlined text-[250px] text-white select-none">health_and_safety</span>
            </div>
        </div>

        <!-- Right Side: Forms -->
        <div class="w-full md:w-[480px] bg-white p-8 sm:p-12 md:py-16 flex flex-col justify-start md:justify-center relative overflow-hidden">
            <!-- Mobile Logo -->
            <div class="md:hidden flex justify-center items-center gap-2 mb-10">
                <span class="material-symbols-outlined text-brand-500 fill-current text-4xl" style="font-variation-settings: 'FILL' 1;">medical_services</span>
                <span class="text-3xl font-display font-bold tracking-tight"><span class="text-brand-900">JEEVAN</span><span class="text-accent-500">setu</span></span>
            </div>

            <div class="relative min-h-0 flex flex-col">
                
                <!-- Section 1: Signup Form -->
                <div id="signup-section" class="transition-all duration-500 transform opacity-100 scale-100">
                    <div class="mb-10 text-center md:text-left mt-4 md:mt-0">
                        <h2 class="text-3xl font-display font-bold text-brand-900 mb-2">Create Account</h2>
                        <p class="text-slate-500">Join our digital medical network today</p>
                    </div>

                    <form onsubmit="handleSignup(event)" class="space-y-5">
                        @csrf
                        <input type="hidden" name="role" value="patient">
                        
                        <div class="space-y-1.5">
                            <label class="block text-sm font-bold text-brand-900 ml-1">Full Name</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px] group-focus-within:text-brand-500 transition-colors">person</span>
                                <input type="text" id="name" required class="w-full pl-12 pr-4 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all text-sm font-medium" placeholder="John Doe">
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-sm font-bold text-brand-900 ml-1">Email Address</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px] group-focus-within:text-brand-500 transition-colors">mail</span>
                                <input type="email" id="email" required class="w-full pl-12 pr-4 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all text-sm font-medium" placeholder="patient@example.com">
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-sm font-bold text-brand-900 ml-1">Password</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[20px] group-focus-within:text-brand-500 transition-colors">lock</span>
                                <input type="password" id="password" required class="w-full pl-12 pr-4 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all text-sm font-medium" placeholder="••••••••">
                            </div>
                        </div>

                        <button type="submit" id="signup-btn" class="w-full bg-brand-900 text-white font-extrabold py-4 rounded-2xl shadow-[0_20px_40px_-12px_rgba(6,26,26,0.3)] hover:shadow-[0_25px_50px_-12px_rgba(6,26,26,0.4)] hover:-translate-y-1 active:scale-95 transition-all mt-4 flex justify-center items-center gap-3 disabled:opacity-70 disabled:cursor-not-allowed">
                            <span id="signup-btn-text" class="flex items-center gap-3">
                                Sign Up <span class="material-symbols-outlined text-[20px]">person_add</span>
                            </span>
                            <div id="signup-loader" class="hidden">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </button>
                    </form>

                    <div class="mt-10 mb-6 text-center text-sm text-slate-500 font-medium">
                        Already have an account? <a href="{{ route('login') }}" class="font-bold text-brand-500 hover:text-brand-600 transition-all border-b-2 border-transparent hover:border-brand-500 pb-0.5">Log in</a>
                    </div>
                </div>

                <!-- Section 2: OTP Verification -->
                <div id="otp-section" class="hidden transition-all duration-500 transform opacity-0 translate-x-12">
                    <button onclick="showSignup()" class="text-slate-400 hover:text-brand-900 flex items-center gap-2 text-sm font-bold mb-10 group">
                        <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span> Change details
                    </button>
                    <div class="mb-10">
                        <h2 class="text-3xl font-display font-bold text-brand-900 mb-3">Verify Email</h2>
                        <p class="text-slate-500">Enter the 6-digit code sent to <span id="display-email" class="font-bold text-brand-900"></span></p>
                    </div>
                    
                    <div class="space-y-10 text-center">
                        <div class="flex justify-between gap-3">
                            <input type="text" maxlength="1" class="otp-input w-full aspect-square text-center text-2xl font-extrabold bg-slate-50 border-2 border-slate-200 rounded-2xl outline-none transition-all">
                            <input type="text" maxlength="1" class="otp-input w-full aspect-square text-center text-2xl font-extrabold bg-slate-50 border-2 border-slate-200 rounded-2xl outline-none transition-all">
                            <input type="text" maxlength="1" class="otp-input w-full aspect-square text-center text-2xl font-extrabold bg-slate-50 border-2 border-slate-200 rounded-2xl outline-none transition-all">
                            <input type="text" maxlength="1" class="otp-input w-full aspect-square text-center text-2xl font-extrabold bg-slate-50 border-2 border-slate-200 rounded-2xl outline-none transition-all">
                            <input type="text" maxlength="1" class="otp-input w-full aspect-square text-center text-2xl font-extrabold bg-slate-50 border-2 border-slate-200 rounded-2xl outline-none transition-all">
                            <input type="text" maxlength="1" class="otp-input w-full aspect-square text-center text-2xl font-extrabold bg-slate-50 border-2 border-slate-200 rounded-2xl outline-none transition-all">
                        </div>
                        <button onclick="handleVerifyOtp()" class="w-full bg-brand-500 text-white font-extrabold py-5 rounded-2xl shadow-xl shadow-brand-500/20 hover:-translate-y-1 transition-all">
                            Verify & Register
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="reg-toast" class="fixed bottom-8 right-8 z-[100] hidden transition-all duration-500 transform translate-y-20 opacity-0">
        <div class="bg-brand-900 text-white px-8 py-5 rounded-[24px] shadow-[0_20px_50px_rgba(0,0,0,0.3)] flex items-center gap-4 border border-white/10 backdrop-blur-md">
            <div id="toast-icon-bg" class="bg-accent-500 rounded-full p-1.5 text-brand-900 flex items-center justify-center">
                <span id="toast-icon" class="material-symbols-outlined text-[20px] font-bold">check</span>
            </div>
            <span id="toast-text" class="text-sm font-bold tracking-tight"></span>
        </div>
    </div>

    <script>
        async function handleSignup(e) {
            e.preventDefault();
            const btn = document.getElementById('signup-btn');
            const text = document.getElementById('signup-btn-text');
            const loader = document.getElementById('signup-loader');
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Start Loading
            btn.disabled = true;
            text.classList.add('hidden');
            loader.classList.remove('hidden');

            try {
                const response = await fetch('{{ route('register.submit') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ name, email, password, role: 'patient' })
                });
                const data = await response.json();
                
                if (data.success) {
                    document.getElementById('display-email').textContent = email;
                    showOtpSection();
                    showToast('Verification code sent!');
                } else {
                    let msg = 'Registration failed';
                    if (data.errors) msg = Object.values(data.errors)[0];
                    else if (data.error) msg = data.error;
                    showToast(msg, 'error');
                }
            } catch (err) { 
                showToast('Connection error', 'error'); 
            } finally {
                // End Loading
                btn.disabled = false;
                text.classList.remove('hidden');
                loader.classList.add('hidden');
            }
        }

        async function handleVerifyOtp() {
            const otpInputs = document.querySelectorAll('.otp-input');
            const otp = Array.from(otpInputs).map(i => i.value).join('');
            if (otp.length < 6) return showToast('Please enter 6 digits', 'error');

            try {
                const response = await fetch('{{ route('register.otp') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ otp })
                });
                const data = await response.json();
                if (data.success) {
                    showToast('Account verified! Redirecting...');
                    setTimeout(() => window.location.href = '{{ route('dashboard') }}', 1500);
                } else { showToast(data.error || 'Invalid code', 'error'); }
            } catch (err) { showToast('Verification failed', 'error'); }
        }

        function showOtpSection() {
            const signup = document.getElementById('signup-section');
            const otp = document.getElementById('otp-section');
            signup.classList.add('opacity-0', '-translate-x-12');
            setTimeout(() => {
                signup.classList.add('hidden');
                otp.classList.remove('hidden');
                setTimeout(() => {
                    otp.classList.remove('opacity-0', 'translate-x-12');
                    otp.classList.add('opacity-100', 'translate-x-0');
                }, 10);
            }, 300);
        }

        function showSignup() {
            const signup = document.getElementById('signup-section');
            const otp = document.getElementById('otp-section');
            otp.classList.add('opacity-0', 'translate-x-12');
            setTimeout(() => {
                otp.classList.add('hidden');
                signup.classList.remove('hidden');
                setTimeout(() => {
                    signup.classList.remove('opacity-0', '-translate-x-12');
                    signup.classList.add('opacity-100', 'scale-100');
                }, 10);
            }, 300);
        }

        function showToast(message, type = 'success') {
            const toast = document.getElementById('reg-toast');
            const text = document.getElementById('toast-text');
            const icon = document.getElementById('toast-icon');
            const iconBg = document.getElementById('toast-icon-bg');
            text.textContent = message;
            icon.textContent = type === 'success' ? 'check' : 'error';
            iconBg.className = `${type === 'success' ? 'bg-accent-500 text-brand-900' : 'bg-red-500 text-white'} rounded-full p-1.5 flex items-center justify-center`;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.remove('translate-y-20', 'opacity-0'), 10);
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
                setTimeout(() => toast.classList.add('hidden'), 500);
            }, 5000);
        }

        document.querySelectorAll('.otp-input').forEach((input, idx) => {
            input.addEventListener('keyup', (e) => {
                if (e.key >= 0 && e.key <= 9) {
                    if (idx < 5) input.nextElementSibling.focus();
                } else if (e.key === 'Backspace') {
                    if (idx > 0) input.previousElementSibling.focus();
                }
            });
        });
    </script>
</body>
</html>
