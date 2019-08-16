@extends('admin.master.app')

@section('content-header')
    @contentheader(['breadcrumb' => $breadcrumb ?? [], 'title_header' =>  "Detalhes do ". $page['singular']])
    @endcontentheader
@endsection



@section('content')

    <div class="col-12 col-sm-8 align-items-stretch">
        <div class="card bg-light">
            <div class="card-body">

                @if($delete)
                    <div class="row">
                        <div class="col-md-12">
                            @message_admin(['color' => 'danger', 'icon' => 'asterisk'])
                                Deseja realmente excluir o {{$page['singular'] }} <span class="text-uppercase text-bold text-justify">{{$register->name}}</span>? A exclusão desse registro implicará na eliminação total do mesmo, incluíndo suas dependências.
                            @endmessage_admin
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-7">
                        <h2 class="lead"><b>Nome:</b> {{$register->name}}<br/><b>CNPJ:</b> {{$register->document}}</h2>
                        <p class="text-muted text-sm"><b>É credor: </b> {{($register->creditor)}} <br/> <b>É devedor: </b> {{($register->debtor)}} <br/> <b>Situação:</b> {{$register->is_active}}</p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Endereço: {{$register->street}}, {{$register->number}} {{$register->complement}} - {{$register->neighborhood}} - {{$register->zipcode}} <br/>{{$register->city}}/{{$register->state}}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> E-mail: {{$register->email}}</li>
                        </ul>
                    </div>
                    <div class="col-5 text-center">
                        <img src="{{url('assets/admin/dist/img/user2-160x160.jpg')}}" alt="" class="img-circle img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <form action="{{route('admin.'.$routeName.'.destroy', [$register->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <a href="{{route('admin.'.$routeName.'.index')}}" class="btn btn-sm btn-light">
                            <i class="fas fa-undo"></i> Voltar
                        </a>
                        @if ($delete)
                            <button type="submit" class="btn btn-sm btn-danger" title="Excluir" onclick="javascript: return confirm('Confirma a exclusão?');"><i class="fas fa-trash"></i> Excluir</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
