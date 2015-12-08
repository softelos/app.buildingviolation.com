<script>                
	bootbox.dialog({
		title:"<b>Note</b>",
		message:"{!! Session::get('message') !!}",
		closeButton:true,
		buttons:{
			success:{
				label:"OK",
				className:"btn-{{Session::get('message-type')}}",
			}
		}                                      
	});
</script>
