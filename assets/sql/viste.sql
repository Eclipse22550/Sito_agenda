CREATE VIEW Amministratori AS
SELECT  user_code, name, lname, email, username
FROM    login
WHERE   roleid = '15398';

CREATE VIEW Moderatori AS
SELECT  user_code, name, lname, email, username
FROM    login
WHERE   roleid = '89187';

CREATE VIEW Utenti AS
SELECT  user_code, name, lname, email, username
FROM    login
WHERE   roleid = '64039';