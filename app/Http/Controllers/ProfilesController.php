<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;

class ProfilesController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "email" => "required|unique:profiles|email",
            "password" => "required"
        ]);

        if($validator->fails())
        {
            return response()->json(["Errors" => $validator->errors()], 400);
        }



        Profile::create($request->all());

        return response()->json(["status" => "New profile successfully added to the database"], 201);
    }

    public function find($id)
    {
        $profile = Profile::find($id);

        if(!$profile)
        {
            return response()->json(["status" => "Profile not found"], 404);
        }

        return response()->json(["data" => $profile], 200);
    }

    public function update($id, Request $request)
    {
        $profile = Profile::find($id);

        if(!$profile)
        {
            return response()->json(["status" => "Profile not found"], 404);
        }

        $validator = Validator::make($request->all(),[
            "email" => "required|email",
            "password" => "required"
        ]);

        if($validator->fails())
        {
            return response()->json(["Errors" => $validator->errors()], 400);
        }

        $profile->email = $request->email;
        $profile->password = $request->password;
        $profile->save();

        return response()->json(["status" => "Profile successfully updated"], 200);
    }

    public function delete($id)
    {
        $profile = Profile::find($id);

        if(!$profile)
        {
            return response()->json(["status" => "Profile not found"], 404);
        }

        $profile->delete();

        return response()->json(["status" => "Profile has been successfully deleted"], 200);
    }
}
