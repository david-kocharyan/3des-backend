<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\Tax;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    const TITLE = 'Taxes';
    const ROUTE = "/taxes";
    const FOLDER = 'admin.taxes';

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $data = Tax::with(['country', 'state'])->orderBy('id', 'ASC')->paginate(10);
        return view(self::FOLDER . ".index", compact('title', 'route', 'data'));
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
        $countries = Country::all();
        return view(self::FOLDER . ".create", compact('title', 'route', 'action', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required',
            'state' => 'required',
            'tax' => 'required',
        ]);

        $arr = array();
        foreach ($request->country as $key => $val) {
            $arr[$key]['country_id'] = $val;
            $arr[$key]['state_id'] = $request->state[$key];
            $arr[$key]['percentage'] = $request->tax[$key];
            $arr[$key]['created_at'] = Carbon::now();
            $arr[$key]['updated_at'] = Carbon::now();
        }

        Tax::insert($arr);
        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Tax $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Tax $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        $title = self::TITLE;
        $action = "Edit";
        $route = self::ROUTE;
        $countries = Country::all();
        $data = $tax;
        return view(self::FOLDER . ".edit", compact('title', 'route', 'action', 'countries', 'data'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tax          $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tax $tax)
    {
        $request->validate([
            'tax' => 'required|numeric',
        ]);

        $tax->percentage = $request->tax;
        $tax->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Tax $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();
        return redirect(self::ROUTE);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStates($id)
    {
        $states = State::where('country_id', $id)->get();
        return response()->json(['states' => $states]);
    }

}
