<?php

namespace App\Http\Controllers\Products;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

use App\Categories;
use App\Features_sizes_category;
use App\Features_size;
use App\Features_color;
use App\Products;
use App\ProductsFeatures;
use App\ProductFeacturesImgs;
use App\ProductSize;
use App\ProductKidsSelected;

class ProductController extends Controller
{

        public function __construct() {
        $this->middleware('auth');
        $this->modData = [
            'modTitle' => trans('config.mod_products_desc'),
            'modMenu' => [
                'home' => [
                    trans('config.app_back') => [
                        'href' => route('admin'),
                    ]
                ],
                'index' => [
                    trans('config.app_back') => [
                        'href' => route('products.home'),
                    ],
                    trans('config.app_create') => [
                        'href' => route('products.create'),
                    ]
                ],
                'create' => [
                    trans('config.app_back') => [
                        'href' => route('products.index'),
                    ]
                ],
                'edit' => [
                    trans('config.app_back') => [
                        'href' => route('products.index'),
                    ]
                ],
                'show' => [
                    trans('config.app_back') => [
                        'href' => route('products.index'),
                    ]
                ]
            ],

            'modTitleAction' => [
                'home' => trans('config.mod_products_desc'),
                'index' => trans('modules.mod_products_index_action'),
                'create' => trans('modules.mod_products_create_action'),
                'edit' => trans('modules.mod_products_edit_action'),
                'show' => trans('modules.mod_products_show_action'),
              ],

            'modBreadCrumb' => [
                'home' => [
                    trans('config.app_home') => [
                        'href' => route('admin')
                    ],
                    trans('config.mod_products_desc') => [
                        'active' => true
                    ]
                ],
                'index' => [
                    trans('config.app_home') => [
                        'href' => route('admin')
                    ],
                    trans('config.mod_products_desc') => [
                        'href' => route('products.home')
                    ],
                    trans('modules.mod_products_index_action') => [
                        'active' => true
                    ],
                ],
                'create' => [
                    trans('config.app_home') => [
                        'href' => route('admin')
                    ],
                    trans('config.mod_products_desc') => [
                        'href' => route('products.home')
                    ],
                    trans('modules.mod_products_index_action') => [
                        'href' => route('products.index')
                    ],
                    trans('modules.mod_products_create_action') => [
                        'active' => true
                    ],
                ],
                'edit' => [
                    trans('config.app_home') => [
                        'href' => route('admin')
                    ],
                    trans('config.mod_products_desc') => [
                        'href' => route('products.home')
                    ],
                    trans('modules.mod_products_index_action') => [
                        'href' => route('products.index')
                    ],
                    trans('modules.mod_products_edit_action') => [
                        'active' => true
                    ],
                ],
                'show' => [
                    trans('config.app_home') => [
                        'href' => route('admin')
                    ],
                    trans('config.mod_products_desc') => [
                        'href' => route('products.home')
                    ],
                    trans('modules.mod_products_index_action') => [
                        'href' => route('products.index')
                    ],
                    trans('modules.mod_products_show_action') => [
                        'active' => true
                    ],
                ]
            ]
          ];

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return $this->view('admin.product.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plugins[] = 'Datatable';
        $categories = Categories::where('state','1')->get();
        $products = Products::all();

        return $this->view('admin.product.index',compact('plugins','categories','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plugins[] = 'summernote';
        $plugins[] = 'iCheck';
        $categories = Categories::where('state','1')->get();
        $sizes = Features_sizes_category::where('state','1')->get();
        $colors = Features_color::where('state','1')->get();
        return $this->view('admin.product.create',
          compact(
            'plugins',
            'categories',
            'sizes',
            'colors')
        );
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
        'category' => 'required',
        'reference' => 'required',
        'name' => 'required',
        'state' => 'required|max:10|numeric',
        'type_size' => 'required',
        'color.*' => 'required',
        'img.*' => 'required',
      ]);

        try {

          //Creacion del producto
          $product = new Products();
          $product->name = $request->name;
          $product->description = $request->description;
          $product->reference = $request->reference;
          $product->alter_reference = $request->alter_reference;
          $product->state = $request->state;
          $product->category = $request->category;
          $product->type_size = $request->type_size;
          $product->save();

          //Cracion de tallas
          foreach($request->sizes as $size){
            $sizes = new ProductSize();
            $sizes->id_product = $product->id;
            $sizes->id_size = $size;
            $sizes->save();
          }
          
          //Creacion de las caracteristicas
          foreach($request->color as $key => $value){
            $productFeactures = new ProductsFeatures();
            $productFeactures->id_product = $product->id;
            $productFeactures->id_color = $value;
            $productFeactures->save();

            //Creacion de los archivos
            foreach($request->img[$key] as $file){
              Storage::putfile('public',$file);
              $productFeacturesFile = new ProductFeacturesImgs();
              $productFeacturesFile->id_product_feature = $productFeactures->id;
              $productFeacturesFile->file = $file->store('public');
              $productFeacturesFile->save();
            }

          }

          Session::flash('success', trans('modules.mod_products_store_msj_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_products_store_msj_error'));

        }

        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plugins[] = 'summernote';
        $plugins[] = 'iCheck';

        $product = Products::find($id);
        $categories = Categories::all();
        $sizes = Features_sizes_category::all();
        $colors = Features_color::all();
        $producstSizes = ProductSize::select('id_size')->where('id_product',$id)->get();

        $productSizesSelect = [];
        foreach ($producstSizes as $productSize) {
          $productSizesSelect[] = $productSize->id_size;
        }
        //dd($producstSizes);
        return $this->view('admin.product.show',
          compact(
            'plugins',
            'categories',
            'sizes',
            'colors',
            'product',
            'sizes',
            'productSizesSelect')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plugins[] = 'summernote';
        $plugins[] = 'iCheck';

        $product = Products::find($id);
        $categories = Categories::all();
        $sizes = Features_sizes_category::all();
        $colors = Features_color::all();
        $producstSizes = ProductSize::select('id_size')->where('id_product',$id)->get();
        $productSizesSelect = [];
        foreach ($producstSizes as $productSize) {
          $productSizesSelect[] = $productSize->id_size;
        }
        //dd($producstSizes);
        return $this->view('admin.product.edit',
          compact(
            'plugins',
            'categories',
            'sizes',
            'colors',
            'product',
            'sizes',
            'productSizesSelect')
        );
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
        'category' => 'required',
        'reference' => 'required',
        'name' => 'required',
        'state' => 'required|max:10|numeric',
        'type_size' => 'required',
        'color.*' => 'required',
      ]);

        try {

          //Creacion del producto
          $product = Products::find($id);
          $product->name = $request->name;
          $product->description = $request->description;
          $product->reference = $request->reference;
          $product->alter_reference = $request->alter_reference;
          $product->state = $request->state;
          $product->category = $request->category;
          $product->type_size = $request->type_size;
          $product->save();

          //Cracion de tallas
          ProductSize::where('id_product',$id)->delete();
          foreach($request->sizes as $size){
            $sizes = new ProductSize();
            $sizes->id_product = $product->id;
            $sizes->id_size = $size;
            $sizes->save();
          }

          //Creacion de las caracteristicas
            //Eliminacion de las tallas
            $feactures = ProductsFeatures::where('id_product',$id)->get();
            foreach($feactures as $feacture){
              ProductFeacturesImgs::where('id_product_feature',$feacture->id)->delete();
            }
            ProductsFeatures::where('id_product',$id)->delete();

          foreach($request->color as $key => $value){

            $productFeactures = new ProductsFeatures();
            $productFeactures->id_product = $product->id;
            $productFeactures->id_color = $value;
            $productFeactures->save();

            foreach($request->img[$key] as $keyChildren => $file){
              if(is_string($request->img[$key][$keyChildren])){
                $productFeacturesFile = new ProductFeacturesImgs();
                $productFeacturesFile->id_product_feature = $productFeactures->id;
                $productFeacturesFile->file = $request->img[$key][$keyChildren];
                $productFeacturesFile->save();
              }else{
                Storage::putfile('public',$file);
                $productFeacturesFile = new ProductFeacturesImgs();
                $productFeacturesFile->id_product_feature = $productFeactures->id;
                $productFeacturesFile->file = $file->store('public');
                $productFeacturesFile->save();
              }
            }
          }

            Session::flash('success', trans('modules.mod_products_edit_msj_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_products_edit_msj_error'));

        }

        return redirect()->route('products.index');
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

        $productsKids = ProductKidsSelected::where('id_product',$id)->get();
        if(count($productsKids) > 0){
          Session::flash('error',trans('modules.mod_products_delete_msj_valid_product'));
          return redirect()->route('products.index');
        }

        Products::destroy($id);
        ProductSize::where('id_product',$id)->delete();
        $feactures = ProductsFeatures::where('id_product',$id)->get();
        
        foreach($feactures as $feacture){
          ProductFeacturesImgs::where('id_product_feature',$feacture->id)->delete();
        Session::flash('success', trans('modules.mod_products_edit_msj_succes'));
        }
        ProductsFeatures::where('id_product',$id)->delete();

        Session::flash('success', trans('modules.mod_products_delete_msj_succes'));

      } catch (Exception $e) {
        Session::flash('error',trans('modules.mod_products_delete_msj_error'));
      }

      return redirect()->route('products.index');

    }

    public function ajaxCategory($id = null)
    {
        if(is_null($id)){
          $products = Products::all();
        }else{
          $products = Products::where('category','=',$id)->get();
        }

        $count = 0;
        $dataArray = [];

        foreach ($products as $product) {
          $dataArray[$count][] = $product->reference;
          $dataArray[$count][] = $product->name;
          $dataArray[$count][] = $product->md_category->name;
          $dataArray[$count][] = ($product->state == 1)? trans('modules.mod_categories_field_state_enabled') : trans('modules.mod_categories_field_state_disabled');
          $dataArray[$count][] = "<a href='".route('products.edit',['id' => $product->id ])."'><i class='fa fa-edit fa-2x'></a>";
          $dataArray[$count][] = "<a href='".route('products.show',['id' => $product->id ])."'><i class='fa fa-remove fa-2x'></a>";
          $count++;
        }

        return response(array(
          'data' => $dataArray
        ),200);
    }

    public function AjaxInputsTypeSize($id){
      $sizes = Features_size::where('id_md_features_sizes_category',$id)->get();
      return view('admin.product.ajaxInputsTypeSize',compact('sizes'))->render();
    }
}