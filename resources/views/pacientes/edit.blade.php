
@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{ url('/pacientes/'.$paciente->id) }}" method="post" enctype="multipart/form-data">



@csrf 

{{ method_field('PATCH') }}

@include('pacientes.form',['modo'=>'Editar'] ); 

</form>

</div>

@endsection


