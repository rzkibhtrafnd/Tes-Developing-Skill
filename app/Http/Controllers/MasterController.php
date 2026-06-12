<?php

namespace App\Http\Controllers;

use App\Services\MasterService;
use App\Http\Requests\TableARequest;
use App\Http\Requests\TableCRequest;
use App\Http\Requests\TableDRequest;

class MasterController extends Controller
{
    protected $masterService;

    public function __construct(MasterService $masterService)
    {
        $this->masterService = $masterService;
    }

    // Toko
    public function indexTableA()
    {
        $data = $this->masterService->getAllTableA();
        return view('master.toko.index', compact('data'));
    }

    public function createTableA()
    {
        return view('master.toko.create');
    }

    public function storeTableA(TableARequest $request)
    {
        $this->masterService->storeTableA($request->validated());
        return redirect()->route('toko.index')->with('success', 'Data Toko Berhasil Disimpan');
    }

    public function editTableA($id)
    {
        $data = $this->masterService->getTableAById($id);
        return view('master.toko.edit', compact('data'));
    }

    public function updateTableA(TableARequest $request, $id)
    {
        $this->masterService->updateTableA($id, $request->validated());
        return redirect()->route('toko.index')->with('success', 'Data Toko Berhasil Diperbarui');
    }

    public function destroyTableA($id)
    {
        $this->masterService->deleteTableA($id);
        return redirect()->route('toko.index')->with('success', 'Data Toko Berhasil Dihapus');
    }


    // Area
    public function indexTableC()
    {
        $data = $this->masterService->getAllTableC();
        return view('master.area.index', compact('data'));
    }

    public function createTableC()
    {
        $tokoOptions = $this->masterService->getAllTableA();
        return view('master.area.create', compact('tokoOptions'));
    }

    public function storeTableC(TableCRequest $request)
    {
        $this->masterService->storeTableC($request->validated());
        return redirect()->route('area.index')->with('success', 'Mapping Area Berhasil Disimpan');
    }

    public function editTableC($id)
    {
        $data = $this->masterService->getTableCById($id);
        $tokoOptions = $this->masterService->getAllTableA();
        return view('master.area.edit', compact('data', 'tokoOptions'));
    }

    public function updateTableC(TableCRequest $request, $id)
    {
        $this->masterService->updateTableC($id, $request->validated());
        return redirect()->route('area.index')->with('success', 'Mapping Area Berhasil Diperbarui');
    }

    public function destroyTableC($id)
    {
        $this->masterService->deleteTableC($id);
        return redirect()->route('area.index')->with('success', 'Mapping Area Berhasil Dihapus');
    }


    // Sales
    public function indexTableD()
    {
        $data = $this->masterService->getAllTableD();
        return view('master.sales.index', compact('data'));
    }

    public function createTableD()
    {
        return view('master.sales.create');
    }

    public function storeTableD(TableDRequest $request)
    {
        $this->masterService->storeTableD($request->validated());
        return redirect()->route('sales.index')->with('success', 'Data Sales Berhasil Disimpan');
    }

    public function editTableD($id)
    {
        $data = $this->masterService->getTableDById($id);
        return view('master.sales.edit', compact('data'));
    }

    public function updateTableD(TableDRequest $request, $id)
    {
        $this->masterService->updateTableD($id, $request->validated());
        return redirect()->route('sales.index')->with('success', 'Data Sales Berhasil Diperbarui');
    }

    public function destroyTableD($id)
    {
        $this->masterService->deleteTableD($id);
        return redirect()->route('sales.index')->with('success', 'Data Sales Berhasil Dihapus');
    }
}