
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
                                      <label for="name">Nombre y Apellido</label>
                                      <input type="text" name="name" id="name" class="form-control {{$errors->has('name')?'is-invalid' : ''}}"
                                       value="{{ isset($patient->name)?$patient->name:old('name')}}" required>
                                       {!! $errors->first('name','<div class="invalid-feedback">:message</div>')!!}
                                    </div>
                                    <div class="form-group">
                                      <label for="document">Número de Documento</label>
                                      <input type="number" name="document" id="document" class="form-control {{$errors->has('document')?'is-invalid' : ''}}"
                                      value="{{ isset($patient->document)?$patient->document:old('document')}}" required>
                                      {!! $errors->first('document','<div class="invalid-feedback">:message</div>')!!}
                                    </div>
                                    <div class="form-group">
                                      <label for="phone">Número Teléfonico</label>
                                      <input type="number" name="phone" id="phone" class="form-control {{$errors->has('phone')?'is-invalid' : ''}}"
                                      value="{{ isset($patient->phone)?$patient->phone:old('phone')}}" required>
                                      {!! $errors->first('phone','<div class="invalid-feedback">:message</div>')!!}
                                    </div>
                                      <div class="form-group">
                                      <label for="email">Correo Electrónico (Opcional)</label>
                                      <input type="email" name="email" id="email" class="form-control {{$errors->has('email')?'is-invalid' : ''}}"
                                      value="{{ isset($patient->email)?$patient->email:old('email')}}">
                                      {!! $errors->first('email','<div class="invalid-feedback">:message</div>')!!}
                                    </div>
                                    <?php if($modo != 'crear'): ?>
                                      <div class="form-group">
                                        <label for="email" class="col-md-2">¿Reestablecer contraseña?</label>
                                        <input type="checkbox" class="largerCheckbox" id="cbox" name="password" value="yes">
                                      </div>
                                    <?php endif; ?>
                                  </div>
                                <br>
                              </div>
                          </div>
                      </div>
                      <div class="card-footer">
                        <input type="submit" class="btn btn-success btn-sm float-right" value="{{ $modo=='crear' ? 'Agregar Paciente':'Modificar Paciente'}}">
                        <a href="{{url('patient')}}" class="btn btn-danger btn-sm float-left">Cancelar</a>
                    </div>
                  </div>
              </div>
      </section>
  </div>        
@endsection

<style>
        input.largerCheckbox {
            transform : scale(2);
        }
        body {
            text-align:center;
            margin-top:10px;
        }
    </style>