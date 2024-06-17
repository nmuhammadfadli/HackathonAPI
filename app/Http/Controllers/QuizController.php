<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    public function index()
    {
       
        $quizzes = DB::table('quizzes as q')
            ->leftJoin('questions as qu', 'q.id_quiz', '=', 'qu.id_quiz')
            ->leftJoin('options as o', 'qu.question_id', '=', 'o.question_id')
            ->select('q.id_quiz', 'q.title', 'q.created_at', 'qu.question_id', 'qu.content', 'o.option_id', 'o.content as option_content', 'o.is_correct')
            ->get();

       
        $groupedQuizzes = [];
        foreach ($quizzes as $quiz) {
            if (!isset($groupedQuizzes[$quiz->id_quiz])) {
                $groupedQuizzes[$quiz->id_quiz] = [
                    'id_quiz' => $quiz->id_quiz,
                    'title' => $quiz->title,
                    'created_at' => $quiz->created_at,
                    'questions' => []
                ];
            }

            if (!isset($groupedQuizzes[$quiz->id_quiz]['questions'][$quiz->question_id])) {
                $groupedQuizzes[$quiz->id_quiz]['questions'][$quiz->question_id] = [
                    'question_id' => $quiz->question_id,
                    'content' => $quiz->content,
                    'options' => []
                ];
            }

            if ($quiz->option_id) {
                $groupedQuizzes[$quiz->id_quiz]['questions'][$quiz->question_id]['options'][] = [
                    'option_id' => $quiz->option_id,
                    'content' => $quiz->option_content,
                    'is_correct' => $quiz->is_correct
                ];
            }
        }

      
        $formattedQuizzes = array_values($groupedQuizzes);

        return response()->json($formattedQuizzes);
    }
}
