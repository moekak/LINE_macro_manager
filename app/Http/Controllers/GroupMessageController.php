<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupMessageRequest;
use App\Http\Requests\UpdateGroupMessageRequest;
use App\Models\GroupMessage;
use App\Models\MessageSendingTime;
use Illuminate\Http\Request;
use Illuminate\Mail\Events\MessageSending;

class GroupMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(CreateGroupMessageRequest $request)
    {
        $validated = $request->validated();

        $data = [
            "start_id" => '1',
            "end_id" => '0',
            "is_sent" => '1',
            "device_id" => $validated["device_id"]
            
        ];

        $existingRecord = MessageSendingTime::where("device_id", $data["device_id"])->first();

        if(!$existingRecord){
            $messageSendingTime = MessageSendingTime::create($data);
            $insertId = $messageSendingTime->id;
        }else{
            $insertId = $existingRecord->id;
        }

        

        $group_message_data = [
            "time_id" => $insertId,
            "message" => $validated["group_message"]
        ];

        GroupMessage::create($group_message_data);

        $device_id = session("device_id");
        return redirect()->route("device.show", ["id" => $device_id])->with("success", "一斉送信メッセージの追加に成功しました。");
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupMessage $groupMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $group_message = GroupMessage::find($id);

        return response()->json($group_message);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupMessageRequest $request, $id)
    {
        $validated = $request->validated();
        $group_message = GroupMessage::findOrFail($id);

        $group_message->update(["message" => $validated["group_message"]]);
        $device_id = session("device_id");
        
        return redirect()->route("device.show", ["id" => $device_id])->with("success", "一斉送信メッセージの更新に成功しました。");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $group_message = GroupMessage::findOrFail($id);
        $group_message->delete();

        $device_id = session("device_id");
        return redirect()->route("device.show", ["id" => $device_id])->with("success", "一斉送信メッセージの削除に成功しました。");

        
    }


    public function updateIsSent($id){

        $mesage_sending_data = MessageSendingTime::where("device_id", $id)->first();

        $end_id = $mesage_sending_data["end_id"];
        $device_id = session("device_id");

        if($end_id != "0"){
            return redirect()->route("device.show", ["id" => $device_id])->with("success", "一斉送信がまだ終わっていません。配信が終了するまでお待ちください。");
        }else{
            $data = [
                "is_sent" => "0"
            ];
            MessageSendingTime::where("device_id", $id)->update($data);

            return redirect()->route("device.show", ["id" => $device_id])->with("success", "一斉送信が開始されます。");
        }
        
    }
}
