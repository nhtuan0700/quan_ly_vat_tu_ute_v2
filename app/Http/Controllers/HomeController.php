<?php

namespace App\Http\Controllers;

use App\Repositories\PeriodRegistration\PeriodRegistrationInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $periodRepo;

    public function __construct(PeriodRegistrationInterface $periodRegistrationInterface)
    {
        $this->periodRepo = $periodRegistrationInterface;
    }

    public function welcome() {
        return view('welcome.home');
    }

    public function introduce() {
        return view('welcome.introduce');
    }
    
    public function home()
    {
        $periods = $this->periodRepo->query()
            ->where(function ($query) {
                $query->where('start_time', '<=', now())->where('end_time', '>=', now());
            })->orWhere(function ($query) {
                $query->where('start_time', '>', now());
            })->orderby('created_at', 'desc')->get();
        return view('home.index2', compact('periods'));
    }
}
