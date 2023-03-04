<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\UserStats;
use App\Models\User;
use App\Models\Walls;
use App\Models\Logs;
use App\Models\HoldOffers;
use App\Models\Settings;
use App\Events\NewRecentFeeds;

class PostbackController extends Controller
{
    public function HandlePostBack($hash, $sid, $amount, $status, $passwordVar, $track,$clickip,$cname)
    {
        $setts = Settings::all();
        foreach ($setts as $sett) {
            $settings[$sett->name] = $sett->value;
        }

        $wall = Walls::where('hash', $hash)->first();
        $hold = false;
        /**
         *   IP Restrictions Check
         **/
        

        /**
         *   Password & Hash Confirmation
         **/
        if ($wall->passwordVar != "") {
            if (strpos($wall->password, "md5") !== false) {
                $cSig = str_replace("[OFFERID]", $track, $wall->password);
                $cSig = str_replace("[USERID]", $sid, $cSig);
                $cSig = str_replace("[PAYOUT]", $amount, $cSig);
                preg_match("#\((.*?)\)#", $cSig, $cSig);
                $encsig = md5($cSig[1]);
                if ($encsig != $passwordVar) return "Password Error";
            } else if ($wall->password != $passwordVar) return "Password Error";
        }
        
        try {   
            
            $amount = $amount * $wall->per / 100;
            $user = User::findOrFail($sid);
            /**
             *   Crediting Part
             **/
            if ($status == 1) 
            {
        
              if($amount >= $settings['hold_min_amount'] || $hold == true)
              {
                $expire_at = Carbon::now()->addDays(30)->format('Y-m-d');
                HoldOffers::create(['wall' => $wall->name, 'userid' => $user->id, 'points' => $amount, 'track' => $track, 'cname' => $cname, 'expires_at' => $expire_at]);
                $user->update(['hold_points' => $user->hold_points + $amount]);
                return $wall->success;
              }

                
                $user->update(['points' => $user->points + $amount]);
                $logs = Logs::create(['logs_room_id'=> 1,'wall' => $wall->name, 'userid' => $user->id, 'points' => $amount, 'track' => $track, 'cname' => $cname, 'color'=>$wall->color]);
                
                broadcast(new NewRecentFeeds($logs))->toOthers();

                $userstats = UserStats::where('date', Carbon::now()->format('Y-m-d'))->where('user_id',$user->id)->first();
                if(!$userstats)
                {
                  UserStats::create(['user_id' => $user->id, 'earned' => $amount, 'date' => date('Y-m-d') ]);
                }
                else
                {
                  $userstats->update(['earned' => $userstats->earned + $amount]);
                }
                session()->flash('success', "Stats Updated Successfully.");
                
                return $wall->success;
            }

            /**
             *   Reversal Section
             **/

             if($amount >= $settings['hold_min_amount']){
                HoldOffers::where('track', $track)->delete();

                $user->update(['hold_points' => $user->hold_points - $amount ]);
                 return $wall->success;          
            }
            $user = User::findOrFail($sid);
            $user->update(['points' => $user->points - $amount]);
           // Logs::where('track', $track)->delete();
            return $wall->success;
        } catch (\Exception $e) {
             return "Invalid User";
        }
    }


    public function getrequest(Request $request, $hash)
    {
        $wall = Walls::where('hash', $hash)->first();
        $sid = $request->get($wall->sid);
        $amount = abs($request->get($wall->amount));
        $status = $request->get($wall->status);
        $passwordVar = ($wall->passwordVar) ? $request->get($wall->passwordVar) : "";
        $track = $request->get($wall->track);
        $scode = 1;
        $clickip = ($wall->clickip) ? $request->get($wall->clickip) ? $request->get($wall->clickip) : "" : "";
            $cname = $request->get($wall->cname) ?? "";

    
        if ($wall->status != "") {
            $scode = 1;

            if ($status == $wall->credit) {
                $scode = 1;
            }
            if ($status == $wall->reverse) {
                $scode = 2;
            }
        }
        
         if ($request->get($wall->amount) < 0)
        {
          $scode = 2;
        }

        return $this->HandlePostBack($hash, $sid, $amount, $scode, $passwordVar, $track,$clickip,$cname);
    }

}
