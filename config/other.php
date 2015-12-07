<?php
	
	return [
		// Name of the Website
		'sitename'=>'BuildingViolation',
		// Year of copyright to show in the footer
		'copyright'=>2015,
		// email address to contact
		'email'=>'hello@softelos.com',
		// Google API key for street view and maps
		'googleAPIKey'=>'AIzaSyAhYzD8In6fSnp1OFPbUjyatiDCRsSsQDk',
		// List of States
		'user_types'=>[
			'admin'=>'Administrator',
			'cus'=>'Customer',
			'pro'=>'Pro'	
		],
		'pro_types'=>[
			'architect'=>'Architect',
			'attorney'=>'Attorney',
			'carpenter'=>'Carpenter',
			'electrician'=>'Electrician',
			'filing'=>'Filing Rep./Expediter',
			'plumber'=>'Plumber',
			'engineer'=>'Engineer'
		],
		'states'=>[
			'AL'=>"Alabama",  
			'AK'=>"Alaska",  
			'AZ'=>"Arizona",  
			'AR'=>"Arkansas",  
			'CA'=>"California",  
			'CO'=>"Colorado",  
			'CT'=>"Connecticut",  
			'DE'=>"Delaware",  
			'DC'=>"District Of Columbia",  
			'FL'=>"Florida",  
			'GA'=>"Georgia",  
			'HI'=>"Hawaii",  
			'ID'=>"Idaho",  
			'IL'=>"Illinois",  
			'IN'=>"Indiana",  
			'IA'=>"Iowa",  
			'KS'=>"Kansas",  
			'KY'=>"Kentucky",  
			'LA'=>"Louisiana",  
			'ME'=>"Maine",  
			'MD'=>"Maryland",  
			'MA'=>"Massachusetts",  
			'MI'=>"Michigan",  
			'MN'=>"Minnesota",  
			'MS'=>"Mississippi",  
			'MO'=>"Missouri",  
			'MT'=>"Montana",
			'NE'=>"Nebraska",
			'NV'=>"Nevada",
			'NH'=>"New Hampshire",
			'NJ'=>"New Jersey",
			'NM'=>"New Mexico",
			'NY'=>"New York",
			'NC'=>"North Carolina",
			'ND'=>"North Dakota",
			'OH'=>"Ohio",  
			'OK'=>"Oklahoma",  
			'OR'=>"Oregon",  
			'PA'=>"Pennsylvania",  
			'RI'=>"Rhode Island",  
			'SC'=>"South Carolina",  
			'SD'=>"South Dakota",
			'TN'=>"Tennessee",  
			'TX'=>"Texas",  
			'UT'=>"Utah",  
			'VT'=>"Vermont",  
			'VA'=>"Virginia",  
			'WA'=>"Washington State",  
			'WV'=>"West Virginia",  
			'WI'=>"Wisconsin",  
			'WY'=>"Wyoming"
		],
		'violation_class'=>[
			'class_1'=>'Hazardous',
			'class_2'=>'Non-Hazardous',
			'other'=>'Other'
		],
		'violation_type'=>[
			'boilers'=>'Boilers',
			'construction'=>'Construction',
			'elevators'=>'Elevators',
			'local_law'=>'Local Law',
			'quality_of_life'=>'Quality of Life',
			'site_safety'=>'Site Safety',
			'zoning'=>'Zoning',
			'other'=>'Other'
		],
		'violation_reporter'=>[
			'respondent'=>'Respondent named on the violation',
 			'officer'=>'Officer/Director/Managing Agent of named Respondent corporation',
 			'owner'=>'Owner of Property, but NOT named Respondent (new owners)',
 			'managing_agent'=>'Managing Agent of Place of occurrence',
 			'partner'=>'Partner of named Respondent partnership',
 			'contractor'=>'Contractor or Other agent of named Respondent'
		],
		'violation_corrector'=>[
			'myself'=>'Myself',
 			'my_employee'=>'My Employee',
 			'contractor'=>'Contractor',
 			'architect_engineer'=>'Architect/Engineer'
		],
		'stage_status'=>[
			0=>'Open',
			1=>'Awarded',
			2=>'Conditions Submitted',
			3=>'Conditions Accepted',
			4=>'Started',
			5=>'Completed',
			6=>'Closed'
		],
		'rates'=>[
			0=>'0',
			1=>'1',
			2=>'3',
			4=>'4',
			5=>'5'
		]
	];