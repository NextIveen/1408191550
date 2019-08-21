@extends('page')
@section('content')
    <style>
        .map {
            width: 100%;
            height: 400px;
            background-color: grey;
        }
    </style>

    <div class="center_box cb">
        <div class="uo_tabs cf">
            <a href="/"><span>Profile</span></a>
            <a href="#"><span>Reviews</span></a>
            <a href="#"><span>Orders</span></a>
            <a href="#" class="active"><span>My Address</span></a>
            <a href="#"><span>Settings</span></a>
        </div>
        <div class="page_content bg_gray">
            <div class="uo_header">
                <div class="wrapper cf">
                    <div class="wbox ava">
                        <figure><img src="{{ asset('imgc/user_ava_1_140.jpg') }}" alt="Helena Afrassiabi" /></figure>
                    </div>
                    <div class="main_info">
                        <h1>Helena Afrassiabi</h1>
                        <div class="midbox">
                            <h4>560 points</h4>
                            <div class="info_nav">
                                <a href="#">Get Free Points</a>
                                <span class="sepor"></span>
                                <a href="#">Win iPad</a>
                            </div>
                        </div>
                        <div class="stat">
                            <div class="item">
                                <div class="num">30</div>
                                <div class="title">total orders</div>
                            </div>
                            <div class="item">
                                <div class="num">14</div>
                                <div class="title">total reviews</div>
                            </div>
                            <div class="item">
                                <div class="num">0</div>
                                <div class="title">total gifts</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uo_body">
                <div class="wrapper">
                    <div class="uofb cf">
                        <div class="l_col adrs">
                            <h2>Add New Address</h2>
                            {!! Form::open([
                               'url'    => route('addresses.store',$address->id),
                               'method' => 'post',
                               'class'  => 'address-form'
                             ]) !!}
                            <div class="field">
                                {!! Form::label('name', 'Name *') !!}
                                {!! Form::text('name', null, [
                                    'class'       => 'vl_empty',
                                    'placeholder' => '',
                                    'required'=>true
                                ]); !!}
                            </div>
                            <div class="field">
                                {!! Form::label('city', 'Your city *') !!}
                                {!! Form::select('city_id',$citiesMap ,null,[
                                    'class'       => 'vl_empty',
                                    'required'    => true

                                ]); !!}
                            </div>
                            <div class="field">
                                {!! Form::label('area', 'Your aria *') !!}
                                {!! Form::select('area_id',$areasMap ,null,[
                                    'class'       => 'vl_empty',
                                    'required'    => true

                                ]); !!}
                            </div>
                            <div class="field">
                                {!! Form::label('street', 'Street *') !!}
                                {!! Form::text('street', null, [
                                    'class'       => 'vl_empty',
                                    'placeholder' => '',
                                    'required'=>true

                                ]); !!}
                            </div>
                            <div class="field">
                                {!! Form::label('house', 'House #') !!}
                                {!! Form::text('house', null, [
                                    'class'       => 'vl_empty',
                                    'placeholder' => '',
                                ]); !!}
                            </div>
                            <div class="field">
                                {!! Form::label('info', 'Additional Information') !!}
                                {!! Form::text('info', null, [
                                    'class'       => 'vl_empty',
                                    'placeholder' => '',
                                ]); !!}
                            </div>
                            <div class="field">
                                {!! Form::submit(__('Add Address'), [
                                    'class' => 'green_btn',
                                ]) !!}
                            </div>
                        </div>

                        <div class="r_col">
                            <h2>My Addresses</h2>
                            <div class="uo_adr_list">
                                @foreach($addresses as $address)
                                    <div class="item">
                                        <h3>{{$address->name}} Address</h3>
                                        <p>{{$address->city->name.', '.$address->area->name.', '.$address->street.', '.$address->house}},<br/>{{$address->info}}  </p>
                                        <div class="actbox">
                                            <a href="#" class="bcross" onclick="deleteEntity('{{route('addresses.destroy', $address->id)}}')"></a>
                                        </div>
                                        <div class="map" id="map{{$address->id}}" ></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var data = [];
        @foreach($addresses as $address )
        data.push({
            id      : '{{ $address->id }}',
            city    : '{{ $address->city->name }}',
            street  : '{{ $address->street }}',
            house   : '{{ $address->house }}',
        });
        @endforeach

        function initMap() {
             data.map( element => {
                var geo = new google.maps.Geocoder();
                var map = new google.maps.Map(document.getElementById('map'+element.id), {zoom:15});
                var address = element.city + element.street + element.house;

                geo.geocode({'address': address}, function (results, status) {
                    console.log(results[0]);
                    if (status === google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location)
                        new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location
                        });
                    }
                });
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDq2-ZdfbOX-BNqj9VViQjbyg2hr3t12qU&callback=initMap"
            type="text/javascript">
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/address.js') }}"></script>
    <script>
        function deleteEntity(url) {
            $.ajax({
                type   : "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url    : url,
                success: function (data) {
                    if (data.success) {
                        swal(
                            'Deleted!',
                            'Data was deleted.',
                            'success',
                        ).then(function () {
                            location.reload();
                        })
                    } else {
                        swal(
                            'Data wasnt deleted! ',
                            data.messages,
                            'error'
                        )
                    }
                },
                error  : function (xhr) {
                    if (xhr.status == 500) {
                        swal({
                            type : 'error',
                            title: 'Oops...',
                            text : 'Something went wrong!',
                        })
                    }
                }
            })};
    </script>

@stop
