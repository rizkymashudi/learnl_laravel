<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = DB::table('staff')->get();

        //Menyiapkan data untuk chart
        $categories = [];
        $age        = [];
        foreach($pegawai as $p){
            $categories[] = $p->jabatan;
            $age[]        = $p->umur;
        }
        
        return view('table', ['staff' => $pegawai, 'categories' => $categories, 'age' => $age]);
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
        DB::table('staff')->delete($id);
        return response()->json(['success'=>"Product Deleted Successfully", 'tr'=>'tr'.$id]);
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table('staff')->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully"]);
    }
}
