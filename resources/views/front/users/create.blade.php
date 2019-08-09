@extends('front.master.app')

@section('content')
    <div class="content">
        <div class="container">
            <h1 class="title">Empréstimos para empresas</h1>
            <p>Preencha o formulário abaixo e solicite uma proposta.</p>

            @if($errors->all())
                @foreach($errors->all() as $error)
                    @message(['color' => 'danger'])
                        {{$error}}
                    @endmessage
                @endforeach
            @endif

            @if(session()->exists('message'))
                @message(['color' => session()->get('color')])
                {{session()->get('message')}}
                @endmessage
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('users.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="type" value="{{$type}}">
                <h4>Dados de acesso</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Nome/Razaão Social *</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nome" required autofocus>
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
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail" required>
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
                            <input id="text" type="text" class="form-control mask-cnpj" name="cnpj" value="{{ old('cnpj') }}" placeholder="CNPJ" required>
                            @if ($errors->has('cnpj'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cnpj') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Senha *</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Senha" required>
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
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Senha" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <h4 class="mt-3">Endereço</h4>
                <div class="row">
                    <div class="col-12 col-sm-3">
                        <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                            <label for="zipcode">CEP</label>
                            <input id="zipcode" type="text" class="form-control zip_code_search mask-zipcode" name="zipcode" value="{{ old('zipcode') }}" placeholder="CEP" required>
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
                            <input id="street" type="text" class="form-control street" name="street" value="{{ old('street') }}" placeholder="Logradouro">
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
                            <input id="number" type="text" class="form-control" name="number" value="{{ old('number') }}" placeholder="Número">
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
                            <input id="comlement" type="text" class="form-control" name="comlement" value="{{ old('comlement') }}" placeholder="Complemento">
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
                            <input id="neighborhood" type="text" class="form-control neighborhood" name="neighborhood" value="{{ old('neighborhood') }}" placeholder="Bairro">
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
                            <input id="state" type="text" class="form-control state" name="state" value="{{ old('state') }}" placeholder="Estado">
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
                            <input id="city" type="text" class="form-control city" name="city" value="{{ old('city') }}" placeholder="Cidade">
                            @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>


                <h4 class="mt-3">Proposta</h4>

                @if($type == 'debtor')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('source_of_debt') ? ' has-error' : '' }}">
                                <label for="source_of_debt">Qual a necessidade do crédito *</label>
                                <input id="source_of_debt" type="text" class="form-control" name="source_of_debt" value="{{ old('source_of_debt') }}" placeholder="Necessidade do crédito" required>
                                @if ($errors->has('source_of_debt'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('source_of_debt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('job_id') ? ' has-error' : '' }}">
                                <label for="job_id">Tipo de mão de obra especializada *</label>
                                <select name="job_id" id="job_id" class="form-control" required>
                                    <option value="">Selecione a mão de obra especializada</option>
                                    @foreach($jobs as $item)
                                        <option value="{{$item->id}}" {{(old('job_id') == $item ? 'selected' : '')}}>{{$item->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                                <label for="value">Valor pretendido</label>
                                <input id="value" type="text" class="form-control" name="value" value="{{ old('value') }}" placeholder="Valor pretendido" required>
                                @if ($errors->has('value'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('value') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('economic_sector_invest') ? ' has-error' : '' }}">
                                <label for="economic_sector_invest">Qual o setor econômico?</label>
                                <input id="economic_sector_invest" type="text" class="form-control" name="source_of_debt" value="{{ old('economic_sector_invest') }}" placeholder="Setor econômico" required>
                                @if ($errors->has('economic_sector_invest'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('economic_sector_invest') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('service_id') ? ' has-error' : '' }}">
                                <label for="service_id">Tipo de serviço</label>
                                <select name="service_id" id="service_id" class="form-control">
                                    <option value="">Selecione o tipo de serviço</option>
                                    @foreach($services as $item)
                                        <option value="{{$item->id}}" {{(old('service_id') == $item ? 'selected' : '')}}>{{$item->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                                <label for="value">Valor a investir</label>
                                <input id="value" type="text" class="form-control" name="value" value="{{ old('value') }}" placeholder="Valor a investir" required>
                                @if ($errors->has('value'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('value') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif



                <hr>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>










            </form>

        </div>
    </div>
@endsection
