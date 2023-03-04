<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Waxpeer;


class ApiController extends Controller
{
  public function import()
  {
    $sett = Settings::find(4);
    $skip = $sett['value'];

    echo "Fetching items..." .$skip;

    $data = json_decode(file_get_contents("https://api.waxpeer.com/v1/get-items-list?api=e1207f36af786b1c4f489b0944080f40559619ecdd4b9a44c5e0b216e7812f15&skip=".$skip."&limit=100&min_price=500&order=asc&order_by=price&minified=0&game=csgo"), true);
    $items = $data['items'];

    foreach($items as $item)
    {
        $item_exist = Waxpeer::where('item_id',$item['item_id'])->first();
        if(!$item_exist){
            Waxpeer::create([
            'item_id' => $item['item_id'],
            'name' => $item['name'],
            'price' => $item['price'],
            'image' => $item['image'], 
         ]);
        }else{
            $item_exist->update([
             'price' => $item['price'],
            ]);
        }
    }
    $sett->update(['value' => $skip + 100]);
    return 'Done';
  }

  public function order(Request $req)
  {
    $item_id = $req->get('item_id');
    $price = $req->get('price');
    
    
    $trade = Auth::user()->trade_url;
    //dd($trade);
    
    $partner = explode('&',explode("partner=",$trade)[1])[0];
    $token = explode("token=",explode('&',explode("partner=",$trade)[1])[1])[1];

    $data = json_decode(file_get_contents("https://api.waxpeer.com/v1/buy-one-p2p?api=e1207f36af786b1c4f489b0944080f40559619ecdd4b9a44c5e0b216e7812f15&partner=".$partner.'&token='.$token.'&item_id='.$item_id.'&price='.$price),true);
    
    return response()->json($data);
  }
}
