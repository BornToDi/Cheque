# Requisition 2.0 interface upgrade

The running application now uses a shared interface for the bank and operations portals, with a responsive sidebar, account header, page titles, consistent typography, form controls, table styling and print rules. Login pages for operations, bank and managers use the same new design.

The overview dashboard shows database-backed totals, status distribution and the eight most recent requests. Bank users and managers see totals and recent rows for their collecting branch. Navigation retains the original role-specific links; bank request links and operations order management now point to their existing workflows.

Usability improvements include mobile navigation, password visibility controls, local filtering of rows already loaded on the page, compact requisition pagination and modern Excel file selection. Server search continues to search the database. Fifteen legacy pages with standalone styles were also connected to the shared design.

Repairs found during verification: admin/vendor total-list pagination lacked a query; bank user-management links named missing files; other-items import referenced the wrong database and duplicate-check column; manager sign-in did not accept the hashes used by the bank portal; some pages loaded scripts/styles from incorrect paths; the paginated Excel export lacked database initialization. The report link now says "Download this page" because it exports the current page rather than every record.

Existing workflow inputs and actions were retained. Successful sign-in regenerates the session ID and uses HTTP redirects. No existing user passwords, requisitions or delivery rows were changed during this upgrade. Temporary branch-role sessions used for validation are outside the website document root.

Validation artifacts are in `runtime/tmp`: `modern-login.png`, `modern-dashboard.png`, `modern-mobile.png`, `modern-upload.png`, `modern-requisitions.png` and `ui-verification.json`. The browser checks use installed Chrome through Playwright, covering both portals, mobile menu, table filtering, pagination, password visibility, wrong-password rejection, logout, manager-password compatibility, user/manager pages and branch totals. PHP syntax checks cover all 161 application files. Spreadsheet read/write and the paginated report download were checked separately.

This upgrade modernizes the interface and repairs the listed issues. The underlying application still uses the existing PHP 5.6 compatibility runtime and legacy workflow code. It is not a migration to a supported PHP runtime or a certification of every business operation. Physical printing, live imports and end-to-end requisition changes were not performed against real records. Keep this deployment local until a separate backend modernization and security review are completed.

Original ZIP files remain on D:. Pre-change entry pages and other changed-file snapshots are in `ui-backup`.

Open http://127.0.0.1:8080/net/net_signin.php or run `Start-Requisition.cmd`. Existing local credentials remain in `LOCAL-LOGIN.txt`.
