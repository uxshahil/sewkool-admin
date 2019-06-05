function submitForm() {
    var e = document.getElementById("job_card_id");
    var job_card_id = e.options[e.selectedIndex].value;

    if (e.selectedIndex != 0) {
        document.update_job_card_quality.action="verify_quality.php?id=" + job_card_id;
        document.update_job_card_quality.submit();    
    }
    
}