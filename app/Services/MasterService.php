<?php

namespace App\Services;

use App\Models\TableA;
use App\Models\TableC;
use App\Models\TableD;

class MasterService
{
    public function getAllTableA() 
    { 
        return TableA::all(); 
    }

    public function getTableAById($id) 
    { 
        return TableA::findOrFail($id); 
    }
    
    public function storeTableA(array $data) 
    {
        return TableA::create($data);
    }

    public function updateTableA($id, array $data) 
    {
        $toko = $this->getTableAById($id);
        $toko->update($data);
        return $toko;
    }
    
    public function deleteTableA($id) 
    {
        $toko = $this->getTableAById($id);
        return $toko->delete();
    }

    public function getAllTableC() 
    { 
        return TableC::with('toko')->get(); 
    }

    public function getTableCById($id) 
    { 
        return TableC::findOrFail($id); 
    }
    
    public function storeTableC(array $data) 
    {
        return TableC::create($data);
    }

    public function updateTableC($id, array $data) 
    {
        $area = $this->getTableCById($id);
        $area->update($data);
        return $area;
    }
    
    public function deleteTableC($id) 
    {
        $area = $this->getTableCById($id);
        return $area->delete();
    }

    public function getAllTableD() 
    { 
        return TableD::all(); 
    }

    public function getTableDById($id) 
    { 
        return TableD::findOrFail($id); 
    }
    
    public function storeTableD(array $data) 
    {
        return TableD::create($data);
    }

    public function updateTableD($id, array $data) 
    {
        $sales = $this->getTableDById($id);
        $sales->update($data);
        return $sales;
    }
    
    public function deleteTableD($id) 
    {
        $sales = $this->getTableDById($id);
        return $sales->delete();
    }
}