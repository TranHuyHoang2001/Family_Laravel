<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Criteria implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        try {
            return \App\Models\Criteria::create(
                [
                    'name' => $row[5],
                    'proviso' => $row[6],
                ]
            );

        } catch (\Exception $exception) {
            \Log::error($exception->getTraceAsString());
            throw $exception;
        }
    }

    public function startRow(): int
    {
        return 7;
    }
}
