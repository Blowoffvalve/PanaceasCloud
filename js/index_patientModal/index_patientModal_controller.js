function collectOriModalData(pid){
	var firstName_id = "pFirstNameModal_" + pid;
	var lastName_id = "pLastNameModal_" + pid;
	var age_id = "inputAge_" + pid;
	var gender_id = "select_gender_" + pid;
	var status_name = "select_status_" + pid;
	var R_name = "select_respirations_" + pid;
	var P_name = "select_perfusion_" + pid;
	var M_name = "select_mentalStatus_" + pid;
	var patientCondition_id = "inputPatientCondition_" + pid;
	var beacon_id = "updateBeacon_ID_" + pid;

	var firstName_controller = document.getElementById(firstName_id);
	var lastName_controller = document.getElementById(lastName_id);
	var age_controller = document.getElementById(age_id);
	var gender_controller = document.getElementById(gender_id);
	var status_controller = document.getElementsByName(status_name);
	var R_controller = document.getElementsByName(R_name);
	var P_controller = document.getElementsByName(P_name);
	var M_controller = document.getElementsByName(M_name);
	var patientCondition_controller = document.getElementById(patientCondition_id);
	var beacon_controller = document.getElementById(beacon_id);


	var fn_oriVal = firstName_controller.value;
	var ln_oriVal = lastName_controller.value;
	var age_oriVal = age_controller.value;
	var gender_oriVal = gender_controller.value;
	var pc_oriVal = patientCondition_controller.value;
	var bc_oriVal = beacon_controller.value; 
	var status_oriVal = null;
	var R_oriVal = null;
	var P_oriVal = null;
	var M_oriVal = null;

	for(var i = 0; i < status_controller.length; i++){
	    if(status_controller[i].checked){
	        status_oriVal = status_controller[i].value;
	    }
	}

	for(var i = 0; i < R_controller.length; i++){
	    if(R_controller[i].checked){
	        R_oriVal = R_controller[i].value;
	    }
	}

	for(var i = 0; i < P_controller.length; i++){
	    if(P_controller[i].checked){
	        P_oriVal = P_controller[i].value;
	    }
	}

	for(var i = 0; i < M_controller.length; i++){
	    if(M_controller[i].checked){
	        M_oriVal = M_controller[i].value;
	    }
	}
	
	var finalData = {};
	finalData.pid = pid + "";
	finalData.patient_modal_data = {};
	finalData.patient_modal_data.fn_val = fn_oriVal;
	finalData.patient_modal_data.ln_val = ln_oriVal;
	finalData.patient_modal_data.age_val = age_oriVal;
	finalData.patient_modal_data.gender_val = gender_oriVal;
	finalData.patient_modal_data.pc_val = pc_oriVal;
	finalData.patient_modal_data.bc_val = bc_oriVal;
	finalData.patient_modal_data.status_val = status_oriVal;
	finalData.patient_modal_data.R_val = R_oriVal;
	finalData.patient_modal_data.P_val = P_oriVal;
	finalData.patient_modal_data.M_val = M_oriVal;
	
	return finalData;
}

function collectModalData(patients){
	var result = [];
	for(var i = 0; i < patients.length; i++){
		result[patients[i].patientId] = collectOriModalData(patients[i].patientId);
	}
	return result;
}

function detectModalUtil(pid, patients){
	var currModal = collectOriModalData(pid);
    var oriModal = patients[currModal.pid];

	if(currModal.patient_modal_data.M_val == oriModal.patient_modal_data.M_val && currModal.patient_modal_data.P_val == oriModal.patient_modal_data.P_val 
	   && currModal.patient_modal_data.R_val == oriModal.patient_modal_data.R_val && currModal.patient_modal_data.age_val == oriModal.patient_modal_data.age_val 
	   && currModal.patient_modal_data.bc_val == oriModal.patient_modal_data.bc_val && currModal.patient_modal_data.fn_val == oriModal.patient_modal_data.fn_val && currModal.patient_modal_data.gender_val == oriModal.patient_modal_data.gender_val && currModal.patient_modal_data.pc_val == oriModal.patient_modal_data.pc_val && currModal.patient_modal_data.status_val == oriModal.patient_modal_data.status_val){
	      var modal_id = "#editP_" + pid;
          $(modal_id).modal('hide');
	}else{
		var confirm_id = "#confirmP_" + pid;
		var confirm_controller = document.getElementById(confirm_id);
		$(confirm_id).modal('show');


	}
}

function closeModal(pid){
	var confirm_id = "#confirmP_" + pid;
	var editModal_id = "#editP_" + pid;
	$(confirm_id).modal('hide');
    $(editModal_id).modal('hide');
}

function stayOnEditModal(pid){
	var confirm_id = "#confirmP_" + pid;
    $(editModal_id).modal('hide');
}

function saveChanges(pid){
	var form_id =  "patientForm_" + pid;
	var form_controller = document.getElementById(form_id);
	var input = document.createElement('input');
	input.value = pid + "";
	input.name= "updateBtn_P_ID_map";
	input.style = "display:none;";
	form_controller.appendChild(input);
	form_controller.submit();
}

