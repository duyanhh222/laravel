<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', function(){
    return view('login');
});
Route::post('login', function(Illuminate\Http\Request $request){
    if($request->account == 'admin'  && $request->password == 'admin')
        return view('welcome');
    else
        return view('login_error');
});
Route::get('caculator', function(){
    return view('caculator');
});
Route::post('check_caculator', function(Illuminate\Http\Request $request){
    if($request->gia != null){
        $gia = $request->gia;
        $phantram = $request->phantram;
        $des = $request->des;
        $total = $gia*$phantram*0.1;
        return view('display',compact('gia','phantram','des','total'));
    }
});
Route::get('dic', function(){
    return view('dic');
});
Route::post('check_dic', function(Illuminate\Http\Request $request){
    if($request->dic != null){
        $dic = $request->dic;
        $dictionary = array(
            'computer' => 'máy tính',
            'hello' => 'xin chào',
            'book' => 'quyển sách',
            'bye' => 'tạm biệt'
        );
                $flag=0;
                foreach($dictionary as $key => $value){
                    if($dic == $key){
                        return $value;
                    }
                }
                if($flag==0){
                    return 'từ chưa có trong từ điển';
                }
    }
});

