#!/bin/bash
export PATH=${PATH}:/usr/local/mysql/bin

mysql -u root -p <<EOFMYSQL
source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/drop_table.sql;

source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/create_db.sql;

source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/main.sql;

source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/populate.sql;

EOFMYSQL

#source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/drop_table.sql;

#source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/create_db.sql;

#source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/main.sql;

#source ~/Documents/github/CPS630_FINAL_PROJECT/back-end/sql-code/populate.sql;