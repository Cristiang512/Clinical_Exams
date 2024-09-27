

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
    <section class="content-header">
        <div class="container-fluid">
            <div class="col-md-12">
            @if(Session::has('message'))
                    <div class="alert alert-info">
                        <p>Información:</p>
                        <ul>
                        {{Session::get('message')}}
                        </ul>
                    </div>
            @endif
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
            <!-- <form action="{{ route('users.import.excel') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                @if(Session::has('message'))
                <p>{{ Session::get('message') }}</p>
                @endif

                <input type="file" name="file" accept = ".csv" required>

                <button>Importar Usuarios</button>
            </form> -->
                <div class="card">
                    <div class="card-header">
                        {{-- <h1 class="card-title" style="color: black"><strong>PACIENTES</strong></h1> --}}
                        <a href="{{url('patient/create')}}" class="btn btn-success">Agregar Paciente</a>
                        <div class="card-tools">
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                              {{-- style="border-right: 1px solid gray;border-left: 1px solid gray;border-top: 1px solid gray;border-bottom: 1px solid gray" --}}
                                <p class="text-center"> <strong>Lista de Pacientes</strong> </p>
                                <div class="chart">
                                    <table class="table table-light" id="patient">
                                        <thead class="thead-light">
                                            <tr>
                                                {{-- <th>#</th> --}}
                                                <th>Nombre y Apellido</th>
                                                <th>Número de Documento</th>
                                                {{-- <th>Teléfono Celular</th>
                                                <th>Correo Electrónico</th> --}}
                                                <th>Modificar</th>
                                                <th>Eliminar</th>
                                                <th>Ver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($patient as $patient)
                                                <tr>
                                                    {{-- <td>{{$loop->iteration}}</td> --}}
                                                    <td>{{$patient->name}}</td>
                                                    <td>{{$patient->document}}</td>
                                                    {{-- <td>{{$patient->phone}}</td>
                                                    <td>{{$patient->correo}}</td> --}}
                                                    <td>
                                                    <a href="{{url('/patient/'. $patient->id.'/edit')}}">
                                                    <button class="btn btn-sm"><i class="fas fa-edit" style="color:blue"></i></button>
                                                    </a>
                                                    </td>
                                                    <td><form method="post" action="{{url('/patient/'. $patient->id)}}">
                                                        {{csrf_field()}}
                                                        {{ method_field('DELETE')}}
                                                        <button class="btn btn-sm" onclick="return confirm ('¿Borrar?');">
                                                        <i class="fas fa-trash-alt"  style="color:red"></i></button>
                                                    </form>
                                                    </td>
                                                    <td>
                                                    <a href="{{url('/patient/'. $patient->id.'/index')}}">
                                                    <button class="btn btn-sm"><i class="fas fa-upload" style="color:black"></i>Resultados</button>
                                                    </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                              <br>
                            </div>

                        </div>
                    </div>
                </div>
                    <form action="{{ route('users.import.excel') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="card">
                            <div class="card-header">
                                <h1 class="card-title" style="text-align: center"><strong>Importar Pacientes</strong></h1>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- <p class="text-center"><strong></strong></p>
                                        --}}
                                        <div class="chart">
                                        </div>
                                        <!-- right column -->
                            <!--/.col (left) -->
                            <div class="col-md-12">
                                        <!-- general form elements -->
                                    <div class="card card-primary">
                                        
                                        
                                            </div>
                                            <div role="form">
                                                <div class="card-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="document">Archivo (.csv)</label>
                                                            <input type="file" name="file" accept = ".csv" class="form-control"  required>
                                                        </div>
                                                    </div>  
                                                    
                                        
                                    </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success float-right">Cargar</button>
                    </form>
            </div>
    </section>
</div>
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script> $('#patient').DataTable({
        reponsive: true,
        autoWidth: false,
        "language": {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }


    }); </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>
    @if (Session::has('info'))
        <script>
            toastr.success("{!! Session::get('info') !!}");
        </script>
    @endif
@endsection
