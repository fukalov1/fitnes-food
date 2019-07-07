@extends('layouts._pages')


@section('content')

            <div class="container">
                <div class="goods-page-item" style="background: url(/uploads/{{ $data->image }})no-repeat center;">
                    <h3>{{ $data->name or '' }}</h3>
                    <p>&npsp;</p>
                    <h3>{{ $data->name_ext or '' }}</h3>
                </div>

                <div class="about-page-main">
                    <div class="row">
                            <div class="col-md-6">
                                {!! $data->text !!}
                            </div>
                            <div class="col-md-6">
                                {!! $data->info !!}
                            </div>
                    </div>
                </div>
            </div>



@stop
