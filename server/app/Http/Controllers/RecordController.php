<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'doctor_id' => 'required|exists:users,id',
        ]);

        $record = Record::create($request->all());
        return response()->json($record, 201);
    }

    public function update(Request $request, $id)
    {
        $record = Record::findOrFail($id);

        $request->validate([
            'appointment_id' => 'exists:appointments,id',
            'doctor_id' => 'exists:users,id',
        ]);

        $record->update($request->all());

        return response()->json($record);
    }

    public function destroy($id)
    {
        $record = Record::findOrFail($id);
        $record->delete();

        return response()->json(null, 204);
    }
}