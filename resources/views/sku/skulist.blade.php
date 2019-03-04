@extends('layouts.left-layout')
@section('title','Item Listing')

@section('sidebar')
    @include('includes/dept-sidebar')
@endsection

@section('content')
    <div class="flex-center position-ref full-height">
        @if($skus && count($skus)>0)
            <div class="row">
                @foreach ($skus as $sku)

                    <div class="col-4">
                        <div class="card mb-4">
                            @if($sku->image_url)
                                <img src="/images/items/{{$sku->image_url}}" alt="{{$sku->image_name}}"/>

                            @else
                                <img src="/images/default_200.png" alt="{{$sku->image_name}}"/>

                            @endif

                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="card-title">{{$sku->name}}</h6>
                                    </div>
                                    <div class="col text-right text-danger">
                                        {{$sku->item_price}}
                                    </div>
                                </div>
                                <p class="text-muted"> {{$sku->item_desc}}</p>
                                <div class="btn-group">
                                    <a href="/cart/addItem?itemId={{$sku->item_id}}"
                                       class="btn btn-outline-primary btn-sm"
                                    >
                                        Add to Cart
                                    </a>
                                    <a href="/item/{{$sku->item_id}}" class="btn btn-outline-secondary btn-sm"
                                    >
                                        More Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        @else
            <br/><br/>
            <span class="alert alert-secondary">There were no items found!!</span>
        @endif

    </div>
@endsection




