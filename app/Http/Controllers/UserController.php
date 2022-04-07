<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function home(){
        dd("login as user");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if($req->has('searchUser')){
            $search = $req->searchUser;
            $user = User::where('name','like','%'.$search.'%')->
                          orderBy('id','DESC')->paginate(5);
        }else{
            $user = User::orderBy('id','asc')->paginate(5);
        }       
        return view('admin.user.index',['users'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'role' => ['required'],
        ]);
        $data = New User();
        $data->name = $req->name;
        $data->email = $req->email;
        $data->password = Hash::make($req->password);
        $data->role =$req->role;
        $data->save();
        if($data){
            return back()->with(['success'=>'A User has been Saved!']);
        }else{
            return back()->with(['fail'=>'A User can not Save!']);
        }
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
        $userEdit = User::find($id);
        return view('admin.user.update',['userEdit'=>$userEdit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {   
        $data = User::find($id);
        $this->validate($req,[
            'name' =>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$data->id,
            'password' => 'required|string|min:3|confirmed',
            'role' => 'required',
        ]);
        
        $data->name = $req->name;
        $data->email = $req->email;
        $data->password = Hash::make($req->password);
        $data->role =$req->role;
        $data->save();
        if($data){
            return back()->with(['success'=>'A User has been Saved!']);
        }else{
            return back()->with(['fail'=>'A User can not Save!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        if($user){
            return back()->with(['success'=>'A user has been deleted!']);
        }else{
            return back()->with(['fail'=>'Can not delete!']);
        }
    }
}
