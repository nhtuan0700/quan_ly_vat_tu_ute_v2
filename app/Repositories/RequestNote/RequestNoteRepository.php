<?php

namespace App\Repositories\RequestNote;

use App\Models\RequestNote;
use App\Repositories\BaseRepository;
use App\Repositories\RequestNote\RequestNoteInterface;

class RequestNoteRepository extends BaseRepository implements RequestNoteInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return RequestNote::class;
    }

    public function getAutoId($is_mua = true)
    {
        $now = now();
        $code = $is_mua ? 'PM' : 'PS';
        $month = $now->format('m');
        $year = $now->format('y');
        $prefix = $code . $month . $year;
        $last_field = $this->model->where('id', 'like', "$prefix%")->orderby('id', 'desc')->first();
        if (!$last_field) {
            $count = str_pad(1, 3, '0', STR_PAD_LEFT);
        } else {
            $count = intval(substr($last_field->id, -3)) + 1;
            $count = str_pad($count, 3, '0', STR_PAD_LEFT);
        }
        $new_id = $prefix . $count;
        return $new_id;
    }

    public function listBuyNoteByDepartment()
    {
        return $this->model->buy()
            ->where('id_department', auth()->user()->id_department)
            ->orderby('created_at', 'desc')
            ->paginate($this->limit);
    }

    public function listFixNote()
    {
        return $this->model->fix()
            ->where('id_creator', auth()->id())
            ->orderby('created_at', 'desc')
            ->paginate($this->limit);
    }

    public function search2($request, $is_buy = true)
    {
        if ($is_buy) {
            $model = $this->model->buy()->where('id_department', auth()->user()->id_department);
        } else {
            $model = $this->model->fix()->where('id_creator', auth()->id());
        }
        if ($request->id) {
            $model->where('id', $request->id);
        }
        if ($request->status) {
            $model->where('status', $request->status);
        }
        return $model
            ->orderby('created_at', 'desc')
            ->paginate($this->limit)
            ->appends(request()->all());
    }

    public function process($id, $is_confirm)
    {
        $phieu = $this->model->findOrfail($id);
        $phieu->update([
            'status' => $is_confirm ? RequestNote::CONFIRMED : RequestNote::REJECTED,
            'id_handler' => auth()->id(),
            'processed_at' => now()
        ]);
    }

    public function create_buy_note($attributes = [])
    {
        $attributes['id'] = $this->getAutoId(true);
        $attributes['is_buy'] = true;
        $attributes['status'] = RequestNote::PROCESSING;
        $new_note = parent::create($attributes);
        return $new_note;
    }

    public function create_fix_note($attributes = [])
    {
        $attributes['id'] = $this->getAutoId(false);
        $attributes['is_buy'] = false;
        $attributes['status'] = RequestNote::PROCESSING;
        $new_note = parent::create($attributes);
        return $new_note;
    }

    public function find_buy_note($id)
    {
        return $this->model->buy()->where('id', $id)->firstOrFail();
    }
    public function find_fix_note($id)
    {
        return $this->model->fix()->where('id', $id)->firstOrFail();
    }
}
