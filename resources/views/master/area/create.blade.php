<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Area Toko') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('area.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="kode_toko" class="block text-sm font-medium text-gray-700">Pilih Toko <span class="text-red-500">*</span></label>
                    <select name="kode_toko" id="kode_toko" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="" disabled selected>-- Pilih Toko Baru --</option>
                        @foreach($tokoOptions as $toko)
                            <option value="{{ $toko->kode_toko_baru }}" {{ old('kode_toko') == $toko->kode_toko_baru ? 'selected' : '' }}>
                                Kode Toko Baru: {{ $toko->kode_toko_baru }} 
                                @if($toko->kode_toko_lama) (Kode Lama: {{ $toko->kode_toko_lama }}) @endif
                            </option>
                        @endforeach
                    </select>
                    @error('kode_toko')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="area_sales" class="block text-sm font-medium text-gray-700">Area Sales <span class="text-red-500">*</span></label>
                    <select name="area_sales" id="area_sales" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="" disabled selected>-- Pilih Wilayah Area --</option>
                        <option value="A" {{ old('area_sales') == 'A' ? 'selected' : '' }}>Area A</option>
                        <option value="B" {{ old('area_sales') == 'B' ? 'selected' : '' }}>Area B</option>
                    </select>
                    @error('area_sales')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end border-t pt-4">
                    <a href="{{ route('area.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md mr-2 hover:bg-gray-300 transition">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>