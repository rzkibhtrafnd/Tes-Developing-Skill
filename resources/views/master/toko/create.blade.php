<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Toko') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('toko.store') }}" method="POST">
                @csrf
                
                {{-- Input Kode Toko Baru --}}
                <div class="mb-4">
                    <label for="kode_toko_baru" class="block text-sm font-medium text-gray-700">Kode Toko Baru <span class="text-red-500">*</span></label>
                    <input type="number" name="kode_toko_baru" id="kode_toko_baru"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        value="{{ old('kode_toko_baru') }}" required placeholder="Contoh: 6">
                    @error('kode_toko_baru')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input Kode Toko Lama --}}
                <div class="mb-6">
                    <label for="kode_toko_lama" class="block text-sm font-medium text-gray-700">Kode Toko Lama <span class="text-gray-400 font-normal">(Opsional)</span></label>
                    <input type="number" name="kode_toko_lama" id="kode_toko_lama"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        value="{{ old('kode_toko_lama') }}" placeholder="Kosongkan jika tidak ada">
                    @error('kode_toko_lama')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-end border-t pt-4">
                    <a href="{{ route('toko.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md mr-2 hover:bg-gray-300 transition">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>