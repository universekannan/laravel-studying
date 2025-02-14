<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Models\User;

class ProfileController extends Controller
{

  public function __construct()
  {
         $this->middleware( 'auth' );
     }
 
    public function profile()
     {
      $userid = Auth::user()->id; 
      $profile = DB::table('users')->where('id','=', $userid)->get();
     return view('users/profile', compact('profile'));

    }
    public function updateprofile(Request $request){
        $userid = Auth::user()->id; 
        $updateprofile = DB::table( 'users' )->where('id',$userid)->update([
          'name'       => $request->name,
          'aadhar_no'  => $request->aadhar_no,
          'phone'      => $request->phone,
          'email'      => $request->email,
          'gender'     => $request->gender,
          'address'    => $request->address,
          'upi'        => $request->upi,
        ]);
      
        $qrcode ="";
        if($request->payment_qr_oode != null){
         $qrcode = $userid.'.'.$request->file('payment_qr_oode')->extension(); 
         $filepath = public_path('uploads'.DIRECTORY_SEPARATOR.'qrcodeimg'.DIRECTORY_SEPARATOR);
         move_uploaded_file($_FILES['payment_qr_oode']['tmp_name'], $filepath.$qrcode);
         $sql = "update users set payment_qr_oode='$qrcode' where id = $userid";
           DB::update(DB::raw($sql));
       }
       return redirect('dashboard')->with('success', 'Edit User Successfully ... !');
      }
}
