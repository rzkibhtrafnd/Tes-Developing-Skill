<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Transaksi Baru') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        @if($errors->any())
            <div class="p-3 mb-6 text-red-700 bg-red-100 border border-red-300 rounded-md">
                <strong class="block mb-1">Gagal memproses data:</strong>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="p-6 bg-white shadow-sm sm:rounded-lg border-t-4 border-blue-500">
                <h3 class="text-base font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-keyboard mr-2 text-blue-500"></i> Input Transaksi Manual
                </h3>
                <form action="{{ route('transaksi.store_manual') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="kode_toko" class="block text-sm font-medium text-gray-700">Pilih Toko <span class="text-red-500">*</span></label>
                        <select name="kode_toko" id="kode_toko" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="" disabled selected>-- Pilih Kode Toko --</option>
                            @foreach($tokoOptions as $toko)
                                <option value="{{ $toko->kode_toko_baru }}" {{ old('kode_toko') == $toko->kode_toko_baru ? 'selected' : '' }}>
                                    Toko Baru #{{ $toko->kode_toko_baru }} 
                                    @if($toko->kode_toko_lama) (Kode Lama: #{{ $toko->kode_toko_lama }}) @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="nominal_transaksi" class="block text-sm font-medium text-gray-700">Nominal Transaksi (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" name="nominal_transaksi" id="nominal_transaksi" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            value="{{ old('nominal_transaksi') }}" placeholder="Contoh: 1000.00">
                    </div>

                    <div class="flex justify-end border-t pt-4">
                        <a href="{{ route('transaksi.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-md mr-2 hover:bg-gray-300 transition">Kembali</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition shadow">
                            Simpan Manual
                        </button>
                    </div>
                </form>
            </div>

            <div class="p-6 bg-white shadow-sm sm:rounded-lg border-t-4 border-emerald-500">
                <h3 class="text-base font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-file-excel mr-2 text-emerald-500"></i> Upload via File Excel
                </h3>
                <form action="{{ route('transaksi.store_excel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih File Excel (.xlsx, .xls, .csv) <span class="text-red-500">*</span></label>
                        <div class="flex items-center justify-center w-full">
                            <label id="drop-area" class="flex flex-col w-full h-36 border-4 border-dashed border-gray-200 hover:bg-gray-50 hover:border-emerald-300 rounded-md cursor-pointer transition overflow-hidden relative">
                                <input id="file_excel" type="file" name="file_excel" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required accept=".xlsx, .xls, .csv" />
                                <div id="drop-content" class="flex flex-col items-center justify-center pt-3 pointer-events-none">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-1"></i>
                                    <p id="drop-text" class="text-xs text-gray-500 text-center px-4">Klik untuk memilih file atau seret file ke sini</p>
                                    <p id="file-name" class="mt-2 text-xs text-gray-600"></p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="mb-4 text-sm">
                        <div class="p-3 bg-gray-50 border border-gray-200 rounded-md text-gray-700">
                            <strong>Format template:</strong>
                            <div class="mt-2 text-xs text-gray-500">Kolom harus berurutan: <code class="bg-white px-1 rounded">kode_toko, nominal_transaksi</code>. Contoh isi: <code class="bg-white px-1 rounded">1,1000.00</code></div>
                            <div class="mt-2">
                                <a href="/assets/sample_transaksi.csv" class="text-emerald-600 hover:underline text-sm">Download template CSV</a>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center border-t pt-5">
                        <span class="text-xs text-gray-400 italic">Maksimal ukuran file 2MB</span>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-md hover:bg-emerald-700 transition shadow">
                            Upload & Proses
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('file_excel');
    const dropArea = document.getElementById('drop-area');
    const dropText = document.getElementById('drop-text');
    const fileName = document.getElementById('file-name');

    if (!input) return;

    input.addEventListener('change', function(e) {
        const f = e.target.files[0];
        if (f) {
            fileName.textContent = f.name + ' (' + Math.round(f.size/1024) + ' KB)';
            dropArea.classList.add('border-emerald-400');
        } else {
            fileName.textContent = '';
            dropArea.classList.remove('border-emerald-400');
        }
    });

    // drag events for visual feedback
    ['dragenter','dragover'].forEach(evt => {
        dropArea.addEventListener(evt, (e) => { e.preventDefault(); e.stopPropagation(); dropArea.classList.add('bg-gray-50','border-emerald-300'); });
    });
    ['dragleave','drop'].forEach(evt => {
        dropArea.addEventListener(evt, (e) => { e.preventDefault(); e.stopPropagation(); dropArea.classList.remove('bg-gray-50','border-emerald-300'); });
    });
});
</script>