# Source-only local setup

This repository omits runtime executables and all bank/customer records. Use an isolated local environment for the existing legacy application. The bank manual-entry INSERT and some permission checks still need fixes described in the Bengali guide.

## Requirements

- PHP 5.6.40 with short tags enabled. Official archive: https://downloads.php.net/~windows/releases/archives/
- MariaDB 10.11-compatible server. The original portable layout uses 10.11.10: https://archive.mariadb.org/mariadb-10.11.10/winx64-packages/
- PHP extensions: mysql, mysqli, pdo_mysql, mbstring, gd, ldap, openssl, DOM and iconv.
- Include `vendor/pear` in the PHP `include_path` for Excel exports. Reader source is already under `CBRMS_AIBL/excel_reader2.php`.

## Database and account

1. Run a local MariaDB server bound to `127.0.0.1`, preferably on port `3307` to match the existing application default. The original layout used an empty root password for local compatibility; the source copy supports database credentials through environment variables below.
2. Create a `cbrms_aibl` database and import `database/schema.sql`. It creates empty tables only. Configure the server for the legacy application's SQL mode, for example `--sql-mode=` in an isolated local environment.
3. Set `CBRMS_DB_HOST` (default `127.0.0.1:3307`), `CBRMS_DB_USER` (default `root`), `CBRMS_DB_PASSWORD` (default empty) and `CBRMS_DB_NAME` (default `cbrms_aibl`) in the process environment if different.
4. Run `php tools/create-local-admin.php`. It prompts for a new development password on standard input and creates Bank `LOCALADMIN` and Operations `localadmin` accounts. If either name already exists, it stops without overwriting users. The original application's vendor password storage and bank MD5 storage are retained for compatibility; this is not a modern password-storage implementation.
5. Populate legitimate branch/product/serial configuration using the available administration features or an approved database import. The repository deliberately contains none of the original configuration rows or bank data. An empty schema is not the original populated installation.

## PHP configuration and start

Enable `short_open_tag=On`, the extensions above, and `date.timezone=Asia/Dhaka`. Set `include_path` to include the absolute path to this clone's `vendor/pear`. Configure writable session and upload temporary directories outside the web root. Keep error display off and logging on.

Create writable upload folders under `CBRMS_AIBL/net`: `ucbl data`, `ucbl card data` and `aibl others data`. These generated/customer files are ignored by Git.

Start from the repository root:

```text
php -S 127.0.0.1:8080 -t CBRMS_AIBL
```

- Operations: http://127.0.0.1:8080/net/net_signin.php
- Bank: http://127.0.0.1:8080/aibl/user_signin.php
- Manager: http://127.0.0.1:8080/aibl/manager_signin.php

## Windows shortcut layout

The included start/stop helpers expect a prepared `runtime/php`, `runtime/mariadb-10.11.10-winx64`, `runtime/db-data`, `runtime/logs`, `runtime/sessions` and `runtime/tmp` layout. Create your own `runtime/php/php.ini` and database `runtime/db-data/my.ini` with this checkout's absolute paths. For that layout, point `include_path` to `vendor/pear`. The runtime directory is ignored and never uploaded.

## LDAP and deployment

`CBRMS_AIBL/aibl/adLDAP.php` contains example domain placeholders and no directory-account credentials. If bank directory integration is required, configure it privately outside Git and validate its authentication/session flow separately. It is not needed for the local database sign-in screens.

The modern UI does not remove the backend's documented legacy limitations. Network deployment, backend migration and complete role/branch permission enforcement are separate work.
