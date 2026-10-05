<?php
if (PHP_SAPI !== 'cli') { http_response_code(403); exit('CLI only.'); }
$host = getenv('CBRMS_DB_HOST') ?: '127.0.0.1:3307';
$parts = explode(':', $host, 2);
$dsn = 'mysql:host='.$parts[0].';port='.(isset($parts[1])?$parts[1]:'3306').';dbname='.(getenv('CBRMS_DB_NAME') ?: 'cbrms_aibl');
$pdo = new PDO($dsn, getenv('CBRMS_DB_USER') ?: 'root', getenv('CBRMS_DB_PASSWORD') ?: '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
$bank = $pdo->query("SELECT COUNT(*) FROM aibl_login WHERE user_id='LOCALADMIN'")->fetchColumn();
$ops = $pdo->query("SELECT COUNT(*) FROM net_user WHERE user_name='localadmin'")->fetchColumn();
if ($bank || $ops) exit("An admin account already exists. No users changed.\n");
echo "Choose a local development password (input may be visible in this terminal): ";
$password = rtrim(fgets(STDIN), "\r\n");
if (strlen($password)<12) exit("Use at least 12 characters. No users changed.\n");
$statement = $pdo->prepare("INSERT INTO aibl_login (user_id,pass,branch_code,branch_name,branch_user_name,user_email,active,user_type,user_create_by,user_modified_by,user_create_date,user_modified_date,flag) VALUES ('LOCALADMIN',?,'0000','Local','Local Administrator','',1,'admin','local setup','local setup',NOW(),NOW(),1)");
$statement->execute(array(md5($password)));
$statement = $pdo->prepare("INSERT INTO net_user (user_name,user_fullname,user_pass,active,user_type) VALUES ('localadmin','Local Administrator',?,1,'admin')");
$statement->execute(array($password));
echo "Created local development accounts: bank LOCALADMIN; operations localadmin.\n";
