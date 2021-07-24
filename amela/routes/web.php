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

Route::get('/time/{timezone?}', function ($timezone = null) {
    if(!empty($timezone)){
        $time = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('UTC'));
        $time->setTimezone(new DateTimeZone(str_replace('-', '/', $timezone)));
        echo 'Múi giờ bạn chọn ' . $timezone . ' hiện tại đang là: ' . $time->format('d-m-Y H:i:s');
    }
    return view('view');
});
Route::get('login1', function(){
    return view('layout.index');
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

// Route::group(['prefix' => 'task'], function(){
//     Route::resource('/','TaskController');
// });

Route::post('logout','ExController@indexx')->name('logout')->middleware('checkAge');
Route::get('email', function(){
    return view('check.email');
});
Route::post('check','EmailController@index');
Route::resource('manager','TaskManagementController');
Route::resource('customer','CustomerController');
Route::get('post','PostController@index')->name('post.index');
Route::get('post/create','PostController@create')->name('post.create');
Route::post('post','PostController@store')->name('post.store');
Route::get('post/edit/{post}','PostController@edit')->name('post.edit');
Route::post('post/update/{post}','PostController@update')->name('post.update');
Route::get('post/delete/{post}','PostController@delete')->name('post.destroy');