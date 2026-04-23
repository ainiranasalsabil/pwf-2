<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-2xl p-6">

                <!-- HEADER -->
                <div class="flex items-center gap-3 mb-6">
                    <a href="{{ route('product.show', $product->id) }}"
                       class="text-gray-400 hover:text-gray-600">
                        ←
                    </a>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Edit Product
                        </h2>
                        <p class="text-sm text-gray-400">
                            Update {{ $product->name }}
                        </p>
                    </div>
                </div>

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 rounded-lg">
                        <ul class="text-red-600 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM UPDATE --}}
                <form action="{{ route('product.update', $product->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <!-- NAME -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="name"
                               value="{{ old('name', $product->name) }}"
                               class="w-full border rounded-lg px-4 py-2 mt-1 focus:ring-2 focus:ring-blue-400">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        <!-- QUANTITY -->
                        <div>
                            <label class="text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="quantity"
                                   value="{{ old('quantity', $product->quantity) }}"
                                   class="w-full border rounded-lg px-4 py-2 mt-1 focus:ring-2 focus:ring-blue-400">

                            @error('quantity')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- PRICE -->
                        <div>
                            <label class="text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price"
                                   value="{{ old('price', $product->price) }}"
                                   class="w-full border rounded-lg px-4 py-2 mt-1 focus:ring-2 focus:ring-blue-400">

                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- ACTION -->
                    <div class="flex justify-end gap-2 pt-4">

                        <a href="{{ route('product.show', $product->id) }}"
                           class="px-4 py-2 border rounded-lg text-sm hover:bg-gray-100">
                            Cancel
                        </a>

                        <button type="submit"
                        style="background-color:#2563eb; color:white; padding:8px 16px; border-radius:8px; font-weight:600;">
                         Update
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>