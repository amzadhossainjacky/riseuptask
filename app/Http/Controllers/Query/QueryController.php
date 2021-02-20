<?php

namespace App\Http\Controllers\Query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

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

    public function queryBuilder(Request $request){

        //validate data
        $validator = Validator::make($request->all(), [
            'name1.*' => 'required',
            'name2.*' => 'required',
            'name3.*' => 'required',
            'name4.*' => 'required',
            'name5.*' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $name1 = $request->name1;
        $name2 = $request->name2;
        $name3 = $request->name3;
        $name4 = $request->name4;
        $name5 = $request->name5;
        $query = "SELECT * FROM users Where";
        $rule = $request->rule;

        if($name1 == null){
            //return redirect()->back();
            $notification=array(
                'messege'=>'please, select any query below',
                    'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }

        for ($i=0; $i <count($name1) ; $i++) { 
           
            if ($rule[$i] == 1){
                $query .= " Date($name1[$i]) between '".$name3[$i]."' and '".$name4[$i]."'";
            }else if($rule[$i] == 2) {
                $opa = "";
                if ($name2[$i] == "On") $opa = "=";
                else if ($name2[$i] == "After") $opa = "<";
                else if ($name2[$i] == "Before") $opa = ">";
                $query .= " Date($name1[$i]) $opa '".$name3[$i]."'";
            }else if($rule[$i] == 3){
                $opa = "";
                if ($name2[$i] == "is"){
                    $opa = "=";
                    $query .= " $name1[$i] $opa '".$name3[$i]."'";
                } 
                else if ($name2[$i] == "contains"){
                    $opa ="Like";
                    $query .= " $name1[$i] $opa '%".$name3[$i]."%'";
                } 
                else if ($name2[$i] == "starts_with"){
                    $opa ="Like";
                    $query .= " $name1[$i] $opa '".$name3[$i]."%'";
                }  
                else if ($name2[$i] == "ends_with"){
                    $opa ="Like";
                    $query .= " $name1[$i] $opa '%".$name3[$i]."'";
                } 
                else if ($name2[$i] == "doesnot_starts_with"){
                    $opa ="Not Like";
                    $query .= " $name1[$i] $opa '".$name3[$i]."%'";
                }  
                else if ($name2[$i] == "doesnot_ends_with"){
                    $opa ="Not Like";
                    $query .= " $name1[$i] $opa '%".$name3[$i]."'";
                }
                else if ($name2[$i] == "doesnot_contains"){
                    $opa ="Not Like";
                    $query .= " $name1[$i] $opa '%".$name3[$i]."%'";
                } 
            }
            if($name5 != null)
            {      
                $query .=  array_key_exists($i, $name5) ? " ".$name5[$i] : " ";           
            }
        }

        try {
            $results = DB::select(DB::raw($query));
            return view('query.view_query_results',compact('results'));
        } catch (\Illuminate\Database\QueryException $ex) {

            $notification=array(
                'messege'=>'Please select valid query syntax',
                    'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
          // return redirect()->back();
        }

    }
}
