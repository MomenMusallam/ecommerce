<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Traits\APITrait;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    use APITrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $bookmarks = Bookmark::All();
//        return $this->returnData(true , 'Get Data Successfully' , $bookmarks ,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id']= $request->user()->id;
        return $this->returnData(true , 'Add Bookmark Successes' , Bookmark::create($request->all()) , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user_id = $request->user()->id;
        return $this->returnData(true , 'get bookmarks for particular user' , Bookmark::where('user_id' , $user_id)->get() , 200);
//        return $this->returnData(true , 'get bookmarks for particular user' , $user , 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        $bookmark = Bookmark::find($id);
//        $bookmark = $bookmark->update($request->all());
//        return response()->json($bookmark);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {
        $user_id= $request->user()->id;
        $result = Bookmark::where('user_id',$user_id)->where('id' , $id)->delete();
        if($result){
            return $this->returnSuccessMessage('Delete Bookmark Success' , 200);
        }else {
            return $this->returnError('Something is wong',405);
        }
    }
}
