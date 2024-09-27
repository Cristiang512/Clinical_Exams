



<form action="{{url('/service/' . $service->id)}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
{{method_field('PATCH')}}
@include('service.form',['modo'=>'editar'])

</form>




