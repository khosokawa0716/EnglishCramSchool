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
        // $request->validate([
        //     'title' => 'required|string|min:3|max:60',
        //     'type' => 'required',
        //     'minimum_amount' => 'nullable|integer|min:1000|max:10000000',
        //     'max_amount' => 'nullable|integer|min:1000|max:10000000|gte:minimum_amount',
        //     'detail' => 'required|string|min:3|max:1000'
        // ]);

        $wordQuestion->group = $request['group'];
        $wordQuestion->japanese = $request['japanese'];
        $wordQuestion->choice1 = $request['choice1'];
        $wordQuestion->choice2 = $request['choice2'];
        $wordQuestion->choice3 = $request['choice3'];
        $wordQuestion->answer = $request['answer'];

        $wordQuestion->save();

        // return $wordQuestion;
    }
}
