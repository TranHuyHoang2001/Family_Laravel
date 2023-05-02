<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Job implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('category')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return \App\Models\Job::create(
                [
                    'name' => $row[1] ?? 'N/A',
                    'point' => 1,
                    'role_id' => $row[2],
                ]
            );

        } catch (\Exception $exception) {
            \Log::error($exception->getTraceAsString());
            throw $exception;
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
