<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index');
    }

    public function password(Request $request)
    {
        $password = $request->c_password;
        $match = Hash::check($password, Auth::user()->password);
        if($match) {
          echo "matched";
        } else {
          echo "error";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
          'name'         => 'required',
          'gender'       => 'required',
          'phone_number' => 'required'
        ]);
        if($request->password)
        {
          $update = [
            'name'         => $request->name,
            'gender'       => $request->gender,
            'phone_number' => $request->phone_number,
            'password'     => Hash::make($request->password)
          ];
        } else {
          // $image = $request->file('pic');
          // $file_name = 'blank.png';
          // $base_path = 'image';
          // $image->move($base_path, $file_name);

          // $request->file('pic')->move('image', 'blank.png');

          $update = [
            'name'         => $request->name,
            'gender'       => $request->gender,
            'phone_number' => $request->phone_number
          ];
        }
        User::where('id', Auth::user()->id)->update($update);
        $response = [
          'msgType' => 'success',
          'message' => 'Successfully Data Updated'
        ];

        echo json_encode($response);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
