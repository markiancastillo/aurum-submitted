/* populate civil status table */
INSERT INTO civilstatuses (cstatusName, cstatusDescription)
VALUES ('Single', 'Single');
INSERT INTO civilstatuses (cstatusName, cstatusDescription)
VALUES ('Married', 'Married');
INSERT INTO civilstatuses (cstatusName, cstatusDescription)
VALUES ('Widowed', 'Widowed');
INSERT INTO civilstatuses (cstatusName, cstatusDescription)
VALUES ('Divorced', 'Divorced');
INSERT INTO civilstatuses (cstatusName, cstatusDescription)
VALUES ('Separated', 'Separated');
INSERT INTO civilstatuses (cstatusName, cstatusDescription)
VALUES ('Registered Partnership', 'Registered Partnership');

/* populate departments table */
INSERT INTO departments(departmentName)
VALUES ('Administrative');
INSERT INTO departments(departmentName)
VALUES ('Counsel');
INSERT INTO departments(departmentName)
VALUES ('Associate');
INSERT INTO departments(departmentName)
VALUES ('Human Resource and Finance');
INSERT INTO departments(departmentName)
VALUES ('Operations');

/* populate positions table */
INSERT INTO positions (positionName, positionDescription)
VALUES ('Managing Partner', 'To lead the firm towards achieving its goals in order to fulfill their mission and vision.');
INSERT INTO positions (positionName, positionDescription)
VALUES ('Partner', 'Foster an organization that identifies and accepts errors and encourage everyone to continue learning.');
INSERT INTO positions (positionName, positionDescription)
VALUES ('Office Counsel', 'To make sure the firm is abiding by the laws.');
INSERT INTO positions (positionName, positionDescription)
VALUES ('Associate/Paralegal', 'Senior or junior lawyers who work in the firm and perform different services for clients.');
INSERT INTO positions (positionName, positionDescription)
VALUES ('Legal Researcher', 'Tasked to research current events, laws and important cases.');
INSERT INTO positions (positionName, positionDescription)
VALUES ('Executive Assistant', 'Directly communicates with the managing partner, partners and associates regarding relevant matters.');
INSERT INTO positions (positionName, positionDescription)
VALUES ('Liaison Personnel', 'In-charge of building a bridge between different departments in order to have communication and coordination.');
INSERT INTO positions (positionName, positionDescription)
VALUES ('Human Resource Assistant', 'Communicates with different employees regarding problems in the workplace, salary, compensation and benefits.');
INSERT INTO positions (positionName, positionDescription)
VALUES ('Accounting Head', 'Manages the accounting processes of the firm.');
INSERT INTO positions (positionName, positionDescription)
VALUES ('Messenger', 'Attends hearings if there are no associates available, representing lawyers in client meetings and reminding associates of scheduled meetings or hearings.');
INSERT INTO positions (positionName, positionDescription)
VALUES ('Driver', 'Performs logistics-related tasks for the firm and its members.');

/* insert data into accounts table 
   account username: janedoe, password: janedoe */
INSERT INTO accounts (accountUsername, 
					accountPassword, 
					accountPhoto, 
					accountFN, 
					accountMN, 
					accountLN, 
					accountBirthDate, 
					accountSex, 
					accountSSSNo, 
					accountTINNo, 
					accountBIRNo, 
					accountHDMFNo, 
					accountEmail, 
					accountBaseRate, 
					accountStatus, 
					cstatusID, 
					positionID, 
					departmentID)
VALUES ('Gw6jfiwL5tyaOh/N/VpWXw==', 
		'Gw6jfiwL5tyaOh/N/VpWXw==', 
		NULL, 
		'bZrfYnvaJTXiqPNTfltLig==', 
		'n6RHVJVfFATh9PsZjyzW+w==', 
		'wkVqz6VVPjXTTWLlynm7Tg==', 
		'1992-12-12', 
		'F', 
		'lGiG/3IyvuK/WYym+NZrFA==', 
		'q3bslPIczddhbnpZDf9UKg==', 
		'4GlecytGXLYPkJtrrcTTWg==', 
		'0ICLiF9aSUW2DlX/RApdhg==', 
		'px9nTGClteWgy4EbLn59KrbB777C8QIFMSKX05fxBGw=', 
		'75.00','Active',1,1,1);

/* populate contact types table */
INSERT INTO contacttypes (ctypeName) 
VALUES ('Main'); 
INSERT INTO contacttypes (ctypeName) 
VALUES ('Mobile');
INSERT INTO contacttypes (ctypeName) 
VALUES ('Home');
INSERT INTO contacttypes (ctypeName) 
VALUES ('Office');
INSERT INTO contacttypes (ctypeName) 
VALUES ('Fax');