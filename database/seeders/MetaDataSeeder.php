<?php

namespace Database\Seeders;

use App\Models\MetaIncidentStatus;
use App\Models\MetaLocation;
use App\Models\MetaSgflRelation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // Truncate existing records from each table
        \App\Models\MetaAuditHall::truncate();
        \App\Models\MetaAuditType::truncate();
        \App\Models\MetaBasicCause::truncate();
        \App\Models\MetaContactType::truncate();
        \App\Models\MetaDepartment::truncate();
        \App\Models\MetaDepartmentTag::truncate();
        \App\Models\MetaFireCategory::truncate();
        \App\Models\MetaDesignation::truncate();
        \App\Models\MetaImmediateCause::truncate();
        \App\Models\MetaIncidentCategory::truncate();
        \App\Models\MetaInjuryCategory::truncate();
        \App\Models\MetaLine::truncate();
        \App\Models\MetaInternalExternalAuditQuestion::truncate();
        \App\Models\MetaPropertyDamage::truncate();
        \App\Models\MetaPtwItem::truncate();
        \App\Models\MetaPtwType::truncate();
        \App\Models\MetaRiskLevel::truncate();
        \App\Models\MetaRootCause::truncate();
        \App\Models\MetaUnit::truncate();
        \App\Models\MetaUnsafeBehaviorType::truncate();
        \App\Models\MetaIncidentStatus::truncate();
        \App\Models\MetaSgflRelation::truncate();
        \App\Models\MetaLocation::truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');


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
        \App\Models\MetaRiskLevel::factory()->count(3)->create();
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

        MetaSgflRelation::create([
            "sgfl_relation_title" => "Contract",
        ]);
        MetaSgflRelation::create([
            "sgfl_relation_title" => "Permanent",
        ]);

        MetaLocation::create([
            "location_title" => "location 1",
            "meta_unit_id" => 1,
        ]);
        MetaLocation::create([
            "location_title" => "location 2",
            "meta_unit_id" => 1,
        ]);
        MetaLocation::create([
            "location_title" => "location 3",
            "meta_unit_id" => 2,
        ]);
        MetaLocation::create([
            "location_title" => "location 4",
            "meta_unit_id" => 2,
        ]);


    }
}