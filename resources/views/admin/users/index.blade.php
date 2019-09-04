@extends('admin.master.app')

@section('content-header')
    @contentheader(['breadcrumb' => $breadcrumb ?? [], 'title_header' => $page])
    @endcontentheader
@endsection



@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    @if(session()->exists('message'))
                        @message(['color' => session()->get('color')])
                        {{session()->get('message')}}
                        @endmessage
                    @endif

                    <a href="{{route('admin.'.$routeName.'.create')}}" class="btn btn-sm btn-success">{{$btnCaption}}</a>
                    <form class="float-right" action="{{route('admin.'.$routeName.'.search')}}" method="GET">
                        @csrf
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 300px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="Pesquisar" value="{{$dataForm['search'] ?? ''}}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            @foreach($colunmsTitle as $key => $value)
                                <th class="text-{{$value['aling']}}">{{$value['value']}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $l)
                                <tr>
                                    @foreach($colunmsTitle as $key => $value)
                                        @if($key != 'actions')
                                            <td class="text-{{$value['aling']}} align-middle">{{$l->$key}}</td>
                                        @else
                                            <td class="text-center align-middle" width="140px">
                                                <a href="{{ route('admin.'.$routeName.'.show', $l->id) }}" class="btn btn-dark btn-sm" title="Detalhar"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                <a href="{{ route('admin.'.$routeName.'.edit', $l->id) }}" class="btn btn-info btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                <a href="{{ route('admin.'.$routeName.'.show', [$l->id, 'delete=1']) }}" class="btn btn-danger btn-sm" title="Excluir"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <ul class="m-2 pr-3 float-right">
                        @if(isset($dataForm))
                            {!! $list->appends($dataForm)->links()  !!}
                        @else
                            {!! $list->links()  !!}
                        @endif
                    </ul>
                </div>
                <!-- /.card-body -->

                <div class="card-footer clearfix">
                    <ul class="float-right pt-3">
                        <a href="{{route('admin.home')}}" class="btn btn-sm btn-outline-secondary">Voltar</a>
                        <a href="{{route('admin.'.$routeName.'.create')}}" class="btn btn-sm btn-success">{{$btnCaption}}</a>
                    </ul>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection



@section('content-footer')

@endsection
