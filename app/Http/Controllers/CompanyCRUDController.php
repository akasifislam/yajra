<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Datatables;

class CompanyCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Company::select('*'))
                ->addColumn('created_at', function ($company) {
                    return date('d-m-Y', strtotime($company->created_at));
                })
                ->addColumn('action', 'companies.action')
                ->addColumn('plus', 'companies.plusq')
                ->rawColumns(['action', 'plus'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('companies.index');
    }
}
