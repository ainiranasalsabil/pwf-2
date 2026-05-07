<x-app-layout>
    
    {{-- HEADER --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- CARD --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- INFO LOGIN --}}
                <p class="text-gray-900 dark:text-gray-100 text-lg">
                    You're logged in!
                </p>

                {{-- ================= NAMA USER ================= --}}
                <p class="mt-4 text-gray-700 dark:text-gray-300">
                    Nama:
                    
                    <span class="font-semibold text-black dark:text-white">
                        {{ auth()->user()->name }}
                    </span>
                </p>

                {{-- ================= ROLE USER ================= --}}
                <p class="mt-2 text-gray-700 dark:text-gray-300">
                    Role:

                    @if(auth()->user()->role == 'admin')

                        <span class="bg-blue-200 text-black px-3 py-1 rounded text-xs font-semibold border border-blue-500">
                            ADMIN
                        </span>

                    @else

                        <span class="bg-gray-200 text-black px-3 py-1 rounded text-xs font-semibold border border-gray-500">
                            USER
                        </span>

                    @endif
                </p>

            </div>

        </div>
    </div>

</x-app-layout>