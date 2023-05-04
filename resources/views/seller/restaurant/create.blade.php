@extends('layouts.seller')

@section('title')
    <title>پنل فروشنده | تکمیل مشخصات رستوران</title>
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card w-50 m-auto shadow">
                <div class="card-header text-center fw-bold fs-4">{{ __('تکمیل مشخصات رستوران') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('seller.restaurants.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="lat" name="lat" value="">
                        <input type="hidden" id="lng" name="lng" value="">
                        <div class="form-group mb-2">
                            <label class="mb-2" for="image">{{ __('تصویر رستوران') }}</label>
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="name">{{ __('نام رستوران') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="days">{{ __('روزهای کاری در هفته') }}</label>
                            <input id="days" type="text" class="form-control @error('days') is-invalid @enderror" name="days" value="{{ old('days') }}">
                            @error('days')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="start">{{ __('ساعت شروع کار') }}</label>
                            <input id="start" type="time" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}">
                            @error('start')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="end">{{ __('ساعت پایان کار') }}</label>
                            <input id="end" type="time" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end') }}">
                            @error('end')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="phone_number">{{ __('شماره تماس') }}</label>
                            <input id="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="account_number">{{ __('شماره حساب') }}</label>
                            <input id="account_number" type="number" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number') }}">
                            @error('account_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- <div class="form-group mb-2">
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') }}</textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> --}}
                        <label class="mb-2" for="address">{{ __('آدرس') }}</label>
                        <div style="height: 350px; background: #eee; border: 2px solid #aaa;" id="map"></div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="restaurant_categories_id">{{ __('دسته بندی های رستوران ها') }}</label>
                            <select id="restaurant_categories_id" type="text" class="form-control @error('name') is-invalid @enderror" name="restaurant_categories_id" value="{{ old('restaurant_categories_id') }}">
                                @foreach ($restaurantCategories as $restaurantCategory)
                                    <option value="{{ $restaurantCategory->id }}">{{ $restaurantCategory->name }}</option>
                                @endforeach
                            </select>    
                            @error('restaurant_categories_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ایجاد') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">
var lat=35.699739;
var lng=51.338097;

console.log(document.getElementById("lat").value);

if(document.getElementById("lat").value)
    lat=document.getElementById("lat").value;

if(document.getElementById("lng").value)
    lng=document.getElementById("lng").value;

// neshan map
var myMap = new L.Map('map', {
    key: 'web.ab95a829f72a4419befd9a0a8d1929ca',
    maptype: 'dreamy',
    poi: true,
    traffic: false,
    center: [lat, lng],
    zoom: 14
});

//add marker
var stuSplit = L.latLng(lat, lng);
var myMarker = new L.Marker(stuSplit,
    {
        title: 'unselected' ,
        draggable : true,
        clickable: true,
    })
    .addTo(myMap).on('dragend', (e)=>{
        document.getElementById("lat").value = e.target.getLatLng().lat;
        document.getElementById("lng").value = e.target.getLatLng().lng;
    });

function geocoding() {
    var log = document.getElementById("log");
    //getting adrress value from input tag
    var address = document.getElementById("address").value;
    //making url
    var url = `https://api.neshan.org/v4/geocoding?address=${address}`;
    console.log(url);
    //add your api key
    var params = {
        headers: {
            'Api-Key': 'web.ab95a829f72a4419befd9a0a8d1929ca'
        },

    };
    //sending get request
    axios.get(url, params)
        .then(data => {
            //using the data
            var lat = data.data.location.y;
            var lng = data.data.location.x;
            //logging the location
            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;
            //update marker location to address
            myMarker.setLatLng([lat, lng]);
            myMarker.bindPopup(address).openPopup();
            //set map center to address
            myMap.flyTo([lat, lng], 15);

        }).catch(err => {
        console.log("error = " + err);
        log.textContent = "Nothing found";

    });
}
</script>
@endsection