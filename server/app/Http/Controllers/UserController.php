<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    // public function index()
    // {
    //     $users = User::all();
    //     return response()->json($users);
    // }

    public function index($id = null)
{
    if ($id) {
        $user = DB::table('users')->where('id', $id)->first();
        return response()->json($user);
    } else {
        $users = DB::table('users')->get();
        return response()->json($users);
    }
}

    //trying different approach
    // public function store(Request $request){
    //     try {
    //         $validated = $request->validate([
    //             'name' => 'required|string',
    //             'userType' => 'required|string',
    //             'email' => 'required|email|unique:users,email|string', 
    //             'password' => 'required|string', 
    //         ]);
    //         $validated['password'] = bcrypt($validated['password']);

    //         $validated['status'] = 0;
            
    //         $user = User::create($validated);
            
    //         return response()->json(['message' => 'User created successfully'], 201);
    //     } catch (ValidationException $e) {
    //         return response()->json(['message' => 'Validation error', 'error' => $e->errors()], 422);
    //     }catch (\Exception $e) {
    //         return response()->json(['message' => 'Error occurred while registering user'], 500);
    //     }
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'gender' => 'required',
            'age' => 'required|integer'
        ]);
    
        DB::table('users')
            ->where('id', $id)
            ->update([
                'email' => $request->email,
                'name' => $request->name,
                'gender' => $request->gender,
                'age' => $request->age,
            ]);
    
        return response()->json(['message' => 'User profile updated successfully'], 200);
    }
    

    public function destroy($id)
    {
        $appointment = User::findOrFail($id);
        $appointment->delete();

        return response()->noContent();
    }
    

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
                'user_Type' => 'required|string',
                'status' =>'required|string',
            ]);
            
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->user_Type = $request->user_Type;
            $user->status = $request->status;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred while registering user'], 500);
        }
    }

}
