@extends('layouts.app')
@section('content')
<div class="container-fluid">
 <div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0">Dashboard</h1>
</div>
</div> 
</div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>1&nbsp;</h3>
            <p>Members</p>
          </div>
          <div class="icon">
            <i class="nav-icon nav-icon fa fa-users fa-spin fa-3x"></i>
          </div>
       <a href="{{url('members')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right {{ Request::is('wallet/index') ? 'active' : '' }}"></i></a>
        </div>
      </div> 
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>2&nbsp;</h3>
            <p>Today Income</p>
          </div>
          <div class="icon">
            <i class="nav-icon nav-icon fas fa-arrow-down fa-spin fa-3x"></i>
          </div>
          <a href="{{url('todayincome')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right {{ Request::is('admin/donates') ? 'active' : '' }}"></i></a>
        </div>
      </div> 

      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>3&nbsp;</h3>
            <p>Total Income </p>
          </div>
          <div class="icon">
            <i class="nav-icon nav-icon fas fa-money-check fa-spin fa-3x"></i>
          </div>
          <a href="{{url('totalincome')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right {{ Request::is('admin/donates') ? 'active' : '' }}"></i></a>
        </div>
      </div> 
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>4&nbsp;</h3>
            <p>Wallet </p>
          </div>
          <div class="icon">
            <i class="nav-icon nav-icon fas fa-wallet fa-spin fa-3x"></i>
          </div>
          <a href="{{url('/wallet/{from}/{to}')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right {{ Request::is('wallet/index') ? 'active' : '' }}"></i></a>
        </div>
      </div> 
	  <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>5&nbsp;</h3>
            <p>Request Payment </p>
          </div>
          <div class="icon">
            <i class="nav-icon nav-icon fas fa-wallet fa-spin fa-3x"></i>
          </div>
          <a href="{{url('/requestpayment') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right {{ Request::is('wallet/index') ? 'active' : '' }}"></i></a>
        </div>
      </div> 

      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>6&nbsp;</h3>
            <p>Withdrawal Payment </p>
          </div>
          <div class="icon">
            <i class="nav-icon nav-icon fas fa-wallet fa-spin fa-3x"></i>
          </div>
          <a href="{{url('/newrequest') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right {{ Request::is('wallet/index') ? 'active' : '' }}"></i></a>
        </div>
      </div> 

      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>7&nbsp;</h3>
            <p>Today Joined Users</p>
          </div>
          <div class="icon">
            <i class="nav-icon nav-icon fas fa-wallet fa-spin fa-3x"></i>
          </div>
          <a href="{{url('/todayjoined') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right {{ Request::is('/members') ? 'active' : '' }}"></i></a>
        </div>
      </div> 

    </div>
    
	
</div>
</div>
</section>
@endsection
