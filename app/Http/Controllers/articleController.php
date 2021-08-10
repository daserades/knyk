<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\article;
use App\harman;
use App\caglik;
use Yajra\Datatables\Datatables;
use TCG\Voyager\Facades\Voyager;


class articleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'articles')->firstOrFail();
        return view('article.index',compact('dataType'));
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
        $dataType = Voyager::model('DataType')->where('slug', '=', 'articles')->firstOrFail();
        $article=article::where('id',$id)->with('harman','caglik')->first();
        return view('article.show',compact('article','dataType'));
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

    public function js()
    {
        $article=article::orderbydesc('id')->get();
        return Datatables::of($article)
        ->addColumn('action', function ($article) {
            $a= '<table><tr>
            <td><a href="article/'.$article->id.'"  class="btn btn-warning btn-sm browse_bread" title="Görüntüle"><i class="voyager-eye"></i> Görüntüle</a></td>
            </tr></table>';
            return $a;
        })
        ->removeColumn('password')
        ->make(true);
    }
}
