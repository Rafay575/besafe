<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "facility_id" => $this->facility_id,
            "first_name" => $this->first,
            "last_name" => $this->last,
            "email" => $this->email,
            "username" => $this->username,
            "phone" => $this->phone,
            "image" => asset('images/user/' . $this->image),
            // "email_verified_at" => "10-15-2021",
            // "type" => "tech",
            "status" => $this->status,

            // "allowed_login" => 1,
            // "sale_comis_percentage" => null,
            // "max_sale_dis_percentage" => null,
            "dob" => $this->dob,
            "gender" => $this->gender,
            "blood_group" => null,
            "marital_status" => null,
            "mobile_no" => $this->mobile_no,
            // "a_mobile_no" => null,
            // "f_mobile_no" => null,
            // "e_mobile_no" => null,
            // "e_contact_name" => null,
            // "facebook" => null,
            // "twitter" => null,
            // "linkedin" => null,
            // "instagram" => null,
            "current_address" => $this->current_address,
            "permanent_address" => $this->permanent_address,
            // "id_proof_name" => null,
            // "id_proof_no" => null,
            // "bank_account_title" => null,
            // "bank_account_no" => null,
            // "bank_name" => null,
            // "branch_title" => null,
            // "branch_code" => null,
            // "tax_payer_id" => null,
            // "department" => null,
            // "designation" => null,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}