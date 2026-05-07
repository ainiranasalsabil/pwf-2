<x-app-layout>

    {{-- CONTAINER --}}
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- ================= CARD ================= --}}
            <div class="bg-white shadow-2xl rounded-3xl border border-gray-200 overflow-hidden">

                {{-- ================= HEADER ================= --}}
                <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-white">

                    <div class="flex items-center justify-between">

                        {{-- LEFT --}}
                        <div class="flex items-center gap-4">

                            {{-- BACK BUTTON --}}
                            <a href="{{ route('product.index') }}"
                               class="w-11 h-11 flex items-center justify-center rounded-full bg-white border border-gray-300 shadow hover:bg-blue-100 transition">

                                <span class="text-xl text-black">
                                    ←
                                </span>

                            </a>

                            {{-- TITLE --}}
                            <div>

                                <h2 class="text-3xl font-bold text-gray-800">
                                    Product Detail
                                </h2>

                                <p class="text-sm text-gray-500 mt-1">
                                    Viewing Product #{{ $product->id }}
                                </p>

                            </div>

                        </div>

                        {{-- RIGHT ACTION --}}
                        @if(auth()->user()->role === 'admin')

                        <div class="flex items-center gap-3">

                            {{-- EDIT --}}
                            <a href="{{ route('product.edit', $product->id) }}"
                               class="flex items-center gap-2 px-5 py-3 bg-blue-200 hover:bg-blue-300 text-black rounded-xl font-semibold shadow border border-blue-400 transition">

                                ✏️
                                <span>Edit</span>

                            </a>

                            {{-- DELETE --}}
                            <form action="{{ route('product.destroy', $product->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus product ini?')"
                                    class="flex items-center gap-2 px-5 py-3 bg-red-200 hover:bg-red-300 text-black rounded-xl font-semibold shadow border border-red-400 transition">

                                    🗑️
                                    <span>Delete</span>

                                </button>

                            </form>

                        </div>

                        @endif

                    </div>

                </div>

                {{-- ================= CONTENT ================= --}}
                <div class="p-8 bg-gray-50">

                    <div class="space-y-5">

                        {{-- PRODUCT NAME --}}
                        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">

                            <p class="text-sm text-gray-500 mb-1">
                                Product Name
                            </p>

                            <h3 class="text-2xl font-bold text-black">
                                {{ $product->name }}
                            </h3>

                        </div>

                        {{-- CATEGORY --}}
                        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">

                            <p class="text-sm text-gray-500 mb-1">
                                Category
                            </p>

                            <span class="inline-block px-4 py-2 bg-blue-100 text-black rounded-xl border border-blue-300 font-semibold">

                                {{ $product->kategori->name ?? '-' }}

                            </span>

                        </div>

                        {{-- QUANTITY --}}
                        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">

                            <p class="text-sm text-gray-500 mb-2">
                                Quantity
                            </p>

                            @if($product->qty < 10)

                                <span class="inline-flex items-center gap-2 px-5 py-3 bg-red-100 text-red-700 border border-red-300 rounded-2xl font-bold text-lg">

                                    ⚠️ {{ $product->qty }} In Stock

                                </span>

                            @else

                                <span class="inline-flex items-center gap-2 px-5 py-3 bg-blue-100 text-blue-700 border border-blue-300 rounded-2xl font-bold text-lg">

                                    📦 {{ $product->qty }} In Stock

                                </span>

                            @endif

                        </div>

                        {{-- PRICE --}}
                        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">

                            <p class="text-sm text-gray-500 mb-1">
                                Price
                            </p>

                            <h3 class="text-3xl font-bold text-black">

                                Rp {{ number_format($product->price, 0, ',', '.') }}

                            </h3>

                        </div>

                        {{-- OWNER --}}
                        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">

                            <p class="text-sm text-gray-500 mb-3">
                                Owner
                            </p>

                            <div class="flex items-center gap-4">

                                {{-- AVATAR --}}
                                <div class="w-12 h-12 rounded-full bg-blue-200 border border-blue-400 flex items-center justify-center text-black font-bold text-lg shadow">

                                    {{ strtoupper(substr($product->user->name ?? 'U', 0, 1)) }}

                                </div>

                                {{-- NAME --}}
                                <div>

                                    <h4 class="font-bold text-black text-lg">

                                        {{ $product->user->name ?? '-' }}

                                    </h4>

                                    <p class="text-sm text-gray-500">
                                        Product Owner
                                    </p>

                                </div>

                            </div>

                        </div>

                        {{-- CREATED & UPDATED --}}
                        <div class="grid md:grid-cols-2 gap-5">

                            {{-- CREATED --}}
                            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">

                                <p class="text-sm text-gray-500 mb-1">
                                    Created At
                                </p>

                                <p class="font-semibold text-black">
                                    {{ $product->created_at->format('d M Y, H:i') }}
                                </p>

                            </div>

                            {{-- UPDATED --}}
                            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">

                                <p class="text-sm text-gray-500 mb-1">
                                    Updated At
                                </p>

                                <p class="font-semibold text-black">
                                    {{ $product->updated_at->format('d M Y, H:i') }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>