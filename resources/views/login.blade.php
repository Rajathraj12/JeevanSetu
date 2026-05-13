<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - JeevanSetu</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;500;700&family=Mukta:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"DM Sans"', 'sans-serif'],
                        display: ['"Mukta"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#e5f6f2',
                            100: '#cceae3',
                            400: '#339780',
                            500: '#006b55', 
                            600: '#005644',
                            900: '#0f1c2c', 
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
</head>
<body class="font-sans text-slate-800 antialiased bg-[#f8f9fa] min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <!-- Decorative Background -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-accent-400/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[30rem] h-[30rem] bg-brand-500/10 rounded-full blur-3xl"></div>
    </div>

    <a href="{{ route('home') }}" class="absolute top-6 left-6 flex items-center gap-2 text-slate-500 hover:text-brand-900 transition-colors font-medium">
        <span class="material-symbols-outlined">arrow_back</span>
        Back to Home
    </a>

    <!-- Login Card -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-[0_20px_50px_rgb(0,0,0,0.05)] border border-slate-100 p-8 sm:p-10 relative z-10 backdrop-blur-sm">
        
        <!-- Logo -->
        <div class="flex justify-center items-center gap-2 mb-6">
            <span class="material-symbols-outlined text-brand-500 fill-current text-4xl" style="font-variation-settings: 'FILL' 1;">medical_services</span>
            <span class="text-3xl font-display font-bold tracking-tight"><span class="text-brand-900">JEEVAN</span><span class="text-accent-500">setu</span></span>
        </div>

        <h2 id="form-title" class="text-2xl font-display font-bold text-brand-900 mb-2 text-center">Patient Login</h2>
        <p class="text-slate-500 text-center text-sm mb-6">Please enter your details to sign in.</p>

        <!-- Role Switcher Tabs -->
        <div class="flex p-1 bg-slate-100 rounded-xl mb-8 border border-slate-200/60">
            <button id="tab-patient" type="button" class="flex-1 py-2 text-sm font-bold rounded-lg bg-white shadow-[0_2px_8px_rgb(0,0,0,0.04)] text-brand-900 transition-all" onclick="switchTab('patient')">
                <div class="flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">person</span> Patient
                </div>
            </button>
            <button id="tab-hospital" type="button" class="flex-1 py-2 text-sm font-medium rounded-lg text-slate-500 hover:text-brand-900 transition-all" onclick="switchTab('hospital')">
                <div class="flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">local_hospital</span> Hospital
                </div>
            </button>
        </div>

        <!-- Login Form goes straight to Dashboard for prototype purposes -->
        <form action="{{ route('login.submit') }}" method="POST" id="loginForm" class="space-y-5">
            @csrf
            <input type="hidden" name="role" id="role-input" value="patient">
            
            <div>
                <label for="email" class="block text-sm font-medium text-brand-900 mb-1.5">Email</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">mail</span>
                    <input type="email" id="email" name="email" class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm" placeholder="patient@example.com" value="" required>
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-brand-900 mb-1.5">Password</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                    <input type="password" id="password" name="password" class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm" placeholder="••••••••" value="" required>
                </div>
            </div>

            <div class="flex items-center justify-between mt-2">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="w-4 h-4 text-brand-500 bg-slate-50 border-slate-300 rounded focus:ring-brand-500 focus:ring-2">
                    <label for="remember" class="ml-2 text-sm text-slate-600 cursor-pointer">Remember me</label>
                </div>
                <a href="#" class="text-sm font-medium text-brand-500 hover:text-brand-600 transition-colors">Forgot password?</a>
            </div>

            <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3.5 rounded-xl shadow-[0_8px_20px_rgb(0,107,85,0.25)] hover:shadow-[0_8px_25px_rgb(0,107,85,0.35)] hover:-translate-y-0.5 transition-all mt-4 flex justify-center items-center gap-2">
                Sign In <span class="material-symbols-outlined text-[18px]">login</span>
            </button>
        </form>

        <div id="signup-section" class="mt-8 text-center text-sm text-slate-500">
            Don't have an account? <a href="{{ route('register') }}" class="font-bold text-brand-500 hover:text-brand-600 transition-colors">Sign up now</a>
        </div>
    </div>

    <script>
        function switchTab(type) {
            const patientTab = document.getElementById('tab-patient');
            const hospitalTab = document.getElementById('tab-hospital');
            const emailInput = document.getElementById('email');
            const formTitle = document.getElementById('form-title');
            const signupSection = document.getElementById('signup-section');
            const roleInput = document.getElementById('role-input');

            const activeClass = "flex-1 py-2 text-sm font-bold rounded-lg bg-white shadow-[0_2px_8px_rgb(0,0,0,0.04)] text-brand-900 transition-all";
            const inactiveClass = "flex-1 py-2 text-sm font-medium rounded-lg text-slate-500 hover:text-brand-900 transition-all";

            if (type === 'patient') {
                patientTab.className = activeClass;
                hospitalTab.className = inactiveClass;
                emailInput.placeholder = "patient@example.com";
                emailInput.value = "patient@example.com";
                formTitle.innerText = "Patient Login";
                signupSection.style.display = 'block';
                roleInput.value = 'patient';
            } else {
                hospitalTab.className = activeClass;
                patientTab.className = inactiveClass;
                emailInput.placeholder = "admin@JeevanSetu.com";
                emailInput.value = "admin@JeevanSetu.com";
                formTitle.innerText = "Hospital Login";
                signupSection.style.display = 'none';
                roleInput.value = 'admin';
            }
        }
    </script>

</body>
</html>
