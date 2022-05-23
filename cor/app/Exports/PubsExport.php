<?php

namespace App\Exports;

use App\Models\Pub;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PubsExport implements FromCollection, WithHeadings , WithMapping ,ShouldAutoSize ,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pub::all();
    }
    /**
     * Returns headers for report
     * @return array
     */
    public function headings(): array {
        return [
            "ID",
            "Tên sản phẩm :",
            "Số lượng :",
            "Giá cả :",
            "Tổng tiền :",
            "Thành viên nhập :",
            "Thành viên sử dụng :",
            "Ngày khởi tạo :",
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:AJ1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
            },
        ];
    }

    public function map($pub): array {

        $user_manny = '';
        foreach($pub->pubs_users as $k =>  $users){
            if ($k > 0) {
                $user_manny .=  ',' . $users->name;
            } else {
                $user_manny .=  $users->name;
            }
        }

        return [
            $pub->id,
            $pub->product_name,
            $pub->amount,
            number_format($pub->price),
            number_format($pub->amount *  $pub->price),
            $pub->users->name,
            $user_manny,
            $pub->created_at,
        ];
    }
}
