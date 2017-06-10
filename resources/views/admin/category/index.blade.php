@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_categories_name'))

@section('content')
<table id="datatable-buttons" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Nombre de la zona</th>
      <th>Responsable de la atenci&oacute;n</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
      <tr>
        <td>1</td> 
        <td>1</td> 
        <td>1</td> 
        <td>
           <a href="#" class="btn btn-primary">Editar</a>
           <a href="#" class="btn btn-danger">Eliminar</a>
        </td>
      </tr>
  </tbody>
   </table>
@endsection