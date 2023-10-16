<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $types = ['Javascript', 'Php', 'VueJs', 'Vite', 'Laravel'];
        foreach ($types as $type) {
            $new_type = new Type();
            $new_type->type = $type;
            $new_type->slug = Str::slug($new_type->type);
            $new_type->save();
    }
}
}
