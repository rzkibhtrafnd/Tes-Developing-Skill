<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Sales') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('sales.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="kode_sales" class="block text-sm font-medium text-gray-700">Kode Sales <span class="text-red-500">*</span></label>
                    <input type="text" name="kode_sales" id="kode_sales"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        value="{{ old('kode_sales') }}" required placeholder="Contoh: E1">
                    @error('kode_sales')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="nama_sales" class="block text-sm font-medium text-gray-700">Nama Sales <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_sales" id="nama_sales"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        value="{{ old('nama_sales') }}" required placeholder="Nama Sales">
                    @error('nama_sales')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end border-t pt-4">
                    <a href="{{ route('sales.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md mr-2 hover:bg-gray-300 transition">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
