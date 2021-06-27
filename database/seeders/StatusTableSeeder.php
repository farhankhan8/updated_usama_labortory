<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('statuses')->insert(array(
            array(
                'Sname' => "Progressing",
            ),
            array(
                'Sname' => "Verified",

            ),
            array(
                'Sname' => "Not Received",

            ),
            array(
                'Sname' => "Cancelled",

            ),
        ));
    }
}
