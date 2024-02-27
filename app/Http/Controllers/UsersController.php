<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data =  User::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<a href="javascript:void(0)" type="button" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-xs editUser">
                        <i class="mdi mdi-grease-pencil "></i>
                        </a>';
                 $btn = $btn.' <a href="javascript:void(0)" type="button" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-xs deleteUser"><i class="mdi mdi-delete-forever "></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bidang = DB::table('bidang')->get();
        return view('admin.users.create',compact('bidang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        if ($request->type == "admin") {
            $role = 1;
        } else {
            $role = 2;
        }


        if ($request->user_id == '') {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
            ]);

            if ($validator->fails()) {
                return response()->json([
                            'error' => $validator->errors()->all()
                        ]);
            }
            if ($request->password == '') {
                User::updateOrCreate([
                    'id' => $request->user_id
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'type' => $role,
                ]);
            } else {
                User::updateOrCreate([
                    'id' => $request->user_id
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'type' => $role,
                ]);
            }
            return response()->json(['success'=>'Product saved successfully.']);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                            'error' => $validator->errors()->all()
                        ]);
            }
            if ($request->password == '') {
                User::updateOrCreate([
                    'id' => $request->user_id
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'type' => $role,
                ]);
            } else {
                User::updateOrCreate([
                    'id' => $request->user_id
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'type' => $role,
                ]);
            }
            return response()->json(['success'=>'Product saved successfully.']);
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
    public function profil($id)
    {
        // $id = Auth::user()->id;
        $user = User::find($id);

        return view('admin.users.profil',compact('user'));
    }

    public function profilupdate(Request $request,$id)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'alamat' => 'required',
            'telp' => 'required',

        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        // dd($user);
        return redirect()->back()
                        ->with('success','User updated successfully');
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
        return response()->json($user);
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
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'role' => 'required',

        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        // dd($input);
        // DB::table('model_has_roles')->where('model_id',$id)->delete();

        // $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

     public function reset_password(Request $request)
    {
        $id = $request->id;
        $post = User::find($id);

            $post->password = Hash::make($request->password);
            $post->save();

            // $post = User::find($id)->update(['password' => Hash::make($request->password)]);


        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }

    function validate_email(Request $request) {

        if ($request->input('email') !== '') {
            if ($request->input('email')) {
                $rule = array('email' => 'Required|email|unique:users');
                $validator = Validator::make($request->all(), $rule);
            }
            if (!$validator->fails()) {
                die('true');
            }
        }
        die('false');
    }
}
