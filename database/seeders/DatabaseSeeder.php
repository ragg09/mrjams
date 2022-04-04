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
        DB::table('users')->insert([
            [
                'email' => "mr.jams1822@gmail.com",
                'avatar' => "https://lh3.googleusercontent.com/a/AATXAJzErZRv6Ugom2tgr1Xdk8doj-SpAiWPIZEV8ECH=s96-c",
                'role' => "admin",
                'created_at' => "2022-02-25 16:25:30",
                'updated_at' => "2022-02-25 16:25:30",
            ],

        ]);

        DB::table('clinic_types')->insert([
            [
                'type_of_clinic' => "Dental",
            ],
            [
                'type_of_clinic' => "Medical",
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
                'remark' => "dark",
            ],
            [
                'status' => "deleted",
                'remark' => "danger",
            ],
            [
                'status' => "cancelled",
                'remark' => "secondary",
            ],
        ]);

        DB::table('billing_status')->insert([
            [
                'status' => "fully paid",
                'remark' => "success",
            ],
            [
                'status' => "installment",
                'remark' => "danger",
            ],
        ]);
    }
}
