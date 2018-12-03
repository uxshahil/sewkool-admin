<?php
class job_card{
  
    // databse connection and table name
    private $conn;
    private $table_name = 'Job_Card';

    // job_card properties 
		public $id;
		public $client_business_id;
		public $customer_business_id;
		public $job_card_status_id;
		public $created_date;
		public $created_by;
		public $modified_date;
		public $modified_by;
        public $row_source;
        public $client_invoice_number;
        public $skip_artwork;
        public $qty_verify_customer;
        public $qty_verify_checked;
        public $qty_verify_info;
        public $qty_quality_pass;
        public $qty_quality_not_pass;
        public $qty_quality_info;
        public $assigned_to;

    public function __construct($db){
        $this->conn = $db;
    }

    // create business 
    function create(){

        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
				SET 
					client_business_id=:client_business_id,
					customer_business_id=:customer_business_id,
                    client_invoice_number=:client_invoice_number,
                    skip_artwork=:skip_artwork,
                    qty_verify_customer=:qty_verify_customer
                    ";

        $stmt = $this->conn->prepare($query);

        // posted values
		$this->client_business_id=htmlspecialchars(strip_tags($this->client_business_id));
		$this->customer_business_id=htmlspecialchars(strip_tags($this->customer_business_id));
        $this->client_invoice_number=htmlspecialchars(strip_tags($this->client_invoice_number));
        $this->skip_artwork=htmlspecialchars(strip_tags($this->skip_artwork));
        $this->qty_verify_customer=htmlspecialchars(strip_tags($this->qty_verify_customer));

        // bind values
		$stmt->bindParam(":client_business_id", $this->client_business_id);
		$stmt->bindParam(":customer_business_id", $this->customer_business_id);
        $stmt->bindParam(":client_invoice_number", $this->client_invoice_number);
        $stmt->bindParam(":skip_artwork", $this->skip_artwork);
        $stmt->bindParam(":qty_verify_customer", $this->qty_verify_customer);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }
    
    function readAll($from_record_num, $records_per_page){
 
        $query = "SELECT
                    j.id, b.name, s.title
                FROM
                    " . $this->table_name . " j
                    LEFT JOIN
                        Business b
                            ON j.client_business_id = b.id
                    LEFT JOIN 
                        Status s
                            ON j.job_card_status_id = s.id
                ORDER BY
                    id ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        return $stmt;
    }

    function readAllForBusiness($business_id){
 
        $query = "SELECT
                    j.id, b.name, s.title
                FROM
                    " . $this->table_name . " j
                    LEFT JOIN
                        Business b
                            ON j.client_business_id = b.id
                    LEFT JOIN 
                        Status s
                            ON j.job_card_status_id = s.id
                    WHERE
                        b.id = ?
                ORDER BY
                    id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $business_id);
        $stmt->execute();
     
        return $stmt;
    }

    // used for paging business
    function countAll(){

        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

    function readOne(){

        $query = "SELECT *
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    0,1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];
		$this->client_business_id = $row['client_business_id'];
		$this->customer_business_id = $row['customer_business_id'];
		$this->job_card_status_id = $row['job_card_status_id'];
		$this->created_date = $row['created_date'];
		$this->created_by = $row['created_by'];
		$this->modified_date = $row['modified_date'];
		$this->modified_by = $row['modified_by'];
        $this->row_source = $row['row_source'];
        $this->client_invoice_number = $row['client_invoice_number'];
        $this->skip_artwork = $row['skip_artwork'];
        $this->qty_verify_customer = $row['qty_verify_customer'];
		$this->qty_verify_checked = $row['qty_verify_checked'];
		$this->qty_verify_info = $row['qty_verify_info'];
        $this->qty_quality_pass = $row['qty_quality_pass'];
        $this->qty_quality_not_pass = $row['qty_quality_not_pass'];
        $this->qty_quality_info = $row['qty_quality_info'];
        $this->assigned_to = $row['assigned_to'];

    }
    
    function update(){

        $query = "UPDATE
                    " . $this->table_name . "
                SET
					client_business_id=:client_business_id,
					customer_business_id=:customer_business_id,
                    job_card_status_id=:job_card_status_id,
                    client_invoice_number=:client_invoice_number,
                    skip_artwork=:skip_artwork,
                    qty_verify_customer=:qty_verify_customer,
					qty_verify_checked=:qty_verify_checked,
                    qty_verify_info=:qty_verify_info,
                    qty_quality_pass=:qty_quality_pass,
                    qty_quality_not_pass=:qty_quality_not_pass,
                    qty_quality_info=:qty_quality_info,
                    assigned_to=:assigned_to
                WHERE
                    id = :id";
        
        $stmt = $this->conn->prepare($query);

        // posted values
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->client_business_id=htmlspecialchars(strip_tags($this->client_business_id));
		$this->customer_business_id=htmlspecialchars(strip_tags($this->customer_business_id));
        $this->job_card_status_id=htmlspecialchars(strip_tags($this->job_card_status_id));
        $this->client_invoice_number=htmlspecialchars(strip_tags($this->client_invoice_number));
        $this->skip_artwork=htmlspecialchars(strip_tags($this->skip_artwork));
        $this->qty_verify_customer=htmlspecialchars(strip_tags($this->qty_verify_customer));
		$this->qty_verify_checked=htmlspecialchars(strip_tags($this->qty_verify_checked));
		$this->qty_verify_info=htmlspecialchars(strip_tags($this->qty_verify_info));
        $this->qty_quality_pass=htmlspecialchars(strip_tags($this->qty_quality_pass));
        $this->qty_quality_not_pass=htmlspecialchars(strip_tags($this->qty_quality_not_pass));
        $this->qty_quality_info=htmlspecialchars(strip_tags($this->qty_quality_info));
        $this->assigned_to=htmlspecialchars(strip_tags($this->assigned_to));

        // bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":client_business_id", $this->client_business_id);
		$stmt->bindParam(":customer_business_id", $this->customer_business_id);
        $stmt->bindParam(":job_card_status_id", $this->job_card_status_id);
        $stmt->bindParam(":client_invoice_number", $this->client_invoice_number);
        $stmt->bindParam(":skip_artwork", $this->skip_artwork);
        $stmt->bindParam(":qty_verify_customer", $this->qty_verify_customer);
		$stmt->bindParam(":qty_verify_checked", $this->qty_verify_checked);
		$stmt->bindParam(":qty_verify_info", $this->qty_verify_info);
        $stmt->bindParam(":qty_quality_pass", $this->qty_quality_pass);
        $stmt->bindParam(":qty_quality_not_pass", $this->qty_quality_not_pass);
        $stmt->bindParam(":qty_quality_info", $this->qty_quality_info);
        $stmt->bindParam(":assigned_to", $this->assigned_to);

        // execute the query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    function updateStatus(){

        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    job_card_status_id=:job_card_status_id
                WHERE
                    id = :id";
        
        $stmt = $this->conn->prepare($query);

        // posted values
		$this->id=htmlspecialchars(strip_tags($this->id));
        $this->job_card_status_id=htmlspecialchars(strip_tags($this->job_card_status_id));

        // bind values
		$stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":job_card_status_id", $this->job_card_status_id);

        // execute the query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    function verifyQuantity(){

        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    job_card_status_id=:job_card_status_id,
                    qty_verify_customer=:qty_verify_customer,
					qty_verify_checked=:qty_verify_checked,
                    qty_verify_info=:qty_verify_info
                WHERE
                    id = :id";
        
        $stmt = $this->conn->prepare($query);

        // posted values
		$this->id=htmlspecialchars(strip_tags($this->id));
        $this->job_card_status_id=htmlspecialchars(strip_tags($this->job_card_status_id));
        $this->qty_verify_customer=htmlspecialchars(strip_tags($this->qty_verify_customer));
		$this->qty_verify_checked=htmlspecialchars(strip_tags($this->qty_verify_checked));
		$this->qty_verify_info=htmlspecialchars(strip_tags($this->qty_verify_info));

        // bind values
		$stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":job_card_status_id", $this->job_card_status_id);
        $stmt->bindParam(":qty_verify_customer", $this->qty_verify_customer);
		$stmt->bindParam(":qty_verify_checked", $this->qty_verify_checked);
		$stmt->bindParam(":qty_verify_info", $this->qty_verify_info);

        // execute the query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    function verifyQuality(){

        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    job_card_status_id=:job_card_status_id,
                    qty_quality_pass=:qty_quality_pass,
                    qty_quality_not_pass=:qty_quality_not_pass,
                    qty_quality_info=:qty_quality_info
                WHERE
                    id = :id";
        
        $stmt = $this->conn->prepare($query);

        // posted values
		$this->id=htmlspecialchars(strip_tags($this->id));
        $this->job_card_status_id=htmlspecialchars(strip_tags($this->job_card_status_id));
        $this->qty_quality_pass=htmlspecialchars(strip_tags($this->qty_quality_pass));
        $this->qty_quality_not_pass=htmlspecialchars(strip_tags($this->qty_quality_not_pass));
        $this->qty_quality_info=htmlspecialchars(strip_tags($this->qty_quality_info));

        // bind values
		$stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":job_card_status_id", $this->job_card_status_id);
        $stmt->bindParam(":qty_quality_pass", $this->qty_quality_pass);
        $stmt->bindParam(":qty_quality_not_pass", $this->qty_quality_not_pass);
        $stmt->bindParam(":qty_quality_info", $this->qty_quality_info);

        // execute the query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    function assignUser(){

        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    job_card_status_id=:job_card_status_id,
                    assigned_to=:assigned_to
                WHERE
                    id = :id";
        
        $stmt = $this->conn->prepare($query);

        // posted values
		$this->id=htmlspecialchars(strip_tags($this->id));
        $this->job_card_status_id=htmlspecialchars(strip_tags($this->job_card_status_id));
        $this->assigned_to=htmlspecialchars(strip_tags($this->assigned_to));

        // bind values
		$stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":job_card_status_id", $this->job_card_status_id);
        $stmt->bindParam(":assigned_to", $this->assigned_to);

        // execute the query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    // delete the business
    function delete(){

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
    
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // read business by search term
    public function search($search_term, $from_record_num, $records_per_page){

        // select query
            $query = "SELECT
                *
            FROM
                " . $this->table_name . " j
            LEFT JOIN 
                Business b
            ON
                j.client_business_id = b.id
            LEFT JOIN
                Status s
            ON
                s.id = j.job_card_status_id
            WHERE
                j.client_business_id LIKE ? OR j.id LIKE ? 
            ORDER BY
                j.client_business_id ASC
            LIMIT
                ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind variable values - should match where clause in sql
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
        $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;    
    }
    
    public function countAll_BySearch($search_term){

        // select query
        $query = "SELECT
            COUNT(*) as total_rows
        FROM
            " . $this->table_name . "
        WHERE
            id LIKE ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }    

    // used by select drop-down list
    function read(){
        // select all data
        $query = "SELECT
                    *
                FROM 
                    " . $this->table_name . "
                ORDER BY
                    client_business_id";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

    // used to read user name by its ID
    function readName(){

        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['client_business_id'];
    }

    // get current auto_increment index
    function getIndex(){

        $query = "SELECT id FROM " . $this->table_name . " ORDER BY id DESC LIMIT 1;";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['id'];
    }
}