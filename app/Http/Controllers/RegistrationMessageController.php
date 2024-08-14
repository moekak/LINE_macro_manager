<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRegistrationMessageRequest;
use App\Models\MessageUrl;
use App\Models\RegistrationMessage;
use Illuminate\Http\Request;

class RegistrationMessageController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RegistrationMessage $registrationMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $message_data = RegistrationMessage::find($id);
        return response()->json($message_data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegistrationMessageRequest $request, $id)
    {
        $validated = $request->validated();
        $message = RegistrationMessage::findOrFail($id);

        $message->update(["message" => $validated["message"]]);
        $device_id = session("device_id");

        return redirect()->route("device.show", ["id" => $device_id])->with("success", "自動返信メッセージの更新に成功しました。");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegistrationMessage $registrationMessage)
    {
        //
    }
}
