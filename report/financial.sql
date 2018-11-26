-- Retrieve all receipts for a business
SELECT 
    r.client_business_id, b.name, r.amount_receipted, r.date_receipted 
FROM 
    Receipt r 
LEFT JOIN 
    Business b
ON 
    r.client_business_id = b.id
WHERE 
    b.id = ?;

-- Retrieve all invoices for a business
SELECT 
    j.client_business_id, b.name, i.total_invoiced, i.date_issued 
FROM 
    Invoice i 
LEFT JOIN 
    Job_Card j 
ON 
    j.id = i.job_card_id
LEFT JOIN 
    Business b 
ON
    j.client_business_id = b.id;
WHERE 
    b.id = ?;

-- Retrieve all invoices & receipts for a business
DROP PROCEDURE IF EXISTS sp_Calculate_Account_Balance;

DELIMITER $$
CREATE PROCEDURE `sp_Calculate_Account_Balance`(IN business_id INT)
BEGIN
    
	SELECT SUM(amount) AS balance
	FROM (

	(SELECT 
		r.client_business_id, b.name, (-1 * r.amount_receipted) AS amount, r.date_receipted AS date 
	FROM 
		Receipt r 
	LEFT JOIN 
		Business b
	ON 
		r.client_business_id = b.id
	WHERE 
		b.id = business_id) 

	UNION

	(SELECT 
		j.client_business_id, b.name, i.total_invoiced, i.date_issued 
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
		b.id = business_id)) t1;
    
END$$
DELIMITER ;

-- Retrieve all receipts for all businesses
SELECT 
    r.client_business_id, b.name, r.amount_receipted, r.date_receipted 
FROM 
    Receipt r 
LEFT JOIN 
    Business b
ON 
    r.client_business_id = b.id

-- Retrieve all invoices for all businesses
SELECT 
    j.client_business_id, b.name, i.total_invoiced, i.date_issued 
FROM 
    Invoice i 
LEFT JOIN 
    Job_Card j 
ON 
    j.id = i.job_card_id
LEFT JOIN 
    Business b 
ON
    j.client_business_id = b.id;

-- Retrieve all invoices & receipts for all businesses
SELECT 
    r.client_business_id, b.name, (-1 * r.amount_receipted) AS amount, r.date_receipted AS date 
FROM 
    Receipt r 
LEFT JOIN 
    Business b
ON 
    r.client_business_id = b.id

UNION

SELECT 
    j.client_business_id, b.name, i.total_invoiced, i.date_issued 
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


1 DAY
SELECT * FROM table_name WHERE created_date <= (NOW() - INTERVAL 1 DAY)

1 MONTH
SELECT * FROM table_name WHERE created_date <= (NOW() - INTERVAL 1 MONTH)

1 WEEK
SELECT * FROM table_name WHERE created_date <= (NOW() - INTERVAL 1 WEEK)

1 QUARTER
SELECT * FROM table_name WHERE created_date <= (NOW() - INTERVAL 1 QUARTER)

1 YEAR
SELECT * FROM table_name WHERE created_date <= (NOW() - INTERVAL 1 YEAR)

PRESENT Month
SELECT * FROM `dt_table` WHERE  date between  DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE()

PRESENT Year
SELECT * FROM `dt_table` WHERE  date between  DATE_FORMAT(CURDATE() ,'%Y-01-01') AND CURDATE()

Financial Year Start ???
SELECT * FROM `dt_table` WHERE  date between  DATE_FORMAT(CURDATE() ,'%Y-03-01') AND CURDATE()

-- https://www.plus2net.com/sql_tutorial/date-lastweek.php
