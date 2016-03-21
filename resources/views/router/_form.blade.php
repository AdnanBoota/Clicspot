<div class="col-md-4">
                <div class="routerstep routerstep1"><span>Add your ROUTER</span></div>
                <div class="routerdetail  successfully">
                    <div class="detailtitle">
                        <img src="{{ asset("/img/addbtn.png ") }}" class="center-block">
                        <h3>Add your ROUTER</h3>
                    </div>
                 
                    <div class="routerform">
                        
                     
                      {!!  Form::text('shortname', null, array('id'=>'shortname','class'=>'lname','required'=>'true','placeholder'=>'Location Name','required'=>'true')) !!}
<!--                        <input class="lname" name="lname" type="text" placeholder="Location Name" value="">-->
                      {!!  Form::text('ssid', null, array('id'=>'shortname','class'=>'wirelessnm','required'=>'true','placeholder'=>'Wireless Name','required'=>'true')) !!}
<!--                      <input class="wirelessnm" name="wirelessnm" type="text" placeholder="Wireless Name" value=""/>-->
                  {!!  Form::text('nasidentifier', (Session::has('mac')) ? Session::get('mac') : null, array('id'=>'nasidentifier','class'=>'router','required'=>'true','minlength'=>'17','placeholder'=>'88:AC:45:45:87')) !!}
<!--                      <input class="router" name="router" type="text" placeholder="88:AC:45:45:87" value=""/>-->
                    </div>
                  <a  href="javascript:void(0)"class="routerbtn"><i class="nextbtn"></i> NEXT</a>
                </div>    
            </div> 
            <div class="col-md-4">
                <div class="routerstep routerstep2 active"><span>Add your LOCATION</span></div>
                <div class="routerdetail addlocation">
                    <div class="detailtitle">
                        <img src="{{ asset("/img/addbtn.png ") }}" class="center-block">
                        <h3>Add your LOCATION</h3>
                    </div>
                    <div class="routerform">
                        {!!  Form::text('address', null, array('id'=>'address','class'=>'rlocation','placeholder'=>'Address, City, Country')) !!}
<!--                         <input id="address" type="text"  class="rlocation" name="rlocation" placeholder="Address, City, Country" value="">-->
                        
                    </div>
                    
                    <a  href="javascript:void(0)" class="routerbtn" id="find"><i class="nextbtn"></i> SUBMIT</a> 
                </div>  
                
                <div class="locationdetail active successfully"  >
                     <img  src="{{ asset("/img/mapimg.png ") }}" class=" mapimg center-block" style="height: 300px;width: 300px;">
                    <div id="map" style="height: 300px;width: 300px;"></div>

<!--                     <div class="searchlocation">
                         <input class="searchicon" type="text" placeholder="Search locations" id="locations"/>
                        <a href="javascript:void(0)" class="" id="search">Get directors</a>
                        </div>  -->
                 </div>
                     {!!  Form::hidden('latitude', null, array('id'=>'lat')) !!}
                     {!!  Form::hidden('longitude', null, array('id'=>'long')) !!}
                     {!!  Form::hidden('ChilliSpot-Bandwidth-Max-Up', "1024" ) !!}
                     {!!  Form::hidden('Idle-Timeout', "1800" ) !!}
                    {!!  Form::hidden('EMail_ChilliSpot-Bandwidth-Max-Up', "1024" ) !!}
                    {!!  Form::hidden('EMail_Idle-Timeout','1800' ) !!}
<!--                <input type="hidden" name="latitude" id="lat" value="">
                <input type="hidden" name="longitude" id="long" value="">-->
            </div>
            <div class="col-md-4">
                <div class="routerstep routerstep3"><span>DONE !</span></div> 
                <div class="routerdetail routeradded "> 
                    <img class="rightimg" src="{{ asset("/img/rightimg.png ") }}" class="center-block">
                    <h2>Router added !</br>
let’s do the configuration</h2>
                     <a  href="javascript:void(0)" class="routerbtn" ><i class="settingicon"></i> SETTING</a>
                </div>    
            </div>