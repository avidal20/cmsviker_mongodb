<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
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
                Session::flash('error',trans('modules.mod_groups_msj_delete_error'));
                return redirect()->route('groups.index');
            }

            Group::destroy($id);

            Session::flash('success', trans('mod_groups_msj_delete_success'));

        } catch (QueryException $e) {
        
            Session::flash('error',trans('modules.mod_groups_msj_delete_error'));
        }

        return redirect()->route('groups.index');

    }

    public function users($id){

        $this->modVars = [":id:" => $id];
        $plugins[] = 'iCheck';
        $plugins[] = 'Datatable';
        $users = User::where("id_md_groups", $id)->get();
        return $this->view('admin.groups.users.index', compact('plugins', 'users'));
    }

    public function createUser($id){

        $this->modVars = [":id:" => $id];
        $plugins[] = 'iCheck';
        $plugins[] = 'Datatable';
        $id_md_groups = $id;
        return $this->view('admin.groups.users.create', compact('plugins', 'id_md_groups'));
    }

    public function storeUser(Request $request){

        $this->validate($request, [
            'username' => 'required|string|max:255|unique:users',
            'id_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'max:255',
            'number_phone' => 'required|string|max:255',
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

    public function importUsers($id){

        dd($id);
    }
}
