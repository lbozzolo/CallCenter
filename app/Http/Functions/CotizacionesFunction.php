<?php

namespace SmartLine\Http\Functions;

use Illuminate\Support\Facades\Auth;

class CotizacionesFunction extends EnviopackFunction
{
    protected $service;

    public function __construct()
    {
        parent::__construct();

        $this->service = env('API_ENVIOPACK_COTIZAR_SERVICE');
    }

    public function getCotizacion($provincia, $codigoPostal, $peso, $paquetes, $direccionEnvio)
    {

        $accessToken = json_decode($this->callAuth())->token;

        $url = $this->urlBase . $this->service . "/costo?access_token=" . $accessToken
            . "&provincia=". $provincia . "&codigo_postal=". $codigoPostal
            . "&peso=". $peso
            . "&paquetes=". $paquetes
            . "&direccion_envio=". $direccionEnvio;

        $this->call($url, 'get', $body = [$provincia, $codigoPostal, $peso, $paquetes, $direccionEnvio]);
    }

    public function getComprador($provincia, $codigoPostal, $peso, $paquetes, $correo, $direccionEnvio)
    {
        $accessToken = json_decode($this->callAuth())->token;

        $url = $this->urlBase . $this->service . "/precio/a-sucursal?access_token=" . $accessToken
            . "&provincia=". $provincia . "&codigo_postal=". $codigoPostal
            . "&peso=". $peso
            . "&paquetes=". $paquetes
            . "&correo=" . $correo
            . "&direccion_envio=". $direccionEnvio;

        $this->call($url, 'get', $body = [$provincia, $codigoPostal, $peso, $paquetes, $correo, $direccionEnvio]);
    }

    public function getCorreos()
    {
        $accessToken = json_decode($this->callAuth())->token;
        $url = $this->urlBase . 'correos'. "?access_token=" . $accessToken;
        $this->call($url);
    }












    // casos
    public function getCasos()
    {
        $url = $this->urlBase . '/' . $this->service . "/casos?tipo_slug=dadse.mpt&estado_slug=pendiente&limit=50";

        $this->call($url);

    }

    public function getCasosDetalle($id)
    {
        $url = $this->urlBase . '/' . $this->service . "/casos/".$id;

        $this->call($url);
    }

    public function getDocumentos($id)
    {
        $url = $this->urlBase . '/' . $this->service . "/casos/".$id."/documentos";

        $this->call($url);
    }

    public function getFile($id)
    {
        $url = $this->urlBase . '/' . $this->service . "/documentos/".$id."/file";

        $this->call($url);

    }

    public function getNotas($id)
    {
        $url = $this->urlBase . '/' . $this->service . "/casos/".$id."/notas";

        $this->call($url);
    }

    public function postNotas($id , $msg)
    {
        $url = $this->urlBase . '/' . $this->service . "/casos/".$id."/notas";

        $body =  [ 'username'=> Auth::user()->username ,'mensaje'=> $msg];

        $this->call($url,'POST', $body);
    }

    public function postCasosCerrar($id)
    {
        $url = $this->urlBase . '/' . $this->service . "/casos/".$id;

        $body =  [ 'username'=> Auth::user()->username ,'estado_slug'=> 'finalizado' ];

        $this->call($url,'PATCH', $body);
    }
/// solicitudes

    public function searchSolicitudes($clasificacion = '', $estado = '')
    {
        $url = $this->urlBase . '/' . $this->service . "/solicitudes?clasificacion=$clasificacion&estado=$estado&limit=100";
        $this->call($url);
    }

    public function getSolicitud($id)
    {
        $url = $this->urlBase . '/' . $this->service . "/solicitudes/$id";
        $this->call($url);
    }

    public function getPrestacionesSolicitud($id)
    {
        $url = $this->urlBase . '/' . $this->service . "/solicitudes/$id/prestaciones";
        $this->call($url);
    }

    public function searchPersona($dato = '')
    {
        if(intval($dato))
            $url = $this->urlBase . '/' . $this->service . "/personas?offset=&limit=100&nombre=&documento=".$dato."&cuil=";
        else
            $url = $this->urlBase . '/' . $this->service . "/personas?offset=&limit=100&nombre=".urlencode($dato)."&documento=&cuil=";

        $this->call($url);
    }

    public function getPersona($id)
    {
        $url = $this->urlBase . '/' . $this->service . "/personas/$id";
        $this->call($url);
    }

    public function getOrganizacion($id)
    {
        $url = $this->urlBase . '/' . $this->service . "/organizacion/$id";
        $this->call($url);
    }

    public function getClasificaciones()
    {
        $url = $this->urlBase . '/' . $this->service . '/clasificaciones';
        $this->call($url);
    }

    public function updatePrestacion($idPrestacion, $idClasificacion = null, $idEstado = null, $cantidad = null)
    {
        $url = $this->urlBase . '/' . $this->service . "/prestaciones/$idPrestacion";
        $datos = [];

        // Clasificacion
        if (!is_null($idClasificacion) && $idClasificacion > 0)
            $datos['clasificacionId'] = $idClasificacion;

        // Estado
        if (!is_null($idEstado) && $idEstado > 0)
            $datos['estadoId'] = $idEstado;

        // Cantidad
        if (!is_null($cantidad))
            $datos['cantidad'] = $cantidad;

        $this->call($url, 'patch', $datos);
    }

    public function patchCasos($id , $estado)
    {
        //$datos['estado_slug'] = $estado;

        $url = $this->urlBase . '/' . $this->service . "/casos/".$id;

        $body =  [ 'username'=> Auth::user()->username ,'estado_slug'=> $estado ];

        $this->call($url,'patch',$body);


    }
}