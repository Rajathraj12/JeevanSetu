<aside id="sidebar" class="w-[260px] h-full fixed left-0 top-0 bg-primary-container border-r border-outline-variant/20 shadow-md flex flex-col py-6 px-4 z-50 -translate-x-full lg:translate-x-0 transition-transform duration-300">
    @php
        $user = auth()->user();
        $role = $user ? $user->role : session('role', 'patient');
    @endphp

    <div class="mb-8 px-4 flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-[#1e2d40] flex items-center justify-center text-secondary-fixed shrink-0 border border-secondary-fixed/20">
            <span class="material-symbols-outlined text-2xl">medical_services</span>
        </div>
        <div>
            <h1 class="text-headline-sm font-bold text-white tracking-wide">JeevanSetu</h1>
            <p class="text-[11px] text-white/60 tracking-widest mt-0.5 uppercase">{{ $role === 'admin' ? 'Medical System' : 'Patient Portal' }}</p>
        </div>
    </div>
    
    <nav class="flex-1 flex flex-col gap-2 overflow-y-auto no-scrollbar">
        @php
            if ($role === 'patient') {
                $navItems = [
                    ['name' => 'Dashboard', 'icon' => 'grid_view', 'route' => 'dashboard'],
                    ['name' => 'Hospital Finder', 'icon' => 'local_hospital', 'route' => 'city-beds'],
                    ['name' => 'OPD Queue', 'icon' => 'clinical_notes', 'route' => 'opd-queue'],
                    ['name' => 'My Appointments', 'icon' => 'calendar_month', 'route' => 'my-appointments'],
                    ['name' => 'Medical Records', 'icon' => 'description', 'route' => 'medical-records'],
                ];
            } else {
                $navItems = [
                    ['name' => 'Dashboard', 'icon' => 'grid_view', 'route' => 'dashboard'],
                    ['name' => 'OPD Queue', 'icon' => 'clinical_notes', 'route' => 'opd-queue'],
                    ['name' => 'Bed Map', 'icon' => 'bed', 'route' => 'bed-map'],
                    ['name' => 'Admissions', 'icon' => 'patient_list', 'route' => 'admissions'],
                    ['name' => 'Inventory', 'icon' => 'inventory_2', 'route' => 'inventory'],
                    ['name' => 'Doctor Schedule', 'icon' => 'calendar_today', 'route' => 'doctor-schedule'],
                    ['name' => 'Wait Board', 'icon' => 'hourglass_empty', 'route' => 'wait-board'],
                    ['name' => 'City Beds', 'icon' => 'location_city', 'route' => 'city-beds'],
                ];
            }
        @endphp

        @foreach($navItems as $item)
            @php 
                $isActive = request()->routeIs($item['route']);
            @endphp
            <a href="{{ route($item['route']) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ $isActive ? 'bg-[#1e2d40] text-white border-l-4 border-secondary-fixed font-bold' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                <span class="material-symbols-outlined {{ $isActive ? 'icon-fill text-secondary-fixed' : '' }} text-[22px]">{{ $item['icon'] }}</span>
                <span class="text-sm tracking-wide">{{ $item['name'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="mt-auto flex flex-col gap-2 pt-4 border-t border-white/10">



        <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors text-left">
                <span class="material-symbols-outlined text-[22px]">logout</span>
                <span class="text-sm tracking-wide">Logout</span>
            </button>
        </form>
    </div>
</aside>
