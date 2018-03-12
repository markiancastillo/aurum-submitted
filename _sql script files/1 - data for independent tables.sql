/* populate the allowances table */
INSERT INTO allowances (allowanceMobile, allowanceEcola, allowanceMed) 
VALUES (300.00, 480.00, 450.00);

/* populate the civil status table */
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

/* populate the contact types table */
INSERT INTO contacttypes (ctypeName) VALUES ('Main'); 
INSERT INTO contacttypes (ctypeName) VALUES ('Mobile');
INSERT INTO contacttypes (ctypeName) VALUES ('Home');
INSERT INTO contacttypes (ctypeName) VALUES ('Office');
INSERT INTO contacttypes (ctypeName) VALUES ('Fax');

/* populate the departments table */
INSERT INTO departments(departmentName) VALUES ('Administrative');
INSERT INTO departments(departmentName) VALUES ('Counsel');
INSERT INTO departments(departmentName) VALUES ('Associate');
INSERT INTO departments(departmentName) VALUES ('Human Resource and Finance');
INSERT INTO departments(departmentName) VALUES ('Operations');

/* populate the expensetypes table */
INSERT INTO expensetypes (etypeName) VALUES ('Gasoline');
INSERT INTO expensetypes (etypeName) VALUES ('Postage/Courier');
INSERT INTO expensetypes (etypeName) VALUES ('Transportation');
INSERT INTO expensetypes (etypeName) VALUES ('Food');
INSERT INTO expensetypes (etypeName) VALUES ('Filing Fee');
INSERT INTO expensetypes (etypeName) VALUES ('TSN');
INSERT INTO expensetypes (etypeName) VALUES ('Facilitation');
INSERT INTO expensetypes (etypeName) VALUES ('Others');

/* populate the leavetypes table */

INSERT INTO leavetypes (ltypeName) VALUES ('Sick');
INSERT INTO leavetypes (ltypeName) VALUES ('Maternity');
INSERT INTO leavetypes (ltypeName) VALUES ('Vacation');
INSERT INTO leavetypes (ltypeName) VALUES ('Emergency');
INSERT INTO leavetypes (ltypeName) VALUES ('Paternity');

/* populate the positions table */
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

/* populate the servicetypes table */
INSERT INTO servicetypes (stypeName) VALUES ('General Counseling and Retainer');
INSERT INTO servicetypes (stypeName) VALUES ('Corporate');
INSERT INTO servicetypes (stypeName) VALUES ('Intellectual Property');
INSERT INTO servicetypes (stypeName) VALUES ('Immigration');
INSERT INTO servicetypes (stypeName) VALUES ('Labor');
INSERT INTO servicetypes (stypeName) VALUES ('Real Estate and Property Management');
INSERT INTO servicetypes (stypeName) VALUES ('Litigation and Dispute Resolution');
INSERT INTO servicetypes (stypeName) VALUES ('Telecommunications');
INSERT INTO servicetypes (stypeName) VALUES ('Tax');

/* populate the clients table */
/* name: Kevin Smith, kevinsmith@mail.com */
INSERT INTO clients (clientFN, clientMN, clientLN, clientEmail)
VALUES ('33zmQsVjuhbFRvCFHwHWWw==', 
'n6RHVJVfFATh9PsZjyzW+w==', 
'aFs5CbLMAGr40lBegi32tQ==', 
'8zW3Tpe0jkPslUJfavxaXGz23cXSKD+ERrrNzhFM/Sc=');

/* name: Amanda Barnes, a.barnes@trax.co.uk */
INSERT INTO clients (clientFN, clientMN, clientLN, clientEmail)
VALUES ('g2roBoTF0EJMs9ttCxV67w==', 
'n6RHVJVfFATh9PsZjyzW+w==', 
'oUy4jJwE1LLYsFQu/LNMqA==', 
'lbKucrXDSUzttdixeJs7RNk1TvGcq7Sng2Mupch0ang=');

/* name: Thomas Pagdanganan Madrigal, thomasmadrigal1993@yahoo.com */
INSERT INTO clients (clientFN, clientMN, clientLN, clientEmail)
VALUES ('4/re97S+9BG4skUDuRe5gQ==', 
'N7t8gsNZosWmab18IEBWwQ==', 
'vS682JA24FXwZY60bFCHSA==', 
'jgKeyf9HYali6mO1HCIhEucxJUk9Qc5uR6s2FpH/gqM=');

/* name: Dolores Tanyag */
INSERT INTO clients (clientFN, clientMN, clientLN, clientEmail)
VALUES ('BA16Q2lUVILth/cMPTkpYg==', 
'n6RHVJVfFATh9PsZjyzW+w==', 
'50UqQvPBSLTfi4/SPNAdQw==', 
'n6RHVJVfFATh9PsZjyzW+w==');