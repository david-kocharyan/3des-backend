<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    const TITLE = 'Coupons';
    const ROUTE = "/coupons";
    const FOLDER = 'admin.coupons';

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Coupon::orderBy('type')->paginate(15);
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::FOLDER . '.index', compact('title', 'route', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = self::TITLE;
        $action = "Create";
        $route = self::ROUTE;
        return view(self::FOLDER . ".create_edit", compact('title', 'route', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|min:6',
            'percentage' => 'required|numeric',
            'start' => 'required|date',
            'finish' => 'required|date',
        ]);

        $data = new Coupon();
        $data->name = $request->name;
        $data->code = $request->code;
        $data->percentage = $request->percentage;
        $data->start = $request->start;
        $data->finish = $request->finish;
        $data->save();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        $data = $coupon;
        $title = self::TITLE;
        $action = "Edit";
        $route = self::ROUTE;
        return view(self::FOLDER . ".create_edit", compact('title', 'route', 'action', 'data'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Coupon       $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|min:6',
            'percentage' => 'required|numeric',
            'start' => 'required|date',
            'finish' => 'required|date',
        ]);

        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->percentage = $request->percentage;
        $coupon->start = $request->start;
        $coupon->finish = $request->finish;
        $coupon->type = 1;
        $coupon->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        Coupon::destroy($coupon->id);
        return redirect(self::ROUTE);
    }

    public function disable($id)
    {
        $coupon = Coupon::where('id', $id)->first();
        $coupon->type = 0;
        $coupon->save();
        return redirect(self::ROUTE);
    }
}
