@extends('app')
@push('styles')
<link href="{{ asset('/css/list.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/platform-mailing.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ asset('/plugins/fullcalendar/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/fullcalendar/fullcalendar.print.css') }}" media="print">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.1/jquery.timepicker.min.css" type="text/css">
@endpush
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.1/jquery.timepicker.min.js"></script>
@section('content')
<style>
    /*    .deletebtn{
            display: none !important;
        }*/
    .automailingblock{
        overflow: visible;
    }
    .dropdown-menu span a{
        color: #69737f !important;
        background: none;
        border-radius: none;
        margin: 0px;
    }
    #templateName{
        display: block;
    } 
    #events-layer{
        width: 100%;
    }
    #events-layer li a{
        font-size: 12px;
        padding: 5px;
        display: block;
        width: 90%; 
        border-radius: 3px;
        margin: 0 !important;
        background: #F5F5F5;
        color: #333; 
    }
    #events-layer li a:hover{
        background: #1B84B5;
        color: #fff;
    } 
    #events-layer li a i{
        margin-right: 5px;
    }
    .fc-day-grid-event.fc-event.fc-start.fc-end.draft{
        background: none !important;
        border: none !important;
        margin-bottom: 0 !important;
        margin-right: 20px;
        margin-top: 0 !important;
    }
    .fc-day-grid-event.fc-event.fc-start.fc-end.send{
        background: none !important;
        border: none !important;
        margin-bottom: 0 !important;
        margin-right: 20px;
        margin-top: 0 !important;
    }
    
    .fc-day-grid-event.fc-event.fc-start.fc-end.draft .fc-content{
        background-color: #0073b7;
        border-color: #0073b7;
        color: #fff;
        font-size: 14px;
        border-radius: 3px;
        padding: 5px;
    } 
    .fc-day-grid-event.fc-event.fc-start.fc-end.send .fc-content{
        background-color: #3C8DBC;
        border-color: #3C8DBC;
        color: #fff;
        font-size: 14px;
        border-radius: 3px;
        padding: 5px;
    }
    .automailingblock a, .automailingblock .campaignbtn a.emailbtn{
        color: #59B6E3;
        border: 1px solid #59B6E3;
        border-radius: 5px;
        background: none;
        font-size: 14px;
    }
    #statusData{
        
        border: 1px solid #E2E2E2;
        padding: 10px;
        -webkit-appearance: none;
   -moz-appearance:    none;
   appearance:         none;
   margin: 0px 20px 10px 10px;
   background:rgba(0,0,0,0) url('../img/arrows.png') no-repeat right center; 
    } 
    .fc-content-skeleton table{
        min-height: 130px;
    }
    
</style>

<section class="creatpart">
    <div class="titleblock">
        <i class="fa fa-envelope"></i>
        <h1>{{ Lang::get('auth.emailplatform') }}</h1>
    </div>
    <div class="multitab">
        <ul class="tabpart">
            <li class="active"><a href="javascript:void(0)" class="automaticMailForm"><i class="fa fa-pencil"></i>{{ Lang::get('auth.automail') }}</a></li>
            <li><a href="javascript:void(0)" class="manualMailingForm "  ><i class="fa fa-pencil-square-o"></i>{{ Lang::get('auth.manumail') }}</a></li>
        </ul>
    </div>
</section>

<section class="creatpart automaticMailing">
    <div class="titleblock">
        <i class="mailingicon">
            <img src="{{ asset("img/mailingicon.png") }}" />
        </i>
        <h1>{{ Lang::get('auth.automail') }}</h1>
    </div>
    
     
    
    <div class="newautomaticplatform">
       <table class="mailplateformnewtable">
            <thead>
                <th>{{ Lang::get('emails.template') }}</th>
                <th>{{ Lang::get('emails.description') }}</th>
                <th>{{ Lang::get('emails.report') }}</th>
                <th>{{ Lang::get('emails.status') }}</th>
            </thead>
            <tbody>
                <tr>
                    <td><img src="{{ asset("img/riviewicon.png") }}" /><span><a href="{{ URL::to('emails/review') }}" style="color:#1abc9c">{{ Lang::get('emails.review') }}</a></span></td>
                    <td>{{ Lang::get('emails.sendreview') }} </td>
                    <td><canvas id="pieChart1"></canvas></td>
                    <td>
                        <div class="switch">
                            <input type="checkbox" class="cmn-toggle cmn-toggle-round" id="cmn-toggle-1" {{ isset($hotspot->reviewstatus) && $hotspot->reviewstatus==1 ? 'checked="checked"' : '' }}>
                            <label for="cmn-toggle-1"></label>
                          </div>
                    </td>
                </tr>
                <tr>
                    <td><img src="{{ asset("img/birthdayimg.png") }}" /><span>{{ Lang::get('emails.birthday') }}</span></td>
                    <td>{{ Lang::get('emails.emailautobirth') }}.</br> {{ Lang::get('emails.emailautobirth2') }}  </td>
                    <td><canvas id="pieChart2"></canvas></td>
                    <td>
                        <div class="switch">
                            <input type="checkbox" class="cmn-toggle cmn-toggle-round" id="cmn-toggle-2">
                            <label for="cmn-toggle-2"></label>
                          </div>
                    </td>
                </tr>
                <tr>
                    <td><img src="{{ asset("img/fblikeicon.png") }}" /><span>{{ Lang::get('emails.facebooklike') }}</span></td>
                    <td>{{ Lang::get('emails.facebooklike2') }}</td>
                    <td><canvas id="pieChart3" ></canvas></td>
                    <td>
                        <div class="switch">
                            <input type="checkbox" class="cmn-toggle cmn-toggle-round" id="cmn-toggle-3">
                            <label for="cmn-toggle-3"></label>
                          </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

 
    
    
</section>


<section class="creatpart automaticMailing" style="display: none;" id="emailTemplate">
    <div class="titleblock">
        <i class="fa fa-envelope"></i>
        <h1>{{ Lang::get('auth.automail') }}</h1>
    </div>
    <div class="automailingblock">
        <a href="{{url('emails/emailSetup')}}"><img src="{{ asset("img/addicon.png") }}" /> {{ Lang::get('auth.createCampaign') }}</a>
        <div class="manualbtn">
<!--               <a href="#" class="sentbtn active"><i></i>Sent<span class="notiblk">{{  $sentCount[0]->totalSentCountCount }}</span></a>
            <a href="#" class="draftbtn "><i></i>Drafts<span class="notiblk">{{$draftCount[0]->totalDraftCount}}</span></a>-->
        </div>
        <div class="mailingtabledtl">

            <table class="mailingtable" id="emailTemplate-table">
                <thead>
                    <tr>

                        <th class="tchackboc">
                            <a class="deletebtn" href="javascript:void(0)" style="display: none;" id="deletebtn"><img src="{{ asset("img/deleteimg.png") }}" /></a>
                            <label class="">
                                <div class="icheckbox_flat-green" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="flat-red emailDelCheckBox" style="position: absolute; opacity: 0;" name="emailTemplateDelete[]" id="multicheck" value=""><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div>
                            </label>
                        </th>
                        <th>Template Name</th>
                        <th>Template Description</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

     
</section>
<section class="creatpart manualMailing" style="display: none;">
    <div class="titleblock">
        <i class="fa fa-envelope"></i>
        <h1>{{ Lang::get('auth.manumail') }}</h1>
    </div>
    <div class="automailingblock">
        <div id="calendar"></div>
    </div>


</section>


@endsection

@push('scripts')
<!-- calendar -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ asset('/plugins/fullcalendar/fullcalendar.js') }}"></script>
	<script src="{{ asset('/plugins/fullcalendar/fr.js') }}"></script>
	<script src="{{ asset('/plugins/fullcalendar/lang-all.js') }}"></script>
	<script src="{{ asset('/plugins/fullcalendar/lib/jquery-ui.custom-datepicker.js') }}"></script>
	<script src="{{ asset('/plugins/fullcalendar/lib/moment.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('/plugins/chartjs/Chart.js') }}"></script>
<!--<script src="{{ asset('/plugins/chartjs/Chart.min.js') }}"></script>-->
<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.responsive.js') }}"></script>
<script>
     
          var APP_URL = {!! json_encode(url('/')) !!};
        /* initialize the external events
         -----------------------------------------------------------------
        function ini_events(ele) {
          ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
           

          });
        }
        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
(function(){
    function onload (moment, $) {

        // RIPPED STRAIGHT FROM MOMENT'S SOURCE
        // (https://github.com/moment/moment/blob/develop/lang/fr.js)
        //
        moment.lang('fr', {
            months : "Janvier_Février_Mars_Avril_Mai_Juin_Juillet_Août_Septembre_Octobre_Novembre_Décembre".split("_"),
            monthsShort : "Janv._Févr._Mars_Avr._Mai_Juin_Juil._Août_Sept._Oct._Nov._Déc.".split("_"),
            weekdays : "Dimanche_Lundi_Mardi_Mercredi_Jeudi_Vendredi_Samedi".split("_"),
            weekdaysShort : "Dim._Lun._Mar._Mer._Jeu._Ven._Sam.".split("_"),
            weekdaysMin : "Di_Lu_Ma_Me_Je_Ve_Sa".split("_"),
            longDateFormat : {
                LT : "HH:mm",
                L : "DD/MM/YYYY",
                LL : "D MMMM YYYY",
                LLL : "D MMMM YYYY LT",
                LLLL : "dddd D MMMM YYYY LT"
            },
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			   },
            calendar : {
                sameDay: "[Aujourd'hui à] LT",
                nextDay: '[Demain à] LT',
                nextWeek: 'dddd [à] LT',
                lastDay: '[Hier à] LT',
                lastWeek: 'dddd [dernier à] LT',
                sameElse: 'L'
            },
            relativeTime : {
                future : "dans %s",
                past : "il y a %s",
                s : "quelques secondes",
                m : "une minute",
                mm : "%d minutes",
                h : "une heure",
                hh : "%d heures",
                d : "un jour",
                dd : "%d jours",
                M : "un mois",
                MM : "%d mois",
                y : "un an",
                yy : "%d ans"
            },
            ordinal : function (number) {
                return number + (number === 1 ? 'er' : '');
            },
            week : {
                dow : 1, // Monday is the first day of the week.
                doy : 4  // The week that contains Jan 4th is the first week of the year.
            }
        });
        
        
        if ($.fullCalendar) {
            $.fullCalendar.lang('fr', {
                // strings we need that are neither in Moment nor datepicker
                "day": "Jour",
                "week": "Semaine",
                "month": "Mois",
                "list": "Mon planning"
            }, {
                // VALUES ARE FROM JQUERY-UI DATEPICKER'S TRANSLATIONS
                // (https://github.com/jquery/jquery-ui/blob/master/ui/i18n/jquery.ui.datepicker-fr.js)
                // 
                // Values that are reduntant because of Moment are not included here.
                //
                // When fullCalendar's lang method is called, it will merge this config with Moment's
                // and make this stuff available for jQuery UI's datepicker:
                //
                //     $.datepicker.regional['fr'] = ...
                //
                closeText: 'Fermer',
                prevText: 'Précédent',
                nextText: 'Suivant',
                currentText: 'Aujourd\'hui',
                dayNamesMin: ['D','L','M','M','J','V','S'],
                weekHeader: 'Sem.',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            });
        }

    }

    // we need Moment and jQuery before we can begin...
    //
    if (typeof define === "function" && define.amd) {
        define(["moment", "jquery"], onload);
    }
    if (typeof window !== "undefined" && window.moment && window.jQuery) {
        onload(window.moment, window.jQuery);
    }

})();
   function calendarData(id)
   {
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        var calendar =$('#calendar').fullCalendar({
			
          header: { 
            left: '',
            center: 'title',
            right: 'month,agendaWeek,prev,next today'
          },
          //Random default events
         events: {
            url: APP_URL+'/emails/manualMailing/'+id,
            type: 'GET', // Send post data
            cache: true,
            error: function() {
                alert('There was an error while fetching events.');
            }
        },
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        eventLimit: true,
        eventMouseover: function(event, domEvent) {
				var layer = '<div id="events-layer"><li><a href="emails/emailSetup/'+event.id+'/edit"><i class="fa fa-fw fa-pencil"></i>Modifier</a></li><li><a href="javascript:void(0);" data-token="{{ csrf_token() }}" val="'+event.id+'" id="delete"><i class="fa fa-fw fa-trash"></i>Effacer</a></li><li><a href="emails/report/'+event.id+'/view"><i class="fa fa-fw fa-eye"></i>Rapport</a></li></div>';				
				$(this).append(layer);
				$("#delbut"+event.id).fadeIn(300);
				$("#delbut"+event.id).click(function() {
					$.post("delete.php", {eventId: event.id});
					calendar.fullCalendar('refetchEvents');
				});
				
				$("#edbut"+event.id).fadeIn(300);
				$("#edbut"+event.id).click(function() {
					var title = prompt('Current Event Title: ' + event.title + '\n\nNew Event Title: ');
					
					if(title){
						$.post("update_title.php", {eventId: event.id, eventTitle: title});
						calendar.fullCalendar('refetchEvents');
					}
				});
            
},eventMouseout: function(calEvent, domEvent) {
				$("#events-layer").remove();
			},
            eventRender: function (event, element) {
                 element.attr('href', 'javascript:void(0);');
                 $(element).css({'width':'100px','padding':'5px','font-size':'14px'});

         

            },
            eventDrop: function(event, delta, revertFunc) {
            	swal({
                        title: 'Current Time <?php echo date('H:i');?> <br/>Please select Any time<br/><select id="dtimeslot" name="dtimeslot"><option value="00:00">00:00</option><option value="00:30">00:30</option><option value="01:00">01:00</option><option value="01:30">01:30</option><option value="02:00">02:00</option><option value="02:30">02:30</option><option value="03:00">03:00</option><option value="03:30">03:30</option><option value="04:00">04:00</option><option value="04:30">04:30</option><option value="05:00">05:00</option><option value="05:30">05:30</option><option value="06:00">06:00</option><option value="06:30">06:30</option><option value="07:00">07:00</option><option value="07:30">07:30</option><option value="08:00">08:00</option><option value="08:30">08:30</option><option value="09:00">09:00</option><option value="09:30">09:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:30">23:30</option></select>',
                        html:true,
                        text: '',
                        type: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Continue",
                        cancelButtonText: "No, cancel!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) { 
                    var dtimeslotv = jQuery('#dtimeslot').val();
                    if (isConfirm) {
                      swal({
                        title: "Are you sure about this change?",
                        html:true,
                        text: '',
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, Change it!",
                        cancelButtonText: "No, cancel!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            var id = event.id;
                            var token = jQuery(this).attr('data-token');
                            jQuery.ajax({                            	
                                url: 'emails/emailSetup/' + id+'/campaignmove',
                                type: 'POST',
                                data: {
                                    "_token": '{{csrf_token()}}',
                                    "id": event.id,
                                    "timeslot": dtimeslotv,
                                    "edate": event.start.format()
                                },
                                success: function (result) {
                                    if (result.success) {
                                        swal("success!", "Campaign Change successfully.", "success");
                                          $('#calendar').fullCalendar('refetchEvents');
                                    } else {
                                        swal("ohh snap!", "something went wrong", "error");
                                        revertFunc();
                                    }

                                }
                            });
		                        } else {
		                            swal("Cancelled", "Campaign Change is cancelled ", "error");
		                            //return true;
		                            revertFunc();
		                        }
		                    });
                        } else {
                            swal("Cancelled", "Campaign Change is cancelled ", "error");
                            //return true;
                            revertFunc();
                        }
                   
            	
            	 
                    }); 
                    /*if (!confirm("Are you sure about this change?")) {
						revertFunc();
					}*/
            		return false;
			},
                    
        });

        
        
        var selectDraft='';
        var selectSend="";
        var selectSchedule="";
        if(id=="draft"){
            selectDraft="selected";
            
        }else if(id=="send"){
            selectSend="selected";
            console.log('id',id);
        }else if(id=="schedule"){
            selectSchedule="selected";
        }
            
        
   var customButton="<div class='fc-button-group campaignbtn'><a href='{{url('emails/emailSetup')}}'>{{ Lang::get('auth.createcamp') }}</a> <select id='statusData'><option value='all'>{{ Lang::get('auth.select') }}</option><option value='draft' "+selectDraft+">{{ Lang::get('auth.draft')}}</option><option value='send' "+selectSend+">{{ Lang::get('auth.send')}}</option></select><a href='javascript:void(0)'><i class='fa fa-paper-plane'></i> <b>5000</b>/<small>5000<small></a></div>";
       $(".fc-left").html(customButton);
	   
    
      }
      $(document).ready(function(){
    $("body").on('change','#statusData',function(e){
         $('#calendar').fullCalendar('destroy');    
         var data=$(this).val();
         calendarData(data);
     });  
     $(document).on('click', '#delete', function () {
            var $me = $(this);
            swal({
                        title: "Are you sure?",
                        text: "",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, Delete it!",
                        cancelButtonText: "No, cancel!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            var id = jQuery($me).attr('val');
                            var token = jQuery($me).attr('data-token');

                            jQuery.ajax({
                                url: 'emails/emailSetup/' + id,
                                type: 'DELETE',
                                data: {
                                    "_token": token
                                },
                                success: function (result) {
                                    if (result.success) {
                                        swal("success!", "Campaign deleted successfully.", "success");
                                          $('#calendar').fullCalendar('refetchEvents');
                                    } else {
                                        alert('false');
                                        swal("ohh snap!", "something went wrong", "error");
                                    }

                                }
                            });
                        } else {
                            swal("Cancelled", "Campaign delete is cancelled ", "error");
                            //return true;
                        }
                    });
            return false;
        });
      
    });
     
    </script>
 

<script type="text/javascript">
var oTableCampaign;
function  countChecked() {
    var n = $("input:checked").length; //n now contains the number of checked elements.
 //  $("#count").text(n + (n === 1 ? " is" : " zijn") + " aangevinkt!"); //show some text
    if (n == 0) {
        $(".deletebtn").fadeOut(); //if there are none checked, hide only visible elements
        $(".campaignDelete").fadeOut();
    } else {
        $(".deletebtn").fadeIn(); //otherwise (some are selected) fadeIn - if the div is hidden.
        $(".campaignDelete").fadeIn();
    }

}
$(function() {
    oTable = $('#emailTemplate-table').DataTable({
        sDom: 'lrftip',
        processing: true,
        serverSide: true,
        responsive: true,
        info: false,
        bFilter: false,
        ajax: '',
        columns: [
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'templateName', name: 'templateName'},
            {data: 'description', name: 'description'},
            {data: 'edit', name: 'edit', orderable: false, searchable: false}
        ]
    });
});
$(function() {
    oTableCampaign = $('#campaign-table').DataTable({
        sDom: 'lrftip',
        processing: true,
        serverSide: true,
        responsive: true,
        info: false,
        bFilter: false,
        ajax: {
            url: '/emails/campaignTable',
            "data": function(d) {
                mailType = $("#mailType").val();
                if (mailType)
                    d.mailType = mailType;
            }
        },
        columns: [
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'campaignName', name: 'campaignName'},
            {data: 'statistics', name: 'statistics'},
            {data: 'edit', name: 'edit', orderable: false, searchable: false}
        ]
    });
});
$(document).ready(function() {
    var dataToFetch = "";
    var APP_URL = {!! json_encode(url('/')) !!};
    $(document).on("click", ".emailDelCheckBox", function() {
        countChecked();
        if ($(this).is(":checked")) {
            $(this).parent().addClass("checked");
            $(".deletebtn").show();
             $(".campaignDelete").show();
        } else {
            $(this).parent().removeClass("checked");
            // $(".deletebtn").hide("slow", !$('input[type="checkbox"]').is(":checked"));
        }
    });

    $(document).on("change", "#multicheck", function() {
//        alert("hello");
        if ($(this).is(":checked")) {
            $(".deletebtn").fadeIn();

            $('.emailDelCheckBox').each(function() {
                $(this).prop('checked', true);
            });
            $(".emailDelCheckBox").parent().addClass("checked");

        } else {
            $('.emailDelCheckBox').each(function() {
                $(this).prop('checked', false);
            });
            $(".deletebtn").fadeOut();
            $(".emailDelCheckBox").parent().removeClass("checked");
        }
    });

    $(document).on("click", "#deletebtn", function() {

        var checkBoxValue = $(".emailDelCheckBox:checked").map(function() {
            return $(this).val();
        }).toArray();
        console.log(checkBoxValue);
        jQuery.ajax({
            url: 'emails/' + checkBoxValue,
            type: 'post',
            data: {
                "_method": 'delete',
                "_token": '{{csrf_token()}}'

            },
            success: function(result) {
                if (result.success) {
                    swal("success!", "Email Template  deleted successfully.", "success");
                    oTable.draw();
                    
                } else {
                    alert('false');
                    swal("ohh snap!", "something went wrong", "error");
                }
                 $(".deletebtn").fadeOut();

            }
        });
    });
        $(document).on("click", "#campaignDelete", function() {

        var checkBoxValue = $(".emailDelCheckBox:checked").map(function() {
            return $(this).val();
        }).toArray();
        console.log(checkBoxValue);
        jQuery.ajax({
            url: '/campaignTemplate/' ,
            type: 'post',
            data: {
                "_method": 'post',
                "_token": '{{csrf_token()}}',
                "checkBoxValue":checkBoxValue

            },
            success: function(result) {
                if (result.success) {
                    swal("success!", "Email Campaign  deleted successfully.", "success");
                    oTableCampaign.draw();
                } else {
                    alert('false');
                    swal("ohh snap!", "something went wrong", "error");
                }
                 $(".deletebtn").fadeOut();

            }
        });
    });

    $(document).on("click", ".duplicateTemplate", function() {
        var templateId = $(this).attr("id");
        console.log(templateId);
        jQuery.ajax({
            url: 'emails/duplicateTemplate/' + templateId,
            type: 'post',
            data: {
                "_token": '{{csrf_token()}}'
            },
            success: function(result) {
                if (result.success) {
                    swal("success!", "Email Template  Duplicated successfully.", "success");
                    oTable.draw();
                } else {
                    alert('false');
                    swal("ohh snap!", "something went wrong", "error");
                }

            }
        });
    });

    $(document).on("click", ".renameTemplate", function() {
        var templateId = $(this).attr("id");
        var templateName = $(this).attr("templateName");
        console.log(templateId);
        swal({
            title: "Template Rename",
            text: '<input class="visibleInput" id="templateName" type="text" name="templateName" value="' + templateName + '" placeholder="Enter Template Name">',
            html: true,
            showCancelButton: true,
        },
                function(response) {
                    if (response == true) {
                        templateName = $("#templateName").val();
                        var templateDescription = $("#templateDesc").val();
                        jQuery.ajax({
                            url: 'emails/rename/' + templateId,
                            type: 'POST',
                            data: {
                                "templateName": templateName,
                                "_token": '{{csrf_token()}}'
                            },
                            success: function(result) {
                                swal({
                                    title: "Template is Renamed Successfully",
                                    text: "",
                                    type: "success",
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Ok",
                                    closeOnConfirm: true
                                },
                                function(response) {
                                    if (response == true) {
                                        oTable.draw();
                                    }
                                    else {
                                        return false;
                                    }
                                });
                            }
                        });
                    }
                });
    });

    $(document).on("click", ".automaticMailForm", function() {
        $(".automaticMailing").show();
        $("#emailTemplate").hide();
        $(".manualMailing").hide();
        $(this).parents(".tabpart").find(".active").removeClass("active");
        $(this).parent().addClass("active");
    });
    $(document).on("click", ".manualMailingForm", function() {
        $("#sentbtn").trigger("click");
        $(".automaticMailing").hide();
        $(".manualMailing").show();
        //$('#calendar').fullCalendar('render');
        calendarData('all');
        $(this).parents(".tabpart").find(".active").removeClass("active");
        $(this).parent().addClass("active");

    });
    $(document).on("click", ".draftbtn", function() {
        $(this).addClass("active");
        if ($(".sentbtn").hasClass("active")) {
            $(".sentbtn").removeClass("active");
        }
        $("#mailType").val("draft");
        oTableCampaign.draw();
    });

    $(document).on("click", "#sentbtn", function() {
        $(this).addClass("active");
        if ($(".draftbtn").hasClass("active")) {
            $(".draftbtn").removeClass("active");
        }
        $("#mailType").val("sent");
        oTableCampaign.draw();
    });
    
     $("#cmn-toggle-1").change(function(){
        $(this).attr("checked","checked");
        if($(this).prop("checked")==true){
         $(this).val("1");
        }else{
            $(this).removeAttr("checked");
            $(this).val("0");
        }
         $.ajax({
               url:APP_URL+'/emails/reviewState/'+$(this).val(),
               type:'get',
               success:function(result){
                console.log(result);   
               }   
            });
    });
    $("#cmn-toggle-2").change(function(){
        $(this).attr("checked","checked");
        if($(this).prop("checked")==true){
        }else{
            $(this).removeAttr("checked");
        }
    });
    $("#cmn-toggle-3").change(function(){
        $(this).attr("checked","checked");
        if($(this).prop("checked")==true){
        }else{
            $(this).removeAttr("checked");
        }
    });
});
    
    var pieChartCanvas1 = $("#pieChart1").get(0).getContext("2d");
    var pieChart1 = new Chart(pieChartCanvas1);
    var PieData = [
      {
        value: 700,
        color: "#f56954",
        highlight: "#f56954",
        label: "Chrome"
      },
      {
        value: 500,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "IE"
      }, 
      {
        value: 600,
        color: "#00c0ef",
        highlight: "#00c0ef",
        label: "Safari"
      } 
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart1.Doughnut(PieData, pieOptions);
    
    var pieChartCanvas2 = $("#pieChart2").get(0).getContext("2d");
    var pieChart2 = new Chart(pieChartCanvas2);
    pieChart2.Doughnut(PieData, pieOptions);
    
    var pieChartCanvas3 = $("#pieChart3").get(0).getContext("2d");
    var pieChart3 = new Chart(pieChartCanvas3);
    pieChart3.Doughnut(PieData, pieOptions);
    
    
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      {
        value: 700,
        color: "#f56954",
        highlight: "#f56954",
        label: "Chrome"
      },
      {
        value: 500,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "IE"
      },
      {
        value: 400,
        color: "#f39c12",
        highlight: "#f39c12",
        label: "FireFox"
      },
      {
        value: 600,
        color: "#00c0ef",
        highlight: "#00c0ef",
        label: "Safari"
      },
      {
        value: 300,
        color: "#3c8dbc",
        highlight: "#3c8dbc",
        label: "Opera"
      },
      {
        value: 100,
        color: "#d2d6de",
        highlight: "#d2d6de",
        label: "Navigator"
      }
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);

    
    
    
</script>
  

 


@endpush