<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timeline;

class ToppageController extends Controller
{
    public function index(){
        $timelines = Timeline::with('user')->get();
        return view ('post.test-page', compact('timelines'));
    }

    // public function create(){
    //     return view('post.test-page');
    // }

        public function store(Request $request){
            Timeline::create([
                'body' => $request->body,
                'user_id' => auth()->id()
            ]

            );

            $request->session()->flash('message', '保存しました');

            //return back();
            $timelines=Timeline::all();
            return view ('post.test-page', compact('timelines'));
        }


        public function show($id){
            $timeline=Timeline::find($id);
            return view('post.test-page', compact('timeline'));
        }
    }
    //

