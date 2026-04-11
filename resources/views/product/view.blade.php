<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-md rounded-xl p-6">

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('product.index') }}"
                           class="text-gray-400 hover:text-gray-600">
                            ←
                        </a>

                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">
                                Product Detail
                            </h2>
                            <p class="text-sm text-gray-400">
                                Product #{{ $product->id }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-2">

                        @can('update', $product)
                        <a href="{{ route('product.edit', $product) }}"
                           class="px-3 py-2 text-sm border rounded-lg text-yellow-600">
                            Edit
                        </a>
                        @endcan

                        @can('delete', $product)
                        <form action="{{ route('product.delete', $product->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-2 text-sm border rounded-lg text-red-600">
                                Delete
                            </button>
                        </form>
                        @endcan

                    </div>
                </div>

                <div class="border rounded-lg divide-y">

                    <div class="flex px-5 py-4">
                        <div class="w-32 text-sm text-gray-500">Name</div>
                        <div class="text-sm font-semibold">{{ $product->name }}</div>
                    </div>

                    <div class="flex px-5 py-4">
                        <div class="w-32 text-sm text-gray-500">Quantity</div>
                        <div>
                            <span class="px-2 py-1 text-xs rounded-full
                                {{ $product->quantity > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $product->quantity }}
                            </span>
                        </div>
                    </div>

                    <div class="flex px-5 py-4">
                        <div class="w-32 text-sm text-gray-500">Price</div>
                        <div>Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    </div>

                    <div class="flex px-5 py-4">
                        <div class="w-32 text-sm text-gray-500">Owner</div>
                        <div>{{ $product->user->name ?? '-' }}</div>
                    </div>

                    <div class="flex px-5 py-4">
                        <div class="w-32 text-sm text-gray-500">Created</div>
                        <div>{{ $product->created_at->format('d M Y H:i') }}</div>
                    </div>

                    <div class="flex px-5 py-4">
                        <div class="w-32 text-sm text-gray-500">Updated</div>
                        <div>{{ $product->updated_at->format('d M Y H:i') }}</div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>