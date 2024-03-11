<?php

namespace Database\Seeders;

use App\DiscussionReply;
use Illuminate\Database\Seeder;

class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<400;$i++){
            DiscussionReply::create([
                'discussion_id'=>42,
                'reply'=>'This is a message: '.$i,
                'user_id'=>6
            ]);
        }
    }
}
