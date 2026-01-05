<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" type="image/png" href="{{ asset('images/plugzone.png') }}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body id="top">
    <div class="amazon-layout">
        @include('components.navbar')
        
        <div class="content-wrapper">
            @auth
                <aside>
                    @include('components.left-bar')
                </aside>
            @endauth
            
            <main class="main-content">
                @include('components.alerts')
                @yield('content')
            </main>
        </div>
        
        @include('components.footer')
    </div>
    
    <script>
        // Theme initialization and toggle functionality
        (function() {
            const body = document.body;
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const themeText = document.getElementById('theme-text');
            
            // Get saved theme or default to dark
            const savedTheme = localStorage.getItem('theme') || 'dark';
            
            // Apply theme on load
            function applyTheme(theme) {
                if (theme === 'dark') {
                    body.classList.add('dark-mode');
                    if (themeIcon) themeIcon.textContent = '🌙';
                    if (themeText) themeText.textContent = 'Dark';
                } else {
                    body.classList.remove('dark-mode');
                    if (themeIcon) themeIcon.textContent = '☀️';
                    if (themeText) themeText.textContent = 'Light';
                }
                localStorage.setItem('theme', theme);
            }
            
            // Initialize theme
            applyTheme(savedTheme);
            
            // Toggle theme on button click
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    const currentTheme = body.classList.contains('dark-mode') ? 'dark' : 'light';
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    applyTheme(newTheme);
                });
                
                // Hover effect
                themeToggle.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = 'rgba(255,255,255,0.1)';
                    this.style.borderColor = 'rgba(255,255,255,0.5)';
                });
                themeToggle.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = 'transparent';
                    this.style.borderColor = 'rgba(255,255,255,0.3)';
                });
            }
        })();
    </script>
</body>
</html>
