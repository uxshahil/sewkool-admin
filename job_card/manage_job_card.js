function getJobCardStatus() {
    var list1 = document.getElementById('job_card_phase');
    var list2 = document.getElementById("job_card_status_id");
    var list1SelectedValue = list1.options[list1.selectedIndex].value;
        
    if (list1SelectedValue=='1')
    {
            
        list2.options.length=0;
        list2.options[0] = new Option('Please select...', '');
        list2.options[1] = new Option('Signed In', '6');
        list2.options[2] = new Option('Job Quantity Checked', '7');
            
    }
    else if (list1SelectedValue=='2')
    {
            
        list2.options.length=0;
        list2.options[0] = new Option('Please select...', '');
        list2.options[1] = new Option('Awaiting Artwork from Client', '8');
        list2.options[2] = new Option('Awaiting Digitization', '9');
        list2.options[3] = new Option('Awaiting Artwork Approval', '10');
            
    }
    else if (list1SelectedValue=='3')
    {
            
        list2.options.length=0;
        list2.options[0] = new Option('Please select...', '');
        list2.options[1] = new Option('Awaiting Loading', '11');
        list2.options[2] = new Option('Awaiting Production', '12');
        list2.options[3] = new Option('Production', '13');
        list2.options[4] = new Option('Quality / Quantity Checked', '14');
        list2.options[5] = new Option('Complete', '15'); 
        list2.options[6] = new Option('Signed-Off', '16');    

    }
    else if (list1SelectedValue=='4')
    {
            
        list2.options.length=0;
        list2.options[0] = new Option('Please select...', '');
        list2.options[1] = new Option('Cancelled Order', '17');
        list2.options[2] = new Option('Investigate', '18');
        list2.options[3] = new Option('Can’t Find', '19');
        list2.options[4] = new Option('Damaged Goods', '20');
        list2.options[5] = new Option('Void', '21');
        list2.options[6] = new Option('Shahil To Delete', '27');
            
    }
    else if (list1SelectedValue=='5')
    {
            
        list2.options.length=0;
        list2.options[0] = new Option('Please select...', '');
        list2.options[1] = new Option('Invoiced', '22');
        list2.options[2] = new Option('Paid', '23');
    }
}

function setStatusInputs() {
    var list1 = document.getElementById('job_card_status_id');
    var list1SelectedValue = list1.options[list1.selectedIndex].value;
        
    if (list1SelectedValue=='7') //quanity verified check
    {
        showHide(7);

    }
    else if (list1SelectedValue=='14') //qaulity verified check 
    {
        showHide(14);    
            
    }
    else if (list1SelectedValue=='12') //awaiting production assign user  
    {
        showHide(12);    
            
    }
    else {
        hideAll();
    }
}

function showHide(status) {
    
    if (status == "7") {

        if (document.getElementById("tr_qty_verify_customer").style.display === "none") {
            document.getElementById("tr_qty_verify_customer").style.display = "table-row";
        } else {
            document.getElementById("tr_qty_verify_customer").style.display = "none";
        }

        if (document.getElementById("tr_qty_verify_checked").style.display === "none") {
            document.getElementById("tr_qty_verify_checked").style.display = "table-row";
        } else {
            document.getElementById("tr_qty_verify_checked").style.display = "none";
        }

        if (document.getElementById("tr_qty_verify_info").style.display === "none") {
            document.getElementById("tr_qty_verify_info").style.display = "table-row";
        } else {
            document.getElementById("tr_qty_verify_info").style.display = "none";
        }
    }

    if (status == "14") {

        if (document.getElementById("tr_qty_quality_pass").style.display === "none") {
            document.getElementById("tr_qty_quality_pass").style.display = "table-row";
        } else {
            document.getElementById("tr_qty_quality_pass").style.display = "none";
        }

        if (document.getElementById("tr_qty_quality_not_pass").style.display === "none") {
            document.getElementById("tr_qty_quality_not_pass").style.display = "table-row";
        } else {
            document.getElementById("tr_qty_quality_not_pass").style.display = "none";
        }

        if (document.getElementById("tr_qty_quality_info").style.display === "none") {
            document.getElementById("tr_qty_quality_info").style.display = "table-row";
        } else {
            document.getElementById("tr_qty_quality_info").style.display = "none";
        }
    }

    if (status == "12") {

        if (document.getElementById("tr_assigned_to").style.display === "none") {
            document.getElementById("tr_assigned_to").style.display = "table-row";
        } else {
            document.getElementById("tr_assigned_to").style.display = "none";
        }
    }
    
}

function hideAll() {
    document.getElementById("tr_qty_verify_customer").style.display = "none";
    document.getElementById("tr_qty_verify_checked").style.display = "none";
    document.getElementById("tr_qty_verify_info").style.display = "none";
    document.getElementById("tr_qty_quality_pass").style.display = "none";
    document.getElementById("tr_qty_quality_not_pass").style.display = "none";
    document.getElementById("tr_qty_quality_info").style.display = "none";
    document.getElementById("tr_assigned_to").style.display = "none";
} 

function submitForm() {
    var list1 = document.getElementById('job_card_status_id');
    var list1SelectedValue = list1.options[list1.selectedIndex].value;
        
    if (list1SelectedValue=='7') //quanity verified check
    {
        document.update_job_card.action="manage_job_card_function.php?action=verify_quantity"
    }
    else if (list1SelectedValue=='14') //qaulity verified check 
    {
        document.update_job_card.action="manage_job_card_function.php?action=verify_quality"
    }
    else if (list1SelectedValue=='12') //awaiting production assign user  
    {
        document.update_job_card.action="manage_job_card_function.php?action=assign_user"
    }
    else {
        document.update_job_card.action="manage_job_card_function.php?action=update_status"
    }

    document.update_job_card.submit();
}

function filterPhase() {
    document.filter_job_card.action="manage_job_card_function.php?action=filter_phase";
    document.filter_job_card.submit();
}

function filterStatus() {
    document.filter_job_card.action="manage_job_card_function.php?action=filter_status"
    document.filter_job_card.submit();
}

function filterNoVoidNoInvoiced() {

    if (document.getElementById("no_void_no_invoiced").selectedIndex == 0){

        document.filter_job_card.action="manage_job_card_function.php?action=no_void_no_invoiced";

    } else if (document.getElementById("no_void_no_invoiced").selectedIndex == 1){

        document.filter_job_card.action="manage_job_card_function.php?action=no_void";

    } else if (document.getElementById("no_void_no_invoiced").selectedIndex == 2){

        document.filter_job_card.action="manage_job_card_function.php?action=no_invoiced";

    } else if (document.getElementById("no_void_no_invoiced").selectedIndex == 3){

        document.filter_job_card.action="manage_job_card_function.php?action=no_filter";
    } 

    document.filter_job_card.submit();
}