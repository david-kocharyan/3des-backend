<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class TaxController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountries()
    {
        $data = Country::SelectRaw('id, name, code')->get();
        if (null == $data) {
            return ResponseHelper::fail("Countries Not Found", 422);
        }

        $resp = array(
            "countries" => $data
        );
        return ResponseHelper::success($resp);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getState(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'country' => 'required|numeric',
            ]);

        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        $data = State::SelectRaw('id, name, code')->where('country_id', $request->country)->get();
        if (null == $data) {
            return ResponseHelper::fail("States Not Found", 422);
        }

        $resp = array(
            "states" => $data
        );
        return ResponseHelper::success($resp);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function taxCalculate(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data,
            [
                'shipping' => 'required|numeric',
                'country_id' => 'required|numeric',
                'state_id' => 'required|numeric',
                'price' => 'required|numeric',
            ]);
        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        $tax = Tax::where(array('country_id' => $data['country_id'], 'state_id' => $data['state_id']))->first();
        $percentage = floatval($tax->percentage ?? 0);

        $tax_amount = (floatval($data['price']) + floatval($data['shipping'])) * $percentage / 100;
        $total_price = floatval($data['price']) + floatval($data['shipping']) + $tax_amount;

        $resp = array(
            "tax_amount" => $tax_amount,
            "total_price" => $total_price,
        );
        return ResponseHelper::success($resp);
    }

}
