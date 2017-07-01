<?php

namespace App\Http\Controllers\Features;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use App\Features_size;
use App\Features_sizes_category;
use App\Products;
use Auth;

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
                        'href' => route('sizes.create'),
                        'atribute' => [],
                    ],
                ],
                'create'=> [
                    trans('config.app_back') => [
                        'href' => route('sizes.index'),
                        'atribute' => [],
                    ],
                ],
                'edit'=> [
                    trans('config.app_back') => [
                        'href' => route('sizes.index'),
                        'atribute' => [],
                    ],
                ],
                'show'=> [
                    trans('config.app_back') => [
                        'href' => route('sizes.index'),
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
                        'href' => route('sizes.index'),
                    ],
                    trans('modules.mod_features_sizes_create') => [
                        'active' => true
                    ]
                ],
                'edit'=> [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_features_title') => [
                        'href' => route('features'),
                    ],
                    trans('modules.mod_features_sizes_list_title') => [
                        'href' => route('sizes.index'),
                    ],
                    trans('modules.mod_features_sizes_edit') => [
                        'active' => true
                    ]
                ],
                'show'=> [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_features_title') => [
                        'href' => route('features'),
                    ],
                    trans('modules.mod_features_sizes_list_title') => [
                        'href' => route('sizes.index'),
                    ],
                    trans('modules.mod_features_sizes_delete') => [
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
        if( !Auth::user()->hasRole('sizes.all') && 
            !Auth::user()->hasRole('sizes.list') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

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
        if( !Auth::user()->hasRole('sizes.all') && 
            !Auth::user()->hasRole('sizes.create') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $plugins[] = 'jQueryUi';
        return $this->view('admin.features.sizes.createSizeCategory', compact('plugins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( !Auth::user()->hasRole('sizes.all') && 
            !Auth::user()->hasRole('sizes.create') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $this->validate($request, [
          'name' => 'required|max:255',
          'sizes.*' => 'required',
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

        return redirect()->route('sizes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Features_sizes_category  $features_sizes_category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if( !Auth::user()->hasRole('sizes.all') && 
            !Auth::user()->hasRole('sizes.delete') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $tallaCat = Features_sizes_category::with("md_features_sizes")->find($id);
        return $this->view('admin.features.sizes.deleteSizeCategory', compact( 'tallaCat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Features_sizes_category  $features_sizes_category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if( !Auth::user()->hasRole('sizes.all') && 
            !Auth::user()->hasRole('sizes.update') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $plugins[] = 'jQueryUi';
        $tallaCat = Features_sizes_category::with("md_features_sizes")->find($id);
        return $this->view('admin.features.sizes.editSizeCategory', compact( 'plugins', 'tallaCat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Features_sizes_category  $features_sizes_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if( !Auth::user()->hasRole('sizes.all') && 
            !Auth::user()->hasRole('sizes.update') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $this->validate($request, [
          'name' => 'required|max:255',
          'sizes.*' => 'required',
          'state' => 'required|max:10|numeric',
        ]);

        try {

            $tallaCat = Features_sizes_category::find($id);
            $tallaCat->name = $request->name;
            $tallaCat->state = $request->state;
            $tallaCat->save();

            // arreglo con las tallas editadas y nuevas
            $goodSizes = [];

            // actualiza las tallas existentes y crea las nuevas
            foreach($request->sizes as $index => $size){

                // existentes
                if(is_array($size)){

                    foreach($size as $id => $name){
                        $tempSize = Features_size::find($id);
                        $tempSize->name = $name;
                        $tempSize->save();
                        $goodSizes[$id] = $name;
                    }

                }else if(is_string($size)){
                // nuevas
                    if(strlen($size) > 0){
                        $talla = new Features_size;
                        $talla->name = $size;
                        $talla->id_md_features_sizes_category = $tallaCat->id;
                        $talla->save();
                        $goodSizes[$talla->id]  = $talla->name;
                    }
                }
            }
            
            $currentSizes = Features_size::where("id_md_features_sizes_category", $tallaCat->id)->get();

            // elimina las tallas eliminadas(valga la redundancia)
            foreach($currentSizes as $index => $size){
                if(! array_key_exists($size->id, $goodSizes)){
                    Features_size::destroy($size->id);
                }
            }

            Session::flash('success', trans('modules.mod_sizes_store_msj_edit_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_features_sizes_store_msj_edit_error'));

        }

        return redirect()->route('sizes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Features_sizes_category  $features_sizes_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( !Auth::user()->hasRole('sizes.all') && 
            !Auth::user()->hasRole('sizes.delete') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        try {

            // valida si esta enlasado a un producto
            $delete = Products::where("type_size", $id)->count();
            if($delete > 0){
                Session::flash('error', trans('modules.mod_features_sizes_cant_delete'));
            }else{
                $tallaCat = Features_sizes_category::find($id);
                $currentSizes = Features_size::where("id_md_features_sizes_category", $tallaCat->id)->get();
                foreach($currentSizes as $index => $size){
                    Features_size::destroy($size->id);
                }
                Features_sizes_category::destroy($id);
                Session::flash('success', trans('modules.mod_sizes_store_msj_delete_succes'));
            }   

        } catch (QueryException $e) {
        
            Session::flash('error',trans('modules.mod_features_sizes_store_msj_delete_error'));
        
        }

        return redirect()->route('sizes.index');
    }

    

}
