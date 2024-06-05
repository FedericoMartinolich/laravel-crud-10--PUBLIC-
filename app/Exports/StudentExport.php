<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentExport implements FromCollection, WithHeadings, WithMapping
{
    protected $student;
    protected $condition;

    public function __construct(Student $student, string $condition)
    {
        $this->student = $student;
        $this->condition = $condition;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect([$this->student]);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'DNI',
            'Name',
            'Surname',
            'ID',
            'Birth',
            'Assists',
            'Condition'
        ];
    }

    /**
     * @param \App\Models\Student $student
     * @return array
     */
    public function map($student): array
    {
        return [
            $student->dni,
            $student->name,
            $student->surname,
            $student->id,
            date("d-m-y", strtotime($student->birth)),
            $student->assists->count(),
            $this->condition
        ];
    }
}
