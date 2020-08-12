@extends('admin.layout.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                
                    <div class="form">

                    <form  action="{{ route('perfume') }}" method="POST" >
                     {{ csrf_field() }}
                     <div class="form-group  has-feedback{{ $errors->has('perfname') ? ' has-error' : '' }}" >
                    <label class="form__label">Name<label>
                    <input class="form__input form-control" required name="perfname" type="text" placeholder="Enter Perfume Name"  value="{{ old('perfname') }}" /> 
                     @if ($errors->has('perfname'))
                      <span class="help-block">{{ $errors->first('perfname') }}</span>
                    @endif
                    </div>

                     <div class="form-group has-feedback{{ $errors->has('perfprice') ? ' has-error' : '' }}">
                    <label class="form__label">Price<label>
                    <input class="form__input" name="perfprice" type="text" value="{{ old('perfprice') }}" placeholder="Enter Laundry Price" /> 
                   @if ($errors->has('perfprice'))
                      <span class="help-block">{{ $errors->first('perfprice') }}</span>
                    @endif
                    </div>

                   
                    <div class="col-md-12">
                    <input type="submit"  class="btn btn-primary btn-block btn-flat" value="Add"  />
                    </div>
                    </form>
                  
                    </div>



                    <div class="content-box ">

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
                                           
                                             <td>{{$item->perfname}}</td>
                                            <td>{{$item->perfprice}}</td>
                                            
                                           
                                            
                                            <td><a href="{{ route('delete-perfume',['id' => $item->id])}}" >Delete</a></td>
                                           
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
