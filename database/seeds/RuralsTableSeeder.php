<?php

use Illuminate\Database\Seeder;
use App\Models\Rural;

class RuralsTableSeeder extends Seeder
{
    public function run()
    {
        $rurals = factory(Rural::class)->times(50)->make()->each(function ($rural, $index) {
            if ($index == 0) {
                // $rural->field = 'value';
            }
        });

        Rural::insert($rurals->toArray());
    }

}

