## MySQL Tables and Indexes

### Overview :

1.  Names of the table should be starting with uppercase letter with no special characters and number in the start and if the name is  of more than one word. Then use underscore (_) as seperator and keeping the CammelCase format.
2. Each table should consist a *primary key* which should be not null and unique.
3. The values in primary key column should be unsigned and auto-increment.
4. The names of the column should use *RegularlCase* with underscore as seperator between two words.
5. The pivot table should also use the same convention and should not be null.
    ```
        CREATE TABLE Blog_User(
        User_Id INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
        First_Name VARCHAR(30) NOT NULL,
        Last_Name VARCHAR(30),
        Email_Id VARCHAR(30) NOT NULL,
        Password VARCHAR(100) NOT NULL,
        PRIMARY KEY(User_Id)
        );
    ```
    
## Tables in the database
#### Blog_User
            +------------+-----------------+------+-----+---------+----------------+
            | Field      | Type            | Null | Key | Default | Extra          |
            +------------+-----------------+------+-----+---------+----------------+
            | User_Id    | int(5) unsigned | NO   | PRI | NULL    | auto_increment |
            | First_Name | varchar(30)     | NO   |     | NULL    |                |
            | Last_Name  | varchar(30)     | YES  |     | NULL    |                |
            | Email_Id   | varchar(30)     | NO   |     | NULL    |                |
            | Password   | varchar(100)    | YES  |     | NULL    |                |
            +------------+-----------------+------+-----+---------+----------------+
#### Article
            +---------------+-----------------+------+-----+---------+----------------+
            | Field         | Type            | Null | Key | Default | Extra          |
            +---------------+-----------------+------+-----+---------+----------------+
            | Article_Id    | int(5) unsigned | NO   | PRI | NULL    | auto_increment |
            | Article_Title | varchar(100)    | NO   |     | NULL    |                |
            | Article       | text            | NO   |     | NULL    |                |
            | User_Id       | int(5) unsigned | YES  | MUL | NULL    |                |
            | Created_Date  | date            | NO   |     | NULL    |                |
            | Modified_Date | date            | NO   |     | NULL    |                |
            +---------------+-----------------+------+-----+---------+----------------+


CREATE TABLE `Assignments`.`Comment` ( `Comment_Id` INT(5) NOT NULL AUTO_INCREMENT , `Comment_Data` TEXT NOT NULL , `User_Id` INT NOT NULL , `Article_Id` INT NOT NULL , `Created_On` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB;