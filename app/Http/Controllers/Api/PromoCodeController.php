<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromoCodeController extends Controller
{
    public function index(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data,
            [
                'code' => 'required',
                'price' => 'required|numeric',
            ]);

        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        $promo = Coupon::where('code', $data['code'])->first();

        if ($promo == null) {
            return ResponseHelper::fail("No Such Coupon Exists! Please Enter Valid Code.", ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        $startDate = Carbon::createFromFormat('Y-m-d',$promo->start);
        $endDate = Carbon::createFromFormat('Y-m-d',$promo->finish);
        $check = Carbon::now()->between($startDate,$endDate);
        if (!$check){
            return ResponseHelper::fail("Coupon Expired!", ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        $promo_amount = floatval($data['price'])*floatval($promo->percentage)/100;
        $total_price = floatval($data['price'])-$promo_amount;

        $resp = array(
            "promo_amount" => $promo_amount,
            "total_price" => $total_price,
        );
        return ResponseHelper::success($resp);

    }
}
