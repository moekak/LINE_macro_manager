<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeviceRequest;
use App\Http\Requests\EditDeviceRequest;
use App\Models\Device;
use App\Models\FriendCount;
use App\Models\GroupMessage;
use App\Models\MessageSendingTime;
use App\Models\MessageUrl;
use App\Models\RegistrationMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $device_info = Device::where("user_id", $user->id)->where("is_used", "1")->get();
        return view("device", ["device_info" => $device_info]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDeviceRequest $request)
    {

        $user = Auth::user();
        $validated = $request->validated();
        $validated["user_id"] = $user->id;
        $device = Device::create($validated);


        $data = [
            "device_id" => $device->id,
            "count" => 0 
        ];

        FriendCount::create($data);

        return redirect()->route("device")->with("デバイス情報の追加に成功しました");
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id){

        session(['device_id' => $id]);

        $url = MessageUrl::where("device_id", $id)->get();
        $registration_msg = RegistrationMessage::where("device_id", $id)->get();
        $group_msg = MessageSendingTime::with("groupMessage")->where("device_id", $id)->get();
       // すべてのメッセージを収集するための配列
        $allMessages = [];

        foreach ($group_msg as $messageSendingTime) {
            foreach ($messageSendingTime->groupMessage as $groupMessage) {
                // 各 GroupMessage の message フィールドを収集
                $allMessages[] = $groupMessage;
            }
        }


        // 登録者数の合計
        $friendCount_total = FriendCount::where('device_id', $id)->sum("count");


        if($request->isMethod("get")){
            $today = Carbon::today()->format("Y-m");

            // 年と月を分割
            list($year, $month) = explode('-', $today);

           
            $friendCounts = FriendCount::where('device_id', $id)
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get()
                ->groupBy(function($date) {
                    // 日付を日によってグループ化
                    return Carbon::parse($date->created_at)->format('j');
                })
                ->map(function ($group) {
                    // 各グループに対して、'count' の合計を計算
                    return $group->sum('count');
                });

          

                session(['date' => "{$year}年{$month}月"]);
                $daysData = [];
                for ($day = 1; $day <= 31; $day++) {
                    $daysData[$day] = isset($friendCounts[$day]) ? $friendCounts[$day] : 0;
                }
        
                return view("device_show", ["url" => $url, "registration_msg" => $registration_msg, "group_msg" => $allMessages, "daysData" => $daysData, "total_friendCount"=>$friendCount_total]);
            }




        if ($request->isMethod('post')){

            $selected_date = $request["date"];

            // 年と月を分割
            list($year, $month) = explode('-', $selected_date);

            
            $friendCounts = FriendCount::where('device_id', $id)
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get()
                ->groupBy(function($date) {
                    // 日付を日によってグループ化
                    return Carbon::parse($date->created_at)->format('j');
                })
                ->map(function ($group) {
                    // 各グループに対して、'count' の合計を計算
                    return $group->sum('count');
                });

          

                session(['date' => "{$year}年{$month}月"]);
                $daysData = [];
                for ($day = 1; $day <= 31; $day++) {
                    $daysData[$day] = isset($friendCounts[$day]) ? $friendCounts[$day] : 0;
                }

        

                return view("device_show", ["url" => $url, "registration_msg" => $registration_msg, "group_msg" => $allMessages, "daysData" => $daysData, "total_friendCount"=>$friendCount_total]);

        }
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $device_edit_info = Device::find($id);
        return response()->json($device_edit_info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditDeviceRequest $request, $id)
    {
        session()->flash('route_name', 'device.edit');

        $validated = $request->validated();
        // デバイスを取得
        $device = Device::findOrFail($id);
        // // デバイス情報を更新
        $device->update($validated);

        return redirect()->route("device")->with("success", "デバイス情報の更新に成功しました");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        $device->update(['is_used' => '0']);

        Log::info("更新id" . $id);

        return redirect()->route("device")->with("success", "デバイスが正常に削除されました。");
    }
}
