<div class="card">
    <div class="card-header">
        <h3>Listado de asignaciones históricas</h3>
        <hr>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="div-table-asignaciones-historicas">

            <table class="table table-vertical dataTable" id="table-asignaciones-historicas">

                <thead>
                <tr>
                    <th>Id</th>
                    <th>Supervisor</th>
                    <th>Operador</th>
                    <th>Dato</th>
                    <th>Fecha</th>
                </tr>
                </thead>
                <tbody>

                @foreach($historicas as $asignacion)

                    <tr>
                        <td style="color: darkgray">{!! $asignacion->id !!}</td>
                        <td style="color: darkgray">{!! $asignacion->supervisor->full_name !!}</td>
                        <td style="color: darkgray">{!! $asignacion->operador->full_name !!}</td>
                        <td style="color: darkgray">{!! $asignacion->cliente->full_name !!}</td>
                        <td style="color: darkgray">{!! $asignacion->fecha_creado !!}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>