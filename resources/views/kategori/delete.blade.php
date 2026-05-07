<x-app-layout> {{-- Layout utama Laravel (navbar, header, dll) --}}

    {{-- HEADER HALAMAN --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-black">
            Delete Category {{-- Judul halaman --}}
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="py-10"> {{-- jarak atas bawah --}}
        <div class="max-w-3xl mx-auto"> {{-- posisi tengah + lebar dibatasi --}}

            {{-- CARD --}}
            <div class="bg-white text-black p-6 rounded-2xl shadow-xl">
            {{-- background putih biar jelas --}}
            {{-- text hitam biar kontras --}}

                {{-- ================= WARNING ================= --}}
                <div class="mb-6">

                    {{-- JUDUL WARNING --}}
                    <h1 class="text-lg font-semibold text-red-600 flex items-center gap-2">
                        ⚠️ Are you sure?
                        {{-- warna merah = tanda bahaya --}}
                    </h1>

                    {{-- DESKRIPSI --}}
                    <p class="text-gray-700 mt-2">
                        Kamu akan menghapus category:

                        <span class="font-semibold text-black">
                            {{ $kategori->name }}
                        </span>
                        {{-- menampilkan nama kategori --}}
                    </p>

                    {{-- BOX WARNING --}}
                    <div class="mt-4 bg-red-100 border border-red-300 text-red-700 p-3 rounded-lg text-sm">
                        Data yang dihapus tidak bisa dikembalikan.
                        {{-- warning tambahan --}}
                    </div>

                </div>

                {{-- ================= FORM ================= --}}
                <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST">
                {{-- mengarah ke controller destroy() --}}

                    @csrf {{-- keamanan Laravel --}}
                    @method('DELETE') {{-- method delete --}}

                    {{-- BUTTON --}}
                    <div class="flex justify-end gap-3">

                        {{-- CANCEL --}}
                        <a href="{{ route('kategoris.index') }}"
                           class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm">
                            Cancel
                        </a>
                        {{-- kembali tanpa hapus --}}

                        {{-- DELETE --}}
                        <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus kategori ini? Data tidak bisa dikembalikan!')"
                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-semibold">
                            Delete
                        </button>
                        {{-- onclick confirm:
                             - muncul popup konfirmasi
                             - jika klik OK → lanjut hapus
                             - jika klik Cancel → batal --}}
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>