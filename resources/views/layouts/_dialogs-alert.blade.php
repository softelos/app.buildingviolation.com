<script>                
	bootbox.dialog({
		title:"Message",
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
