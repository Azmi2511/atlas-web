<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'ClassRoom'])->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classrooms = ClassRoom::all();
        return view('admin.students.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'nisn' => 'required|string|unique:students,nisn',
            'class_id' => 'nullable|exists:classrooms,id',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:L,P',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'father_name' => 'nullable|string',
            'mother_name' => 'nullable|string',
            'parent_phone' => 'nullable|string',
            'admission_year' => 'nullable|digits:4',
            'is_active' => 'boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('student');

        Student::create([
            'user_id' => $user->id,
            'class_id' => $request->class_id,
            'nisn' => $request->nisn,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'parent_phone' => $request->parent_phone,
            'admission_year' => $request->admission_year,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function show(Student $student)
    {
        $student->load(['user', 'ClassRoom']);
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classrooms = ClassRoom::all();
        return view('admin.students.edit', compact('student', 'classrooms'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'password' => 'nullable|min:6|confirmed',
            'nisn' => 'required|string|unique:students,nisn,' . $student->id,
            'class_id' => 'nullable|exists:classrooms,id',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:L,P',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'father_name' => 'nullable|string',
            'mother_name' => 'nullable|string',
            'parent_phone' => 'nullable|string',
            'admission_year' => 'nullable|digits:4',
            'is_active' => 'boolean',
        ]);

        $user = $student->user;
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $student->update([
            'class_id' => $request->class_id,
            'nisn' => $request->nisn,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'parent_phone' => $request->parent_phone,
            'admission_year' => $request->admission_year,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil diupdate');
    }

    public function destroy(Student $student)
    {
        $student->user->delete();
        return redirect()->route('admin.students.index')->with('success', 'Siswa berhasil dihapus');
    }
}