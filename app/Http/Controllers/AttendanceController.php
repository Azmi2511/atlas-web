<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\AttendanceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('user', 'classroom');
        if ($request->filled('class_id')) $query->where('class_id', $request->class_id);
        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('date')) $query->whereDate('date', $request->date);
        $attendances = $query->latest('date')->paginate(20);
        $classrooms = ClassRoom::all();
        return view('admin.attendance.index', compact('attendances', 'classrooms'));
    }

    public function show(Attendance $attendance)
    {
        $attendance->load('user', 'classroom', 'logs.user');
        return view('admin.attendance.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        return view('admin.attendance.edit', compact('attendance'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'note' => 'nullable|string'
        ]);

        $old = $attendance->status;
        $attendance->update([
            'status' => $request->status,
            'verified_by' => auth()->id()
        ]);

        AttendanceLog::create([
            'attendance_id' => $attendance->id,
            'user_id' => auth()->id(),
            'action' => 'update_status',
            'note' => $request->note,
            'old_data' => json_encode(['status' => $old]),
            'new_data' => json_encode(['status' => $request->status])
        ]);

        broadcast(new \App\Events\AttendanceUpdated($attendance))->toOthers();

        return redirect()->route('attendance.index')->with('success', 'Status kehadiran diperbarui');
    }

    public function verifyFace(Attendance $attendance)
    {
        return view('admin.attendance.verify-face', compact('attendance'));
    }

    public function postVerifyFace(Request $request, Attendance $attendance)
    {
        $request->validate(['verified' => 'required|boolean']);
        $attendance->update(['face_matched' => $request->verified, 'verified_by' => auth()->id()]);

        AttendanceLog::create([
            'attendance_id' => $attendance->id,
            'user_id' => auth()->id(),
            'action' => 'verify_face',
            'note' => $request->verified ? 'Foto wajah sesuai' : 'Foto wajah tidak sesuai'
        ]);

        return redirect()->route('admin.attendance.show', $attendance)->with('success', 'Verifikasi wajah selesai');
    }
}