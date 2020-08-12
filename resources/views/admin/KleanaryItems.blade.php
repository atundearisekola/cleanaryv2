@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                
                    <div class="form">

                    <form  action="{{ route('kitem') }}" method="POST" >
                     {{ csrf_field() }}
                     <div class="form-group  has-feedback{{ $errors->has('kname') ? ' has-error' : '' }}" >
                    <label class="form__label">Laundry Name<label>
                    <input class="form__input form-control" required name="kname" type="text" placeholder="Enter Laundry Name"  value="{{ old('kname') }}" /> 
                     @if ($errors->has('kname'))
                      <span class="help-block">{{ $errors->first('kname') }}</span>
                    @endif
                    </div>

                     <div class="form-group has-feedback{{ $errors->has('kprice') ? ' has-error' : '' }}">
                    <label class="form__label">Price<label>
                    <input class="form__input" name="kprice" type="number" value="{{ old('kprice') }}" placeholder="Enter Price" /> 
                   @if ($errors->has('kprice'))
                      <span class="help-block">{{ $errors->first('kprice') }}</span>
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
                                           
                                            <td>{{$item->kname}}</td>
                                            <td>{{$item->kprice}}</td>
                                            
                                           
                                            
                                            <td><a href="{{ route('delete-item',['id' => $item->id])}}" >Delete</a></td>
                                           
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
