DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_check_auto_increment`()
BEGIN

	DECLARE myvar INT;

	SELECT MAX(id) INTO myvar FROM `Line_Item`;

	IF (myvar = 1) THEN 
		CALL sp_set_auto_increment;
	END IF;


	IF EXISTS (SELECT id FROM Line_Item WHERE id = myvar) THEN
		CALL sp_set_auto_increment;
	END IF;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_set_auto_increment`()
BEGIN

SET @max_id = ((SELECT MAX(id) FROM `Line_Item`) + 1);
SET @sql = CONCAT('ALTER TABLE `Line_Item_Temp` AUTO_INCREMENT = ', @max_id);
PREPARE st FROM @sql;
EXECUTE st;

END$$
DELIMITER ;
