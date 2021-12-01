<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LimitStationery\LimitStationeryInterface;

class LimitStationeryController extends Controller
{
    private $limitRepo;

    public function __construct(
        LimitStationeryInterface $limitStationeryInterface
    ) {
        $this->limitRepo = $limitStationeryInterface;
    }
    
    public function index()
    {
        $limit_stationeries = $this->limitRepo->listByUser(auth()->id());
        // dd($limit_stationeries);
        return view('limit_stationery.index', compact('limit_stationeries'));
    }
}
