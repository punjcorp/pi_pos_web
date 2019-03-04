@extends('layouts.right-layout')
@section('title','Item Listing')

@section('content')
    @if($cart!==null)
        <div class="row">
            @foreach ($cart->cartItems()->get() as $cartItem)

                <div class="row mb-3">
                    <div class="col-3">
                        <img class="img-fluid"
                                src="/images/default_200.png"
                                alt="{{$cartItem->name}}"
                        />
                    </div>
                    <div class="col-6 text-left">
                        <h5>
                            {{$cartItem->name}}
                            <span class="text-danger">
                    {{"     $ "}}({{$cartItem->price}})
                  </span>
                        </h5>
                        <br/>
                        <p>{{$cartItem->description}}</p>
                    </div>
                    <div class="col text-left">
                        <div class="input-group">
                            <input
                                    type="number"
                                    step="1"
                                    class="form-control"
                                    value="{{$cartItem->qty}}"
                            />
                            <div class="input-group-append">
                                <a href="/cart/addItemQty?itemId={{$cartItem->item_id}}"
                                        class="btn btn-sm btn-outline-info"
                                                                      >
                                +
                                </a>
                                <a href="/cart/removeItemQty?itemId={{$cartItem->item_id}}"
                                        class="btn btn-sm btn-outline-danger"
                                                                        >
                                -
                                </a>
                                <a href="/cart/removeItem?itemId={{$cartItem->item_id}}"
                                        class="btn btn-sm btn-outline-danger"
                                                                        >
                                X
                                </a>
                            </div>
                        </div>

                        <br/>
                        <h6 class="text-danger">
                            <b>
                                {{" $ "}}
                                {{$cartItem->total}}
                            </b>
                        </h6>
                    </div>
                </div>

            @endforeach

        </div>
    @else
        <br/><br/>
        <span class="alert alert-secondary">Cart is Empty!!</span>
    @endif
@endsection


@section('right-sidebar')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <b><span> Subtotal Amount : </span></b>
                </div>
                <div class="col">
                    {{"$ ".number_format($cart->sub_total, 2, '.', ',')}}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <b><span> Total Tax Amount : </span></b>
                </div>
                <div class="col">
                    {{"$ ".number_format($cart->tax_total, 2, '.', ',')}}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <b><span> Total Amount : </span></b>
                </div>
                <div class="col">
                    {{"$ ".number_format($cart->total, 2, '.', ',')}}
                </div>
            </div>

            <div class="row my-5">
                <div class="col text-center">
                    <a href="/cart/checkout" class="btn btn-outline-success">Proceed to Checkout</a>
                </div>

            </div>
        </div>
    </div>

@endsection


