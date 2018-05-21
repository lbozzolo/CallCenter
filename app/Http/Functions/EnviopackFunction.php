<?php

namespace SmartLine\Http\Functions;

use Illuminate\Support\Facades\App;

class EnviopackFunction
{
    protected $apiKey;
    protected $secretKey;
    protected $authParam;
    protected $curl;
    protected $info;
    protected $header;
    protected $httpResultado;
    protected $httpResultadoAuth;
    protected $httpCode;
    protected $urlBase;

    public function __construct()
    {
        $this->urlBase = env('API_ENVIOPACK_URL');
        $this->header = [
            'Content-Type: application/x-www-form-urlencoded',
        ];
    }

    public function call($url = '', $method = 'GET', Array $body = [])
    {
        # Abro conexión
        $this->_init($url);

        # Método
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);

        # Si tiene parámetros en el body
        if (count($body) > 0)
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($body));

        # Ejecuto
        $this->httpResultado = $this->_exec();
        $this->httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        # Cierro
        $this->_close();
    }

    public function callAuth()
    {
        $authParam = 'api-key='.env('API_ENVIOPACK_KEY', '').'&secret-key='.env('API_ENVIOPACK_SECRET_KEY', '');

        # Abro conexión
        $this->_initAuth('https://api.enviopack.com/auth');

        # Método
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $authParam);

        # Ejecuto
        $this->httpResultadoAuth = $this->_exec();
        $this->info = curl_getinfo($this->curl);
        $this->httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        # Cierro
        $this->_close();

        return $this->httpResultadoAuth;
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function getResultado()
    {
        return json_decode($this->httpResultado);
    }

    public function getResultadoAuth()
    {
        return json_decode($this->httpResultadoAuth);
    }

    protected function _close()
    {
        curl_close($this->curl);
    }

    protected function _exec()
    {
        return curl_exec($this->curl);
    }

    protected function _init($url)
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->header);

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        # Si la aplicación no está en producción, desactivo comprobación de Cert SSL
        if (!App::environment('production'))
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
    }

    protected function _initAuth($url)
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->header);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        # Si la aplicación no está en producción, desactivo comprobación de Cert SSL
        if (!App::environment('production'))
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
    }


}