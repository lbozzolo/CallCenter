<?php namespace SmartLine\Http\Controllers;

use SmartLine\Entities\Banco;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\Entity;
use SmartLine\User;
use Bican\Roles\Models\Role;
use SmartLine\Entities\Categoria;
use SmartLine\Entities\Producto;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SmartLine\Http\Controllers\Controller;
use SmartLine\Entities\ValidateCreditCard;

class DashboardController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function test()
    {
    // TARJETAS DE EJEMPLO
    // http://generatarjetasdecredito.com/
        $credit_card_user    = "4594439577977162"; // VISA
    // $credit_card_user = "5370517873215895"; // MASTER CARD
    // $credit_card_user = "372249624477942";  // American Express
    // $credit_card_user = "6011103438289080"; // Discover Card
    // $credit_card_user = "30350727682943";   // Diners Club Carte Blanche
    // $credit_card_user = "36612758986350";   // Diners Club International
    // $credit_card_user = "3370728773640984"; // JCB

    // Comprueba el formato
        echo (ValidateCreditCard::validateFormatCreditCard($credit_card_user)) ? 'VALIDO<br>' : 'NO VALIDO<br>';

    // Comprueba la validez mediante el algoritmo de Luhn
        echo (ValidateCreditCard::calculateLuhn($credit_card_user)) ? 'SI' : 'NO';
    }

}