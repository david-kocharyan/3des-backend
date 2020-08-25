<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    const TITLE = 'Contact Us';
    const ROUTE = "/contact-us";
    const FOLDER = 'admin.contact';

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Contact::orderBy('type')->paginate(10);
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::FOLDER . ".index", compact('title', 'route', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Contact::where('id', $id)->first();
        $title = "Reply to messages";
        $route = self::ROUTE;
        return view(self::FOLDER . '.reply', compact('title', 'route', 'data'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact      $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required',
            'subject' => 'required'
        ]);

        $contact = Contact::where('id', $id)->first();
        $details = array('email' => $contact->email, 'subject' => $request->subject, 'message' => $request->answer);
        \App\Jobs\Contact::dispatch($details);

        $contact->type = 1;
        $contact->save();

        Session::flash('message', 'Message sent successfully!');
        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::destroy($id);
        return redirect(self::ROUTE);
    }
}
