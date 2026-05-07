<x-app-layout> {{-- Layout utama Laravel (navbar, header, dll otomatis) --}}

    {{-- HEADER HALAMAN --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-black">
            Add Category {{-- Judul halaman --}}
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="py-10"> {{-- jarak atas bawah --}}
        <div class="max-w-3xl mx-auto"> {{-- posisi tengah + lebar dibatasi --}}

            {{-- CARD --}}
            <div class="bg-white text-black p-6 rounded-2xl shadow-xl">
            {{-- background putih biar jelas --}}
            {{-- text hitam biar kontras tinggi --}}

                {{-- FORM --}}
                <form action="{{ route('kategoris.store') }}" method="POST">
                {{-- mengarah ke controller store() --}}

                    @csrf {{-- token keamanan Laravel (WAJIB) --}}

                    {{-- ================= INPUT ================= --}}
                    <div class="mb-6">

                        {{-- LABEL --}}
                        <label class="block mb-2 text-sm text-gray-700">
                            Category
                        </label>

                        {{-- INPUT TEXT --}}
                        <input type="text" name="name"
                               value="{{ old('name') }}"
                               {{-- old() → supaya input tidak hilang saat error --}}

                               class="w-full p-3 rounded-lg bg-white border border-gray-300 text-black
                                      focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: Electronic">

                        {{-- ERROR VALIDASI --}}
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                        {{-- menampilkan error jika input salah --}}
                    </div>

                    {{-- ================= BUTTON ================= --}}
                    <div class="flex justify-end gap-3">

                        {{-- CANCEL --}}
                        <a href="{{ route('kategoris.index') }}"
                           class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm">
                            Cancel
                        </a>
                        {{-- kembali tanpa menyimpan data --}}

                        {{-- SAVE --}}
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold">
                            Save Category
                        </button>
                        {{-- submit form → menjalankan store() di controller --}}

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>