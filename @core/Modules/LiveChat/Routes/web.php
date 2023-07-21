<?php


// backend routes
Route::group(['prefix' => 'admin-home/chat-users', 'middleware' => 'globalVariable'], function () {
    Route::get('/seller','Backend\PublicChatController@seller')->name('admin.chat.seller');
    Route::get('/buyer-connected-to-seller/{id}','Backend\PublicChatController@buyerConnectedToSeller')->name('admin.chat.buyer.connect.to.seller');
    Route::get('/chat-details','Backend\PublicChatController@chatDetails')->name('admin.chat.details');
    Route::match(['get','post'],'login/text/show-hide','Backend\PublicChatController@loginTextShowHide')->name('admin.chat.login.text.show.hide');
});

//frontend routes
Route::group(['prefix'=>'public-chat'],function() {
    Route::post('save-user-info', 'Frontend\PublicChatController@saveUserInfo')->name('save.user.info');
    Route::post('send-user-message', 'Frontend\PublicChatController@sendUserMessage')->name('send.user.message');
    Route::post('close-chat-box', 'Frontend\PublicChatController@closeChatBox')->name('close.chat.box');
});

//seller routes
Route::group(['prefix'=>'seller','middleware'=> ['auth','inactiveuser','BuyerCheck','userEmailVerify','setlang','globalVariable']],function() {
    Route::get('live-chat', 'Frontend\SellerChatController@liveChat')->name('seller.live.chat');
    Route::get('/load-latest-messages', 'Frontend\SellerChatController@getLoadLatestMessages')->name('load.latest.message');
    Route::post('/send', 'Frontend\SellerChatController@postSendMessage')->name('live.message.send');
    Route::get('/fetch-old-messages', 'Frontend\SellerChatController@getOldMessages')->name('fetch.old.message');
});

//buyer routes
Route::group(['prefix'=>'buyer','middleware'=>['auth','inactiveuser','UserRoleCheck','userEmailVerify','setlang','globalVariable']],function() {
    Route::get('live-chat', 'Frontend\BuyerChatController@liveChat')->name('buyer.live.chat');
    Route::get('/load-latest-messages', 'Frontend\BuyerChatController@getLoadLatestMessages');
    Route::post('/send', 'Frontend\BuyerChatController@postSendMessage');
    Route::get('/fetch-old-messages', 'Frontend\BuyerChatController@getOldMessages');
    Route::get('/chat-name-search', 'Frontend\BuyerChatController@chatNameSearch')->name('chat.name.search');
});


Route::post('chat/user/login', 'Frontend\BuyerChatController@chatUserLogin')->name('chat.user.login');
