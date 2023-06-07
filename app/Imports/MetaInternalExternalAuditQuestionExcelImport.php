<?php

namespace App\Imports;

use App\Models\MetaInternalExternalAuditQuestion;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MetaInternalExternalAuditQuestionExcelImport implements ToCollection, WithHeadingRow, WithValidation
{

    protected $titleField = "question";
    protected $modelClass = MetaInternalExternalAuditQuestion::class;

    public function rules(): array
    {
        return [
            $this->titleField => ['required', 'string', 'min:3', 'max:40'],
            'group_name' => ['nullable', 'string', 'min:3', 'max:20'],
            'meta_audit_type_id' => ['required', 'exists:meta_audit_types,id'],
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
                    $meta_data->group_name = $row['group_name'];
                    $meta_data->meta_audit_type_id = $row['meta_audit_type_id'];
                    $meta_data->save();
                }
            } else {
                // preventing duplicate
                $meta_data = $this->modelClass::where($this->titleField, $row[$this->titleField])->where('meta_audit_type_id', $row['meta_audit_type_id'])->first();
                if (!$meta_data) {
                    // otherwise we create new meta data
                    $this->modelClass::create([$this->titleField => $row[$this->titleField], 'group_name' => $row['group_name'], 'meta_audit_type_id' => $row['meta_audit_type_id']]);
                }

            }
        }
    }
}