<?php

namespace App\Exports;
use App\Models\Bill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class TestExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return Bill::all();
    }

    /**
     * Set header columns
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'customer_id',
            'date_order',
            'total',
            'note'
        ];
    }

    /**
     * Mapping data
     *
     * @return array
     */
    public function map($bill): array
    {
        return [
            $bill->customer_id,
            $bill->date_order,
            $bill->total,
            $bill->note,
        ];
    }
}
