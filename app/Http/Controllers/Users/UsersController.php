<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Ultraware\Roles\Models\Role;
use Ultraware\Roles\Models\Permission;
use Auth;

class UsersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->modData = [
            'modTitle' => trans('config.mod_users_desc'),
            'modMenu' => [
                'index' => [
                    trans('config.app_back') => [
                        'href' => route('admin'),
                    ],
                    trans('config.app_create') => [
                        'href' => route('users.create'),
                    ]
                ],
                'create' => [
                    trans('config.app_back') => [
                        'href' => route('users.index'),
                    ]
                ],
                'edit' => [
                    trans('config.app_back') => [
                        'href' => route('users.index'),
                    ]
                ],
                'show' => [
                    trans('config.app_back') => [
                        'href' => route('users.index'),
                    ]
                ],
                'permissions' => [
                    trans('config.app_back') => [
                        'href' => route('users.index'),
                    ]
                ]
            ],

            'modTitleAction' => [
                'index' => trans('modules.mod_users_index_action'),
                'create' => trans('modules.mod_users_create_action'),
                'edit' => trans('modules.mod_users_edit_action'),
                'show' => trans('modules.mod_users_delete_action'),
                'permissions' => trans('modules.mod_users_permissions_action'),
              ],

            'modBreadCrumb' => [
                'index' => [
                    trans('config.app_home') => [
                        'href' => route('admin')
                    ],
                    trans('modules.mod_users_index_action') => [
                        'active' => true
                    ],
                ],
                'create' => [
                    trans('config.app_home') => [
                        'href' => route('admin')
                    ],
                    trans('modules.mod_users_index_action') => [
                        'href' => route('users.index')
                    ],
                    trans('modules.mod_users_create_action') => [
                        'active' => true
                    ],
                ],
                'edit' => [
                    trans('config.app_home') => [
                        'href' => route('admin')
                    ],
                    trans('modules.mod_users_index_action') => [
                        'href' => route('users.index')
                    ],
                    trans('modules.mod_users_edit_action') => [
                        'active' => true
                    ],
                ],
                'show' => [
                     trans('config.app_home') => [
                        'href' => route('admin')
                    ],
                    trans('modules.mod_users_index_action') => [
                        'href' => route('users.index')
                    ],
                    trans('modules.mod_users_delete_action') => [
                        'active' => true
                    ],
                ],
                'permissions' => [
                     trans('config.app_home') => [
                        'href' => route('admin')
                    ],
                    trans('modules.mod_users_index_action') => [
                        'href' => route('users.index')
                    ],
                    trans('modules.mod_users_permissions_action') => [
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
      if( !Auth::user()->hasRole('users.all') && 
          !Auth::user()->hasRole('users.list') ){
          Session::flash('error',trans('config.app_msj_not_permissions'));
          return redirect()->route('admin');
      }

        $plugins[] = 'Datatable';
        $users = User::where('admin','1')->get();
        return $this->view('admin.users.index',compact('plugins','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if( !Auth::user()->hasRole('users.all') && 
          !Auth::user()->hasRole('users.create') ){
          Session::flash('error',trans('config.app_msj_not_permissions'));
          return redirect()->route('admin');
      }

        $plugins[] = 'Datatable';
        return $this->view('admin.users.create',compact('plugins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if( !Auth::user()->hasRole('users.all') && 
          !Auth::user()->hasRole('users.create') ){
          Session::flash('error',trans('config.app_msj_not_permissions'));
          return redirect()->route('admin');
      }

        $this->validate($request, [
            'username' => 'required|string|max:255|unique:users',
            'id_number' => 'required|numeric',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'max:255',
            'number_phone' => 'required|numeric',
            'state' => 'required|max:10|numeric',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {

          //Creacion del usuario
          $user = new User();
          $user->username = $request->username;  
          $user->id_number = $request->id_number;
          $user->name = $request->name;
          $user->last_name = $request->last_name;
          $user->email = $request->email;
          $user->address = $request->address;
          $user->number_phone = $request->number_phone;
          $user->state = $request->state;
          $user->admin = '1';
          $user->password = bcrypt($request->password);
          $user->save();

            Session::flash('success', trans('modules.mod_users_store_msj_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_users_store_msj_error'));

        }

        return redirect()->route('users.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if( !Auth::user()->hasRole('users.all') && 
          !Auth::user()->hasRole('users.delete') ){
          Session::flash('error',trans('config.app_msj_not_permissions'));
          return redirect()->route('admin');
      }
        $user = User::find($id);
        return $this->view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if( !Auth::user()->hasRole('users.all') && 
          !Auth::user()->hasRole('users.update') ){
          Session::flash('error',trans('config.app_msj_not_permissions'));
          return redirect()->route('admin');
      }
        $user = User::find($id);
        return $this->view('admin.users.edit',compact('user'));
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
      if( !Auth::user()->hasRole('users.all') && 
          !Auth::user()->hasRole('users.update') ){
          Session::flash('error',trans('config.app_msj_not_permissions'));
          return redirect()->route('admin');
      }

        if(is_null($request->password) && is_null($request->password_confirmation)){

            $this->validate($request, [
              'id_number' => 'required|numeric',
              'name' => 'required|string|max:255',
              'last_name' => 'required|string|max:255',
              'email' => 'required|string|email|max:255',
              'address' => 'max:255',
              'state' => 'required|max:10|numeric',
              'number_phone' => 'required|numeric',
            ]);

            try {

              //Creacion del usuario
              $user = User::find($id);
              $user->id_number = $request->id_number;
              $user->name = $request->name;
              $user->last_name = $request->last_name;
              $user->email = $request->email;
              $user->address = $request->address;
              $user->state = $request->state;
              $user->save();

                Session::flash('success', trans('modules.mod_users_update_msj_succes'));

            } catch (QueryException $e) {

                Session::flash('error',trans('modules.mod_users_update_msj_error'));

            }

        }else{

            $this->validate($request, [
                'id_number' => 'required|numeric',
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'address' => 'max:255',
                'state' => 'required|max:10|numeric',
                'number_phone' => 'required|numeric',
                'password' => 'required|string|min:6|confirmed',
            ]);

            try {

              //Creacion del usuario
              $user = User::find($id);
              $user->id_number = $request->id_number;
              $user->name = $request->name;
              $user->last_name = $request->last_name;
              $user->email = $request->email;
              $user->address = $request->address;
              $user->state = $request->state;
              $user->password = bcrypt($request->password);
              $user->save();

                Session::flash('success', trans('modules.mod_users_update_msj_succes'));

            } catch (QueryException $e) {

                Session::flash('error',trans('modules.mod_users_update_msj_error'));

            }
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if( !Auth::user()->hasRole('users.all') && 
          !Auth::user()->hasRole('users.delete') ){
          Session::flash('error',trans('config.app_msj_not_permissions'));
          return redirect()->route('admin');
      }

        try {

            //Eliminacion del usuario
            User::destroy($id);

            Session::flash('success', trans('modules.mod_users_delete_msj_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_users_delete_msj_error'));

        }

        return redirect()->route('users.index');

    }

    public function permissions($id){

      if( !Auth::user()->hasRole('users.all') && 
          !Auth::user()->hasRole('users.permissions') ){
          Session::flash('error',trans('config.app_msj_not_permissions'));
          return redirect()->route('admin');
      }

        $plugins[] = 'iCheck';
        $user = User::find($id);
        $rolesdb = Role::select('name')->get();
        $roles = [];
        foreach ($rolesdb as $rol) {
            $roles[] = $rol->name;
        }

        return $this->view('admin.users.permissions',compact('plugins','user','roles'));
    }

    public function permissionsUpdate(request $request, $id){
      
      if( !Auth::user()->hasRole('users.all') && 
          !Auth::user()->hasRole('users.permissions') ){
          Session::flash('error',trans('config.app_msj_not_permissions'));
          return redirect()->route('admin');
      }

      try {

            if(is_null($request->perm)){
              Session::flash('error',trans('modules.mod_users_permissions_no_input_msj_error'));
              return redirect()->route('users.permissions',['id' => $id]);
            }

            $roles = [];

            foreach ($request->perm as $module => $rol) {
                $rolModule = Role::where('name',$module.".module")->first();
                if(is_null($rolModule)){
                  $rolModule = Role::Create([
                        'name' => $module.".module",
                        'slug' => $module.".module",
                  ]);

                  $roles[] = $rolModule->id;
                }else{
                  $rolModule = Role::where('name',$module.".module")->first();
                  $roles[] = $rolModule->id;
                }

                $roles[] = $rolModule->id;

              foreach ($rol as $key => $value) {
                $rol = Role::where('name',$module.".".$key)->first();
                if(is_null($rol)){

                  $rol = Role::Create([
                      'name' => $module.".".$key,
                      'slug' => $module.".".$key,
                  ]);

                  $roles[] = $rol->id;

                }else{
                  $rol = Role::where('name',$module.".".$key)->first();
                  $roles[] = $rol->id;
                }
              }
            }

            $user = User::find($id);
            $user->syncRoles($roles);

            Session::flash('success', trans('modules.mod_users_permissions_msj_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_users_permissions_msj_error'));

        }

        return redirect()->route('users.permissions',['id' => $id]);
    }
}
