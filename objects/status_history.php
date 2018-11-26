<?php
class status_history{
  
    // databse connection and table name
    private $conn;
    private $table_name = 'Status_History';

    // status_history properties 
		public $id;
		public $fk_table;
		public $fk_field;
		public $fk_field_pk;
		public $title;
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
					id=:id,
					fk_table=:fk_table,
					fk_field=:fk_field,
					fk_field_pk=:fk_field_pk,
					title=:title
                    ";

        $stmt = $this->conn->prepare($query);

        // posted values
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->fk_table=htmlspecialchars(strip_tags($this->fk_table));
		$this->fk_field=htmlspecialchars(strip_tags($this->fk_field));
		$this->fk_field_pk=htmlspecialchars(strip_tags($this->fk_field_pk));
		$this->title=htmlspecialchars(strip_tags($this->title));

        // bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":fk_table", $this->fk_table);
		$stmt->bindParam(":fk_field", $this->fk_field);
		$stmt->bindParam(":fk_field_pk", $this->fk_field_pk);
		$stmt->bindParam(":title", $this->title);

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
                    title ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
     
        $stmt = $this->conn->prepare( $query );
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
		$this->fk_table = $row['fk_table'];
		$this->fk_field = $row['fk_field'];
		$this->fk_field_pk = $row['fk_field_pk'];
		$this->title = $row['title'];
		$this->created_date = $row['created_date'];
		$this->created_by = $row['created_by'];
		$this->modified_date = $row['modified_date'];
		$this->modified_by = $row['modified_by'];
		$this->row_source = $row['row_source'];

    }

    function readOneForJobCard($job_card){
 
        $query = "SELECT 
                        sh.fk_field, sh.title, i.invoice_number, i.job_card_id, u.first_name, u.last_name, sh.created_date 
                    FROM 
                        Status_History sh 
                    LEFT JOIN 
                        Invoice i 
                            ON 
                                sh.fk_field_pk = i.job_card_id
                    LEFT JOIN 
                        User u
                            ON 
                                sh.created_by = u.id
                    WHERE 
                        sh.fk_field = 'job_card_status_id'
                    AND 
                        i.job_card_id = ?;";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $job_card);
        $stmt->execute();
     
        return $stmt;
    }
    
    function update(){

        $query = "UPDATE
                    " . $this->table_name . "
                SET
					id=:id,
					fk_table=:fk_table,
					fk_field=:fk_field,
					fk_field_pk=:fk_field_pk,
					title=:title
                WHERE
                    id = :id";
        
        $stmt = $this->conn->prepare($query);

        // posted values
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->fk_table=htmlspecialchars(strip_tags($this->fk_table));
		$this->fk_field=htmlspecialchars(strip_tags($this->fk_field));
		$this->fk_field_pk=htmlspecialchars(strip_tags($this->fk_field_pk));
		$this->title=htmlspecialchars(strip_tags($this->title));

        // bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":fk_table", $this->fk_table);
		$stmt->bindParam(":fk_field", $this->fk_field);
		$stmt->bindParam(":fk_field_pk", $this->fk_field_pk);
		$stmt->bindParam(":title", $this->title);

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
                title LIKE ? OR fk_field LIKE ? 
            ORDER BY
                title ASC
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
            title LIKE ?";

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
                    title";
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

        $this->name = $row['title'];
    }

    // tracks the status of a job card for reporting purposes
    function trackJobCardStatus($job_card_id){
        $query = "INSERT INTO 
                    " . $this->table_name . " (fk_table, fk_field, fk_field_pk, title)
                SELECT 
                    'Job_Card', 'job_card_status_id', Job_Card.id, Status.title
                FROM 
                    (Job_Card 
                LEFT JOIN 
                    Status 
                        ON Job_Card.job_card_status_id = Status.id)
                WHERE Job_Card.id = ?;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $job_card_id);

        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function trackInvoiceStatus($invoice_id){
        $query = "INSERT INTO 
                    " . $this->table_name . " (fk_table, fk_field, fk_field_pk, title, created_by)
                SELECT 
                    'Invoice', 'invoice_status_id', Invoice.id, Status.title, ?
                FROM 
                    (Invoice 
                LEFT JOIN 
                    Status 
                        ON Invoice.invoice_status_id = Status.id)
                WHERE Invoice.id = ?;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $_SESSION['user_id']);
        $stmt->bindParam(2, $invoice_id);

        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}