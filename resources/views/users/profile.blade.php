@extends('app')
@push('styles')
<link href="{{ asset('/css/profile.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
<section class="creatpart">
    <div class="titleblock">
        <i class="fa fa-user"></i>
        <h1>Profile</h1>
    </div>
    <div class="multitab">
        <ul class="tabpart">
            <li class="active"><a href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i>Profile</a></li>
            <li><a href="{{url('users')}}"><i class="fa fa-list-alt"></i>User list</a></li>
        </ul>
    </div>
</section>
<section class="profilepart">
    <div class="titleblock">
        <i class="fa fa-user"></i>
        <h1>User Profile</h1>
    </div>
    <div class="userprofileblock">
        <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-5 userprofileblock_left">
                    <div class="profiledetleft">
                        <div class="profiledettop">
                            <h3>Adrien Massetti</h3>
                        </div>
                        <div class="profiledetmin">
                            <div class="profileimg">
                                <img src="{{ asset("img/profileimg.png") }}" />
                            </div>
                        </div>
                        <div class="profiledetbtm">
                            <div class="reviewblock">
                               <a class="active" href="#"><i></i></a>
                               <a href="#"><i></i></a>
                               <a href="#"><i></i></a>
                           </div>
                           <a class="sendbtn" href="#">
                               <i class="fa fa-envelope"></i>
                               <span>Send me an Email !</span>
                           </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 userprofileblock_right">
                    <div class="profiledetrgt">
                        <div class="socialsharing">
                            <a class="fbicon" href="#"><i class="fa fa-facebook"></i></a>
                            <a class="gplusicon" href="#"><i class="fa fa-google-plus"></i></a>
                            <a class="mailicon" href="#"><i><img src="{{ asset("img/emailicon.png") }}" /></i></a>
                        </div>
                        <div class="userprodtl">
                            <div class="row userprodtlrow">
                                <div class="col-md-4">
                                    <div class="prolabel">
                                        <label>Age :</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="prolbldetail">
                                        <span>32 years</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row userprodtlrow">
                                <div class="col-md-4">
                                    <div class="prolabel">
                                        <label>First visit :</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="prolbldetail">
                                        <span>14th September 2015</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row userprodtlrow">
                                <div class="col-md-4">
                                    <div class="prolabel">
                                        <label>E-mail :</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="prolbldetail">
                                        <span>massetti.adrien@gmail.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
           <div class="memberbox">
            <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">8 New Members</span>
                    <button data-widget="collapse" class="btn btn-box-tool" type="button"><i class="fa fa-minus"></i>
                    </button>
                    <button data-widget="remove" class="btn btn-box-tool" type="button"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <li>
                      <img alt="User Image" src="/dist/img/user1-128x128.jpg">
                      <a href="#" class="users-list-name">Alexander Pierce</a>
                      <span class="users-list-date">Today</span>
                    </li>
                    <li>
                      <img alt="User Image" src="/dist/img/user8-128x128.jpg">
                      <a href="#" class="users-list-name">Norman</a>
                      <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                      <img alt="User Image" src="/dist/img/user7-128x128.jpg">
                      <a href="#" class="users-list-name">Jane</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img alt="User Image" src="/dist/img/user6-128x128.jpg">
                      <a href="#" class="users-list-name">John</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img alt="User Image" src="/dist/img/user2-160x160.jpg">
                      <a href="#" class="users-list-name">Alexander</a>
                      <span class="users-list-date">13 Jan</span>
                    </li>
                    <li>
                      <img alt="User Image" src="/dist/img/user5-128x128.jpg">
                      <a href="#" class="users-list-name">Sarah</a>
                      <span class="users-list-date">14 Jan</span>
                    </li>
                    <li>
                      <img alt="User Image" src="/dist/img/user4-128x128.jpg">
                      <a href="#" class="users-list-name">Nora</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                    <li>
                      <img alt="User Image" src="/dist/img/user3-128x128.jpg">
                      <a href="#" class="users-list-name">Nadia</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a class="uppercase" href="javascript::">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
           </div>
        </div>
    </div>
    </div>
</section>

<section class="actionblock">
   <div class="titleblock">
        <img src="{{ asset("img/labelimg.png") }}" />
        <h1>Latest Actions</h1>
    </div>
    <div class="ltaction">
        <div class="info-box mainlabox mailbox ">
            <span class="info-box-icon bg-aqua">5</span>
            <div class="info-box-content">
                <span>E-mails</br><span>Opened</span></span>
            </div>
            <span class="info-box-icon rgticon">
                <img src="{{ asset("img/mailimg.png") }}" />
            </span>
        </div>
        <div class="info-box mainlabox visitbox">
            <span class="info-box-icon bg-aqua">30</span>
            <div class="info-box-content">
                <span>Last Visit</br><span>Days ago</span></span>
            </div>
            <span class="info-box-icon rgticon">
                <img src="{{ asset("img/watchimg.png") }}" />
            </span>
        </div>
        <div class="info-box mainlabox wifibox">
            <span class="info-box-icon bg-aqua">12</span>
            <div class="info-box-content">
                <span>Connections</span></span>
            </div>
            <span class="info-box-icon rgticon">
                <img src="{{ asset("img/wifiimg.png") }}" />
            </span>
        </div>
    </div>
</section>

<section class="actionblock">
   <div class="titleblock">
        <img src="{{ asset("img/labelimg.png") }}" />
        <h1>History</h1>
    </div>
    <div class="historyblock">
        <div class="row">
            <div class="col-md-6">
                <div class="historuydtl historyblock_left">
                    <div class="htitle">
                       <div class="numblock">2</div>
                        <h2>Latest Email</h2>
                    </div>
                    <div class="hismaildetail">
                        <div class="hismaildetail_img">
                              <img src="{{ asset("img/rated.png") }}" />
                        </div>
                        <div class="hismaildesc">
                            <h3>Campagn Name_Review</h3>
                            <p><span>Sent</span> on Mon 7th Feb 2015, 9:33:27</p>
                            <p><label>Status :</label>Rated</p>
                        </div>
                    </div>
                    <div class="hismaildetail">
                        <div class="hismaildetail_img">
                              <img src="{{ asset("img/read.png") }}" />
                        </div>
                        <div class="hismaildesc">
                            <h3>Campagn Name_Review</h3>
                            <p><span>Sent</span> on Mon 7th Feb 2015, 9:33:27</p>
                            <p><label>Status :</label>Read</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="historuydtl historyblock_right">
                    
                    <div class="htitle">
                       <div class="numblock">1</div>
                        <h2>Latest Venues</h2>
                    </div>
                    <div class="hismaildetail">
                        <div class="hismaildetail_img">
                              <img src="{{ asset("img/venueimg.png") }}" />
                        </div>
                        
                        <div class="hismaildesc">
                            <h3>Router Name1</h3>
                            <p><label>Visits :</label>7</p>
                            <p><label>Last visit :</label>Tue 10th Feb 2015, 13:31:45</p>
                        </div>
                        <div class="hismaildetail_img plusimg">
                              <a href="#"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="hismaildetail">
                        <div class="hismaildetail_img">
                              <img src="{{ asset("img/venueimg.png") }}" />
                        </div>
                        <div class="hismaildesc">
                            <h3>Router Name2</h3>
                            <p><label>Visits :</label> 4</p>
                            <p><label>Last visit :</label>Mon 7th Feb 2015, 13:27:30</p>
                        </div>
                    </div
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
