<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DetailBuy;
use App\Models\DetailFix;
use App\Models\Equipment;
use App\Models\RequestNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month;
        $year = $request->year ?? now()->year;

        $cost_buy = DetailBuy::selectRaw('MONTH(pay_at) as month, sum(cost) as cost');
        $cost_fix = DetailFix::selectRaw('MONTH(pay_at) as month, sum(cost) as cost');
        $cost_buy_total = clone $cost_buy;
        $cost_fix_total = clone $cost_fix;
        $equipments = Equipment::groupby('status')->selectRaw('count(*) as count, status')->get();
        $notes = RequestNote::groupby('is_buy')
            ->selectRaw('count(*) as count, is_buy');

        if ($month) {
            $cost_buy_total = $cost_buy_total->whereMonth('pay_at', $month);
            $cost_fix_total = $cost_fix_total->whereMonth('pay_at', $month);
            $notes = $notes->whereMonth('created_at', $month);
        }

        $cost_buy_total = $cost_buy_total->whereYear('pay_at', $year);
        $cost_fix_total = $cost_fix_total->whereYear('pay_at', $year);
        $cost_buy = $cost_buy->whereYear('pay_at', $year);
        $cost_fix = $cost_fix->whereYear('pay_at', $year);
        $notes = $notes->whereYear('created_at', $year)->get();

        $data['cost_buy_total'] = $cost_buy_total->sum('cost');
        $data['cost_fix_total'] = $cost_fix_total->sum('cost');
        $data['cost_buy'] = $cost_buy->groupby('month')->get()->pluck('cost', 'month');
        $data['cost_fix'] = $cost_fix->groupby('month')->get()->pluck('cost', 'month');
        $data['equipments'] = $equipments->pluck('count', 'status')->toArray();
        $data['notes'] = $notes->pluck('count', 'is_buy');

        $data['departments'] = Department::query()
            ->withCount(['notes as count_buy' => function ($query) use ($month, $year) {
                $query = $query->where('is_buy', true);
                if ($month) {
                    $query = $query->whereMonth('created_at', $month);
                }
                return $query->whereYear('created_at', $year);
            }])->withCount(['notes as count_fix' => function ($query) use ($month, $year) {
                $query = $query->where('is_buy', false);
                if ($month) {
                    $query = $query->whereMonth('created_at', $month);
                }
                return $query->whereYear('created_at', $year);
            }])
            ->get();
        return view('statistic.index', compact('data'));
    }
}
