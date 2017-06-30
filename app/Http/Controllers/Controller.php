<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function view($route, $param = null){

      //Si no esta definida la variable de configuracion modulo, el sistema utiliza el view tradicional
      if(!isset($this->modData)){
        return view($route, $param);
      }

      //Nombre de la funcion origen
      $nameFunctionOrigin = debug_backtrace()[1]['function'];

      //Definicion del array que tendra las configuraciones
      $configV = [];

      //Si esta definido modTitle se agrega al array
      if(isset($this->modData['modTitle'])){
        $configV['modTitle'] = $this->modData['modTitle'];
      }

      //Si esta definido modMenu se agrega al array
      if(isset($this->modData['modMenu'])){
        $configV['modMenu'] = $this->modData['modMenu'][$nameFunctionOrigin];
      }

      //Si esta definido un titulo para la accion se agrega al array
      if(isset($this->modData['modTitleAction'])){
        if(isset($this->modData['modTitleAction'][$nameFunctionOrigin])){
          $configV['modTitleAction'] = $this->modData['modTitleAction'][$nameFunctionOrigin];
        }
      }

      //Si esta definido el rastro de miga se agrega al array
      if(isset($this->modData['modBreadCrumb'])){
        if(isset($this->modData['modBreadCrumb'][$nameFunctionOrigin])){
          $configV['modBreadCrumb'] = $this->modData['modBreadCrumb'][$nameFunctionOrigin];
        }
      }

      //todas las configuraciones se asignan a la posicion modData
      $configvCollect['modData'] = $configV;

      //Union entre el array que viene de los parametros entre el array de la configuracion
      //del modulo
      if(is_array($param) && is_array($configvCollect)){
        $vdata = array_merge($param,$configvCollect);
        return view($route, $vdata);
      }else{
        return view($route, $configvCollect);
      }

    }
}
