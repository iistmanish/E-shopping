<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    public function index(Request $request)
    {
        $search = $request->input('search');
        $studentsPerPage = 5; // Change this as needed
    
        $query = Student::query();
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('phone', 'LIKE', "%$search%")
                    ->orWhere('city', 'LIKE', "%$search%");
            });
        }
    
        $students = $query->paginate(5);
    
        return view('students.index', compact('students'));
    }
    

    public function trashed_students()
    {
        $students = Student::onlyTrashed()->paginate(5);
        // $students = Student::appends(['sort'=>'votes']);
        return view('students.trash-index', ['students' => $students]);
    }

    public function restore($id)
    {
        $students = Student::withTrashed()->findOrFail($id);
        if(!empty($students)){
            $students->restore();
        }
        return redirect()->route('students.index')->with('success','Student restored successfully.');
    }
    public function deletePermanently($id)
    {
        $students = Student::withTrashed()->findOrFail($id);
        if(!empty($students)){
            $students->forceDelete();
        }
        return redirect()->route('students.index')->with('success','Student deleted Permanently successfully.');
    }

    public function create()
    {
        return view('students.create');
    }

    
    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email',
        'password' => 'required|string|min:6',
        'phone' => 'required|numeric|min:10|unique:students,phone',
        'city' => 'required|string|max:255',
    ]);

    // Hash the password before storing it
    $data['password'] = Hash::make($request->password);

    $newStudent = Student::create($data);
    return redirect()->route('students.index')->with('success', 'Student created successfully');
}

    public function edit(Student $student)
    {
        return view('students.edit', ['student' => $student]);
    }

  
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'password' => 'required',
            'phone' => 'required|numeric|min:10|unique:students,phone,' . $student->id,
            'city' => 'required',
        ]);
    
        $student->update($data);
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }
    // public function trash(Student $student)
    // {
    //     // $students = Student::onlyTrashed()->paginate(2);
    //     $students = Student::paginate(2);
    //     // $students = Student::appends(['sort'=>'votes']);
    //     return view('trash', ['students' => $students]);
    // }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
