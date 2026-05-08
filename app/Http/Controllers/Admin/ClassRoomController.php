<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ClassRoomController extends Controller
{
    public function index()
    {
        $classrooms = ClassRoom::with('teacher')->paginate(10);
        return view('admin.classes.index', compact('classrooms'));
    }

    public function create()
    {
        $teachers = User::role('teacher')->get();
        return view('admin.classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'grade' => 'required|string|max:10',
            'teacher_id' => 'nullable|exists:users,id',
            'academic_year' => 'nullable|integer|min:2000|max:2100',
        ]);

        ClassRoom::create($validated);

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit(ClassRoom $class)
    {
        $teachers = User::role('teacher')->get();
        return view('admin.classes.edit', compact('class', 'teachers'));
    }

    public function update(Request $request, ClassRoom $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'grade' => 'required|string|max:10',
            'teacher_id' => 'nullable|exists:users,id',
            'academic_year' => 'nullable|integer|min:2000|max:2100',
        ]);

        $class->update($validated);

        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy(ClassRoom $class)
    {
        $class->delete();
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus');
    }

    public function students(ClassRoom $class)
    {
        $students = $class->students()->paginate(15);
        return view('admin.classes.students', compact('class', 'students'));
    }
}