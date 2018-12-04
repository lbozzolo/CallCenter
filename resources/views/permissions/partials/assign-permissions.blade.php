<div class="row">

    @foreach($models as $model)
        <div class="col-lg-4 col-md-4 col-sm-6">
            @foreach($model as $key => $value)

                <div class="card card-default">
                    <div class="card-heading">
                        <h4 class="card-title">{!! $names[$value] !!}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($permisos as $permiso)
                                @if($permiso->model == $value)
                                    <li>
                                        <div class="form-check">
                                            @if(isset($user))
                                                {!! Form::checkbox('permissions[]', $permiso->id, ($user->hasPermission($permiso->id))) !!}
                                            @else
                                                {!! Form::checkbox('permissions[]', $permiso->id) !!}
                                            @endif
                                            {!! $permiso->name !!}
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

            @endforeach
        </div>
    @endforeach

</div>