
@extends('adminlte/layout')

@section('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />
@endsection

@section('app')


<div class="content-wrapper">
@if (count($errors)>0)
   <div class="alert alert-danger" role="alert">
     <ul>
        @foreach ($errors->all() as $error)
         <li>
         {{ $error}}
         </li>
        @endforeach
     </ul>
   </div>
@endif
<section class="content-header">
               <div class="container-fluid">
                   <div class="col-md-12">
                       <div class="card">
                           <div class="card-body">
                               <div class="row">
                                   <div class="col-md-12">
                                       <div class="chart">
                                          <div class="form-group">
                                             <label for="name">Nombre de la Especialidad</label>
                                             <input type="text" name="name" id="name" class="form-control {{$errors->has('name')?'is-invalid' : ''}}"
                                              value="{{ isset($specialty->name)?$specialty->name:old('name')}}">
                                              {!! $errors->first('name','<div class="invalid-feedback">:message</div>')!!}
                                           </div>
                                       </div>
                                     <br>
                                   </div>
                               </div>
                           </div>
                           <div class="card-footer">
                              <input type="submit" class="btn btn-success btn-sm float-right" value="{{ $modo=='crear' ? 'Agregar Especialidad':'Modificar Especialidad'}}">
                        <a href="{{url('specialty')}}" class="btn btn-danger btn-sm float-left">Cancelar</a>
                         </div>
                       </div>
                   </div>
           </section>
       </div>                 
@endsection
