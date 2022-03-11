<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    
    public function __construct(){
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
        return View('company')->with('company', Company::first());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|string',
            'abbreviation' => 'required|string',
            'email' => 'required|string|email',
            'address' => 'required|string',
            'phone' => 'required|string',
            'fixed_line' => 'required|string',
        ]);

        //
        
        if($request->hasFile('picture_logo')){
            $fileNameWithExt = $request->file('picture_logo')->getClientOriginalName();
            //Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //File extension
            $extension = $request->file('picture_logo')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('picture_logo')->storeAs('public/company/', $fileNameToStore);
        }else{
            $fileNameToStore = 'nofile.jpg';
        }

        
        if($request->hasFile('picture_header')){
            $fileNameWithExt = $request->file('picture_header')->getClientOriginalName();
            //Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //File extension
            $extension = $request->file('picture_header')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore_header = $fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('picture_header')->storeAs('public/company/', $fileNameToStore_header);
        }else{
            $fileNameToStore_header = 'nofile.jpg';
        }

        $request->request->add(['logo'=>$fileNameToStore]);  
        $request->request->add(['header_img'=>$fileNameToStore_header]);  
        
        Company::create($request->all());

        return redirect('company')->with('success', 'Company Information Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
        $this->validate($request, [
            'name' => 'required|string',
            'abbreviation' => 'required|string',
            'email' => 'required|string|email',
            'address' => 'required|string',
            'phone' => 'required|string',
            'fixed_line' => 'required|string',
        ]);

        //
        
        if($request->hasFile('picture_logo')){
            $fileNameWithExt = $request->file('picture_logo')->getClientOriginalName();
            //Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //File extension
            $extension = $request->file('picture_logo')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('picture_logo')->storeAs('public/company/', $fileNameToStore);
        }else{
            $fileNameToStore = $company->icon;
        }

        
        if($request->hasFile('picture_header')){
            $fileNameWithExt = $request->file('picture_header')->getClientOriginalName();
            //Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //File extension
            $extension = $request->file('picture_header')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore_header = $fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('picture_header')->storeAs('public/company/', $fileNameToStore_header);
        }else{
            $fileNameToStore_header = $company->header_img;
        }

        $request->request->add(['logo'=>$fileNameToStore]);  
        $request->request->add(['header_img'=>$fileNameToStore_header]);  
             
        $company->update($request->all());

        return redirect('company')->with('success', 'Company Information Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
