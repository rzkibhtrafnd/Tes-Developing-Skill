<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Manajemen Transaksi Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 overflow-hidden bg-white shadow-md sm:rounded-lg">
            <div class="flex justify-between mb-6">
                <h3 class="flex items-center text-lg font-semibold text-gray-800">
                    Daftar Histori Transaksi
                </h3>
                <div class="flex space-x-2">
                    <a href="{{ route('transaksi.export_excel') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-200 ease-in-out bg-emerald-600 rounded-lg shadow hover:bg-emerald-700">
                        <i class="mr-2 fas fa-file-excel"></i> Download Excel
                    </a>

                    <a href="{{ route('transaksi.export_pdf') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-200 ease-in-out bg-rose-600 rounded-lg shadow hover:bg-rose-700">
                        <i class="mr-2 fas fa-file-pdf"></i> Download PDF
                    </a>

                    <a href="{{ route('transaksi.create') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-200 ease-in-out bg-blue-600 rounded-lg shadow hover:bg-blue-700">
                        <i class="mr-2 fas fa-plus"></i> Tambah Transaksi
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="p-3 mb-4 text-green-700 bg-green-100 border border-green-300 rounded-md">
                    <i class="mr-2 fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full text-sm border divide-y divide-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 font-semibold text-left text-gray-600">No</th>
                        <th class="px-4 py-2 font-semibold text-left text-gray-600">Kode Toko</th>
                        <th class="px-4 py-2 font-semibold text-right text-gray-600">Nominal Transaksi</th>
                        <th class="px-4 py-2 font-semibold text-right text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($data as $transaksi)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-4 py-2 text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 font-medium text-gray-900">
                                Toko #{{ $transaksi->kode_toko }}
                            </td>
                            <td class="px-4 py-2 text-right font-semibold text-gray-800">
                                Rp {{ number_format($transaksi->nominal_transaksi, 2, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 space-x-2 text-right">
                                <a href="{{ route('transaksi.edit', $transaksi->id ?? $transaksi->kode_toko) }}"
                                    class="inline-flex items-center px-3 py-1 text-sm font-medium text-white transition duration-200 bg-yellow-500 rounded-md hover:bg-yellow-600">
                                    <i class="mr-1 fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('transaksi.destroy', $transaksi->id ?? $transaksi->kode_toko) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-white transition duration-200 bg-red-600 rounded-md hover:bg-red-700"
                                            onclick="return confirm('Yakin ingin menghapus data transaksi ini?')">
                                        <i class="mr-1 fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                <i class="mr-2 fas fa-inbox"></i> Belum ada riwayat transaksi masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</x-app-layout>