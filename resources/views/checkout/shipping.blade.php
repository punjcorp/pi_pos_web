@extends('layouts.center-layout')

@section('content')
    <div class="container">
        @if( !empty($selectedUserAddress))
            <div class="row">
                <div class="col-4">
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    {{$selectedUserAddress->address1.', '}}
                                </div>
                            </div>
                            @if($selectedUserAddress->address2)
                                <div class="row">
                                    <div class="col">
                                        {{$selectedUserAddress->address2.', '}}
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col">
                                    {{$selectedUserAddress->city.', '.$selectedUserAddress->state}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    {{$selectedUserAddress->country.' - '.$selectedUserAddress->pincode}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    {{'Primary address - '.$selectedUserAddress->primary}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card mb-4">
                        <div class="card-body">

                            <a href="{{route('addAddress')}}" class="btn btn-sm btn-outline-info">Add New Address</a>
                            <br><br>
                            <button class="btn btn-sm btn-outline-success" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">
                                Choose Another Address
                            </button>
                            <br><br>
                            <a href="{{route('paymentStep')}}" class="btn btn-sm btn-outline-danger">Proceed to
                                Payment</a>


                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if( empty($selectedUserAddress))
            <div class="flex-center position-ref full-height">
                @else
                    <div class="flex-center position-ref full-height collapse" id="collapseExample">
                        @endif
                        <div class="row">
                            @if( empty($selectedUserAddress))
                                <div class="col-4">
                                    <div class="card mb-4">
                                        <div class="card-body">

                                            <a href="{{route('addAddress')}}" class="btn btn-sm btn-info">Add New
                                                Address</a>

                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($userAddresses && count($userAddresses)>0)

                                @foreach ($userAddresses as $userAddress)
                                    @if( empty($selectedUserAddress) || (!empty($selectedUserAddress) && $selectedUserAddress->address_id != $userAddress->address_id))
                                        <div class="col-4">
                                            @if($userAddress->primary=='Y')
                                                <div class="card border-primary mb-4">
                                                    @else

                                                        <div class="card mb-4">
                                                            @endif

                                                            <div class="card-body">

                                                                <div class="row">
                                                                    <div class="col">
                                                                        {{$userAddress->address1.', '}}
                                                                    </div>
                                                                </div>
                                                                @if($userAddress->address2)
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            {{$userAddress->address2.', '}}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <div class="row">
                                                                    <div class="col">
                                                                        {{$userAddress->city.', '.$userAddress->state}}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        {{$userAddress->country.' - '.$userAddress->pincode}}
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        {{'Primary address - '.$userAddress->primary}}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-3 mt-3"></div>
                                                                    <div class="col mt-3 text-right">

                                                                        <a class="btn btn-sm btn-outline-success"
                                                                           href="{{ url('/checkout/shipping/'. $userAddress->address_id) }}">
                                                                            {{__('Ship To Address')}}
                                                                        </a>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            @endif
                                            @endforeach

                                            @else
                                                <div class="col-4 alert alert-secondary">There are no addresses existing
                                                    !!
                                                </div>
                                            @endif
                                        </div>


                        </div>
                    </div>
            </div>
@endsection
