<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupMessageRequest;
use App\Http\Requests\UpdateGroupMessageRequest;
use App\Models\GroupMessage;
use App\Models\MessageSendingTime;
use Illuminate\Http\Request;

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
            "is_sent" => '0',
            "device_id" => $validated["device_id"]
            
        ];

        $messageSendingTime = MessageSendingTime::create($data);
        $insertId = $messageSendingTime->id;

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
}
