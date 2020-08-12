@extends('branchadmin.layout.auth')

@section('title')

@endsection

@section('content')

	           

                <dl class="list-group">
     <dt class="list-group-item active">Laundry ~</dt>
      <dt class="list-group-item">Username <span id="ref" ><h2>{{$singlep->user->name}}</h2></span></dt>
<dt class="list-group-item">Gender <span id="ref" >{{$singlep->user->gender}}</span></dt>
     
  <dt class="list-group-item">Reference <span id="ref" >{{$singlep->txref}}</span></dt>
  <dt class="list-group-item">Total Laundry <span id="totalnum" >{{$singlep->totalnum}}</span></dt>
  <dt class="list-group-item">Total Price <span id="totalprice" >{{$singlep->totalprice}}</span></dt>
  <dt class="list-group-item">Laundry Status <span id="lstatus" >{{$singlep->lstatus}}</span></dt>
       <dt class="list-group-item">Requested Date <span id="createdat" >{{$singlep->created_at}} - {{$singlep->created_at->diffForHumans()}}</span></dt>

     <dt class="list-group-item">Pickup Date <span id="pickupat" >{{$singlep->pickup_at}} -</span></dt>
     <dt class="list-group-item">Delivery Date <span id="deliveryat" >{{$singlep->delivery_at}} - </span></dt>
        <dt class="list-group-item">State <span id="state" >{{$singlep->state}}</span></dt>
        <dt class="list-group-item">Sub-Urban <span id="localgov" >{{$singlep->localgov}}</span></dt>
    <dt class="list-group-item">Delivery Address <span id="addr" >{{$singlep->addr}}</span></dt>
    <dt class="list-group-item">Country <span id="country" >{{$singlep->country}}</span></dt>
    <dt class="list-group-item">Short Note <span id="shortnote" >{{$singlep->shortnote}}</span></dt>

     <dt class="list-group-item active">Laundry</dt>

     <table class="table table-striped table-bordered table-hover" style="text-align: center;" id="klists">
                            
                        </table>
                        <script type="text/javascript">JustDisplay('{!!$singlep->kleanaryinput!!}');</script>
  
    <dt class="list-group-item active">Favorites</dt>

    <dt class="list-group-item">Starch: <span id="favstarch" >{{$singlep->favstarch["starchname"]}}</span></dt>
<dt class="list-group-item">Perfume: <span id="favperfume" >{{$singlep->favperf["perfname"]}}</span></dt>


 <dt class="list-group-item active">Todos</dt>
 <dt class="list-group-item">
 <div class="btn-group" id="todobtn" >
 <a href="javascript:void(0)" id="ironbtn" class="btn btn-primary" onclick="showGallary('{{$singlep->user_id}}','{{$singlep->laundryimg}}')">All Image</a>
<a href="javascript:void(0)" id="starchbtn" class="btn btn-primary" onclick="showGallary('{{$singlep->user_id}}','{{$singlep->todostarch}}')">Hang</a>
<a href="javascript:void(0)" id="perfumebtn" class="btn btn-primary" onclick="showGallary('{{$singlep->user_id}}','{{$singlep->todoperfume}}')">Perfume</a>
<a href="javascript:void(0)" id="ironbtn" class="btn btn-primary" onclick="showGallary('{{$singlep->user_id}}','{{$singlep->todoiron}}')">Iron</a>
</div>
  <div id="tododisplay"></div>
</dt>
<dt class="list-group-item">
    @if($singlep->lstatus == 'CONFIRMED')
    <a  class="btn btn-primary" href="{{ route('picklaundry',['id' => $singlep->id])}}" >Pick Laundry</a>

    @elseif($singlep->lstatus =='PICKING')

    <a class="btn btn-primary" href="{{ route('deliverlaundry',['id' => $singlep->id])}}" >Deliver Laundry</a>

    @else

    @endif
</dt>

  </dl>

          
            
                                            
   
                 
              

@endsection
