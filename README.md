# PHP & MaterializeCSS Affiliate/Refferal System
---
A template for a affiliate/refferal system built with PHP and Materialize. There are three sections:
1. The Affilate User Dashboard - Dashboard for those looking to refer people to your website
2. The Affiliate Admin Dashboard - Dashboard for you, or those making the payouts and monitoring conversions
3. Snippets - Snippets of code that need to be added to pages on your website to count refferals

## Features
- An End-User Dashboard
- A Management Dashboard
- Completed snippets of code to integrate your existing website to this system

## Getting Started
1. The User Dashboard:
    1. The Files - I recommend putting the user dashboard files into the root of the affiliates folder. ie. website.tld/affiliate = user dashboard index page
    2. The Database:
        1. Create the following tables (you can choose different names, but change these in config.php)
            - "affiliates" table with the following columns:
                - affiliateID - INT (Foreign Key with the primary key from the table containing login information)
                - clicks - INT
                - conversions - INT
                - commissionBalance - FLOAT
                - payoutEmail - TEXT
            - "conversions" table with the following columns:
                - commissionID - INT (Primary Key + Auto Increment)
                - affiliate - INT (Foreign Key with affiliateID from Affiliates table)
                - date - DATE
                - type - TEXT
                - commissionAmount - FLOAT
                - approved - TINYINT (0 = pending, 1 = approved, 2 = rejected)
            - "payouts" table with the following columns:
                - payoutID - INT (Primary Key + Auto Increment)
                - affiliate - INT (foreign key with affiliateID from Affiliates table)
                - date - DATE
                - amount - FLOAT
                - email - TEXT
    3. Update the config.php file
        1. Set the companyName variable to change the value in the footer
        2. Change rootOfFiles variable if the files are not in the root (ie htdocs or www folder)
        3. Change the currency variable to the currency you will be paying your affiliates in
        4. Set the website URL variable to the URL of the website your affiliates will be referring people to. This will make their referral URL to website.tld/?ref=XXXX
        5. Add your database information, including the information of the tables you created in step one
    4. Upload a favicon.png and logo.png into the images folder to change the favicon and the logo in the nav menu respectively
    5. Make sure the password hashes in the database are generated with password_hash() with PHP

2. The Admin Dashboard:
    1. The Files - I recommend putting the admin dashboard files into another folder such ad 'admin'. ie. website.tld/affiliate/admin = admin dashboard index page
    2. Update the config.php file
        1. Set the companyName variable to change the value in the footer
        2. Change rootOfFiles variable if the files are not in the root (ie htdocs or www folder)
        3. Change the currency variable to the currency you will be paying your affiliates in
        4. Add your database information
        5. Set the minimum withdrawal amount for your affiliates (this will only change how affiliate payouts are sorted)
    3. Upload a favicon.png and logo.png into the images folder to change the favicon and the logo in the nav menu respectively
    4. Make sure the password hashes in the database are generated with password_hash() with PHP

3. The Snippets:
    1. Open the snippets folder on github, or download it, although the formatting will vanish locally
    2. Paste the snippets of code into the correct files as mentioned in the snippets.md file

## Warning
There are currently no fraud checks included in the system. I would recommend at least implementing a simple IP check to prevent fraud. If you do code a fraud check, feel free to create a pull request or issue to include the code in this repository.