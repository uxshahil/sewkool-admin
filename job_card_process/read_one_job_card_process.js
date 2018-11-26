function calculateTotalOutstanding() {
    var total_invoiced;
    var total_paid;
    var total_outstanding;
    
    total_invoiced = parseFloat(document.getElementById("total_invoiced").innerText);
    total_paid = parseFloat(document.getElementById("total_paid").innerText);
    
    total_outstanding = total_invoiced - total_paid;
    
    document.getElementById("total_outstanding").innerText = total_outstanding;
}

calculateTotalOutstanding();