<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function index($id = null)
    {
        try {
            $users = User::all(['id', 'name', 'email', 'password', 'age', 'gender', 'user_Type']);
            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve users'], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|min:1',
                'confirm_password' => 'required|min:1|same:password', 
                'age' => 'required|integer',
                'gender' => 'required|string|max:255',
                'user_Type' => 'required|string|max:255',
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'age' => $request->age,
                'gender' => $request->gender,
                'user_Type' => $request->user_Type,
            ]);

            Log::info('User created successfully: ' . $user->id);
            return response()->json($user, 201);

        } catch (ValidationException $e) {

            Log::error('Validation errors occurred: ' . json_encode($e->errors()));
            return response()->json(['error' => $e->errors()], 422);

        } catch (\Exception $e) {

            Log::error('Failed to create user: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create user'], 500);
            
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:users,email,'.$id,
                'password' => 'sometimes|min:1',
                'confirm_password' => 'sometimes|min:1|same:password',
                'age' => 'sometimes|required|integer',
                'gender' => 'sometimes|string|max:255',
                'user_Type' => 'sometimes|string|max:255',
            ]);
    
            $user = User::find($id);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
    
            if ($request->has('name')) {
                $user->name = $request->name;
            }
    
            if ($request->has('email')) {
                $user->email = $request->email;
            }
    
            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }
    
            if ($request->has('age')) {
                $user->age = $request->age;
            }
    
            if ($request->has('gender')) {
                $user->gender = $request->gender;
            }
    
            if ($request->has('user_Type')) {
                $user->user_Type = $request->user_Type;
            }
    
            $user->save();
    
            Log::info('User updated successfully: ' . $user->id);
            return response()->json(['message' => 'User profile updated successfully'], 200);
    
        } catch (QueryException $e) {
            Log::error('Database error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'Database error: '.$e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::error('Failed to update user: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
    
    

    public function destroy($id)
    {
        $appointment = User::findOrFail($id);
        $appointment->delete();

        return response()->noContent();
    }
    
}
