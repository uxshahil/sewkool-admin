<?php
class business{
  
    // databse connection and table name
    private $conn;
    private $table_name = 'Business';

    // business properties 
		public $id;
		public $name;
		public $description;
		public $head_office;
		public $branch_name;
		public $adr_postal;
		public $adr_location;
		public $contact_primary_name;
		public $contact_primary_number;
		public $contact_primary_email;
		public $contact_secondary_name;
		public $contact_secondary_number;
		public $contact_secondary_email;
		public $contact_business_number;
		public $contact_business_email;
		public $contact_business_www;
		public $contact_business_twitter;
		public $contact_business_facebook;
		public $contact_business_instagram;
		public $contact_business_youtube;
		public $created_date;
		public $created_by;
		public $modified_date;
		public $modified_by;
		public $row_source;
		public $image;
		public $vat;
        public $company_registration;
        public $account_status_id;

    public function __construct($db){
        $this->conn = $db;
    }

    // create business 
    function create(){

        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
				SET 
					name=:name,
					description=:description,
					head_office=:head_office,
					branch_name=:branch_name,
					adr_postal=:adr_postal,
					adr_location=:adr_location,
					contact_primary_name=:contact_primary_name,
					contact_primary_number=:contact_primary_number,
					contact_primary_email=:contact_primary_email,
					contact_secondary_name=:contact_secondary_name,
					contact_secondary_number=:contact_secondary_number,
					contact_secondary_email=:contact_secondary_email,
					contact_business_number=:contact_business_number,
					contact_business_email=:contact_business_email,
					contact_business_www=:contact_business_www,
					contact_business_twitter=:contact_business_twitter,
					contact_business_facebook=:contact_business_facebook,
					contact_business_instagram=:contact_business_instagram,
					contact_business_youtube=:contact_business_youtube,
					image=:image,
					vat=:vat,
                    company_registration=:company_registration,
                    account_status_id=:account_status_id
                    ";

        $stmt = $this->conn->prepare($query);

        // posted values
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->head_office=htmlspecialchars(strip_tags($this->head_office));
		$this->branch_name=htmlspecialchars(strip_tags($this->branch_name));
		$this->adr_postal=htmlspecialchars(strip_tags($this->adr_postal));
		$this->adr_location=htmlspecialchars(strip_tags($this->adr_location));
		$this->contact_primary_name=htmlspecialchars(strip_tags($this->contact_primary_name));
		$this->contact_primary_number=htmlspecialchars(strip_tags($this->contact_primary_number));
		$this->contact_primary_email=htmlspecialchars(strip_tags($this->contact_primary_email));
		$this->contact_secondary_name=htmlspecialchars(strip_tags($this->contact_secondary_name));
		$this->contact_secondary_number=htmlspecialchars(strip_tags($this->contact_secondary_number));
		$this->contact_secondary_email=htmlspecialchars(strip_tags($this->contact_secondary_email));
		$this->contact_business_number=htmlspecialchars(strip_tags($this->contact_business_number));
		$this->contact_business_email=htmlspecialchars(strip_tags($this->contact_business_email));
		$this->contact_business_www=htmlspecialchars(strip_tags($this->contact_business_www));
		$this->contact_business_twitter=htmlspecialchars(strip_tags($this->contact_business_twitter));
		$this->contact_business_facebook=htmlspecialchars(strip_tags($this->contact_business_facebook));
		$this->contact_business_instagram=htmlspecialchars(strip_tags($this->contact_business_instagram));
		$this->contact_business_youtube=htmlspecialchars(strip_tags($this->contact_business_youtube));
		$this->image=htmlspecialchars(strip_tags($this->image));
		$this->vat=htmlspecialchars(strip_tags($this->vat));
        $this->company_registration=htmlspecialchars(strip_tags($this->company_registration));
        $this->account_status_id=htmlspecialchars(strip_tags($this->account_status_id));

        // bind values
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":head_office", $this->head_office);
		$stmt->bindParam(":branch_name", $this->branch_name);
		$stmt->bindParam(":adr_postal", $this->adr_postal);
		$stmt->bindParam(":adr_location", $this->adr_location);
		$stmt->bindParam(":contact_primary_name", $this->contact_primary_name);
		$stmt->bindParam(":contact_primary_number", $this->contact_primary_number);
		$stmt->bindParam(":contact_primary_email", $this->contact_primary_email);
		$stmt->bindParam(":contact_secondary_name", $this->contact_secondary_name);
		$stmt->bindParam(":contact_secondary_number", $this->contact_secondary_number);
		$stmt->bindParam(":contact_secondary_email", $this->contact_secondary_email);
		$stmt->bindParam(":contact_business_number", $this->contact_business_number);
		$stmt->bindParam(":contact_business_email", $this->contact_business_email);
		$stmt->bindParam(":contact_business_www", $this->contact_business_www);
		$stmt->bindParam(":contact_business_twitter", $this->contact_business_twitter);
		$stmt->bindParam(":contact_business_facebook", $this->contact_business_facebook);
		$stmt->bindParam(":contact_business_instagram", $this->contact_business_instagram);
		$stmt->bindParam(":contact_business_youtube", $this->contact_business_youtube);
		$stmt->bindParam(":image", $this->image);
		$stmt->bindParam(":vat", $this->vat);
        $stmt->bindParam(":company_registration", $this->company_registration);
        $stmt->bindParam(":account_status_id", $this->account_status_id);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }
    
    function readAll($from_record_num, $records_per_page){
 
        $query = "SELECT
                    b.id, b.name, b.description, s.title
                FROM
                    " . $this->table_name . " b
                LEFT JOIN
                    Status s
                        ON b.account_status_id = s.id
                ORDER BY
                    name ASC
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
		$this->name = $row['name'];
		$this->description = $row['description'];
		$this->head_office = $row['head_office'];
		$this->branch_name = $row['branch_name'];
		$this->adr_postal = $row['adr_postal'];
		$this->adr_location = $row['adr_location'];
		$this->contact_primary_name = $row['contact_primary_name'];
		$this->contact_primary_number = $row['contact_primary_number'];
		$this->contact_primary_email = $row['contact_primary_email'];
		$this->contact_secondary_name = $row['contact_secondary_name'];
		$this->contact_secondary_number = $row['contact_secondary_number'];
		$this->contact_secondary_email = $row['contact_secondary_email'];
		$this->contact_business_number = $row['contact_business_number'];
		$this->contact_business_email = $row['contact_business_email'];
		$this->contact_business_www = $row['contact_business_www'];
		$this->contact_business_twitter = $row['contact_business_twitter'];
		$this->contact_business_facebook = $row['contact_business_facebook'];
		$this->contact_business_instagram = $row['contact_business_instagram'];
		$this->contact_business_youtube = $row['contact_business_youtube'];
		$this->created_date = $row['created_date'];
		$this->created_by = $row['created_by'];
		$this->modified_date = $row['modified_date'];
		$this->modified_by = $row['modified_by'];
		$this->row_source = $row['row_source'];
		$this->image = $row['image'];
		$this->vat = $row['vat'];
        $this->company_registration = $row['company_registration'];
        $this->account_status_id = $row['account_status_id'];

    }

    function readOneForJobCard($job_card){
 
        $query = "SELECT
                    b.name, s.title, b.id, b.description, s.title
                FROM
                    " . $this->table_name . " b
                LEFT JOIN 
                    Status s
                        ON b.account_status_id = s.id
                LEFT JOIN 
                    Job_Card j
                        ON j.client_business_id = b.id
                WHERE
                    j.id = ?";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $job_card);
        $stmt->execute();
     
        return $stmt;
    }

    function readOneForReceipt($receipt){
 
        $query = "SELECT
                    b.name, s.title, b.id, b.description, s.title
                FROM
                    " . $this->table_name . " b
                LEFT JOIN 
                    Status s
                        ON b.account_status_id = s.id
                LEFT JOIN 
                    Receipt r
                        ON r.client_business_id = b.id
                WHERE
                    r.id = ?";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $receipt);
        $stmt->execute();
     
        return $stmt;
    }
    
    function update(){

        $query = "UPDATE
                    " . $this->table_name . "
                SET
					name=:name,
					description=:description,
					head_office=:head_office,
					branch_name=:branch_name,
					adr_postal=:adr_postal,
					adr_location=:adr_location,
					contact_primary_name=:contact_primary_name,
					contact_primary_number=:contact_primary_number,
					contact_primary_email=:contact_primary_email,
					contact_secondary_name=:contact_secondary_name,
					contact_secondary_number=:contact_secondary_number,
					contact_secondary_email=:contact_secondary_email,
					contact_business_number=:contact_business_number,
					contact_business_email=:contact_business_email,
					contact_business_www=:contact_business_www,
					contact_business_twitter=:contact_business_twitter,
					contact_business_facebook=:contact_business_facebook,
					contact_business_instagram=:contact_business_instagram,
					contact_business_youtube=:contact_business_youtube,
					vat=:vat,
                    company_registration=:company_registration,
                    account_status_id=:account_status_id
                WHERE
                    id = :id";
        
        $stmt = $this->conn->prepare($query);

        // posted values
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->head_office=htmlspecialchars(strip_tags($this->head_office));
		$this->branch_name=htmlspecialchars(strip_tags($this->branch_name));
		$this->adr_postal=htmlspecialchars(strip_tags($this->adr_postal));
		$this->adr_location=htmlspecialchars(strip_tags($this->adr_location));
		$this->contact_primary_name=htmlspecialchars(strip_tags($this->contact_primary_name));
		$this->contact_primary_number=htmlspecialchars(strip_tags($this->contact_primary_number));
		$this->contact_primary_email=htmlspecialchars(strip_tags($this->contact_primary_email));
		$this->contact_secondary_name=htmlspecialchars(strip_tags($this->contact_secondary_name));
		$this->contact_secondary_number=htmlspecialchars(strip_tags($this->contact_secondary_number));
		$this->contact_secondary_email=htmlspecialchars(strip_tags($this->contact_secondary_email));
		$this->contact_business_number=htmlspecialchars(strip_tags($this->contact_business_number));
		$this->contact_business_email=htmlspecialchars(strip_tags($this->contact_business_email));
		$this->contact_business_www=htmlspecialchars(strip_tags($this->contact_business_www));
		$this->contact_business_twitter=htmlspecialchars(strip_tags($this->contact_business_twitter));
		$this->contact_business_facebook=htmlspecialchars(strip_tags($this->contact_business_facebook));
		$this->contact_business_instagram=htmlspecialchars(strip_tags($this->contact_business_instagram));
		$this->contact_business_youtube=htmlspecialchars(strip_tags($this->contact_business_youtube));
		$this->vat=htmlspecialchars(strip_tags($this->vat));
        $this->company_registration=htmlspecialchars(strip_tags($this->company_registration));
        $this->account_status_id=htmlspecialchars(strip_tags($this->account_status_id));

        // bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":head_office", $this->head_office);
		$stmt->bindParam(":branch_name", $this->branch_name);
		$stmt->bindParam(":adr_postal", $this->adr_postal);
		$stmt->bindParam(":adr_location", $this->adr_location);
		$stmt->bindParam(":contact_primary_name", $this->contact_primary_name);
		$stmt->bindParam(":contact_primary_number", $this->contact_primary_number);
		$stmt->bindParam(":contact_primary_email", $this->contact_primary_email);
		$stmt->bindParam(":contact_secondary_name", $this->contact_secondary_name);
		$stmt->bindParam(":contact_secondary_number", $this->contact_secondary_number);
		$stmt->bindParam(":contact_secondary_email", $this->contact_secondary_email);
		$stmt->bindParam(":contact_business_number", $this->contact_business_number);
		$stmt->bindParam(":contact_business_email", $this->contact_business_email);
		$stmt->bindParam(":contact_business_www", $this->contact_business_www);
		$stmt->bindParam(":contact_business_twitter", $this->contact_business_twitter);
		$stmt->bindParam(":contact_business_facebook", $this->contact_business_facebook);
		$stmt->bindParam(":contact_business_instagram", $this->contact_business_instagram);
		$stmt->bindParam(":contact_business_youtube", $this->contact_business_youtube);
		$stmt->bindParam(":vat", $this->vat);
        $stmt->bindParam(":company_registration", $this->company_registration);
        $stmt->bindParam(":account_status_id", $this->account_status_id);

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
                name LIKE ? OR description LIKE ? 
            ORDER BY
                name ASC
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
            name LIKE ?";

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
	
	//fk
    // used by select drop-down list
    function read(){
        // select all data
        $query = "SELECT
                    *
                FROM 
                    " . $this->table_name . "
                ORDER BY
                    name";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

    // used to read business name by its ID

    function readName(){

        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
    }
    //

    function accountSummary(){
        
        $query = "
            SELECT 
                r.client_business_id, b.name, (-1 * r.amount_receipted) AS amount, r.date_receipted AS date 
            FROM 
                Receipt r 
            LEFT JOIN 
                Business b
            ON 
                r.client_business_id = b.id
            WHERE 
                b.id = ?
            
            UNION
            
            SELECT 
                j.client_business_id, b.name, i.total_invoiced AS amount, i.date_issued AS date
            FROM 
                Invoice i 
            LEFT JOIN 
                Job_Card j 
            ON 
                j.id = i.job_card_id
            LEFT JOIN 
                Business b 
            ON 
                j.client_business_id = b.id
            WHERE
                b.id = ?
                
            ORDER BY date desc;";
        
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->bindParam(2, $this->id);
        $stmt->execute();

        return $stmt;
    }

    // set account status
    function setAccountStatus(){

        $query = "CALL sp_Set_Account_Status(?);";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
    
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}