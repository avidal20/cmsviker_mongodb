<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Excel;
use App\Group;
use App\User;
use Auth;


class GroupController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->modData = [
            'modTitle' => trans('modules.mod_groups_title'),
            'modMenu' => [
                'index' => [
                    trans('config.app_back') => [
                        'href' => route('admin'),
                        'atribute' => [],
                    ],
                    trans('config.app_create') => [
                        'href' => route('groups.create'),
                        'atribute' => [],
                    ],
                ],
                'create' => [
                    trans('config.app_back') => [
                        'href' => route('groups.index'),
                        'atribute' => [],
                    ]
                ],
                'edit' => [
                    trans('config.app_back') => [
                        'href' => route('groups.index'),
                        'atribute' => [],
                    ]
                ],
                'show' => [
                    trans('config.app_back') => [
                        'href' => route('groups.index'),
                        'atribute' => [],
                    ]
                ],
                'users' => [
                    trans('config.app_back') => [
                        'href' => route('groups.index'),
                        'atribute' => [],
                    ],
                    trans('config.app_create') => [
                        'href' => route('groups.createUser', ['id' => ':id:']),
                        'atribute' => [],
                    ],
                    trans('modules.mod_groups_import_users') => [
                        'href' => route('groups.importUsers', ['id' => ':id:']),
                        'atribute' => [],
                    ],
                ],
                'createUser' => [
                    trans('config.app_back') => [
                        'href' => route('groups.users', ['id' => ':id:']),
                        'atribute' => [],
                    ]
                ],
                'editUser' => [
                    trans('config.app_back') => [
                        'href' => route('groups.users', ['id' => ':id:']),
                        'atribute' => [],
                    ]
                ],
                'showUser' => [
                    trans('config.app_back') => [
                        'href' => route('groups.users', ['id' => ':id:']),
                        'atribute' => [],
                    ]
                ],
                'importUsers' => [
                    trans('config.app_back') => [
                        'href' => route('groups.users', ['id' => ':id:']),
                        'atribute' => [],
                    ]
                ]

            ],
            'modBreadCrumb' => [
                'index' => [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_groups_title') => [
                        'active' => true
                    ]
                ],
                'create' => [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_groups_list') => [
                        'href' => route('groups.index'),
                    ],
                    trans('modules.mod_groups_create') => [
                        'active' => true
                    ]
                ],
                'edit' => [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_groups_list') => [
                        'href' => route('groups.index'),
                    ],
                    trans('modules.mod_groups_edit') => [
                        'active' => true
                    ]
                ],
                'show' => [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_groups_list') => [
                        'href' => route('groups.index'),
                    ],
                    trans('modules.mod_groups_delete') => [
                        'active' => true
                    ]
                ],
                'users' => [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_groups_list') => [
                        'href' => route('groups.index'),
                    ],
                    trans('modules.mod_groups_list_users') => [
                        'active' => true
                    ]
                ],
                'createUser' => [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_groups_list') => [
                        'href' => route('groups.index'),
                    ],
                    trans('modules.mod_groups_list_users') => [
                        'href' => route('groups.users', ['id' => ':id:']),
                    ],
                    trans('modules.mod_users_create_action') => [
                        'active' => true
                    ]
                ],
                'editUser' => [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_groups_list') => [
                        'href' => route('groups.index'),
                    ],
                    trans('modules.mod_groups_list_users') => [
                        'href' => route('groups.users', ['id' => ':id:']),
                    ],
                    trans('modules.mod_users_edit_action') => [
                        'active' => true
                    ]
                ],
                'showUser' => [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_groups_list') => [
                        'href' => route('groups.index'),
                    ],
                    trans('modules.mod_groups_list_users') => [
                        'href' => route('groups.users', ['id' => ':id:']),
                    ],
                    trans('modules.mod_users_delete_action') => [
                        'active' => true
                    ]
                ],
                'importUsers' => [
                    trans('config.app_home') => [
                        'href' => route('admin'),
                    ],
                    trans('modules.mod_groups_list') => [
                        'href' => route('groups.index'),
                    ],
                    trans('modules.mod_groups_list_users') => [
                        'href' => route('groups.users', ['id' => ':id:']),
                    ],
                    trans('modules.mod_groups_import_users') => [
                        'active' => true
                    ]
                ]
            ]
        ];

        $this->modVars = [];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.list') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $plugins[] = 'Datatable';
        $grupos = Group::all();
        return $this->view('admin.groups.index', compact('plugins', 'grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.create') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }
        return $this->view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.store') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        try {
            $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:255',
            'state' => 'required|max:10|numeric',
            ]);

            $grupo = new Group;
            $grupo->name = $request->name;
            $grupo->description = $request->description;
            $grupo->state = $request->state;
            $grupo->save();

            Session::flash('success', trans('modules.mod_groups_create_msj_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_groups_create_msj_error'));

        }

        return redirect()->route('groups.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.delete') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $group = Group::find($id);
        if(is_null($group)){
             Session::flash('error',trans('modules.mod_groups_id_error'));
             return redirect()->route('groups.index');
        }
        return $this->view('admin.groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.edit') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $group = Group::find($id);
        if(is_null($group)){
             Session::flash('error',trans('modules.mod_groups_id_error'));
             return redirect()->route('groups.index');
        }
        return $this->view('admin.groups.edit', compact('group'));
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
        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.update') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        try {
            $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:255',
            'state' => 'required|max:10|numeric',
            ]);

            $grupo = Group::find($id);
            if(is_null($grupo)){
                Session::flash('error',trans('modules.mod_groups_id_error'));
                return redirect()->route('groups.index');
            }

            $grupo->name = $request->name;
            $grupo->description = $request->description;
            $grupo->state = $request->state;
            $grupo->save();

            Session::flash('success', trans('modules.mod_groups_edit_msj_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_groups_edit_msj_error'));

        }

        return redirect()->route('groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.destroy') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('groups.index');
        }

        try {

            // valida si el grupo tiene usuarios
            $numUsers = User::where("id_md_groups", $id)->count();

            if($numUsers > 0){
                Session::flash('error', trans('modules.mod_groups_delete_msj_users_error'));
                return redirect()->route('groups.index');
            }

            Group::destroy($id);

            Session::flash('success', trans('modules.mod_groups_msj_delete_success'));

        } catch (QueryException $e) {
        
            Session::flash('error',trans('modules.mod_groups_msj_delete_error'));
        }

        return redirect()->route('groups.index');

    }

    public function users($id){

        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.users') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $this->modVars = [":id:" => $id];
        $plugins[] = 'iCheck';
        $plugins[] = 'Datatable';
        $users = User::where("id_md_groups", $id)->get();
        return $this->view('admin.groups.users.index', compact('plugins', 'users'));
    }

    public function createUser($id){

        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.createuser') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $this->modVars = [":id:" => $id];
        $plugins[] = 'iCheck';
        $plugins[] = 'Datatable';
        $id_md_groups = $id;
        return $this->view('admin.groups.users.create', compact('plugins', 'id_md_groups'));
    }

    public function storeUser(Request $request){

        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.createuser') ){
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
            $user->admin = '0';
            $user->password = bcrypt($request->password);
            $user->id_md_groups = $request->id_md_groups;
            $user->is_group_admin = !is_null($request->is_group_admin)? 1 : 0;
            $user->save();

            Session::flash('success', trans('modules.mod_users_store_msj_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_users_store_msj_error'));
        }

        return redirect()->route('groups.users', ['id' => $request->id_md_groups]);

    }

    public function editUser($id){

        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.edituser') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $plugins[] = 'iCheck';
        $plugins[] = 'Datatable';
        $user = User::find($id);
        if(is_null($user)){
            Session::flash('error',trans('modules.mod_groups_id_error'));
            return redirect()->route('groups.index');
        }
        $this->modVars = [":id:" => $user->id_md_groups];
        return $this->view('admin.groups.users.edit', compact('plugins', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(request $request, $id)
    {
        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.edituser') ){
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

        }

        try {

            //Creacion del usuario
            $user = User::find($id);
            $user->id_number = $request->id_number;
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->state = $request->state;
            if(!is_null($request->password) && !is_null($request->password_confirmation)){
                $user->password = bcrypt($request->password);
            }
            $user->is_group_admin = !is_null($request->is_group_admin)? 1 : 0;
            $user->save();

            Session::flash('success', trans('modules.mod_users_update_msj_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_users_update_msj_error'));

        }

        return redirect()->route('groups.users', ['id' => $user->id_md_groups]);
    }

    public function showUser($id){

        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.deleteuser') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $plugins[] = 'iCheck';
        $user = User::find($id);
        if(is_null($user)){
            Session::flash('error',trans('modules.mod_groups_id_error'));
            return redirect()->route('groups.index');
        }
        $this->modVars = [":id:" => $user->id_md_groups];
        return $this->view('admin.groups.users.show', compact('plugins', 'user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUser($id)
    {

        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.deleteuser') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        try {
            $user = User::find($id);
            $group = $user->id_md_groups;
            //Eliminacion del usuario
            User::destroy($id);

            Session::flash('success', trans('modules.mod_users_delete_msj_succes'));

        } catch (QueryException $e) {

            Session::flash('error',trans('modules.mod_users_delete_msj_error'));

        }

        return redirect()->route('groups.users', ['id' => $group]);

    }

    public function importUsers($id){

        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.createuser') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }
        
        $this->modVars = [":id:" => $id];
        return $this->view('admin.groups.users.import', compact('id'));
    }
    public function importUsersProcess(request $request){

        if( !Auth::user()->hasRole('groups.all') && 
            !Auth::user()->hasRole('groups.storeUser') ){
            Session::flash('error',trans('config.app_msj_not_permissions'));
            return redirect()->route('admin');
        }

        $file = $request->file("file");
        // guarda el archivo
        Storage::putfile('public', $file);

        $whiteRows = 0;
        $results = Excel::load("public/storage/".$file->hashName(), function($reader) {})->get();
        // Loop through all rows
        foreach ($results as $index => $row) {

            if($whiteRows == 2){
                break;
            }
            // valida si toda la fila esta vacia
            if(
                strlen(trim($row->usuario)) == 0 &&
                strlen(trim($row->identificacion)) == 0 &&
                strlen(trim($row->nombres)) == 0 &&
                strlen(trim($row->apellidos)) == 0 &&
                strlen(trim($row->correo_electronico)) == 0 &&
                strlen(trim($row->direccion)) == 0 &&
                strlen(trim($row->telefono)) == 0
            ){
                $whiteRows ++;
                continue;
            }
            

            // numero de la fila real, se muestra en los mensajes de error
            $realIndex = $index +2;

            // valida los campos
            if(
                strlen(trim($row->usuario)) == 0 ||
                strlen(trim($row->identificacion)) == 0 ||
                strlen(trim($row->nombres)) == 0 ||
                strlen(trim($row->apellidos)) == 0 ||
                strlen(trim($row->correo_electronico)) == 0 || strpos($row->correo_electronico, "@") == false || strpos($row->correo_electronico, ".") == false ||
                strlen(trim($row->direccion)) == 0 ||
                strlen(trim($row->telefono)) == 0
            ){
                Session::flash('error', array_merge(
                    (array) Session::get('error'), 
                    array(trans("modules.mod_groups_import_users_error_row", ['row' => $realIndex]))
                ));
            } else{

                $fail = false;

                // valida que el usuario no este repetido
                if(User::where("username", $row->usuario)->count() > 0){
                    Session::flash('error', array_merge(
                        (array) Session::get('error'), 
                        array(trans("modules.mod_groups_import_users_error_username", ['row' => $realIndex, 'username' => $row->usuario]))
                    ));
                    $fail = true;
                }

                // valida que el documento no este repetido
                if(User::where("id_number", intval($row->identificacion))->count() > 0){
                    Session::flash('error', array_merge(
                        (array) Session::get('error'), 
                        array(trans("modules.mod_groups_import_users_error_number_id", ['row' => $realIndex, 'num' => $row->identificacion]))
                    ));
                    $fail = true;
                }

                // valida que el email no este repetido
                if(User::where("email", $row->correo_electronico)->count() > 0){
                    Session::flash('error', array_merge(
                        (array) Session::get('error'), 
                        array(trans("modules.mod_groups_import_users_error_email", ['row' => $realIndex, 'email' => $row->correo_electronico]))
                    ));
                    $fail = true;
                }

                if(!$fail){
                    // guarda el usuario
                    $user = new User();
                    $user->username = $row->usuario;
                    $user->id_number = intval($row->identificacion);
                    $user->name = $row->nombres;
                    $user->last_name = $row->apellidos;
                    $user->email = $row->correo_electronico;
                    $user->address = $row->direccion;
                    $user->number_phone = intval($row->telefono);
                    $user->state = 1;
                    $user->admin = 0;
                    $user->id_md_groups = $request->group;
                    if(!is_null($row->supervisor) && $row->supervisor == 1){
                        $user->is_group_admin = intval($row->supervisor);
                    }
                    $user->save();
                }

            }

        }

        Session::flash('success', trans("modules.mod_groups_import_users_finish"));


        return redirect()->route('groups.users', ['id' => $request->group]);

    }

    public function ajaxChangeAdmin(request $request){
        $user = User::find($request->user);
        $user->is_group_admin = $request->newValue;
        $user->save();
    }
}