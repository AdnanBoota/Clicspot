<div class="col-md-8">
                <div class="routerstep routerstep1"><span>{{ Lang::get('router.addyourrouter') }}</span></div>
                <div class="col-md-10">
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
            </div>
            <div class="col-md-4">
                <div class="routerstep routerstep2"><span>{{ Lang::get('router.done') }}</span></div> 
                <div class="routerdetail routeradded "> 
                    <img class="rightimg" src="{{ asset("/img/rightimg.png ") }}" class="center-block">
                    <h2>{{ Lang::get('router.routeradded') }}</br>
{{ Lang::get('router.letsdotheconfig') }}</h2>
                     <a  href="javascript:void(0)" class="routerbtn" ><i class="settingicon"></i>{{ Lang::get('router.setting') }}</a>
                </div>    
            </div>