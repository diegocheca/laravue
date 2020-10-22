<?php

namespace App\Http\Controllers;

use App\Laravue\Models\OrdenTrabajo;
use Illuminate\Http\Request;

use App\Http\Resources\OrdenTrabajoResource;

use Illuminate\Support\Facades\Validator;
class OrdenTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return OrdenTrabajoResource::collection(OrdenTrabajo::all());
    }
    public function ordenes_dashboard()
    {
        //
        $ordenes = OrdenTrabajo::select('id','description','idcliente','estado','porcent')->where('estado', '!=', 4)->get();

        return response()->json($ordenes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'description' => ['required'],
                'idcliente' => ['required'],
                'direccion' => ['required'],
                'idtecnico' => ['required'],
                'enddate' => ['required'],
                'estado'=> ['required']
            ]
        );
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $orden = OrdenTrabajo::create([
                'description' => $params['description'],
                'direccion' => $params['direccion'],
                'idcliente' => $params['idcliente'],
                'idtecnico' => $params['idtecnico'],
                'enddate' => $params['enddate'],
                'estado' => $params['estado']
            ]);
            return new OrdenTrabajoResource($orden);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laravue\\Models\\OrdenTrabajo  $ordenTrabajo
     * @return \Illuminate\Http\Response
     */
    public function show(OrdenTrabajo $ordenTrabajo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laravue\\Models\\OrdenTrabajo  $ordenTrabajo
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenTrabajo $ordenTrabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laravue\\Models\\OrdenTrabajo  $ordenTrabajo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenTrabajo $ordenTrabajo)
    {
        if ($ordenTrabajo === null) { // significa que la orden de trabajo es vacia
            return response()->json(['error' => 'Orden de trabajo not found'], 404);
        }

        $validator = Validator::make(
            $request->all(), // hago las validaciones de los campos que traje y son obligatorios
            [
                'description' => ['required'],
                'idcliente' => ['required'],
                'direccion' => ['required'],
                'idtecnico' => ['required'],
                'enddate' => ['required'],
                'estado'=> ['required']
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403); // error en las validaciones
        } else {
            
            $params = $request->all(); // paso los parametros a una nueva variable, al pedo
            $orden_a_actualizar = OrdenTrabajo::where('id', '=',  $params['id'])->first(); // busco la orden de trabajo a actualizar
            if($orden_a_actualizar == null) //significa que no encontre nada por el id
                return response()->json(['error' => 'Orden de trabajo no encontrada'], 404); // devuelvo error de orden no encontrada
            else // significa que si encontre la orden de trabajo que estoy buscando
            {
                // voy a actualizar los campos con los nuevos valores
                $orden_a_actualizar->description = $params['description'];
                $orden_a_actualizar->direccion = $params['direccion'];
                $orden_a_actualizar->idcliente = $params['idcliente'];
                $orden_a_actualizar->idtecnico = $params['idtecnico'];
                $orden_a_actualizar->enddate = $params['enddate'];
                $orden_a_actualizar->estado = $params['estado'];
                $orden_a_actualizar->save(); // guardo los cambios
            }
        }
        //return new OrdenTrabajoResource($ordenTrabajo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laravue\\Models\\OrdenTrabajo  $ordenTrabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //var_dump($id);
        try {
            $note = OrdenTrabajo::where('OrdenTrabajo_Id', '=',  $id)->first(); // busco la orden de trabajo a actualizar
            $note->delete();
        } catch (\Exception $ex) {
            response()->json(['error' => $ex->getMessage()], 403);
        }
    
        return response()->json(null, 204);
    }
}
