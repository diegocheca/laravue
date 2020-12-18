<?php
/**
 * File AuthController.php
 *
 * @author Tuan Duong <bacduong@gmail.com>
 * @package Laravue
 * @version 1.0
 */
namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Laravue\Models\Loglogin;
use App\Laravue\Models\User;
use App\Laravue\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\Api
 */
class AuthController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json(new JsonResponse([], 'login_error'), Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();

        //aca se agregan los ultimos logueos del usuario que se esta logueando
        //se guarda la fecha y hora de cuando se le dio el ok para ingresar
        $id_del_usuario = User::where('email', $request->email)->first();
        $log = new Loglogin;

        $log->id_user = $id_del_usuario->id;
        $log->estado = "login";
        $log->fecha = date("Y-m-d H:i:s");


        $log->save();

        return response()->json(new JsonResponse(new UserResource($user)), Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        //agrego el log del logout
        $id_del_usuario = User::where('email', $request->email)->first();
        $log = new Loglogin;

        $log->id_user = Auth::id();
        $log->estado = "logout";
        $log->fecha = date("Y-m-d H:i:s");


        $log->save();

        return response()->json((new JsonResponse())->success([]), Response::HTTP_OK);
    }

}
