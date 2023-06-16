<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class IncidentExport implements FromCollection
{

    protected $incidentModelClass;

    public function __construct($incidentModelClass)
    {
        $this->incidentModelClass = $incidentModelClass;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->incidentModelClass;
    }
}