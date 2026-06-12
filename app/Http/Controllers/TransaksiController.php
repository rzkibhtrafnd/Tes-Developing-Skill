<?php

namespace App\Http\Controllers;

use App\Services\TransaksiService;
use App\Services\MasterService;
use App\Http\Requests\TableBRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TransaksiImport;
use App\Exports\TransaksiExport;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    protected $transaksiService;
    protected $masterService;

    public function __construct(TransaksiService $transaksiService, MasterService $masterService)
    {
        $this->transaksiService = $transaksiService;
        $this->masterService = $masterService;
    }

    public function index()
    {
        $data = $this->transaksiService->getPaginatedTransaksi();
        return view('transaksi.index', compact('data'));
    }

    public function exportExcel()
    {
        return Excel::download(new TransaksiExport, 'Laporan_Transaksi_' . date('Ymd_His') . '.xlsx');
    }

    public function exportPdf()
    {
        $data = $this->transaksiService->getAllTransaksi();
        
        $pdf = Pdf::loadView('transaksi.pdf', compact('data'))->setPaper('a4', 'portrait');
        
        return $pdf->download('Laporan_Transaksi_' . date('Ymd_His') . '.pdf');
    }

    public function create()
    {
        $tokoOptions = $this->masterService->getAllTableA(); 
        return view('transaksi.create', compact('tokoOptions'));
    }

    public function store(TableBRequest $request)
    {
        try {
            $this->transaksiService->storeTransaksi($request->validated());
            return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new TransaksiImport, $request->file('file_excel'));
            return redirect()->route('transaksi.index')->with('success', 'Data Excel Berhasil Diimport');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Gagal mengimpor file: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data = $this->transaksiService->getTransaksiById($id);
        $tokoOptions = $this->masterService->getAllTableA();
        return view('transaksi.edit', compact('data', 'tokoOptions'));
    }

    public function update(TableBRequest $request, $id)
    {
        try {
            $this->transaksiService->updateTransaksi($id, $request->validated());
            return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil Diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $this->transaksiService->deleteTransaksi($id);
        return redirect()->route('transaksi.index')->with('success', 'Transaksi Berhasil Dihapus');
    }
}