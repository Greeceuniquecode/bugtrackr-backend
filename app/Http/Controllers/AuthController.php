<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        if (isset($request->image)) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('images/user/', $image_new_name);
            $imagePath = 'images/user/' . $image_new_name;
        } else {
            $imagePath = 'images/user/default.jpg';
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->address =$request->address;
        $user->image = $imagePath;
        $user->save();
        return response()->json(['message' => "Signed Up successfully"], 200);
    }
    public function editUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        if (isset($request->image)) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('images/user/', $image_new_name);
            $imagePath = 'images/user/' . $image_new_name;
        } else {
            $imagePath = 'images/user/default.jpg';
        }
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->image = $imagePath;
        $user->save();
        return response()->json(['message' => "User data updated successfully"], 200);
    }
    public function getuser()
    {
        $user = User::get();
        return response()->json(['user' => $user], 200);
    }
    public function login(Request $request)
    {
        $user = User::where("email", $request->email)->first();
        if ($user == null) {
            return response()->json(['message' => "user does not exist"], 404);
        } else {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return response()->json(['message' => "user logged in succefully","user"=>$user], 200,);
            }
            return response()->json(['message' => "Incorrect Password"], 404);
        }
    }
    public function logout()
    {
        $user = Auth::user();
        Auth::logout($user);
        return response()->json(['message' => "user logged out succefully"], 200,);
    }
    public function getAuthUser()
    {
        $user = Auth::user();
        return response()->json(['user' => $user], 200,);
    }
}
