SELECT * FROM clients;

SELECT * FROM showtypes;

SELECT * FROM clients LIMIT 0,20;

SELECT * FROM clients WHERE card = 1;

SELECT CONCAT('Nom: ', lastName, '\n Prénom: ', firstName) AS "Clients" FROM clients WHERE lastName LIKE 'M%' ORDER BY lastName ASC;

SELECT CONCAT(title,' par ', performer, ' le ', date, ' à ', startTime) as "Spectacles" FROM shows;

SELECT CONCAT('Nom: ', lastName, '\nPrénom: ', firstName, '\nDate de naissance: ', birthDate,IF(card <> 0,CONCAT("\nCarte de fidélité: Oui\nNuméro de carte: ",cardNumber), "\nCarte de fidélité: Non")) AS "Clients" FROM clients;