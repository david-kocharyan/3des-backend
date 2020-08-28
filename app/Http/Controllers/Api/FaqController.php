<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = Faq::selectRaw("question, answer")->orderBy("id", "ASC")->get();
        if (null == $data) {
            return ResponseHelper::fail("FAQ Not Found", 422);
        }
        $resp = array(
            "faq" => $data
        );
        return ResponseHelper::success($resp);
    }
}
