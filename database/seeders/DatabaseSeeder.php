<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $quiz1 = Quiz::create(['title' => 'Geografi Indonesia']);
        $question1 = Question::create(['id_quiz' => $quiz1->id, 'content' => 'Apa ibu kota Indonesia?']);
        Option::create(['question_id' => $question1->id, 'content' => 'Jakarta', 'is_correct' => true]);
        Option::create(['question_id' => $question1->id, 'content' => 'Bandung', 'is_correct' => false]);
        Option::create(['question_id' => $question1->id, 'content' => 'Surabaya', 'is_correct' => false]);
        Option::create(['question_id' => $question1->id, 'content' => 'Medan', 'is_correct' => false]);

        $question2 = Question::create(['id_quiz' => $quiz1->id, 'content' => 'Berapa jumlah provinsi di Indonesia?']);
        Option::create(['question_id' => $question2->id, 'content' => '34', 'is_correct' => true]);
        Option::create(['question_id' => $question2->id, 'content' => '33', 'is_correct' => false]);
        Option::create(['question_id' => $question2->id, 'content' => '35', 'is_correct' => false]);
        Option::create(['question_id' => $question2->id, 'content' => '32', 'is_correct' => false]);

        $quiz2 = Quiz::create(['title' => 'Sejarah Indonesia']);
        $question3 = Question::create(['id_quiz' => $quiz2->id, 'content' => 'Siapa proklamator kemerdekaan Indonesia?']);
        Option::create(['question_id' => $question3->id, 'content' => 'Soekarno-Hatta', 'is_correct' => true]);
        Option::create(['question_id' => $question3->id, 'content' => 'Soekarno', 'is_correct' => false]);
        Option::create(['question_id' => $question3->id, 'content' => 'Hatta', 'is_correct' => false]);
        Option::create(['question_id' => $question3->id, 'content' => 'Sukarno', 'is_correct' => false]);
    }
}
