<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $about = About::first();
        if (!$about) {
            $about = new About();
        }

        $about->name = "Besafe";
        $about->description = "Besafe is project of Service shoes safety department";
        $about->detail = "This app is used for safety related issues in workplace";
        $about->address = "Karachi Pakistan";
        $about->phone = "0313269631";
        $about->email = "admin@besafe.com";
        $about->mailing = "Karach Pakistan";
        $about->website = "https://www.website.com";
        $about->fax = "-3132696111";
        $about->save();
    }
}