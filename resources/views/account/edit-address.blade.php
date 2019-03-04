@extends('layouts.center-layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Address') }}</div>

                    <div class="card-body">
                        @if (!empty($status))
                            <div class="form-group row">


                                @if ($status == 'success')
                                    <div class="col alert alert-success">
                                        <strong>{{ __('The address has been updated successfully!')}}</strong>
                                    </div>
                                @elseif ($status == 'failure')

                                    <div class="col alert alert-danger">
                                        <strong>{{ __('There was an error while saving the address updates!!')}}</strong>
                                    </div>
                                @endif

                            </div>
                        @endif
                        <form method="POST" action="{{ route('updateAddress') }}">
                            @csrf
                            <input type="hidden" name="address_id" id="address_id" value="{{ old('address_id',$address->address_id) }}"/>
                            <div class="form-group row">
                                <label for="address1"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Address Line 1') }}</label>

                                <div class="col-md-6">
                                    <input id="address1" type="text"
                                           class="form-control{{ $errors->has('address1') ? ' is-invalid' : '' }}"
                                           name="address1" value="{{ old('address1',$address->address1) }}" required>

                                    @if ($errors->has('address1'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address1') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address2"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Address Line 2') }}</label>

                                <div class="col-md-6">
                                    <input id="address2" type="text"
                                           class="form-control{{ $errors->has('address2') ? ' is-invalid' : '' }}"
                                           name="address2" value="{{ old('address2',$address->address2) }}">

                                    @if ($errors->has('address2'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address2') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                           name="city" value="{{ old('city',$address->city) }}" required autofocus>

                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="state"
                                       class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                                <div class="col-md-6">
                                    <input id="state" type="text"
                                           class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}"
                                           name="state" value="{{ old('state',$address->state) }}" required autofocus>

                                    @if ($errors->has('state'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="country"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                                <div class="col-md-6">
                                    <input id="country" type="text"
                                           class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                                           name="country" value="{{ old('country',$address->country) }}" required autofocus>

                                    @if ($errors->has('country'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="pincode"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Zipcode') }}</label>

                                <div class="col-md-6">
                                    <input id="pincode" type="number" min="1"
                                           class="form-control{{ $errors->has('pincode') ? ' is-invalid' : '' }}"
                                           name="pincode" value="{{ old('pincode',$address->pincode) }}" required autofocus>

                                    @if ($errors->has('pincode'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pincode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address_type"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Address Type') }}</label>

                                <div class="col-md-6">
                                    <select name="address_type" class="form-control" value="{{ old('address_type',$address->address_type) }}">
                                        <option value="Home">Home</option>
                                        <option value="Work">Work</option>
                                        <option value="Others">Others</option>
                                    </select>

                                    @if ($errors->has('address_type'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save Address') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
