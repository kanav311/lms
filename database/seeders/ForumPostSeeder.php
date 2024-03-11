<?php

namespace Database\Seeders;

use App\ForumPost;
use Illuminate\Database\Seeder;

class ForumPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<400;$i++){
            ForumPost::create([
                'forum_topic_id'=>3,
                'message'=>'This is a message: '.$i,
                'user_id'=>6
            ]);
        }
    }
}
