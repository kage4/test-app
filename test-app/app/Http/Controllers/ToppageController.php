<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timeline;
use Illuminate\Support\Facades\Storage;
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

            $request->validate([
                'body' => 'required|max:255',
                'image' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $imagepath = null;
            if ($request->file('image')) {
                $imagepath = $request->file('image')->store('uploads', 'public');
            }
            Timeline::create([
                'body' => $request->body,
                'user_id' => auth()->id(),
                'image_path' => $imagepath,
            ]

            );
            //return back();
            $timelines=Timeline::all();
            return redirect()->route('toppage')->with('message','投稿が完了しました！');
        }


        public function show($id){
            $timeline=Timeline::find($id);
            return view('post.test-page', compact('timeline'));
        }
        public function destroy($id){

                $timeline = Timeline::find($id);

                if ($timeline) {
                    if ($timeline->image_path) {
                        Storage::disk('public')->delete($timeline->image_path);
                    }
                    $timeline->delete();
                    return response()->json(['success' => true]);
                } else {
                    return response()->json(['success' => false], 404);
                }
            }
        }


