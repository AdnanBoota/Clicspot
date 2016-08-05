@extends('app')

@push('styles')
<link href="{{ asset('/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/list.css') }}" rel="stylesheet" type="text/css"/>
<style>
	input[type=radio] {
		display:none;
	}

	input[type=radio] + label
	{
		background: #BAC3C7;
		height: 100px;
		width: 100%;
		display:inline-block;
		padding: 0 0 0 0px;
		cursor: pointer;
	}
	input[type=radio]:checked + label
	{
		background: #00EC9E;
		height: 100px;
		width: 100%;
		display:inline-block;
		padding: 0 0 0 0px;
	}

	label img
	{
		display: block;
		margin: 30px auto;
		max-width: 150px;
	}
</style>
@endpush

@section('content')
	<section class="creatpart">
		<div class="titleblock">
			<i class="fa fa-upload"></i>
			<h1>Import a list</h1>
		</div>
	</section>


	<section class="container" style="background: white; padding-top: 40px; padding-bottom: 150px">
		<form id="importTheList" class="form-horizontal" enctype="multipart/form-data">

			<div class="row">
				<div class="col-md-6">

					<div class="row">
						<div class="col-md-12">
							<h4 style="margin-bottom: 20px">Choose Import Type</h4>
						</div>
						<div class="col-md-6">
							<input type='radio' name='importType' value='clicspot' id="clicspotImporter" checked/>
							<label for="clicspotImporter">
								<img src="{{asset("/img/logo.png")}}">
							</label>
							<a style="margin-top: 10px;" target="_blank" href="/downloads/clicspot_model.xlsx" download="clicspot_model.xlsx"><i class="fa fa-download"></i> Download Clicspot model</a>
						</div>
						<div class="col-md-6">
							<input type='radio' name='importType' value='zenchef' id="zenchefImporter"/>
							<label for="zenchefImporter">
								<img src="http://zenchef.com/wp-content/themes/zenchef/img/logo_zenchef.png">
							</label>
							<a style="margin-top: 10px;" target="_blank" href="/downloads/zenchef_model.csv" download="zenchef_model.csv"><i class="fa fa-download"></i> Download ZenChef model</a>
						</div>
					</div>

				</div>
				<div class="col-md-4">
					<div style="margin-top: 35px">
						<h4>Upload your List</h4>
					</div>

					<div style="margin-top: 20px">
						<label>Select a default router for this list: </label>
						<div class="selectbox">
							<i class="fa fa-caret-down"></i>
							{!!  Form::select('router', $routers, null, ['id'=>'router','tabindex'=>'1']) !!}
						</div>
					</div>

					<div style="margin-top: 20px">
						<label>Select a default language for this list: </label>
						<div class="selectbox">
							<i class="fa fa-caret-down"></i>
							{!!  Form::select('language', $languages, null, ['id'=>'languages','tabindex'=>'13']) !!}
						</div>
					</div>

					<div style="margin-top: 20px">
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<input type="file" name="import_file" value="{{{ csrf_token() }}}" />
					</div>

					<div style="margin-top: 20px">
						<button style="display: block; width: 100%; background: #00EC9E; border: none" class="btn btn-primary btn-lg">Import List</button>
					</div>
				</div>
			</div>
		</form>

	</section>
@endsection

@push('scripts')
<script src="{{ asset('/js/bootstrap-multiselect.js') }}"></script>
<script type="text/javascript">
	$('#router').multiselect({
		includeSelectAllOption: false
	});
	$('#languages').multiselect({
		includeSelectAllOption: false,
		enableHTML: true
	});

	$("form#importTheList").on("submit", function(e){
		e.preventDefault();

		var formData = new FormData($(this)[0]);

		formData._token = '{{csrf_token()}}';

		jQuery.ajax({
			url: 'importList',
			type: 'POST',
			data: formData,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function(result) {
				if(result > 0){
					swal({
								title: result + " imported successfully",
								text: "",
								type: "success",
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "Ok",
								closeOnConfirm: true

							});
				}else{
					swal({
						title: "Your list is empty or malformed",
						text: "",
						type: "error",
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Ok",
						closeOnConfirm: true

					});
				}
			}
		});
	});
</script>
@endpush