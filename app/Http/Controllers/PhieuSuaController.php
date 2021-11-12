<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhieuDeNghi\StorePhieuDeNghi;
use App\Http\Requests\PhieuDeNghi\UpdatePhieuDeNghi;
use App\Repositories\PhieuDeNghi\PhieuDeNghiInterface;
use Illuminate\Http\Request;

class PhieuSuaController extends Controller
{
    protected $phieuSuaRepo;

    public function __construct(PhieuDeNghiInterface $phieuDeNghiInterface)
    {
        $this->phieuSuaRepo = $phieuDeNghiInterface;
    }

    public function index()
    {
    }

    public function create()
    {
    }

    public function store(StorePhieuDeNghi $request)
    {
    }

    public function edit($id)
    {
    }

    public function update(UpdatePhieuDeNghi $request, $id)
    {
    }

    public function delete($id)
    {
    }
}
