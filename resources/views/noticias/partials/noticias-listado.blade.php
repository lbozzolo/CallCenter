<div class="card-body">
    <div class="table-responsive">
        <table class="table student-data-table m-t-20">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Descripción</th>
                    <th class="text-right">Opciones</th>
                 </tr>
            </thead>
            <tbody>
            @forelse($noticias as $noticia)
                <tr>
                    <td>{!! $noticia->titulo !!}</td>
                    <td>{!! str_limit($noticia->descripcion, 35) !!}</td>
                    <td>
                        <button type="button" title="Eliminar" class=" btn btn-danger btn-xs" data-toggle="modal" data-target="#noticia{!! $noticia->id !!}"><i class="fa fa-trash-o"></i></button>
                        <a href="{!! route('noticias.edit', $noticia->id) !!}" class=" btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                        <a href="{!! route('noticias.show', $noticia->id) !!}" class=" btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>

                <div class="modal fade col-lg-4 col-lg-offset-8" id="noticia{!! $noticia->id !!}">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="card-title"><i class="fa fa-warning "></i> Eliminar noticia</h4>
                        </div>
                        <div class="card-body">
                            <p class="text-danger">Usted está a punto de eliminar la noticia devinitivamente</p>
                            <p>¿Desea continuar?</p>
                        </div>
                        <div class="card-footer">
                            {!! Form::open(['url' => route('noticias.destroy', $noticia->id), 'method' => 'delete', 'class' => 'form']) !!}
                                <button type="submit" class="btn btn-danger">Eliminar de todos modos</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="3">Todavía no hay ninguna noticia</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>