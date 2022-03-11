<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;

class BlogController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['newsView', 'show']);
        $this->middleware(['permission:all'])->except(['newsView', 'show']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $blogs = Blog::paginate(20);
        return view('blog.blogs')->with('blogs', $blogs);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('blog.manage_blog')->with('new', true);
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
             'sub_title' => 'required|string',
             'message' => 'required|string',
             'picture' => 'mimes:jpg,jpeg,png,bmp,pgm,jfif,tiff,gif|max:2000'
         ],[
             'picture.required' => 'Please upload photo',
             'picture.mimes' => 'Only jpeg, png, jpg and bmp images are allowed',
             'picture.max' => 'Sorry! Maximum allowed size for an image is 2MB',
         ]);
         
        if($request->hasFile('picture')){
            $fileNameWithExt = $request->file('picture')->getClientOriginalName();
            //Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //File extension
            $extension = $request->file('picture')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('picture')->storeAs('public/blog_photos', $fileNameToStore);
        }else{
            $fileNameToStore = 'noFile.jpg';
        }
        
         $request->request->add(['photo'=> $fileNameToStore]);
         $request->request->add(['user_id'=>Auth::id()]);
         $request->request->add(['views'=>0]);
         Blog::create($request->all());
         
         return redirect('news')->with('success', 'News Registered');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($blog)
    {
        //
        $blog = Blog::find($blog);

        $blog->views++;
        $blog->save();
        return view('blog.blog_detail')->with('blog', $blog);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($blog)
    {
        //
        $blog = Blog::find($blog);
        return view('blog.manage_blog')->with('new', false)->with('blog', $blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $blog)
    {
        //
        $blog = Blog::find($blog);        
        $this->validate($request, [
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'message' => 'required|string',
            'picture' => 'mimes:jpg,jpeg,png,bmp,pgm,jfif,tiff,gif|max:2000'
        ],[
            'picture.required' => 'Please upload photo',
            'picture.mimes' => 'Only jpg, jpeg, png, bmp, pgm, tiff and gif images are allowed',
            'picture.max' => 'Sorry! Maximum allowed size for an image is 2MB',
        ]);

       if($request->hasFile('picture')){
           $fileNameWithExt = $request->file('picture')->getClientOriginalName();
           //Get only file name
           $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
           //File extension
           $extension = $request->file('picture')->getClientOriginalExtension();
           //File name to store
           $fileNameToStore = $fileName.'_'.time().'.'.$extension;
           //Upload Image
           $path = $request->file('picture')->storeAs('public/blog_photos', $fileNameToStore);
       }else{
            $fileNameToStore = $blog->photo;
       }
       
        $request->request->add(['photo'=> $fileNameToStore]);
        $request->request->add(['user_id'=>Auth::id()]);
        $blog->update($request->all());
        
        return redirect('news')->with('success', 'News Registered'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($blog)
    {
        //
        $blog = Blog::find($blog);
        $blog->delete();
        return response()->json('Successfully Deleted');
    }
    
    public function tableData()
    {
        return Datatables::of(Blog::All())->addColumn('edit', function ($blog) {
            $url = url('news/'.$blog->id.'/edit');
            return '<a href="'.$url.'"><i class="icon-pen6"></i></a>';
        })->addColumn('delete', function ($blog) {
            return '<a href="" onclick="deleteBlog('.$blog->id.')" id='.$blog->id.' class="text-danger"><i class="icon-trash"></i></a>';
        })->addColumn('open', function ($blog) {
            return '<a href="'.url('news/'.$blog->id).'"><i class="icon-new-tab"></i> </a>';
        })->addColumn('user', function ($blog) {
            return $blog->user->name;
        })->addColumn('adj_message', function ($blog) {
            return \str_limit($blog->message, 150, '...');
        })->rawColumns(['delete','edit', 'open'])->make(true);
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newsView()
    {
        //
        $blogs = Blog::paginate(20);
        return view('blog.blog_view')->with('blogs', $blogs);
    }

}
