<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAddressController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAddress()
    {
        $user = Auth::guard('api')->user();

        $address = Address::selectRaw('id, company, city, street, zip, countries.name as country, states.name as state')
            ->join('countries', 'addresses.country_id', '=', 'countries.id')
            ->join('states', 'addresses.state_id', '=', 'states.id')
            ->where('user_id', $user->id)->first();

        return ResponseHelper::success($address);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAddress(Request $request)
    {
        $user = Auth::guard('api')->user();
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data,
            [
                'country_id' => 'required|numeric',
                'state_id' => 'required|numeric',
                'street' => 'required',
                'city' => 'required',
                'zip' => 'required',
            ]);

        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        $address = new Address;
        $address->user_id = $user->id;
        $address->country_id = $data['country_id'];
        $address->state_id = $data['state_id'];
        $address->street = $data['street'];
        $address->city = $data['city'];
        $address->zip = $data['zip'];
        $address->company = $data['company'];
        $address->save();

        return ResponseHelper::success(array(), false, "Your Address Save Successfully!");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editAddress(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data,
            [
                'country_id' => 'required|numeric',
                'state_id' => 'required|numeric',
                'street' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'id' => 'required'
            ]);

        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        $address = Address::where('id', $data['id'])->first();
        $address->country_id = $data['country_id'];
        $address->state_id = $data['state_id'];
        $address->street = $data['street'];
        $address->city = $data['city'];
        $address->zip = $data['zip'];
        $address->company = $data['company'];
        $address->save();

        return ResponseHelper::success(array(), false, "Your Address Changed Successfully!");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAddress(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data,
            [
                'id' => 'required'
            ]);

        if ($validator->fails()) {
            return ResponseHelper::fail($validator->errors()->first(), ResponseHelper::UNPROCESSABLE_ENTITY_EXPLAINED);
        }

        Address::destroy($data['id']);
        return ResponseHelper::success(array(), false, "Your Address Deleted Successfully!");
    }
}
