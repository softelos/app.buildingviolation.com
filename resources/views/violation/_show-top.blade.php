<div class="violation-top-summary">
	<div class="row">
		<div class="col-md-6">
			<ul>
				<li><span class="ul-label"><i class="fa fa-medkit"></i> Class:</span>{{ $violation->class }}</li>
				<li><span class="ul-label"><i class="fa fa-building-o"></i> Type:</span>{{ $violation->type }}</li>
				<li><span class="ul-label"><i class="fa fa-user"></i> Reporter:</span>{{ $violation->reporter }}</li>
				<li><span class="ul-label"><i class="fa fa-exclamation-triangle"></i> Status:</span>{{ $violation->status }}</li>
			</ul>
		</div>
		<div class="col-md-6">
			<ul>
				<li><span class="ul-label"><i class="fa fa-check"></i> Corrected:</span>{{ $violation->corrected }}</li>
				<li><span class="ul-label"><i class="fa fa-balance-scale"></i> Guilty:</span>{{ $violation->guilt_admit }}</li>
				<li><span class="ul-label"><i class="fa fa-calendar"></i> Hearing:</span>{{ $violation->hearing_date_missed }}</li>
				<li><span class="ul-label"><i class="fa fa-money"></i> Offers:</span>{{ $violation->offers }}</li>
			</ul>
		</div>
	</div>
</div>