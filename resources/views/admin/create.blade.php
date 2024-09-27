



<form action="{{url('/admin')}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
@include('admin.form',['modo'=>'crear'])



</form>
