<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //API:GET/director
    public function index()
    {
        $directores = Director::OrderBy('id', 'desc')->get();
        return view('src/director/ScreenDirector', compact('directores'));
    }
    public function eliminar($id)
    {
        $director = Director::findOrFail($id);
        $director->delete();

        return response()->json(['message' => 'Director eliminado correctamente']);
    }
    public function actualizar(Request $request, $id)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'ext_num' => 'required',
            'usu_nom' => 'required',
            'dep_nom' => 'required',
            'depto_nom' => 'required',
           
        ]);

        // Buscar el director por su ID
        $director = Director::findOrFail($id);

        // Actualizar los datos del director con los datos recibidos del formulario
        $director->ext_num = $request->ext_num;
        $director->usu_nom = $request->usu_nom;
        $director->dep_nom = $request->dep_nom;
        $director->depto_nom = $request->depto_nom;
      
        // Guardar los cambios en la base de datos
        $director->save();

        $directores = Director::OrderBy('id', 'desc')->get();
        // Devolver una respuesta JSON indicando éxito
        return response()->json(['success' => true, 'message' => 'Datos del director actualizados correctamente',"datos"=>$directores]);
    }
    public function guardar(Request $request)
    {
        // Validación de los datos recibidos del formulario
        $request->validate([
            'ext_num' => 'required',
            'usu_nom' => 'required',
            'dep_nom' => 'required',
            'depto_nom' => 'required',
           
        ]);

        try {
            // Crear un nuevo director
            $director = new Director();
        
            $director->ext_num  = $request->ext_num;
            $director->usu_nom  = $request->usu_nom;
            $director->dep_nom  = $request->dep_nom;
            $director->depto_nom = $request->depto_nom;
            $director->save();

            // Respuesta JSON de éxito
            return response()->json([
                'success' => true,
                'message' => 'Director agregado correctamente'
            ]);

        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json([
                'error' => false,
                'message' => 'Error al agregar el director: ' . $e->getMessage()
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //traer director por id
        $director = Director::findOrFail($id);
        return $director;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
