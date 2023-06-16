<?php

namespace App\Exports;

use App\Http\Resources\FirePropertyDamageCollection;
use App\Http\Resources\HazardCollection;
use App\Http\Resources\IEAuditClauseCollection;
use App\Http\Resources\InjuryCollection;
use App\Http\Resources\NearMissCollection;
use App\Http\Resources\PermitToWorkCollection;
use App\Http\Resources\UnsafeBehaviorCollection;
use App\Models\Hazard;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BasicExcelExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{

    protected $dataCollection;
    protected $isResource = false;
    public function getResourceCollectionClass($key)
    {
        $resourcesClasses = [
            'hazards' => HazardCollection::class,
            'injuries' => InjuryCollection::class,
            'fire_property_damages' => FirePropertyDamageCollection::class,
            'near_misses' => NearMissCollection::class,
            'unsafe_behaviors' => UnsafeBehaviorCollection::class,
            'permit_to_works' => PermitToWorkCollection::class,
            'ie_audit_clauses' => IEAuditClauseCollection::class,
        ];
        return $resourcesClasses[$key] ?? false;
    }
    public function __construct($dataCollection)
    {
        $resouceCollectionClass = $this->getResourceCollectionClass($dataCollection->first()->getTable());
        if ($resouceCollectionClass) {
            $this->dataCollection = $resouceCollectionClass::collection($dataCollection);
            $this->isResource = true;
        } else {
            $this->dataCollection = $dataCollection;
        }
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->dataCollection;
    }
    public function headings(): array
    {
        $columnNames = [];
        $columnNames = Schema::getColumnListing($this->dataCollection->first()->getTable());

        if ($this->isResource) {
            $columnNames = array_keys(json_decode($this->dataCollection->first()->toJson(), true));
        } else {
            $columnNames = Schema::getColumnListing($this->dataCollection->first()->getTable());
        }

        $columnNames = array_map(function ($columnName) {
            return ucwords(str_replace('_', ' ', $columnName));
        }, $columnNames);

        return $columnNames;

    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'F2F2F2',
                    ],
                ],
            ],
        ];
    }


}