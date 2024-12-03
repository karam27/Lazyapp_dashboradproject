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
        return Activity::select('id', 'child_name', 'activity_name', 'duration', 'date')->get();
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
            $activity->child_name,
            $activity->activity_name,
            $activity->duration . ' دقيقة',
            $activity->date,
        ];
    }
}
