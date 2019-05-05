"# HotelBookingForm" 

HotelBooking App
This project is an Advanced PHP & MySQL project for CodeSapce - using session storage, MYSQL & PHPt to create Hotel Booking App with persistant data.

Database Structure ❤

DB name : hotel 
Table : bookings

+-----------+-------------+------+-----+-------------------+----------------+
| Field     | Type        | Null | Key | Default           | Extra          |
+-----------+-------------+------+-----+-------------------+----------------+
| id        | int(6)      | NO   | PRI | NULL              | auto_increment |
| firstname | varchar(40) | NO   |     | NULL              |                |
| surname   | varchar(40) | NO   |     | NULL              |                |
| hotelname | varchar(40) | NO   |     | NULL              |                |
| indate    | varchar(40) | NO   |     | NULL              |                |
| outdate   | varchar(40) | NO   |     | NULL              |                |
| booked    | varchar(4)  | YES  |     | NULL              |                |
| datetime  | timestamp   | NO   |     | CURRENT_TIMESTAMP |                |
+-----------+-------------+------+-----+-------------------+----------------+


Sample Data

+-----+--------------+------------------+-------------------------------+------------+------------+--------+---------------------+
| id  | firstname    | surname          | hotelname                     | indate     | outdate    | booked | datetime            |
+-----+--------------+------------------+-------------------------------+------------+------------+--------+---------------------+
|   1 | Shalendra    | Singh            | Cape Grace                    | 2019-05-04 | 2019-05-16 | NULL   | 2019-05-04 19:13:59 |
|   2 | Shalendra    | Singh            | Taj Cape Town                 | 2019-05-04 | 2019-05-16 | NULL   | 2019-05-04 19:15:26 |
|   3 | Urisha       | Brijlal          | Twelve Apostles Hotel and Spa | 2019-05-10 | 2019-05-17 | NULL   | 2019-05-04 19:15:44 |
+-----+--------------+------------------+-------------------------------+------------+------------+--------+---------------------+


🤷‍ Why?

Project is an intermediate PHP project for CodeSapce - using session storage for PHP and JavaScript to create ToDo App with persistant data without a DB
To enhance my MYSQL , OOP & PHP skills

🤔 solution?
This Hotel Booking uses HTML, CSS , PHP and MYSQL
It is built as version 1 of a fully databased app.


🚀 Try out?
All you have to do is: 

1. Enter your Name & Suranme
2. Choose a 'Check In and Check Out dates' for the Booking
3. Click "Check Availbility" 
4. This will check the DB to see if you have an existing booking 
5. if not you will get a summary of your booking and be able to Confirm the Holiday

🚚 Roadmap
0.1.0
- 
- 
- 