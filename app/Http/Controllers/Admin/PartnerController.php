<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PartnerController extends Controller
{

    const TITLE = 'Partners';
    const ROUTE = "/partners";
    const FOLDER = 'admin.partners';

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $data = User::with('partner')->where("type", User::TYPE["partner"])->paginate(10);
        return view(self::FOLDER . ".index", compact('title', 'route', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $action = "Create";
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
            "full_name" => "required",
            "email" => "required|unique:users|max:150|email",
            "password" => "required|min:6",
            "phone" => "required",
            "company" => "required",
            "country" => "required",
            "state" => "required",
            "city" => "required",
            "street" => "required",
            "zip" => "required",
        ]);

        DB::beginTransaction();
        $user = new User;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->type = User::TYPE['partner'];
        $user->save();

        $partner = new Partner;
        $partner->user_id = $user->id;
        $partner->company = $request->company;
        $partner->country = $request->country;
        $partner->state = $request->state;
        $partner->city = $request->city;
        $partner->street = $request->street;
        $partner->zip = $request->zip;
        $partner->save();

        DB::commit();

        $details = array('email' => $user->email, 'subject' => "3Des Partner Password", 'password' => $request->password);
        \App\Jobs\Partner::dispatch($details);

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = self::TITLE;
        $action = "Edit";
        $route = self::ROUTE;
        $data = User::with("partner")->where("id", $id)->first();
        return view(self::FOLDER . ".create_edit", compact('title', 'route', 'action', 'data'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "company" => "required",
            "country" => "required",
            "state" => "required",
            "city" => "required",
            "street" => "required",
            "zip" => "required",
        ]);

        $partner = Partner::where("user_id", $id)->first();
        $partner->company = $request->company;
        $partner->country = $request->country;
        $partner->state = $request->state;
        $partner->city = $request->city;
        $partner->street = $request->street;
        $partner->zip = $request->zip;
        $partner->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect(self::ROUTE);
    }
}
