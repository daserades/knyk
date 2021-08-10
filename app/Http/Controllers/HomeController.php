<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\desen;
use App\departman;
use Illuminate\Support\Facades\ DB;
use Yajra\Datatables\Datatables;
use App\Imports\desenImport;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('home');
    }
   /* public function  desen(){
        return view('backend.desen');
    }
     public function post_desen()
    {
        return Datatables::of(desen::query())->make(true);
    }
    public function desen_list()
    {
        return view('backend.desen_list');
    }
    */
    public function import()
    {
        Excel::import(new desenImport, 'asd.xlsx');        
        return redirect('/')->with('success', 'All good!');
    }
}
