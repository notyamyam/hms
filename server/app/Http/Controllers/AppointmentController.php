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
    
        $appointments = $query->get();
    
        return response()->json($appointments);
    }
    
    public function showForDoctor(Request $request)
{
    $doctor_id = $request->query('doctor_id');

    $query = DB::table('appointments')
        ->join('users', 'appointments.patient_id', '=', 'users.id')
        ->select('appointments.*', 'users.name as patient_name')
        ->where('appointments.doctor_id', '=', $doctor_id);

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

    public function approveAppointment(Request $request, $id)
{
    $validated = $request->validate([
        'appointment_id' => 'required|exists:appointments,id',
    ]);

    $appointment_id = $validated['appointment_id'];

    DB::transaction(function () use ($appointment_id) {
        DB::table('appointments')
            ->where('id', $appointment_id)
            ->update(['status' => 'Approved']);

        $appointment = DB::table('appointments')->where('id', $appointment_id)->first();

        DB::table('records')->insert([
            'appointment_id' => $appointment_id,
            'doctor_id' => $appointment->doctor_id,
            'findings' => '',
            'payment_status' => 'Pending',
            
        ]);
    });

    return response()->json([
        'message' => 'Appointment approved and record created successfully.'
    ]);
}


    

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return response()->json(null, 204);
    }
}
