@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                
                    <div class="form">

                    <form  action="{{ route('starch') }}" method="POST" >
                     {{ csrf_field() }}
                     <div class="form-group  has-feedback{{ $errors->has('starchname') ? ' has-error' : '' }}" >
                    <label class="form__label">Starch<label>
                    <input class="form__input form-control" required name="starchname" type="text" placeholder="Enter Starch Name"  value="{{ old('starchname') }}" /> 
                     @if ($errors->has('starchname'))
                      <span class="help-block">{{ $errors->first('starchname') }}</span>
                    @endif
                    </div>

                     <div class="form-group has-feedback{{ $errors->has('starchprice') ? ' has-error' : '' }}">
                    <label class="form__label">Price<label>
                    <input class="form__input" name="starchprice" type="text" value="{{ old('starchprice') }}" placeholder="Enter Starch Price" /> 
                   @if ($errors->has('starchprice'))
                      <span class="help-block">{{ $errors->first('starchprice') }}</span>
                    @endif
                    </div>

                    
                   
                   <div class="col-md-12">
                    <input type="submit"  class="btn btn-primary btn-block btn-flat" value="Add"  />
                    </div>
                    </form>
                  
                    </div>



                    <div class="content-box">

                    <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                    <th>Name</th>
                     <th>Price</th>
                     
                     
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                     @foreach($items as $item)
                                        <tr class="laundrylist">
                                           
                                             <td>{{$item->starchname}}</td>
                                            <td>{{$item->starchprice}}</td>
                                            
                                            
                                            
                                            <td><a href="{{ route('delete-starch',['id' => $item->id])}}" >Delete</a></td>
                                           
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
