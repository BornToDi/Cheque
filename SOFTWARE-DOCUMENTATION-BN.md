# Requisition 2.0 — ব্যবহার, Role ও কাজের নির্দেশিকা

সংস্করণ: বর্তমান local software ও আধুনিক UI • প্রস্তুতের তারিখ: ৫ অক্টোবর ২০২৬

এই নির্দেশিকা বর্তমান কোড, মেনু এবং পূর্বের browser পরীক্ষার ভিত্তিতে লেখা। এখানে role-এর দায়িত্ব ও স্বাভাবিক মেনু-access বর্ণনা করা হয়েছে। সব পেজে server permission সমানভাবে প্রয়োগ হয়েছে—এমন নিশ্চয়তা দেওয়া হচ্ছে না।

## ১. সফটওয়্যারটির উদ্দেশ্য

AIBL-এর cheque book এবং অন্যান্য security item-এর requisition, approval, order preparation, serial number, challan, dispatch ও receipt-এর তথ্য এক জায়গায় রাখা। Bank এবং Networld/operations দলের জন্য আলাদা portal আছে।

এটি requisition ব্যবস্থাপনার সফটওয়্যার। পূর্ণ banking system, cheque-clearing system, accounting software অথবা printing-machine controller হিসেবে এর কার্যকারিতা পাওয়া যায়নি।

## ২. কীভাবে চালু ও লগইন করবেন

1. `E:\Requisition software\Start-Requisition.cmd` double-click করুন।
2. Operations-এর জন্য http://127.0.0.1:8080/net/net_signin.php খুলুন।
3. Bank-এর জন্য http://127.0.0.1:8080/aibl/user_signin.php খুলুন।
4. Manager-এর জন্য http://127.0.0.1:8080/aibl/manager_signin.php খুলুন।
5. নিজের User ID ও password দিয়ে login করুন।
6. কাজ শেষে account-এর পাশে Sign out চাপুন। Server বন্ধ করতে `Stop-Requisition.cmd` চালান।

বর্তমান local test ID: Operations Admin = `localadmin`; Bank Admin = `LOCALADMIN`। Password আলাদা `LOCAL-LOGIN.txt` ফাইলে আছে; এই শেয়ারযোগ্য নির্দেশিকায় password লেখা হয়নি।

Portal নির্বাচন করলেই role বদলায় না। Login করা account-এর সংরক্ষিত role অনুযায়ী access নির্ধারিত হয়। Operations Admin এবং Bank Admin দুটি আলাদা account ব্যবস্থা। Manager portal-এ Bank Admin login করলে overview-তে যায়; সে কারণে account Manager হয়ে যায় না।

## ৩. Role অনুযায়ী কার কী দায়িত্ব

| Role | কার জন্য | স্বাভাবিক কাজ ও access | তথ্যের পরিসর / সীমা |
|---|---|---|---|
| Bank Admin (`admin`) | ব্যাংকের system administrator | Bank user তৈরি/সংশোধন; role, branch ও active status সেট; branch তৈরি/সংশোধন; overview ও total list | নতুন dashboard ও total list-এ সব branch; manager approval বা vendor production-এর স্বাভাবিক role নয় |
| GSD (`gsd`) | ব্যাংকের কেন্দ্রীয় requisition তদারকি দল; GSD নামের পূর্ণরূপ প্রতিষ্ঠানের কাছে নিশ্চিত করতে হবে | সব branch-এর cheque/other item search, requisition তালিকা ও status দেখা; rejected request management-এর মেনু | কেন্দ্রীয় দৃশ্যমানতা; rejected-edit মেনু ও পেজের role-check-এর অসামঞ্জস্য আছে |
| Branch User (`user`) | শাখার requisition entry ও receipt কর্মকর্তা | New cheque/item request; নিজের branch-এর search/list/status; dispatch হওয়া item গ্রহণের acknowledgement; password পরিবর্তন | dashboard ও সংশ্লিষ্ট branch search/list-এ collecting branch অনুযায়ী তথ্য; approval-এর দায়িত্ব Manager-এর |
| Branch Manager (`manager`) | শাখার অনুমোদনকারী | branch-এর awaiting-approval request দেখা; approve/reject; branch search/list/status; password পরিবর্তন | branch অনুযায়ী তালিকা; approval ও rejection মানুষের সিদ্ধান্ত |
| Operations Admin (`admin`, operations portal) | Networld/operations administrator | Vendor-এর operational কাজ; operations user তৈরি/সংশোধন, active status ও deletion-এর মেনু | operations portal-এর সব requisition; bank branch/role management আলাদা portal-এ |
| Vendor (`vendor`) | production, printing preparation ও dispatch operator | Excel import; request search; print preparation; serial range; order management; challan; bill/report download; status tracking | operations-এর সব branch-এর তথ্য; operations user management-এর মেনু দেখায় না; branch-manager approval role নয় |

Bank user তৈরির form-এ `user`, `manager`, `admin`, `gsd` role আছে। Operations-এর সাধারণ Create User form নতুন account-কে `vendor` হিসেবে তৈরি করে; সেখানে নতুন Operations Admin তৈরির সাধারণ role selector পাওয়া যায়নি।

## ৪. কাজের অধিকার এক নজরে

চিহ্ন: **আছে** = স্বাভাবিক মেনু/কোডে ব্যবস্থা; **সীমিত** = সংশ্লিষ্ট branch বা নির্দিষ্ট মডিউল; **নেই** = সেই role-এর স্বাভাবিক মেনুতে নেই। এটি security certification নয়।

| কাজ | Bank Admin | GSD | Branch User | Manager | Ops Admin | Vendor |
|---|---|---|---|---|---|---|
| Overview dashboard | আছে | আছে | branch | branch | আছে | আছে |
| Bank user ও branch management | আছে | নেই | নেই | নেই | নেই | নেই |
| Operations user management | নেই | নেই | নেই | নেই | আছে | নেই |
| Manual requisition entry | নেই | নেই | আছে* | নেই | নেই | নেই |
| Manager approve/reject | নেই | নেই | নেই | branch | নেই | নেই |
| Search/list/status | সীমিত | সব branch | branch | branch | সব branch | সব branch |
| Excel requisition import | নেই | নেই | নেই | নেই | আছে | আছে |
| Serial ও print preparation | নেই | নেই | নেই | নেই | আছে | আছে |
| Order, challan, dispatch কাজ | নেই | নেই | নেই | নেই | আছে | আছে |
| Delivery acknowledgement | নেই | নেই | branch | নেই | নেই | নেই |
| Bill/production export-এর স্বাভাবিক মেনু | নেই | সীমিত report | সীমিত report | সীমিত report | আছে | আছে |

*Manual entry form দেখা গেছে এবং স্ক্রিন পরীক্ষা হয়েছে; cheque entry submission-এর SQL-এ duplicate column আছে। সংশোধন ও test submission ছাড়া এটি নির্ভুল কাজ করছে বলা যাবে না। Bank Admin-এর overview/quick search থাকা এবং তার sidebar-এ GSD-এর সব search menu থাকা একই বিষয় নয়।

## ৫. সফটওয়্যার কী কী করতে পারে

### Dashboard ও তালিকা

- Database থেকে total, pending, ordered ও delivered-এর সংখ্যা দেখায়।
- Approval, pending, ordered, dispatched, delivered ও rejected distribution দেখায়।
- সর্বশেষ ৮টি cheque requisition দেখায়। Branch User/Manager-এর dashboard collecting branch অনুযায়ী সীমিত।
- Cheque ও other item-এর status তালিকা আলাদা। Dashboard-এর মূল summary cheque requisition-এর; other item-এর সব সংখ্যা সেখানে একসঙ্গে দেখানো হয় না।
- Pagination দিয়ে তালিকার পরবর্তী পেজ দেখা যায়। নতুন compact total list প্রতি পেজে ৩০টি request দেখায়।

### Requisition ও approval

- Branch User-এর cheque ও other item entry form আছে। Account/customer, branch, item/account type, leaf/book quantity, delivery priority ও remarks-এর তথ্য রাখার ব্যবস্থা আছে।
- Manual cheque entry-এর কোড নতুন request-কে `approval` status দেওয়ার উদ্দেশ্যে লেখা। বর্তমান submission ত্রুটি নিচে উল্লেখ আছে।
- Manager-এর approve করলে cheque request `pending` হয়; reject করলে `reject` হয়। Approver ও approval সময় সংরক্ষণের কোড আছে।
- Branch User dispatch হওয়া item বাস্তবে পাওয়ার পরে acknowledgement করলে cheque request `delivered` করার কোড আছে।

### Excel import

- Operations portal-এ cheque `.xls` import আছে। Card ও other item import-এর route/form-ও আছে; বর্তমান sidebar-এ তিনটির সব link দেখায় না।
- Cheque import existing column order অনুযায়ী পড়ে; data loop পঞ্চম row থেকে শুরু হয়। অন্য import-এর template একই ধরে নেওয়া যাবে না।
- একই filename আগে import হয়েছে কি না পরীক্ষা করার ব্যবস্থা আছে; এটি একই customer/account/request নতুন filename-এ আবার import হওয়া ঠেকানোর পূর্ণ ব্যবস্থা নয়।
- Cheque import কোড `Pending` status দেয়; other-item import কোড `Ordered` status দেয়। তাই import সবসময় manager-approval ধাপ দিয়ে যায়—এমন ধারণা করা ঠিক নয়।
- Import সফল হলে database-এ record যোগ হয় এবং upload-এর কপি সংশ্লিষ্ট folder-এ রাখার কোড আছে। বাস্তব import submission এখনো এই local setup-এ পরীক্ষা করা হয়নি।

### Production, serial, challan ও রিপোর্ট

- Serial range-এর start/end number সেট করা যায়। Print preparation-এর কোড আগের serial ও leaf quantity ব্যবহার করে number হিসাব করার ব্যবস্থা রাখে; operator যাচাই ও confirm করেন।
- Pending request বাছাই করে production/order status update করার ব্যবস্থা আছে। Manage orders-এ ordered request দেখা ও dispatch status update-এর কোড আছে।
- Cheque/other item challan number দেওয়া এবং branch অনুযায়ী challan/report তৈরির ব্যবস্থা আছে।
- Bill summary, branch-wise bill, challan, PSI এবং MICR/personalisation-এর export link/code আছে। সব ধরনের export সম্পূর্ণ পরীক্ষা হয়নি।
- নতুন total-list-এর `Download this page` বর্তমান পেজের তথ্য export করে; সব ৭৭,০৭৫ record একসঙ্গে download করে না।
- Database search এবং বর্তমান পেজে দ্রুত `Filter this list` আলাদা। Filter কেবল ইতিমধ্যে load হওয়া row খোঁজে।

### User ও UI

- Bank user-এর role, branch association ও active status ব্যবস্থাপনার form আছে। Operations user create/edit/active/delete-এর কোড আছে।
- আধুনিক login, password show/hide, responsive sidebar, mobile menu, status badge ও একরকম form/table design আছে।
- Login সফল হলে session ID regenerate হয়; sign out আছে। Role নির্ধারণ account-এ হয়।

## ৬. একটি সাধারণ কাজের প্রবাহ

**Manual bank request-এর উদ্দেশ্যকৃত প্রবাহ:**

Branch User entry → Awaiting approval → Manager approve → Pending → Operations serial/production preparation → Ordered → Challan/dispatch → Dispatched → Branch receipt acknowledgement → Delivered

**Rejected request:** Manager reject করলে request rejected তালিকায় যায়। সংশোধন/পুনরায় পাঠানোর কিছু পুরোনো কোড ও মেনু আছে, তবে বর্তমান routing/permission মিলিয়ে end-to-end পরীক্ষা করা হয়নি।

**Excel import-এর প্রবাহ:** প্রস্তুত Excel ফাইল → Operations import → import module অনুযায়ী Pending/Ordered → production/challan/dispatch → receipt। এটি manual bank approval-এর সমান প্রবাহ নয়।

এই ধাপগুলো বর্তমান কোডের উদ্দেশ্য বোঝায়; live request দিয়ে সম্পূর্ণ সফল চক্রের প্রত্যয়ন নয়।

## ৭. Status-এর অর্থ ও দায়িত্ব

| Status | অর্থ | সাধারণ দায়িত্ব |
|---|---|---|
| `approval` | অনুমোদনের অপেক্ষায় | Branch Manager সিদ্ধান্ত দেবেন |
| `pending` | approval/import হয়েছে; production preparation বাকি | Operations/Vendor প্রস্তুত করবেন |
| `ordered` | order/production পর্যায়ে | Operations/Vendor serial, production ও challan যাচাই করবেন |
| `dispatched` | পাঠানোর তথ্য update করা হয়েছে | Operations/Vendor প্রকৃত পাঠানোর পরে update করবেন |
| `delivered` | receipt/acknowledgement update হয়েছে | Branch User বাস্তবে গ্রহণ করে নিশ্চিত করবেন |
| `reject` | request বাতিল/অনুমোদিত হয়নি | Manager; সংশোধনের জন্য সংশ্লিষ্ট দল যোগাযোগ করবেন |

Status update নিজে physical production, courier delivery বা cheque book হাতে পাওয়ার প্রমাণ সংগ্রহ করে না। দায়িত্বপ্রাপ্ত ব্যক্তি বাস্তব কাজের সঙ্গে মিলিয়ে update করবেন।

## ৮. সফটওয়্যারের বাইরে কী করতে হয়

| বাইরের কাজ | সফটওয়্যারের সম্পর্ক |
|---|---|
| Bank/branch থেকে source data সংগ্রহ ও Excel প্রস্তুত | সঠিক format-এর file মানুষ upload করেন; automatic core-banking sync নিশ্চিত পাওয়া যায়নি |
| Approval ও quality check-এর সিদ্ধান্ত | সফটওয়্যার সিদ্ধান্ত record করে; মানুষ তথ্য ও অনুমোদন যাচাই করেন |
| Cheque/MICR ছাপানো, binding ও packing | Export/preparation আছে; machine integration পরীক্ষা বা নিশ্চিত করা হয়নি |
| Courier বা শাখায় physical delivery | সফটওয়্যারে dispatch/receipt record হয়; physical delivery বাইরে হয় |
| Bill payment ও পূর্ণ হিসাব মেলানো | Bill/report আছে; পূর্ণ payment/accounting integration পাওয়া যায়নি |
| Database backup ও restore | স্বয়ংক্রিয় scheduled backup মেনু/ব্যবস্থা পাওয়া যায়নি; administrator-কে আলাদা ব্যবস্থা করতে হবে |
| একাধিক computer থেকে ব্যবহার | বর্তমান server loopback/local-এ চলছে; network deployment আলাদা কাজ |

Backup করতে হলে database-এর সামঞ্জস্যপূর্ণ SQL export অথবা server যথাযথভাবে বন্ধ করে complete backup-এর ব্যবস্থা করতে হবে। চলন্ত database-এর table file অযাচিতভাবে copy করাকে নিশ্চিত backup হিসেবে ধরা যাবে না।

## ৯. দৈনন্দিন দায়িত্বের প্রস্তাবিত ভাগ

1. **Bank Admin:** ব্যক্তিগত user account, সঠিক role ও branch association বজায় রাখবেন; কর্মী পরিবর্তনে active status সংশোধন করবেন।
2. **Branch User:** সঠিক তথ্য entry/import source দেবেন; status অনুসরণ করবেন; আসল item পাওয়ার পরে acknowledgement দেবেন।
3. **Manager:** request-এর account, quantity ও প্রয়োজন যাচাই করে approve/reject করবেন।
4. **GSD:** branch-গুলোর request ও অগ্রগতি পর্যবেক্ষণ করবেন; সমস্যা হলে bank/operations দলের সঙ্গে সমন্বয় করবেন।
5. **Vendor:** production data, serial, printing export, challan ও dispatch information যাচাই করে কাজ করবেন।
6. **Operations Admin:** operations account management, দলীয় তদারকি, backup ও local server পরিচালনার দায়িত্ব নির্ধারণ করবেন। Backup এখানে সাংগঠনিক দায়িত্ব; তৈরি হয়ে যাওয়া automatic feature নয়।

## ১০. কী পরীক্ষা হয়েছে, কী হয়নি

| বিষয় | বর্তমান যাচাই |
|---|---|
| Bank/operations login, ভুল password, logout | Browser পরীক্ষা হয়েছে |
| Manager portal-এর password compatibility | Local Bank Admin account দিয়ে hash compatibility পরীক্ষা হয়েছে |
| Branch User/Manager স্ক্রিন ও dashboard branch scope | Temporary test session দিয়ে পরীক্ষা হয়েছে; আসল role-account creation/login নয় |
| Dashboard, search, serial, challan, bill ও user-management screens | সংশ্লিষ্ট browser/page checks হয়েছে |
| Mobile menu, table filter, pagination, password toggle | Browser checks হয়েছে |
| PHP syntax | ১৬১টি application PHP file পাস করেছে |
| Existing XLS reading ও XLS write/read | পরীক্ষা হয়েছে |
| Paginated report export | Local download পরীক্ষা হয়েছে |
| প্রকৃত requisition entry/import → approve → order → dispatch → receipt | Live record দিয়ে সম্পূর্ণ পরীক্ষা হয়নি |
| User create/delete, role change ও branch পরিবর্তনের সব write action | Screen/code পরিদর্শন হয়েছে; সব submission পরীক্ষা হয়নি |
| GSD-এর সব কাজ, প্রতিটি report/printing export | পূর্ণ কার্যকরী পরীক্ষা হয়নি |
| Physical printing, courier, bank directory integration | পরীক্ষা হয়নি |

এই নির্দেশিকা তৈরির সময় database-এ ৭৭,০৭৫ cheque requisition ও ৩,০৭,৪৩৮ delivery/challan row আছে। দ্বিতীয় সংখ্যাটি delivered cheque book-এর সংখ্যা নয়; `del_challan` table-এর record count।

## ১১. বর্তমান সীমাবদ্ধতা ও নির্দিষ্ট অসামঞ্জস্য

- **Manual cheque entry:** `chk_request.php`-এর INSERT column list-এ `collecting_branch` ও `collecting_branch_code` দুবার আছে। Form খোলা যাচাই হয়েছে; submit-এর এই ত্রুটি সংশোধনের আগে নিয়মিত live entry শুরু করা ঠিক হবে না।
- **GSD rejected management:** GSD sidebar-এ rejected management link আছে, কিন্তু সংশ্লিষ্ট পুরোনো cheque-management পেজের role condition GSD/Admin-কে signin-এ পাঠায়। মেনু থাকা মানেই এ কাজ নির্ভরযোগ্যভাবে চালু নয়।
- **Permission enforcement:** কিছু পুরোনো পেজ JavaScript redirect ব্যবহার করে; সব write/export route-এ সমান server-side role/branch check যাচাই হয়নি। এই role table-কে সম্পূর্ণ access-control audit হিসেবে ব্যবহার করবেন না।
- **Import ও manual approval আলাদা:** imported record-এর status module অনুযায়ী আগে থেকেই Pending/Ordered হতে পারে; অনুমোদনের নীতি প্রতিষ্ঠানের দায়িত্বে নির্ধারণ করতে হবে।
- **Backend:** UI 2.0 হলেও বর্তমান application পুরোনো PHP 5.6 compatibility runtime ও legacy database code ব্যবহার করে। পূর্ণ backend migration হয়নি।
- **Deployment:** শুধু এই computer-এ local access চালু। Internet বা office-network production চালু করার আগে backend, permissions ও business workflow-এর আলাদা কাজ প্রয়োজন।

এই documentation-এর কাজ বর্তমান অবস্থা বোঝানো; উপরের ত্রুটিগুলো এই documentation তৈরির কাজে সফটওয়্যারে পরিবর্তন করে সংশোধন করা হয়নি।

## ১২. দরকারি ফাইল ও সহায়তা

| ফাইল/ফোল্ডার | ব্যবহার |
|---|---|
| `Start-Requisition.cmd` / `Stop-Requisition.cmd` | local software চালু/বন্ধ |
| `LOCAL-LOGIN.txt` | local test credentials; দায়িত্বপ্রাপ্ত ব্যক্তির জন্য |
| `README-LOCAL.md` | local setup ও runtime তথ্য |
| `UI-UPGRADE.md` | UI upgrade-এর পরিবর্তন ও যাচাই |
| `runtime/logs` | সমস্যা হলে diagnostic logs |
| `runtime/db-data` | কাজের database; ইচ্ছেমতো edit/delete করবেন না |
| `database-backup` | ZIP থেকে extracted original table backup |
| `ui-backup` | UI পরিবর্তনের আগের কিছু ফাইলের snapshot |

মূল source যাচাই: `aibl/body_content/left_menu.php`, `net/net_left_menu.php`, `ui/shell.php`, `ui/dashboard.php`, bank user-management, approval/acknowledgement, operations import/order/serial এবং pagination-এর কোড। Screenshot ও browser-check ফল `runtime/tmp`-এ আছে।
