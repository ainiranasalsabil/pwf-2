<x-app-layout> {{-- Layout utama Laravel (navbar, sidebar, dll) --}}

    <div class="py-10"> {{-- jarak atas bawah --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> {{-- container utama responsive --}}

            {{-- ================= CARD ================= --}}
            <div class="bg-white text-black rounded-2xl shadow-xl p-6">
            {{-- bg putih, bayangan, sudut membulat --}}

                {{-- ================= HEADER ================= --}}
                <div class="flex items-center justify-between mb-6">

                    {{-- JUDUL --}}
                    <div>
                        <h2 class="text-xl font-semibold">
                            Product List
                        </h2>

                        <p class="text-sm text-gray-600">
                            Manage your product inventory
                        </p>
                    </div>

                    {{-- BUTTON TAMBAH --}}
@if(auth()->user()->role === 'admin')

<a href="{{ route('product.create') }}"
   class="px-4 py-2 bg-blue-200 hover:bg-blue-300 text-black rounded-lg text-sm font-semibold border border-blue-400 shadow transition">

    + Add Product

</a>

@endif

                </div>

                {{-- ================= TABLE ================= --}}
<div class="overflow-x-auto rounded-xl border border-gray-300 shadow-sm">

    <table class="w-full text-sm text-left">

        {{-- ================= HEADER TABLE ================= --}}
        <thead class="bg-gray-200 text-gray-800 border-b-2 border-gray-400">

            <tr>

                <th class="px-5 py-4 border-r border-gray-300 font-semibold">
                    No
                </th>

                <th class="px-5 py-4 border-r border-gray-300 font-semibold">
                    Product
                </th>

                <th class="px-5 py-4 border-r border-gray-300 font-semibold">
                    Category
                </th>

                <th class="px-5 py-4 border-r border-gray-300 font-semibold">
                    Stock
                </th>

                <th class="px-5 py-4 border-r border-gray-300 font-semibold">
                    Price
                </th>

                <th class="px-5 py-4 border-r border-gray-300 font-semibold">
                    Owner
                </th>

                <th class="px-5 py-4 text-center font-semibold">
                    Action
                </th>

            </tr>

        </thead>

        {{-- ================= BODY ================= --}}
        <tbody class="bg-white text-gray-800">

            {{-- LOOP DATA --}}
            @forelse($products as $product)

            <tr class="border-b border-gray-200 hover:bg-gray-50 transition">

                {{-- NOMOR --}}
                <td class="px-5 py-4 border-r border-gray-200 font-medium text-gray-700">
                    {{ $loop->iteration }}
                </td>

                {{-- NAMA --}}
                <td class="px-5 py-4 border-r border-gray-200 font-semibold text-black">
                    {{ $product->name }}
                </td>

                {{-- KATEGORI --}}
                <td class="px-5 py-4 border-r border-gray-200 text-gray-700">
                    {{ optional($product->kategori)->name ?? '-' }}
                </td>

                {{-- STOCK --}}
                <td class="px-5 py-4 border-r border-gray-200">

                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $product->qty < 10
                            ? 'bg-red-100 text-red-700 border border-red-300'
                            : 'bg-blue-100 text-blue-700 border border-blue-300'
                        }}">

                        {{ $product->qty }}

                    </span>

                </td>

                {{-- PRICE --}}
                <td class="px-5 py-4 border-r border-gray-200 font-medium text-gray-800">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </td>

                {{-- OWNER --}}
                <td class="px-5 py-4 border-r border-gray-200 text-gray-700">
                    {{ optional($product->user)->name ?? '-' }}
                </td>

                {{-- ACTION --}}
                <td class="px-5 py-4">

                    <div class="flex justify-center gap-3">

                        {{-- VIEW --}}
                        <a href="{{ route('product.show', $product->id) }}"
                           class="text-blue-600 hover:text-blue-800 font-medium transition">

                            👁️

                        </a>

                        {{-- EDIT --}}
                        @can('update', $product)

                        <a href="{{ route('product.edit', $product->id) }}"
                           class="text-blue-600 hover:text-blue-800 font-medium transition">

                            ✏️

                        </a>

                        @endcan

                        {{-- DELETE --}}
                        @can('delete', $product)

                        <form action="{{ route('product.destroy', $product->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                class="text-red-600 hover:text-red-800 font-medium transition">

                                🗑️

                            </button>

                        </form>

                        @endcan

                    </div>

                </td>

            </tr>

            {{-- JIKA KOSONG --}}
            @empty

            <tr>

                <td colspan="7"
                    class="text-center py-8 text-gray-500">

                    No products found.

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