<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:all']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders = Slider::paginate(20);
        return view('slider.slider')->with('sliders', $sliders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('slider.manage_slider')->with('new', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required|string',
            'message' => 'required|string',
            'active_now' => 'required',
        ]);

        if ($request->hasFile('attachment')) {
            $fileNameWithExt = $request->file('attachment')->getClientOriginalName();
            //Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //File extension
            $extension = $request->file('attachment')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            //Upload Image
            $path = $request->file('attachment')->storeAs('public/slider_photos', $fileNameToStore);
        } else {
            $fileNameToStore = 'nofile.jpg';
        }

        $request->request->add(['photo' => $fileNameToStore]);
        $request->request->add(['active' => $request->active_now ? true : false]);
        Slider::create($request->all());
        return redirect('slider')->with('success', 'Slider Information Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
        return view('slider.manage_slider')->with('new', false)->with('slider', $slider);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
        return view('slider.manage_slider')->with('new', false)->with('slider', $slider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        //
        $this->validate($request, [
            'title' => 'required|string',
            'message' => 'required|string',
        ]);

        if ($request->hasFile('attachment')) {
            $fileNameWithExt = $request->file('attachment')->getClientOriginalName();
            //Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //File extension
            $extension = $request->file('attachment')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            //Delete Existing File
            Storage::delete('public/slider_photos/' . $slider->photo);

            //Upload Image
            $request->file('attachment')->storeAs('public/slider_photos', $fileNameToStore);

            $request->request->add(['photo' => $fileNameToStore]);
        }
        $request->request->add(['active' => $request->active_now ? true : false]);
        $slider->update($request->all());
        return redirect('slider')->with('success', 'Slider Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        //
        $slider->delete();
        Storage::delete('public/slider_photos/' . $slider->photo);
        return response()->json(['message' => 'Success']);
    }
}
