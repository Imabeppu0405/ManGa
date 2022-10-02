<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

abstract class BaseRepository
{
    protected $table;

    /**
     * 削除済みも含めて未削除→削除済みの順で取得
     *
     * @param string $sortColumn
     * @return Collection
     */
    public function getListWithLeft(string $sortOrder = 'ASC', string $sortColumn = 'id') {
        return DB::table($this->table)
            ->orderBy('deleted_at')
            ->orderBy($sortColumn, $sortOrder)
            ->get();
    }
}