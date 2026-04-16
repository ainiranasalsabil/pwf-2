<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-md rounded-xl p-6">

                <div class="flex items-center gap-3 mb-6">
                    <a href="{{ route('product.index') }}"
                       class="text-gray-400 hover:text-gray-600">
                        ←
                    </a>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Add Product
                        </h2>
                        <p class="text-sm text-gray-400">
                            Fill in product details
                        </p>
                    </div>
                </div>

                {{-- 🔴 ERROR GLOBAL --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 rounded-lg">
                        <ul class="text-red-600 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('product.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    {{-- NAME --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full border rounded-lg px-4 py-2 mt-1">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        {{-- QUANTITY --}}
                        <div>
                            <label class="text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="quantity" value="{{ old('quantity') }}"
                                   class="w-full border rounded-lg px-4 py-2 mt-1">

                            @error('quantity')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- PRICE --}}
                        <div>
                            <label class="text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" value="{{ old('price') }}"
                                   class="w-full border rounded-lg px-4 py-2 mt-1">

                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('product.index') }}"
                           class="px-4 py-2 border rounded-lg text-sm">
                            Cancel
                        </a>

                        <button type="submit"
                        style="background-color:#2563eb; color:white; padding:8px 16px; border-radius:8px;">
                        Save Product
                    </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>