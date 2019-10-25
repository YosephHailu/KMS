<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(['permission:all'])->except(['contacts']);        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('contact.contact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contact.manage_contact')->with('new', true);
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
            'office' => 'required|string',
            'manager' => 'string',
            'phone' => 'string',
            'fax' => 'string',
            'remark' => 'string',
        ]);
        Contact::create($request->all());
        return redirect('contact')->with('success', 'Contact Information Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
        return view('contact.manage_contact')->with('new', false)->with('contact', $contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
        $this->validate($request, [
            'office' => 'required|string',
            'manager' => 'string',
            'phone' => 'string',
            'fax' => 'string',
            'remark' => 'string',
        ]);
        $contact->update($request->all());
        return redirect('contact')->with('success', 'Contact Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
        $contact->delete();
        return response()->json('Success');
    }
    public function tableData()
    {
        return Datatables::of(Contact::All())->addColumn('edit', function ($contact) {
                $url = url('contact/'.$contact->id.'/edit');
                return '<a href="'.$url.'"><i class="icon-pen6"></i></a>';
            })->addColumn('delete', function ($contact) {
                return '<a href="" onclick="deleteContact('.$contact->id.')" id='.$contact->id.' class="text-danger"><i class="icon-trash"></i></a>';
            })->addColumn('open', function ($contact) {
                return '<a href="'.url('contact/'.$contact->id).'"><i class="icon-new-tab"></i> </a>';
            })->rawColumns(['delete','edit', 'open'])->make(true);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contacts()
    {
        //
        return view('contact.contacts');
    }
}
