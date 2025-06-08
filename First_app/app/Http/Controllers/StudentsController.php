<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Students::all();
        return view('studentList', compact('students'));
    }

    public function newStudent(Request $request)
    {
        $request->validate([
            'stdName' => 'required|max:300',
            'stdAge' => 'required|numeric',
        ]);

        $input['name'] = $request->stdName;
        $input['age'] = $request->stdAge;
        Students::create($input);

        return redirect()->route('std.index')->with('success', 'Student created successfully.');
    }

    public function destroy($id)
{
    $student = Students::find($id);

    if (!$student) {
        return redirect()->back()->with('error', 'Student not found.');
    }

    $student->delete();
    return redirect()->back()->with('success', 'Student deleted successfully.');
}
public function update(Request $request, $id)
{
    $request->validate([
        'stdName' => 'required|string|max:255',
        'stdAge' => 'required|integer',
    ]);

    $student = Students::find($id);

    if (!$student) {
        return redirect()->back()->with('error', 'Student not found.');
    }

    $student->name = $request->stdName;
    $student->age = $request->stdAge;
    $student->save();

    return redirect()->back()->with('success', 'Student updated successfully.');
}

    
}