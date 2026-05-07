<x-app-layout> {{-- Layout utama Laravel (navbar, dll) --}}

    {{-- HEADER HALAMAN --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-black">
            Category {{-- Judul halaman --}}
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="py-10"> {{-- jarak atas bawah --}}
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8"> {{-- lebar + responsive --}}

            {{-- CARD --}}
            <div class="bg-white text-black shadow-xl rounded-2xl p-6">

                {{-- HEADER CARD --}}
                <div class="flex items-center justify-between mb-6">

                    {{-- JUDUL --}}
                    <div>
                        <h1 class="text-xl font-semibold">
                            Category List
                        </h1>

                        <p class="text-sm text-gray-600">
                            Manage your category
                        </p>
                    </div>

                    {{-- BUTTON TAMBAH (HANYA ADMIN) --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('kategoris.create') }}"
                           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold">
                            + Add Category
                        </a>
                    @endif

                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto border border-gray-300 rounded-xl">

                    <table class="w-full text-sm text-left">

                        {{-- HEADER --}}
                        <thead class="bg-gray-100 border-b border-gray-400">
                            <tr class="text-black">
                                <th class="py-3 px-4 border-r">No</th>
                                <th class="py-3 px-4 border-r">Name</th>
                                <th class="py-3 px-4 border-r">Total Product</th>
                                <th class="py-3 px-4 text-center">Action</th>
                            </tr>
                        </thead>

                        {{-- BODY --}}
                        <tbody>

                            @forelse($kategoris as $index => $kategori)

                                <tr class="border-b hover:bg-gray-50">

                                    {{-- NOMOR --}}
                                    <td class="py-3 px-4 border-r">
                                        {{ $index + 1 }}
                                    </td>

                                    {{-- NAMA --}}
                                    <td class="py-3 px-4 border-r">
                                        {{ $kategori->name }}
                                    </td>

                                    {{-- TOTAL --}}
                                    <td class="py-3 px-4 border-r">
                                        {{ $kategori->products_count }}
                                    </td>

                                    {{-- ACTION --}}
                                    <td class="py-3 px-4">
                                        <div class="flex justify-center gap-3">

                                            @if(auth()->user()->role === 'admin')

                                                {{-- EDIT --}}
                                                <a href="{{ route('kategoris.edit', $kategori->id) }}"
                                                   class="text-blue-600 hover:text-blue-800">
                                                    ✏️
                                                </a>

                                                {{-- DELETE (FIX) --}}
                                                <a href="{{ route('kategoris.show', $kategori->id) }}"
                                                   class="text-red-600 hover:text-red-800">
                                                    🗑️
                                                </a>
                                                {{-- FIX PENJELASAN:
                                                     - tidak pakai form lagi
                                                     - tidak pakai confirm()
                                                     - diarahkan ke halaman delete.blade
                                                     - di sana baru ada tombol hapus --}}

                                            @else
                                                <span class="text-gray-400 text-sm">
                                                    View Only
                                                </span>
                                            @endif

                                        </div>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-gray-500">
                                        Data kategori kosong
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>