<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Find a Doctor - JeevanSetu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL,GRAD,opsz@300,1,0,24&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    }
                }
            }
        }
    </script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .text-gradient {
            background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .mesh-bg {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 10% 20%, hsla(160,100%,74%,0.1) 0px, transparent 50%),
                radial-gradient(at 80% 0%, hsla(189,100%,56%,0.1) 0px, transparent 50%);
        }
        .doctor-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body class="font-sans text-slate-800 antialiased mesh-bg min-h-screen">

    <!-- Sticky Navbar -->
    <header class="fixed top-0 inset-x-0 z-50 glass py-4 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center text-white transition-transform group-hover:rotate-12">
                    <span class="material-symbols-outlined text-[20px]">emergency</span>
                </div>
                <span class="text-xl font-bold text-navy-900">Jeevan<span class="text-emerald-500">Setu</span></span>
            </a>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-navy-900 transition-colors">Sign In</a>
                <a href="{{ route('register') }}" class="bg-navy-900 text-white text-sm font-semibold px-5 py-2.5 rounded-full hover:bg-navy-800 transition-all">Join Network</a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 pt-32 pb-20">
        <!-- Hero Search Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-navy-900 mb-4 tracking-tight">Find the right <span class="text-gradient">Specialist.</span></h1>
            <p class="text-slate-500 text-lg max-w-2xl mx-auto">Browse through our network of verified medical professionals and book your consultation instantly.</p>
            
            <!-- Search Bar -->
            <div class="mt-10 max-w-3xl mx-auto relative group">
                <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none text-slate-400">
                    <span class="material-symbols-outlined">search</span>
                </div>
                <input type="text" placeholder="Search by doctor name, specialty, or hospital..." class="w-full pl-16 pr-32 py-5 rounded-[2rem] glass focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none shadow-xl shadow-emerald-500/5 transition-all text-lg font-medium">
                <button class="absolute right-2 top-2 bottom-2 bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-8 rounded-[1.5rem] transition-all flex items-center gap-2">
                    Search
                </button>
            </div>

            <!-- Filters -->
            <div class="flex flex-wrap justify-center gap-3 mt-8">
                <button class="px-5 py-2 rounded-full bg-emerald-500 text-white text-sm font-bold shadow-lg shadow-emerald-500/20">All Specialists</button>
                <button class="px-5 py-2 rounded-full glass hover:bg-white text-slate-600 text-sm font-bold transition-all">Cardiology</button>
                <button class="px-5 py-2 rounded-full glass hover:bg-white text-slate-600 text-sm font-bold transition-all">Neurology</button>
                <button class="px-5 py-2 rounded-full glass hover:bg-white text-slate-600 text-sm font-bold transition-all">Pediatrics</button>
                <button class="px-5 py-2 rounded-full glass hover:bg-white text-slate-600 text-sm font-bold transition-all">Orthopedics</button>
            </div>
        </div>

        <!-- Doctor Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $doctors = [
                    ['name' => 'Dr. Arjun Sharma', 'spec' => 'Senior Cardiologist', 'hospital' => 'Apollo Health City', 'exp' => '15 Yrs Exp', 'rating' => '4.9', 'img' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?q=80&w=400&auto=format&fit=crop'],
                    ['name' => 'Dr. Priya Mehta', 'spec' => 'Neurologist', 'hospital' => 'Fortis Memorial', 'exp' => '12 Yrs Exp', 'rating' => '4.8', 'img' => 'https://images.unsplash.com/photo-1559839734-2b71f1e3c770?q=80&w=400&auto=format&fit=crop'],
                    ['name' => 'Dr. Vikram Rathore', 'spec' => 'Orthopedic Surgeon', 'hospital' => 'Max Super Specialty', 'exp' => '18 Yrs Exp', 'rating' => '5.0', 'img' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?q=80&w=400&auto=format&fit=crop'],
                    ['name' => 'Dr. Ananya Iyer', 'spec' => 'Pediatrician', 'hospital' => 'AIIMS Network', 'exp' => '9 Yrs Exp', 'rating' => '4.7', 'img' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?q=80&w=400&auto=format&fit=crop'],
                    ['name' => 'Dr. Rohan Gupta', 'spec' => 'Dermatologist', 'hospital' => 'Medanta Medicity', 'exp' => '11 Yrs Exp', 'rating' => '4.9', 'img' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?q=80&w=400&auto=format&fit=crop'],
                    ['name' => 'Dr. Sneha Kapoor', 'spec' => 'Gynecologist', 'hospital' => 'Cloudnine Hospitals', 'exp' => '14 Yrs Exp', 'rating' => '4.8', 'img' => 'https://images.unsplash.com/photo-1551601651-2a8555f1a136?q=80&w=400&auto=format&fit=crop'],
                ];
            @endphp

            @foreach($doctors as $doctor)
            <div class="doctor-card glass rounded-[2rem] p-6 transition-all duration-500 group relative">
                <div class="flex items-start gap-5">
                    <div class="relative">
                        <img src="{{ $doctor['img'] }}" alt="Doctor" class="w-24 h-24 rounded-2xl object-cover shadow-lg group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute -bottom-2 -right-2 bg-emerald-500 text-white text-[10px] font-bold px-2 py-1 rounded-lg flex items-center gap-1 shadow-lg">
                            <span class="material-symbols-outlined text-[12px] fill-current">star</span> {{ $doctor['rating'] }}
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-navy-900 group-hover:text-emerald-600 transition-colors">{{ $doctor['name'] }}</h3>
                        <p class="text-emerald-500 text-sm font-bold mb-3 uppercase tracking-wider">{{ $doctor['spec'] }}</p>
                        <div class="space-y-1.5">
                            <div class="flex items-center gap-2 text-slate-500 text-xs font-medium">
                                <span class="material-symbols-outlined text-[16px]">apartment</span> {{ $doctor['hospital'] }}
                            </div>
                            <div class="flex items-center gap-2 text-slate-500 text-xs font-medium">
                                <span class="material-symbols-outlined text-[16px]">history</span> {{ $doctor['exp'] }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 pt-6 border-t border-slate-200/50 flex items-center justify-between">
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Consultation</div>
                        <div class="text-lg font-bold text-navy-900">₹800 <span class="text-xs font-medium text-slate-400">/ visit</span></div>
                    </div>
                    <a href="{{ route('appointments.create') }}" class="bg-navy-900 hover:bg-navy-800 text-white text-sm font-bold px-6 py-3 rounded-xl transition-all shadow-lg shadow-navy-900/10">
                        Book Appointment
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <footer class="border-t border-slate-200 bg-white py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-slate-500 text-sm font-medium">&copy; {{ date('Y') }} JeevanSetu Healthcare. Empowering patients with choice.</p>
        </div>
    </footer>
</body>
</html>
