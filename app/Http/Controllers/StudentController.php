<?php

namespace App\Http\Controllers;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $students = Student::orderBy('id','desc')->paginate(5);
        return view('students.index', compact('students'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('students.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(StudentStoreRequest $request)
    {

        Student::create($request->post());

        return redirect()->route('student.index')->with('success','Student has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Student  $students
    * @return \Illuminate\Http\Response
    */
    public function show(Student $students)
    {
        return view('students.show',compact('students'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Student  $students
    * @return \Illuminate\Http\Response
    */
    public function edit(Student $students ,$id)
    {
        $students = Student::find($id);
        return view('students.edit',compact('students'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Student  $students
    * @return \Illuminate\Http\Response
    */
    public function update(StudentUpdateRequest $request, Student $students)
    {

        $students->fill($request->post())->save();

        return redirect()->route('student.index')->with('success','Student Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Student  $students
    * @return \Illuminate\Http\Response
    */
    public function destroy(Student $students)
    {
        $students->delete();
        return redirect()->route('students.index')->with('success','Company has been deleted successfully');
    }
}


