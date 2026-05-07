<x-app-layout> {{-- Layout utama Laravel (navbar, header otomatis) --}}

    <div class="py-10"> {{-- jarak atas bawah --}}
        <div class="max-w-3xl mx-auto"> {{-- container tengah --}}

            {{-- CARD --}}
            <div class="bg-white text-black p-6 rounded-2xl shadow-xl">
            {{-- background putih biar jelas --}}
            {{-- text hitam biar kontras --}}

                {{-- ================= HEADER ================= --}}
                <div class="flex items-center gap-3 mb-6">

                    {{-- BACK BUTTON --}}
                    <a href="{{ route('product.show', $product->id) }}"
                       class="text-gray-500 hover:text-black text-lg">
                        ←
                    </a>
                    {{-- kembali ke halaman detail product --}}

                    <div>
                        <h2 class="text-xl font-semibold">
                            Edit Product
                        </h2>

                        <p class="text-sm text-gray-600">
                            Update {{ $product->name }}
                        </p>
                        {{-- menampilkan nama product --}}
                    </div>

                </div>

                {{-- ================= ERROR GLOBAL ================= --}}
                @if ($errors->any()) {{-- cek error --}}
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 rounded-lg">
                        <ul class="text-red-600 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- ================= FORM ================= --}}
                <form action="{{ route('product.update', $product->id) }}" method="POST" class="space-y-5">
                    @csrf {{-- keamanan --}}
                    @method('PUT') {{-- method update --}}

                    {{-- ================= NAME ================= --}}
                    <div>
                        <label class="text-sm text-gray-700">
                            Product Name
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $product->name) }}"
                               required {{-- wajib isi --}}
                               class="w-full mt-1 p-3 rounded-lg border border-gray-300
                                      focus:ring-2 focus:ring-blue-500">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ================= CATEGORY ================= --}}
                    <div>
                        <label class="text-sm text-gray-700">
                            Category
                        </label>

                        <select name="kategori_id"
                                required
                                class="w-full mt-1 p-3 rounded-lg border border-gray-300
                                       focus:ring-2 focus:ring-blue-500">

                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id', $product->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('kategori_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ================= GRID ================= --}}
                    <div class="grid grid-cols-2 gap-4">

                        {{-- ================= QTY ================= --}}
                        <div>
                            <label class="text-sm text-gray-700">
                                Quantity
                            </label>

                            <input type="number"
                                   name="qty"
                                   value="{{ old('qty', $product->qty) }}"
                                   required
                                   min="1"
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
                                   value="{{ old('price', $product->price) }}"
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

                        {{-- CANCEL --}}
                        <a href="{{ route('product.show', $product->id) }}"
   class="px-4 py-2 bg-blue-200 hover:bg-blue-300 text-black rounded-lg text-sm font-semibold border border-blue-400 shadow transition">

    Cancel

</a>

{{-- UPDATE --}}
<button type="submit"
        class="px-4 py-2 bg-blue-200 hover:bg-blue-300 text-black rounded-lg text-sm font-semibold border border-blue-400 shadow transition">

    Update Product

</button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>