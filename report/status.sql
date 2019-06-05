-- Filter job_cards by job_card_status
SELECT 
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
    j.job_card_status_id = 6;

-- Filter job_cards by invoice_status
SELECT 
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
    i.invoice_status_id = s.id
WHERE 
    i.invoice_status_id = 27;
    
-- Filter business by account_status_id
SELECT 
    b.id, s.title 
FROM 
    Business b
LEFT JOIN 
    Status s
ON 
    b.account_status_id = s.id
WHERE
    b.account_status_id = 23;

-- Select all distict job_card_status ids 
    -- [used in status_report]
SELECT 
    DISTINCT s.title
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

-- Select all distict invoice_status ids 
    -- [used in status_report]
SELECT
    DISTINCT s.id
FROM 
    Invoice i
LEFT JOIN 
    Status s
ON 
    i.invoice_status_id = s.id;

-- Select all distict account_status ids 
    -- [used in status_report]
SELECT 
    DISTINCT s.id
FROM 
    Business b
LEFT JOIN 
    Status s
ON 
    b.account_status_id = s.id;

-- <sp_Count_Job_Card_Status
    -- Stored procedure to TOTAL up each job_card_status
    -- [used in sp_Status_Report_Job_Card]
        DELIMITER //
        DROP PROCEDURE IF EXISTS sp_Count_Job_Card_Status //

        CREATE PROCEDURE sp_Count_Job_Card_Status(IN status_id INT)
        BEGIN
            INSERT INTO Temp_Report_Status
            SELECT status_id, s.title, COUNT(s.title) AS total, 'Job_Card' FROM Job_Card j
            LEFT JOIN Status s
            ON j.job_card_status_id = s.id
            WHERE s.id = status_id;
        END //
        DELIMITER ;

        CALL sp_Count_Job_Card_Status(6);

-- sp_Count_Job_Card_Status/>

-- <sp_Count_Invoice_Status
    -- Stored procedure to TOTAL up each invoice_status
    -- [used in sp_Status_Report_Invoice]
    DELIMITER //
    DROP PROCEDURE IF EXISTS sp_Count_Invoice_Status //

    CREATE PROCEDURE sp_Count_Invoice_Status(IN status_id INT)
    BEGIN
        INSERT INTO Temp_Report_Status
        SELECT status_id, s.title, COUNT(s.title) as total, 'Invoice' FROM Invoice i
        LEFT JOIN Status s
        ON i.invoice_status_id = s.id
        WHERE s.id = status_id;
    END //
    DELIMITER ;

    CALL sp_Count_Invoice_Status(27);

-- sp_Count_Invoice_Status/>

-- <sp_Count_Account_Status
    -- Stored procedure to TOTAL up each account_status
    -- [used in sp_Status_Report_Account]
    DELIMITER //
    DROP PROCEDURE IF EXISTS sp_Count_Account_Status //

    CREATE PROCEDURE sp_Count_Account_Status(IN status_id INT)
    BEGIN
        INSERT INTO Temp_Report_Status
        SELECT status_id, s.title, COUNT(s.title) as total, 'Business' FROM Business b
        LEFT JOIN Status s
        ON b.account_status_id = s.id
        WHERE s.id = status_id;
    END //
    DELIMITER ;

    CALL sp_Count_Account_Status(23);
-- <sp_Count_Account_Status/>

-- <sp_Status_Report_Job_Card

    DELIMITER $$

    DROP PROCEDURE IF EXISTS `sp_Status_Report_Job_Card` $$
    CREATE PROCEDURE `sp_Status_Report_Job_Card`() -- 1 input argument; you might need more or fewer
    BEGIN

    -- declare the program variables where we'll hold the values we're sending into the procedure;
    -- declare as many of them as there are input arguments to the second procedure,
    -- with appropriate data types.

    DECLARE status_id INT DEFAULT NULL;
    -- DECLARE val2 INT DEFAULT NULL;

    -- we need a boolean variable to tell us when the cursor is out of data

    DECLARE done TINYINT DEFAULT FALSE;

    -- declare a cursor to select the desired columns from the desired source table1
    -- the input argument (which you might or might not need) is used in this example for row selection

    DECLARE cursor1 -- cursor1 is an arbitrary label, an identifier for the cursor

    CURSOR FOR

        SELECT 
            DISTINCT s.id
        FROM 
            Job_Card j
        LEFT JOIN 
            Invoice i 
        ON 
            j.id = i.job_card_id
        LEFT JOIN 
            Status s
        ON 
            j.job_card_status_id = s.id;

    -- this fancy spacing is of course not required; all of this could go on the same line.

    -- a cursor that runs out of data throws an exception; we need to catch this.
    -- when the NOT FOUND condition fires, "done" -- which defaults to FALSE -- will be set to true,
    -- and since this is a CONTINUE handler, execution continues with the next statement.   

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- open the cursor

    OPEN cursor1;

    my_loop: -- loops have to have an arbitrary label; it's used to leave the loop
    LOOP

    -- read the values from the next row that is available in the cursor

    FETCH NEXT FROM cursor1 INTO status_id;

    IF done THEN -- this will be true when we are out of rows to read, so we go to the statement after END LOOP.
        LEAVE my_loop; 
    ELSE -- val1 and val2 will be the next values from c1 and c2 in table t1, 
        -- so now we call the procedure with them for this "row"
        CALL sp_Count_Job_Card_Status(status_id);
        -- maybe do more stuff here
    END IF;
    END LOOP;

    -- execution continues here when LEAVE my_loop is encountered;
    -- you might have more things you want to do here

    -- the cursor is implicitly closed when it goes out of scope, or can be explicitly closed if desired

    CLOSE cursor1;

    END $$

    DELIMITER ;

-- sp_Status_Report_Job_Card/>

-- <sp_Status_Report_Invoice

    DELIMITER $$

    DROP PROCEDURE IF EXISTS `sp_Status_Report_Invoice` $$
    CREATE PROCEDURE `sp_Status_Report_Invoice`() -- 1 input argument; you might need more or fewer
    BEGIN

    -- declare the program variables where we'll hold the values we're sending into the procedure;
    -- declare as many of them as there are input arguments to the second procedure,
    -- with appropriate data types.

    DECLARE status_id INT DEFAULT NULL;
    -- DECLARE val2 INT DEFAULT NULL;

    -- we need a boolean variable to tell us when the cursor is out of data

    DECLARE done TINYINT DEFAULT FALSE;

    -- declare a cursor to select the desired columns from the desired source table1
    -- the input argument (which you might or might not need) is used in this example for row selection

    DECLARE cursor1 -- cursor1 is an arbitrary label, an identifier for the cursor

    CURSOR FOR

        SELECT 
            DISTINCT s.id
        FROM 
            Business b
        LEFT JOIN 
            Status s
        ON 
            b.account_status_id = s.id;

    -- this fancy spacing is of course not required; all of this could go on the same line.

    -- a cursor that runs out of data throws an exception; we need to catch this.
    -- when the NOT FOUND condition fires, "done" -- which defaults to FALSE -- will be set to true,
    -- and since this is a CONTINUE handler, execution continues with the next statement.   

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- open the cursor

    OPEN cursor1;

    my_loop: -- loops have to have an arbitrary label; it's used to leave the loop
    LOOP

    -- read the values from the next row that is available in the cursor

    FETCH NEXT FROM cursor1 INTO status_id;

    IF done THEN -- this will be true when we are out of rows to read, so we go to the statement after END LOOP.
        LEAVE my_loop; 
    ELSE -- val1 and val2 will be the next values from c1 and c2 in table t1, 
        -- so now we call the procedure with them for this "row"
        CALL sp_Count_Invoice_Status(status_id);
        -- maybe do more stuff here
    END IF;
    END LOOP;

    -- execution continues here when LEAVE my_loop is encountered;
    -- you might have more things you want to do here

    -- the cursor is implicitly closed when it goes out of scope, or can be explicitly closed if desired

    CLOSE cursor1;

    END $$

    DELIMITER ;

-- sp_Status_Report_Invoice/>

-- <sp_Status_Report_Account
    DELIMITER $$

    DROP PROCEDURE IF EXISTS `sp_Status_Report_Account` $$
    CREATE PROCEDURE `sp_Status_Report_Account`() -- 1 input argument; you might need more or fewer
    BEGIN

    -- declare the program variables where we'll hold the values we're sending into the procedure;
    -- declare as many of them as there are input arguments to the second procedure,
    -- with appropriate data types.

    DECLARE status_id INT DEFAULT NULL;
    -- DECLARE val2 INT DEFAULT NULL;

    -- we need a boolean variable to tell us when the cursor is out of data

    DECLARE done TINYINT DEFAULT FALSE;

    -- declare a cursor to select the desired columns from the desired source table1
    -- the input argument (which you might or might not need) is used in this example for row selection

    DECLARE cursor1 -- cursor1 is an arbitrary label, an identifier for the cursor

    CURSOR FOR

        SELECT 
            DISTINCT s.id
        FROM 
            Business b
        LEFT JOIN 
            Status s
        ON 
            b.account_status_id = s.id;

    -- this fancy spacing is of course not required; all of this could go on the same line.

    -- a cursor that runs out of data throws an exception; we need to catch this.
    -- when the NOT FOUND condition fires, "done" -- which defaults to FALSE -- will be set to true,
    -- and since this is a CONTINUE handler, execution continues with the next statement.   

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- open the cursor

    OPEN cursor1;

    my_loop: -- loops have to have an arbitrary label; it's used to leave the loop
    LOOP

    -- read the values from the next row that is available in the cursor

    FETCH NEXT FROM cursor1 INTO status_id;

    IF done THEN -- this will be true when we are out of rows to read, so we go to the statement after END LOOP.
        LEAVE my_loop; 
    ELSE -- val1 and val2 will be the next values from c1 and c2 in table t1, 
        -- so now we call the procedure with them for this "row"
        CALL sp_Count_Account_Status(status_id);
        -- maybe do more stuff here
    END IF;
    END LOOP;

    -- execution continues here when LEAVE my_loop is encountered;
    -- you might have more things you want to do here

    -- the cursor is implicitly closed when it goes out of scope, or can be explicitly closed if desired

    CLOSE cursor1;

    END $$

    DELIMITER ;
-- sp_Status_Report_Account/>

-- <sp_Status_Report
    DELIMITER $$

    DROP PROCEDURE IF EXISTS `sp_Status_Report` $$
    CREATE PROCEDURE `sp_Status_Report`(report text) -- 1 input argument; you might need more or fewer

    BEGIN
        DROP TABLE IF EXISTS Temp_Report_Status;
        CREATE TEMPORARY TABLE IF NOT EXISTS Temp_Report_Status (status_id int, title varchar(50), total int, ref_table varchar(50));
        
        IF report = 'Job_Card' THEN CALL sp_Status_Report_Job_Card(); END IF;
        IF report = 'Invoice' THEN CALL sp_Status_Report_Invoice(); END IF;
        IF report = 'Account' THEN CALL sp_Status_Report_Account(); END IF;
        IF report = 'All' THEN CALL sp_Status_Report_Job_Card(); CALL sp_Status_Report_Invoice(); CALL sp_Status_Report_Account(); END IF;
        
    END;
    $$
-- sp_Status_Reprot/>