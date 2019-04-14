<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('api');
    }

    public function postASale()
    {
        return response()->json(['hello' => 'Dixie']);
    }

    public function postNoSale()
    {
        return response()->json(['hello' => 'Dixie']);
    }

    public function postDNDDueOut()
    {
        return response()->json(['hello' => 'Dixie']);
    }

    public function postDNDStayover()
    {
        return response()->json(['hello' => 'Dixie']);
    }

    public function postAnItemReject()
    {
        return response()->json(['hello' => 'Dixie']);        
    }

    public function postAnExtraSale()
    {
        return response()->json(['hello' => 'Dixie']);        
    }

    public function postARestock()
    {
        return response()->json(['hello' => 'Dixie']);        
    }
}