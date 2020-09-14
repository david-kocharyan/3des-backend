<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordReset extends Controller
{
    const LINK = "3des.ca/reset-password?code=";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMail(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data, ['email' => 'required|email']);
        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        $user = User::where('email', $data['email'])->first();
        if ($user == null) {
            return ResponseHelper::fail("User with this email was not found!", ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        $resCode = new ResetPassword();
        $resCode->user_id = $user->id;
        $resCode->code = $this->bigNumber();
        $resCode->save();

        $details = array('email' => $user->email, 'subject' => "3Des Reset Password", 'link' => self::LINK . $resCode->code);
        \App\Jobs\Reset::dispatch($details);

        return ResponseHelper::success(array(), null, "We sent link on your email, please check it!");
    }

    /**
     * @param Request $request
     */
    public function changePassword(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $validator = Validator::make($data, [
                'code' => 'required|numeric',
                'password' => 'required|min:6',
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        $user_code = ResetPassword::where('code', $data['code'])->first();
        if($user_code == null)
        {
            return ResponseHelper::fail("Please check the code. User not found!", ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        DB::beginTransaction();
        $user = User::where('id', $user_code->user_id)->first();
        $user->password = Hash::make($data['password']);
        $user->save();

        ResetPassword::destroy($user_code->id);
        DB::commit();

        return ResponseHelper::success(array(), null,  "Your password is changed successful!");
    }

    /**
     * @return int|string
     */
    private function bigNumber()
    {
        $output = rand(1, 9);
        for ($i = 0; $i < 16; $i++) {
            $output .= rand(0, 9);
        }
        return $output;
    }
}
