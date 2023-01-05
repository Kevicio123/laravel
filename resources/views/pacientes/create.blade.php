@extends('layouts.app')
@section('content')
<div class="container">

<form action="{{url('/pacientes')}}" method="post" enctype="multipart/form-data">
@csrf

@include('pacientes.form',['modo'=>'Crear']);


</form>

</div>

@endsection