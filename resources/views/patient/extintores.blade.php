@extends('adminlte/layout')


@section('links')
    <link href="public/css/multiselect.css" media="screen" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />
@endsection
@section('app')
<form action="{{route('guardarextintor',$user_id)}}" method="POST" enctype="multipart/form-data" >
<input type="hidden" name="services_list" id="services_list" value="{{ $service }}">
{{ csrf_field() }}
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="col-md-12">
                    
                @if(Session::has('mensaje'))
                    <div class="alert alert-danger">
                        <p>Corrige los siguientes errores:</p>
                        <ul>
                        {{Session::get('mensaje')}}
                        </ul>
                    </div>
                @elseif (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title" style="color: black"><strong>
                                    @foreach ($cliente as $c)
                                     {{ $c->name }} -
                                       {{'CC'}} {{ $c->document }}
                                    @endforeach
                                </strong></h1>
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
                                        <table class="table table-light" id="historial">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Exámen</th>
                                                    <th>Servicio</th>
                                                    <th>Especialidad</th>
                                                    
                                                    <th>Fecha de Subida</th>
                                                    <th>Ver</th>
                                                    <?php if(auth()->user()->rol_id == 1): ?>
                                                        <th>Eliminar</th>
                                                    <?php endif; ?> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($manejoext as $rs)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{ $rs->document}}</td>
                                                        <td>{{ $rs->service}}</td>
                                                        <td>{{ $rs->specialty}}</td>
                                                        
                                                        <td>{{ $rs->fecha_subida}}</td>
                                                        <td>
                                                            <a class="fas fa-eye" style="color:black" target="_blank" href="{{asset('Archivos/'.$rs->document)}}" enctype="multipart/form-data"></a>                                                            
                                                        </td>
                                                        <?php if(auth()->user()->rol_id == 1): ?>
                                                            <td>
                                                                <a href="{{ url('patient/ocultar',$rs->resultado_id)}}" onclick="return confirm('¿Esta seguro de eliminar este Exámen?')" data-toggle="tooltip" data-placement="right" title="Eliminar">
                                                                    <i class="fas fa-trash-alt" style="color:red" aria-hidden="true"></i>
                                                                </a>
                                                            </td>  
                                                        <?php endif; ?> 
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                </div>
                                {{-- col-3 --}}
                            </div>
                        </div>
                    </div>
                <?php if(auth()->user()->rol_id == 1): ?>
                    {{-- Segunda card --}}
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title" style="text-align: center"><strong>Cargar Resultado</strong></h1>
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
                                            <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="document">Archivo</label>
                                                    <input type="file" name="document" id="document" class="form-control" accept = "application/pdf, image/jpeg, image/jpg" required>
                                                </div>
                                            </div>  

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="speciality">Especialidad</label>
                                                    <select name="specialty_id" id="specialty_id" class="form-control {{$errors->has('specialty_id')?'is-invalid' : ''}}" required>
                                                        <option
                                                        value="" > Seleccione...
                                                        </option>
                                                        @foreach ($specialty as $specialt)
                                                            <option value="{{ $specialt ['id']}}" > {{ $specialt ['name']}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> 
                                             
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="service">Servicio</label>
                                                    <select name="service_id" id="service_id" class="form-control {{$errors->has('service_id')?'is-invalid' : ''}}" required>
                                                        <option
                                                        value="" > Seleccione...
                                                        </option>
                                                        @foreach ($service as $servic)
                                                            <option value="{{ $servic ['id']}}" > {{ $servic ['name']}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> 
                                </div>
                        </div>
                    </div>
                <?php endif; ?>

            <!-- /.card -->
                                    <br>
                                </div>
                                {{-- col-3 --}}
                            </div>
                        </div>
                        <?php if(auth()->user()->rol_id == 1): ?>
                        <button type="submit" class="btn btn-success float-right">Cargar</button>
                        <a href="{{url('service')}}" class="btn btn-danger btn-sm float-left">Cancelar</a>
                        <?php endif; ?>
                    </div>
                </div>
        </section>
    </div>
 </form>

@endsection

@section('javascript')
    <script src="public/js/jquery.multi-select.js" type="text/javascript"></script>
    <script> $('#my-select').multiSelect()</script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script> $('#historial').DataTable({
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
    <script src="{{ asset('dist/js/dependents.js') }}"></script>
@endsection


