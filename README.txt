To set up the database code for this website please go to the files found in the database folder. You will want to run the files in the following order:

1. CampChamp_user.sql
2. CampChamp_employee.sql
3. CampChamp_customer.sql
4. CampChamp_vendor.sql
5. CampChamp_product.sql
6. CampChamp_order.sql
7. insert_user_data.sql
8. insert_employee_data.sql
9. insert_customer_data.sql
10. insert_vendor_data.sql
11. insert_product_data.sql
12. insert_order_data.sql

If you need to reset the databases at any time please use the drop_databases.sql file also found in the database folder to drop all the databases.

Note: You will have to edit the password and username for your database connection in the php files. I have run my code as the root user of my MAMP server which has the password root. You must change every connection.

The following files have connections that must be changed:

include folder:
	mysql.inc

This site uses both databases and sessions to run properly.