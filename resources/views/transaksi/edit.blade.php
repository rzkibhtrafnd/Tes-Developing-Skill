<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        @if($errors->any())
            <div class="p-3 mb-6 text-red-700 bg-red-100 border border-red-300 rounded-md">
                <strong class="block mb-1">Gagal memperbarui data:</strong>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('transaksi.update', $data->id ?? $data->kode_toko) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="kode_toko" class="block text-sm font-medium text-gray-700">Kode Toko <span class="text-red-500">*</span></label>
                    <select name="kode_toko" id="kode_toko" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        @foreach($tokoOptions as $toko)
                            <option value="{{ $toko->kode_toko_baru }}" {{ old('kode_toko', $data->kode_toko) == $toko->kode_toko_baru ? 'selected' : '' }}>
                                Toko Baru #{{ $toko->kode_toko_baru }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="nominal_transaksi" class="block text-sm font-medium text-gray-700">Nominal Transaksi (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="nominal_transaksi" id="nominal_transaksi" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        value="{{ old('nominal_transaksi', $data->nominal_transaksi) }}">
                </div>

                <div class="flex justify-end border-t pt-4">
                    <a href="{{ route('transaksi.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md mr-2 hover:bg-gray-300 transition">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">Update Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>