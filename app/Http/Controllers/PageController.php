<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Directorate;
use App\Contact;
class PageController extends Controller
{
    //
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        //
        return view('static_pages.about');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function about_system()
    {
        //
        return view('static_pages.about_system');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        //
        $contacts = Contact::All();
        return view('static_pages.contact')->with('contacts', $contacts);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function help()
    {
        //
        return view('static_pages.help');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function audit()
    {
        //
        $directorates = Directorate::All();
        return view('static_pages.knowledge_audit')->with('directorates', $directorates);
    }

    /**
     * Show the application configuration.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function localization($local)
    {
        App::setLocale($local);
        session()->put('locale', $local);
        return redirect()->back()->with('success', 'Language Changed');
    }
    
}
