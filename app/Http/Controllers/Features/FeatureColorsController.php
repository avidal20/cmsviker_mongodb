<?php

namespace App\Http\Controllers\Features;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Features_color;
use App\ProductsFeatures;

class FeatureColorsController extends Controller
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
                        'href' => route('colors.create'),
                        'atribute' => [],
                    ],
                ],
                'create'=> [
                    trans('config.app_back') => [
                        'href' => route('colors.index'),
                        'atribute' => [],
                    ],
                ],
                'edit'=> [
                    trans('config.app_back') => [
                        'href' => route('colors.index'),
                        'atribute' => [],
                    ],
                ],
                'show'=> [
                    trans('config.app_back') => [
                        'href' => route('colors.index'),
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
                    trans('modules.mod_features_colors_list_title') => [
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
                    trans('modules.mod_features_colors_list_title') => [
                        'href' => route('colors.index'),
                    ],
                    trans('modules.mod_features_colors_create') => [
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
                    trans('modules.mod_features_colors_list_title') => [
                        'href' => route('colors.index'),
                    ],
                    trans('modules.mod_features_colors_edit') => [
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
                    trans('modules.mod_features_colors_list_title') => [
                        'href' => route('colors.index'),
                    ],
                    trans('modules.mod_features_colors_delete') => [
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
        $colors = Features_color::all();
        return $this->view('admin.features.colors.index', compact('plugins', 'colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view('admin.features.colors.create');
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
          'image' => 'required',
          'state' => 'required|max:10|numeric',
        ]);

        try {

            $color = new Features_color;
            $color->name = $request->name;
            $color->state = $request->state;
            // archivo imagen
            $file = $request->file("image");
            $fileName = $file->hashName();
            Storage::putfile('public', $file);

            $color->image = $fileName;
            $color->save();

            Session::flash('success', trans('modules.mod_colors_store_msj_create_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_features_colors_store_msj_create_error'));

        }

        return redirect()->route('colors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $color = Features_color::find($id);
        return $this->view('admin.features.colors.delete', compact('color'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = Features_color::find($id);
        return $this->view('admin.features.colors.edit', compact('color'));
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
        $this->validate($request, [
          'name' => 'required|max:255',
          'description' => 'max:550',
          'state' => 'required|max:10|numeric',
        ]);

        try {

            $color = Features_color::find($id);
            $color->name = $request->name;
            $color->state = $request->state;
            $file = $request->file("image");
            if ($file !== null) {
                // Elimina la imagen actual
                Storage::delete('public/'.$color->image);
                // archivo imagen
                $fileName = $file->hashName();
                Storage::putfile('public', $file);
                $color->image = $fileName;
            }
            $color->save();

            Session::flash('success', trans('modules.mod_colors_store_msj_edit_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_colors_store_msj_edit_error'));

        }

        return redirect()->route('colors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
        
            //valida si esta enlasado a un producto
            $delete = ProductsFeatures::where("id_color", $id)->count();
            if($delete > 0){
                Session::flash('error', trans('modules.mod_features_colors_cant_delete'));
            }else{
                Features_color::destroy($id);
                Session::flash('success', trans('modules.mod_colors_store_msj_delete_succes'));
            }

        } catch (QueryException $e) {
        
            Session::flash('error',trans('modules.mod_colors_store_msj_delete_error'));
        
        }

        return redirect()->route('colors.index');
    }
}
