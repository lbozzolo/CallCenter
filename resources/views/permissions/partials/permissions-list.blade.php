
<h3>Permisos disponibles</h3>

<ul class="list-group" id="accordion">
    @if(isset($permiso))
        <li class="list-group-item text-center">
            <a href="{{ route('permissions.index') }}"  class="btn btn-sm btn-default">Agregar nuevo permiso</a>
        </li>
    @endif

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseBanco" aria-expanded="false" aria-controls="collapseBanco">
                <h4>Permisos de Bancos</h4>
            </span>

            <ul class="list-unstyled collapse"  id="collapseBanco" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'banco')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseCategoria" aria-expanded="false" aria-controls="collapseCategoria">
                <h4>Permisos de Categorías</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapseCategoria" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'categoria')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseCliente" aria-expanded="false" aria-controls="collapseCliente">
                <h4>Permisos de Clientes</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapseCliente" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'cliente')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseEtapa" aria-expanded="false" aria-controls="collapseEtapa">
                <h4>Permisos de Etapas</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapseEtapa" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'etapa')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseFormasPago" aria-expanded="false" aria-controls="collapseFormasPago">
                <h4>Permisos de Formas de Pago</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapseFormasPago" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'formaPago')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseImagen" aria-expanded="false" aria-controls="collapseImagen">
                <h4>Permisos de Imagenes</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapseImagen" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'imagen')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseInstitucion" aria-expanded="false" aria-controls="collapseInstitucion">
                <h4>Permisos de Instituciónes</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapseInstitucion" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'institucion')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseLlamada" aria-expanded="false" aria-controls="collapseLlamada">
                <h4>Permisos de Llamadas</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapseLlamada" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'llamada')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseMetodoPago" aria-expanded="false" aria-controls="collapseMetodoPago">
                <h4>Permisos de Métodos de pago</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapseMetodoPago" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'metodoPago')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseProducto" aria-expanded="false" aria-controls="collapseProducto">
                <h4>Permisos de Productos</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapseProducto" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'producto')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapsePromocion" aria-expanded="false" aria-controls="collapsePromocion">
                <h4>Permisos de Promociónes</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapsePromocion" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'promocion')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseReclamos" aria-expanded="false" aria-controls="collapseReclamos">
                <h4>Permisos de Reclamos</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapseReclamos" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'reclamo')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseUsuario" aria-expanded="false" aria-controls="collapseUsuario">
                <h4>Permisos de Usuarios</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapseUsuario" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'user')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseVentas" aria-expanded="false" aria-controls="collapseVentas">
                <h4>Permisos de Ventas</h4>
            </span>
            <ul class="list-unstyled collapse"  id="collapseVentas" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'ventas')
                        <li class="list-group-item">
                            @include('permissions.partials.options-permisos')
                            <strong>{!! $permiso->name !!} ({!! $permiso->slug !!}) </strong><br>
                            <small>{!! $permiso->description !!}</small>
                            @include('permissions.partials.modal-eliminar-permiso')
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>

</ul>

@section('js')

    <script type="text/javascript">
        $( document ).ready(function() {
            $('.collapse').collapse({
                toggle: false
            });
        });
    </script>

@endsection
