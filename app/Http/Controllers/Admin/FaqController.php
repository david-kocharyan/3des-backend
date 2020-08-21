<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    const TITLE = 'FAQ';
    const ROUTE = "/faqs";
    const FOLDER = 'admin.faqs';

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $data = Faq::orderBy('id', 'ASC')->get();
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
            'question' => 'required',
            'answer' => 'required'
        ]);

        $data = new Faq();
        $data->question = $request->question;
        $data->answer = $request->answer;
        $data->save();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        $title = self::TITLE;
        $action = "Create";
        $route = self::ROUTE;
        $data = $faq;
        return view(self::FOLDER . ".create_edit", compact('title', 'route', 'action', 'data'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faq          $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect(self::ROUTE);
    }
}
