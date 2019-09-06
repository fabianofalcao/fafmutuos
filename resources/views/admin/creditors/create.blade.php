@extends('admin.master.app')

@section('content-header')
    @contentheader(['breadcrumb' => $breadcrumb ?? [], 'title_header' =>  "Adicionar ". $page['singular']])
    @endcontentheader
@endsection



@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Novo {{$page['singular']}}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('admin.'.$routeName.'.store') }}" autocomplete="off">
            {{ csrf_field() }}
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

                <h4>Dados da proposta</h4>
                    <input type="hidden" name="economic_sector_invest" value="teste">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="user_id">Nome do cliente *</label>
                            <select name="user_id" id="user_id" class="form-control" required autofocus>
                                <option value="">Selecione um cliente...</option>
                                @foreach($users as $item)
                                    <option value="{{$item->id}}" {{(old('user_id') ? 'selected' : '')}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="service_id">Setor econômico *</label>
                            <select name="service_id" id="service_id" class="form-control" required>
                                <option value="">Selecione um setor econômico...</option>
                                @foreach($sectors as $item)
                                    <option value="{{$item->id}} {{(old('service_id') ? 'selected' : '')}}">{{$item->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="value">Valor do aporte *</label>
                            <input id="value" type="text" class="form-control mask-money" name="value" value="{{ old('value') }}" placeholder="Valor do aporte" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="text-right">
                        <a href="{{route('admin.'.$routeName.'.index')}}" class="btn btn-sm btn-light">
                            <i class="fas fa-undo"></i> Voltar
                        </a>
                        <button type="submit" class="btn btn-sm btn-success" title="Cadastrar"><i class="fas fa-save"></i> Cadastrar</button>
                    </form>
                </div>
            </div>

        </form>
    </div>

@endsection
