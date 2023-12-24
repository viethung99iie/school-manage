<?php

namespace App\Exports;

use App\Models\FeeCollect;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportCollectFee implements FromCollection , WithMapping , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [

                "Tên",
                "MSV",
                "Học kì",
                "Lớp",
                "Học phí",
                "Trạng thái",
                "Ngày nộp",
        ];
    }

    public function map($user): array
    {
        return [

            $user->user_name,
            $user->id_student,
            $user->exam_name,
            $user->class_name,
            number_format($user->class_amount,0)." VNĐ",
            'Đã thanh toán',
            date('d-m-Y',strtotime($user->created_at)),
        ];
    }
    public function collection()
    {
        return FeeCollect::getCollectFeeStudent();
    }
}