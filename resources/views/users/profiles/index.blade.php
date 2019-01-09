@extends('users.layouts.app') 
@section('content')
  @if(Auth::check())
  <div class>
      <div class="row">
        <div class="col-md-12">
          <form>
          <div class="form-group">
              <label class="label">Photo : </label> <img src="{{url('images/profiles/'.$user->profile->photo)}}" height="150" width="150">
              
            </div>
            <div class="form-group">
              <label class="label">Nama Lengkap : </label> {{$user->profile->name}}
              
            </div>
            <div class="form-group">
              <label class="label">Nomor Handphone : </label> {{$user->profile->phone}}
              
            </div>

            <label class="label">Jenis Kelamin : </label> {{$user->profile->gender}}
            
            <div class="form-group mt-3">
              <label class="label">Nama Alamat : </label> {{$user->profile->address->name}}
            </div>

            <div class="form-group">
              <label class="label">Alamat Rinci : </label>{{$user->profile->address->detail}}, {{$user->profile->address->subdistrict_name}}, {{$user->profile->address->city_name}}, {{$user->profile->address->province_name}}, {{$user->profile->address->postal_code}}
              
            </div>

            <div class="form-group">
              <label class="label">Birthday : </label> {{$user->profile->birthday}}
             
            </div>

          </form>
        </div>
      </div>
    </div>
  @else
  <div id="cart">
      <cart />
    </div>
  @endif
  
@endsection
