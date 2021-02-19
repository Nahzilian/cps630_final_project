# cps630_final_project

##OVERVIEW
___
Over the past few years, the living conditions of everyone have been affected heavily by the carbon emissions caused by industrial waste or transportation. Several solutions have been developed in order to tackle this problem, and they all show promising results.
The project applies the “Plan for Smart Services” (P2S) Web application methodology as a mean of creating potential services help reduce air pollution. The web application is developed under the LAMP stack (Linux, Apache, MySQL, PHP) with MVC architecture. Additionally, the web app includes open libraries such as google map, SASS, JQuery to assist the system.

##TECHNOLOGIES
___
As mentioned above, the web application will be developed under the LAMP stack with the MVC design pattern. To be more specific, these are the tools that will be used:
* Linux OS system (As developing environment)
* Apache (XAMPP - Web hosting tool)
* MySQL (MySQL database)
* PHP (As the main coding language for back-end)
* HTML5, SASS, CSS3, JavaScript, JQuery (For UI/UX)

##IMPLEMENTATION
___
###1/ The main system
The web application will have 2 different modes: user mode and admin mode. Admin will have all the privileges to view the databases, as well as create, delete and modify records. Users will be able to see their personal information, orders, map, store, products.
To distinguish between the 2 modes, the database was set to collect user type. The “user” type is set by default so that everyone with access to the website can make their personal account. The “admin” type, however, can only be set up by the developer/root admin.
The following section will include all the implementation of SQL codes for all the transactions.
  - Creating
  - Adding
  - Deleting
  - Modifying
  - Searching
###2/ The front-end
Each page will contain certain information, functionality that assists the user. All pages will navigate through a  Navbar component. The website will contain the following pages:
  - Home page
  - About us
  - Contact us
  - Sign up
  - Reviews
  - Shopping cart
  - Type of Service

The Home page where all the information about the web is displayed. This will give a quick overview of the page along with its features. On this page, other content will be included such as the “About Us” page - a brief bio description of Team 6 members as well as their contribution to the site, and the form “Contact us”.
The Signup page will lead the user to a form where they could fill up their information for signing up for an account. After they have successfully created an account, they can log in to the system using the Login form.
The Shopping Cart is where the user can see their current orders.
The Type of Service will toggle users between services: Delivering service or driving service.
The Review page: Users can read over the reviews for a product or a driver, however, they will not be able to make any review/ rating unless they have previously ordered/got delivered from that specific driver or bought the specific flower type.
###3/ The back-end
There are 2 main components that made up the back-end, which is the relational database system and the MVC back-end.
For the relational database system, we have decided to create the following tables:

|  Table 	|  Description 	|  Attributes 	|  # of Records 	|
|:-:	|---	|---	|:-:	|
|  Car 	|   Information about cars	|  ID, model, code, availability code 	|  15 	|
|  Customer 	|  Information about customers, including user name and hashed password 	|  ID, name, telephone, email, address, city code, username, password, balance, admin (To check for users) 	|  10 	|
|  Customer Order 	|  Information about customer orders 	|  ID, date issued, date done, total price, payment code, customer ID, trip ID, flower ID 	|  100 	|
|   Flower	|  Information about the store and price of the produc 	|  ID, Store code, price 	|  30 	|
|  Trip 	|  Information about the trip 	|  ID, destination code, source code, distance, car id, price 	|  50 	|
| Product review  	| All the reviews on products  	| ID, context, score, flower ID  	|  30 	|
|  Driver review 	|  All the reviews on driver 	|  ID, context, score, car ID 	| 30  	|


There will be separated scripts to generate the tables according to the design board above, most of the data are consistent, however, the customer order total price is inconsistent with the add up of trip price and the product type, since they were generated for demo purpose. However, once a new user is created, the new records will be much more consistent comparing to existed ones. Since all of our team members are developing the web application on the Linux platform, we have made a file named “generate.sh” in order to create and populate data to the database.
As for the back-end system, it was designed and implemented by the MVC pattern and object-oriented architecture. There will be 7 different classes with different methods to implement to the web application. These 7 classes match all the tables from the database and will be used as our Model. These models will be called in the main Controller, which will respond accordingly based on the parameters. Afterwards, the front-end (View) will be updated whenever it makes a request to the back-end side.

##RESULTS
These are some of the images of our web application:

