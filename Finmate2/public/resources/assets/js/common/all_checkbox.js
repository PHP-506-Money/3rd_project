$(document).ready(function() {

    
//한개만 체크
 $('input[type="checkbox"][name="only_ch"]').click(function(){
 
  if($(this).prop('checked')){
 
     $('input[type="checkbox"][name="only_ch"]').prop('checked',false);
 
     $(this).prop('checked',true);
 
    }
  
   });



});

$(document).ready(function() {

// 전체 선택 및 해제
$("#All").click(function() {
		if($("#All").is(":checked")) $("input[name=chk]").prop("checked", true);
		else $("input[name=chk]").prop("checked", false);
	});

	$("input[name=chk]").click(function() {
		var total = $("input[name=chk]").length;
		var checked = $("input[name=chk]:checked").length;

		if(total != checked) $("#All").prop("checked", false);
		else $("#All").prop("checked", true); 
	});


$("#All_sms").click(function() {
		if($("#All_sms").is(":checked")) $("input[name=chk_sms]").prop("checked",true);
		else $("input[name=chk_sms]").prop("checked",false);
	});	

	$("input[name=chk_sms]").click(function() {
		var total_sms = $("input[name=chk_sms]").length;
		var checked_sms = $("input[name=chk_sms]:checked").length;

		if(total_sms != checked_sms) $("#All_sms").prop("checked",false);
		else $("#All_sms").prop("checked",true); 
	});
	});