<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'nik' => 'nullable|string|unique:teachers,nik',
            'nuptk' => 'nullable|string|unique:teachers,nuptk',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:L,P',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'subject_specialization' => 'nullable|string',
            'education' => 'nullable|string',
            'hire_date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('teacher');

        Teacher::create([
            'user_id' => $user->id,
            'nik' => $request->nik,
            'nuptk' => $request->nuptk,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'subject_specialization' => $request->subject_specialization,
            'education' => $request->education,
            'hire_date' => $request->hire_date,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('teachers.index')->with('success', 'Guru berhasil ditambahkan');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('user');
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'password' => 'nullable|min:6|confirmed',
            'nik' => 'nullable|string|unique:teachers,nik,' . $teacher->id,
            'nuptk' => 'nullable|string|unique:teachers,nuptk,' . $teacher->id,
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:L,P',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'subject_specialization' => 'nullable|string',
            'education' => 'nullable|string',
            'hire_date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $user = $teacher->user;
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $teacher->update([
            'nik' => $request->nik,
            'nuptk' => $request->nuptk,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'subject_specialization' => $request->subject_specialization,
            'education' => $request->education,
            'hire_date' => $request->hire_date,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Data guru berhasil diupdate');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->user->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Guru berhasil dihapus');
    }
}