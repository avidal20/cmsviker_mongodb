<?php

namespace App\Http\Controllers\Features;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use App\Features_size;
use App\Features_sizes_category;

class FeatureSizesCategoryController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->modData = [
            'modTitle' => trans('modules.mod_features_title'),
            'modMenu' => [
                'index' => [
                    trans('config.app_back') => [
                        'href' => route('features'),
                        'atribute' => [],
                    ],
                    trans('config.app_create') => [
                        'href' => route('features.sizes.create'),
                        'atribute' => [],
                    ],
                ],
                'create'=> [
                    trans('config.app_back') => [
                        'href' => route('features.sizes'),
                        'atribute' => [],
                    ],
                ],
            ],

            'modBreadCrumb' => [
                'index' => [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_features_title') => [
                        'href' => route('features'),
                    ],
                    trans('modules.mod_features_sizes_list_title') => [
                        'active' => true
                    ]
                ],
                'create'=> [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_features_title') => [
                        'href' => route('features'),
                    ],
                    trans('modules.mod_features_sizes_list_title') => [
                        'href' => route('features.sizes'),
                    ],
                    trans('modules.mod_features_sizes_create') => [
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
        $sizesCategories = Features_sizes_category::with("md_features_sizes")->get();
        return $this->view('admin.features.sizes.index', compact('plugins', 'sizesCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view('admin.features.sizes.createSizeCategory');
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
          'sizes' => 'required',
          'state' => 'required|max:10|numeric',
        ]);

        try {

            $tallaCat = new Features_sizes_category;
            $tallaCat->name = $request->name;
            $tallaCat->state = $request->state;
            $tallaCat->save();

            foreach($request->sizes as $index => $size){
                if(strlen($size) > 0){
                     $talla = new Features_size;
                    $talla->name = $size;
                    $talla->id_md_features_sizes_category = $tallaCat->id;
                    $talla->save();
                }
            }

            Session::flash('success', trans('modules.mod_sizes_store_msj_create_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_features_sizes_store_msj_create_error'));

        }

        return redirect()->route('features.sizes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Features_sizes_category  $features_sizes_category
     * @return \Illuminate\Http\Response
     */
    public function show(Features_sizes_category $features_sizes_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Features_sizes_category  $features_sizes_category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tallaCat = Features_sizes_category::with("md_features_sizes")->find($id);
        return $this->view('admin.features.editSizeCategory', compact('tallaCat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Features_sizes_category  $features_sizes_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Features_sizes_category $features_sizes_category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Features_sizes_category  $features_sizes_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
        
            Categories::destroy($id);
            Session::flash('success', trans('modules.mod_categories_store_msj_delete_succes'));

        } catch (QueryException $e) {
        
            Session::flash('error',trans('modules.mod_categories_store_msj_delete_error'));
        
        }

        return redirect()->route('categories.index');
    }

}
