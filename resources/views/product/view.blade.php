<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- OUTER CARD -->
            <div class="bg-white shadow-xl rounded-2xl p-8">

                <!-- HEADER -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-4">

                        <a href="{{ route('product.index') }}"
                           class="text-gray-400 hover:text-gray-700 text-xl">
                            ←
                        </a>

                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">
                                Product Detail
                            </h2>
                            <p class="text-sm text-gray-400">
                                Viewing product #{{ $product->id }}
                            </p>
                        </div>
                    </div>

                    <!-- ACTION BUTTON -->
                    <div class="flex items-center gap-2">
                        <x-edit-button :url="route('product.edit', $product->id)" />
                        <x-delete-button :url="route('product.destroy', $product->id)" />
                    </div>
                </div>

                <!-- INNER BOX -->
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-2">

                    <div class="bg-white rounded-lg divide-y">

                        <!-- ROW -->
                        <div class="grid grid-cols-[160px_1fr] px-6 py-4 hover:bg-gray-50 transition">
                            <span class="text-gray-500">Product Name</span>
                            <span class="font-semibold text-gray-800">
                                {{ $product->name }}
                            </span>
                        </div>

                        <!-- ROW -->
                        <div class="grid grid-cols-[160px_1fr] px-6 py-4 hover:bg-gray-50 transition">
                            <span class="text-gray-500">Quantity</span>
                            <span>
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                    {{ $product->quantity }} In Stock
                                </span>
                            </span>
                        </div>

                        <!-- ROW -->
                        <div class="grid grid-cols-[160px_1fr] px-6 py-4 hover:bg-gray-50 transition">
                            <span class="text-gray-500">Price</span>
                            <span class="font-semibold text-gray-800">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- ROW -->
                        <div class="grid grid-cols-[160px_1fr] px-6 py-4 hover:bg-gray-50 transition items-center">
                            <span class="text-gray-500">Owner</span>

                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 flex items-center justify-center rounded-full bg-indigo-500 text-white text-sm font-bold">
                                    {{ strtoupper(substr($product->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <span class="text-gray-800">
                                    {{ $product->user->name ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <!-- ROW -->
                        <div class="grid grid-cols-[160px_1fr] px-6 py-4 hover:bg-gray-50 transition">
                            <span class="text-gray-500">Created At</span>
                            <span class="text-gray-600">
                                {{ $product->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>

                        <!-- ROW -->
                        <div class="grid grid-cols-[160px_1fr] px-6 py-4 hover:bg-gray-50 transition">
                            <span class="text-gray-500">Updated At</span>
                            <span class="text-gray-600">
                                {{ $product->updated_at->format('d M Y, H:i') }}
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>