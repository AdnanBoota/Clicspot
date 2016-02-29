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
                            <div class="{{($getProfile->gender=='male') ? 'profiledettop':'profiledettopFemale'}}" href="mailto:{{$getProfile->email}}">
                                <h3>{{$getProfile->name}}</h3>
                            </div>
                            <div class="profiledetmin">
                                <div class="profileimg">
                                    @if($getProfile->avatar!='')
                                    <img src="{{ $getProfile->avatar }}" />
                                    @else
                                    @if($getProfile->gender=='male')
                                    <img src="{{ asset("img/male.png") }}" />
                                    @else
                                    <img src="{{ asset("img/female.png") }}" />
                                    @endif
                                    @endif
                                </div>
                            </div>
                            <div class="profiledetbtm">
                                <div class="reviewblock">
                                    <a class="active" href="#"><i></i></a>
                                    <a href="#"><i></i></a>
                                    <a href="#"><i></i></a>
                                </div>
                                <a class="sendbtn" href="mailto:{{$getProfile->email}}">
                                    <i class="fa fa-envelope"></i>
                                    <span>Send me an Email !</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 userprofileblock_right">
                        <div class="profiledetrgt">
                            <div class="socialsharing">

                                <a class="mailicon {{($getProfile->type==2) ? 'emailHover':''}}" href="javascript:void(0)"><i><img src="{{ asset("img/emailicon.png") }}"/></i></a>
                                <a class="fbicon {{($getProfile->type==1 AND strpos($getProfile->profileurl, 'facebook') !== false) ? 'facebookHover':''}}" href="{{($getProfile->type==1 AND strpos($getProfile->profileurl, 'facebook') !== false) ? $getProfile->profileurl :'javascipt:void(0)' }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a class="gplusicon {{($getProfile->type==1 AND strpos($getProfile->profileurl, 'google') !== false) ? 'gplusHover':''}}" href="{{($getProfile->type==1 AND strpos($getProfile->profileurl, 'google') !== false) ? $getProfile->profileurl : 'javascript:void(0)'}}" target="_blank"><i class="fa fa-google-plus"></i></a>


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
                                            <span>Unkonwn</span>
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
                                            <span>{{date('d F, Y', strtotime($getProfile->created_at))}}</span>
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
                                            <span>{{ isset($getProfile->email)? $getProfile->email : 'Unkonwn' }}</span>
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

                            <!--                            <div class="box-tools pull-right">
                                                            <span class="label label-danger">8 New Members</span>
                                                            <button data-widget="collapse" class="btn btn-box-tool" type="button"><i class="fa fa-minus"></i>
                                                            </button>
                                                            <button data-widget="remove" class="btn btn-box-tool" type="button"><i class="fa fa-times"></i>
                                                            </button>
                                                        </div>-->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">
                                @if (count($getLatestUsers) > 0)
                                @foreach ($getLatestUsers as $latestUser)
                                <li>
                                    @if($latestUser->avatar!='')
                                    <img alt="User Image" src="{{$latestUser->avatar}}">
                                    @else
                                    @if($latestUser->gender=='male')
                                    <img src="{{ asset("img/male.png") }}" />
                                    @else
                                    <img src="{{ asset("img/female.png") }}" />
                                    @endif
                                    @endif

                                    <a href="#" class="users-list-name">{{$latestUser->name}}</a>
                                    <span class="users-list-date">{{ $latestUser->joinDate }}</span>
                                </li>
                                @endforeach
                                @endif

                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.box-body -->
                        <!--                        <div class="box-footer text-center">
                                                    <a class="uppercase" href="javascript::">View All Users</a>
                                                </div>-->
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
            <span class="info-box-icon bg-aqua">{{$getLastVisit[0]->lastvisit}}</span>
            <div class="info-box-content">
                <span>Last Visit</br><span>Days ago</span></span>
            </div>
            <span class="info-box-icon rgticon">
                <img src="{{ asset("img/watchimg.png") }}" />
            </span>
        </div>
        <div class="info-box mainlabox wifibox">
            <span class="info-box-icon bg-aqua">{{$getLastVisit[0]->connections}}</span>
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
                    @if (count($getRouterInformation) > 0)
                    @foreach ($getRouterInformation as $getRounterInfo)
                    <div class="hismaildetail">
                        <div class="hismaildetail_img">
                            <img src="{{ asset("img/venueimg.png") }}" />
                        </div>

                        <div class="hismaildesc">
                            <h3>{{$getRounterInfo->routerName}}</h3>
                            <p><label>Visits :</label>{{$getRounterInfo->totalVisit}}</p>
                            <p><label>Last visit :</label>{{$getRounterInfo->LastVisitDate}}</p>
                        </div>
                        <div class="hismaildetail_img plusimg">
                            <a href="#"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    <!--                    <div class="hismaildetail">
                                            <div class="hismaildetail_img">
                                                <img src="{{ asset("img/venueimg.png") }}" />
                                            </div>
                                            <div class="hismaildesc">
                                                <h3>Router Name2</h3>
                                                <p><label>Visits :</label> 4</p>
                                                <p><label>Last visit :</label>Mon 7th Feb 2015, 13:27:30</p>
                                            </div>
                                        </div>-->



                </div>
            </div>
        </div>
    </div>
</section>
@endsection
