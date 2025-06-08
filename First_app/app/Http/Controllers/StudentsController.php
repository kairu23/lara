<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Students::orderBy('id', 'desc')->get();
        if(Session::has('loginID')){
            $students = User::where('id', '=', Session::get('loginID'))->first();
        }
        return view('studentList', compact('students'));
    }
    

    public function newStudent(Request $request)
    {
        $request->validate([
            'stdName' => 'required|max:255',
            'stdAge' => 'required|numeric',
        ]);

        $input['name'] = $request->stdName;
        $input['age'] = $request->stdAge;
        Students::create($input);

        return redirect()->route('std.index')->with('success', 'Student created successfully.');
    }

    public function destroy($id)
    {
        $student = Students::findOrFail($id);
        $student->delete();
        return redirect()->route('std.index')->with('success', 'Student deleted successfully.');
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'stdName' => 'required|string|max:255',
            'stdAge' => 'required|integer|min:1',
        ]);

        $student = Students::findOrFail($id);
        $student->name = $request->stdName;
        $student->age = $request->stdAge;
        $student->save();

        return redirect()->route('std.index')->with('success', 'Student Updated!');

    }
    
}