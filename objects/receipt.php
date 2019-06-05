<?php
class receipt{
  
    // databse connection and table name
    private $conn;
    private $table_name = 'Receipt';

    // receipt properties 
		public $id;
		public $client_business_id;
		public $date_receipted;
		public $amount_receipted;
		public $payment_method_id;
		public $payment_reference;
		public $created_date;
		public $created_by;
		public $modified_date;
		public $modified_by;
		public $row_source;

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
					date_receipted=:date_receipted,
					amount_receipted=:amount_receipted,
					payment_method_id=:payment_method_id,
					payment_reference=:payment_reference
                    ";

        $stmt = $this->conn->prepare($query);

        // posted values
		$this->client_business_id=htmlspecialchars(strip_tags($this->client_business_id));
		$this->date_receipted=htmlspecialchars(strip_tags($this->date_receipted));
		$this->amount_receipted=htmlspecialchars(strip_tags($this->amount_receipted));
		$this->payment_method_id=htmlspecialchars(strip_tags($this->payment_method_id));
		$this->payment_reference=htmlspecialchars(strip_tags($this->payment_reference));

        // bind values
		$stmt->bindParam(":client_business_id", $this->client_business_id);
		$stmt->bindParam(":date_receipted", $this->date_receipted);
		$stmt->bindParam(":amount_receipted", $this->amount_receipted);
		$stmt->bindParam(":payment_method_id", $this->payment_method_id);
		$stmt->bindParam(":payment_reference", $this->payment_reference);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }
    
    function readAll($from_record_num, $records_per_page){
 
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    payment_reference ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        return $stmt;
    }

    function readAllForBusiness($business_id){
 
        $query = "SELECT
                    r.id, b.name, r.amount_receipted, payment_reference
                FROM
                    " . $this->table_name . " r
                LEFT JOIN
                    Business b
                        ON r.client_business_id = b.id
                WHERE
                    b.id = ?
                ORDER BY
                    r.id ASC";
     
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
		$this->date_receipted = $row['date_receipted'];
		$this->amount_receipted = $row['amount_receipted'];
		$this->payment_method_id = $row['payment_method_id'];
		$this->payment_reference = $row['payment_reference'];
		$this->created_date = $row['created_date'];
		$this->created_by = $row['created_by'];
		$this->modified_date = $row['modified_date'];
		$this->modified_by = $row['modified_by'];
		$this->row_source = $row['row_source'];

    }
    
    function update(){

        $query = "UPDATE
                    " . $this->table_name . "
                SET
					client_business_id=:client_business_id,
					date_receipted=:date_receipted,
					amount_receipted=:amount_receipted,
					payment_method_id=:payment_method_id,
					payment_reference=:payment_reference
                WHERE
                    id = :id";
        
        $stmt = $this->conn->prepare($query);

        // posted values
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->client_business_id=htmlspecialchars(strip_tags($this->client_business_id));
		$this->date_receipted=htmlspecialchars(strip_tags($this->date_receipted));
		$this->amount_receipted=htmlspecialchars(strip_tags($this->amount_receipted));
		$this->payment_method_id=htmlspecialchars(strip_tags($this->payment_method_id));
		$this->payment_reference=htmlspecialchars(strip_tags($this->payment_reference));

        // bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":client_business_id", $this->client_business_id);
		$stmt->bindParam(":date_receipted", $this->date_receipted);
		$stmt->bindParam(":amount_receipted", $this->amount_receipted);
		$stmt->bindParam(":payment_method_id", $this->payment_method_id);
		$stmt->bindParam(":payment_reference", $this->payment_reference);

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
                " . $this->table_name . " 
            WHERE
                payment_reference LIKE ? OR client_business_id LIKE ? 
            ORDER BY
                payment_reference ASC
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
            payment_reference LIKE ?";

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
                    payment_reference";
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

        $this->name = $row['payment_reference'];
    }
}