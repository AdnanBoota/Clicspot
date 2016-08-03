
<script>
$(function()
{
	 $( "#q" ).autocomplete({
	  source: "search/autocomplete",
	  minLength: 3,
	  select: function(event, ui) {
	  	$('#q').val(ui.item.value);
	  }
	});
});