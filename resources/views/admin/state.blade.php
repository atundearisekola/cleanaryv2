@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                
                    <div class="form">

                    <form  action="{{ route('state') }}" method="POST" >
                     {{ csrf_field() }}

                      <div class="form-group  has-feedback{{ $errors->has('country') ? ' has-error' : '' }}" >
                    <label class="form__label">Country<label>
                    <select class="form__input form-control" required name="country"  placeholder="Enter Country Name"  value="{{ old('country') }}" >
                    
                    @foreach($countries as $country)
                       <option value="{{$country->country}}">{{$country->country}}</option>       
                    @endforeach
                    </select> 
                     @if ($errors->has('country'))
                      <span class="help-block">{{ $errors->first('country') }}</span>
                    @endif
                    </div>

                     <div class="form-group  has-feedback{{ $errors->has('state') ? ' has-error' : '' }}" >
                    <label class="form__label">State Name<label>
                    <input class="form__input form-control" required name="state" type="text" placeholder="Enter State Name"  value="{{ old('country') }}" /> 
                     @if ($errors->has('state'))
                      <span class="help-block">{{ $errors->first('state') }}</span>
                    @endif
                    </div>
                    

                     <div class="form-group has-feedback{{ $errors->has('area') ? ' has-error' : '' }}">
                    <label class="form__label">Area<label>
                    <input class="form__input" name="area" type="text" value="{{ old('area') }}" placeholder="Enter State Area" /> 
                   @if ($errors->has('area'))
                      <span class="help-block">{{ $errors->first('area') }}</span>
                    @endif
                    </div>

                     <div class="form-group has-feedback{{ $errors->has('population') ? ' has-error' : '' }}">
                    <label class="form__label">Population<label>
                    <input class="form__input" name="population" value="{{ old('population') }}" type="text" placeholder="Enter Country Population" /> 
                    @if ($errors->has('population'))
                      <span class="help-block">{{ $errors->first('population') }}</span>
                    @endif
                    </div>
                     <div class="form-group has-feedback{{ $errors->has('latitude') ? ' has-error' : '' }}">
                    <label class="form__label">Latitude<label>
                    <input class="form__input" name="latitude" value="{{ old('latitude') }}" type="text" placeholder="Enter State latitude" /> 
                    @if ($errors->has('latitude'))
                      <span class="help-block">{{ $errors->first('latitude') }}</span>
                    @endif
                    </div>

                     <div class="form-group has-feedback{{ $errors->has('longitude') ? ' has-error' : '' }}">
                    <label class="form__label">Logitude<label>
                    <input class="form__input" name="logitude" value="{{ old('longitude') }}" type="text" placeholder="Enter State Longitude" /> 
                   @if ($errors->has('longitude'))
                      <span class="help-block">{{ $errors->first('longitude') }}</span>
                    @endif
                    </div>

                   
                    <input type="submit"  class="btn btn-primary btn-block btn-flat" value="Add"  />
                    
                    </form>
                 
                    </div>



                    <div class="content-box table-responsive">

                    <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                    <th>Country</th>
                    <th>State</th>
                     <th>Area</th>
                      <th>Population</th>
                       <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                     @foreach($states as $state)
                                        <tr class="laundrylist">
                                           
                                            <td>{{$state->country}}</td>
                                             <td>{{$state->state}}</td>
                                            <td>{{$state->area}}</td>
                                            
                                            <td>{{$state->population}}</td>
                                            <td>{{$state->latitude}}</td>
                                            <td> {{$state->longitude}}</td>
                                            <td><a href="{{ route('delete-state',['id' => $state->id])}}" >Delete</a></td>
                                          
                                        </tr>
                                       @endforeach
                    
                    </tbody>
                    </table>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
