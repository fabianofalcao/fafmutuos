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

        <form class="form-horizontal" method="POST" action="{{ route('admin.users.update', [$register->id]) }}">
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


                <h4>Dados de acesso</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Nome/Razaão Social *</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ?? $register->name }}" placeholder="Nome" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-mail *</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') ?? $register->email }}" placeholder="E-mail" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group{{ $errors->has('cnpj') ? ' has-error' : '' }}">
                            <label for="cnpj">CNPJ *</label>
                            <input id="text" type="text" class="form-control mask-cnpj" name="cnpj" value="{{ old('cnpj') ?? $register->document}}" placeholder="CNPJ" required>
                            @if ($errors->has('cnpj'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cnpj') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <label for="type">Tipo: *</label>
                        <div class="card text-white bg-dark mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-3" type="checkbox" id="debtor" name="debtor" {{($register->debtor == 'Sim' ? 'checked' : '')}}>
                                <label class="form-check-label" for="debtor">Devedor</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-3" type="checkbox" id="creditor"  name="creditor" {{($register->creditor == 'Sim' ? 'checked' : '')}}>
                                <label class="form-check-label" for="creditor">Credor</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input ml-3" type="checkbox" id="is_admin"  name="is_admin" {{($register->is_admin == 1 ? 'checked' : '')}}>
                                <label class="form-check-label" for="creditor">Administrador</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Senha *</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Senha">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password-confirm">Confirmar Senha</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Senha">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="type">Situação *</label>
                        <div class="card text-white bg-dark mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input mb-3 ml-3 mt-3" type="checkbox" id="is_active" name="is_active" {{($register->is_active == 'Ativo' ? 'checked' : '')}}>
                                <label class="form-check-label" for="is_active">Usuário ativo?</label>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="mt-3">Endereço</h4>
                <div class="row">
                    <div class="col-12 col-sm-3">
                        <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                            <label for="zipcode">CEP</label>
                            <input id="zipcode" type="text" class="form-control zip_code_search mask-zipcode" name="zipcode" value="{{ old('zipcode') ?? $register->zipcode}}" placeholder="CEP" required>
                            @if ($errors->has('zipcode'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                            <label for="street">Logradouro <small>(Rua, Av, Travessa, etc...)</small></label>
                            <input id="street" type="text" class="form-control street" name="street" value="{{ old('street') ?? $register->street}}" placeholder="Logradouro">
                            @if ($errors->has('street'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('street') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                            <label for="number">Número</label>
                            <input id="number" type="text" class="form-control" name="number" value="{{ old('number') ?? $register->number}}" placeholder="Número">
                            @if ($errors->has('number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group{{ $errors->has('complement') ? ' has-error' : '' }}">
                            <label for="comlement">Complemento</label>
                            <input id="comlement" type="text" class="form-control" name="comlement" value="{{ old('comlement') ?? $register->complement}}" placeholder="Complemento">
                            @if ($errors->has('comlement'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('comlement') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group{{ $errors->has('neighborhood') ? ' has-error' : '' }}">
                            <label for="neighborhood">Bairro</label>
                            <input id="neighborhood" type="text" class="form-control neighborhood" name="neighborhood" value="{{ old('neighborhood')  ?? $register->neighborhood}}" placeholder="Bairro">
                            @if ($errors->has('neighborhood'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('neighborhood') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state">Estado</label>
                            <input id="state" type="text" class="form-control state" name="state" value="{{ old('state') ?? $register->state}}" placeholder="Estado">
                            @if ($errors->has('state'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city">Cidade</label>
                            <input id="city" type="text" class="form-control city" name="city" value="{{ old('city') ?? $register->city}}" placeholder="Cidade">
                            @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
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
