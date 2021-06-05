/**
* Custom Js for backend 
*
* @package Business_Plan 
*/
jQuery(document).ready(function($) {
    $('#business-plan-img-container li label img').click(function(){    	
        $('#business-plan-img-container li').each(function(){
            $(this).find('img').removeClass ('business-plan-radio-img-selected') ;
        });
        $(this).addClass ('business-plan-radio-img-selected') ;
    });                    
});