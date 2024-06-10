<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;

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
            $users = User::find($id);
    
            return response()->json($users);
           
        } else {
            $users = User::all();
         
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'status' => 'required|string|in:Active,Deactivated',
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return response()->json(['message' => 'User updated successfully'], 200);
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
