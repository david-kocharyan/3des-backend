<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserCreditCardController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCard()
    {
        $user = Auth::guard('api')->user();
        $credit_card = CreditCard::where('user_id', $user->id)->first();
        return ResponseHelper::success($credit_card, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCard(Request $request)
    {
        $user = Auth::guard('api')->user();
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data,
            [
                'number' => 'required|numeric',
                'expiration_month' => 'required|numeric',
                'expiration_year' => 'required|numeric',
                'cardholder_name' => 'required',
                'cvv' => 'required|numeric',
            ]);

        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        $credit_card = new CreditCard;
        $credit_card->user_id = $user->id;
        $credit_card->number = $data['number'];
        $credit_card->expiration_month = $data['expiration_month'];
        $credit_card->expiration_year = $data['expiration_year'];
        $credit_card->cardholder_name = $data['cardholder_name'];
        $credit_card->cvv = $data['cvv'];
        $credit_card->save();

        return ResponseHelper::success(array(), false, "Your Credit Card Save Successfully!");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCard(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data,
            [
                'id' => 'required'
            ]);

        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        CreditCard::destroy($data['id']);
        return ResponseHelper::success(array(), false, "Your Credit Card Deleted Successfully!");
    }
}
