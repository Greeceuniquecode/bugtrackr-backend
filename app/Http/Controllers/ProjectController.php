<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
  public function createProject(Request $request) 
  {
     $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $project = new Project();
        $project->name = $request->name;
        $project->user_id=$request->user_id;
        $project->description=$request->description;
        $project->status=$request->status;
        $project->save();
        return response()->json(['message' => "Project Created successfully"], 200);
    }
    public function editProject(Request $request){
 $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $project = Project::find($request->id);
        $project->name = $request->name;
        $project->save();
        return response()->json(['message' => "Project data updated successfully"], 200);
    }
  }

