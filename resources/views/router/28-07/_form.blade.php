<div class="col-md-4">
                <div class="routerstep routerstep1"><span>{{ Lang::get('router.addyourrouter') }}</span></div>
                <div class="routerdetail  successfully">
                    <div class="detailtitle">
                        <img src="{{ asset("/img/addbtn.png ") }}" class="center-block">
                        <h3>{{ Lang::get('router.addyourrouter') }}</h3>
                    </div>
                 
                    <div class="routerform">
                        
                     
                      {!!  Form::text('shortname', null, array('id'=>'shortname','class'=>'lname','required'=>'true','placeholder'=>Lang::get("router.locationname"),'required'=>'true')) !!}
<!--                        <input class="lname" name="lname" type="text" placeholder="Location Name" value="">-->
                      {!!  Form::text('ssid', null, array('id'=>'shortname','class'=>'wirelessnm','required'=>'true','placeholder'=>Lang::get("router.wirelressname"),'required'=>'true')) !!}
<!--                      <input class="wirelessnm" name="wirelessnm" type="text" placeholder="Wireless Name" value=""/>-->
                  {!!  Form::text('nasidentifier', (Session::has('mac')) ? Session::get('mac') : null, array('id'=>'nasidentifier','class'=>'router','required'=>'true','minlength'=>'17','placeholder'=>'A8:AC:45:45:87')) !!}
<!--                      <input class="router" name="router" type="text" placeholder="88:AC:45:45:87" value=""/>-->
                    </div>
                  <a  href="javascript:void(0)"class="routerbtn"><i class="nextbtn"></i>{{ Lang::get('router.next') }}</a>
                </div>    
            </div> 
            <div class="col-md-4">
                <div class="routerstep routerstep2 active"><span>{{ Lang::get('router.addyourlocation') }}</span></div>
                <div class="routerdetail addlocation">
                    <div class="detailtitle">
                        <img src="{{ asset("/img/addbtn.png ") }}" class="center-block">
                        <h3>{{ Lang::get('router.addyourlocation') }}</h3>
                    </div>
                    <div class="routerform">
                        {!!  Form::text('address', null, array('id'=>'address','class'=>'rlocation','placeholder'=>Lang::get("router.addresscitycountry"))) !!}
<!--                         <input id="address" type="text"  class="rlocation" name="rlocation" placeholder="Address, City, Country" value="">-->
                        
                    </div>
                    
                    <a  href="javascript:void(0)" class="routerbtn" id="find"><i class="nextbtn"></i>{{ Lang::get('router.submit') }}</a> 
                </div>  
                
                <div class="locationdetail active successfully"  >
                     <img  src="{{ asset("/img/mapimg.png ") }}" class=" mapimg center-block" style="height: 300px;width:100%;">
                    <div id="map" style="height: 300px;width: 100%;"></div>

<!--                     <div class="searchlocation">
                         <input class="searchicon" type="text" placeholder="Search locations" id="locations"/>
                        <a href="javascript:void(0)" class="" id="search">Get directors</a>
                        </div>  -->
                 </div>
                     {!!  Form::hidden('latitude', null, array('id'=>'lat')) !!}
                     {!!  Form::hidden('longitude', null, array('id'=>'long')) !!}
                     {!!  Form::hidden('ChilliSpot-Bandwidth-Max-Up', "5000" ) !!}
                     {!!  Form::hidden('Idle-Timeout', "1800" ) !!}
                    {!!  Form::hidden('EMail_ChilliSpot-Bandwidth-Max-Up', "5000" ) !!}
                    {!!  Form::hidden('EMail_Idle-Timeout','1800' ) !!}
<!--                <input type="hidden" name="latitude" id="lat" value="">
                <input type="hidden" name="longitude" id="long" value="">-->
            </div>
            <div class="col-md-4">
                <div class="routerstep routerstep3"><span>{{ Lang::get('router.done') }}</span></div> 
                <div class="routerdetail routeradded "> 
                    <img class="rightimg" src="{{ asset("/img/rightimg.png ") }}" class="center-block">
                    <h2>{{ Lang::get('router.routeradded') }}</br>
{{ Lang::get('router.letsdotheconfig') }}</h2>
                     <a  href="javascript:void(0)" class="routerbtn" ><i class="settingicon"></i>{{ Lang::get('router.setting') }}</a>
                </div>    
            </div>