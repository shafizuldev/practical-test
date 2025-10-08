@extends('layouts.admin')

@section('title', 'Privacy Consents')

@section('content')
<div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
  <div class="bg-white shadow-md rounded-2xl p-6 sm:p-8 max-w-7xl mx-auto">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
      <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 flex items-center gap-2">
        🧾 <span>Privacy Consent Records</span>
      </h2>
      <span class="text-sm text-gray-500">
        Total Records: <strong>{{ $consents->total() }}</strong>
      </span>
    </div>

    <!-- Responsive Table Container -->
    <div class="flex flex-col h-[70vh] sm:h-[80vh] border border-gray-200 rounded-lg shadow-sm overflow-hidden bg-white">
      <!-- Scrollable area -->
      <div class="flex-1 overflow-auto">
        <table class="w-full h-full text-sm text-gray-700 border-collapse">
          <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold tracking-wide sticky top-0">
            <tr>
              <th class="py-3 px-4 text-center whitespace-nowrap">GUID</th>
              <th class="py-3 px-4 text-center whitespace-nowrap">Accepted At</th>
              <th class="py-3 px-4 text-center whitespace-nowrap">Version</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @forelse($consents as $consent)
            <tr class="hover:bg-gray-50 transition-colors text-center">
              <td class="py-3 px-4 font-mono text-xs text-gray-800 break-all">
                {{ $consent->guid }}
              </td>
              <td class="py-3 px-4 whitespace-nowrap">
                {{ $consent->accepted_at }}
              </td>
              <td class="py-3 px-4 whitespace-nowrap">
                {{ $consent->version }}
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="3" class="py-8 text-center text-gray-500">
                No consent records found.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
      {{ $consents->links('pagination::tailwind') }}
    </div>
  </div>
</div>
@endsection
