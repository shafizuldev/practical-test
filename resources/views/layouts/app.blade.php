<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - My Laravel Website</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="flex flex-col min-h-screen bg-white text-gray-900">
    <!-- ✅ Navbar -->
    <header class="bg-gray-800 text-white">
      <nav class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold">MyWebsite</a>
        <ul class="flex space-x-6">
          <li><a href="{{ route('home') }}" class="hover:text-blue-300 {{ request()->routeIs('home') ? 'text-blue-400' : '' }}">Home</a></li>
          <li><a href="{{ route('about') }}" class="hover:text-blue-300 {{ request()->routeIs('about') ? 'text-blue-400' : '' }}">About</a></li>
          <li><a href="{{ route('privacy') }}" class="hover:text-blue-300 {{ request()->routeIs('privacy') ? 'text-blue-400' : '' }}">Privacy</a></li>
          <li><a href="{{ route('terms') }}" class="hover:text-blue-300 {{ request()->routeIs('terms') ? 'text-blue-400' : '' }}">Terms</a></li>
        </ul>
      </nav>
    </header>

    <!-- Main content -->
    <main class="flex-grow">
      @yield('content')
    </main>
<!-- Privacy Consent Modal -->
<!-- Privacy Consent Modal -->
<div id="privacy-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg max-w-lg mx-auto p-8 text-center">
      <h2 class="text-2xl font-semibold mb-4 text-gray-800">Privacy Consent</h2>
  
      <p class="text-gray-700 mb-4">
        Cookies are necessary for this website to function properly, for performance measurement,
        and to provide you with the best experience.
      </p>
  
      <p class="text-gray-700 mb-6">
        By continuing to access or use this site, you acknowledge and consent to our use of cookies
        in accordance with our
        <a href="{{ route('terms') }}" class="text-blue-600 hover:underline">Terms & Conditions</a>
        and
        <a href="{{ route('privacy') }}" class="text-blue-600 hover:underline">Privacy Statement</a>.
      </p>
  
      <div class="flex justify-center space-x-4">
        <button id="accept-privacy" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
          Accept
        </button>
        <button id="decline-privacy" class="bg-gray-300 text-gray-800 px-5 py-2 rounded-lg hover:bg-gray-400 transition">
          Decline
        </button>
      </div>
    </div>
  </div>
    <!-- Footer -->
    <footer class="bg-gray-100 text-center py-4 mt-12 border-t">
      <p class="text-sm text-gray-600">© {{ date('Y') }} MyWebsite. All rights reserved.</p>
    </footer>
  </body>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('privacy-modal');
        const acceptBtn = document.getElementById('accept-privacy');
        const declineBtn = document.getElementById('decline-privacy');
    
        function getCookie(name) {
        const cookies = document.cookie.split('; ').find(row => row.startsWith(name + '='));
        if (cookies) {
            return cookies.split('=')[1];
        }
        return null;
    }
    
        // --- Check existing cookies ---
        const consentCookie = getCookie('privacy_consent');
        const declineCookie = getCookie('privacy_decline');

        if (consentCookie) {
            const parsedCookie = JSON.parse(consentCookie);
            if (parsedCookie.expiresAt && parsedCookie.expiresAt < Date.now()) {
                showModal = true;
            } 
        } else if (declineCookie) {
            const parsedCookie = JSON.parse(declineCookie);
            if (parsedCookie.expiresAt && parsedCookie.expiresAt < Date.now()) {
                showModal = true;
            } 
        } else {
            showModal = true;
        }
        // --- Show modal if needed ---
        if (showModal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    
        // --- ACCEPT ---
        acceptBtn.addEventListener('click', async () => {
            try {
                const guid = crypto.randomUUID();
                const consentData = {
                    guid,
                    accepted_at: new Date().toISOString(),
                    version: 1
                };
                document.cookie = `privacy_consent=${encodeURIComponent(JSON.stringify(consentData))}; path=/; max-age=${60 * 60 * 24 * 365}; SameSite=Lax`;

                await fetch("{{ route('privacy.accept') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(consentData)
                });
    
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            } catch (error) {
                console.error("Error accepting consent:", error);
            }
        });
    
        // --- DECLINE ---
        declineBtn.addEventListener('click', async () => {
            try {
                const declineData = { declined_at: new Date().toISOString() };
    
                document.cookie = `privacy_decline=${encodeURIComponent(JSON.stringify(declineData))}; path=/; max-age=${60 * 60 * 24}`;
    
                await fetch("{{ route('privacy.decline') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(declineData)
                });
    
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            } catch (error) {
                console.error("Error declining consent:", error);
            }
        });
    });
    </script>
    
    
    
</html>
