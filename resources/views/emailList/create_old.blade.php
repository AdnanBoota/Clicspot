@extends('app')
@push('styles')
<link href="{{ asset('/css/list.css') }}" rel="stylesheet" type="text/css"/>

       <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
        rel="stylesheet" type="text/css" />
    

@endpush
@section('content')


<section class="creatpart">
    <div class="titleblock">
        <i class="fa fa-pencil-square-o"></i>
        <h1>Create List</h1>
    </div>
    <div class="multitab">
        <ul class="tabpart">
            <li class="active"><a href="#"><i class="fa fa-pencil"></i>Create list</a></li>
            <li><a href="#"><i class="fa fa-pencil-square-o"></i>Edit list</a></li>
            <li><a href="#"><i class="fa fa-list-alt"></i>User list</a></li>
        </ul>
    </div>
</section>
<section class="profilepart">
    <div class="titleblock">
        <i class="fa fa-search"></i>
        <h1>Profiles found</h1>
    </div>
    <div class="multitab">
        <ul class="tabpart">
            <li class="active"><a href="#"><i class="fa fa-pencil"></i>Create list</a></li>
            <li><a href="#"><i class="fa fa-pencil-square-o"></i>Edit list</a></li>
            <li><a href="#"><i class="fa fa-list-alt"></i>User list</a></li>
        </ul>
    </div>
</section>

<section class="filterpart">
    <div class="titleblock">
        <h1>Filters</h1>
    </div>
    <div class="filterform">
       
        <form>
            
        </form>
    </div>
</section>

@endsection
@push('scripts')
<script src="{{ asset('/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
        type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $('form').validate({
            rules: {},
            errorClass: "text-red",
            errorElement: "span",
            errorPlacement: function (error, element) {
                if (element.context.name == 'x') {
                    error.appendTo(element.parents(".col-sm-10:last"));
                }
                else {
                    error.appendTo(element.parents(".col-sm-10:first"));
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

        $(".my-colorpicker").colorpicker();
        $("#ChilliSpot-Bandwidth-Max-Up").ionRangeSlider({
            min: 256,
            max: 10240,
            step: 256,
            prettify: function (value) {
                if (value < 1024) {
                    return Math.round(value) + ' Kbps';
                } else {
                    return (value / 1024) + ' Mbps';
                }
            }
        });
        $("#ChilliSpot-Bandwidth-Max-Down").ionRangeSlider({
            min: 256,
            max: 10240,
            step: 256,
            prettify: function (value) {
                if (value < 1024) {
                    return Math.round(value) + ' Kbps';
                } else {
                    return (value / 1024) + ' Mbps';
                }
            }
        });
        $("#Session-Timeout").ionRangeSlider({
            min: 60,
            max: 14400,
            step: 60,
            prettify: function (value) {
                return Math.round(value / 60) + ' min';
            }
        });
        $("#Idle-Timeout").ionRangeSlider({
            min: 60,
            max: 7200,
            grid_num: 1,
            prettify: function (value) {
                return Math.round(value / 60) + ' min';
            }
        });
        
        
        
        
        
        $("#backgroundimage").on("change", function()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function(){ // set image data as background of div
                    $("#preview").css("background-image", "url("+this.result+")");
                }
            }
        });
        
        $("#logoimage").on("change", function()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function(){ // set image data as background of div
                    
                    $("#preview #logo").css("background-image", "url("+this.result+")");
                }
            }
        });

    });

</script>
 <script type="text/javascript">
        $(function () {
            $('#lstFruits').multiselect({
                includeSelectAllOption: true
            });
            $('#btnSelected').click(function () {
                var selected = $("#lstFruits option:selected");
                var message = "";
                selected.each(function () {
                    message += $(this).text() + " " + $(this).val() + "\n";
                });
                alert(message);
            });
        });
    </script>
@endpush