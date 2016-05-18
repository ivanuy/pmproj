<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Users;

class UsersController extends Controller
{
    private $rules = [
            'name' => 'required|min:5',
            'email' => ['required', 'min:10'],
            'phone' => ['required', 'min:12'],
            'address' => ['required', 'min:8']
    ];

    private $uploadPhotoDest;

    public function __construct()
    {
        $this->uploadPhotoDest = public_path() . '/uploads/';
    }

    public function index()
    {
        //$users = Users::all(); view all users
        //paginate user list
        $users = Users::orderBy('id', 'desc')->paginate(6);

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        //$validator = Validator::make($request->all(), $rules);
        $this->validate($request, $this->rules);
        $data = $this->getRequest($request);

        Users::create($data);

        return redirect('users')->with('message', 'Created Successfully');
    }

    public function getRequest(Request $request)
    {
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->getClientOriginalName();
            //file to server
            $destination = $this->uploadPhotoDest;
            $request->file('photo')->move($destination, $photo);
            $data['photo'] = $photo;
        }

        // BUG :: on edit user no selected photo
        // $data = $request->all();

        return $data;
    }

    public function update($id, Request $request)
    {
        //$validator = Validator::make($request->all(), $rules);

        $this->validate($request, $this->rules);
        $user = Users::find($id);
        $data = $this->getRequest($request);
        $user->update($data);

        return redirect('users')->with('message', 'Updated Successfully');
    }

    public function edit($id)
    {
        $user = Users::find($id);
        return view('users.edit', compact('user'));
    }

    public function destroy($id)
    {
        $user = Users::find($id);

        if (!is_null($user->photo)) {
            $file_path = $this->uploadPhotoDest . '/' . $user->photo;

            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $user->delete();

        return redirect('users')->with('message', 'Deleted Successfully');
    }
}
