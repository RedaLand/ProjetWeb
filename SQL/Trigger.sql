DELIMITER //
DROP TRIGGER IF EXISTS `Trigger_Suppr_Patient`//
CREATE TRIGGER `Trigger_Suppr_Patient` BEFORE DELETE ON `patients`
 FOR EACH ROW BEGIN
 	DELETE FROM ordonnances WHERE Numero_Piece_ID = old.Numero_Piece_ID;
 	DELETE FROM antecedants WHERE ID_Patient = old.Numero_Piece_ID;
 END; //
DELIMITER ;


DELIMITER //
DROP TRIGGER IF EXISTS `Trigger_Ordonnance`//
CREATE TRIGGER `Trigger_Ordonnance` BEFORE INSERT ON `ordonnances` FOR EACH ROW 
BEGIN 
    IF (NEW.Remarque_Ordonnance IS NOT NULL) THEN
    	SET NEW.LienPhoto = 'NULL';
    ELSE
    	SET NEW.Remarque_Ordonnance = 'NULL';
    END IF
END //
DELIMITER ;