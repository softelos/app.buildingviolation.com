$(document).ready(function(){

    // Initiate data tables
    $('#payments_table').DataTable();
    $('#users_table').DataTable();

    // Initiate selects
    $('select').selectpicker();
    
    // For links that trigger modals
    $('a.remove-item').click(function () {
        var url = this.href;      
        window.location.href = url;
    });
    
    // D I A L O G S
    
    // Confirm for <a>    
    $('a.action-confirm').click(function(e){
        e.preventDefault();
        var msg=$(this).attr('data');
        var url=$(this).attr('href');
        var forwarding=$(this).hasClass('action-forwarding');
        var forwarding_msg=$(this).attr('forward-msg');
        bootbox.confirm(msg,function(result){
            if(result){
                if(forwarding) bootbox.alert(forwarding_msg);
                window.location.href=url;
            }
        });
    });

    // Confirm for buttons    
    $('button.action-confirm').click(function(e){
        e.preventDefault();
        var msg=$(this).attr('data');
        var form=$(this).closest('form');
        bootbox.confirm(msg,function(result){
            if(result) form.submit();
        });
    });
    
    // Report Violation Form
    if($('input#guilt_admit_0').is(":checked")) $('div#guilt_admit').removeClass('hidden');
    else $('div#guilt_admit').addClass('hidden'); 
    
    if($('input#corrected_1').is(":checked")) $('div#corrected').removeClass('hidden');
    else $('div#corrected').addClass('hidden');         
    
    if($('select[name=correction_author] option:selected').val()!='myself') $('div#contractor').removeClass('hidden');
    else $('div#contractor').addClass('hidden');     
    
    // User Form
    if($('input#licensed_1').is(":checked")) $('div#license-number').removeClass('hidden');
    else $('div#license-number').addClass('hidden');
    
        
    // Report From
    // Not Guilty
    $('input[name=guilt_admit]').change(function(){       
        if($('input#guilt_admit_0').is(":checked")) $('div#guilt_admit').removeClass('hidden');
        else $('div#guilt_admit').addClass('hidden');     
    });
    
    // Corrected
    $('input[name=corrected]').change(function(){       
        if($('input#corrected_1').is(":checked")) $('div#corrected').removeClass('hidden');
        else $('div#corrected').addClass('hidden');     
    });
    
    // Corrected - Contractor Information
     $('select[name=correction_author]').change(function(){       
        if($('select[name=correction_author] option:selected').val()!='myself') $('div#contractor').removeClass('hidden');
        else $('div#contractor').addClass('hidden');     
    });
    
    
    // User Form
    $('input[name=licensed]').change(function(){       
        if($('input#licensed_1').is(":checked")) $('div#license-number').removeClass('hidden');
        else $('div#license-number').addClass('hidden');
    });      


    // F O R M  E L E M E N T S
    // Text count
    $('.text-count').maxlength({
        alwaysShow:true
    });
    $('.text-count').focusout(function(){
        $('span.bootstrap-maxlength').hide();
    });   
    
});