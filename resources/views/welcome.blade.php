<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>JeevanSetu - Modern Healthcare Platform</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL,GRAD,opsz@300,1,0,24&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        navy: { 900: '#0a0f1c', 800: '#111827' },
                        emerald: { 400: '#34d399', 500: '#10b981', 600: '#059669' },
                        teal: { 400: '#2dd4bf', 500: '#14b8a6' },
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 3s infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
                        },
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .glass-dark {
            background: rgba(17, 24, 39, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .text-gradient {
            background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .mesh-bg {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 10% 20%, hsla(160,100%,74%,0.15) 0px, transparent 50%),
                radial-gradient(at 80% 0%, hsla(189,100%,56%,0.15) 0px, transparent 50%),
                radial-gradient(at 0% 60%, hsla(160,100%,74%,0.15) 0px, transparent 50%);
        }
        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="font-sans text-slate-800 antialiased mesh-bg min-h-screen relative overflow-x-hidden selection:bg-emerald-500/30">

    <!-- Background Blobs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-teal-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/2 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Sticky Navbar -->
    <header class="fixed top-0 inset-x-0 z-50 transition-all duration-300" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)" :class="{ 'glass shadow-sm py-3': scrolled, 'bg-transparent py-5': !scrolled }">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <span class="material-symbols-outlined text-white text-[18px]">emergency</span>
                </div>
                <span class="text-xl font-bold text-navy-900 tracking-tight">Jeevan<span class="text-emerald-500">Setu</span></span>
            </div>
            
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                <a href="{{ route('patients') }}" class="relative group hover:text-navy-900 transition-colors">
                    Patients
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('hospitals') }}" class="relative group hover:text-navy-900 transition-colors">
                    Hospitals
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('admissions') }}" class="relative group hover:text-navy-900 transition-colors">
                    Admissions
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                </a>
            </nav>

            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="hidden sm:block text-sm font-medium text-slate-600 hover:text-navy-900 transition-colors">Log in</a>
                <a href="{{ route('login') }}" class="bg-navy-900 hover:bg-navy-800 text-white text-sm font-semibold px-5 py-2.5 rounded-full shadow-lg shadow-navy-900/20 transition-all hover:scale-105 active:scale-95">
                    Get Started
                </a>
            </div>
        </div>
    </header>

    <main class="relative z-10 pt-32 pb-16">
        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col lg:flex-row items-center gap-16 lg:gap-8 min-h-[85vh]">
            <!-- Left Text -->
            <div class="flex-1 flex flex-col items-start text-left max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-600 text-xs font-bold uppercase tracking-wider mb-8 shadow-sm">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    Connected Healthcare Infrastructure
                </div>

                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-navy-900 tracking-tight leading-[1.05] mb-6">
                    Next-gen healthcare <br/>
                    powered by <span class="text-gradient">Data.</span>
                </h1>

                <p class="text-lg text-slate-500 mb-10 max-w-xl leading-relaxed">
                    Instantly connect with doctors, track real-time bed availability, and receive smart, data-driven admission recommendations across a unified hospital network.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
                    <a href="{{ route('find-doctor') }}" class="w-full sm:w-auto bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-semibold text-base px-8 py-4 rounded-full shadow-lg shadow-emerald-500/30 transition-all hover:shadow-xl hover:shadow-emerald-500/40 hover:-translate-y-0.5 flex justify-center items-center gap-2">
                        Find a Doctor <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                    <a href="{{ route('city-beds') }}" class="w-full sm:w-auto glass hover:bg-white/80 text-navy-900 font-semibold text-base px-8 py-4 rounded-full transition-all text-center flex justify-center items-center">
                        View Live Beds
                    </a>
                </div>
                
                <div class="mt-10 flex items-center gap-4 text-sm text-slate-500 font-medium">
                    <div class="flex -space-x-2">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?img=1" alt="User">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?img=2" alt="User">
                        <img class="w-8 h-8 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?img=3" alt="User">
                    </div>
                    <span>Trusted by 10,000+ medical professionals</span>
                </div>
            </div>

            <!-- Right Advanced Illustration -->
            <div class="flex-1 relative w-full h-[600px] hidden lg:block">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-teal-500/5 rounded-[2.5rem] border border-white/40 shadow-2xl overflow-hidden glass">
                    <!-- Dashboard UI Wireframe -->
                    <div class="absolute top-4 left-4 right-4 h-12 border-b border-slate-200/50 flex items-center gap-2 px-4">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    </div>
                    
                    <!-- Floating Elements Inside -->
                    <div class="absolute inset-0 pt-20 px-8 pb-8 flex flex-col gap-6">
                        <!-- Main Card -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center gap-4 animate-float">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <span class="material-symbols-outlined text-2xl">bed</span>
                            </div>
                            <div class="flex-1">
                                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Live ICU Capacity</div>
                                <div class="text-2xl font-bold text-navy-900">42 / 50 Beds</div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2">
                                    <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 84%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-6 h-full">
                            <!-- Left Mini Card -->
                            <div class="flex-1 bg-gradient-to-br from-navy-900 to-navy-800 rounded-2xl p-6 shadow-lg text-white flex flex-col justify-between animate-float-delayed relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/20 blur-2xl rounded-full"></div>
                                <div class="relative z-10">
                                    <span class="material-symbols-outlined text-emerald-400 mb-2">neurology</span>
                                    <div class="text-sm font-medium text-slate-300">Smart Triage Match</div>
                                    <div class="text-xl font-bold mt-1">98.5% Accuracy</div>
                                </div>
                                <div class="relative z-10 mt-4 flex -space-x-1">
                                    <div class="w-2 h-8 bg-emerald-500 rounded-full animate-pulse-slow"></div>
                                    <div class="w-2 h-12 bg-emerald-400 rounded-full animate-pulse-slow" style="animation-delay: 0.2s"></div>
                                    <div class="w-2 h-6 bg-teal-500 rounded-full animate-pulse-slow" style="animation-delay: 0.4s"></div>
                                    <div class="w-2 h-10 bg-teal-400 rounded-full animate-pulse-slow" style="animation-delay: 0.6s"></div>
                                </div>
                            </div>

                            <!-- Right Mini Card -->
                            <div class="flex-1 bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-center items-center text-center animate-float" style="animation-delay: 1.5s">
                                <div class="relative flex items-center justify-center w-16 h-16 mb-3">
                                    <div class="absolute inset-0 bg-red-100 rounded-full animate-ping opacity-75"></div>
                                    <div class="relative bg-red-50 w-12 h-12 rounded-full flex items-center justify-center text-red-500">
                                        <span class="material-symbols-outlined">emergency</span>
                                    </div>
                                </div>
                                <div class="text-sm font-bold text-slate-800">Emergency Status</div>
                                <div class="text-xs text-slate-500 mt-1">Routing to nearest facility...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Trusted By Section -->
        <section class="border-y border-slate-200/50 bg-white/50 py-10 mt-12">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                <p class="text-sm font-semibold text-slate-400 mb-8 uppercase tracking-widest">Integrating with the nation's leading healthcare providers</p>
                <div class="flex flex-wrap justify-center items-center gap-12 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                    <div class="text-xl font-bold text-slate-800 flex items-center gap-2"><span class="material-symbols-outlined">local_hospital</span> Apollo Health</div>
                    <div class="text-xl font-bold text-slate-800 flex items-center gap-2"><span class="material-symbols-outlined">health_and_safety</span> Fortis Care</div>
                    <div class="text-xl font-bold text-slate-800 flex items-center gap-2"><span class="material-symbols-outlined">monitor_heart</span> JeevanSetu</div>
                    <div class="text-xl font-bold text-slate-800 flex items-center gap-2"><span class="material-symbols-outlined">healing</span> AIIMS Network</div>
                </div>
            </div>
        </section>

        <!-- How It Works (Bento Layout) -->
        <section class="max-w-7xl mx-auto px-6 lg:px-8 py-32">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-navy-900 tracking-tight mb-4">Streamlined Healthcare Architecture</h2>
                <p class="text-slate-500 text-lg">We've completely re-engineered the patient admission flow into a seamless, intelligent process.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="glass p-8 rounded-[2rem] hover-lift relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-all"></div>
                    <div class="w-12 h-12 bg-white shadow-sm rounded-2xl flex items-center justify-center text-emerald-500 mb-6 font-bold text-xl border border-slate-100">1</div>
                    <h3 class="text-xl font-bold text-navy-900 mb-3">Instant Triage</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Our system analyzes your symptoms and instantly determines the required level of care and medical specialization.</p>
                </div>
                <!-- Step 2 -->
                <div class="glass p-8 rounded-[2rem] hover-lift relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl group-hover:bg-teal-500/20 transition-all"></div>
                    <div class="w-12 h-12 bg-white shadow-sm rounded-2xl flex items-center justify-center text-teal-500 mb-6 font-bold text-xl border border-slate-100">2</div>
                    <h3 class="text-xl font-bold text-navy-900 mb-3">Live Resource Match</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">The system scans our entire hospital network to locate the nearest available specialist and open beds.</p>
                </div>
                <!-- Step 3 -->
                <div class="glass p-8 rounded-[2rem] hover-lift relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-all"></div>
                    <div class="w-12 h-12 bg-white shadow-sm rounded-2xl flex items-center justify-center text-blue-500 mb-6 font-bold text-xl border border-slate-100">3</div>
                    <h3 class="text-xl font-bold text-navy-900 mb-3">Frictionless Admission</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Secure your slot instantly. Paperwork is handled digitally before you even arrive at the facility.</p>
                </div>
            </div>
        </section>

        <!-- Real-time Dashboard Feature -->
        <section class="bg-navy-900 py-32 relative overflow-hidden text-white">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+CgkJPGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMSIgZmlsbD0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjA1KSIvPgoJPC9zdmc+')]"></div>
            
            <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 text-teal-300 text-xs font-bold uppercase tracking-wider mb-6">
                            Data Infrastructure
                        </div>
                        <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-6 leading-tight">
                            Command center for <br/>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-emerald-400">hospital operations.</span>
                        </h2>
                        <p class="text-slate-400 text-lg mb-8 leading-relaxed">
                            A unified, real-time view of hospital resources. Eliminate blind spots, manage ward capacities, and coordinate emergency responses with military precision.
                        </p>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3 text-slate-300"><span class="material-symbols-outlined text-emerald-400">check_circle</span> Live bed occupancy tracking</li>
                            <li class="flex items-center gap-3 text-slate-300"><span class="material-symbols-outlined text-emerald-400">check_circle</span> Predictive discharge modeling</li>
                            <li class="flex items-center gap-3 text-slate-300"><span class="material-symbols-outlined text-emerald-400">check_circle</span> Automated emergency routing</li>
                        </ul>
                    </div>
                    
                    <div class="flex-1 w-full">
                        <div class="glass-dark rounded-2xl p-6 border border-white/10 shadow-2xl">
                            <!-- Dark UI Mockup -->
                            <div class="flex justify-between items-center mb-6">
                                <div class="text-sm font-bold">Network Capacity</div>
                                <div class="text-xs bg-emerald-500/20 text-emerald-400 px-2 py-1 rounded text-green-400">Live Updates Active</div>
                            </div>
                            
                            <div class="space-y-4">
                                <!-- Row 1 -->
                                <div class="bg-white/5 rounded-xl p-4 flex justify-between items-center hover:bg-white/10 transition-colors cursor-pointer">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400"><span class="material-symbols-outlined">airline_seat_flat</span></div>
                                        <div>
                                            <div class="font-bold">General Wards</div>
                                            <div class="text-xs text-slate-400">Across 12 facilities</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-emerald-400">142 Available</div>
                                        <div class="text-xs text-slate-400">of 500 total</div>
                                    </div>
                                </div>
                                <!-- Row 2 -->
                                <div class="bg-white/5 rounded-xl p-4 flex justify-between items-center hover:bg-white/10 transition-colors cursor-pointer">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-red-500/20 flex items-center justify-center text-red-400"><span class="material-symbols-outlined">monitor_heart</span></div>
                                        <div>
                                            <div class="font-bold">Intensive Care (ICU)</div>
                                            <div class="text-xs text-slate-400">Critical priority</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-amber-400">12 Available</div>
                                        <div class="text-xs text-slate-400">of 150 total</div>
                                    </div>
                                </div>
                                <!-- Row 3 -->
                                <div class="bg-white/5 rounded-xl p-4 flex justify-between items-center hover:bg-white/10 transition-colors cursor-pointer">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-400"><span class="material-symbols-outlined">masks</span></div>
                                        <div>
                                            <div class="font-bold">Surgical Theaters</div>
                                            <div class="text-xs text-slate-400">Scheduled</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-emerald-400">4 Available</div>
                                        <div class="text-xs text-slate-400">Ready for dispatch</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="max-w-7xl mx-auto px-6 lg:px-8 py-32">
            <h2 class="text-3xl font-extrabold text-navy-900 text-center mb-16">Trusted by Healthcare Leaders</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative">
                    <span class="material-symbols-outlined text-4xl text-slate-200 absolute top-8 left-8">format_quote</span>
                    <p class="text-slate-600 text-lg leading-relaxed relative z-10 mt-6 font-medium">"JeevanSetu has completely transformed how we manage patient intake. The smart triage accuracy is unprecedented, reducing wait times by over 40% in our emergency department."</p>
                    <div class="mt-8 flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-200 rounded-full"></div>
                        <div>
                            <div class="font-bold text-navy-900">Dr. Sarah Jenkins</div>
                            <div class="text-sm text-slate-500">Chief Medical Officer, Apollo Health</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative">
                    <span class="material-symbols-outlined text-4xl text-slate-200 absolute top-8 left-8">format_quote</span>
                    <p class="text-slate-600 text-lg leading-relaxed relative z-10 mt-6 font-medium">"Finally, a modern operating system for healthcare. The real-time bed tracking API integrated seamlessly with our existing infrastructure in a matter of days."</p>
                    <div class="mt-8 flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-200 rounded-full"></div>
                        <div>
                            <div class="font-bold text-navy-900">David Chen</div>
                            <div class="text-sm text-slate-500">CTO, National Hospital Network</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Banner -->
        <section class="max-w-5xl mx-auto px-6 lg:px-8 mb-20">
            <div class="bg-gradient-to-r from-navy-900 to-navy-800 rounded-[2.5rem] p-12 text-center shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+CgkJPGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMSIgZmlsbD0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjA1KSIvPgoJPC9zdmc+')]"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6">Ready to upgrade your healthcare infrastructure?</h2>
                    <p class="text-slate-300 mb-8 max-w-2xl mx-auto text-lg">Join hundreds of hospitals already using JeevanSetu to streamline admissions and save lives.</p>
                    <a href="{{ route('login') }}" class="inline-flex bg-emerald-500 hover:bg-emerald-400 text-white font-bold px-8 py-4 rounded-full transition-all shadow-[0_0_20px_rgb(16,185,129,0.4)] hover:shadow-[0_0_30px_rgb(16,185,129,0.6)]">
                        Request a Demo
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white py-8 relative z-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-500 fill-current">emergency</span>
                <span class="text-xl font-bold text-navy-900 tracking-tight">Jeevan<span class="text-emerald-500">Setu</span></span>
            </div>
            
            <div class="text-sm text-slate-500 text-center md:text-left">
                &copy; {{ date('Y') }} JeevanSetu. All rights reserved.
            </div>

            <div class="flex gap-6 text-sm font-medium text-slate-500">
                <a href="#" class="hover:text-emerald-500 transition-colors">Privacy</a>
                <a href="#" class="hover:text-emerald-500 transition-colors">Terms</a>
                <a href="#" class="hover:text-emerald-500 transition-colors">Contact</a>
            </div>
        </div>
    </footer>
</body>
</html>
