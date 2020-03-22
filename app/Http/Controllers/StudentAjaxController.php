<?php

namespace App\Http\Controllers;

use App\Student_ajax;
use Illuminate\Http\Request;
use App\Mail\Host;
use Mail;

class StudentAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student_ajax.index');
    }

    public function studentlist(Request $request)
    {
        $student_list['perpage'] = $perpage = $request->input('perpage', 10);
        $page = $request->input('page', 1);
        $student_list['search'] = $search = $request->search;
        $sorting = $request->sorting;
        $sortingOrder = $request->sortingOrder;
        $student_list['sl'] = (($page-1)*$perpage)+1;
        $student_list['sorting'] = $sorting;
        $student_list['sortingOrder'] = $sortingOrder;
        $sortingField = ["student_name", "roll", "phone_number", "address"];
        if($sorting>0){
          $sorting = $sortingField[$sorting-1];
        } else {
          $sorting = "id";
          $sortingOrder = "desc";
        }

        $student_list['data'] = Student_ajax::orderBy($sorting, $sortingOrder)
        ->when($search, function($query)use ($search) {
          $query->where('student_name', 'like', "%{$search}%")
          ->orWhere('roll', 'like', "%{$search}%")
          ->orWhere('phone_number', 'like', "%{$search}%")
          ->orWhere('address', 'like', "%{$search}%");
        })
        ->paginate($perpage);
        return view('student_ajax.student_list', $student_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student_ajax.create');
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
          'roll'         => 'required',
          'phone_number' => 'required',
          'address'      => 'required'
        ]);
        $data = [
          'student_name' => $request->student_name,
          'roll'         => $request->roll,
          'phone_number' => $request->phone_number,
          'address'      => $request->address
        ];

        $id = $request->id;
        if($id) {
          //Update
          Student_ajax::where('id', $id)->update($data);
          $response = [
            'msgType' => 'success',
            'message' => 'Data Updated Successfully'
          ];
        } else {
          //Insert
          Student_ajax::create($data);
          $response = [
            'msgType' => 'success',
            'message' => 'Data Inseted Successfully'
          ];
        }


        echo json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student_ajax  $student_ajax
     * @return \Illuminate\Http\Response
     */
    public function show(Student_ajax $student_ajax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student_ajax  $student_ajax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student_list['data'] = Student_ajax::find($id);
        return view('student_ajax.edit', $student_list);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student_ajax  $student_ajax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student_ajax $student_ajax)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student_ajax  $student_ajax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student_ajax::where('id', $id)->delete();
        $response = [
          'msgType' => 'success',
          'message' => 'Data Deleted Successfully'
        ];
        echo json_encode($response);
    }
}
