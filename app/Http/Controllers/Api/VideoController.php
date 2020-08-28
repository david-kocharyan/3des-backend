<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = Video::selectRaw("CONCAT('uploads','/',link) AS link")->orderBy("id", "ASC")->first();
        if (null == $data) {
            return ResponseHelper::fail("Video Not Found", 422);
        }
        $resp = array(
            "video" => $data
        );
        return ResponseHelper::success($resp);
    }
}
