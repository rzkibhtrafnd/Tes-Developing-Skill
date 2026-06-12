<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard Ringkasan Eksekutif') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 gap-5 mb-8 sm:grid-cols-3">
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Pendapatan</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">Rp {{ number_format($totalOmset, 2, ',', '.') }}</p>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <i class="fas fa-wallet text-2xl"></i>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Master Toko</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalToko }} Toko</p>
                </div>
                <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                    <i class="fas fa-store text-2xl"></i>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Tim Sales</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalSales }} Anggota</p>
                </div>
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 lg:col-span-2">
                <h3 class="text-base font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-bar mr-2 text-blue-500"></i> Grafik Distribusi Omset per Area Wilayah Sales
                </h3>
                <div class="relative h-64">
                    <canvas id="areaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('areaChart').getContext('2d');
            
            new window.Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($areaLabels),
                    datasets: [{
                        label: 'Total Nominal Transaksi (Rp)',
                        data: @json($areaValues),
                        backgroundColor: ['rgba(99, 102, 241, 0.75)', 'rgba(16, 185, 129, 0.75)'],
                        borderColor: ['rgb(99, 102, 241)', 'rgb(16, 185, 129)'],
                        borderWidth: 1.5,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => 'Rp ' + value.toLocaleString('id-ID')
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>