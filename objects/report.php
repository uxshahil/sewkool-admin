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

    function dashboardReportAll($id){
        $query = "SELECT 
                    j.id AS 'Job Card No', 
                    b.name AS 'Client', 
                    bb.name AS 'Customer', 
                    u.first_name AS 'Assigned To', 
                    j.qty_verify_customer AS 'Qty'
                FROM 
                    Job_Card j
                LEFT JOIN 
                    `Status` s 
                        ON 
                        j.job_card_status_id = s.id  
                LEFT JOIN 
                    `Business` b
                        ON 
                        j.client_business_id = b.id
                LEFT JOIN 
                    `User` u
                        ON 
                        j.assigned_to = u.id
                LEFT JOIN 
                    `Business` bb
                        ON 
                        j.customer_business_id = bb.id
                WHERE 
                    s.id = ?";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }

    function dashboardReportAssignedToUsers(){
        $query = " SELECT DISTINCT 
                    u.id, 
                    u.first_name, 
                    u.last_name 
                FROM 
                    `User` u 
                LEFT JOIN 
                    `Job_Card` j
                        ON 
                            j.assigned_to = u.id
                LEFT JOIN 
                    `Status` s
                        ON 
                            j.job_card_status_id = s.id
                WHERE 
                    j.assigned_to IS NOT NULL 
                        AND 
                            (s.title = 'Awaiting Production' OR s.title = 'Production')";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }

    function dashboardReportUser($id, $user){
        $query = "SELECT 
                    j.id AS 'Job Card No', 
                    b.name AS 'Client', 
                    bb.name AS 'Customer', 
                    u.first_name AS 'Assigned To', 
                    j.qty_verify_customer AS 'Qty'
                FROM 
                    Job_Card j
                LEFT JOIN 
                    `Status` s 
                        ON 
                        j.job_card_status_id = s.id  
                LEFT JOIN 
                    `Business` b
                        ON 
                        j.client_business_id = b.id
                LEFT JOIN 
                    `User` u
                        ON 
                        j.assigned_to = u.id
                LEFT JOIN 
                    `Business` bb
                        ON 
                        j.customer_business_id = bb.id
                WHERE 
                    s.id = ? AND u.id = ?";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $user);
        $stmt->execute();
        return $stmt;
    }

    function dashboardDeadlineReport($duration){

        // used for deadline_report
        // due this week
        // due today
        // due tomorrow
        // due next week
        // due this month
        // due next month

        // due today & past due
        // due in 3 days or less
        // due in 4 - 7 days 
        // due in 7+ days

        if ($duration == "0") {
            $query = "SELECT 
                         j.id, j.created_date AS Created, j.deadline_date AS Deadline, j.deadline_enforce, b.name AS Client, bb.name AS Customer, s.title AS 'Status', 

                            ((DATEDIFF(deadline_date, CURDATE())) -
                            ((WEEK(deadline_date) - WEEK(CURDATE())) * 2) -
                            (case when weekday(deadline_date) = 6 then 1 else 0 end) -
                            (case when weekday(CURDATE()) = 5 then 1 else 0 end)) as 'Days Left'

                    FROM 
                        Job_Card j
                    LEFT JOIN  
                        Business b
                            ON j.client_business_id = b.id
                    LEFT JOIN
                        Business bb
                            ON j.customer_business_id = bb.id
					LEFT JOIN 
						Status s
							ON j.job_card_status_id = s.id
                    WHERE 
                        ( DATEDIFF(deadline_date,CURDATE()) <= 0) 
                    ORDER BY
                        deadline_enforce DESC, deadline_date ASC;";
        }

        if ($duration == "1") {
            $query = "SELECT 
                        j.id, j.created_date AS Created, j.deadline_date AS Deadline, j.deadline_enforce, b.name AS Client, bb.name AS Customer, s.title AS 'Status', 

                            ((DATEDIFF(deadline_date, CURDATE())) -
                            ((WEEK(deadline_date) - WEEK(CURDATE())) * 2) -
                            (case when weekday(deadline_date) = 6 then 1 else 0 end) -
                            (case when weekday(CURDATE()) = 5 then 1 else 0 end)) as 'Days Left'

                    FROM 
                        Job_Card j
                    LEFT JOIN  
                        Business b
                            ON j.client_business_id = b.id
                    LEFT JOIN
                        Business bb
                            ON j.customer_business_id = bb.id
                    LEFT JOIN 
                        Status s
                            ON j.job_card_status_id = s.id
                    WHERE 
                        ( DATEDIFF(deadline_date,CURDATE()) > 0) AND ( DATEDIFF(deadline_date,CURDATE() ) <= 7) 
                    ORDER BY
                        deadline_enforce DESC, deadline_date ASC;";
        }            

        if ($duration == "2") {
            $query = "SELECT 
                        j.id, j.created_date AS Created, j.deadline_date AS Deadline, j.deadline_enforce, b.name AS Client, bb.name AS Customer, s.title AS 'Status', 

                            ((DATEDIFF(deadline_date, CURDATE())) -
                            ((WEEK(deadline_date) - WEEK(CURDATE())) * 2) -
                            (case when weekday(deadline_date) = 6 then 1 else 0 end) -
                            (case when weekday(CURDATE()) = 5 then 1 else 0 end)) as 'Days Left'

                    FROM 
                        Job_Card j
                    LEFT JOIN  
                        Business b
                            ON j.client_business_id = b.id
                    LEFT JOIN
                        Business bb
                            ON j.customer_business_id = bb.id
                    LEFT JOIN 
                        Status s
                            ON j.job_card_status_id = s.id
                    WHERE 
                        ( DATEDIFF(deadline_date,CURDATE()) > 7) 
                    ORDER BY
                        deadline_enforce DESC, deadline_date ASC;";
        }      

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

    function dashboardDeadlineReportCountQuantity($id){
        // select all data
        $query = "SELECT 
                    SUM(item_qty) AS 'Count' 
                FROM 
                    Line_Item 
                WHERE 
                    job_card_id = ?;";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt;
    }
}