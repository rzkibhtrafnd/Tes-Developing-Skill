<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Area Toko') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('area.update', $data->kode_toko) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="kode_toko" class="block text-sm font-medium text-gray-700">Kode Toko</label>
                    <select name="kode_toko" id="kode_toko" disabled
                        class="mt-1 block w-full border-gray-300 bg-gray-100 text-gray-500 rounded-md shadow-sm cursor-not-allowed">
                        @foreach($tokoOptions as $toko)
                            <option value="{{ $toko->kode_toko_baru }}" {{ $data->kode_toko == $toko->kode_toko_baru ? 'selected' : '' }}>
                                Kode Toko Baru: {{ $toko->kode_toko_baru }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="kode_toko" value="{{ $data->kode_toko }}">
                    <p class="text-xs text-gray-500 mt-1">Kode toko tidak dapat dialihkan dari halaman edit.</p>
                </div>

                <div class="mb-6">
                    <label for="area_sales" class="block text-sm font-medium text-gray-700">Area Sales <span class="text-red-500">*</span></label>
                    <select name="area_sales" id="area_sales" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="A" {{ old('area_sales', $data->area_sales) == 'A' || old('area_sales', $data->area_sales) == 'a' ? 'selected' : '' }}>Area A</option>
                        <option value="B" {{ old('area_sales', $data->area_sales) == 'B' || old('area_sales', $data->area_sales) == 'b' ? 'selected' : '' }}>Area B</option>
                    </select>
                    @error('area_sales')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end border-t pt-4">
                    <a href="{{ route('area.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md mr-2 hover:bg-gray-300 transition">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>