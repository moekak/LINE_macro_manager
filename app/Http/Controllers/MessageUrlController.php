<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMessageUrlRequest;
use App\Models\MessageUrl;
use Illuminate\Http\Request;

class MessageUrlController extends Controller
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
    public function show(MessageUrl $messageUrl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $url_info = MessageUrl::find($id);
        return response()->json($url_info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageUrlRequest $request, $id)
    {
        $validated = $request->validated();
        $url = MessageUrl::findOrFail($id);

        $url->update(["url" => $validated["url"]]);
        $device_id = session("device_id");

        return redirect()->route("device.show", ["id" => $device_id])->with("success", "URLの更新に成功しました。");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MessageUrl $messageUrl)
    {
        //
    }
}
