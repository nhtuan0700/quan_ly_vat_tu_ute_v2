<?php

namespace App\Http\Controllers;

use App\Models\DetailBuy;
use App\Models\DetailFix;
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
        $equipments_request = DB::table('request_note')
            ->join('detail_fix', 'request_note.id', '=', 'detail_fix.id_note')
            ->select(
                DB::raw('count(IF(detail_fix.is_fixable=1,1,NULL)) fixable'),
                DB::raw('count(IF(detail_fix.is_fixable is null,1,NULL)) fixing'),
                DB::raw('count(IF(detail_fix.is_fixable=0,1,NULL)) broken'),
                DB::raw('count(*) total')
            )
            ->where('request_note.is_buy', false)
            ->where('request_note.status', '!=', 4);

        $departments = DB::table('department')
            ->join('request_note', 'department.id', '=', 'request_note.id_department')
            ->groupBy(
                'request_note.id_department',
                'department.id',
                'department.name',
            )
            ->select(
                'department.id',
                'department.name',
                DB::raw('count(IF(request_note.is_buy=true,1,NULL)) as count_buy'),
                DB::raw('count(IF(request_note.is_buy=false,1,NULL)) as count_fix'),
            );

        $notes = RequestNote::groupby('is_buy')
            ->selectRaw('count(*) as count, is_buy');

        if ($month) {
            $cost_buy_total = $cost_buy_total->whereMonth('pay_at', $month);
            $cost_fix_total = $cost_fix_total->whereMonth('pay_at', $month);
            $notes = $notes->whereMonth('created_at', $month);
            $equipments_request = $equipments_request->whereMonth('created_at', $month);
            $departments = $departments->whereMonth('created_at', $month);
        }

        $cost_buy_total = $cost_buy_total->whereYear('pay_at', $year);
        $cost_fix_total = $cost_fix_total->whereYear('pay_at', $year);
        $cost_buy = $cost_buy->whereYear('pay_at', $year);
        $cost_fix = $cost_fix->whereYear('pay_at', $year);
        $equipments_request = $equipments_request->whereYear('created_at', $year);
        $departments = $departments->whereYear('created_at', $year);

        $notes = $notes->whereYear('created_at', $year)->get();
        $data['cost_buy_total'] = $cost_buy_total->sum('cost');
        $data['cost_fix_total'] = $cost_fix_total->sum('cost');
        $data['cost_buy'] = $cost_buy->groupby('month')->get()->pluck('cost', 'month');
        $data['cost_fix'] = $cost_fix->groupby('month')->get()->pluck('cost', 'month');
        $data['equipments_request'] = $equipments_request->first();
        $data['notes'] = $notes->pluck('count', 'is_buy');
        $data['departments'] = $departments->get();

        return view('statistic.index', compact('data'));
    }
}
