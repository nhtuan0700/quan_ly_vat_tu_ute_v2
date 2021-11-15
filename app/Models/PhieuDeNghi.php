<?php

namespace App\Models;

use App\Traits\TimestampFormatTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PhieuDeNghi extends Model
{
    use HasFactory, TimestampFormatTrait;
    public const CONFIRMING = 1;
    public const CONFIRMED = 2;
    public const FINISH = 3;

    protected $fillable = [
        'id', 'id_creator', 'id_csvc', 'id_dotdk', 'id_donvi', 'is_mua', 'status', 'confirmed_at',
    ];

    protected $table = 'phieudenghi';
    public $incrementing = false;

    public function creator()
    {
        return $this->belongsTo(User::class, 'id_creator', 'id');
    }

    public function confirmer()
    {
        return $this->belongsTo(User::class, 'id_csvc', 'id');
    }

    public function detail_mua()
    {
        return $this->hasMany(ChiTietMua::class, 'id_phieu', 'id');
    }
    public function detail_sua()
    {
        return $this->hasMany(ChiTietSua::class, 'id_phieu', 'id');
    }

    public function thietbi()
    {
        return $this->belongsToMany(ThietBi::class, 'chitietsua', 'id_phieu', 'id_thietbi');
    }

    public function details()
    {
        if ($this->is_mua) {
            $data = DB::table('vanphongpham')
                ->join('chitietmua', 'vanphongpham.id', '=', 'chitietmua.id_vanphongpham')
                ->where('chitietmua.id_phieu', $this->id)
                ->select('id', 'name', 'dvt', 'qty', 'cost')
                ->get();
        } else {
            $data = DB::table('thietbi')
                ->join('chitietsua', 'thietbi.id', '=', 'chitietsua.id_thietbi')
                ->where('chitietsua.id_phieu', $this->id)
                ->select('id', 'name', 'phong', 'reason', 'cost', 'status')
                ->get();
        }
        return $data;
    }

    public function scopePhieuMua($query)
    {
        return $query->where('is_mua', true);
    }

    public function scopePhieuSua($query)
    {
        return $query->where('is_mua', false);
    }

    public function getStatusHTMLAttribute()
    {
        switch ($this->status) {
            case self::CONFIRMING:
                return '<span class="badge badge-info">Chờ duyệt</span>';
            case self::CONFIRMED:
                return '<span class="badge badge-warning">Chờ bàn giao</span>';
            case self::FINISH:
                return '<span class="badge badge-success">Đã hoàn thành</span>';
        }
    }

    public function getCategoryAttribute()
    {
        if ($this->is_mua) {
            return 'Phiếu Mua';
        }
        return 'Phiếu Sửa';
    }
}
