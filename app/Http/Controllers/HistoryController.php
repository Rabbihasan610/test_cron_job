<?php

namespace App\Http\Controllers;

use App\Models\MessageHistory;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(){
        $histories = MessageHistory::with('user')->paginate(10);

        return view('history', [
            'histories' => $histories
        ]);
    }
}
