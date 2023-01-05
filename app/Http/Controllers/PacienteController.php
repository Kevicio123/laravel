<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Enviaremos la lista de Pacientes */
        $datos['listPacientes']=Paciente::paginate(2);
        return view('pacientes.index',$datos);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[

            'Nombre'=>'required|string|max:100',
            'ApePat'=>'required|string|max:100',
            'ApeMat'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',

        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        ];

        $this->validate($request,$campos,$mensaje);

        /* $datosPaciente = request()->all(); */
        $datosPaciente = request()->except('_token');

        /* Para cambiar el formato de la foto y subirlo al sistema */
        if($request->hasFile('Foto')){
            $datosPaciente['Foto']=$request->file('Foto')->store('uploads','public');
        }

        /* Poner el nombre del Modelo */
        Paciente::insert($datosPaciente);
        // return response()->json($datosPaciente);
        return redirect('pacientes')->with('mensaje','Paciente agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $paciente = Paciente::findOrFail($id);

        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[

            'Nombre'=>'required|string|max:100',
            'ApePat'=>'required|string|max:100',
            'ApeMat'=>'required|string|max:100',
            'Correo'=>'required|email',
           

        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            
        ];
        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=['Foto.required'=>'La foto es requerida'];
        }

        $this->validate($request,$campos,$mensaje);



        /* $datosPaciente = request()->all(); */
        /* Method para que no se guarde en la BD*/
        $datosPaciente = request()->except(['_token','_method']);

        if($request->hasFile('Foto')){
            $paciente = Paciente::findOrFail($id);

            Storage::delete('public/'.$paciente->Foto);

            $datosPaciente['Foto']=$request->file('Foto')->store('uploads','public');
        }


        Paciente::where('id','=',$id)->update($datosPaciente);

        $paciente = Paciente::findOrFail($id);
        // return view('pacientes.edit', compact('paciente'));
        return redirect('pacientes')->with('mensaje','Paciente Editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Poner el nombre del Model  */

        $paciente = Paciente::findOrFail($id);

        /*Pregunta si la foto fue eliminada */
        if(Storage::delete('public/'.$paciente->Foto)){

            Paciente::destroy($id);

        }
     

        
        return redirect('pacientes')->with('mensaje','Paciente Borrado');
    }
}
