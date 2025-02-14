<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\User;

class DashboardController extends Controller
 {
    public function __construct()
 {
        $this->middleware( 'auth' );
    }

    public function dashboard() {
      
        return view( 'dashboard');
    }

}
