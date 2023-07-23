<?php

namespace App\Imports;

use App\Models\MetaLocation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MetaLocationImport implements ToCollection, WithHeadingRow, WithValidation
{

    protected $titleField = "location_title";
    protected $modelClass = MetaLocation::class;

    public function rules(): array
    {
        return [
            $this->titleField => ['required', 'string', 'min:3', 'max:40'],
            'meta_unit_id' => ['required', 'numeric', 'exists:meta_units,id'],
        ];
    }


    public function collection(Collection $collection)
    {

        foreach ($collection as $row) {
            $id = @$row['id'];
            // if its has id then it means update existing record
            if (!empty($id)) {
                $meta_data = $this->modelClass::where('id', $id)->first();
                if ($meta_data) {
                    $meta_data->{$this->titleField} = $row[$this->titleField];
                    $meta_data->meta_unit_id = $row['meta_unit_id'];
                    $meta_data->save();
                }
            } else {
                // preventing duplicate
                $meta_data = $this->modelClass::where($this->titleField, $row[$this->titleField])->first();
                if (!$meta_data) {
                    // otherwise we create new meta data
                    $this->modelClass::create([$this->titleField => $row[$this->titleField], 'meta_unit_id' => $row['meta_unit_id']]);
                }

            }
        }
    }
}