<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Toko') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('toko.update', $data->kode_toko_baru) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="kode_toko_baru" class="block text-sm font-medium text-gray-700">Kode Toko Baru</label>
                    <input type="number" name="kode_toko_baru" id="kode_toko_baru"
                        class="mt-1 block w-full border-gray-300 bg-gray-100 text-gray-500 rounded-md shadow-sm cursor-not-allowed"
                        value="{{ old('kode_toko_baru', $data->kode_toko_baru) }}" readonly>
                    <p class="text-xs text-gray-500 mt-1">Kode toko baru (ID) tidak dapat diubah.</p>
                    @error('kode_toko_baru')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="kode_toko_lama" class="block text-sm font-medium text-gray-700">Kode Toko Lama <span class="text-gray-400 font-normal">(Opsional)</span></label>
                    <input type="number" name="kode_toko_lama" id="kode_toko_lama"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        value="{{ old('kode_toko_lama', $data->kode_toko_lama) }}" placeholder="Kosongkan jika tidak ada">
                    @error('kode_toko_lama')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end border-t pt-4">
                    <a href="{{ route('toko.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md mr-2 hover:bg-gray-300 transition">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>