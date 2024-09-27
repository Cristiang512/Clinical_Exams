



<form action="{{url('/admin/' . $admin->id)}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
{{method_field('PATCH')}}
@include('admin.form',['modo'=>'editar'])

</form>




