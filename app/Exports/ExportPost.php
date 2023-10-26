<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPost implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'id',
            'title',
            'description',
            'status',
            'created_user_id',
            'updated_user_id',
            'deleted_user_id',
            'created_at',
            'updated_at',
            'deleted_at'
        ];
    }
    public function collection()
    {
        return Post::all();
    }
}
