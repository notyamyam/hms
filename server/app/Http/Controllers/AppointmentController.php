<?php

namespace App\Http\Controllers;
use App\Models\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('patient', 'doctor')->get();
        return response()->json($appointments);
    }

    public function show(Request $request)
    {
        $patient_id = $request->query('patient_id');
    
        $query = DB::table('appointments')
            ->join('users', 'appointments.doctor_id', '=', 'users.id')
            ->select('appointments.*', 'users.name as doctor_name')
            ->where('appointments.patient_id', '=', $patient_id);
        \Log::info($query->toSql());
    
        $appointments = $query->get();
    
        return response()->json($appointments);
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'status' => 'required|string',
            'appointment_date' => 'required|date',
        ]);
    
        $appointment = DB::table('appointments')->insert([
            'patient_id' => $request->input('patient_id'),
            'doctor_id' => $request->input('doctor_id'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'appointment_date' => $request->input('appointment_date'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return response()->json($appointment, 201);
    }
    

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'patient_id' => 'exists:users,id',
            'doctor_id' => 'exists:users,id',
            'description' => 'string',
            'status' => 'string',
            'appointment_date' => 'date',
        ]);

        $appointment->update($request->all());

        return response()->json($appointment);
    }


    

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return response()->json(null, 204);
    }
}
