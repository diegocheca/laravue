<?php

namespace App\Http\Controllers;

use App\Laravue\Models\OrdenTrabajoMaterial;
use Illuminate\Http\Request;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\OrdenTrabajoResource;
use App\Http\Resources\OrdenTrabajoMaterialResource;


class OrdenTrabajoMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrdenTrabajoMaterialResource::collection(OrdenTrabajoMaterial::all());
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
    
    public function ordenes_para_un_material($id)
    {
        //
        //var_dump("el idea que traje es:".$id);
        return OrdenTrabajoMaterial::select('*')->where('material_id', '=', $id)->get();;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laravue\Models\OrdenTrabajoMaterial  $ordenTrabajoMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(OrdenTrabajoMaterial $ordenTrabajoMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laravue\Models\OrdenTrabajoMaterial  $ordenTrabajoMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenTrabajoMaterial $ordenTrabajoMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laravue\Models\OrdenTrabajoMaterial  $ordenTrabajoMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenTrabajoMaterial $ordenTrabajoMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laravue\Models\OrdenTrabajoMaterial  $ordenTrabajoMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdenTrabajoMaterial $ordenTrabajoMaterial)
    {
        //
    }
}
