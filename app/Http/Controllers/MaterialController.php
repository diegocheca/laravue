<?php

namespace App\Http\Controllers;

use App\Laravue\Models\Material;
use Illuminate\Http\Request;
use App\Http\Resources\MaterialResource;
use Illuminate\Support\Facades\Validator;


class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MaterialResource::collection(Material::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = Validator::make(
            $request->all(),
            [
                'descripcion' => ['required'],
                'stock' => ['required'],
                'proveedor' => ['required'],
                'contactoproveedor' => ['required'],
                'unidad' => ['required'],
            ]
        );
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $orden = Material::create([
                'descripcion' => $params['descripcion'],
                'stock' => $params['stock'],
                'proveedor' => $params['proveedor'],
                'contactoproveedor' => $params['contactoproveedor'],
                'unidad' => $params['unidad'],
            ]);
            return new MaterialResource($orden);
        }
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
                'descripcion' => ['required'],
                'stock' => ['required'],
                'proveedor' => ['required'],
                'contactoproveedor' => ['required'],
                'unidad' => ['required'],
            ]
        );
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $orden = Material::create([
                'descripcion' => $params['descripcion'],
                'stock' => $params['stock'],
                'proveedor' => $params['proveedor'],
                'contactoproveedor' => $params['contactoproveedor'],
                'unidad' => $params['unidad'],
            ]);
            return new MaterialResource($orden);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laravue\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laravue\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laravue\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
       // echo("Por mostrar");
       // var_dump($request);
        //
        if ($material === null) { // significa que la orden de trabajo es vacia
            return response()->json(['error' => 'Orden de trabajo not found'], 404);
        }

        $validator = Validator::make(
            $request->all(), // hago las validaciones de los campos que traje y son obligatorios
            [
                'descripcion' => ['required'],
                'stock' => ['required'],
                'proveedor' => ['required'],
                'contactoproveedor' => ['required'],
                'unidad' => ['required']
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403); // error en las validaciones
        } else {
            echo("estoy actualizando");
            $params = $request->all(); // paso los parametros a una nueva variable, al pedo
            $orden_a_actualizar = Material::find($params['id']);// busco la orden de trabajo a actualizar
            if($orden_a_actualizar == null) //significa que no encontre nada por el id
                return response()->json(['error' => 'Orden de trabajo no encontrada'], 404); // devuelvo error de orden no encontrada
            else // significa que si encontre la orden de trabajo que estoy buscando
            {
                // voy a actualizar los campos con los nuevos valores
                $orden_a_actualizar->descripcion = $params['descripcion'];
                $orden_a_actualizar->stock = $params['stock'];
                $orden_a_actualizar->proveedor = $params['proveedor'];
                $orden_a_actualizar->contactoproveedor = $params['contactoproveedor'];
                $orden_a_actualizar->unidad = $params['unidad'];
                $orden_a_actualizar->save(); // guardo los cambios
            }
        }
        //return new OrdenTrabajoResource($ordenTrabajo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laravue\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $material_a_borrar = Material::find($id)->delete(); // busco la orden de trabajo a actualizar
        } catch (\Exception $ex) {
            response()->json(['error' => $ex->getMessage()], 403);
        }
    
        return response()->json(null, 204);
    }
}
