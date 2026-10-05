# Requisition software — local setup

Working folder: `E:\Requisition software`. Keep this path unchanged because the runtime configuration uses it.

Double-click `Start-Requisition.cmd` to start the database and website and open the vendor login. Double-click `Stop-Requisition.cmd` to stop them.

- Vendor/admin login: http://127.0.0.1:8080/net/net_signin.php
- Bank/admin login: http://127.0.0.1:8080/aibl/user_signin.php
- Local test account credentials: `LOCAL-LOGIN.txt`

Existing users were preserved. Separate local admin accounts were added to the working database copy. Original ZIP files on D: and the extracted backup in `database-backup` remain unchanged. Application changes and database writes apply only to the working copy.

The portable database uses MariaDB 10.11.10 on loopback port 3307. PHP 5.6.40 runs on loopback port 8080 for compatibility with the application's legacy mysql APIs. These servers start manually; they are not Windows services. Database files are in `runtime/db-data`, and diagnostic logs are in `runtime/logs`.

Repairs: session registration compatibility; shared includes; bank password validation; local database connections including PDO; missing homepage reference; one PHP syntax error; missing spreadsheet export dependencies; spreadsheet reader path; upload duplicate-check column and value binding; Dhaka timezone.

Validation: all 157 application PHP files pass syntax checks; all nine restored database tables pass integrity checks; restored counts are 77,075 requisitions and 307,438 delivery rows. Both local account logins and wrong-password rejection were checked. Dashboard, search, serial number, user management, challan, upload-form and bill-page HTTP checks passed. An existing XLS file was read successfully and a generated XLS was read back successfully.

This is a local compatibility setup. Full business workflow correctness, bank directory authentication, physical printing and new requisition imports have not been certified. No real requisitions were submitted during testing. PHP 5.6 is retired (https://www.php.net/releases/5_6_40.php); use a modernized application and a production security review before exposing it to a network or the internet.

Downloaded dependencies come from official PHP, MariaDB and PEAR archives; their package sources and license notices are retained under `runtime/packages`.
