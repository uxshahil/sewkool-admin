<?php
class invoice{
  
    // databse connection and table name
    private $conn;
    private $table_name = 'Invoice';

    // invoice properties 
		public $id;
		public $invoice_number;
		public $job_card_id;
        public $date_issued;
        public $date_due;
		public $total_invoiced;
		public $invoice_status_id;
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
					invoice_number=:invoice_number,
					job_card_id=:job_card_id,
                    date_due=:date_due,
					total_invoiced=:total_invoiced,
					invoice_status_id=:invoice_status_id
                    ";

        $stmt = $this->conn->prepare($query);

        // posted values
		$this->invoice_number=htmlspecialchars(strip_tags($this->invoice_number));
		$this->job_card_id=htmlspecialchars(strip_tags($this->job_card_id));
        $this->date_due=htmlspecialchars(strip_tags($this->date_due));
		$this->total_invoiced=htmlspecialchars(strip_tags($this->total_invoiced));
		$this->invoice_status_id=htmlspecialchars(strip_tags($this->invoice_status_id));

        // bind values
		$stmt->bindParam(":invoice_number", $this->invoice_number);
		$stmt->bindParam(":job_card_id", $this->job_card_id);
        $stmt->bindParam(":date_due", $this->date_due);
		$stmt->bindParam(":total_invoiced", $this->total_invoiced);
		$stmt->bindParam(":invoice_status_id", $this->invoice_status_id);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    // create business 
    function createJobCardInvoice(){

        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET 
                    invoice_number=:invoice_number,
                    job_card_id=:job_card_id,
                    date_due=:date_due,
                    total_invoiced=:total_invoiced,
                    invoice_status_id=:invoice_status_id
                    ";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->invoice_number=htmlspecialchars(strip_tags($this->invoice_number));
        $this->job_card_id=htmlspecialchars(strip_tags($this->job_card_id));
        $this->date_due=htmlspecialchars(strip_tags($this->date_due));
        $this->total_invoiced=htmlspecialchars(strip_tags($this->total_invoiced));
        $this->invoice_status_id=htmlspecialchars(strip_tags($this->invoice_status_id));

        // bind values
        $stmt->bindParam(":invoice_number", $this->invoice_number);
        $stmt->bindParam(":job_card_id", $this->job_card_id);
        $stmt->bindParam(":date_due", $this->date_due);
        $stmt->bindParam(":total_invoiced", $this->total_invoiced);
        $stmt->bindParam(":invoice_status_id", $this->invoice_status_id);

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
                    invoice_number ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        return $stmt;
    }

    function readAllForBusiness($business_id){
 
        $query = "SELECT
                    i.id AS invoice_id, i.invoice_number, b.name, i.total_invoiced, s.title
                FROM
                    " . $this->table_name . " i
                LEFT JOIN
                    Job_Card j
                        On j.id = i.job_card_id
                LEFT JOIN
                    Business b
                        ON j.client_business_id = b.id
                LEFT JOIN 
                    Status s
                        ON i.invoice_status_id = s.id
                WHERE
                    b.id = ?
                ORDER BY
                    i.invoice_number ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $business_id);
        $stmt->execute();
     
        return $stmt;
    }

    function readAllForJobCard($job_card){
 
        $query = "SELECT
                    i.id AS invoice_id, i.invoice_number, b.name, i.total_invoiced, s.title
                FROM
                    " . $this->table_name . " i
                LEFT JOIN
                    Job_Card j
                        On j.id = i.job_card_id
                LEFT JOIN
                    Business b
                        ON j.client_business_id = b.id
                LEFT JOIN 
                    Status s
                        ON i.invoice_status_id = s.id
                WHERE
                    i.job_card_id = ?
                ORDER BY
                    i.invoice_number ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $job_card);
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
		$this->invoice_number = $row['invoice_number'];
		$this->job_card_id = $row['job_card_id'];
        $this->date_issued = $row['date_issued'];
        $this->date_due = $row['date_due'];
		$this->total_invoiced = $row['total_invoiced'];
		$this->invoice_status_id = $row['invoice_status_id'];
		$this->created_date = $row['created_date'];
		$this->created_by = $row['created_by'];
		$this->modified_date = $row['modified_date'];
		$this->modified_by = $row['modified_by'];
		$this->row_source = $row['row_source'];

    }

    function readJobCardItems(){

        $query = "SELECT *
                FROM
                    " . $this->table_name . "
                WHERE
                    job_card_id = ?
                LIMIT
                    0,1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->job_card_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];
		$this->invoice_number = $row['invoice_number'];
		$this->job_card_id = $row['job_card_id'];
        $this->date_issued = $row['date_issued'];
        $this->date_due = $row['date_due'];
		$this->total_invoiced = $row['total_invoiced'];
		$this->invoice_status_id = $row['invoice_status_id'];

    }
    
    function update(){

        $query = "UPDATE
                    " . $this->table_name . "
                SET
					invoice_number=:invoice_number,
					job_card_id=:job_card_id,
                    date_issued=:date_issued,
                    date_due=:date_due,
					total_invoiced=:total_invoiced,
					invoice_status_id=:invoice_status_id
                WHERE
                    id = :id";
        
        $stmt = $this->conn->prepare($query);

        // posted values
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->invoice_number=htmlspecialchars(strip_tags($this->invoice_number));
		$this->job_card_id=htmlspecialchars(strip_tags($this->job_card_id));
        $this->date_issued=htmlspecialchars(strip_tags($this->date_issued));
        $this->date_due=htmlspecialchars(strip_tags($this->date_due));
		$this->total_invoiced=htmlspecialchars(strip_tags($this->total_invoiced));
		$this->invoice_status_id=htmlspecialchars(strip_tags($this->invoice_status_id));

        // bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":invoice_number", $this->invoice_number);
		$stmt->bindParam(":job_card_id", $this->job_card_id);
        $stmt->bindParam(":date_issued", $this->date_issued);
        $stmt->bindParam(":date_due", $this->date_due);
		$stmt->bindParam(":total_invoiced", $this->total_invoiced);
		$stmt->bindParam(":invoice_status_id", $this->invoice_status_id);

        // execute the query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    /*function updateJobCardID(){

        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    job_card_id=:job_card_id,
                    invoice_number=:invoice_number
                WHERE
                    job_card_id = 999999";
        
        $stmt = $this->conn->prepare($query);

        // posted values
		$this->invoice_number=htmlspecialchars(strip_tags($this->invoice_number));
		$this->job_card_id=htmlspecialchars(strip_tags($this->job_card_id));

        // bind values
		$stmt->bindParam(":invoice_number", $this->invoice_number);
		$stmt->bindParam(":job_card_id", $this->job_card_id);

        // execute the query
        if ($stmt->execute()){
            return true;
        }

        return false;
    }*/

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

    // delete the business
    function deleteJobCard(){

        $query = "DELETE FROM " . $this->table_name . " WHERE job_card_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->job_card_id);
    
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
                invoice_number LIKE ? OR invoice_status_id LIKE ? 
            ORDER BY
                invoice_number ASC
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
            invoice_number LIKE ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }    

    // will upload image file to server
    public function uploadPhoto(){

        $result_message="";

        // now, if image is not empty, try to uplaod the image
        if($this->image){

            // sha1_file() function is used to make a unique file name
            $target_directory = "uploads/";
            $target_file = $target_directory . $this->image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

            // error message is empty
            $file_upload_error_messages="";

            // make sure that file is a real image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check!==false){
                // submitted file is an image
            }else{
                $file_upload_error_messages.="<div>Submitted file is not an image</div>";
            }

            // make sure certain file types are allowed
            $allowed_file_types=array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed</div>";
            }

            // make sure file does not exist
            if(file_exists($target_file)){
                $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
            }

            // make sure submitted file is not too large, can't be larger than 10 MB
            if($_FILES['image']['size'] > (10240000)){
                $file_upload_error_messages.="<div>Image must be less than 10 MB in size.</div>";
            }

            // make sure the 'uploads' folder exists
            // if not, create it
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }

            // if $file_upload_error_messages is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                    // means photo was uploaded
                }else{
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="<div>Unable to upload photo.</div>";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
            }

            // if $file_upload_error_messages is NOT empty
            else{
                // it means there are some errors, so show them to user
                $result_message.="<div class='alert alert-danger'>";
                    $result_message.="{$file_upload_error_messages}";
                    $result_message.="<div>Update the record to upload photo.</div>";
                $result_message.="</div>";
            }

        }

        return $result_message;
    }
    // used by select drop-down list
    function read(){
        // select all data
        $query = "SELECT
                    *
                FROM 
                    " . $this->table_name . "
                ORDER BY
                    invoice_number";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

    // used to read invoice number by its ID
    function readInvoiceNumber(){

        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->invoice_number = $row['invoice_number'];
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