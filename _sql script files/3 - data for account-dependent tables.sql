/* populate the contacts table */
INSERT INTO contacts (contactNumber, ctypeID, accountID)
VALUES ('+0Cah3fIc+WaZVN/6y5Hwg==',1 ,1);
INSERT INTO contacts (contactNumber, ctypeID, accountID)
VALUES ('Nh1dPdTb6IUHwaOjFkK+nw==',2 ,1);
INSERT INTO contacts (contactNumber, ctypeID, accountID)
VALUES ('MCJUIc3BMrBVma83b6Z3eg==',2 ,2);
INSERT INTO contacts (contactNumber, ctypeID, accountID)
VALUES ('e5smW2zoSZy5TGnaZ2qb9Q==',2 ,3);
INSERT INTO contacts (contactNumber, ctypeID, accountID)
VALUES ('7BXWq8vkzimCN/vQA++rdw==',5 ,3);

/* populate the addresses table */
INSERT INTO addresses (addressL1, addressL2, addressCity, addressZip, accountID)
VALUES ('5uOM93Pkmel62k2FUWkqSpIsCenaD5G12dTC7veIXhs=', 'n6RHVJVfFATh9PsZjyzW+w==', 'f+HtRZIY1M3H2MroDcmxXw==', '1776', 1);

/* populate the cases table */
INSERT INTO cases (caseTitle, caseDescription, caseStartDate, caseEndDate, caseRemarks, caseStatus, accountID, clientID) 
VALUES ('Theft case against Jean Valjean', '', '2018-03-15', '2018-05-15', '', 'Active', 1, 5);
INSERT INTO cases (caseTitle, caseDescription, caseStartDate, caseEndDate, caseRemarks, caseStatus, accountID, clientID) 
VALUES ('Sample Case 001', '', '2018-02-21', '2018-04-11', '', 'Active', 2, 1);

/* populate the leavecounts table */
/* 
	ltypeID reference: 
	1 - Sick
	2 - Maternity
	3 - Vacation
	4 - Emergency
	5 - Paternity
*/
/* leave count for account: Mark Castillo (ID 1) */
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 1, 1);
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 1, 2);
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 1, 3);
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 1, 4);
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 1, 5);

/* leave count for account: Gian Estera (ID 2) */
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 2, 1);
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 2, 2);
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 2, 3);
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 2, 4);
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 2, 5);

/* leave count for account: Josh Manalo (ID 3) */
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 3, 1);
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 3, 2);
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 3, 3);
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 3, 4);
INSERT INTO leavecounts (lcAmount, accountID, ltypeID)
VALUES (0, 3, 5);