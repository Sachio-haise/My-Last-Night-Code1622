<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $users = User::paginate(10);
        return view('admin.users.index',['users'=>$users]);




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create',['roles'=>Role::all()]);
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
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique(User::class),

        ],
        'password'=> 'required',

       ]);

         $user =  User::create([
        'name' => $request->name,
        'email' =>$request->email,
        'password' => Hash::make($request->password),
    ]);
     $user->roles()->sync($request->roles);
     return redirect(route('admin.users.index'))->with('success','Successfully Created!');

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
         return view('admin.users.edit',[
             'roles' => Role::all(),
             'user' => User::find($id)
         ]);
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
     /*  $user = User::findOrFail($id);
       $user->update($request->except(['_token','roles']));
       $user->roles()->sync($request->roles);
       return redirect(route('admin.users.index'));
  */
       $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',

        ],

       ]);
        $user  = User::findOrFail($id);
         $user->update([
        'name' => $request->name,
        'email' =>$request->email,
        'password' => Hash::make($request->password),
          ]);
     $user->roles()->sync($request->roles);
     return redirect(route('admin.users.index'))->with('success','Successfully Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(User::destroy($id)){
            return redirect(route('admin.users.index'))->with('success','Successfully Deleted!');
        }else{
              return "Error!";
        }
    }
}
