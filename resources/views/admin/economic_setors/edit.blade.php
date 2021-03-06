@extends('admin.master.app')

@section('content-header')
    @contentheader(['breadcrumb' => $breadcrumb ?? [], 'title_header' =>  "Editar ". $page['singular']])
    @endcontentheader
@endsection



@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar {{$page['singular']}}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('admin.jobs.update', [$register->id]) }}">
            {{ csrf_field() }}
            @method('PUT')
            <div class="card-body">

                @if($errors->all())
                    @foreach($errors->all() as $error)
                        @message(['color' => 'danger', 'icon' => 'error'])
                        {{$error}}
                        @endmessage
                    @endforeach
                @endif

                @if(session()->exists('message'))
                    @message(['color' => session()->get('color')])
                        <p class="icon-asterisk">{{session()->get('message')}}</p>
                    @endmessage
                @endif


                <h4>Dados de acesso</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="name">Descrição *</label>
                            <input id="name" type="text" class="form-control" name="description" value="{{ old('description') ?? $register->description }}" placeholder="Descrição" required autofocus>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="text-right">
                        <a href="{{route('admin.'.$routeName.'.index')}}" class="btn btn-sm btn-light">
                            <i class="fas fa-undo"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-sm btn-success" title="Salvar alterações"><i class="fas fa-save"></i> Salvar alterações</button>
                    </form>
                </div>
            </div>

        </form>
    </div>

@endsection
