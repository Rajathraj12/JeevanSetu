<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sign Up - JeevanSetu</title>
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

    <!-- Register Card -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-[0_20px_50px_rgb(0,0,0,0.05)] border border-slate-100 p-8 sm:p-10 relative z-10 backdrop-blur-sm mt-8">
        
        <!-- Logo -->
        <div class="flex justify-center items-center gap-2 mb-6">
            <span class="material-symbols-outlined text-brand-500 fill-current text-4xl" style="font-variation-settings: 'FILL' 1;">medical_services</span>
            <span class="text-3xl font-display font-bold tracking-tight"><span class="text-brand-900">JEEVAN</span><span class="text-accent-500">setu</span></span>
        </div>

        <h2 class="text-2xl font-display font-bold text-brand-900 mb-2 text-center">Create an Account</h2>
        <p class="text-slate-500 text-center text-sm mb-8">Join our network to manage your healthcare seamlessly.</p>

        <!-- Register Form goes straight to Dashboard for prototype purposes -->
        <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="role" value="patient">

            <div>
                <label for="name" class="block text-sm font-medium text-brand-900 mb-1.5">Full Name</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">person</span>
                    <input type="text" id="name" name="name" class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm" placeholder="John Doe" required>
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-brand-900 mb-1.5">Email</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">mail</span>
                    <input type="email" id="email" name="email" class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm" placeholder="patient@example.com" required>
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-brand-900 mb-1.5">Password</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                    <input type="password" id="password" name="password" class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3.5 rounded-xl shadow-[0_8px_20px_rgb(0,107,85,0.25)] hover:shadow-[0_8px_25px_rgb(0,107,85,0.35)] hover:-translate-y-0.5 transition-all mt-6 flex justify-center items-center gap-2">
                Sign Up <span class="material-symbols-outlined text-[18px]">person_add</span>
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-slate-500">
            Already have an account? <a href="{{ route('login') }}" class="font-bold text-brand-500 hover:text-brand-600 transition-colors">Log in</a>
        </div>
    </div>

</body>
</html>
