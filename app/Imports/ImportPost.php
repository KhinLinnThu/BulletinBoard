<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ImportPost implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        return new Post([
            'id' => $row[0],
            'title' => $row[1],
            'description' => $row[2],
            'status' => $row[3],
            'created_user_id' => $row[4],
            'updated_user_id' => $row[5],
            'deleted_user_id' => $row[6],
            'created_at' => Carbon::parse($row[7]),
            'updated_at' => Carbon::parse($row[8]),
            'deleted_at' => Carbon::parse($row[9]),
        ]);
    }
}
