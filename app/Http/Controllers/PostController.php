<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return "Received request to see post#" . $id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return 'create()';
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return 'Showing id#' . $id;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // CHAPTER 6: VIEWS
    // Tự viết phương thức - Custom Method cho Controller
    public function contact(){
        // truyền dữ liệu cho view
        //$people = [];
        $people = ['Tony Stark', 'Thor', 'Black Panther', 'Doctor Strange', 'Black Widow', 'Hulk'];
        return view('contact', compact('people'));
    }

    // Truyền dữ liệu cho view
    // Viết phương thức showPost để nhận dữ liệu truyền vào cho view
    public function viewPost($id, $name){
        //return view('post')->with('id', $id);

        // hoặc dùng compact
        // compact có thể kết hợp nhiều biến lại để truyền cho view một lúc
        return view('post', compact('id', 'name'));
    }




}
