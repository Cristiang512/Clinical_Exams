



<form action="{{url('/specialty/' . $specialty->id)}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
{{method_field('PATCH')}}
@include('specialty.form',['modo'=>'editar'])

</form>




