<?php
namespace App\Repositories\RequestNote;

use App\Models\RequestNote;
use App\Repositories\RepositoryInterface;

interface RequestNoteInterface extends RepositoryInterface
{
    public function listBuyNoteByDepartment();
    public function listFixNote();
    public function search2($request, $is_buy = true);
    public function create_buy_note($attributes = []);
    public function create_fix_note($attributes = []);
    public function find_buy_note($id);
    public function find_fix_note($id);

    public function process($id, $is_confirm);
}