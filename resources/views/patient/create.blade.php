



<form action="{{url('/patient')}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
@include('patient.form',['modo'=>'crear'])



</form>
