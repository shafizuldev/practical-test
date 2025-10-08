<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title') - Admin Panel</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex min-h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-gray-800 text-white flex flex-col">
    <div class="px-6 py-4 text-2xl font-bold border-b border-gray-700">
      Admin Panel
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2">
      <a href="{{ route('admin.consents') }}"
         class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.consents') ? 'bg-gray-700' : '' }}">
        🧾 Consents
      </a>
      <a href="{{ route('home') }}"
         class="block px-4 py-2 rounded hover:bg-gray-700">
        🌐 Back to Site
      </a>
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="px-4 pb-6">
      @csrf
      <button class="w-full bg-red-600 hover:bg-red-700 py-2 rounded-lg text-white font-medium">
        Logout
      </button>
    </form>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
      <h1 class="text-xl font-semibold">@yield('title')</h1>
      <span class="text-gray-600 text-sm">
        Logged in as <strong>
            {{ Auth::user()->name }}
        </strong>
      </span>
    </header>

    <!-- Page Content -->
    <main class="flex-1 p-6">
      @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-4 text-gray-500 text-sm border-t bg-white">
      © {{ date('Y') }} MyWebsite Admin. All rights reserved.
    </footer>
  </div>

</body>
</html>
