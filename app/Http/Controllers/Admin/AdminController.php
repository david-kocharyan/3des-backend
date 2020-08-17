<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    const TITLE = 'Dashboard';
    const PATH = 'admin';

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * show dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = self::TITLE;
        return view(self::PATH . '.home', compact('title'));
    }
}
