<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PeriodRegistration\StorePeriodRegistration;
use App\Http\Requests\PeriodRegistration\UpdatePeriodRegistration;
use App\Repositories\PeriodRegistration\PeriodRegistrationInterface;

class PeriodRegistrationController extends Controller
{
    protected $periodRepo;

    public function __construct(
        PeriodRegistrationInterface $periodRegistraionInterface
    ) {
        $this->periodRepo = $periodRegistraionInterface;
    }

    public function index()
    {
        $periods = $this->periodRepo->paginate();
        return view('period.index', compact('periods'));
    }

    public function create()
    {
        $is_coming = $this->periodRepo->checkComing();
        return view('period.create', compact('is_coming'));
    }

    public function store(StorePeriodRegistration $request)
    {
        $is_coming = $this->periodRepo->checkComing();
        if ($is_coming) {
            return redirect(route('period.index'))
                ->with('alert-fail', 'Có đợt đăng ký mới sắp diễn ra nên không thể tạo thêm');
        }
        $data = $request->validated();
        $new_period = $this->periodRepo->create($data);
        return redirect(route('period.edit', ['id' => $new_period->id]))
            ->with('alert-success', trans('alert.create.success'));
    }

    public function edit($id)
    {
        $period = $this->periodRepo->findOrFail($id);
        $disabled_start = false;
        $is_between = now()->between($period->getRawOriginal('start_time'), $period->getRawOriginal('end_time'));
        if ($is_between || Gate::denies('edit', $period)) {
            $disabled_start = true;
        }
        return view('period.edit', compact('period', 'disabled_start'));
    }

    public function update(UpdatePeriodRegistration $request, $id)
    {
        $period = $this->periodRepo->findOrFail($id);
        $this->authorize('edit', $period);
        $data = $request->validated();
        $this->validate(request(), [
            'end_time' => [function ($attribute, $value, $fail) {
                if (Carbon::createFromFormat('d/m/Y H:i', $value)->lt(now())) {
                    $fail('Ngày kết thúc phải lớn hơn hôm nay');
                }
            }]
        ]);
        // Nếu đang diễn ra thì không cập nhật ngày bắt đầu
        $is_between = now()->between($period->getRawOriginal('start_at'), $period->getRawOriginal('end_at'));
        if ($is_between) {
            unset($data['start_at']);
        }
        $period->update($data);
        return back()->with('alert-success', trans('alert.update.success'));
    }

    public function delete($id)
    {
        $period = $this->periodRepo->findOrFail($id);
        $this->authorize('delete', $period);
        $period->delete($id);
        return back()->with('alert-success', trans('alert.delete.success'));
    }
}