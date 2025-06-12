<?php

namespace App\Http\Controllers;

use App\Models\Bugs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BugsController extends Controller
{
    public function createBug(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|min:10|max:200',
            'code'=>'required|string|min:10|max:10000',

        ]);
         if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $bugs = new Bugs();
        $bugs->title = $request->title;
        $bugs->user_id = $request->user_id;
        $bugs->project_id = $request->project_id;
        $bugs->code=$request->code;
        $bugs->description = $request->description;
        $bugs->status = $request->status;
        $bugs->save();
        return response()->json(['message' => "Code uploaded successfully"], 200);

    }
    public function editBug(Request $request,$id){
  $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|min:10|max:200',
            'code'=>'required|string|min:40|max:10000',
            'id'=>'required',
        ]);
         if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $bugs = Bugs::find($id);
        $bugs->title = $request->title;
        $bugs->user_id = $request->user_id;
        $bugs->project_id = $request->project_id;
        $bugs->code=$request->code;
        $bugs->description = $request->description;
        $bugs->status = $request->status;
        $bugs->save();
        return response()->json(['message' => "Code updated successfully"], 200);
    }
      public function getBug(Request $request ){
        $bug= Bugs::find($request->id);
        return response()->json(['bug'=>$bug]);
    }
    public function getAllBugs($id){
        $bugs = Bugs::where('project_id', $id)->get();
        return response()->json(['bugs'=>$bugs]);
    }
}
