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

    public function postExtraSale()
    {
        return response()->json(['hello' => 'Dixie']);        
    }

    public function postRestock()
    {
        return response()->json(['hello' => 'Dixie']);        
    }
}