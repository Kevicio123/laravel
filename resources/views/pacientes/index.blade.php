@extends('layouts.app')
@section('content')
<div class="container">


@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible" role="alert">
{{Session::get('mensaje')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>

</div>
@endif





<br>
<br>
<a href="{{ url('pacientes/create') }}" class="btn btn-success"> Registrar Nuevo Empleado</a>
<br>
<table class="table table-light">

    <thead class="thead-light">
        <tr>
            <th>N°</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($listPacientes as $paciente)
        <tr>
            <td>{{ $paciente->id }}</td>
            

            <td>
                <img class="img-thumbnail img-fluid" src="{{ asset('storage'.'/'.$paciente->Foto) }}" height="50px" width="50px">
            </td>



            <td>{{ $paciente->Nombre }}</td>
            <td>{{ $paciente->ApePat }}</td>
            <td>{{ $paciente->ApeMat }}</td>
            <td>{{ $paciente->Correo }}</td>
            <td> <a class="btn btn-warning" href="{{ url('/pacientes/'.$paciente->id.'/edit')}}">
                
            Editar </a>| 
              
            <form class="d-inline" action="{{ url('/pacientes/'.$paciente->id) }}" method="post">
            @csrf
            {{ method_field('DELETE') }}
            <input type="submit" class="btn btn-danger" onclick="return confirm('¿Quieres borrar?')" 
            value="Borrar">

            </form>
            
            </td>


        </tr>
        @endforeach
        
    </tbody>

</table>

{!! $listPacientes->links()!!}
    

</div>  

@endsection