<?php
class user{
  
    // databse connection and table name
    private $conn;
    private $table_name = 'User';

    // user properties 
        public $id;
        public $first_name;
        public $last_name;
        public $contact_email;
		public $contact_number;
        public $address;
        public $password;
        public $access_level;
        public $access_code;
        public $status;

        public $name;	
		public $contact_number_2;
		public $adr_home_town;
		public $login_username;
		public $login_password;
		public $social_facebook_id;
		public $social_instagram_id;
		public $social_twitter_id;
		public $social_youtube_id;
		public $adr_line_0;
		public $adr_line_1;
		public $adr_line_2;
		public $adr_line_3;
		public $adr_code;
		public $province_id;
		public $permission_super_admin = 0;
		public $permission_admin = 0;
		public $permission_user = 0;
		public $image;
		public $permission_finance = 0;
		public $department;
		public $created_date;
		public $created_by;
		public $modified_date;
		public $modified_by;
		public $row_source;

    public function __construct($db){
        $this->conn = $db;
    }

    // check if given email exist in the database
    function emailExists(){

        // query to check if email exists
        $query = "SELECT id, first_name, last_name, access_level, password, status
                FROM " . $this->table_name . "
                WHERE contact_email = ?
                LIMIT 0,1";
    
        // prepare the query
        $stmt = $this->conn->prepare( $query );
    
        // sanitize
        $this->contact_email=htmlspecialchars(strip_tags($this->contact_email));
    
        // bind given email value
        $stmt->bindParam(1, $this->contact_email);
    
        // execute the query
        $stmt->execute();
    
        // get number of rows
        $num = $stmt->rowCount();
    
        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){
    
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // assign values to object properties
            $this->id = $row['id'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->access_level = $row['access_level'];
            $this->password = $row['password'];
            $this->status = $row['status'];
    
            // return true because email exists in the database
            return true;
        }
    
        // return false if email does not exist in the database
        return false;
    }

    // create business 
    function create(){

        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET 
                    first_name=:first_name,
                    last_name=:last_name,
                    contact_email=:contact_email,
                    contact_number=:contact_number,
                    address=:address,
                    password=:password,
                    access_level=:access_level,
                    access_code=:access_code,
                    status=:status,

					name=:name,
					contact_number_2=:contact_number_2,
					adr_home_town=:adr_home_town,
					login_username=:login_username,
					login_password=:login_password,
					social_facebook_id=:social_facebook_id,
					social_instagram_id=:social_instagram_id,
					social_twitter_id=:social_twitter_id,
					social_youtube_id=:social_youtube_id,
					adr_line_0=:adr_line_0,
					adr_line_1=:adr_line_1,
					adr_line_2=:adr_line_2,
					adr_line_3=:adr_line_3,
					adr_code=:adr_code,
					province_id=:province_id,
					permission_super_admin=:permission_super_admin,
					permission_admin=:permission_admin,
					permission_user=:permission_user,
					image=:image,
					permission_finance=:permission_finance,
					department=:department
                    ";

        $stmt = $this->conn->prepare($query);

        // posted values
        $this->first_name=htmlspecialchars(strip_tags($this->first_name));
        $this->last_name=htmlspecialchars(strip_tags($this->last_name));
        $this->contact_email=htmlspecialchars(strip_tags($this->contact_email));
        $this->contact_number=htmlspecialchars(strip_tags($this->contact_number));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->access_level=htmlspecialchars(strip_tags($this->access_level));
        $this->access_code=htmlspecialchars(strip_tags($this->access_code));
        $this->status=htmlspecialchars(strip_tags($this->status));
        
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->contact_number_2=htmlspecialchars(strip_tags($this->contact_number_2));
		$this->adr_home_town=htmlspecialchars(strip_tags($this->adr_home_town));
		$this->login_username=htmlspecialchars(strip_tags($this->login_username));
		$this->login_password=htmlspecialchars(strip_tags($this->login_password));
		$this->social_facebook_id=htmlspecialchars(strip_tags($this->social_facebook_id));
		$this->social_instagram_id=htmlspecialchars(strip_tags($this->social_instagram_id));
		$this->social_twitter_id=htmlspecialchars(strip_tags($this->social_twitter_id));
		$this->social_youtube_id=htmlspecialchars(strip_tags($this->social_youtube_id));
		$this->adr_line_0=htmlspecialchars(strip_tags($this->adr_line_0));
		$this->adr_line_1=htmlspecialchars(strip_tags($this->adr_line_1));
		$this->adr_line_2=htmlspecialchars(strip_tags($this->adr_line_2));
		$this->adr_line_3=htmlspecialchars(strip_tags($this->adr_line_3));
		$this->adr_code=htmlspecialchars(strip_tags($this->adr_code));
		$this->province_id=htmlspecialchars(strip_tags($this->province_id));
		$this->permission_super_admin=htmlspecialchars(strip_tags($this->permission_super_admin));
		$this->permission_admin=htmlspecialchars(strip_tags($this->permission_admin));
		$this->permission_user=htmlspecialchars(strip_tags($this->permission_user));
		$this->image=htmlspecialchars(strip_tags($this->image));
		$this->permission_finance=htmlspecialchars(strip_tags($this->permission_finance));
		$this->department=htmlspecialchars(strip_tags($this->department));

        // bind values
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":contact_email", $this->contact_email);
        $stmt->bindParam(":contact_number", $this->contact_number);
        $stmt->bindParam(":address", $this->address);

        // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);

        $stmt->bindParam(":access_level", $this->access_level);
        $stmt->bindParam(":access_code", $this->access_code);
        $stmt->bindParam(":status", $this->status);

		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":contact_number_2", $this->contact_number_2);
		$stmt->bindParam(":adr_home_town", $this->adr_home_town);
		$stmt->bindParam(":login_username", $this->login_username);
		$stmt->bindParam(":login_password", $this->login_password);
		$stmt->bindParam(":social_facebook_id", $this->social_facebook_id);
		$stmt->bindParam(":social_instagram_id", $this->social_instagram_id);
		$stmt->bindParam(":social_twitter_id", $this->social_twitter_id);
		$stmt->bindParam(":social_youtube_id", $this->social_youtube_id);
		$stmt->bindParam(":adr_line_0", $this->adr_line_0);
		$stmt->bindParam(":adr_line_1", $this->adr_line_1);
		$stmt->bindParam(":adr_line_2", $this->adr_line_2);
		$stmt->bindParam(":adr_line_3", $this->adr_line_3);
		$stmt->bindParam(":adr_code", $this->adr_code);
		$stmt->bindParam(":province_id", $this->province_id);
		$stmt->bindParam(":permission_super_admin", $this->permission_super_admin);
		$stmt->bindParam(":permission_admin", $this->permission_admin);
		$stmt->bindParam(":permission_user", $this->permission_user);
		$stmt->bindParam(":image", $this->image);
		$stmt->bindParam(":permission_finance", $this->permission_finance);
		$stmt->bindParam(":department", $this->department);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }
    
    function readAll($from_record_num, $records_per_page){
 
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    id DESC
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

    // used in email verification feature
    function updateStatusByAccessCode(){

        // update query
        $query = "UPDATE " . $this->table_name . "
                SET status = :status
                WHERE access_code = :access_code";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->access_code=htmlspecialchars(strip_tags($this->access_code));
    
        // bind the values from the form
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':access_code', $this->access_code);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // used in forgot password feature
    function updateAccessCode(){

        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    access_code = :access_code
                WHERE
                    contact_email = :contact_email";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->access_code=htmlspecialchars(strip_tags($this->access_code));
        $this->contact_email=htmlspecialchars(strip_tags($this->contact_email));
    
        // bind the values from the form
        $stmt->bindParam(':access_code', $this->access_code);
        $stmt->bindParam(':contact_email', $this->contact_email);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // check if given access_code exist in the database
    function accessCodeExists(){

        // query to check if access_code exists
        $query = "SELECT id
                FROM " . $this->table_name . "
                WHERE access_code = ?
                LIMIT 0,1";
    
        // prepare the query
        $stmt = $this->conn->prepare( $query );
    
        // sanitize
        $this->access_code=htmlspecialchars(strip_tags($this->access_code));
    
        // bind given access_code value
        $stmt->bindParam(1, $this->access_code);
    
        // execute the query
        $stmt->execute();
    
        // get number of rows
        $num = $stmt->rowCount();
    
        // if access_code exists
        if($num>0){
    
            // return true because access_code exists in the database
            return true;
        }
    
        // return false if access_code does not exist in the database
        return false;
    
    }

    // used in forgot password feature
    function updatePassword(){

        // update query
        $query = "UPDATE " . $this->table_name . "
                SET password = :password
                WHERE access_code = :access_code";
    
        // prepare the query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->access_code=htmlspecialchars(strip_tags($this->access_code));
    
        // bind the values from the form
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':access_code', $this->access_code);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
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

        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->contact_email = $row['contact_email'];
        $this->contact_number = $row['contact_number'];
        $this->address = $row['address'];
        $this->password = $row['password'];
        $this->access_level = $row['access_level'];
        $this->access_code = $row['access_code'];
        $this->status = $row['status'];

        $this->name = $row['name'];
		$this->contact_number_2 = $row['contact_number_2'];
		$this->adr_home_town = $row['adr_home_town'];
		$this->login_username = $row['login_username'];
		$this->login_password = $row['login_password'];
		$this->social_facebook_id = $row['social_facebook_id'];
		$this->social_instagram_id = $row['social_instagram_id'];
		$this->social_twitter_id = $row['social_twitter_id'];
		$this->social_youtube_id = $row['social_youtube_id'];
		$this->adr_line_0 = $row['adr_line_0'];
		$this->adr_line_1 = $row['adr_line_1'];
		$this->adr_line_2 = $row['adr_line_2'];
		$this->adr_line_3 = $row['adr_line_3'];
		$this->adr_code = $row['adr_code'];
		$this->province_id = $row['province_id'];
		$this->permission_super_admin = $row['permission_super_admin'];
		$this->permission_admin = $row['permission_admin'];
		$this->permission_user = $row['permission_user'];
		$this->image = $row['image'];
		$this->permission_finance = $row['permission_finance'];
		$this->department = $row['department'];
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
                    first_name=:first_name,
                    last_name=:last_name,
                    contact_email=:contact_email,
                    contact_number=:contact_number,
                    address=:address,
                    password=:password,
                    access_level=:access_level,
                    access_code=:access_code,
                    status=:status,

					name=:name,
					contact_number_2=:contact_number_2,
					adr_home_town=:adr_home_town,
					login_username=:login_username,
					login_password=:login_password,
					social_facebook_id=:social_facebook_id,
					social_instagram_id=:social_instagram_id,
					social_twitter_id=:social_twitter_id,
					social_youtube_id=:social_youtube_id,
					adr_line_0=:adr_line_0,
					adr_line_1=:adr_line_1,
					adr_line_2=:adr_line_2,
					adr_line_3=:adr_line_3,
					adr_code=:adr_code,
					province_id=:province_id,
					permission_super_admin=:permission_super_admin,
					permission_admin=:permission_admin,
					permission_user=:permission_user,
					image=:image,
					permission_finance=:permission_finance,
					department=:department
                WHERE
                    id = :id";
        
        $stmt = $this->conn->prepare($query);

        // posted values
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->contact_number=htmlspecialchars(strip_tags($this->contact_number));
		$this->contact_email=htmlspecialchars(strip_tags($this->contact_email));
		$this->contact_number_2=htmlspecialchars(strip_tags($this->contact_number_2));
		$this->adr_home_town=htmlspecialchars(strip_tags($this->adr_home_town));
		$this->login_username=htmlspecialchars(strip_tags($this->login_username));
		$this->login_password=htmlspecialchars(strip_tags($this->login_password));
		$this->social_facebook_id=htmlspecialchars(strip_tags($this->social_facebook_id));
		$this->social_instagram_id=htmlspecialchars(strip_tags($this->social_instagram_id));
		$this->social_twitter_id=htmlspecialchars(strip_tags($this->social_twitter_id));
		$this->social_youtube_id=htmlspecialchars(strip_tags($this->social_youtube_id));
		$this->adr_line_0=htmlspecialchars(strip_tags($this->adr_line_0));
		$this->adr_line_1=htmlspecialchars(strip_tags($this->adr_line_1));
		$this->adr_line_2=htmlspecialchars(strip_tags($this->adr_line_2));
		$this->adr_line_3=htmlspecialchars(strip_tags($this->adr_line_3));
		$this->adr_code=htmlspecialchars(strip_tags($this->adr_code));
		$this->province_id=htmlspecialchars(strip_tags($this->province_id));
		$this->permission_super_admin=htmlspecialchars(strip_tags($this->permission_super_admin));
		$this->permission_admin=htmlspecialchars(strip_tags($this->permission_admin));
		$this->permission_user=htmlspecialchars(strip_tags($this->permission_user));
		$this->image=htmlspecialchars(strip_tags($this->image));
		$this->permission_finance=htmlspecialchars(strip_tags($this->permission_finance));
		$this->department=htmlspecialchars(strip_tags($this->department));

        // bind values
        $stmt->bindParam(":id", $this->id);
        
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":contact_email", $this->contact_email);
        $stmt->bindParam(":contact_number", $this->contact_number);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":access_level", $this->access_level);
        $stmt->bindParam(":access_code", $this->access_code);
        $stmt->bindParam(":status", $this->status);

		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":contact_number_2", $this->contact_number_2);
		$stmt->bindParam(":adr_home_town", $this->adr_home_town);
		$stmt->bindParam(":login_username", $this->login_username);
		$stmt->bindParam(":login_password", $this->login_password);
		$stmt->bindParam(":social_facebook_id", $this->social_facebook_id);
		$stmt->bindParam(":social_instagram_id", $this->social_instagram_id);
		$stmt->bindParam(":social_twitter_id", $this->social_twitter_id);
		$stmt->bindParam(":social_youtube_id", $this->social_youtube_id);
		$stmt->bindParam(":adr_line_0", $this->adr_line_0);
		$stmt->bindParam(":adr_line_1", $this->adr_line_1);
		$stmt->bindParam(":adr_line_2", $this->adr_line_2);
		$stmt->bindParam(":adr_line_3", $this->adr_line_3);
		$stmt->bindParam(":adr_code", $this->adr_code);
		$stmt->bindParam(":province_id", $this->province_id);
		$stmt->bindParam(":permission_super_admin", $this->permission_super_admin);
		$stmt->bindParam(":permission_admin", $this->permission_admin);
		$stmt->bindParam(":permission_user", $this->permission_user);
		$stmt->bindParam(":image", $this->image);
		$stmt->bindParam(":permission_finance", $this->permission_finance);
		$stmt->bindParam(":department", $this->department);

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
                name LIKE ? OR login_username LIKE ? 
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

    // used to read user name by its ID

    function readName(){

        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
    }
}