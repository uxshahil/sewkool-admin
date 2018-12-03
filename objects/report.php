<?php
class report{

    // databse connection and table name
    private $conn;

    // user properties 
    public $job_card_id;
    public $invoice_id;
    public $business_id;
    public $status_id;
    public $job_card_status_id;
    public $invoice_status_id;
    public $account_status_id;

    public function __construct($db){
        $this->conn = $db;
    }

    function filterJobCardByStatus(){
 
        $query = "SELECT 
                    i.job_card_id, s.title 
                FROM 
                    Job_Card j
                LEFT JOIN 
                    Invoice i 
                        ON 
                        j.id = i.job_card_id
                LEFT JOIN 
                    Status s
                        ON 
                        j.job_card_status_id = s.id
                WHERE 
                    j.job_card_status_id = ?";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->job_card_status_id);
        $stmt->execute();
        return $stmt;
    }

    function statusReport($filter){
        $query = "CALL sp_Status_Report(?)";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $filter); 
        $stmt->execute();
        return $stmt;
    }

    function dashboardReportAll($status){
        $query = "SELECT 
                    j.id AS 'Job Card No', 
                    b.name AS 'Client', 
                    bb.name AS 'Customer', 
                    u.first_name AS 'Assigned To', 
                    j.qty_verify_customer AS 'Qty'
                FROM 
                    job_card j
                LEFT JOIN 
                    `status` s 
                        ON 
                        j.job_card_status_id = s.id  
                LEFT JOIN 
                    `business` b
                        ON 
                        j.client_business_id = b.id
                LEFT JOIN 
                    `user` u
                        ON 
                        j.assigned_to = u.id
                LEFT JOIN 
                    `business` bb
                        ON 
                        j.customer_business_id = bb.id
                WHERE 
                    s.title = ?";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $status);
        $stmt->execute();
        return $stmt;
    }
}
