<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class RecordController extends Controller
{
    public function index()
    {
        $records = Record::with('appointment', 'doctor')->get();
        return response()->json($records);
    }

    public function show($id)
    {
        $record = Record::with('appointment', 'doctor')->find($id);
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        return response()->json($record);
    }

    public function getDoctorRecords($doctorId)
{
    $records = DB::table('records')
        ->join('appointments', 'records.appointment_id', '=', 'appointments.id')
        ->join('users', 'appointments.patient_id', '=', 'users.id')
        ->select(
            'records.*',
            'users.name as patient_name',
            'users.gender as patient_gender',
            'users.age as patient_age',
            'appointments.appointment_date',
            'appointments.description'

        )
        ->where('appointments.doctor_id', $doctorId)
        ->get();

    return response()->json($records);
}

public function getPatientRecord($patientId)
{
    $records = DB::table('records')
        ->join('appointments', 'records.appointment_id', '=', 'appointments.id')
        ->join('users', 'appointments.patient_id', '=', 'users.id')
        ->select(
            'records.*',
            'users.name as patient_name',
            'users.gender as patient_gender',
            'users.age as patient_age',
            'appointments.appointment_date',
            'appointments.description'

        )
        ->where('appointments.patient_id', $patientId)
        ->get();

    return response()->json($records);
}


 


        public function updateRecord(Request $request, $id)
        {
            $validated = $request->validate([
                'findings' => 'required|string',
                'payment_status' => 'required|in:Pending,Paid,Cancelled',
            ]);

            $record = Record::findOrFail($id);
            $record->findings = $validated['findings'];
            $record->payment_status = $validated['payment_status'];
            $record->save();

            return response()->json([
                'message' => 'Record updated successfully.',
                'record' => $record,
            ]);
        }


public function getRecord($id)
{
    $record = Record::with('appointment.patient')->findOrFail($id);

    return response()->json([
        'record' => $record,
    ]);
}

    public function destroy($id)
    {
        $record = Record::findOrFail($id);
        $record->delete();

        return response()->json(null, 204);
    }
}