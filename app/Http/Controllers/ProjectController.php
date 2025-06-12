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
            'description' => 'nullable|string|min:10|max:200',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $project = new Project();
        $project->name = $request->name;
        $project->user_id = $request->user_id;
        $project->description = $request->description;
        $project->status = $request->status;
        $project->save();
        return response()->json(['message' => "Project Created successfully"], 200);
    }
    public function editProject(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:25',
            'description' => 'nullable|string|min:10|max:200',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $project = Project::find($id);
        $project->name = $request->name;
        $project->description = $request->description;

        $project->status = $request->status;
        $project->save();
        return response()->json(['message' => "Project data updated successfully"], 200);
    }
    public function getAllProjects()
    {
        $projects = Project::get();
        return response()->json(['projects' => $projects], 200);
    }
    public function deleteProject(Request $request)
    {
        $project = Project::find($request->id);
        $project->delete();
        return response()->json(['message' => "project Deleted succesfully"]);
    }
}
