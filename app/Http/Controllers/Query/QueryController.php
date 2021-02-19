<?php

namespace App\Http\Controllers\Query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('query.create_query');
    }
}
