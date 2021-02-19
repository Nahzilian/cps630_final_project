#!/bin/bash
export PATH=${PATH}:/usr/local/mysql/bin

<<<<<<< HEAD
mysql -u root -p '[PASSWORD]' <<EOFMYSQL
=======
mysql -u root -p <<EOFMYSQL
>>>>>>> 1a17cf87b29101f38658eb53260e807ae593ae7b
source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/drop_table.sql;

source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/create_db.sql;

source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/main.sql;

source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/populate.sql;

EOFMYSQL

#source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/drop_table.sql;

#source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/create_db.sql;

#source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/main.sql;

#source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/populate.sql;
