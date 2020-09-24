<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = ShippingMethod::selectRaw("id, name, price, description")->orderBy("id", "ASC")->get();
        if (null == $data) {
            return ResponseHelper::fail("Shipping Methods Not Found", 422);
        }
        $resp = array(
            "shipping" => $data
        );
        return ResponseHelper::success($resp);
    }
}
