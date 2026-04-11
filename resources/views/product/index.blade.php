<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-xl p-6">

                <!-- HEADER -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-black">
                            Product List
                        </h2>
                        <p class="text-sm text-gray-500">
                            Manage your product inventory
                        </p>
                    </div>

                    @can('manage-product')
                    <a href="{{ route('product.create') }}"
                       class="flex items-center gap-2 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow-md transition"
                       style="background-color:#2563eb;">
                        ➕ Add Product
                    </a>
                    @endcan
                </div>

                <!-- TABLE -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                    <table class="w-full text-sm">

                        <!-- HEAD -->
                        <thead class="bg-gray-200 text-gray-700 uppercase text-xs tracking-wide">
                            <tr>
                                <th class="px-6 py-4 text-left">#</th>
                                <th class="px-6 py-4 text-left">Name</th>
                                <th class="px-6 py-4 text-left">Quantity</th>
                                <th class="px-6 py-4 text-left">Price</th>
                                <th class="px-6 py-4 text-left">Owner</th>
                                <th class="px-6 py-4 text-left">Actions</th>
                            </tr>
                        </thead>

                        <!-- BODY -->
                        <tbody class="divide-y">

                            @forelse($products as $product)
                            <tr class="hover:bg-gray-50 transition">

                                <!-- NUMBER -->
                                <td class="px-6 py-4 text-black">
                                    {{ $loop->iteration }}
                                </td>

                                <!-- NAME -->
                                <td class="px-6 py-4 font-semibold text-black">
                                    {{ $product->name }}
                                </td>

                                <!-- QUANTITY -->
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        {{ $product->quantity < 10 
                                            ? 'bg-red-100 text-black' 
                                            : 'bg-green-100 text-black' }}">
                                        {{ $product->quantity }}
                                    </span>
                                </td>

                                <!-- PRICE -->
                                <td class="px-6 py-4 text-black">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <!-- OWNER -->
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $product->user->name ?? '-' }}
                                </td>

                                <!-- ACTION -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4 text-sm">

                                        <!-- VIEW -->
                                        <a href="{{ route('product.show', $product->id) }}"
                                           class="text-gray-500 hover:text-black transition">
                                            👁
                                        </a>

                                        <!-- EDIT -->
                                        @can('update', $product)
                                        <a href="{{ route('product.edit', $product) }}"
                                           class="text-yellow-500 hover:text-yellow-600 transition">
                                            ✏️
                                        </a>
                                        @endcan

                                        <!-- DELETE -->
                                        @can('delete', $product)
                                        <form action="{{ route('product.delete', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin hapus data?')"
                                                class="text-red-500 hover:text-red-600 transition">
                                                🗑
                                            </button>
                                        </form>
                                        @endcan

                                    </div>
                                </td>

                            </tr>

                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-400">
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