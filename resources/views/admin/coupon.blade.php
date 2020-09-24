@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                
                    <div class="form">

                    <form  action="{{ route('coupon') }}" method="POST" >
                     {{ csrf_field() }}
                     <div class="form-group  has-feedback{{ $errors->has('coupon') ? ' has-error' : '' }}" >
                    <label class="form__label">Coupon Name<label>
                    <input class="form__input form-control" required name="coupon" type="text" placeholder="Enter Coupon"  value="{{ old('coupon') }}" /> 
                     @if ($errors->has('coupon'))
                      <span class="help-block">{{ $errors->first('coupon') }}</span>
                    @endif
                    </div>

                     <div class="form-group has-feedback{{ $errors->has('percent') ? ' has-error' : '' }}">
                    <label class="form__label">Percent<label>
                    <input class="form__input" name="percent" type="decimal" value="{{ old('percent') }}" placeholder="Enter Percent" /> 
                   @if ($errors->has('percent'))
                      <span class="help-block">{{ $errors->first('percent') }}</span>
                    @endif
                    </div>

                      <div class="form-group has-feedback{{ $errors->has('expire') ? ' has-error' : '' }}">
                    <label class="form__label">Expiring Date<label>
                    <input class="form__input" name="expire" type="date" value="{{ old('expire') }}" placeholder="Enter Date" /> 
                   @if ($errors->has('expire'))
                      <span class="help-block">{{ $errors->first('expire') }}</span>
                    @endif
                    </div>

                   
                  
                    <input type="submit"  class="btn btn-primary btn-block btn-flat" value="Add"  />
                   
                    </form>
                  
                    </div>



                    <div class="content-box table-responsive">

                    <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                    <th>Laundry</th>
                     <th>Price</th>
                     
                      
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                     @foreach($items as $item)
                                        <tr class="laundrylist">
                                           
                                            <td>{{$item->coupon}}</td>
                                            <td>{{$item->percent}}</td>
                                            <td>{{$item->expire}}</td>
                                            
                                           
                                            
                                            <td><a href="{{ route('delete-coupon',['id' => $item->id])}}" >Delete</a></td>
                                           
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
