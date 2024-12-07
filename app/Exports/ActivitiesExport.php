<?php

namespace App\Exports;

use App\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;

class ActivitiesExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return Activity::with('user:id,name')
            ->select('id', 'user_id', 'activity_name', 'duration', 'date')
            ->get();
    }


    /**
     * إضافة رؤوس الأعمدة إلى ملف Excel
     */
    public function headings(): array
    {
        return ['رقم', 'اسم الطفل', 'الأنشطة', 'الوقت المستغرق', 'التاريخ'];
    }
    public function map($activity): array
    {

        return [
            $activity->id,
            $activity->user->name,  // الحصول على اسم الطفل من العلاقة
            $activity->activity_name,
            $activity->duration . ' دقيقة',
            $activity->date->format('d/m/Y'),  // تنسيق التاريخ
        ];
    }
}
