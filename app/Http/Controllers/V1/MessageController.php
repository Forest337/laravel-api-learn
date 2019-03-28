<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Transformers\MessageTransformer;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Validation\ValidationException;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        //检查授权
        if (!checkToken($request->bearerToken())) {
            return response()->json(['Unauthorized'], 401);
        }

        //接收参数
        $params = array_merge($request->only('userName', 'userPhone', 'postMessage'), ['messagessource' => 1]);
        Message::create($params);
        //Message::messageCreate($params);
        return response()->json('OK', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if (!checkToken($request->bearerToken())) {
            return response()->json(['Unauthorized'], 401);
        }

        try {
            $message_list = Message::where('messagessource', $id)->get();
        } catch (Handler $e) {
        }

        return response()->json(fractal($message_list, new MessageTransformer())->toArray(), 200);
    }

    /**
     * @param Request $request
     * @param AuthBase $base
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail($id, Request $request)
    {
        if (!checkToken($request->bearerToken())) {
            return response()->json(['Unauthorized'], 401);
        }

        try {
            $message = Message::find($id);
        } catch (Exception $e) {

        }
        return response()->json(fractal($message, new MessageTransformer())->toArray(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
