<?php

namespace App\Http\Controllers;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Exam;
use Illuminate\Http\Request;
use DB;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('exam.index');
    }

    public function tablelist(Request $request)
    {
      $student_list['perpage'] = $perpage = $request->input('perpage', 10);
      $page = $request->input('page', 1);
      $student_list['search'] = $search = $request->search;
      $sorting = $request->sorting;
      $sortingOrder = $request->sortingOrder;
      $student_list['sl'] = (($page-1)*$perpage)+1;
      $student_list['sorting'] = $sorting;
      $student_list['sortingOrder'] = $sortingOrder;
      $sortingField = ["name", "department_id"];
      if($sorting>0){
        $sorting = $sortingField[$sorting-1];
      } else {
        $sorting = "s_id";
        $sortingOrder = "desc";
      }

      $student_list['data'] = Exam::select('exam_student.*', 'department.department_name')
      ->join('department', 'exam_student.department_id', '=', 'department.id')
      ->when($search, function($query)use ($search) {
        $query->where('name', 'like', "%{$search}%")
        ->orWhere('department_name', 'like', "%{$search}%");
      })
      ->orderBy($sorting, $sortingOrder)
      ->paginate($perpage);
      return view('exam.tablelist', $student_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cource['cor'] = DB::table('cource')->get();
        $department['data'] = DB::table('department')->get();
        return view('exam.create', $department, $cource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $custom_id = IdGenerator::generate(['table' => 'exam_student', 'length' => 6, 'prefix' =>'500-']);
        $request->validate([
          'name'             => 'required',
          'cource'           => 'required|min:5'
        ]);
        $student = [
            'id'             => $custom_id,
            'name'           => $request->name,
            'department_id'  => $request->department
        ];

        // $id = $request->id;
        // if($id) {
        //   //Update
        //   Exam::where('id', $id)->update($data);
        //   $response = [
        //     'msgType' => 'success',
        //     'message' => 'Data Updated Successfully'
        //   ];
        // } else {
          //Insert
          Exam::create($student);
          $cource = $request->cource;
          $cource_input = [];
          foreach ($cource as $cource_id) {
            $cource_input[] = [
              'student_id' => $custom_id,
              'cource_id' => $cource_id,
            ];
          }
          DB::table('student_courcelist')->insert($cource_input);
          $response = [
            'msgType' => 'success',
            'message' => 'Data Inseted Successfully'
          ];
        // }
          echo json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data['cor'] = DB::table('cource')->get();
      $data['dep'] = DB::table('department')->get();
      $cource_data['stdl'] = DB::table('student_courcelist')->where('student_id', $id)->get();
      $cource_input = [];
      foreach ($cource_data as $cource_data) {
          $cource_input[] = $cource_data->cource_id;
      }
      echo "<pre>";
      print_r($cource_input);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Exam::where('s_id', $id)->delete();
      $response = [
        'msgType' => 'success',
        'message' => 'Data Deleted Successfully'
      ];
      echo json_encode($response);
    }
}
