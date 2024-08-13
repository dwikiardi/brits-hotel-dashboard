<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('users', compact('data'));
    }

    public function destroy($id)
    {
      $data = User::find($id);
      $data->delete();
      return redirect()->route('users')
        ->with('success', 'User deleted successfully');
    }

    public function edit($id)
    {
        $data = User::find($id);
        return response()->json($data);
    }
    public function store(Request $request){
        try{
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return response()->json('success');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function tambah(Request $request){
        // dd($request->all());
        try{
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return response()->json('success');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
