<?php
Route::get('/home', 'HomeController@index')->name('home');
    Voyager::routes();
// Route::group(['prefix'=>'admin'],function () {
//     Voyager::routes();
// });

// Route::get('break', ['uses'=>'breakController@break', 'middleware' => ['auth']])->name('break');
// Route::post('break_excel', ['uses'=>'breakController@import','middleware' => ['auth']])->name('breakimport');
// Route::post('variant', ['uses'=>'breakController@variant','middleware' => ['auth']])->name('variant');
// Route::post('import_images',['uses'=>'breakController@importimages','middleware' => ['auth']] )->name('importimages');
Route::get('break', 'breakController@break')->name('break');
Route::post('break_excel', 'breakController@import')->name('breakimport');
Route::post('variant', 'breakController@variant')->name('variant');
Route::post('import_images','breakController@importimages')->name('importimages');

// Route::group(['prefix'=>'admi','middleware'=>['auth']],function () {
//     Route::get('/usercreate', 'Auth\RegisterController@showRegistrationForm')->name('usercreate');
//     Route::post('/usercreate', 'Auth\RegisterController@register');
//     Route::get('/changePassword','Auth\ChangePasswordController@index')->name('password.changee');
//     Route::post('/changePassword','Auth\ChangePasswordController@changePassword')->name('password.updatee');
// });


Route::group(['prefix'=>'yarntwist','middleware'=>['auth']],function(){
	Route::resource('yarntwist', 'yarntwistController');
	Route::get('yarntwistdetail/{id}','yarntwistController@yarntwistdetail')->name('yarntwistdetail');
	Route::post('yarntwistdetailpost','yarntwistController@yarntwistdetailpost')->name('yarntwistdetailpost');
	Route::delete('destroy2/{id}','yarntwistController@destroy2')->name('yarntwistdestroy2');
	Route::get('create','yarntwistController@js')->name('bukumjs');
});
Route::group(['prefix'=>'yarnpaint','middleware'=>['auth']],function(){
	Route::resource('yarnpaint', 'yarnpaintController');
	Route::get('create','yarnpaintController@js')->name('boyajs');
	Route::get('create2/{id}','yarnpaintController@create2')->name('boyacreate2');
	Route::post('store2','yarnpaintController@store2')->name('boyastore2');
	Route::delete('destroy2/{id}','yarnpaintController@destroy2')->name('boyadestroy2');
});

//////////////////////////////////////////////////////

///yarn --- İplik

Route::resource('yarn','yarnController');
Route::any('yarn/yarnsearch','yarnController@yarnsearch')->name('yarnsearch');
//Yarn O
Route::get('yarn/yarnlogin/{id}','yarnController@yarnlogin')->name('yarnlogin');
Route::post('yarn/yarnlogindetail','yarnController@yarnlogindetail')->name('yarnlogindetail');
Route::get('yarn/etiket/{id}','yarnController@etiket')->name('etiket');
Route::get('yarn/topluetiket/{id}','yarnController@topluetiket')->name('topluetiket');
//yarn C 
Route::get('yarn/yarnout/{id}','yarnController@yarnout')->name('yarnout');
Route::post('yarn/yarnoutdetail','yarnController@yarnoutdetail')->name('yarnoutdetail');
Route::delete('yarn/yarndetaildestroy/{id}','yarnController@yarndetaildestroy')->name('yarndetaildestroy');
Route::get('yarn/show2/{id}','yarnController@show2')->name('yarn.show2');

Route::post('yarn/cuvalbol','yarnController@cuvalbol')->name('cuvalbol');
Route::get('yarn/cuvalboletiket/{id}','yarnController@cuvalboletiket')->name('cuvalboletiket');

Route::get('yarn/yarn/storereport','yarnController@storereport')->name('yarn.storereport');
Route::get('yarn/yarn/storejs','yarnController@storejs')->name('yarn.storejs');

//////////////////////////////////////////////////////

///cost --- Maliyet

Route::resource('cost','costController');
Route::get('yarncolor/{id}/{fid}','costController@yarncolor')->name('yarncolor');
Route::get('evencolor/{id}/{fid}','costController@evencolor')->name('evencolor');

Route::post('costarticle','costController@article')->name('cost.article');
Route::get('cost/data/{id}','costController@data')->name('articledata');

//////////////////////////////////////////////////////

///orderproces --- Sipariş Süreci

Route::resource('orderproces','orderprocesController');
// Route::get('orderdetailedit/{id}','orderprocesController@orderdetailedit')->name('orderdetailedit');
// Route::get('create2/{id}','orderprocesController@create2')->name('orderproces.create2');
// Route::get('newdetail/{id}','orderprocesController@newdetail')->name('orderproces.newdetail');

//////////////////////////////////////////////////////

///orderdetail --- Sipariş Detayı

Route::resource('orderdetail','orderdetailController');
Route::get('orderdetailedit/{id}','orderdetailController@orderdetailedit')->name('orderdetailedit');
Route::get('create2/{id}','orderdetailController@create2')->name('orderdetail.create2');
Route::get('newdetail/{id}','orderdetailController@newdetail')->name('orderdetail.newdetail');

//////////////////////////////////////////////////////

///order --- sipariş

Route::resource('order','orderController');
Route::get('orderjs','orderController@js')->name('orderjs');

Route::get('explanation/{id}','orderController@explanationdelete')->name('explanationdelete');

Route::get('order/authorized/{id}','orderController@authorized')->name('authorized');
Route::get('adress/{id}','orderController@adress')->name('adress');
Route::post('contractitem','orderController@contractitem')->name('contractitem');

Route::get('costcalculation/{id}','orderController@costcalculation')->name('costcalculation');

Route::post('contractitemupdate','orderController@contractitemupdate')->name('contractitemupdate');
Route::get('contractitemedit/{id}','orderController@contractitemedit')->name('contractitemedit');
Route::get('order/showorder/{id}','orderController@showorder')->name('showorder');

//////////////////////////////////////////////////////

///article

Route::resource('article','articleController');
Route::get('articlejs','articleController@js')->name('articlejs');

//////////////////////////////////////////////////////

///pattern -- desen

Route::resource('pattern','definition\patternController');
Route::get('pattern/pattern/js','definition\patternController@js')->name('patternjs');
Route::get('patterndetail/{id}/{no}','definition\patternController@patterndetail')->name('patterndetail');
Route::get('pattern/showedit/{id}','definition\patternController@showedit')->name('showedit');
Route::get('pattern/showupdate/{id}','definition\patternController@showupdate')->name('showupdate');

//////////////////////////////////////////////////////

///definition -- Tanımlar

Route::resource('authorized','definition\authorizedController');
Route::get('authorized/authorized/js','definition\authorizedController@js')->name('authorizedjs');

Route::resource('company','definition\companyController');
Route::get('company/company/js','definition\companyController@js')->name('companyjs');
Route::get('city/{id}','definition\companyController@city')->name('city');

Route::resource('personel','definition\personelController');
Route::get('personel/personel/js','definition\personelController@js')->name('personeljs');

//////////////////////////////////////////////////////