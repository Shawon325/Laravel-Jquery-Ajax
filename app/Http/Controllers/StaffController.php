<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Designation;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff.index');
    }

    public function staffList(Request $request)
    {
        $staff['perpage'] = $perpage = $request->input('perpage', 10);
        $page = $request->input('page', 1);
        $staff['search'] =  $search      = $request->search;
        $staff['sl'] = (($page-1)*$perpage)+1;
        $staff['sorting'] = $sorting = $request->sorting;
        $staff['sortingOrder'] = $sortingOrder = $request->sortingOrder;
        $sortingField = ["name", "designation", "gender", "email", "number", "address"];
        if($sorting>0){
            $sorting = $sortingField[$sorting-1];
        } else {
            $sorting = "id";
            $sortingOrder = "desc";
        }

        $staff['data'] = Staff::select('staff.*', 'designation.designation_name')
        ->leftJoin('designation', 'staff.designation', '=', 'designation.id')
        ->when($search, function($query)use ($search) {
            $query->where('name', 'like', "%{$search}%")
            ->orWhere('designation_name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('number', 'like', "%{$search}%")
            ->orWhere('address', 'like', "%{$search}%");
        })
        ->orderBy($sorting, $sortingOrder)
        ->paginate($perpage);

        return view('staff.staffList', $staff);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $designation['data'] = Designation::get();
        return view('staff.create', $designation);
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
            'name'        => 'required',
            'designation' => 'required',
            'gender'      => 'required',
            'email'       => 'required|email',
            'number'      => 'required',
            'address'     => 'required'
        ]);
        $staff = [
            'name'        => $request->name,
            'designation' => $request->designation,
            'gender'      => $request->gender,
            'email'       => $request->email,
            'number'      => $request->number,
            'address'     => $request->address
        ];
        $id = $request->id;
        if($id) {
          Staff::where('id', $id)->update($staff);
          $response = [
            'msgType' => 'success',
            'message' => 'Data Updated Successfully'
          ];
        } else {
          Staff::create($staff);
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
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff['des'] = Designation::get();
        $staff['data'] = Staff::find($id);
        return view('staff.edit', $staff);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staff::where('id', $id)->delete();
        $response = [
          'msgType' => 'success',
          'message' => 'Data Deleted Successfully'
        ];

        echo json_encode($response);
    }
}
