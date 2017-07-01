<?php

namespace App\Http\Controllers\Groups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Group;

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        //
    }
}