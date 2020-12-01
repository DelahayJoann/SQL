SELECT * FROM students INNER JOIN school;

SELECT students.prenom FROM students;

SELECT students.prenom,students.datenaissance,school.school FROM students LEFT JOIN school ON students.school = school.idschool;

SELECT * from students WHERE students.genre = 'F';

SELECT * FROM students WHERE students.school = (SELECT students.school FROM students WHERE students.nom = 'Addy');

SELECT students.prenom FROM students ORDER BY students.prenom DESC;

SELECT students.prenom FROM students ORDER BY students.prenom DESC LIMIT 0,2;

INSERT INTO students VALUES (NULL, 'Dalor', 'Ginette', STR_TO_DATE('01/01/1930','%d/%m/%Y'), 'F', (SELECT school.idschool FROM school WHERE school.school = 'Bruxelles'));

UPDATE students SET students.prenom = 'Omer', students.genre = 'M' WHERE students.prenom = 'Ginette';

DELETE FROM `students` WHERE `idStudent` = 3;

UPDATE school t1 JOIN school t2 ON t1.idschool = 1 AND t2.idschool = 2 SET t1.school = 'Central', t2.school = 'Anderlecht'; 