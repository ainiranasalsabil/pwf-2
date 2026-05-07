<x-app-layout> {{-- Layout utama Laravel (navbar, header otomatis) --}}

    {{-- HEADER HALAMAN --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-black">
            Edit Category {{-- Judul halaman --}}
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="py-10"> {{-- jarak atas bawah --}}
        <div class="max-w-3xl mx-auto"> {{-- posisi tengah + lebar dibatasi --}}

            {{-- CARD --}}
            <div class="bg-white text-black p-6 rounded-2xl shadow-xl">
            {{-- background putih biar jelas --}}
            {{-- text hitam biar kontras --}}

                {{-- FORM --}}
                <form action="{{ route('kategoris.update', $kategori->id) }}" method="POST">
                {{-- mengarah ke controller update() --}}

                    @csrf {{-- token keamanan Laravel --}}
                    @method('PUT') {{-- method update karena HTML tidak support PUT --}}

                    {{-- ================= INPUT ================= --}}
                    <div class="mb-6">

                        {{-- LABEL --}}
                        <label class="block mb-2 text-sm text-gray-700">
                            Category
                        </label>

                        {{-- INPUT TEXT --}}
                        <input type="text" name="name"
                               value="{{ old('name', $kategori->name) }}"
                               {{-- old() → supaya input tidak hilang saat error --}}
                               {{-- $kategori->name → menampilkan data lama --}}

                               class="w-full p-3 rounded-lg bg-white border border-gray-300 text-black
                                      focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: Electronic">

                        {{-- ERROR --}}
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                        {{-- menampilkan error validasi --}}
                    </div>

                    {{-- ================= BUTTON ================= --}}
                    <div class="flex justify-end gap-3">

                        {{-- CANCEL --}}
                        <a href="{{ route('kategoris.index') }}"
                           class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm">
                            Cancel
                        </a>
                        {{-- kembali tanpa menyimpan perubahan --}}

                        {{-- UPDATE --}}
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold">
                            Update Category
                        </button>
                        {{-- submit form ke controller --}}

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>