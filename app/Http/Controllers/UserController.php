<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'name' => 'required|string|min:5|max:30',
            'phone' => 'required|digits_between:13,15',
            'email' => 'required|email',
            'gender' => 'required',
            'dob' => 'required|before:-18 years',
            'biography' => 'required|min:10|max:100',
            'image' => 'required|file|mimes:jpeg,bmp,png|max:1024',

        ]);

        $requestData = $request->all();

        // save image if uploaded
        if ($request->hasFile('image')) {
            $image = file_get_contents($request->file('image'));

            $image = base64_encode($image);
            $requestData['image'] = $image;

        } else {
            //dd('nothing', $request->all());
        }

        $user = User::create($requestData);

        return response(['message' => 'created', 'user_id' => $user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response([
            'message' => 'USER DETAIL',
            'user' => $user
        ]);
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
