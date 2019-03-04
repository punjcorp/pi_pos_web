@extends('layouts.left-layout')
@section('title','Featured Item Listing')

@section('sidebar')
    @include('includes/item-sidebar')
@endsection

@section('content')
    <div class="flex-center position-ref full-height">
        @if($featuredItems && count($featuredItems)>0)
            <div class="row">
                @foreach ($featuredItems as $featuredItem)
                    <div class="col-4">
                        <div class="card mb-4">
                            @if($featuredItem->item()->first()->image_url)
                                <img src="/images/items/{{$featuredItem->item()->first()->image_url}}" alt="{{$featuredItem->item()->first()->item_name}}"/>

                            @else
                                <img src="/images/default_200.png" alt="{{$featuredItem->item()->first()->item_name}}"/>

                            @endif

                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="card-title">{{$featuredItem->item()->first()->item_name}}</h6>
                                    </div>
                                    <div class="col text-right text-danger">
                                        {{$featuredItem->item()->first()->item_price}}
                                    </div>
                                </div>
                                <p class="text-muted"> {{$featuredItem->item()->first()->item_desc}}</p>
                                <div class="btn-group">
                                    <a href="/cart/addItem?itemId={{$featuredItem->item()->first()->item_id}}"
                                            class="btn btn-outline-primary btn-sm"
                                    >
                                        Add to Cart
                                    </a>
                                    <a href="/item/{{$featuredItem->item()->first()->item_id}}" class="btn btn-outline-secondary btn-sm"
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
            <span class="alert alert-secondary">There were no featured items found!!</span>
        @endif

    {{--</div>--}}
@endsection




