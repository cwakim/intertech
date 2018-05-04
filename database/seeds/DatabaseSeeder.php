<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domains')->insert([
            'name' => 'bbc',
            'link' => 'http://bbc.com/news',
            'language' => 'en',
            'location' => '12.23, 33.33',
        ]);
        DB::table('pages')->insert([
            'domain_id' => 1,
            'link' => 'http://bbc.com/news',
            'language' => 'en',
            'location' => '12.23, 33.33',
            'location_name' => 'loc name',
            'category' => 'cat',
            'area' => '.nw-c-top-stories--international a.nw-o-link-split__anchor',
            'frequency' => '*/10 * * * *',
            'next_visit_time' => '2016-04-04',
            'last_visit_time' => '2018-04-04',
        ]);
    }
}
