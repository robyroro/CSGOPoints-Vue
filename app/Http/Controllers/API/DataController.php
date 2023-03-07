<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use App\Models\User;
use App\Models\Walls;
use App\Models\Logs;
use App\Models\Orders;
use App\Models\UserStats;
use App\Models\LogsRoom;
use App\Models\Waxpeer;


class DataController extends Controller
{
    public function getdata()
    {
      $logs=Logs::where('userid', Auth::user()->id)->orderBy('created_at','desc')->get()->take(5);
      $orders=Orders::where('userid', Auth::user()->id)->orderBy('created_at','desc')->get()->take(5);  
      $today = Logs::where('userid', Auth::id())->whereDate('created_at', Carbon::today())->sum('points');
      $today_offers = Logs::where('userid', Auth::id())->whereDate('created_at',Carbon::today())->count();
      $overall_points = Logs::where('userid', Auth::id())->sum('points');
      $overall_offers = Logs::where('userid', Auth::id())->get()->count();  
      $values = [];
    
      $startDate = Carbon::now()->subDays(7)->startOfDay();
      $endDate = Carbon::now()->endOfDay();


$earnings = Logs::where('userid', Auth::user()->id)
->whereDate('created_at', '>=', now()->subDays(7))
->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(points) as total_earnings'))
->groupBy('date')
->orderBy('date', 'asc')
->get();

      $userstats = UserStats::where('user_id',Auth::user()->id)->where('date', '>' , Carbon::now()->subDays(7))->get();
      foreach($userstats as $stat)
      {
       // $values['data' => $stat['date']][ 'earned' => $stat['earned']];
      }

      return response()->json([
        'logs' => $logs, 
        'orders' => $orders,
        'td' => $today,
        'td_offers' => $today_offers,
        'ov_pts' => $overall_points,
        'ov_offers' => $overall_offers,
        'values' => $values,
        'usearn' => $earnings
     ]);
    }

    public function getwalls()
    {
      $walls = Walls::select(['id','name','iframe','wall_image','color','boost','unlock','active'])->where('active',1)->get();
      return response()->json($walls);
    }

    public function recentfeeds()
    {
      $offers = Logs::with('user')->orderBy('created_at','desc')->get()->take(10);
      $orders = Orders::with('user')->orderBy('created_at','desc')->get()->take(5);

      $logs = collect($offers->push(...$orders));

      return response()->json(['logs' => $logs]);
    }

    public function rooms()
    {
      return LogsRoom::all();
    }

    public function items(Request $request)
    {
      return Waxpeer::all();
    }

  public function order(Request $req)
  {
    $item_id = $req->get('item_id');
    $price = $req->get('price');
    
    
    $trade = Auth::user()->trade_url;
    //dd($trade);
    
    $partner = explode('&',explode("partner=",$trade)[1])[0];
    $token = explode("token=",explode('&',explode("partner=",$trade)[1])[1])[1];

    $data = json_decode(file_get_contents("https://api.waxpeer.com/v1/buy-one-p2p?api=e1207f36af786b1c4f489b0944080f40559619ecdd4b9a44c5e0b216e7812f15&partner=".$partner.'&token='.$token.'&item_id='.$item_id.'&price='.$price.'&project_id='.$item_id),true);
    
    if($data['success'] === false)
    {
      $item = Waxpeer::where('item_id',$item_id)->first();
      $item->delete();
    }
     
    return response()->json($data);
  }

  public function trackorder(Request $req)
  {
    $item_id = $req->get('item_id');
    $data = json_decode(file_get_contents("https://api.waxpeer.com/v1/check-many-project-id?api=e1207f36af786b1c4f489b0944080f40559619ecdd4b9a44c5e0b216e7812f15&id=".$item_id),true);
    return response()->json($data);
  }
}
