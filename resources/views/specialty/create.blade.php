



<form action="{{url('/specialty')}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
@include('specialty.form',['modo'=>'crear'])

</form>
