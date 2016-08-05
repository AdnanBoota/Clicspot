<?php //echo '<pre>'; print_r($userDetails); exit; ?>
@push('styles') 
<link href="{{ asset('/css/editrouter.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@extends('app')
@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="editrtitle">
        <img src="{{ asset("img/proimg.png") }}"><h1>Profile</h1>
    </div>
<section class="content-header">
    
    
</section>

<div class="editboxinfo">
    <h1>Business Profile</h1>
    <p>Modify the information below and click on Modify to save.</p>
  {!! Form::model($userDetails,["method"=>"POST","class"=>"editrouterform","action"=> ['PaymentController@updateUser'],"files"=>"true","id"=>"multidtepForm"]) !!}   
        <div class="editformblock">
            {!!  Form::hidden('basic','basic') !!}
             {!!  Form::text('email', null, array('id'=>'username','class'=>'addmail','required'=>'true','placeholder'=>'Address email')) !!}
           {!!  Form::text('username', null, array('id'=>'username','class'=>'fname','required'=>'true','placeholder'=>'Full Name')) !!}
<!--             <input class="fname" type="text" placeholder="Full Name">-->
           {!!  Form::text('businessname', null, array('id'=>'businessname','class'=>'bussname','required'=>'true','placeholder'=>'Business Name')) !!}
           {!!  Form::text('siren', null, array('id'=>'phone','class'=>'siranicon','required'=>'true','placeholder'=>'SIREN')) !!}
           {!!  Form::text('nvat', null, array('id'=>'nvat','class'=>'vaticon','required'=>'true','placeholder'=>'VAT NUMBER')) !!}
           {!!  Form::text('phone', null, array('id'=>'phone','class'=>'phicon','required'=>'true','placeholder'=>'Phone Number')) !!}
<!--            <input class="bussname" type="text" placeholder="Business Name"> -->
<!--            <input class="siranicon" type="text" placeholder="SIREN">-->
<!--            <input class="vaticon" type="text" placeholder="VAT NUMBER">-->
<!--            <input class="phicon" type="text" placeholder="Phone Number"> -->
        </div>
        <div class="editformblock">
            {!!  Form::text('address', null, array('id'=>'autocomplete','onFocus'=>'geolocate()','class'=>'addressicon','required'=>'true','placeholder'=>'Enter your address')) !!}
            <input type="hidden" id="street_number" value="">
             <input class="" type="text" placeholder="Enter your address" readonly="readonly" id="route" >
            <div class="editformrow">
            {!!  Form::text('zip',null,array('id'=>'postal_code','readonly'=>'readonly','placeholder'=>'Zip Code','class'=>'padnone')) !!}
           
<!--            <input class="padnone" type="text" placeholder="Zip Code" readonly="readonly"  id="postal_code"> -->
             {!!  Form::text('city',null,array('id'=>'locality','readonly'=>'readonly','placeholder'=>'Country','class'=>'padnone')) !!}    
<!--            <input class="padnone" type="text" placeholder="City" readonly="readonly"  id="locality">-->
            </div>
             {!!  Form::text('country',null,array('id'=>'country','readonly'=>'readonly','placeholder'=>'Country','class'=>'padnone')) !!}
<!--            <input class="padnone" type="text" placeholder="Country" readonly="readonly"  id="country"> -->
            
            
        </div>
        <div class="modifybtnblock">
            <button type="submit" class="modifybtn">Modify</button>
        </div>
   {!! Form::close() !!}
</div>

<div class="editboxinfo">
    <h1>Account Password</h1>
    <p>Modify the information below and click on Modify to save.</p>
  {!! Form::model($userDetails,["method"=>"POST","class"=>"editrouterform","action"=> ['PaymentController@updateUser'],"files"=>"true","id"=>"passform"]) !!}      
        <div class="editformblock passwordblock">
            {!!  Form::hidden('pass','pass') !!}
            {!!  Form::text('oldpassword', null, array('id'=>'phone','class'=>'pswicon','required'=>'true','placeholder'=>'Current password')) !!}
            {!!  Form::password('newpassword',  array('id'=>'newpass','class'=>'pswicon','required'=>'true','placeholder'=>'password')) !!}
            {!!  Form::password('retypepassword',  array('id'=>'retypepass','class'=>'pswicon','required'=>'true','placeholder'=>'Retype Password')) !!}
        </div>
         
        <div class="modifybtnblock">
            <button type="submit" class="modifybtn">Modify</button>
        </div>
   {!! Form::close() !!}
</div>



@endsection
@push('scripts')
<script>
    var placeSearch, autocomplete;
      var componentForm = {
       street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        //administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
                var val,value;
              if(addressType=="street_number")
              {
                     val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
              }else if(addressType=="route"){
                   var value = place.address_components[i][componentForm[addressType]];
                    if(val==undefined){
                    document.getElementById(addressType).value = value;
                 }
                    else{
                        document.getElementById(addressType).value =val+" "+value;
                     }
              }else{
                   var vale = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value =vale;
              }

          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
        <script>
            $(function(){
                
            
             var validator = $('#multidtepForm').validate({
        rules: {
            
            "email": {
                "required": true,
                "email": true
            },
            "username": "required",
            "businessname": "required",
            "address": "required",
            "city": "required",
            "zip": "required",
            "country": "required",
            "phone":{ "required":true, "number": true} ,
            "nvat": "required",
            "siren": "required",
            "term":"required"
        }
         });
         var valid = $('#passform').validate({
        rules: {
            "newpassword": "required",
            "retypepassword": {
                "required": true,
                "equalTo": "#newpass",
            },
        }
        });
        });
        
        
        </script>
        @endpush