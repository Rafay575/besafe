<?php

namespace Database\Seeders;

use App\Models\MetaIncidentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetaDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\MetaAuditHall::factory()->count(10)->create();
        \App\Models\MetaAuditType::factory()->count(10)->create();
        \App\Models\MetaBasicCause::factory()->count(10)->create();
        \App\Models\MetaContactType::factory()->count(10)->create();
        \App\Models\MetaDepartment::factory()->count(10)->create();
        \App\Models\MetaDepartmentTag::factory()->count(10)->create();
        \App\Models\MetaFireCategory::factory()->count(10)->create();
        \App\Models\MetaDesignation::factory()->count(10)->create();
        \App\Models\MetaImmediateCause::factory()->count(10)->create();
        \App\Models\MetaIncidentCategory::factory()->count(10)->create();
        \App\Models\MetaInjuryCategory::factory()->count(10)->create();
        \App\Models\MetaLine::factory()->count(10)->create();
        \App\Models\MetaInternalExternalAuditQuestion::factory()->count(100)->create();
        \App\Models\MetaPropertyDamage::factory()->count(10)->create();
        \App\Models\MetaPtwItem::factory()->count(10)->create();
        \App\Models\MetaPtwType::factory()->count(10)->create();
        \App\Models\MetaRiskLevel::factory()->count(10)->create();
        \App\Models\MetaRootCause::factory()->count(10)->create();
        \App\Models\MetaUnit::factory()->count(10)->create();
        \App\Models\MetaUnsafeBehaviorType::factory()->count(10)->create();

        MetaIncidentStatus::create([
            "status_title" => "Pending",
            "status_code" => 0,
        ]);
        MetaIncidentStatus::create([
            "status_title" => "Assigned",
            "status_code" => 1,
        ]);
        MetaIncidentStatus::create([
            "status_title" => "In Progress",
            "status_code" => 2,
        ]);
        MetaIncidentStatus::create([
            "status_title" => "Completed",
            "status_code" => 3,
        ]);
        MetaIncidentStatus::create([
            "status_title" => "Rejected",
            "status_code" => 4,
        ]);

    }
}