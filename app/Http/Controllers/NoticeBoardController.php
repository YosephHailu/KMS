<?php

namespace App\Http\Controllers;

use Auth;
use App\NoticeBoard;
use App\UserNoticeBoard;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class NoticeBoardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $noticeBoards = NoticeBoard::paginate(20);
        return view('board.board')->with('noticeBoards', $noticeBoards);
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
            'message' => 'required|string',
            'header' => 'required|string',
        ]);
        
        if($request->hasFile('file')){
            //get file name with extension
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            //Get only file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //File extension
            $extension = $request->file('file')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('file')->storeAs('Attachment/Noticeboard/', $fileNameToStore);
        }else{
            $fileNameToStore = 'noFile.jpg' ;
        }


        $request->request->add(['user_id' => Auth::id()]);
        $request->request->add(['attachment' => $fileNameToStore]);
        NoticeBoard::create($request->all());

        //return ->back();
        return redirect('board')->with('success', 'NoticeBoard Information Registered'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function show($noticeBoard)
    {
        //
        $noticeBoard = NoticeBoard::find($noticeBoard);
        if(Storage::exists('Attachment/Noticeboard/'.$noticeBoard->attachment))
            return Storage::download('Attachment/Noticeboard/'.$noticeBoard->attachment);
        return redirect()->back()->with('error', 'File Not Found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function edit(NoticeBoard $noticeBoard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NoticeBoard $noticeBoard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function destroy($noticeBoard)
    {
        //
        $noticeBoard = NoticeBoard::find($noticeBoard);
        Storage::delete('Attachment/Noticeboard/'.$noticeBoard->attachment);
        $noticeBoard->delete();
        return response()->json(['message'=>'Success']);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(NoticeBoard $noticeBoard)
    {
        //        
        UserNoticeBoard::create([
            'seen' => true,
            'seen_at' => Carbon::now(),
            'user_id' => Auth::id(),
            'notice_board_id' => $noticeBoard->id,
        ]);

        return view('board.board_detail')->with('noticeBoard', $noticeBoard);
    }
}
