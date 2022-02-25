<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('clinic_types')->insert([
            [
                'type_of_clinic' => "dental",
            ],
            [
                'type_of_clinic' => "medical",
            ],

        ]);

        DB::table('appointment_status')->insert([
            [
                'status' => "done",
                'remark' => "success",
            ],
            [
                'status' => "pending",
                'remark' => "warning",
            ],
            [
                'status' => "declined",
                'remark' => "danger",
            ],
            [
                'status' => "accepted",
                'remark' => "primary",
            ],
            [
                'status' => "negotiating",
                'remark' => "muted",
            ],
            [
                'status' => "expired",
                'remark' => "danger",
            ],
            [
                'status' => "deleted",
                'remark' => "danger",
            ],
        ]);
    }
}
