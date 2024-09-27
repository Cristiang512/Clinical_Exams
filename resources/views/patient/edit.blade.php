



<form action="{{url('/patient/' . $patient->id)}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
{{method_field('PATCH')}}
@include('patient.form',['modo'=>'editar'])

</form>




