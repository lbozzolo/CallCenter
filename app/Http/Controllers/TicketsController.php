<?php namespace SmartLine\Http\Controllers;

use SmartLine\Entities\EstadoTicket;
use SmartLine\Entities\Ticket;
use Illuminate\Support\Facades\Auth;
use SmartLine\Entities\TicketComment;
use SmartLine\Http\Requests\CreateTicketRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketsController extends Controller
{
    protected $modulos;

    public function __construct()
    {
        $this->modulos = ['ASIGNACIONES', 'AUDITORÍA', 'CATEGORÍAS', 'CLIENTES', 'FACTURACIÓN', 'LOGÍSTICA', 'MÉTODOS DE PAGO', 'MOVIMIENTOS', 'NOTICIAS', 'POSTVENTA', 'PRODUCTOS', 'RECLAMOS', 'USUARIOS', 'VENTAS', 'OTROS'];
    }

    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $data['modulos'] = $this->modulos;
        return view('tickets.create')->with($data);
    }

    public function store(CreateTicketRequest $request)
    {
        $abierto = EstadoTicket::where('slug', 'abierto')->first();

        $ticket = Ticket::create([
            'user_id' => Auth::user()->id,
            'estado_id' => $abierto->id,
            'subject' => $request->subject,
            'modulo' => $request->modulo,
            'body' => $request->body,
            'level_id' => $request->level_id
        ]);

        if(!$ticket)
            return redirect()->back()->withErrors('Ocurrió un error. No se pudo enviar el ticket');

        return redirect()->route('tickets.mis.tickets')->with('ok', 'Ticket enviado con éxito');
    }

    public function misTickets()
    {
        $data['user'] = Auth::user();
        $data['tickets'] = $data['user']->tickets;

        return view('tickets.mis-tickets')->with($data);
    }

    public function show($id)
    {
        $data['ticket'] = Ticket::find($id);

        $data['comments'] = $data['ticket']->comments->sortByDesc('id');

        return view('tickets.show')->with($data);
    }

    public function comment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|max:500',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $comment = TicketComment::create([
            'user_id' => Auth::user()->id,
            'ticket_id' => $id,
            'body' => $request->body
        ]);

        if(!$comment)
            return redirect()->back()->withErrors('Ocurrió un error. No se pudo guardar el comentario.');

        return redirect()->back();
    }

    public function cambiarCriticidad(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->level_id = ($request->level_id)? $request->level_id : $ticket->level_id;
        $ticket->save();

        return redirect()->back();
    }

    public function changeState($id)
    {
        $ticket = Ticket::find($id);

        $cerrado = EstadoTicket::where('slug', 'cerrado')->first();
        $abierto = EstadoTicket::where('slug', 'abierto')->first();

        if ($ticket->estado_id == $cerrado->id){
            $ticket->estado_id = $abierto->id;
        }elseif ($ticket->estado_id == $abierto->id) {
            $ticket->estado_id = $cerrado->id;
        }

        $ticket->save();

        return redirect()->back();
    }


}