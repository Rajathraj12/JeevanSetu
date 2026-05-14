<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'JeevanSetu Medical System')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;500;700&amp;family=Mukta:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#000000",
                        "secondary-fixed": "#6dfad2",
                        "background": "#f8f9fa",
                        "surface": "#f8f9fa",
                        "secondary": "#006b55",
                        "error": "#ba1a1a",
                        "primary-container": "#0f1c2c",
                        "on-primary-container": "#778598",
                        "surface-container-low": "#f3f4f5",
                        "outline-variant": "#c4c6cc",
                        "on-surface-variant": "#44474c",
                        "on-surface": "#191c1d"
                    },
                    "fontFamily": {
                        "label-sm": ["DM Sans"],
                        "headline-md": ["Mukta"],
                        "headline-lg": ["Mukta"],
                        "body-md": ["DM Sans"],
                        "body-sm": ["DM Sans"],
                        "body-lg": ["DM Sans"],
                        "headline-sm": ["Mukta"],
                        "label-md": ["DM Sans"],
                        "display-lg": ["Mukta"]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .icon-fill {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    @stack('styles')
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex">
    
    <!-- Toast Container -->
    <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-3"></div>

    @include('partials.sidebar')

    <!-- Main Content Canvas -->
    <main class="flex-1 lg:ml-[260px] flex flex-col min-h-screen">
        
        @include('partials.header')

        <!-- Dynamic Content -->
        <div class="p-4 md:p-8 flex flex-col flex-1 overflow-x-hidden">
            @yield('content')
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const menuBtn = document.getElementById('mobile-menu-btn');
            if (sidebar && menuBtn) {
                menuBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                });
            }
        });

        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            const bgColor = type === 'success' ? 'bg-secondary' : (type === 'error' ? 'bg-error' : 'bg-primary-container');
            const icon = type === 'success' ? 'check_circle' : (type === 'error' ? 'error' : 'info');

            toast.className = `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-3 transform translate-y-10 opacity-0 transition-all duration-300 ease-out`;
            toast.innerHTML = `
                <span class="material-symbols-outlined">${icon}</span>
                <span class="text-label-md font-medium">${message}</span>
            `;

            container.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-y-10', 'opacity-0');
            }, 10);

            // Remove after 3 seconds
            setTimeout(() => {
                toast.classList.add('opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>
    @stack('scripts')
</body>
</html>
