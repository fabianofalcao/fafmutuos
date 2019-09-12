@extends('admin.master.app')

@section('content-header')
    @contentheader(['breadcrumb' => $breadcrumb ?? [], 'title_header' =>  "Detalhes do ". $page['singular']])
    @endcontentheader
@endsection



@section('content')

    <div class="col-12 col-sm-8 align-items-stretch">
        <div class="card bg-light">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h2 class="lead"><b>Nome:</b> {{$register->user->name}}<br/><b>CNPJ:</b> {{$register->user->document}}<br/><b>Setor econômico de interesse: </b> {{$register->economic_sector->description}}<br/><b>Valor a invstir:</b> R$ {{$register->value}}</h2>
                        <p> </p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Endereço: {{$register->user->street}}, {{$register->user->number}} {{$register->user->complement}} - {{$register->user->neighborhood}} - {{$register->user->zipcode}} <br/>{{$register->user->city}}/{{$register->user->state}}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> E-mail: {{$register->user->email}}</li>
                        </ul>
                    </div>
                    <div class="col-5 text-center">
                        <img src="{{url('assets/admin/dist/img/user2-160x160.jpg')}}" alt="" class="img-circle img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <a href="{{route('admin.'.$routeName.'.index')}}" class="btn btn-sm btn-light">
                        <i class="fas fa-undo"></i> Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
