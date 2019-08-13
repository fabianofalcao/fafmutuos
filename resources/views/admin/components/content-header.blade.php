<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{$title_header}}</h1>
        </div>
        @if($breadcrumb)
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach($breadcrumb as $item)
                        @if($item->url)
                            <li class="breadcrumb-item"><a href="{{$item->url}}">{{$item->title}}</a></li>
                        @else
                            <li class="breadcrumb-item active"><a href="">{{$item->title}}</a></li>
                        @endif
                    @endforeach
                </ol>
            </div>
        @endif
    </div>
</div><!-- /.container-fluid -->

