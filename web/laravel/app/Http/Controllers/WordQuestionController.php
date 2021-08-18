<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WordQuestion;

class WordQuestionController extends Controller
{
    /**
     * 単語問題の登録
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\WordQuestion $wordQuestion
     * @return void
     */
    public function create(Request $request, WordQuestion $wordQuestion ) {
        $request->validate([
            'group' => 'required|string|min:1|max:20',
            'japanese' => 'required|string|min:1|max:20',
            'choice1' => 'required|string|min:1|max:30',
            'choice2' => 'required|string|min:1|max:30',
            'choice3' => 'required|string|min:1|max:30',
            'answer' => 'required|integer|min:1|max:3',
        ]);
        $wordQuestion->group = $request['group'];
        $wordQuestion->japanese = $request['japanese'];
        $wordQuestion->choice1 = $request['choice1'];
        $wordQuestion->choice2 = $request['choice2'];
        $wordQuestion->choice3 = $request['choice3'];
        $wordQuestion->answer = $request['answer'];

        $wordQuestion->save();
    }
}
