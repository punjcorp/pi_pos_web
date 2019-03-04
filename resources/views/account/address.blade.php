@extends('layouts.center-layout')

@section('content')
    <div class="container">

        @if (session()->has('defaultResult'))
            <div class="form-group row">


                @if (session()->get('defaultResult'))
                    <div class="col alert alert-success">
                        <strong>{{ __('The address has been set as default successfully!')}}</strong>
                    </div>
                @else

                    <div class="col alert alert-danger">
                        <strong>{{ __('There was an error while setting up address as default!!')}}</strong>
                    </div>
                @endif

            </div>
        @endif
            @if (session()->has('deleteResult'))
                <div class="form-group row">


                    @if (session()->get('deleteResult'))
                        <div class="col alert alert-success">
                            <strong>{{ __('The address has been deleted successfully!')}}</strong>
                        </div>
                    @else

                        <div class="col alert alert-danger">
                            <strong>{{ __('There was an error while deleting address!!')}}</strong>
                        </div>
                    @endif

                </div>
            @endif

        <div class="flex-center position-ref full-height">
            <div class="row">
                <div class="col-4">
                    <div class="card mb-4">
                        <div class="card-body">

                            <a href="{{route('addAddress')}}" class="btn btn-sm btn-info">Add New Address</a>

                        </div>
                    </div>
                </div>
                @if($userAddresses && count($userAddresses)>0)

                    @foreach ($userAddresses as $userAddress)

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
                                                           href="{{ url('/account/address/edit/'. $userAddress->address_id) }}">
                                                            {{__('Edit')}}
                                                        </a>
                                                        <a class="btn btn-sm btn-outline-danger"
                                                           href="{{ url('/account/address/delete/'. $userAddress->address_id) }}">
                                                            {{__('Delete')}}
                                                        </a>

                                                        @if(!empty($userAddress->primary) && $userAddress->primary=='N')
                                                            <a class="btn btn-sm btn-outline-secondary"
                                                               href="{{ url('/account/address/updatePrimary/'. $userAddress->address_id) }}">
                                                                {{__('Set as Default')}}
                                                            </a>

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                @endforeach

                            @else
                                <div class="col-4 alert alert-secondary">There are no addresses existing !!</div>
                            @endif
                        </div>
            </div>

        </div>
@endsection
