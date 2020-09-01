<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data,
            [
                'name' => 'required|max:191',
                'email' => 'required|email|unique:subscribers',
            ]);

        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        $subscriber = new Subscriber();
        $subscriber->name = $data["name"];
        $subscriber->email = $data["email"];

        if ($subscriber->save()) {
            return ResponseHelper::success(array());
        }
        return ResponseHelper::fail("Something Went Wrong", 500);
    }
}
