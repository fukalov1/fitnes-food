@extends('layouts._pages')


@section('content')

            <div class="container">
                <div class="goods-page-item" style="background: url(/uploads/{{ $data->image }})no-repeat center;">
                    {{--{{ dd($data) }}--}}
                    <h3>{{ $data->name }}</h3>
                    <p>&nbsp;</p>
                    <h3>{{ $data->name_ext }}</h3>
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
