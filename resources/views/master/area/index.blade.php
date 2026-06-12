<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Manajemen Area Sales') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 overflow-hidden bg-white shadow-md sm:rounded-lg">

            <div class="flex justify-between mb-6">
                <h3 class="flex items-center text-lg font-semibold text-gray-800">
                    Daftar Plotting Area Toko
                </h3>
                <a href="{{ route('area.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-200 ease-in-out bg-blue-600 rounded-lg shadow hover:bg-blue-700">
                    <i class="mr-2 fas fa-plus"></i> Tambah Area Toko
                </a>
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
                        <th class="px-4 py-2 font-semibold text-left text-gray-600">Area Sales</th>
                        <th class="px-4 py-2 font-semibold text-right text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($data as $area)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 font-medium text-gray-900">
                                Toko Baru #{{ $area->kode_toko }} 
                                @if($area->toko && $area->toko->kode_toko_lama)
                                    <span class="text-xs text-gray-400 font-normal">(Eks Toko #{{ $area->toko->kode_toko_lama }})</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ strtolower($area->area_sales) == 'a' ? 'bg-purple-100 text-purple-800' : 'bg-emerald-100 text-emerald-800' }}">
                                    Area {{ strtoupper($area->area_sales) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 space-x-2 text-right">
                                <a href="{{ route('area.edit', $area->kode_toko) }}"
                                    class="inline-flex items-center px-3 py-1 text-sm font-medium text-white transition duration-200 bg-yellow-500 rounded-md hover:bg-yellow-600">
                                    <i class="mr-1 fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('area.destroy', $area->kode_toko) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-white transition duration-200 bg-red-600 rounded-md hover:bg-red-700"
                                            onclick="return confirm('Yakin ingin menghapus mapping area untuk toko ini?')">
                                        <i class="mr-1 fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center text-gray-500">
                                <i class="mr-2 fas fa-inbox"></i> Belum ada data mapping area sales.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>