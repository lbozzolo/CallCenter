
<ul class="list-group list-unstyled listado" id="accordion">
    @if(isset($permiso))
        <li class="list-group-item text-center">
            <a href="{{ route('permissions.index') }}"  class="btn btn-sm btn-default">Agregar nuevo permiso</a>
        </li>
    @endif

        <li class="list-group-item">
            <span style="cursor: pointer" data-toggle="collapse" data-target="#collapseBanco" aria-expanded="false" aria-controls="collapseBanco">
                Permisos de Bancos
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
                Permisos de Categorías
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
                Permisos de Clientes
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
                Permisos de Etapas
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
                Permisos de Formas de Pago
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
                Permisos de Imagenes
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
                Permisos de Instituciónes
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
                Permisos de Llamadas
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
                Permisos de Métodos de pago
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
                Permisos de Productos
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
                Permisos de Promociones
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
                Permisos de Reclamos
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
                Permisos de Usuarios
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
                Permisos de Ventas
            </span>
            <ul class="list-unstyled collapse"  id="collapseVentas" aria-labelledby="headingOne" data-parent="#accordion">
                @foreach($permisos as $permiso)
                    @if($permiso->model == 'venta')
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
