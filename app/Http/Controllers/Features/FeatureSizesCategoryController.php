<?php

namespace App\Http\Controllers\Features;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $sizesCategories = Features_sizes_category::all();
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
        dd($request);
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
    public function edit(Features_sizes_category $features_sizes_category)
    {
        //
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
    public function destroy(Features_sizes_category $features_sizes_category)
    {
        //
    }

}
