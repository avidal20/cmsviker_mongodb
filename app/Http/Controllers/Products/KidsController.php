<?php

namespace App\Http\Controllers\Products;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\Products;
use App\ProductKids;
use App\ProductKidsSelected;

class KidsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->modData = [
            'modTitle' => trans('config.mod_products_desc'),
            'modMenu' => [
                'index' => [
                    trans('config.app_back') => [
                        'href' => route('products.home'),
                    ],
                    trans('config.app_create') => [
                        'href' => route('kids.create'),
                    ]
                ],
                'create' => [
                    trans('config.app_back') => [
                        'href' => route('kids.index'),
                    ]
                ],
                'edit' => [
                    trans('config.app_back') => [
                        'href' => route('kids.index'),
                    ]
                ],
                'show' => [
                    trans('config.app_back') => [
                        'href' => route('kids.index'),
                    ]
                ]
            ],

            'modTitleAction' => [
                'index' => trans('modules.mod_kids_index_action'),
                'create' => trans('modules.mod_kids_create_action'),
                'edit' => trans('modules.mod_kids_edit_action'),
                'show' => trans('modules.mod_products_show_action'),
              ],

            'modBreadCrumb' => [
                'index' => [
                    trans('config.app_home') => [
                        'href' => route('admin')
                    ],
                    trans('config.mod_products_desc') => [
                        'href' => route('products.home')
                    ],
                    trans('modules.mod_kids_index_action') => [
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
                    trans('modules.mod_kids_index_action') => [
                        'href' => route('kids.index')
                    ],
                    trans('modules.mod_kids_create_action') => [
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
                    trans('modules.mod_kids_index_action') => [
                        'href' => route('kids.index')
                    ],
                    trans('modules.mod_kids_edit_action') => [
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
                        'href' => route('kids.index')
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
    public function index()
    {
        $plugins[] = 'Datatable';
        $categories = Categories::where('state','1')->get();
        $products = ProductKids::all();

        return $this->view('admin.product.kid.index',compact('plugins','categories','products'));
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
        $plugins[] = 'Datatable';
        $categories = Categories::where('state','1')->get();
        $products = Products::where('state','1')->get();
        return $this->view('admin.product.kid.create',compact('plugins','categories','products'));
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
        'products.*' => 'required',
      ]);

        try {

          //Creacion del producto
          $kid = new ProductKids();
          $kid->name = $request->name;  
          $kid->description = $request->description;
          $kid->reference = $request->reference;
          $kid->alter_reference = $request->alter_reference;
          $kid->state = $request->state;
          $kid->category = $request->category;
          $kid->save();

          //Cracion de productos asociados
          if(isset($request->products)){
            foreach($request->products as $product){
              $productKid = new ProductKidsSelected();
              $productKid->id_product_kids = $kid->id;
              $productKid->id_product = $product;
              $productKid->save();
            }
          }

            Session::flash('success', trans('modules.mod_kids_store_msj_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_kids_store_msj_error'));

        }

        return redirect()->route('kids.edit',['id' => $kid->id ]);
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
        $plugins[] = 'Datatable';
        $categories = Categories::all();
        $kid = ProductKids::find($id);
        $products = Products::all();
        $productsSelect = ProductKidsSelected::where('id_product_kids',$kid->id)->get();
        $productSelected = [];
        foreach ($productsSelect as $select) {
          $productSelected[] = $select->id_product;
        }

        return $this->view('admin.product.kid.show',compact('plugins','categories','products','kid','productSelected'));
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
        $plugins[] = 'Datatable';
        $categories = Categories::where('state','1')->get();
        $kid = ProductKids::find($id);
        $products = Products::where('state','1')->get();
        $productsSelect = ProductKidsSelected::where('id_product_kids',$kid->id)->get();
        $productSelected = [];
        foreach ($productsSelect as $select) {
          $productSelected[] = $select->id_product;
        }

        return $this->view('admin.product.kid.edit',compact('plugins','categories','products','kid','productSelected'));
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
      ]);

        try {
           
          //Creacion del producto
          $kid = ProductKids::find($id);
          $kid->name = $request->name;
          $kid->description = $request->description;
          $kid->reference = $request->reference;
          $kid->alter_reference = $request->alter_reference;
          $kid->state = $request->state;
          $kid->category = $request->category;
          $kid->save();

            Session::flash('success', trans('modules.mod_kids_edit_msj_success'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_kids_edit_msj_error'));

        }

        return redirect()->route('kids.edit',['id' => $kid->id ]);
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

          ProductKids::destroy($id);
          ProductKidsSelected::where('id_product',$id)->delete();

          Session::flash('success', trans('modules.mod_kids_delete_msj_success'));

        } catch (QueryException $e) {

          Session::flash('error',trans('modules.mod_kids_delete_msj_error'));

        }

        return redirect()->route('kids.index');
        
    }

    public function ajaxCategory($id = null)
    {
        if(is_null($id)){
          $kids = ProductKids::all();
        }else{
          $kids = ProductKids::where('category','=',$id)->get();
        }

        $count = 0;
        $dataArray = [];

        foreach ($kids as $kid) {
          $dataArray[$count][] = $kid->reference;
          $dataArray[$count][] = $kid->name;
          $dataArray[$count][] = $kid->md_category->name;
          $dataArray[$count][] = ($kid->state == 1)? trans('modules.mod_categories_field_state_enabled') : trans('modules.mod_categories_field_state_disabled');
          $dataArray[$count][] = "<a href='".route('kids.edit',['id' => $kid->id ])."'><i class='fa fa-edit fa-2x'></a>";
          $dataArray[$count][] = "<a href='".route('kids.show',['id' => $kid->id ])."'><i class='fa fa-remove fa-2x'></a>";
          $count++;
        }

        return response(array(
          'data' => $dataArray
        ),200);
    }

    function ajaxProduct($id = null){
        if(is_null($id)){
            $products = Products::where('state','1')->get();
        }else{
            $products = Products::where('category',$id)->where('state','1')->get();
        }

        return view('admin.product.kid.ajaxinput',compact('products'))->render();
    }

    function ajaxProductEdit($idKid, $id){
        if($id == '0'){
            $products = Products::where('state','1')->get();
        }else{
            $products = Products::where('category',$id)->where('state','1')->get();
        }

        $kid = ProductKids::find($idKid);
        $productsSelect = ProductKidsSelected::where('id_product_kids',$kid->id)->get();
        $productSelected = [];
        foreach ($productsSelect as $select) {
          $productSelected[] = $select->id_product;
        }

        return view('admin.product.kid.ajaxinputEdit',compact('products','productSelected','kid'))->render();
    }

    public function ajaxProductSelect(Request $request)
    {
      if($request->checked == 'true'){
          $productKid = new ProductKidsSelected();
          $productKid->id_product_kids = $request->idKid;
          $productKid->id_product = $request->idProduct;
          $productKid->save();
      }else{
        ProductKidsSelected::
          where('id_product_kids',$request->idKid)
          ->where('id_product',$request->idProduct)->delete();
      }

      $kid = ProductKids::find($request->idKid);
      return view('admin.product.kid.ajaxhtmlproduct',compact('kid'))->render();

    }

}
