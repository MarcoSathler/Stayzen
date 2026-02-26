<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserServiceRelationSeeder extends Seeder
{
    public function run(): void
    {
        
        for ($i = 0; $i < 50; $i++) {
            $serviceId = $i + 1;

            $userId = 2 + floor($i / 5);

            DB::table('users_services')->insert([
                'user_id' => $userId,
                'service_id' => $serviceId,
            ]);
        }
    }
}
