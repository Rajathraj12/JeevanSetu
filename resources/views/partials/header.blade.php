@php
    $user = auth()->user();
    $role = $user ? $user->role : session('role', 'patient');
    $defaultEmail = $role === 'admin' ? 'admin@JeevanSetu.com' : 'patient@example.com';
    $defaultName = $role === 'admin' ? 'Admin' : 'Patient';
    $email = $user ? $user->email : session('email', $defaultEmail);
    $name = $user ? $user->name : session('name', $defaultName);
    $initial = strtoupper(substr($name, 0, 1));
    if (empty($initial)) $initial = $role === 'admin' ? 'A' : 'P';
@endphp
<header class="sticky top-0 w-full z-40 bg-surface border-b border-outline-variant shadow-sm flex justify-between items-center px-4 md:px-8 h-16 text-primary">
    <div class="flex items-center">
        <button id="mobile-menu-btn" class="lg:hidden p-2 mr-2 text-on-surface-variant hover:text-secondary focus:outline-none">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <!-- Search Bar (Admin Only) -->
        @if($role === 'admin')
        <div class="hidden md:flex items-center bg-surface-container-low rounded-full px-4 py-2 w-96 border border-outline-variant/50 focus-within:ring-2 focus-within:ring-secondary/20 transition-all">
            <span class="material-symbols-outlined text-on-surface-variant mr-2">search</span>
            <input onkeypress="if(event.key === 'Enter') alert('Searching for: ' + this.value);" class="bg-transparent border-none outline-none text-body-sm w-full placeholder-on-surface-variant/70 text-on-surface focus:ring-0" placeholder="Search patients, records..." type="text"/>
        </div>
        @endif
    </div>

        <!-- Actions & Profile -->
    <div class="flex items-center gap-2 md:gap-4">
        
        <div class="h-8 w-px bg-outline-variant/50 mx-2 hidden md:block"></div>
        
        @if($role === 'admin')
        <div class="hidden md:flex bg-secondary/10 text-secondary font-label-sm px-3 py-1 rounded-full border border-secondary/20 items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">verified_user</span>
            Admin
        </div>
        @else
        <div class="hidden md:flex bg-primary/10 text-primary font-label-sm px-3 py-1 rounded-full border border-primary/20 items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">personal_injury</span>
            Patient
        </div>
        @endif

        <!-- Profile Dropdown -->
        <div class="relative" id="profile-dropdown-container">
            <button onclick="document.getElementById('profile-menu').classList.toggle('hidden')" class="flex items-center gap-3 hover:bg-surface-container px-3 py-1.5 rounded-full transition-colors border border-outline-variant/30 focus:outline-none focus:ring-2 focus:ring-primary/20 bg-white">
                <div class="w-8 h-8 rounded-full bg-primary-container text-white flex items-center justify-center font-bold">
                    {{ $initial }}
                </div>
                <span class="hidden md:block text-label-md font-medium text-slate-700">Profile</span>
                <span class="material-symbols-outlined text-slate-500 text-[20px]">expand_more</span>
            </button>

            <!-- Dropdown Menu -->
            <div id="profile-menu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-slate-100 py-2 z-50">
                <div class="px-4 py-3 border-b border-slate-100 mb-2">
                    <p class="text-sm text-slate-500">Signed in as</p>
                    <p class="text-sm font-bold text-slate-900 truncate">{{ $email }}</p>
                </div>
                
                <a href="{{ route('profile') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-[18px]">account_circle</span> My Account
                </a>
                <a href="{{ route('settings') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-[18px]">settings</span> Settings
                </a>
                <a href="{{ route('support') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-[18px]">help</span> Help & Support
                </a>
                
                <div class="border-t border-slate-100 my-2"></div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium text-left">
                        <span class="material-symbols-outlined text-[18px]">logout</span> Sign out
                    </button>
                </form>
            </div>
        </div>

        <script>
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                const container = document.getElementById('profile-dropdown-container');
                const menu = document.getElementById('profile-menu');
                if (container && !container.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        </script>
    </div>
</header>
