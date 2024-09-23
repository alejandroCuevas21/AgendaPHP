<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use View;

class AgendasController extends Controller
{
 

    public function VisualizarConsultaAgenda() {
     $Agendas = Agenda::all();
        return view('Agendas.ConsultarAgenda', compact('Agendas'));
            
    }

  
    public function VisualizarInsertarContacto($id = null) {
        $contacto = null;
        $Accion = 'Alta'; 
    
        if ($id) {
            $contacto = Agenda::findOrFail($id); 
            $Accion = 'Actualizar';
        }
    
        return view('Agendas.InsertaAgenda', compact('contacto', 'Accion'));
    }
    


    public function InsertarAgenda(Request $request)
    {
        // Validación de datos
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Domicilio' => 'required|string|max:255',
            'Numero' => 'required|integer',
            'Colonia' => 'required|string|max:255',
            'CP' => 'required|string|max:10',
            'Ciudad' => 'required|string|max:255',
            'Estado' => 'required|string|max:255',
            'Telefono' => 'required|string|max:25',
            'Correo' => 'required|email|max:255',
            'Latitud' => 'required|numeric',
            'Longitud' => 'required|numeric',
        ]);

        // Crear el nuevo registro
        $agenda = Agenda::create($request->all());

        // Retornar respuesta
     //   return response()->json($agenda, 201);

     return response()->json(['success' => true,'Mensaje' => 'Se guardo el contacto correctamente' ]);
    }

    public function ConsultaRegistroAgenda($id) {
        $agenda= Agenda::findOrFail($id);

        return response()->json($agenda);
    }

    
    public function ActualizarAgenda(Request $request, $id)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Domicilio' => 'required|string|max:255',
            'Numero' => 'required|integer',
            'Colonia' => 'required|string|max:255',
            'CP' => 'required|string|max:10',
            'Ciudad' => 'required|string|max:255',
            'Estado' => 'required|string|max:255',
            'Telefono' => 'required|string|max:25',
            'Correo' => 'required|email|max:255',
            'Latitud' => 'required|numeric',
            'Longitud' => 'required|numeric',
        ]);

        $contacto =Agenda::findOrFail($id);
        $contacto->update($validatedData);

        return response()->json(['success' => true, 'contacto' => $contacto ,'Mensaje' => 'Se actualizo el contacto correctamente' ]);
    }
 
}

