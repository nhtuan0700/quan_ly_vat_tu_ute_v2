<?php

namespace App\Http\Controllers;

use App\Http\Requests\DotDangKy\StoreDotDangKy;
use App\Http\Requests\DotDangKy\UpdateDotDangKy;
use App\Repositories\DotDangKy\DotDangKyInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DotDangKyController extends Controller
{
    protected $dotDangKyRepo;

    public function __construct(DotDangKyInterface $dotDangKyInterface)
    {
        $this->dotDangKyRepo = $dotDangKyInterface;
    }

    public function index()
    {
        $list_dotdangky = $this->dotDangKyRepo->paginate();
        return view('dotdangky.index', compact('list_dotdangky'));
    }

    public function create()
    {
        $is_coming = $this->dotDangKyRepo->checkComingExist();
        return view('dotdangky.create', compact('is_coming'));
    }

    public function store(StoreDotDangKy $request)
    {
        $is_coming = $this->dotDangKyRepo->checkComingExist();
        if ($is_coming) {
            return redirect(route('dotdangky.index'))
                ->with('alert-fail', 'Sắp có đợt đăng ký mới nên không thể tạo');
        }
        $data = $request->only(['start_at', 'end_at']);
        $new_data = $this->dotDangKyRepo->create($data);
        return redirect(route('dotdangky.edit', ['id' => $new_data->id]))
            ->with('alert-success', trans('alert.create.success'));
    }

    public function edit($id)
    {
        $dotdangky = $this->dotDangKyRepo->findOrFail($id);
        $start_at = Carbon::createFromFormat('d/m/Y H:i', $dotdangky->start_at);
        $end_at = Carbon::createFromFormat('d/m/Y H:i', $dotdangky->end_at);
        $disable_start_at = false;
        if (Carbon::now()->between($start_at, $end_at)) {
           $disable_start_at = true;
        }
        return view('dotdangky.edit', compact('dotdangky', 'disable_start_at'));
    }

    public function update(UpdateDotDangKy $request, $id)
    {
        $dotdangky = $this->dotDangKyRepo->findOrFail($id);
        if (!$dotdangky->canEdit()) {
            return back()->with('alert-fail', trans('alert.update.fail'));
        }
        $data = $request->only(['start_at', 'end_at']);
        $this->validate(request(), [
            'end_at' => [function ($attribute, $value, $fail) use ($dotdangky) {
                if (Carbon::createFromFormat('d/m/Y H:i', $value)->lt(now())) {
                    $fail('Ngày kết thúc phải lớn hơn hôm nay');
                }
            }]
        ]);

        // Nếu đang diễn ra thì không cập nhật ngày bắt đầu
        $start_at = Carbon::createFromFormat('d/m/Y H:i', $dotdangky->start_at);
        $end_at = Carbon::createFromFormat('d/m/Y H:i', $dotdangky->end_at);
        if (Carbon::now()->between($start_at, $end_at)) {
            unset($data['start_at']);
        }
        $dotdangky->update($data);
        return back()->with('alert-success', trans('alert.update.success'));
    }

    public function delete($id)
    {
        $dotdangky = $this->dotDangKyRepo->findOrFail($id);
        if (!$dotdangky->canDelete()) {
            return back()->with('alert-fail', trans('alert.delete.fail'));
        }
        $dotdangky->delete($id);
        return back()->with('alert-success', trans('alert.delete.success'));
    }
}
