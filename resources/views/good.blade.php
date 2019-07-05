@extends('layouts._pages')


@section('content')

            <div class="container">
                <div class="goods-page-item" style="background: url(/uploads/{{ $data->image }})no-repeat center;">
                    <h2>{{ $data->name }}</h2>
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
