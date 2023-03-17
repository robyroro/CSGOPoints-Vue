<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Waxpeer;
use App\Models\Inventory;

class RewardController extends Controller
{
   public function getitems()
   {
     $items = Inventory::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
     return response()->json($items);
   }

   public function getwinners()
   {
    $winners = User::inRandomOrder()->limit(2)->get();

    //$items = Waxpeer::whereBetween('price',[510, 570])->inRandomOrder()->limit(2)->get();

    $data = json_decode(file_get_contents("https://api.waxpeer.com/v1/get-items-list?api=e1207f36af786b1c4f489b0944080f40559619ecdd4b9a44c5e0b216e7812f15&skip=100&limit=100&min_price=60&max_price=110&order=asc&order_by=price&minified=0&game=csgo"), true);
    $dt = $data['items'];
    $items = collect($dt)->whereBetween('price', [30, 110])->random(25);//->shuffle()->take(25);

    foreach ($winners as $i => $winner) {
       Inventory::create([
        'user_id' => $winner->id, 
        'item_id' => $items[$i]['item_id'], 
        'name' => $items[$i]['name'], 
        'price' => $items[$i]['price'], 
        'image' => $items[$i]['image'], 
        'claimed' => 'No', 
        'wagered' => 'No' 
      ]);
    }
   }

   public function withdraw(Request $req)
   {
     $item_id = $req->get('item_id');
     $price = $req->get('price');

     $trade = Auth::user()->trade_url;

     $partner = explode('&',explode("partner=",$trade)[1])[0];
     $token = explode("token=",explode('&',explode("partner=",$trade)[1])[1])[1];

     $data = json_decode(file_get_contents("https://api.waxpeer.com/v1/buy-one-p2p?api=e1207f36af786b1c4f489b0944080f40559619ecdd4b9a44c5e0b216e7812f15&partner=".$partner.'&token='.$token.'&item_id='.$item_id.'&price='.$price.'&project_id='.$item_id),true);
     return response()->json($data);

   }

   public function swap(Request $req)
   {
    $item_id = $req->get('item_id');
    $price = $req->get('price');
    $data = json_decode(file_get_contents("https://api.waxpeer.com/v1/get-items-list?api=e1207f36af786b1c4f489b0944080f40559619ecdd4b9a44c5e0b216e7812f15&limit=100&min_price=".$price.'&order=asc&order_by=price&minified=0&game=csgo'), true);
    
    return response()->json($data);
   }

   public function swap_buy(Request $req)
   {
    $item_id = $req->get('item_id');
    $old_id = $req->get('old_id');
    $data = json_decode(file_get_contents("https://api.waxpeer.com/v1/check-availability?api=e1207f36af786b1c4f489b0944080f40559619ecdd4b9a44c5e0b216e7812f15&item_id=".$item_id),true);
    
    $dt = $data['items'];
    if($data['success'] === true)
    {
      $trade = Auth::user()->trade_url;
      $partner = explode('&',explode("partner=",$trade)[1])[0];
      $token = explode("token=",explode('&',explode("partner=",$trade)[1])[1])[1];

      $buy = json_decode(file_get_contents("https://api.waxpeer.com/v1/buy-one-p2p?api=e1207f36af786b1c4f489b0944080f40559619ecdd4b9a44c5e0b216e7812f15&partner=".$partner.'&token='.$token.'&item_id='.$item_id.'&price='.$dt[0]['price'].'&project_id='.$item_id),true);
      //dd($buy);
      $user = User::where('id',Auth::user()->id)->first();
      if($buy['success'] === true){
        $item = Inventory::where('item_id',$old_id)->first();
        $item->item_id = $dt[0]['item_id'];
        $item->name = $dt[0]['name'];
        $item->price = $dt[0]['price'];
        $item->image = $dt[0]['image'];
        $item->claimed = 'Yes';
        $item->wagered = 'Yes';

        $user->update(['points' =>  $user->points - $dt[0]['price']]);
        $item->save();

        return response()->json(['ok' => 'ok']);
      }
    }else{
      return response()->json(['ok' => 'false']);
    }
   }
}
