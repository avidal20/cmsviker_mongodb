<?php

namespace App\Http\Controllers\Category;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

use App\Categories;

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
                        'href' => route('categories.create'),
                    ],
                ],

                'create' => [
                    trans('config.app_back') => [
                        'href' => route('categories.index'),
                    ],
                ],
            ],

            'modTitleAction' => [
                'index' => trans('config.mod_categories_desc'),
                'create' => trans('modules.mod_categories_create_action'),
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

                'create' => [

                    trans('config.app_home') => [
                        'href' => '#'
                    ],

                    trans('config.mod_categories_desc') => [
                        'href' => route('categories.index')
                    ],

                    trans('modules.mod_categories_create_action') => [
                        'active' => true
                    ],
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
        $categories = Categories::all();
        return $this->view('admin.category.index',compact('plugins','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required|max:255',
          'description' => 'max:550',
          'state' => 'required|max:10|numeric',
        ]);

        try {
            
            $categories = new Categories;
            $categories->name = $request->name;
            $categories->description = $request->description;
            $categories->state = $request->state;
            $categories->save();

            Session::flash('success', trans('modules.mod_categories_store_msj_create_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_categories_store_msj_create_error'));

        }

        return redirect()->route('categories.index');
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
