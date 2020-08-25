<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{

    const TITLE = 'Video';
    const ROUTE = "/video";
    const FOLDER = 'admin.video';
    const UPLOAD = 'video';

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Video::first();
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
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        $file_name = "video." . $request->link->getClientOriginalExtension();
        $file = Storage::disk('local')->putFileAs(self::UPLOAD, $request->link, $file_name);

        $data = new Video();
        $data->link = $file;
        $data->save();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Video $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Video $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Video        $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'link' => 'required|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        Storage::disk('local')->delete("$video->link");
        $file_name = "video." . $request->link->getClientOriginalExtension();
        $file = Storage::disk('local')->putFileAs(self::UPLOAD, $request->link, $file_name);

        $video->link = $file;
        $video->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Video $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        Storage::disk('local')->delete("$video->link");
        Video::destroy($video->id);
    }
}
