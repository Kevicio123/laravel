Formulario del Paciente

<h1>{{$modo}} Paciente</h1>

@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
    <ul>
    @foreach($errors->all() as $error)
       <li> {{$error}} </li>
    @endforeach
    </ul>
</div>
    

@endif
<br>

<div class="form-group">
<label for="Nombre"> Nombre </label>
<input type="text" class="form-control" name="Nombre" 
value="{{ isset($paciente ->Nombre)?$paciente->Nombre:old('Nombre') }}" id="Nombre">
<br>
</div>

<div class="form-group">
<label for="ApePat"> Apellido Paterno </label>
<input type="text" class="form-control" name="ApePat" 
value="{{ isset($paciente ->ApePat)?$paciente ->ApePat:old('ApePat') }}" id="ApePat">
<br>
</div>


<div class="form-group">
<label for="ApeMat"> Apellido Materno </label>
<input type="text" class="form-control" name="ApeMat" 
value="{{ isset($paciente ->ApeMat)?$paciente ->ApeMat:old('ApeMat') }}" id="ApeMat">
<br>
</div>


<div class="form-group">
<label for="Correo"> Correo </label>
<input type="text" class="form-control" name="Correo" 
value="{{ isset($paciente ->Correo)?$paciente ->Correo:old('Correo') }}"id="Correo">
<br>
</div>

<div class="form-group">
@if(isset($paciente->Foto))
<label for="Foto"> Foto </label>
<br>
<img class="img-thumbnail img-fluid" src="{{ asset('storage'.'/'.$paciente->Foto) }}" height="50px" width="50px">
@endif
<br>
<input type="file" class="form-control" name="Foto" id="Foto">
<br>
</div>

<input class="btn btn-primary" type="submit" value="{{$modo}} Datos">

<a class="btn btn-dark" href="{{ url('pacientes/') }}">Regresar</a>

<br>


