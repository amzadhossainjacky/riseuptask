<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\AuthorPayment;
use Illuminate\Support\Arr;
use Validator;

class ArticleController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function writeArticle(){

        return view('author.create_article');
    }

    public function storeArticle(Request $request){

        //validate data
        $validator = Validator::make($request->all(), [
            'article_title' => 'required|unique:articles|min:2|max:30',
            'article_content' => 'required|min:2|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        //define variable
        $inputValue = $request->article_content;
        $splitStringArray = str_split($inputValue);
        $new_array = array();
        $pay_amount = 0;

        $array_lower = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
        $array_upper = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

        //new array finding
        for ($i=0; $i <count($splitStringArray); $i++) { 
            for ($j=0; $j <count($array_lower); $j++) { 
                if($array_lower[$j]==$splitStringArray[$i]){
                    array_push($new_array, $array_lower[$j]);
                }
                if($array_upper[$j]==$splitStringArray[$i]){
                    array_push($new_array, $array_upper[$j]);
                }
            }
        }

        //Pay_amount count
        // n means position value
        for($i=0; $i <count($new_array); $i++){
           for ($j=0; $j <count($array_lower) ; $j++) { 
               if($array_lower[$j] == $new_array[$i]){
                   if($new_array[$i] == 'a' || $new_array[$i] == 'e' || $new_array[$i] == 'i' || $new_array[$i] == 'o' || $new_array[$i] == 'u'){ 
                        global $pay_amount;
                        $n = $j+1;
                        $pay_amount = $pay_amount + $n + 10;
                        break;
                   }else{
                        global $pay_amount;
                        $n = $j+1;
                        $pay_amount = $pay_amount + $n;
                        break;
                   }
               }
           }
           for ($j=0; $j <count($array_upper) ; $j++) { 
            if($array_upper[$j] == $new_array[$i]){
                if($new_array[$i] == 'A' || $new_array[$i] == 'E' || $new_array[$i] == 'I' || $new_array[$i] == 'O' || $new_array[$i] == 'U'){
                    global $pay_amount;
                    $n = $j+1;
                    $pay_amount = $pay_amount + ($n * $n);
                    break;
                }else{
                    global $pay_amount;
                    $n = $j+1;
                    $pay_amount = $pay_amount + $n + 5;
                    break;
                }
            }
        }
        }

        //data stored in database
        $data = new Article;
        $data->author_id = Auth::id();
        $data->article_title = $request->article_title;
        $data->article_content = $request->article_content;
        $data->status = 0;
        $data->save();

        $data2 = new AuthorPayment;
        $data2->article_id = $data->id;
        $data2->payment_amount = $pay_amount;
        $data2->payment_status = 0;
        $data2->save();

        return redirect()->route('view.all.article');

    }

    public function viewAllArticle(){

        $allArticles = Article::join('author_payments', 'author_payments.article_id', '=', 'articles.id')
        ->where('articles.author_id', '=', Auth::id())
        ->select(['articles.*', 'author_payments.payment_amount', 'author_payments.payment_status'])
        ->orderBy('articles.id', 'DESC')
        ->get();
        return view('author.view_all_articles', compact('allArticles'));

    }
}
