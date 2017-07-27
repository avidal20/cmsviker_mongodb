<?php

namespace App\Http\Controllers\Pqr;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Auth;
use App\Pqr_type;

class PqrController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    function indexUser(){
    	$type_pqr = Pqr_type::all();
      return view('user.pqr.index',compact('type_pqr'));
    }

    function indexUserStore(Request $request){
    	
      $this->validate($request, [
          'g-recaptcha-response' => 'required|recaptcha',
          'coupon_affected' => 'required|max:255|alpha_num',
          'type_request' => 'required|digits:1|numeric',
          'description_request' => 'required|max:255|string',
          'anexo.*' => 'mimes:jpg,png,pdf,zip'
        ]);
    	dd($request->all());
    }
}
