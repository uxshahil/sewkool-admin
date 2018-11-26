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
}
