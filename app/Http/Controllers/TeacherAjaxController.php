<?php

namespace App\Http\Controllers;

use App\Teacher_ajax;
use Illuminate\Http\Request;
use DB;

class TeacherAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher_ajax.index');
    }

    public function teacherlist(Request $request)
    {
        $teacher_list['perpage'] = $perpage = $request->input('perpage', 10);
        $page = $request->input('page', 1);
        $teacher_list['search'] = $search = $request->search;
        $sorting = $request->sorting;
        $sortingOrder = $request->sortingOrder;
        $teacher_list['sorting'] = $sorting;
        $teacher_list['sortingOrder'] = $sortingOrder;
        $sortingField = ['name', 'department_id', 'gender', 'email', 'phone_number'];
        if($sorting>0) {
          $sorting = $sortingField[$sorting-1];
        } else {
          $sorting = 'id';
          $sortingOrder = 'desc';
        }
        $teacher_list['sl'] = (($page-1)*$perpage)+1;
        $teacher_list['data'] = Teacher_ajax::select('teacher_ajaxes.*', 'department.department_name', 'gender.gender_name')
        ->join('department', 'teacher_ajaxes.department_id', '=', 'department.id')
        ->join('gender', 'teacher_ajaxes.gender', '=', 'gender.id')
        ->when($search, function($query)use($search) {
          $query->where('name', 'like', "%{$search}%")
          ->orWhere('department_id', 'like', "%{$search}%")
          ->orWhere('gender', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%")
          ->orWhere('phone_number', 'like', "%{$search}%");
        })
        ->orderBy($sorting, $sortingOrder)
        ->paginate($perpage);
        return view('teacher_ajax.teacher_list', $teacher_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department['data'] = DB::table('department')->get();
        return view('teacher_ajax.create', $department);
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
          'name'          => 'required',
          'gender'        => 'required',
          'email'         => 'required',
          'phone_number'  => 'required',
          'address'       => 'required'
        ]);
        $data = [
          'name'          => $request->name,
          'department_id' => $request->department,
          'gender'        => $request->gender,
          'email'         => $request->email,
          'phone_number'  => $request->phone_number,
          'address'       => $request->address
        ];
        $id = $request->id;
        if($id) {
          Teacher_ajax::where('id', $id)->update($data);
          $response = [
            'msgType' => 'success',
            'message' => 'Data Updated Successfully'
          ];
        } else {
          Teacher_ajax::create($data);
          $response = [
            'msgType' => 'success',
            'message' => 'Data Inserted Successfully'
          ];
        }

        echo json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher_ajax  $teacher_ajax
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher_ajax $teacher_ajax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher_ajax  $teacher_ajax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher_list['dep'] = DB::table('department')->get();
        $teacher_list['data'] = Teacher_ajax::find($id);
        return view('teacher_ajax.edit', $teacher_list);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher_ajax  $teacher_ajax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher_ajax $teacher_ajax)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher_ajax  $teacher_ajax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Teacher_ajax::where('id', $id)->delete();
        $response = [
          'msgType' => 'success',
          'message' => 'Data Deleted Successfully'
        ];
        echo json_encode($response);
    }
}
