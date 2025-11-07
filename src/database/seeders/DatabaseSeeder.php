<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            WeightTarget::factory()->create([
                'user_id' => $user->id,
            ]);

            WeightLog::factory(10)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
