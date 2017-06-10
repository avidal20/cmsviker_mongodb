<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->modData = [
            'modTitle' => trans('config.mod_categories_name'),
            'modMenu' => [
                'index' => [
                    trans('config.app_back') => [
                        'class' => 'active',
                        'href' => route('admin'),
                        'atribute' => [
                            'id' => '12W',
                            'data-name' => 'test'
                        ],
                    ],

                    trans('config.app_create') => [
                        'href' => '#',
                    ],
                ],
            ],

            'modTitleAction' => [
                'index' => trans('config.mod_categories_desc'),
              ],

            'modBreadCrumb' => [
                'index' => [

                    trans('config.app_home') => [
                        'href' => '#'
                    ],

                    trans('config.mod_categories_desc') => [
                        'active' => true
                    ]
                ],
            ]
          ];

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plugins[] = 'Datatable';
        return $this->view('admin.category.index',compact('plugins'));
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
        //
    }
}
