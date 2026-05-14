<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - JeevanSetu</title>
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
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .float-icon {
            animation: float 6s ease-in-out infinite;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .otp-input:focus {
            border-color: #006b55;
            box-shadow: 0 0 0 4px rgba(0, 107, 85, 0.1);
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
        <div class="absolute top-[-10%] left-[-5%] w-[40%] h-[40%] bg-accent-400/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[40%] h-[40%] bg-brand-500/20 rounded-full blur-[120px]"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full opacity-[0.03] pointer-events-none" 
             style="background-image: url('data:image/svg+xml,%3Csvg width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%23000\" fill-opacity=\"1\" fill-rule=\"evenodd\"%3E%3Ccircle cx=\"3\" cy=\"3\" r=\"3\"/%3E%3C/g%3E%3C/svg%3E');">
        </div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 w-full max-w-6xl h-auto md:h-[800px] md:max-h-[90vh] bg-white/40 backdrop-blur-xl md:rounded-[40px] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] border border-white/50 flex flex-col md:flex-row overflow-y-auto md:overflow-hidden m-0">
        
        <!-- Left Side: Hero/Branding -->
        <div class="hidden md:flex flex-1 bg-brand-900 relative p-12 flex-col justify-between overflow-hidden">
            <!-- Decorative gradients for the dark side -->
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
                        Healthcare management <span class="text-accent-500 text-6xl">Simplified.</span>
                    </h1>
                    <p class="text-slate-400 text-lg leading-relaxed">
                        Access real-time bed availability, manage patient records, and streamline hospital operations with Delhi NCR's most advanced medical network.
                    </p>
                </div>
            </div>

            <div class="relative z-10 flex items-center gap-8">
                <div class="flex flex-col">
                    <span class="text-3xl font-bold text-white">500+</span>
                    <span class="text-sm text-slate-500 uppercase tracking-widest font-semibold">Hospitals</span>
                </div>
                <div class="h-10 w-px bg-slate-800"></div>
                <div class="flex flex-col">
                    <span class="text-3xl font-bold text-white">10k+</span>
                    <span class="text-sm text-slate-500 uppercase tracking-widest font-semibold">Beds</span>
                </div>
                <div class="h-10 w-px bg-slate-800"></div>
                <div class="flex flex-col">
                    <span class="text-3xl font-bold text-white">24/7</span>
                    <span class="text-sm text-slate-500 uppercase tracking-widest font-semibold">Support</span>
                </div>
            </div>

            <!-- Floating Medical Icon -->
            <div class="absolute right-[-50px] bottom-[20%] float-icon opacity-20">
                <span class="material-symbols-outlined text-[300px] text-white select-none">stethoscope</span>
            </div>
        </div>

        <!-- Right Side: Forms -->
        <div class="w-full md:w-[480px] bg-white p-8 sm:p-12 md:py-14 flex flex-col justify-start md:justify-center relative overflow-y-auto">
            <!-- Mobile Logo -->
            <div class="md:hidden flex justify-center items-center gap-2 mb-10">
                <span class="material-symbols-outlined text-brand-500 fill-current text-4xl" style="font-variation-settings: 'FILL' 1;">medical_services</span>
                <span class="text-3xl font-display font-bold tracking-tight"><span class="text-brand-900">JEEVAN</span><span class="text-accent-500">setu</span></span>
            </div>

            <div class="relative min-h-0 flex flex-col">
                
                <!-- Login Section -->
                <div id="login-section" class="transition-all duration-500 transform opacity-100 scale-100">
                    <div class="mb-6 text-center md:text-left mt-2 md:mt-0">
                        <h2 class="text-3xl font-display font-bold text-brand-900 mb-1">Welcome Back</h2>
                        <p class="text-slate-500 text-sm">Sign in to your medical dashboard</p>
                    </div>

                    <div class="flex p-1 bg-slate-100 rounded-2xl mb-6 border border-slate-200/60">
                        <button id="tab-patient" type="button" class="flex-1 py-2.5 text-sm font-bold rounded-xl bg-white shadow-sm text-brand-900 transition-all" onclick="switchTab('patient')">
                            Patient
                        </button>
                        <button id="tab-hospital" type="button" class="flex-1 py-2.5 text-sm font-medium rounded-xl text-slate-500 hover:text-brand-900 transition-all" onclick="switchTab('hospital')">
                            Hospital
                        </button>
                    </div>

                    <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="role" id="role-input" value="patient">
                        
                        @if($errors->any())
                        <div class="bg-red-50 border border-red-100 text-red-600 px-4 py-2.5 rounded-xl text-xs flex items-center gap-2 mb-2 animate-in fade-in slide-in-from-top-2 duration-300">
                            <span class="material-symbols-outlined text-[18px]">error</span>
                            <p class="font-medium">{{ $errors->first() }}</p>
                        </div>
                        @endif

                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-brand-900 ml-1 uppercase tracking-wider">Email Address</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[18px] group-focus-within:text-brand-500 transition-colors">mail</span>
                                <input type="email" name="email" id="email" required class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all text-sm font-medium" placeholder="patient@example.com">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-brand-900 ml-1 uppercase tracking-wider">Password</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-[18px] group-focus-within:text-brand-500 transition-colors">lock</span>
                                <input type="password" name="password" required class="w-full pl-11 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all text-sm font-medium" placeholder="••••••••">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" onclick="showSection('reset-email-section')" class="text-xs font-bold text-brand-500 hover:text-brand-600 transition-colors">Forgot password?</button>
                        </div>

                        <div class="pt-2 space-y-3">
                            <button type="submit" class="w-full bg-brand-900 text-white font-extrabold py-3.5 rounded-2xl shadow-[0_15px_30px_-12px_rgba(6,26,26,0.3)] hover:shadow-[0_20px_40px_-12px_rgba(6,26,26,0.4)] hover:-translate-y-1 active:scale-95 transition-all flex justify-center items-center gap-3">
                                Sign In <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </button>
                            
                            <div class="relative py-1">
                                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
                                <div class="relative flex justify-center text-[10px]"><span class="px-2 bg-white text-slate-400 font-bold tracking-widest">OR</span></div>
                            </div>

                            <button type="button" onclick="handleLoginWithOtp()" class="w-full bg-white border-2 border-brand-500 text-brand-500 hover:bg-brand-50 font-bold py-3.5 rounded-2xl transition-all flex justify-center items-center gap-3 group">
                                Sign In with OTP <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">sms</span>
                            </button>
                        </div>
                    </form>

                    <div id="signup-section" class="mt-6 mb-2 text-center text-xs text-slate-500 font-medium">
                        New to JeevanSetu? <a href="{{ route('register') }}" class="font-bold text-brand-500 hover:text-brand-600 transition-all border-b-2 border-transparent hover:border-brand-500 pb-0.5">Create account</a>
                    </div>
                </div>

                <!-- Section: Reset Email -->
                <div id="reset-email-section" class="hidden transition-all duration-500 transform opacity-0 translate-x-12">
                    <button onclick="showSection('login-section')" class="text-slate-400 hover:text-brand-900 flex items-center gap-2 text-sm font-bold mb-10 group">
                        <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span> Back to login
                    </button>
                    <div class="mb-10">
                        <h2 class="text-3xl font-display font-bold text-brand-900 mb-3">Reset Password</h2>
                        <p class="text-slate-500">We'll send a secure OTP to your registered email.</p>
                    </div>
                    <div class="space-y-8">
                        <div class="space-y-1.5">
                            <label class="block text-sm font-bold text-brand-900 ml-1">Email Address</label>
                            <input type="email" id="forgot-email" placeholder="name@example.com" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all text-sm font-medium">
                        </div>
                        <button onclick="handleSendOtp()" class="w-full bg-brand-500 text-white font-extrabold py-5 rounded-2xl shadow-xl shadow-brand-500/20 hover:shadow-2xl hover:shadow-brand-500/30 hover:-translate-y-1 transition-all">
                            Send Reset OTP
                        </button>
                    </div>
                </div>

                <!-- Section: OTP Verification -->
                <div id="otp-section" class="hidden transition-all duration-500 transform opacity-0 translate-x-12">
                    <button onclick="showSection('login-section')" class="text-slate-400 hover:text-brand-900 flex items-center gap-2 text-sm font-bold mb-10 group">
                        <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span> Cancel
                    </button>
                    <div class="mb-10">
                        <h2 id="otp-title" class="text-3xl font-display font-bold text-brand-900 mb-3">Verify Code</h2>
                        <p class="text-slate-500">Enter the 6-digit code sent to your inbox.</p>
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
                        <button id="otp-verify-btn" onclick="handleVerifyOtp()" class="w-full bg-brand-500 text-white font-extrabold py-5 rounded-2xl shadow-xl shadow-brand-500/20 hover:-translate-y-1 transition-all">
                            Verify & Continue
                        </button>
                        <p class="text-sm text-slate-400">Didn't receive code? <button class="text-brand-500 font-bold hover:underline">Resend</button></p>
                    </div>
                </div>

                <!-- Section: New Password -->
                <div id="new-password-section" class="hidden transition-all duration-500 transform opacity-0 translate-x-12">
                    <div class="mb-10">
                        <h2 class="text-3xl font-display font-bold text-brand-900 mb-3">New Password</h2>
                        <p class="text-slate-500">Must be at least 8 characters long.</p>
                    </div>
                    <div class="space-y-6">
                        <div class="space-y-1.5">
                            <label class="block text-sm font-bold text-brand-900 ml-1">New Password</label>
                            <input type="password" id="new-password" placeholder="••••••••" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all text-sm font-medium">
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-sm font-bold text-brand-900 ml-1">Confirm Password</label>
                            <input type="password" id="confirm-password" placeholder="••••••••" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all text-sm font-medium">
                        </div>
                        <button onclick="handleResetPassword()" class="w-full bg-brand-500 text-white font-extrabold py-5 rounded-2xl shadow-xl shadow-brand-500/20 hover:-translate-y-1 transition-all mt-4">
                            Update Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="login-toast" class="fixed bottom-8 right-8 z-[100] hidden transition-all duration-500 transform translate-y-20 opacity-0">
        <div id="toast-bg" class="bg-brand-900 text-white px-8 py-5 rounded-[24px] shadow-[0_20px_50px_rgba(0,0,0,0.3)] flex items-center gap-4 border border-white/10 backdrop-blur-md">
            <div id="toast-icon-bg" class="bg-accent-500 rounded-full p-1.5 text-brand-900 flex items-center justify-center">
                <span id="toast-icon" class="material-symbols-outlined text-[20px] font-bold">check</span>
            </div>
            <span id="toast-text" class="text-sm font-bold tracking-tight"></span>
        </div>
    </div>

    <script>
        const sections = ['login-section', 'reset-email-section', 'otp-section', 'new-password-section'];
        let currentOtpMode = 'reset';

        function showSection(targetId) {
            sections.forEach(id => {
                const el = document.getElementById(id);
                if (id === targetId) {
                    el.classList.remove('hidden');
                    setTimeout(() => {
                        el.classList.remove('opacity-0', 'translate-x-12', '-translate-x-12');
                        el.classList.add('opacity-100', 'translate-x-0');
                    }, 10);
                } else {
                    el.classList.add('opacity-0', id === sections[sections.indexOf(targetId) - 1] ? '-translate-x-12' : 'translate-x-12');
                    setTimeout(() => el.classList.add('hidden'), 300);
                }
            });
        }

        async function handleLoginWithOtp() {
            const email = document.getElementById('email').value;
            if (!email) return showToast('Enter your email first', 'error');

            try {
                const response = await fetch('{{ route('login.otp.send') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ email })
                });
                const data = await response.json();
                if (data.success) {
                    currentOtpMode = 'login';
                    document.getElementById('otp-title').textContent = 'Secure Login';
                    document.getElementById('otp-verify-btn').textContent = 'Verify & Login';
                    showSection('otp-section');
                    showToast('Code sent to your inbox');
                } else {
                    showToast(data.error, 'error');
                }
            } catch (err) { showToast('Connection failed', 'error'); }
        }

        async function handleSendOtp() {
            const email = document.getElementById('forgot-email').value;
            if (!email) return showToast('Email is required', 'error');

            try {
                const response = await fetch('{{ route('password.email') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ email })
                });
                const data = await response.json();
                if (data.success) {
                    currentOtpMode = 'reset';
                    document.getElementById('otp-title').textContent = 'Reset Access';
                    document.getElementById('otp-verify-btn').textContent = 'Verify & Continue';
                    showSection('otp-section');
                    showToast('OTP sent successfully');
                } else { showToast(data.error, 'error'); }
            } catch (err) { showToast('Something went wrong', 'error'); }
        }

        async function handleVerifyOtp() {
            const otpInputs = document.querySelectorAll('.otp-input');
            const otp = Array.from(otpInputs).map(i => i.value).join('');
            if (otp.length < 6) return showToast('Enter 6-digit code', 'error');

            const route = currentOtpMode === 'login' ? '{{ route('login.otp.verify') }}' : '{{ route('password.otp') }}';
            const body = { otp };
            if (currentOtpMode === 'reset') body.email = document.getElementById('forgot-email').value;

            try {
                const response = await fetch(route, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify(body)
                });
                const data = await response.json();
                if (data.success) {
                    if (currentOtpMode === 'login') {
                        showToast('Welcome back! Redirecting...');
                        setTimeout(() => window.location.href = '{{ route('dashboard') }}', 1000);
                    } else {
                        showSection('new-password-section');
                        showToast('Access verified');
                    }
                } else { showToast(data.error, 'error'); }
            } catch (err) { showToast('Verification failed', 'error'); }
        }

        async function handleResetPassword() {
            const password = document.getElementById('new-password').value;
            const confirmation = document.getElementById('confirm-password').value;
            if (password.length < 4) return showToast('Password is too short', 'error');
            if (password !== confirmation) return showToast('Passwords must match', 'error');

            try {
                const response = await fetch('{{ route('password.update') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ password, password_confirmation: confirmation })
                });
                const data = await response.json();
                if (data.success) {
                    showToast('Success! Password updated.');
                    setTimeout(() => showSection('login-section'), 2000);
                } else { showToast(data.error, 'error'); }
            } catch (err) { showToast('Update failed', 'error'); }
        }

        function showToast(message, type = 'success') {
            const toast = document.getElementById('login-toast');
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
            }, 4000);
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

        function switchTab(type) {
            const patientTab = document.getElementById('tab-patient');
            const hospitalTab = document.getElementById('tab-hospital');
            const emailInput = document.getElementById('email');
            const roleInput = document.getElementById('role-input');
            const signupSection = document.getElementById('signup-section');
            const active = "flex-1 py-3 text-sm font-bold rounded-xl bg-white shadow-sm text-brand-900 transition-all";
            const inactive = "flex-1 py-3 text-sm font-medium rounded-xl text-slate-500 hover:text-brand-900 transition-all";
            if (type === 'patient') {
                patientTab.className = active;
                hospitalTab.className = inactive;
                emailInput.placeholder = "patient@example.com";
                roleInput.value = 'patient';
                signupSection.classList.remove('hidden');
            } else {
                hospitalTab.className = active;
                patientTab.className = inactive;
                emailInput.placeholder = "admin@hospital.com";
                roleInput.value = 'admin';
                signupSection.classList.add('hidden');
            }
        }

        // Handle role selection from URL query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const initialRole = urlParams.get('role');
        if (initialRole === 'admin' || initialRole === 'hospital') {
            switchTab('hospital');
        } else if (initialRole === 'patient') {
            switchTab('patient');
        }
    </script>
</body>
</html>
