<?php

use Illuminate\Database\Seeder;
use App\Province;

class ProvincesTableSeeder extends Seeder
{
    protected $table    = 'provinces';
    protected $values   =
    [
        'Bulawayo',
        'Harare Province',
        'Manicaland',
        'Mashonaland Central',
        'Mashonaland East',
        'Mashonaland West',
        'Masvingo',
        'Matabeleland North',
        'Matabeleland South',
        'Midlands',
    ];

    public function run()
    {
        DB::table($this->table)->truncate();

        foreach ($this->values as $value)
        {
            $model          = new Province();
            $model->name    = $value;
            $model->save();
        }
    }
}