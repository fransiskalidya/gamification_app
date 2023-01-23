<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get()->pluck('role', 'id');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->only('name','email', 'role_id') + ['password' => bcrypt($request->password)]);
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::find($id);
      $roles = Role::all()->pluck("role", "id")->toArray();
      // if (empty($lesson)) {
      //     Flash::error('Lesson not found');
      //
      //     return redirect(route('admin.lessons.index'));
      // }
      return view('admin.users.show')->with('user', $user)->with("roles", $roles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
        $roles = Role::all()->pluck("role", "id")->toArray();
        // if (empty($lesson)) {
        //     Flash::error('Lesson not found');
        //
        //     return redirect(route('admin.lessons.index'));
        // }
        return view('admin.users.edit')->with('user', $user)->with("roles", $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $user->update($request->only('name','email', 'role_id') + ['password' => bcrypt($request->password)]);
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $data, $id)
    {

       User::find($id)->delete([
          'name' => $data->name,
          'email' => $data->email,
          'password' => $data->password,
          'role_id' => $data->role_id,
      ]);
      return redirect()->route('admin.users.index')->with(['message'=> 'Successfully deleted!!']);
    }
}
      // $post =User::where('id', $id)->first();
      //
      //     if ($post != null) {
      //         $post->delete();
      //         return redirect()->route('admin.users.index')->with(['message'=> 'Successfully deleted!!']);
      //     }
      //
      //     return redirect()->route('admin.users.index')->with(['message'=> 'Wrong ID!!']);
      //
      //   }
