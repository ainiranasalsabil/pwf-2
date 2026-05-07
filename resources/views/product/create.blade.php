<x-app-layout> {{-- Menggunakan layout utama Laravel (sudah include navbar & header) --}}

    <div class="py-10"> {{-- Memberi jarak atas & bawah --}}
        <div class="max-w-3xl mx-auto"> {{-- Membatasi lebar dan posisi di tengah --}}

            {{-- CARD / BOX UTAMA --}}
            <div class="bg-white text-black p-6 rounded-2xl shadow-xl">
            {{-- bg-white = background putih --}}
            {{-- text-black = warna teks hitam --}}
            {{-- p-6 = padding dalam --}}
            {{-- rounded-2xl = sudut melengkung --}}
            {{-- shadow-xl = efek bayangan --}}

                {{-- ================= HEADER ================= --}}
                <div class="flex items-center gap-3 mb-6">
                {{-- flex = susun horizontal --}}
                {{-- items-center = rata tengah vertikal --}}
                {{-- gap-3 = jarak antar elemen --}}
                {{-- mb-6 = margin bawah --}}

                    {{-- TOMBOL KEMBALI --}}
                    <a href="{{ route('product.index') }}"
                       class="text-gray-500 hover:text-black text-lg">
                        ←
                    </a>
                    {{-- route('product.index') = menuju halaman list product --}}
                    {{-- hover:text-black = berubah warna saat disentuh --}}

                    {{-- JUDUL --}}
                    <div>
                        <h2 class="text-xl font-semibold">
                            Add Product
                        </h2>
                        {{-- Judul halaman --}}

                        <p class="text-sm text-gray-600">
                            Fill in product details
                        </p>
                        {{-- Deskripsi kecil di bawah judul --}}
                    </div>

                </div>

                {{-- ================= ERROR GLOBAL ================= --}}
                @if ($errors->any()) {{-- Cek apakah ada error validasi --}}
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 rounded-lg">
                        {{-- Box untuk menampilkan error --}}
                        <ul class="text-red-600 text-sm space-y-1">
                            @foreach ($errors->all() as $error) {{-- Loop semua error --}}
                                <li>• {{ $error }}</li>
                                {{-- Menampilkan pesan error --}}
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- ================= FORM ================= --}}
                <form action="{{ route('product.store') }}" method="POST" class="space-y-5">
                {{-- action = arah ke controller store --}}
                {{-- method POST = kirim data --}}
                {{-- space-y-5 = jarak antar field --}}

                    @csrf {{-- Token keamanan Laravel (WAJIB ADA) --}}

                    {{-- ================= INPUT NAME ================= --}}
                    <div>
                        <label class="text-sm text-gray-700">
                            Product Name
                        </label>
                        {{-- Label untuk input nama --}}

                        <input type="text"
                               name="name" {{-- Nama field harus sama dengan database --}}
                               value="{{ old('name') }}" {{-- Menyimpan input lama jika error --}}
                               required {{-- Field wajib diisi --}}
                               class="w-full mt-1 p-3 rounded-lg border border-gray-300
                                      focus:outline-none focus:ring-2 focus:ring-blue-500">
                        {{-- w-full = lebar penuh --}}
                        {{-- focus:ring = efek saat klik input --}}

                        @error('name') {{-- Menampilkan error khusus name --}}
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ================= CATEGORY ================= --}}
                    <div>
                        <label class="text-sm text-gray-700">
                            Category
                        </label>

                        <select name="kategori_id"
                                required {{-- Wajib pilih kategori --}}
                                class="w-full mt-1 p-3 rounded-lg border border-gray-300
                                       focus:ring-2 focus:ring-blue-500">

                            <option value="">-- Pilih Category --</option>
                            {{-- Option default --}}

                            @foreach($kategoris as $kategori) {{-- Loop data kategori --}}
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->name }}
                                </option>
                                {{-- selected = otomatis terpilih jika sebelumnya dipilih --}}
                            @endforeach

                        </select>

                        @error('kategori_id') {{-- Error kategori --}}
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ================= GRID (QTY & PRICE) ================= --}}
                    <div class="grid grid-cols-2 gap-4">
                    {{-- grid-cols-2 = 2 kolom --}}
                    {{-- gap-4 = jarak antar kolom --}}

                        {{-- ================= QTY ================= --}}
                        <div>
                            <label class="text-sm text-gray-700">
                                Quantity
                            </label>

                            <input type="number"
                                   name="qty" {{-- HARUS sama dengan database --}}
                                   value="{{ old('qty') }}"
                                   required
                                   min="1" {{-- tidak boleh 0 atau negatif --}}
                                   class="w-full mt-1 p-3 rounded-lg border border-gray-300
                                          focus:ring-2 focus:ring-blue-500">

                            @error('qty')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ================= PRICE ================= --}}
                        <div>
                            <label class="text-sm text-gray-700">
                                Price
                            </label>

                            <input type="number"
                                   name="price"
                                   value="{{ old('price') }}"
                                   required
                                   min="0"
                                   class="w-full mt-1 p-3 rounded-lg border border-gray-300
                                          focus:ring-2 focus:ring-blue-500">

                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- ================= BUTTON ================= --}}
                    <div class="flex justify-end gap-3 pt-4">
                    {{-- justify-end = tombol ke kanan --}}
                    {{-- gap-3 = jarak antar tombol --}}

                        {{-- CANCEL --}}
                        <a href="{{ route('product.index') }}"
   class="px-4 py-2 bg-blue-200 hover:bg-blue-300 text-black rounded-lg text-sm font-semibold border border-blue-400 shadow transition">

    Cancel

</a>
                        {{-- kembali tanpa menyimpan --}}

                        {{-- SAVE --}}
<button type="submit"
        class="px-4 py-2 bg-blue-200 hover:bg-blue-300 text-black rounded-lg text-sm font-semibold border border-blue-400 shadow transition">

    Save Product

</button>
                        {{-- submit form ke controller store --}}
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>