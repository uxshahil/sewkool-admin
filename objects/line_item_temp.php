<?php
class line_item_temp{
  
    // databse connection and table name
    private $conn;
    private $table_name = 'Line_Item_Temp';

    // line_item_temp properties 
        public $id;
        public $job_card_id;
        public $item;
        public $item_qty;
        public $item_qty_verified;
        public $item_qty_info;
        public $artwork_logo;
        public $artwork_position;
        public $artwork_color;
        public $other_info;
        public $price_artwork;
        public $price_setup;
        public $price_embroidery;
        public $fulfilled;
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
					job_card_id=:job_card_id,
					item=:item,
					item_qty=:item_qty,
					item_qty_verified=:item_qty_verified,
					item_qty_info=:item_qty_info,
					artwork_logo=:artwork_logo,
					artwork_position=:artwork_position,
					artwork_color=:artwork_color,
					other_info=:other_info,
					price_artwork=:price_artwork,
                    price_setup=:price_setup,
                    price_embroidery=:price_embroidery,
					fulfilled=:fulfilled
                    ";

        $stmt = $this->conn->prepare($query);

        // posted values
		$this->job_card_id=htmlspecialchars(strip_tags($this->job_card_id));
		$this->item=htmlspecialchars(strip_tags($this->item));
		$this->item_qty=htmlspecialchars(strip_tags($this->item_qty));
		$this->item_qty_verified=htmlspecialchars(strip_tags($this->item_qty_verified));
		$this->item_qty_info=htmlspecialchars(strip_tags($this->item_qty_info));
		$this->artwork_logo=htmlspecialchars(strip_tags($this->artwork_logo));
		$this->artwork_position=htmlspecialchars(strip_tags($this->artwork_position));
		$this->artwork_color=htmlspecialchars(strip_tags($this->artwork_color));
		$this->other_info=htmlspecialchars(strip_tags($this->other_info));
		$this->price_artwork=htmlspecialchars(strip_tags($this->price_artwork));
        $this->price_setup=htmlspecialchars(strip_tags($this->price_setup));
        $this->price_embroidery=htmlspecialchars(strip_tags($this->price_embroidery));
		$this->fulfilled=htmlspecialchars(strip_tags($this->fulfilled));

        // bind values
		$stmt->bindParam(":job_card_id", $this->job_card_id);
		$stmt->bindParam(":item", $this->item);
		$stmt->bindParam(":item_qty", $this->item_qty);
		$stmt->bindParam(":item_qty_verified", $this->item_qty_verified);
		$stmt->bindParam(":item_qty_info", $this->item_qty_info);
		$stmt->bindParam(":artwork_logo", $this->artwork_logo);
		$stmt->bindParam(":artwork_position", $this->artwork_position);
		$stmt->bindParam(":artwork_color", $this->artwork_color);
		$stmt->bindParam(":other_info", $this->other_info);
		$stmt->bindParam(":price_artwork", $this->price_artwork);
        $stmt->bindParam(":price_setup", $this->price_setup);
        $stmt->bindParam(":price_embroidery", $this->price_embroidery);
		$stmt->bindParam(":fulfilled", $this->fulfilled);

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
                    item ASC
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

		$this->job_card_id = $row['job_card_id'];
		$this->item = $row['item'];
		$this->item_qty = $row['item_qty'];
		$this->item_qty_verified = $row['item_qty_verified'];
		$this->item_qty_info = $row['item_qty_info'];
		$this->artwork_logo = $row['artwork_logo'];
		$this->artwork_position = $row['artwork_position'];
		$this->artwork_color = $row['artwork_color'];
		$this->other_info = $row['other_info'];
		$this->price_artwork = $row['price_artwork'];
        $this->price_setup = $row['price_setup'];
        $this->price_embroidery = $row['price_embroidery'];
		$this->fulfilled = $row['fulfilled'];
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
					job_card_id=:job_card_id,
					item=:item,
					item_qty=:item_qty,
					item_qty_verified=:item_qty_verified,
					item_qty_info=:item_qty_info,
					artwork_logo=:artwork_logo,
					artwork_position=:artwork_position,
					artwork_color=:artwork_color,
					other_info=:other_info,
					price_artwork=:price_artwork,
                    price_setup=:price_setup,
                    price_embroidery=:price_embroidery,
					fulfilled=:fulfilled
                WHERE
                    id = :id";
        
        $stmt = $this->conn->prepare($query);

        // posted values
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->job_card_id=htmlspecialchars(strip_tags($this->job_card_id));
		$this->item=htmlspecialchars(strip_tags($this->item));
		$this->item_qty=htmlspecialchars(strip_tags($this->item_qty));
		$this->item_qty_verified=htmlspecialchars(strip_tags($this->item_qty_verified));
		$this->item_qty_info=htmlspecialchars(strip_tags($this->item_qty_info));
		$this->artwork_logo=htmlspecialchars(strip_tags($this->artwork_logo));
		$this->artwork_position=htmlspecialchars(strip_tags($this->artwork_position));
		$this->artwork_color=htmlspecialchars(strip_tags($this->artwork_color));
		$this->other_info=htmlspecialchars(strip_tags($this->other_info));
		$this->price_artwork=htmlspecialchars(strip_tags($this->price_artwork));
        $this->price_setup=htmlspecialchars(strip_tags($this->price_setup));
        $this->price_embroidery=htmlspecialchars(strip_tags($this->price_embroidery));
		$this->fulfilled=htmlspecialchars(strip_tags($this->fulfilled));

        // bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":job_card_id", $this->job_card_id);
		$stmt->bindParam(":item", $this->item);
		$stmt->bindParam(":item_qty", $this->item_qty);
		$stmt->bindParam(":item_qty_verified", $this->item_qty_verified);
		$stmt->bindParam(":item_qty_info", $this->item_qty_info);
		$stmt->bindParam(":artwork_logo", $this->artwork_logo);
		$stmt->bindParam(":artwork_position", $this->artwork_position);
		$stmt->bindParam(":artwork_color", $this->artwork_color);
		$stmt->bindParam(":other_info", $this->other_info);
		$stmt->bindParam(":price_artwork", $this->price_artwork);
        $stmt->bindParam(":price_setup", $this->price_setup);
        $stmt->bindParam(":price_embroidery", $this->price_embroidery);
		$stmt->bindParam(":fulfilled", $this->fulfilled);

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
                item LIKE ? 
            ORDER BY
                item ASC
            LIMIT
                ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind variable values - should match where clause in sql
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);

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
            item LIKE ?";

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
        if($this->artwork_logo){

            // sha1_file() function is used to make a unique file name
            $target_directory = "../images/";
            $target_file = $target_directory . $this->artwork_logo;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

            // error message is empty
            $file_upload_error_messages="";

            // make sure that file is a real image
            $check = getimagesize($_FILES["artwork_logo"]["tmp_name"]);
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
            if($_FILES['artwork_logo']['size'] > (10240000)){
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
                if(move_uploaded_file($_FILES["artwork_logo"]["tmp_name"], $target_file)){
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
                    item";
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

        $this->name = $row['item'];
    }

    function commitTempData(){
        $query = "INSERT IGNORE INTO Line_Item
        SELECT *
        FROM " . $this->table_name;
        
        $stmt = $this->conn->prepare($query);
    
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function purgeTempData(){
        $query = "DELETE
        FROM " . $this->table_name;
        
        $stmt = $this->conn->prepare($query);
    
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}