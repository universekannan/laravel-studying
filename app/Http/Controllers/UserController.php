<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function users()
    {
        $users = DB::table('users')->orderBy('id','desc')->get();
        return view('users/index',compact('users'));
    }
  
public function adduser(Request $request){

        $saveusers = DB::table('users')->insert([
           'full_name'       =>   $request->full_name,
           'email'           =>   $request->email,
           'phone'          =>   $request->phone,
           'status'          =>   'Active',
       ]);

        return redirect('/users')->with('success', 'Users Added Successfully'); 
    }
	
	
    public function updateuser(Request $request){

        $edituser = DB::table('users')->where('id',$request->user_id)->update([
           'full_name'     =>   $request->full_name,
           'email'         =>   $request->email,
           'mobile'        =>   $request->mobile,
           'status'        =>   $request->status,
           'lastup_date'   =>   date('Y-m-d H:i:s'),
        //    'login_id'      =>   auth()->user()->id,
        ]);
        $profile_photo = '';
        if ( $request->photo != null ) {
            $profile_photo = $request->user_id.'.'.$request->file( 'photo' )->extension();
            $filepath = public_path( 'upload'.DIRECTORY_SEPARATOR.'user'.DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $filepath.$profile_photo );
            
            $editstudents = DB::table( 'users' )->where( 'id', $request->user_id )->update( [
                'photo'                  =>   $profile_photo,
            ] );
        }
        return redirect('/viewusers')->with('success', 'User Updated Successfully'); 
    }

    public function deleteuser($id){
        $deleteuser = DB::table('users')->where('id',$id)->delete();
        return redirect('/viewusers')->with('success', 'Users Deleted Successfully');
    }
    
    public function changepassword()
    {
      $userid = Auth::user()->id; 
      return view('admin/changepassword');
    }
    
    public function updatepassword(Request $request){
      $userid = Auth::user()->id;
      $old_password = trim($request->get("oldpassword"));
      $currentPassword = auth()->user()->password;
      if(Hash::check($old_password, $currentPassword)){
        $new_password = trim($request->get("new_password"));
        $confirm_password = trim($request->get("confirm_password"));
        if($new_password != $confirm_password){
          return redirect('changepassword')->with('error', 'Passwords does not match');
        }else{
          $updatepass = DB::table('users')->where('id', '=', $userid)->update([
            'password'   => Hash::make($new_password),
            'cpassword'  => $request->new_password,
          ]);
          return redirect('changepassword')->with('success', 'Passwords Change Succesfully');
        }
      }else{
        return redirect("changepassword")->with('error', 'Sorry, your current password was not recognised');
      }
    }

    public function logout() {
        Auth::guard()->logout();
        return redirect()->intended( '/admin' );
    }

}
