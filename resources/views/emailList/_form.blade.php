@push('styles')
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css"/>
<!--<link href="{{ asset('/css/datepicker3.css') }}" rel="stylesheet" type="text/css"/>-->
<link href="{{ asset('/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/list.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@if(isset($emailList))
<div class="row fliterrow">
    <div class="col-md-4">
       <div class="frmlabel">
            <div class="lblfirst">abc</div>
            <label>{{ Lang::get('auth.lastnm') }} :</label>
            <a href="javascript:void(0);" class="infowindow"><i class="fa fa-info-circle"></i></a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="dropdown editbtn">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span>{{$emailList->listname}}</span>
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
              @foreach ($emailListSelctBox as $list)
                @if($emailList->listname != $list->listname)
                <li><span>{{ $list->listname }}</span><a href="javascript:void(0);" class="delList" data-token="{{csrf_token()}}" val="{{$list->id}}"><img src="{{ asset("img/crossimg.png") }}" /></a></li>
                @else
                <li class="active" ><span>{{ $list->listname }}</span></li>
                @endif
              @endforeach
          </ul>
        </div>
    </div>
    {!!  Form::hidden('listname', null, array('id'=>'listname','class'=>'','required'=>'true','placeholder'=>'My list 01')) !!}
</div>
@else
<div class="row fliterrow">
    <div class="col-md-4">
        <div class="frmlabel">
            <div class="lblfirst">abc</div>
            {!! Form::label('listname', Lang::get("auth.lastnm"), array('class' => '')) !!} 
            <a href="javascript:void(0);" class="infowindow"><i class="fa fa-info-circle"></i></a>
            
        </div>
    </div>
    <div class="col-md-8">
        <div class="editb">
            <i class="fa fa-pencil"></i>
            {!!  Form::text('listname', null, array('id'=>'listname','class'=>'','required'=>'true','placeholder'=>Lang::get("auth.mylist"))) !!}
        </div>
    </div>
</div>
@endif
<div class="row fliterrow">
    <div class="col-md-4">
        <div class="frmlabel">
            <div class="lblfirst"><i class="pingicon fa fa-thumb-tack"></i></div>
            {!! Form::label('favoredconnection', Lang::get("auth.favconnection"), array('class' => '')) !!}
            <a href="javascript:void(0);" class="infowindow"><i class="fa fa-info-circle"></i></a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="socialicon">
            <div class="maincheck fbimg"> 
                <input type="checkbox" value="facebook" name="favoredconnection[]" id="facebook-conn" class="css-checkbox" {{ (isset($emailList) AND in_array('facebook',$emailList->favoredconnection))?'checked':''}} />
                <label for="facebook-conn" class="css-label"></label>
            </div>
            <div class="maincheck gplusimg">
                <input type="checkbox" value="google" name="favoredconnection[]" id="google-conn" class="css-checkbox"  {{ (isset($emailList) AND in_array('google',$emailList->favoredconnection))?'checked':''}}/>
                <label for="google-conn" class="css-label"></label>
            </div>
            <div class="maincheck emailimg"> 
                <input type="checkbox" value="email" name="favoredconnection[]" id="email-conn" class="css-checkbox" {{ (isset($emailList) AND in_array('email',$emailList->favoredconnection))?'checked':''}} />
                <label for="email-conn"  class="css-label"></label>
            </div>
            <div class="maincheck importedimg">
                <input type="checkbox" value="imported" name="favoredconnection[]" id="imported-conn" class="css-checkbox" {{ (isset($emailList) AND in_array('imported',$emailList->favoredconnection))?'checked':''}} />
                <label for="imported-conn"  class="css-label"></label>
            </div>
        </div>
    </div>
</div>
<div class="row fliterrow">
    <div class="col-md-4">
        <div class="frmlabel">
            <div class="lblfirst">
                <i class="visiticon"><img src="{{ asset("img/visitorsicon.png") }}" /></i>
            </div>
            {!! Form::label('visitors',Lang::get("auth.visitor"), array('class' => '')) !!}
            <a href="javascript:void(0);" class="infowindow"><i class="fa fa-info-circle"></i></a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="socialicon visitors">
            <div class="maincheck maleimg"> 
                <input type="checkbox" value="male" name="visitors[]" id="male" class="css-checkbox" {{ ( isset($emailList) AND is_array($emailList->visitors) AND in_array('male',$emailList->visitors))?'checked':''}} />
                <label for="male" class="css-label"></label>
            </div>
            <div class="maincheck femaleimg"> 
                <input type="checkbox" value="female" name="visitors[]" id="female" class="css-checkbox" {{ ( isset($emailList) AND is_array($emailList->visitors) AND in_array('female',$emailList->visitors))?'checked':''}} />
                <label for="female" class="css-label"></label>
            </div>
        </div>
    </div>
</div>

<div class="row fliterrow">
    <div class="col-md-4"></div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                <div class="ageslider">
                    <div class="row">
                        <div class="col-md-2">
                            <span class="agecl">{{ Lang::get("auth.age") }}</span>
                        </div>
                        <div class="col-md-10">{!!  Form::text('age', "", array('data-from'=>isset($emailList)? $emailList->age[0]:'15','data-to'=>isset($emailList)? $emailList->age[1]:'55','data-type'=>'double','id'=>'age','class'=>'','required'=>'true')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                {!!  Form::text('firstname', null, array('id'=>'firstname','placeholder'=>'First Name')) !!}
            </div>
            <div class="col-md-3">
                {!!  Form::text('lastname', null, array('id'=>'lastname','class'=>'','placeholder'=>'Last Name')) !!}
            </div>
        </div>
    </div>
</div>
<div class="row fliterrow">
    <div class="col-md-4">
        <div class="frmlabel">
            <div class="lblfirst">
                <i class="visiticon"><img src="{{ asset("img/amtvisit.png") }}" /></i>
            </div>
            <label>{{ Lang::get('auth.noofvisit') }} </label>
            <a href="javascript:void(0);" class="infowindow"><i class="fa fa-info-circle"></i></a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                {!!  Form::text('numberofvisit', "", array('data-from'=>isset($emailList)? $emailList->numberofvisit[0]:'1','data-to'=>isset($emailList)? $emailList->numberofvisit[1]:'20','data-type'=>'double','id'=>'numberofvisit','class'=>'form-control','required'=>'true')) !!}
            </div>
        </div>
    </div>
</div>
<div class="row fliterrow">
    <div class="col-md-4">
        <div class="frmlabel">
            <div class="lblfirst">
                <i class="visiticon"><img src="{{ asset("img/dateicon.png") }}" /></i>
            </div>
            <label>{{ Lang::get('auth.date') }} </label>
            <a href="javascript:void(0);" class="infowindow"><i class="fa fa-info-circle"></i></a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-4">
                <div class="selectbox">
                    <i class="fa fa-caret-down"></i>
                    {!!  Form::select('datequickselection', array('' => 'Quick Selection','1' => Lang::get("auth.lastday"), '7' => Lang::get("auth.lastweek"),'30' => Lang::get("auth.lastmonth"), '365' => Lang::get("auth.lastyear")), null, ['placeholder' => Lang::get("auth.quickselect"),'id'=>'datequickselection','class'=>'dateGrp']) !!}
                    {!!  Form::hidden('isdatequickselection') !!}
                </div>
            </div>
             <div class="col-md-8">
                <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    <input type="text" name="dateRange" id="dateRange" class="form-control pull-right active date-txt dateGrp">
                </div>
             </div>
            {!!  Form::hidden('datefrom', null, array('id'=>'datefrom','class'=>'date-txt')) !!}
            {!!  Form::hidden('dateto', null, array('id'=>'dateto','class'=>'date-txt')) !!}
<!--            <div class="col-md-4">
                <div class="dateblock">
                    <i class="fa fa-calendar"></i>
                    {!!  Form::hidden('datefrom', null, array('id'=>'datefrom','class'=>'date-txt')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="dateblock">
                    <i class="fa fa-calendar"></i> 
                    {!!  Form::hidden('dateto', null, array('id'=>'dateto','class'=>'date-txt')) !!}
                </div>
            </div>-->
        </div>
    </div>
</div>
<div class="row fliterrow">
    <div class="col-md-4">
        <div class="frmlabel">
            <div class="lblfirst">
                <i class="routericon"><img src="{{ asset("img/routericon.png") }}" /></i>
            </div>
            <label>{{ Lang::get('auth.router') }}</label>
            <a href="javascript:void(0);" class="infowindow"><i class="fa fa-info-circle"></i></a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-4">
                <div class="selectbox">
                    <i class="fa fa-caret-down"></i>
                    {!!  Form::select('router[]', $routers, null, ['multiple' => 'multiple','id'=>'router','required'=>'true']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row fliterrow">
    <div class="col-md-4">
        <div class="frmlabel">
            <div class="lblfirst"><i class="fa fa-star"></i></div>
            <label>{{ Lang::get('auth.reviewstatus') }}</label>
            <a href="javascript:void(0);" class="infowindow"><i class="fa fa-info-circle"></i></a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-4">
                <div class="reviewblock">
                    <!--
                    <a  val='1' class="{{(isset($emailList) AND $emailList->rate >= 1)? 'active':''}}" href="javascript:void(0);"><i></i></a>
                    <a  val='2' class="{{(isset($emailList) AND $emailList->rate >= 2)? 'active':''}}" href="javascript:void(0);"><i></i></a>
                    <a val='3' class="{{(isset($emailList) AND $emailList->rate == 3)? 'active':''}}" href="javascript:void(0);"><i></i></a>
                    -->
                    <div class="starsFilter" data-score="{{(isset($emailList)) ? $emailList->rate : 0}}"></div>
                </div>
                 {!!  Form::hidden('stars') !!}
            </div>
        </div>
    </div>
</div>

<!--<div class="bottomdecore">
    <ul>
        <li><img src="{{ asset("img/btmdecore.png") }}" /></li>
        <li><img src="{{ asset("img/btmdecore.png") }}" /></li>
        <li><img src="{{ asset("img/btmdecore.png") }}" /></li>
    </ul>
</div>-->
@push('scripts')
<script src="{{ asset('/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-multiselect.js') }}"></script>
<script src="/plugins/daterangepicker/moment.min.js"></script>
<script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Raty plugin me@diegopucci.com pucci_diego -->
<script type="text/javascript" src="{{ asset('/plugins/raty/jquery.raty.js') }}"></script>


<script type="text/javascript">
jQuery(document).ready(function () {
    $.validator.addMethod("eitherQuickRange", function(value, element) {
            var quickVal = $('#datequickselection').val();
            var rangeVal = $('#dateRange').val();
            return quickVal || rangeVal;
        }, "Please enter either Quick selection or Date range");

    $('form').validate({
        groups: {  // consolidate messages into one
            names: "datequickselection dateRange"
        },
        rules: {
            'listname':{
                require_from_group:true
            },
            'favoredconnection[]': {
                required: true
            },
            'router[]': {
                required: true
            },
            datequickselection: {
                eitherQuickRange: true
            },
            dateRange: {
                eitherQuickRange: true
            },
        
        },
        errorClass: "text-red",
        errorElement: "span",
        errorPlacement: function (error, element) {
            if (element.context.name == 'x') {
                error.appendTo(element.parents(".col-md-8:last"));
            }
            else {
                error.appendTo(element.parents(".col-md-8:first"));
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
            $(element).parents('.form-group').removeClass('has-success');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
    });

    $("#age").ionRangeSlider({
        min: 1,
        max: 100
    });
    
    $("#numberofvisit").ionRangeSlider({
        min: 1,
        max: 100
    });
    $('#dateRange').daterangepicker({
            autoUpdateInput: true,
            locale: {
          format: 'YYYY-MM-DD'
        },
    }
    ).on('apply.daterangepicker', function(ev, picker) {
//        console.log(picker.startDate.format('YYYY-MM-DD'));
//        console.log(picker.endDate.format('YYYY-MM-DD'));
        //$('input[id="dateRange"]').val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        $('input[name=datefrom]').val(picker.startDate.format('YYYY-MM-DD'));
        $('input[name=dateto]').val(picker.endDate.format('YYYY-MM-DD'));
        getProfileUpdate()
      });
//    $('#datefrom').datepicker({
//        format: "yyyy-mm-dd",
//         autoclose: true
//    }).on('changeDate', function(ev) {
//        getProfileUpdate();
//    });
//    
//    $('#dateto').datepicker({
//        format: "yyyy-mm-dd",
//         autoclose: true
//    }).on('changeDate', function(ev) {
//        getProfileUpdate();
//    });

    $('#router').multiselect({
        includeSelectAllOption: true
    });
    
    $('#datequickselection').on('change',function(){
        var myVal = $(this).val();
        if(myVal){
            $('input[name=isdatequickselection]').val('1');
            $('.date-txt').attr('disabled',true);
            $('.date-txt').val('');
        }
        else{
            $('input[name=isdatequickselection]').val('0');
            $('.date-txt').removeAttr('disabled');
        }
    });

    $('#datequickselection').trigger('change');

    /* EDIT BY me@diegopucci.com*/
    /*
    $('.reviewblock a').on('click',function(){
        $('.reviewblock a').removeClass('active');
        var myVal = $(this).attr('val');
        $('.reviewblock a:lt('+myVal+')').addClass('active');
        $('input[name=rate]').val(myVal);
    });
*/
    $(".starsFilter").raty({
        score: function () {
            return $(this).attr('data-score');
        },
        click: function(score, evt){
            $(this).attr('data-score', score);
            $('input[name=stars]').val(score);
            getProfileUpdate();
        }
    });
    /* EDIT BY me@diegopucci.com END */

    $('form').on('change', 'input, select, textarea', function(){
        var myName = $(this).attr('name');
       console.log('myName',myName);
       if(myName && myName != 'listname' && myName != 'age' && myName != 'datefrom' && myName != 'dateto' && myName != 'dateRange'){
            getProfileUpdate();
        }
    });
    
    if($('input[name=datefrom]').val() != '' && $('input[name=dateto]').val()){
        $('#dateRange').data('daterangepicker').setStartDate($('input[name=datefrom]').val());
        $('#dateRange').data('daterangepicker').setEndDate($('input[name=dateto]').val());
    }else{
        $('#dateRange').val('');
    }
   
});

function getProfileUpdate(){
    //console.log('form url:',$('form').serialize())
    var myVal = 'static';
    var theData = $('form').serialize();

    jQuery.ajax({
             url: '/users/getStatistics/' + myVal+'/formList',
             type: 'POST',
             data: theData,
             success: function (result) {
                 if (result) {
                     $('.fbCount').text(result.fbCount);
                     $('.gCount').text(result.gCount);
                     $('.eCount').text(result.eCount);

                 } else {

                 }

             }
         });
}
</script>
@endpush