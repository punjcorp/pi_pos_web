@extends('layouts.center-layout')
@section('title','Item Details')

@section('sidebar')
    @include('includes/dept-sidebar')
@endsection

@section('content')

    <span class="display-4">Item Details</span>
    <br/><br/>
    <div class="row">
        <div class="col-4">
            @if($itemData['item']->image_url)
                <img src="/images/items/{{$itemData['item']->image_url}}" alt="{{$itemData['item']->name}}"/>

            @else
                <img src="/images/default_200.png" alt="{{$itemData['item']->name}}"/>

            @endif
        </div>
        <div class="col">
            <h4>{{$itemData['item']->name}}</h4>
            <hr/>
            <div class="row">
                <div class="col-4 text-danger">
                    <b>
                        Price - $
                        {{$itemData['item']->item_price}}
                    </b>
                </div>
                <div class="col">
                    <a href="/cart/addItem?itemId={{$itemData['item']->item_id}}" class="btn btn-sm btn-primary">
                        Add to Cart
                    </a>
                </div>
            </div>

            <p class="text-muted">{{$itemData['item']->long_desc}}</p>
            <hr/>
            <h6>Item Attributes</h6>
            @foreach ($itemData['attrs'] as $attr)
                <div class="row">
                    <div class="col-3">
                        <b>{{$attr->attr_name}} - </b>
                    </div>
                    <div class="col text-left">{{$attr->value_name}}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection