<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Review;
use App\Service;
use App\BusinessDay;

class ProfileController extends Controller
{
    //category wise services
    public function profile($username = null)
    {
       
        $id = User::select('id')->where('username',$username)->firstOrFail();

        $seller = User::where('id',$id)->firstOrFail();
        $seller_since = User::select('created_at')->where('id', $id)->where('user_status', 1)->first();
        $completed_order = Order::where('seller_id', $id)->where('status', 2)->count();

        

        $seller_rating = Review::where('seller_id', $id)->avg('rating');
        $seller_rating_percentage_value = $seller_rating * 20;

        $services = Service::with('serviceCity')->select('id','seller_id','title','description','price','slug','image','featured','service_city_id')
        ->where(['seller_id'=>$id,'status'=>1,'is_service_on'=>1])
        ->take(4)
        ->inRandomOrder()
        ->get();

        $service_rating = Review::where('seller_id', $id)->avg('rating');
        $service_reviews = Review::where('seller_id', $id)->get();

        return view('frontend.pages.seller.profile',compact(
            'seller',
            'seller_since',
            'completed_order',
            'seller_rating_percentage_value',
            'services',
            'service_rating',
            'service_reviews'
            
        ));
    }
}
