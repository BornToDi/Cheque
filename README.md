# Cheque — Requisition 2.0

AIBL cheque book requisition management application with a refreshed bank and operations interface. The repository includes the PHP application, UI assets, Bengali role/user documentation, spreadsheet-library source and an empty database schema.

## Features

- Separate bank, manager and operations sign-in screens.
- Responsive navigation and database-backed overview dashboard.
- Branch-scoped dashboard for branch users and managers.
- Requisition, approval, acknowledgement, search and status workflows.
- Excel import, serial/production preparation, order management and challan/bill report screens.
- Table filtering, compact pagination and consistent form/table styling.

The UI is version 2.0. The backend still requires legacy PHP 5.6 and the `mysql` extension; this is not a PHP 8 migration. See the Bengali guide for known workflow and permission limitations. Screens that load successfully are not a certification of every write action or live printing workflow.

## Documentation

- [Bengali PDF user and role guide](SOFTWARE-DOCUMENTATION-BN.pdf)
- [Editable Bengali guide](SOFTWARE-DOCUMENTATION-BN.md)
- [Printable HTML guide](SOFTWARE-DOCUMENTATION-BN.html)
- [UI changes and verification](UI-UPGRADE.md)
- [Local workspace notes](README-LOCAL.md)
- [Source-only setup](SETUP.md)

## Repository contents

| Path | Contents |
|---|---|
| `CBRMS_AIBL/` | PHP application, modern shared UI and original static assets |
| `vendor/pear/` | PEAR/OLE/Spreadsheet Excel Writer source dependencies |
| `database/schema.sql` | Table structure only; no customer records or accounts |
| `tools/create-local-admin.php` | CLI bootstrap for separate development admin accounts |
| `Start-Requisition.*`, `Stop-Requisition.*` | Helpers for the prepared Windows portable-runtime layout |

The original local database, customer Excel files, generated production files, credentials, private LDAP settings, runtime binaries and working backups are excluded. LDAP values in this publication copy are placeholders. Existing passwords are not included, so an account must be created locally or a separately supplied database imported.

For the original local installation, see `README-LOCAL.md`. A clone alone does not contain its portable runtime or populated database; follow `SETUP.md`.

Third-party source retains its original license notices. No new license is assigned to the original application by this upload.
