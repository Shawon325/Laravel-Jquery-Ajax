<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Session;

class Data extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perpage = 10;
        $page = $request->input('page',1);
        $student['sl'] = (($page-1)*$perpage)+1;
        $student['students']= Student::orderBy('id' , 'desc')->paginate($perpage);

        return view('student.index',$student);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'phone_number' => 'required',
            'status'       => 'required'
        ]);
        Student::create($request->all());
        Session::flash('Success' , 'Data Inserted');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student['data'] = Student::find($id);
        return view('student.edit' , $student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'student_name' => 'required',
            'phone_number' => 'required',
            'status'       => 'required'
        ]);
        Student::where('id' , $id)->update($data);
        Session::flash('Success' , 'Data Updated');
        return redirect()->route('student.index' , $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::where('id' , $id)->delete();
        Session::flash('Success' , 'Data Deleted');
        return redirect()->route('student.index');
    }
}
