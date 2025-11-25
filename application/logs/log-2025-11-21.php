<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

INFO - 2025-11-21 11:45:31 --> Config Class Initialized
INFO - 2025-11-21 11:45:31 --> Hooks Class Initialized
DEBUG - 2025-11-21 11:45:31 --> UTF-8 Support Enabled
INFO - 2025-11-21 11:45:31 --> Utf8 Class Initialized
INFO - 2025-11-21 11:45:31 --> URI Class Initialized
INFO - 2025-11-21 11:45:31 --> Router Class Initialized
INFO - 2025-11-21 11:45:31 --> Output Class Initialized
INFO - 2025-11-21 11:45:31 --> Security Class Initialized
DEBUG - 2025-11-21 11:45:31 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 11:45:31 --> Input Class Initialized
INFO - 2025-11-21 11:45:31 --> Language Class Initialized
INFO - 2025-11-21 11:45:31 --> Loader Class Initialized
INFO - 2025-11-21 11:45:31 --> Helper loaded: url_helper
INFO - 2025-11-21 11:45:31 --> Helper loaded: form_helper
INFO - 2025-11-21 11:45:31 --> Database Driver Class Initialized
DEBUG - 2025-11-21 11:45:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 11:45:31 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 11:45:31 --> Form Validation Class Initialized
INFO - 2025-11-21 11:45:31 --> Controller Class Initialized
DEBUG - 2025-11-21 11:45:31 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 11:45:31 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 11:45:31 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 11:45:31 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 11:45:32 --> Model Class Initialized
INFO - 2025-11-21 11:45:32 --> Model Class Initialized
INFO - 2025-11-21 11:45:32 --> Model Class Initialized
INFO - 2025-11-21 11:45:32 --> Model Class Initialized
INFO - 2025-11-21 11:45:32 --> Model Class Initialized
INFO - 2025-11-21 11:45:32 --> Model Class Initialized
DEBUG - 2025-11-21 11:45:32 --> Index loaded - Store: 7, Is Privileged: No
ERROR - 2025-11-21 11:45:32 --> Severity: Warning --> Undefined variable $page_title C:\xampp\htdocs\Inventory_CI\application\views\templates\header.php 7
INFO - 2025-11-21 11:45:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 11:45:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 11:45:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 11:45:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\orders/index.php
INFO - 2025-11-21 11:45:32 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 11:45:32 --> Final output sent to browser
DEBUG - 2025-11-21 11:45:32 --> Total execution time: 1.3590
INFO - 2025-11-21 11:45:33 --> Config Class Initialized
INFO - 2025-11-21 11:45:33 --> Hooks Class Initialized
DEBUG - 2025-11-21 11:45:33 --> UTF-8 Support Enabled
INFO - 2025-11-21 11:45:33 --> Utf8 Class Initialized
INFO - 2025-11-21 11:45:33 --> URI Class Initialized
INFO - 2025-11-21 11:45:33 --> Router Class Initialized
INFO - 2025-11-21 11:45:33 --> Output Class Initialized
INFO - 2025-11-21 11:45:33 --> Security Class Initialized
DEBUG - 2025-11-21 11:45:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 11:45:33 --> Input Class Initialized
INFO - 2025-11-21 11:45:33 --> Language Class Initialized
INFO - 2025-11-21 11:45:33 --> Loader Class Initialized
INFO - 2025-11-21 11:45:33 --> Helper loaded: url_helper
INFO - 2025-11-21 11:45:33 --> Helper loaded: form_helper
INFO - 2025-11-21 11:45:33 --> Database Driver Class Initialized
DEBUG - 2025-11-21 11:45:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 11:45:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 11:45:33 --> Form Validation Class Initialized
INFO - 2025-11-21 11:45:33 --> Controller Class Initialized
DEBUG - 2025-11-21 11:45:33 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 11:45:33 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 11:45:33 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 11:45:33 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 11:45:33 --> Model Class Initialized
INFO - 2025-11-21 11:45:33 --> Model Class Initialized
INFO - 2025-11-21 11:45:33 --> Model Class Initialized
INFO - 2025-11-21 11:45:33 --> Model Class Initialized
INFO - 2025-11-21 11:45:33 --> Model Class Initialized
INFO - 2025-11-21 11:45:33 --> Model Class Initialized
DEBUG - 2025-11-21 11:45:33 --> fetchOrdersData - Store ID: 7, Group ID: , Is Privileged: No
DEBUG - 2025-11-21 11:45:33 --> Adding store restriction for store_id: 7
DEBUG - 2025-11-21 11:45:33 --> Executing query: SELECT o.*,
                    COALESCE(s.name, 'N/A') as store_name,
                    COALESCE(u.username, 'Unknown') as clerk_name
                    FROM orders o
                    LEFT JOIN stores s ON o.store_id = s.id
                    LEFT JOIN users u ON o.user_id = u.id WHERE o.store_id = '7' ORDER BY o.id DESC
DEBUG - 2025-11-21 11:45:33 --> Query returned 970 results
DEBUG - 2025-11-21 11:45:33 --> Found 970 orders for user
INFO - 2025-11-21 11:45:33 --> Final output sent to browser
DEBUG - 2025-11-21 11:45:33 --> Total execution time: 0.1241
INFO - 2025-11-21 11:52:01 --> Config Class Initialized
INFO - 2025-11-21 11:52:01 --> Hooks Class Initialized
DEBUG - 2025-11-21 11:52:01 --> UTF-8 Support Enabled
INFO - 2025-11-21 11:52:01 --> Utf8 Class Initialized
INFO - 2025-11-21 11:52:01 --> URI Class Initialized
INFO - 2025-11-21 11:52:01 --> Router Class Initialized
INFO - 2025-11-21 11:52:01 --> Output Class Initialized
INFO - 2025-11-21 11:52:01 --> Security Class Initialized
DEBUG - 2025-11-21 11:52:01 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 11:52:01 --> Input Class Initialized
INFO - 2025-11-21 11:52:01 --> Language Class Initialized
INFO - 2025-11-21 11:52:01 --> Loader Class Initialized
INFO - 2025-11-21 11:52:01 --> Helper loaded: url_helper
INFO - 2025-11-21 11:52:01 --> Helper loaded: form_helper
INFO - 2025-11-21 11:52:01 --> Database Driver Class Initialized
DEBUG - 2025-11-21 11:52:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 11:52:02 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 11:52:02 --> Form Validation Class Initialized
INFO - 2025-11-21 11:52:02 --> Controller Class Initialized
DEBUG - 2025-11-21 11:52:02 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 11:52:02 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 11:52:02 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 11:52:02 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 11:52:02 --> Model Class Initialized
INFO - 2025-11-21 11:52:02 --> Model Class Initialized
INFO - 2025-11-21 11:52:02 --> Model Class Initialized
INFO - 2025-11-21 11:52:02 --> Model Class Initialized
INFO - 2025-11-21 11:52:02 --> Model Class Initialized
INFO - 2025-11-21 11:52:02 --> Model Class Initialized
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 78, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 138, purchased: 16, ordered: 0, stock: 16
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 79, purchased: 989, ordered: 8, stock: 981
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 80, purchased: 205, ordered: 47, stock: 158
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 81, purchased: 1996, ordered: 905, stock: 1091
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 139, purchased: 2, ordered: 1, stock: 1
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 82, purchased: 0, ordered: 7793, stock: 0
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 83, purchased: 0, ordered: 2784, stock: 0
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 84, purchased: 189, ordered: 17, stock: 172
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 85, purchased: 137, ordered: 3, stock: 134
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 127, purchased: 2000, ordered: 322, stock: 1678
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 86, purchased: 384, ordered: 334, stock: 50
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 87, purchased: 588, ordered: 517, stock: 71
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 88, purchased: 837, ordered: 508, stock: 329
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 89, purchased: 2114, ordered: 653, stock: 1461
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 90, purchased: 470, ordered: 284, stock: 186
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 126, purchased: 25, ordered: 0, stock: 25
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 91, purchased: 26, ordered: 0, stock: 26
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 92, purchased: 25, ordered: 24, stock: 1
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 93, purchased: 752, ordered: 854, stock: 0
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 94, purchased: 764, ordered: 572, stock: 192
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 95, purchased: 2263, ordered: 365, stock: 1898
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 96, purchased: 18856, ordered: 2884, stock: 15972
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 134, purchased: 604, ordered: 69, stock: 535
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 130, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 133, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 131, purchased: 19, ordered: 0, stock: 19
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 97, purchased: 5951, ordered: 2100, stock: 3851
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 98, purchased: 442, ordered: 39, stock: 403
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 99, purchased: 2, ordered: 0, stock: 2
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 100, purchased: 34587, ordered: 24797, stock: 9790
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 137, purchased: 189, ordered: 4, stock: 185
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 101, purchased: 107, ordered: 22, stock: 85
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 102, purchased: 9799, ordered: 6331, stock: 3468
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 103, purchased: 16701, ordered: 19033, stock: 0
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 104, purchased: 7500, ordered: 784, stock: 6716
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 142, purchased: 36, ordered: 0, stock: 36
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 140, purchased: 10, ordered: 0, stock: 10
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 105, purchased: 358, ordered: 186, stock: 172
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 106, purchased: 738, ordered: 631, stock: 107
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 125, purchased: 253, ordered: 0, stock: 253
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 108, purchased: 2503, ordered: 1967, stock: 536
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 109, purchased: 2571, ordered: 660, stock: 1911
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 110, purchased: 1616, ordered: 1459, stock: 157
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 132, purchased: 200, ordered: 175, stock: 25
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 111, purchased: 406, ordered: 77, stock: 329
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 112, purchased: 1900, ordered: 1273, stock: 627
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 113, purchased: 2241, ordered: 825, stock: 1416
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 135, purchased: 1990, ordered: 604, stock: 1386
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 114, purchased: 922, ordered: 45, stock: 877
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 115, purchased: 12262, ordered: 12445, stock: 0
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 116, purchased: 174549, ordered: 199150, stock: 0
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 107, purchased: 1200, ordered: 836, stock: 364
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 117, purchased: 8276, ordered: 5814, stock: 2462
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 118, purchased: 21409, ordered: 19411, stock: 1998
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 129, purchased: 1206, ordered: 1250, stock: 0
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 119, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 120, purchased: 758, ordered: 376, stock: 382
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 121, purchased: 63, ordered: 1, stock: 62
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 122, purchased: 688, ordered: 207, stock: 481
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 123, purchased: 2020, ordered: 1588, stock: 432
DEBUG - 2025-11-21 11:52:02 --> getProductsWithStock - ID: 124, purchased: 3646, ordered: 4439, stock: 0
DEBUG - 2025-11-21 11:52:02 --> Prepared products for create view: [{"id":78,"name":"BROILER BOOSTER","price":3000,"current_stock":0,"unit":""},{"id":138,"name":"BROILER EXTRA","price":3000,"current_stock":16,"unit":""},{"id":79,"name":"BROILER FINISHER MASH","price":1000,"current_stock":981,"unit":""},{"id":80,"name":"BROILER PREMIX","price":3000,"current_stock":158,"unit":""},{"id":81,"name":"BROILER STARTER MASH","price":1000,"current_stock":1091,"unit":""},{"id":139,"name":"CHIKWIDI","price":15000,"current_stock":1,"unit":""},{"id":82,"name":"CHOKAA","price":500,"current_stock":0,"unit":""},{"id":83,"name":"CHUMVI","price":500,"current_stock":0,"unit":""},{"id":84,"name":"D.C.P KOPO (1\/2)","price":2000,"current_stock":172,"unit":""},{"id":85,"name":"D.C.P KOPO 1KG","price":3000,"current_stock":134,"unit":""},{"id":127,"name":"D.C.P KUPIMA","price":1500,"current_stock":1678,"unit":""},{"id":86,"name":"DAGAA KAUZU","price":2800,"current_stock":50,"unit":""},{"id":87,"name":"DAGAA SAGWA","price":2000,"current_stock":71,"unit":""},{"id":88,"name":"DAMU","price":1500,"current_stock":329,"unit":""},{"id":89,"name":"GROWER MASH","price":1000,"current_stock":1461,"unit":""},{"id":90,"name":"HAMIRA","price":1500,"current_stock":186,"unit":""},{"id":126,"name":"HIPHOS PLUS","price":5000,"current_stock":25,"unit":""},{"id":91,"name":"JOSERA MADUME","price":11000,"current_stock":26,"unit":""},{"id":92,"name":"JOSERA MAZIWA","price":11000,"current_stock":1,"unit":""},{"id":93,"name":"KARANGA","price":700,"current_stock":0,"unit":""},{"id":94,"name":"KAUDIS NGURUWE","price":4000,"current_stock":192,"unit":""},{"id":95,"name":"KAYABO","price":2000,"current_stock":1898,"unit":""},{"id":96,"name":"KONOKONO","price":350,"current_stock":15972,"unit":""},{"id":134,"name":"KONOKONO NZIMA","price":400,"current_stock":535,"unit":""},{"id":130,"name":"KONOKONO SAGWA","price":470,"current_stock":0,"unit":""},{"id":133,"name":"KONOKONO SAGWA","price":600,"current_stock":0,"unit":""},{"id":131,"name":"LAYERS EXTRA","price":3500,"current_stock":19,"unit":""},{"id":97,"name":"LAYERS MASH","price":1000,"current_stock":3851,"unit":""},{"id":98,"name":"LAYERS PREMIX","price":3500,"current_stock":403,"unit":""},{"id":99,"name":"MADUME LICK","price":5000,"current_stock":2,"unit":""},{"id":100,"name":"MAHINDI","price":730,"current_stock":9790,"unit":""},{"id":137,"name":"MAZIWA MENGI 1KG","price":1500,"current_stock":185,"unit":""},{"id":101,"name":"MAZIWA MENGI 2kg","price":3000,"current_stock":85,"unit":""},{"id":102,"name":"MCHELE LAINI","price":400,"current_stock":3468,"unit":""},{"id":103,"name":"MCHELE NGUMU","price":320,"current_stock":0,"unit":""},{"id":104,"name":"MFUPA","price":700,"current_stock":6716,"unit":""},{"id":142,"name":"MOLLASSES 1LITRE","price":5000,"current_stock":36,"unit":""},{"id":140,"name":"MOLLASSES 5LITRE","price":15000,"current_stock":10,"unit":""},{"id":105,"name":"MTAMA","price":1000,"current_stock":172,"unit":""},{"id":106,"name":"NGANO","price":1000,"current_stock":107,"unit":""},{"id":125,"name":"NGURUWE MIX","price":3500,"current_stock":253,"unit":""},{"id":108,"name":"PAMBA LAINI","price":1200,"current_stock":536,"unit":""},{"id":109,"name":"PAMBA NGUMU","price":1200,"current_stock":1911,"unit":""},{"id":110,"name":"PARAZA","price":1000,"current_stock":157,"unit":""},{"id":132,"name":"PELLET FINISHER","price":2000,"current_stock":25,"unit":""},{"id":111,"name":"PIG BOOSTER","price":3000,"current_stock":329,"unit":""},{"id":112,"name":"PIG GROWER","price":1000,"current_stock":627,"unit":""},{"id":113,"name":"PIG STARTER","price":1000,"current_stock":1416,"unit":""},{"id":135,"name":"PILLET STARTER","price":2000,"current_stock":1386,"unit":""},{"id":114,"name":"PILLLET GROWER","price":2000,"current_stock":877,"unit":""},{"id":115,"name":"POLLARD","price":750,"current_stock":0,"unit":""},{"id":116,"name":"PUMBA","price":660,"current_stock":0,"unit":""},{"id":107,"name":"PUMBA MAHINDI LAINI","price":600,"current_stock":364,"unit":""},{"id":117,"name":"SHUDU LAINI","price":900,"current_stock":2462,"unit":""},{"id":118,"name":"SHUDU NGUMU","price":800,"current_stock":1998,"unit":""},{"id":129,"name":"SOYA CHENGA","price":2500,"current_stock":0,"unit":""},{"id":119,"name":"SOYA MAFUTA","price":2500,"current_stock":0,"unit":""},{"id":120,"name":"SOYA UNGA","price":2000,"current_stock":382,"unit":""},{"id":121,"name":"SUPER MACLICK","price":3500,"current_stock":62,"unit":""},{"id":122,"name":"UBUYU","price":700,"current_stock":481,"unit":""},{"id":123,"name":"UDUVI","price":3500,"current_stock":432,"unit":""},{"id":124,"name":"WHEAT","price":650,"current_stock":0,"unit":""}]
ERROR - 2025-11-21 11:52:02 --> Severity: Warning --> Undefined variable $page_title C:\xampp\htdocs\Inventory_CI\application\views\templates\header.php 7
INFO - 2025-11-21 11:52:02 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 11:52:02 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 11:52:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 11:52:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\orders/create.php
INFO - 2025-11-21 11:52:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 11:52:03 --> Final output sent to browser
DEBUG - 2025-11-21 11:52:03 --> Total execution time: 2.4599
INFO - 2025-11-21 11:52:03 --> Config Class Initialized
INFO - 2025-11-21 11:52:03 --> Hooks Class Initialized
DEBUG - 2025-11-21 11:52:03 --> UTF-8 Support Enabled
INFO - 2025-11-21 11:52:03 --> Utf8 Class Initialized
INFO - 2025-11-21 11:52:03 --> URI Class Initialized
INFO - 2025-11-21 11:52:03 --> Router Class Initialized
INFO - 2025-11-21 11:52:03 --> Output Class Initialized
INFO - 2025-11-21 11:52:03 --> Security Class Initialized
DEBUG - 2025-11-21 11:52:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 11:52:03 --> Input Class Initialized
INFO - 2025-11-21 11:52:03 --> Language Class Initialized
ERROR - 2025-11-21 11:52:03 --> 404 Page Not Found: Assets/plugins
INFO - 2025-11-21 11:52:03 --> Config Class Initialized
INFO - 2025-11-21 11:52:03 --> Hooks Class Initialized
DEBUG - 2025-11-21 11:52:03 --> UTF-8 Support Enabled
INFO - 2025-11-21 11:52:03 --> Utf8 Class Initialized
INFO - 2025-11-21 11:52:03 --> URI Class Initialized
INFO - 2025-11-21 11:52:03 --> Router Class Initialized
INFO - 2025-11-21 11:52:03 --> Output Class Initialized
INFO - 2025-11-21 11:52:03 --> Security Class Initialized
DEBUG - 2025-11-21 11:52:03 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 11:52:03 --> Input Class Initialized
INFO - 2025-11-21 11:52:03 --> Language Class Initialized
ERROR - 2025-11-21 11:52:03 --> 404 Page Not Found: Assets/plugins
INFO - 2025-11-21 11:53:36 --> Config Class Initialized
INFO - 2025-11-21 11:53:36 --> Hooks Class Initialized
DEBUG - 2025-11-21 11:53:36 --> UTF-8 Support Enabled
INFO - 2025-11-21 11:53:36 --> Utf8 Class Initialized
INFO - 2025-11-21 11:53:36 --> URI Class Initialized
INFO - 2025-11-21 11:53:36 --> Router Class Initialized
INFO - 2025-11-21 11:53:36 --> Output Class Initialized
INFO - 2025-11-21 11:53:36 --> Security Class Initialized
DEBUG - 2025-11-21 11:53:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 11:53:36 --> Input Class Initialized
INFO - 2025-11-21 11:53:36 --> Language Class Initialized
INFO - 2025-11-21 11:53:36 --> Loader Class Initialized
INFO - 2025-11-21 11:53:36 --> Helper loaded: url_helper
INFO - 2025-11-21 11:53:36 --> Helper loaded: form_helper
INFO - 2025-11-21 11:53:36 --> Database Driver Class Initialized
DEBUG - 2025-11-21 11:53:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 11:53:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 11:53:36 --> Form Validation Class Initialized
INFO - 2025-11-21 11:53:36 --> Controller Class Initialized
DEBUG - 2025-11-21 11:53:36 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 11:53:36 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 11:53:36 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 11:53:36 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 11:53:36 --> Model Class Initialized
INFO - 2025-11-21 11:53:36 --> Model Class Initialized
INFO - 2025-11-21 11:53:36 --> Model Class Initialized
INFO - 2025-11-21 11:53:36 --> Model Class Initialized
INFO - 2025-11-21 11:53:36 --> Model Class Initialized
INFO - 2025-11-21 11:53:36 --> Model Class Initialized
DEBUG - 2025-11-21 11:53:36 --> Controller_Orders::create POST: {"customer_name":"OMARI","customer_phone":"","customer_address":"","store_id":"7","product":["116","115"],"qty":["500","70"],"rate":["640.00","714.29"],"rate_value":["640.00","714.29"],"amount":["320000","50000"],"amount_value":["320000","50000"],"discount":"0","paid_status":"2","amount_paid":"370000.00","gross_amount_value":"370000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"370000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 11:53:37 --> Final output sent to browser
DEBUG - 2025-11-21 11:53:37 --> Total execution time: 0.3470
INFO - 2025-11-21 11:54:22 --> Config Class Initialized
INFO - 2025-11-21 11:54:22 --> Hooks Class Initialized
DEBUG - 2025-11-21 11:54:22 --> UTF-8 Support Enabled
INFO - 2025-11-21 11:54:22 --> Utf8 Class Initialized
INFO - 2025-11-21 11:54:22 --> URI Class Initialized
INFO - 2025-11-21 11:54:22 --> Router Class Initialized
INFO - 2025-11-21 11:54:22 --> Output Class Initialized
INFO - 2025-11-21 11:54:22 --> Security Class Initialized
DEBUG - 2025-11-21 11:54:22 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 11:54:22 --> Input Class Initialized
INFO - 2025-11-21 11:54:22 --> Language Class Initialized
INFO - 2025-11-21 11:54:22 --> Loader Class Initialized
INFO - 2025-11-21 11:54:22 --> Helper loaded: url_helper
INFO - 2025-11-21 11:54:22 --> Helper loaded: form_helper
INFO - 2025-11-21 11:54:22 --> Database Driver Class Initialized
DEBUG - 2025-11-21 11:54:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 11:54:22 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 11:54:22 --> Form Validation Class Initialized
INFO - 2025-11-21 11:54:22 --> Controller Class Initialized
DEBUG - 2025-11-21 11:54:22 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 11:54:22 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 11:54:22 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 11:54:22 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 11:54:22 --> Model Class Initialized
INFO - 2025-11-21 11:54:22 --> Model Class Initialized
INFO - 2025-11-21 11:54:22 --> Model Class Initialized
INFO - 2025-11-21 11:54:22 --> Model Class Initialized
INFO - 2025-11-21 11:54:22 --> Model Class Initialized
INFO - 2025-11-21 11:54:22 --> Model Class Initialized
DEBUG - 2025-11-21 11:54:22 --> Controller_Orders::create POST: {"customer_name":"EMMANUEL","customer_phone":"","customer_address":"","store_id":"7","product":["103"],"qty":["100"],"rate":["380"],"rate_value":["380"],"amount":["38000.00"],"amount_value":["38000.00"],"discount":"0","paid_status":"2","amount_paid":"38000.00","gross_amount_value":"38000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"38000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 11:54:22 --> Final output sent to browser
DEBUG - 2025-11-21 11:54:22 --> Total execution time: 0.1570
INFO - 2025-11-21 11:55:06 --> Config Class Initialized
INFO - 2025-11-21 11:55:06 --> Hooks Class Initialized
DEBUG - 2025-11-21 11:55:06 --> UTF-8 Support Enabled
INFO - 2025-11-21 11:55:06 --> Utf8 Class Initialized
INFO - 2025-11-21 11:55:06 --> URI Class Initialized
INFO - 2025-11-21 11:55:06 --> Router Class Initialized
INFO - 2025-11-21 11:55:06 --> Output Class Initialized
INFO - 2025-11-21 11:55:06 --> Security Class Initialized
DEBUG - 2025-11-21 11:55:06 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 11:55:06 --> Input Class Initialized
INFO - 2025-11-21 11:55:06 --> Language Class Initialized
INFO - 2025-11-21 11:55:06 --> Loader Class Initialized
INFO - 2025-11-21 11:55:06 --> Helper loaded: url_helper
INFO - 2025-11-21 11:55:06 --> Helper loaded: form_helper
INFO - 2025-11-21 11:55:06 --> Database Driver Class Initialized
DEBUG - 2025-11-21 11:55:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 11:55:06 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 11:55:06 --> Form Validation Class Initialized
INFO - 2025-11-21 11:55:06 --> Controller Class Initialized
DEBUG - 2025-11-21 11:55:06 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 11:55:06 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 11:55:06 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 11:55:06 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 11:55:06 --> Model Class Initialized
INFO - 2025-11-21 11:55:06 --> Model Class Initialized
INFO - 2025-11-21 11:55:06 --> Model Class Initialized
INFO - 2025-11-21 11:55:06 --> Model Class Initialized
INFO - 2025-11-21 11:55:06 --> Model Class Initialized
INFO - 2025-11-21 11:55:06 --> Model Class Initialized
DEBUG - 2025-11-21 11:55:06 --> Controller_Orders::create POST: {"customer_name":"MZEE MANY","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["50"],"rate":["650"],"rate_value":["650"],"amount":["32500.00"],"amount_value":["32500.00"],"discount":"0","paid_status":"1","amount_paid":"0.00","gross_amount_value":"32500.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"32500.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 11:55:06 --> Final output sent to browser
DEBUG - 2025-11-21 11:55:06 --> Total execution time: 0.1710
INFO - 2025-11-21 11:56:20 --> Config Class Initialized
INFO - 2025-11-21 11:56:20 --> Hooks Class Initialized
DEBUG - 2025-11-21 11:56:20 --> UTF-8 Support Enabled
INFO - 2025-11-21 11:56:20 --> Utf8 Class Initialized
INFO - 2025-11-21 11:56:20 --> URI Class Initialized
INFO - 2025-11-21 11:56:20 --> Router Class Initialized
INFO - 2025-11-21 11:56:20 --> Output Class Initialized
INFO - 2025-11-21 11:56:20 --> Security Class Initialized
DEBUG - 2025-11-21 11:56:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 11:56:20 --> Input Class Initialized
INFO - 2025-11-21 11:56:20 --> Language Class Initialized
INFO - 2025-11-21 11:56:20 --> Loader Class Initialized
INFO - 2025-11-21 11:56:20 --> Helper loaded: url_helper
INFO - 2025-11-21 11:56:20 --> Helper loaded: form_helper
INFO - 2025-11-21 11:56:20 --> Database Driver Class Initialized
DEBUG - 2025-11-21 11:56:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 11:56:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 11:56:20 --> Form Validation Class Initialized
INFO - 2025-11-21 11:56:20 --> Controller Class Initialized
DEBUG - 2025-11-21 11:56:20 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 11:56:20 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 11:56:20 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 11:56:20 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 11:56:20 --> Model Class Initialized
INFO - 2025-11-21 11:56:20 --> Model Class Initialized
INFO - 2025-11-21 11:56:20 --> Model Class Initialized
INFO - 2025-11-21 11:56:20 --> Model Class Initialized
INFO - 2025-11-21 11:56:20 --> Model Class Initialized
INFO - 2025-11-21 11:56:20 --> Model Class Initialized
DEBUG - 2025-11-21 11:56:20 --> Controller_Orders::create POST: {"customer_name":"MAU","customer_phone":"","customer_address":"","store_id":"7","product":["116","110"],"qty":["30","20"],"rate":["650.00","1000.00"],"rate_value":["650.00","1000.00"],"amount":["19500","20000.00"],"amount_value":["19500","20000.00"],"discount":"0","paid_status":"2","amount_paid":"39500.00","gross_amount_value":"39500.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"39500.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 11:56:20 --> Final output sent to browser
DEBUG - 2025-11-21 11:56:20 --> Total execution time: 0.1921
INFO - 2025-11-21 11:57:33 --> Config Class Initialized
INFO - 2025-11-21 11:57:33 --> Hooks Class Initialized
DEBUG - 2025-11-21 11:57:33 --> UTF-8 Support Enabled
INFO - 2025-11-21 11:57:33 --> Utf8 Class Initialized
INFO - 2025-11-21 11:57:33 --> URI Class Initialized
INFO - 2025-11-21 11:57:33 --> Router Class Initialized
INFO - 2025-11-21 11:57:33 --> Output Class Initialized
INFO - 2025-11-21 11:57:33 --> Security Class Initialized
DEBUG - 2025-11-21 11:57:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 11:57:33 --> Input Class Initialized
INFO - 2025-11-21 11:57:33 --> Language Class Initialized
INFO - 2025-11-21 11:57:33 --> Loader Class Initialized
INFO - 2025-11-21 11:57:33 --> Helper loaded: url_helper
INFO - 2025-11-21 11:57:33 --> Helper loaded: form_helper
INFO - 2025-11-21 11:57:33 --> Database Driver Class Initialized
DEBUG - 2025-11-21 11:57:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 11:57:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 11:57:33 --> Form Validation Class Initialized
INFO - 2025-11-21 11:57:33 --> Controller Class Initialized
DEBUG - 2025-11-21 11:57:33 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 11:57:33 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 11:57:33 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 11:57:33 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 11:57:33 --> Model Class Initialized
INFO - 2025-11-21 11:57:33 --> Model Class Initialized
INFO - 2025-11-21 11:57:33 --> Model Class Initialized
INFO - 2025-11-21 11:57:33 --> Model Class Initialized
INFO - 2025-11-21 11:57:33 --> Model Class Initialized
INFO - 2025-11-21 11:57:33 --> Model Class Initialized
DEBUG - 2025-11-21 11:57:33 --> Controller_Orders::create POST: {"customer_name":"JOSEH","customer_phone":"","customer_address":"","store_id":"7","product":["115"],"qty":["350"],"rate":["714.29"],"rate_value":["714.29"],"amount":["250000"],"amount_value":["250000"],"discount":"0","paid_status":"2","amount_paid":"250000.00","gross_amount_value":"250000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"250000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 11:57:34 --> Final output sent to browser
DEBUG - 2025-11-21 11:57:34 --> Total execution time: 0.3865
INFO - 2025-11-21 11:58:25 --> Config Class Initialized
INFO - 2025-11-21 11:58:25 --> Hooks Class Initialized
DEBUG - 2025-11-21 11:58:25 --> UTF-8 Support Enabled
INFO - 2025-11-21 11:58:25 --> Utf8 Class Initialized
INFO - 2025-11-21 11:58:25 --> URI Class Initialized
INFO - 2025-11-21 11:58:25 --> Router Class Initialized
INFO - 2025-11-21 11:58:25 --> Output Class Initialized
INFO - 2025-11-21 11:58:25 --> Security Class Initialized
DEBUG - 2025-11-21 11:58:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 11:58:25 --> Input Class Initialized
INFO - 2025-11-21 11:58:25 --> Language Class Initialized
INFO - 2025-11-21 11:58:25 --> Loader Class Initialized
INFO - 2025-11-21 11:58:25 --> Helper loaded: url_helper
INFO - 2025-11-21 11:58:25 --> Helper loaded: form_helper
INFO - 2025-11-21 11:58:25 --> Database Driver Class Initialized
DEBUG - 2025-11-21 11:58:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 11:58:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 11:58:25 --> Form Validation Class Initialized
INFO - 2025-11-21 11:58:25 --> Controller Class Initialized
DEBUG - 2025-11-21 11:58:25 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 11:58:25 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 11:58:25 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 11:58:25 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 11:58:25 --> Model Class Initialized
INFO - 2025-11-21 11:58:26 --> Model Class Initialized
INFO - 2025-11-21 11:58:26 --> Model Class Initialized
INFO - 2025-11-21 11:58:26 --> Model Class Initialized
INFO - 2025-11-21 11:58:26 --> Model Class Initialized
INFO - 2025-11-21 11:58:26 --> Model Class Initialized
DEBUG - 2025-11-21 11:58:26 --> Controller_Orders::create POST: {"customer_name":"OMARY","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["27.5"],"rate":["640.00"],"rate_value":["640.00"],"amount":["17600"],"amount_value":["17600"],"discount":"0","paid_status":"2","amount_paid":"17600.00","gross_amount_value":"17600.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"17600.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 11:58:26 --> Final output sent to browser
DEBUG - 2025-11-21 11:58:26 --> Total execution time: 0.1505
INFO - 2025-11-21 12:00:12 --> Config Class Initialized
INFO - 2025-11-21 12:00:12 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:00:12 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:00:12 --> Utf8 Class Initialized
INFO - 2025-11-21 12:00:12 --> URI Class Initialized
INFO - 2025-11-21 12:00:12 --> Router Class Initialized
INFO - 2025-11-21 12:00:12 --> Output Class Initialized
INFO - 2025-11-21 12:00:12 --> Security Class Initialized
DEBUG - 2025-11-21 12:00:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:00:12 --> Input Class Initialized
INFO - 2025-11-21 12:00:12 --> Language Class Initialized
INFO - 2025-11-21 12:00:12 --> Loader Class Initialized
INFO - 2025-11-21 12:00:12 --> Helper loaded: url_helper
INFO - 2025-11-21 12:00:12 --> Helper loaded: form_helper
INFO - 2025-11-21 12:00:12 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:00:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:00:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:00:12 --> Form Validation Class Initialized
INFO - 2025-11-21 12:00:12 --> Controller Class Initialized
DEBUG - 2025-11-21 12:00:12 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:00:12 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:00:12 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:00:12 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:00:12 --> Model Class Initialized
INFO - 2025-11-21 12:00:12 --> Model Class Initialized
INFO - 2025-11-21 12:00:12 --> Model Class Initialized
INFO - 2025-11-21 12:00:12 --> Model Class Initialized
INFO - 2025-11-21 12:00:12 --> Model Class Initialized
INFO - 2025-11-21 12:00:12 --> Model Class Initialized
DEBUG - 2025-11-21 12:00:12 --> Controller_Orders::create POST: {"customer_name":"MATHIAS","customer_phone":"","customer_address":"","store_id":"7","product":["116","89","110","117"],"qty":["10","6","2","1"],"rate":["650","1000.00","1000.00","1000"],"rate_value":["650","1000.00","1000.00","1000"],"amount":["6500.00","6000.00","2000.00","1000.00"],"amount_value":["6500.00","6000.00","2000.00","1000.00"],"discount":"0","paid_status":"2","amount_paid":"15500.00","gross_amount_value":"15500.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"15500.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:00:12 --> Final output sent to browser
DEBUG - 2025-11-21 12:00:12 --> Total execution time: 0.1559
INFO - 2025-11-21 12:01:26 --> Config Class Initialized
INFO - 2025-11-21 12:01:26 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:01:27 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:01:27 --> Utf8 Class Initialized
INFO - 2025-11-21 12:01:27 --> URI Class Initialized
INFO - 2025-11-21 12:01:27 --> Router Class Initialized
INFO - 2025-11-21 12:01:27 --> Output Class Initialized
INFO - 2025-11-21 12:01:27 --> Security Class Initialized
DEBUG - 2025-11-21 12:01:27 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:01:27 --> Input Class Initialized
INFO - 2025-11-21 12:01:27 --> Language Class Initialized
INFO - 2025-11-21 12:01:27 --> Loader Class Initialized
INFO - 2025-11-21 12:01:27 --> Helper loaded: url_helper
INFO - 2025-11-21 12:01:27 --> Helper loaded: form_helper
INFO - 2025-11-21 12:01:27 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:01:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:01:27 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:01:27 --> Form Validation Class Initialized
INFO - 2025-11-21 12:01:27 --> Controller Class Initialized
DEBUG - 2025-11-21 12:01:27 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:01:27 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:01:27 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:01:27 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:01:27 --> Model Class Initialized
INFO - 2025-11-21 12:01:27 --> Model Class Initialized
INFO - 2025-11-21 12:01:27 --> Model Class Initialized
INFO - 2025-11-21 12:01:27 --> Model Class Initialized
INFO - 2025-11-21 12:01:27 --> Model Class Initialized
INFO - 2025-11-21 12:01:27 --> Model Class Initialized
DEBUG - 2025-11-21 12:01:27 --> Controller_Orders::create POST: {"customer_name":"PAULO","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["100"],"rate":["640"],"rate_value":["640"],"amount":["64000.00"],"amount_value":["64000.00"],"discount":"0","paid_status":"2","amount_paid":"64000.00","gross_amount_value":"64000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"64000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:01:27 --> Final output sent to browser
DEBUG - 2025-11-21 12:01:27 --> Total execution time: 0.1774
INFO - 2025-11-21 12:01:54 --> Config Class Initialized
INFO - 2025-11-21 12:01:54 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:01:54 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:01:54 --> Utf8 Class Initialized
INFO - 2025-11-21 12:01:54 --> URI Class Initialized
INFO - 2025-11-21 12:01:54 --> Router Class Initialized
INFO - 2025-11-21 12:01:54 --> Output Class Initialized
INFO - 2025-11-21 12:01:54 --> Security Class Initialized
DEBUG - 2025-11-21 12:01:54 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:01:54 --> Input Class Initialized
INFO - 2025-11-21 12:01:54 --> Language Class Initialized
INFO - 2025-11-21 12:01:54 --> Loader Class Initialized
INFO - 2025-11-21 12:01:54 --> Helper loaded: url_helper
INFO - 2025-11-21 12:01:54 --> Helper loaded: form_helper
INFO - 2025-11-21 12:01:54 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:01:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:01:54 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:01:54 --> Form Validation Class Initialized
INFO - 2025-11-21 12:01:54 --> Controller Class Initialized
DEBUG - 2025-11-21 12:01:54 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:01:54 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:01:54 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:01:54 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:01:54 --> Model Class Initialized
INFO - 2025-11-21 12:01:54 --> Model Class Initialized
INFO - 2025-11-21 12:01:54 --> Model Class Initialized
INFO - 2025-11-21 12:01:54 --> Model Class Initialized
INFO - 2025-11-21 12:01:54 --> Model Class Initialized
INFO - 2025-11-21 12:01:54 --> Model Class Initialized
DEBUG - 2025-11-21 12:01:54 --> Controller_Orders::create POST: {"customer_name":"MUSSA","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["100"],"rate":["650"],"rate_value":["650"],"amount":["65000.00"],"amount_value":["65000.00"],"discount":"0","paid_status":"2","amount_paid":"65000.00","gross_amount_value":"65000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"65000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:01:54 --> Final output sent to browser
DEBUG - 2025-11-21 12:01:54 --> Total execution time: 0.1419
INFO - 2025-11-21 12:02:57 --> Config Class Initialized
INFO - 2025-11-21 12:02:57 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:02:57 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:02:57 --> Utf8 Class Initialized
INFO - 2025-11-21 12:02:57 --> URI Class Initialized
INFO - 2025-11-21 12:02:57 --> Router Class Initialized
INFO - 2025-11-21 12:02:57 --> Output Class Initialized
INFO - 2025-11-21 12:02:57 --> Security Class Initialized
DEBUG - 2025-11-21 12:02:57 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:02:57 --> Input Class Initialized
INFO - 2025-11-21 12:02:57 --> Language Class Initialized
INFO - 2025-11-21 12:02:57 --> Loader Class Initialized
INFO - 2025-11-21 12:02:57 --> Helper loaded: url_helper
INFO - 2025-11-21 12:02:57 --> Helper loaded: form_helper
INFO - 2025-11-21 12:02:57 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:02:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:02:57 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:02:57 --> Form Validation Class Initialized
INFO - 2025-11-21 12:02:57 --> Controller Class Initialized
DEBUG - 2025-11-21 12:02:57 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:02:57 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:02:57 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:02:57 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:02:57 --> Model Class Initialized
INFO - 2025-11-21 12:02:57 --> Model Class Initialized
INFO - 2025-11-21 12:02:57 --> Model Class Initialized
INFO - 2025-11-21 12:02:57 --> Model Class Initialized
INFO - 2025-11-21 12:02:57 --> Model Class Initialized
INFO - 2025-11-21 12:02:57 --> Model Class Initialized
DEBUG - 2025-11-21 12:02:57 --> Controller_Orders::create POST: {"customer_name":"PAULO","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["14"],"rate":["642.86"],"rate_value":["642.86"],"amount":["9000"],"amount_value":["9000"],"discount":"0","paid_status":"2","amount_paid":"9000.00","gross_amount_value":"9000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"9000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:02:58 --> Final output sent to browser
DEBUG - 2025-11-21 12:02:58 --> Total execution time: 0.1674
INFO - 2025-11-21 12:03:57 --> Config Class Initialized
INFO - 2025-11-21 12:03:57 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:03:57 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:03:57 --> Utf8 Class Initialized
INFO - 2025-11-21 12:03:57 --> URI Class Initialized
INFO - 2025-11-21 12:03:57 --> Router Class Initialized
INFO - 2025-11-21 12:03:57 --> Output Class Initialized
INFO - 2025-11-21 12:03:57 --> Security Class Initialized
DEBUG - 2025-11-21 12:03:57 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:03:57 --> Input Class Initialized
INFO - 2025-11-21 12:03:57 --> Language Class Initialized
INFO - 2025-11-21 12:03:57 --> Loader Class Initialized
INFO - 2025-11-21 12:03:57 --> Helper loaded: url_helper
INFO - 2025-11-21 12:03:57 --> Helper loaded: form_helper
INFO - 2025-11-21 12:03:57 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:03:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:03:57 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:03:57 --> Form Validation Class Initialized
INFO - 2025-11-21 12:03:57 --> Controller Class Initialized
DEBUG - 2025-11-21 12:03:57 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:03:57 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:03:57 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:03:57 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:03:57 --> Model Class Initialized
INFO - 2025-11-21 12:03:57 --> Model Class Initialized
INFO - 2025-11-21 12:03:57 --> Model Class Initialized
INFO - 2025-11-21 12:03:57 --> Model Class Initialized
INFO - 2025-11-21 12:03:57 --> Model Class Initialized
INFO - 2025-11-21 12:03:57 --> Model Class Initialized
DEBUG - 2025-11-21 12:03:57 --> Controller_Orders::create POST: {"customer_name":"WILSON","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["15.6"],"rate":["641.03"],"rate_value":["641.03"],"amount":["10000"],"amount_value":["10000"],"discount":"0","paid_status":"2","amount_paid":"10000.00","gross_amount_value":"10000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"10000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:03:57 --> Final output sent to browser
DEBUG - 2025-11-21 12:03:57 --> Total execution time: 0.1644
INFO - 2025-11-21 12:05:37 --> Config Class Initialized
INFO - 2025-11-21 12:05:37 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:05:37 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:05:37 --> Utf8 Class Initialized
INFO - 2025-11-21 12:05:37 --> URI Class Initialized
INFO - 2025-11-21 12:05:37 --> Router Class Initialized
INFO - 2025-11-21 12:05:37 --> Output Class Initialized
INFO - 2025-11-21 12:05:37 --> Security Class Initialized
DEBUG - 2025-11-21 12:05:37 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:05:37 --> Input Class Initialized
INFO - 2025-11-21 12:05:37 --> Language Class Initialized
INFO - 2025-11-21 12:05:37 --> Loader Class Initialized
INFO - 2025-11-21 12:05:37 --> Helper loaded: url_helper
INFO - 2025-11-21 12:05:37 --> Helper loaded: form_helper
INFO - 2025-11-21 12:05:37 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:05:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:05:37 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:05:37 --> Form Validation Class Initialized
INFO - 2025-11-21 12:05:37 --> Controller Class Initialized
DEBUG - 2025-11-21 12:05:37 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:05:37 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:05:37 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:05:37 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:05:37 --> Model Class Initialized
INFO - 2025-11-21 12:05:37 --> Model Class Initialized
INFO - 2025-11-21 12:05:37 --> Model Class Initialized
INFO - 2025-11-21 12:05:37 --> Model Class Initialized
INFO - 2025-11-21 12:05:37 --> Model Class Initialized
INFO - 2025-11-21 12:05:37 --> Model Class Initialized
DEBUG - 2025-11-21 12:05:37 --> Controller_Orders::create POST: {"customer_name":"CASHIER","customer_phone":"","customer_address":"","store_id":"7","product":["116","115"],"qty":["100","13.7"],"rate":["650","802.92"],"rate_value":["650","802.92"],"amount":["65000.00","11000"],"amount_value":["65000.00","11000"],"discount":"0","paid_status":"2","amount_paid":"76000.00","gross_amount_value":"76000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"76000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:05:37 --> Final output sent to browser
DEBUG - 2025-11-21 12:05:37 --> Total execution time: 0.2318
INFO - 2025-11-21 12:06:13 --> Config Class Initialized
INFO - 2025-11-21 12:06:13 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:06:13 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:06:13 --> Utf8 Class Initialized
INFO - 2025-11-21 12:06:13 --> URI Class Initialized
INFO - 2025-11-21 12:06:13 --> Router Class Initialized
INFO - 2025-11-21 12:06:13 --> Output Class Initialized
INFO - 2025-11-21 12:06:13 --> Security Class Initialized
DEBUG - 2025-11-21 12:06:13 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:06:13 --> Input Class Initialized
INFO - 2025-11-21 12:06:13 --> Language Class Initialized
INFO - 2025-11-21 12:06:13 --> Loader Class Initialized
INFO - 2025-11-21 12:06:13 --> Helper loaded: url_helper
INFO - 2025-11-21 12:06:13 --> Helper loaded: form_helper
INFO - 2025-11-21 12:06:13 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:06:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:06:13 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:06:13 --> Form Validation Class Initialized
INFO - 2025-11-21 12:06:13 --> Controller Class Initialized
DEBUG - 2025-11-21 12:06:13 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:06:13 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:06:13 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:06:13 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:06:13 --> Model Class Initialized
INFO - 2025-11-21 12:06:13 --> Model Class Initialized
INFO - 2025-11-21 12:06:13 --> Model Class Initialized
INFO - 2025-11-21 12:06:13 --> Model Class Initialized
INFO - 2025-11-21 12:06:13 --> Model Class Initialized
INFO - 2025-11-21 12:06:13 --> Model Class Initialized
DEBUG - 2025-11-21 12:06:13 --> Controller_Orders::create POST: {"customer_name":"M.BABU","customer_phone":"","customer_address":"","store_id":"7","product":["115"],"qty":["140"],"rate":["714.29"],"rate_value":["714.29"],"amount":["100000"],"amount_value":["100000"],"discount":"0","paid_status":"2","amount_paid":"100000.00","gross_amount_value":"100000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"100000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:06:13 --> Final output sent to browser
DEBUG - 2025-11-21 12:06:13 --> Total execution time: 0.1998
INFO - 2025-11-21 12:06:42 --> Config Class Initialized
INFO - 2025-11-21 12:06:42 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:06:42 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:06:42 --> Utf8 Class Initialized
INFO - 2025-11-21 12:06:42 --> URI Class Initialized
INFO - 2025-11-21 12:06:42 --> Router Class Initialized
INFO - 2025-11-21 12:06:42 --> Output Class Initialized
INFO - 2025-11-21 12:06:42 --> Security Class Initialized
DEBUG - 2025-11-21 12:06:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:06:42 --> Input Class Initialized
INFO - 2025-11-21 12:06:42 --> Language Class Initialized
INFO - 2025-11-21 12:06:42 --> Loader Class Initialized
INFO - 2025-11-21 12:06:42 --> Helper loaded: url_helper
INFO - 2025-11-21 12:06:42 --> Helper loaded: form_helper
INFO - 2025-11-21 12:06:42 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:06:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:06:42 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:06:42 --> Form Validation Class Initialized
INFO - 2025-11-21 12:06:42 --> Controller Class Initialized
DEBUG - 2025-11-21 12:06:42 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:06:42 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:06:42 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:06:42 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:06:42 --> Model Class Initialized
INFO - 2025-11-21 12:06:42 --> Model Class Initialized
INFO - 2025-11-21 12:06:42 --> Model Class Initialized
INFO - 2025-11-21 12:06:42 --> Model Class Initialized
INFO - 2025-11-21 12:06:42 --> Model Class Initialized
INFO - 2025-11-21 12:06:42 --> Model Class Initialized
DEBUG - 2025-11-21 12:06:42 --> Controller_Orders::create POST: {"customer_name":"ABEL","customer_phone":"","customer_address":"","store_id":"7","product":["115"],"qty":["70"],"rate":["714.29"],"rate_value":["714.29"],"amount":["50000"],"amount_value":["50000"],"discount":"0","paid_status":"2","amount_paid":"50000.00","gross_amount_value":"50000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"50000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:06:42 --> Final output sent to browser
DEBUG - 2025-11-21 12:06:42 --> Total execution time: 0.1613
INFO - 2025-11-21 12:07:53 --> Config Class Initialized
INFO - 2025-11-21 12:07:53 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:07:53 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:07:53 --> Utf8 Class Initialized
INFO - 2025-11-21 12:07:53 --> URI Class Initialized
INFO - 2025-11-21 12:07:53 --> Router Class Initialized
INFO - 2025-11-21 12:07:53 --> Output Class Initialized
INFO - 2025-11-21 12:07:53 --> Security Class Initialized
DEBUG - 2025-11-21 12:07:53 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:07:53 --> Input Class Initialized
INFO - 2025-11-21 12:07:53 --> Language Class Initialized
INFO - 2025-11-21 12:07:53 --> Loader Class Initialized
INFO - 2025-11-21 12:07:53 --> Helper loaded: url_helper
INFO - 2025-11-21 12:07:53 --> Helper loaded: form_helper
INFO - 2025-11-21 12:07:53 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:07:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:07:53 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:07:53 --> Form Validation Class Initialized
INFO - 2025-11-21 12:07:53 --> Controller Class Initialized
DEBUG - 2025-11-21 12:07:53 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:07:53 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:07:53 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:07:53 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:07:53 --> Model Class Initialized
INFO - 2025-11-21 12:07:53 --> Model Class Initialized
INFO - 2025-11-21 12:07:53 --> Model Class Initialized
INFO - 2025-11-21 12:07:53 --> Model Class Initialized
INFO - 2025-11-21 12:07:53 --> Model Class Initialized
INFO - 2025-11-21 12:07:53 --> Model Class Initialized
DEBUG - 2025-11-21 12:07:53 --> Controller_Orders::create POST: {"customer_name":"SINORAY","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["50"],"rate":["640.00"],"rate_value":["640.00"],"amount":["32000"],"amount_value":["32000"],"discount":"0","paid_status":"2","amount_paid":"32000.00","gross_amount_value":"32000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"32000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:07:53 --> Final output sent to browser
DEBUG - 2025-11-21 12:07:53 --> Total execution time: 0.1340
INFO - 2025-11-21 12:10:01 --> Config Class Initialized
INFO - 2025-11-21 12:10:01 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:10:01 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:10:01 --> Utf8 Class Initialized
INFO - 2025-11-21 12:10:01 --> URI Class Initialized
INFO - 2025-11-21 12:10:01 --> Router Class Initialized
INFO - 2025-11-21 12:10:01 --> Output Class Initialized
INFO - 2025-11-21 12:10:01 --> Security Class Initialized
DEBUG - 2025-11-21 12:10:01 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:10:01 --> Input Class Initialized
INFO - 2025-11-21 12:10:01 --> Language Class Initialized
INFO - 2025-11-21 12:10:01 --> Loader Class Initialized
INFO - 2025-11-21 12:10:01 --> Helper loaded: url_helper
INFO - 2025-11-21 12:10:01 --> Helper loaded: form_helper
INFO - 2025-11-21 12:10:01 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:10:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:10:01 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:10:01 --> Form Validation Class Initialized
INFO - 2025-11-21 12:10:01 --> Controller Class Initialized
DEBUG - 2025-11-21 12:10:01 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:10:01 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:10:01 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:10:01 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:10:01 --> Model Class Initialized
INFO - 2025-11-21 12:10:01 --> Model Class Initialized
INFO - 2025-11-21 12:10:01 --> Model Class Initialized
INFO - 2025-11-21 12:10:01 --> Model Class Initialized
INFO - 2025-11-21 12:10:01 --> Model Class Initialized
INFO - 2025-11-21 12:10:01 --> Model Class Initialized
DEBUG - 2025-11-21 12:10:01 --> Controller_Orders::create POST: {"customer_name":"NDEENI","customer_phone":"","customer_address":"","store_id":"7","product":["94","87","116","115"],"qty":["10","10","100","70"],"rate":["4000.00","2000.00","640.00","714.29"],"rate_value":["4000.00","2000.00","640.00","714.29"],"amount":["40000.00","20000.00","64000.00","50000"],"amount_value":["40000.00","20000.00","64000.00","50000"],"discount":"0","paid_status":"1","amount_paid":"0.00","gross_amount_value":"174000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"174000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:10:01 --> Final output sent to browser
DEBUG - 2025-11-21 12:10:01 --> Total execution time: 0.2400
INFO - 2025-11-21 12:10:29 --> Config Class Initialized
INFO - 2025-11-21 12:10:29 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:10:29 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:10:29 --> Utf8 Class Initialized
INFO - 2025-11-21 12:10:29 --> URI Class Initialized
INFO - 2025-11-21 12:10:29 --> Router Class Initialized
INFO - 2025-11-21 12:10:29 --> Output Class Initialized
INFO - 2025-11-21 12:10:29 --> Security Class Initialized
DEBUG - 2025-11-21 12:10:29 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:10:29 --> Input Class Initialized
INFO - 2025-11-21 12:10:29 --> Language Class Initialized
INFO - 2025-11-21 12:10:29 --> Loader Class Initialized
INFO - 2025-11-21 12:10:29 --> Helper loaded: url_helper
INFO - 2025-11-21 12:10:29 --> Helper loaded: form_helper
INFO - 2025-11-21 12:10:29 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:10:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:10:29 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:10:29 --> Form Validation Class Initialized
INFO - 2025-11-21 12:10:29 --> Controller Class Initialized
DEBUG - 2025-11-21 12:10:29 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:10:29 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:10:29 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:10:29 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:10:29 --> Model Class Initialized
INFO - 2025-11-21 12:10:29 --> Model Class Initialized
INFO - 2025-11-21 12:10:29 --> Model Class Initialized
INFO - 2025-11-21 12:10:29 --> Model Class Initialized
INFO - 2025-11-21 12:10:29 --> Model Class Initialized
INFO - 2025-11-21 12:10:29 --> Model Class Initialized
DEBUG - 2025-11-21 12:10:29 --> Controller_Orders::create POST: {"customer_name":"TWAHA","customer_phone":"","customer_address":"","store_id":"7","product":["100"],"qty":["100"],"rate":["750"],"rate_value":["750"],"amount":["75000.00"],"amount_value":["75000.00"],"discount":"0","paid_status":"1","amount_paid":"0.00","gross_amount_value":"75000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"75000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:10:29 --> Final output sent to browser
DEBUG - 2025-11-21 12:10:29 --> Total execution time: 0.1455
INFO - 2025-11-21 12:11:29 --> Config Class Initialized
INFO - 2025-11-21 12:11:29 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:11:29 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:11:29 --> Utf8 Class Initialized
INFO - 2025-11-21 12:11:29 --> URI Class Initialized
INFO - 2025-11-21 12:11:29 --> Router Class Initialized
INFO - 2025-11-21 12:11:29 --> Output Class Initialized
INFO - 2025-11-21 12:11:29 --> Security Class Initialized
DEBUG - 2025-11-21 12:11:29 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:11:29 --> Input Class Initialized
INFO - 2025-11-21 12:11:29 --> Language Class Initialized
INFO - 2025-11-21 12:11:29 --> Loader Class Initialized
INFO - 2025-11-21 12:11:29 --> Helper loaded: url_helper
INFO - 2025-11-21 12:11:29 --> Helper loaded: form_helper
INFO - 2025-11-21 12:11:29 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:11:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:11:29 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:11:29 --> Form Validation Class Initialized
INFO - 2025-11-21 12:11:29 --> Controller Class Initialized
DEBUG - 2025-11-21 12:11:29 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:11:29 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:11:29 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:11:29 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:11:29 --> Model Class Initialized
INFO - 2025-11-21 12:11:29 --> Model Class Initialized
INFO - 2025-11-21 12:11:29 --> Model Class Initialized
INFO - 2025-11-21 12:11:29 --> Model Class Initialized
INFO - 2025-11-21 12:11:29 --> Model Class Initialized
INFO - 2025-11-21 12:11:29 --> Model Class Initialized
DEBUG - 2025-11-21 12:11:29 --> Controller_Orders::create POST: {"customer_name":"AMANI","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["50"],"rate":["640.00"],"rate_value":["640.00"],"amount":["32000"],"amount_value":["32000"],"discount":"0","paid_status":"2","amount_paid":"32000.00","gross_amount_value":"32000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"32000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:11:29 --> Final output sent to browser
DEBUG - 2025-11-21 12:11:29 --> Total execution time: 0.2368
INFO - 2025-11-21 12:13:45 --> Config Class Initialized
INFO - 2025-11-21 12:13:45 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:13:45 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:13:45 --> Utf8 Class Initialized
INFO - 2025-11-21 12:13:45 --> URI Class Initialized
INFO - 2025-11-21 12:13:45 --> Router Class Initialized
INFO - 2025-11-21 12:13:45 --> Output Class Initialized
INFO - 2025-11-21 12:13:45 --> Security Class Initialized
DEBUG - 2025-11-21 12:13:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:13:45 --> Input Class Initialized
INFO - 2025-11-21 12:13:45 --> Language Class Initialized
INFO - 2025-11-21 12:13:45 --> Loader Class Initialized
INFO - 2025-11-21 12:13:45 --> Helper loaded: url_helper
INFO - 2025-11-21 12:13:45 --> Helper loaded: form_helper
INFO - 2025-11-21 12:13:45 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:13:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:13:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:13:45 --> Form Validation Class Initialized
INFO - 2025-11-21 12:13:45 --> Controller Class Initialized
DEBUG - 2025-11-21 12:13:45 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:13:45 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:13:45 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:13:45 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:13:45 --> Model Class Initialized
INFO - 2025-11-21 12:13:45 --> Model Class Initialized
INFO - 2025-11-21 12:13:45 --> Model Class Initialized
INFO - 2025-11-21 12:13:45 --> Model Class Initialized
INFO - 2025-11-21 12:13:45 --> Model Class Initialized
INFO - 2025-11-21 12:13:45 --> Model Class Initialized
DEBUG - 2025-11-21 12:13:45 --> Controller_Orders::create POST: {"customer_name":"EDWARD","customer_phone":"","customer_address":"","store_id":"7","product":["116","123"],"qty":["1017.1","35"],"rate":["630.00","2428.57"],"rate_value":["630.00","2428.57"],"amount":["640773","85000"],"amount_value":["640773","85000"],"discount":"0","paid_status":"2","amount_paid":"725773.00","gross_amount_value":"725773.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"725773.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:13:45 --> Final output sent to browser
DEBUG - 2025-11-21 12:13:45 --> Total execution time: 0.1475
INFO - 2025-11-21 12:25:02 --> Config Class Initialized
INFO - 2025-11-21 12:25:02 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:25:02 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:25:02 --> Utf8 Class Initialized
INFO - 2025-11-21 12:25:02 --> URI Class Initialized
INFO - 2025-11-21 12:25:02 --> Router Class Initialized
INFO - 2025-11-21 12:25:02 --> Output Class Initialized
INFO - 2025-11-21 12:25:02 --> Security Class Initialized
DEBUG - 2025-11-21 12:25:02 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:25:02 --> Input Class Initialized
INFO - 2025-11-21 12:25:02 --> Language Class Initialized
INFO - 2025-11-21 12:25:02 --> Loader Class Initialized
INFO - 2025-11-21 12:25:02 --> Helper loaded: url_helper
INFO - 2025-11-21 12:25:02 --> Helper loaded: form_helper
INFO - 2025-11-21 12:25:02 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:25:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:25:02 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:25:02 --> Form Validation Class Initialized
INFO - 2025-11-21 12:25:02 --> Controller Class Initialized
DEBUG - 2025-11-21 12:25:02 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:25:02 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:25:02 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:25:02 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:25:02 --> Model Class Initialized
INFO - 2025-11-21 12:25:02 --> Model Class Initialized
INFO - 2025-11-21 12:25:02 --> Model Class Initialized
INFO - 2025-11-21 12:25:02 --> Model Class Initialized
INFO - 2025-11-21 12:25:02 --> Model Class Initialized
INFO - 2025-11-21 12:25:02 --> Model Class Initialized
DEBUG - 2025-11-21 12:25:02 --> Controller_Orders::create POST: {"customer_name":"MINJA","customer_phone":"","customer_address":"","store_id":"7","product":["116","102","118"],"qty":["25","25","8"],"rate":["650","450.00","800.00"],"rate_value":["650","450.00","800.00"],"amount":["16250.00","11250","6400.00"],"amount_value":["16250.00","11250","6400.00"],"discount":"0","paid_status":"2","amount_paid":"33900.00","gross_amount_value":"33900.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"33900.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:25:02 --> Final output sent to browser
DEBUG - 2025-11-21 12:25:02 --> Total execution time: 0.1429
INFO - 2025-11-21 12:26:41 --> Config Class Initialized
INFO - 2025-11-21 12:26:41 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:26:41 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:26:41 --> Utf8 Class Initialized
INFO - 2025-11-21 12:26:41 --> URI Class Initialized
INFO - 2025-11-21 12:26:41 --> Router Class Initialized
INFO - 2025-11-21 12:26:41 --> Output Class Initialized
INFO - 2025-11-21 12:26:41 --> Security Class Initialized
DEBUG - 2025-11-21 12:26:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:26:41 --> Input Class Initialized
INFO - 2025-11-21 12:26:41 --> Language Class Initialized
INFO - 2025-11-21 12:26:41 --> Loader Class Initialized
INFO - 2025-11-21 12:26:41 --> Helper loaded: url_helper
INFO - 2025-11-21 12:26:41 --> Helper loaded: form_helper
INFO - 2025-11-21 12:26:41 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:26:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:26:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:26:41 --> Form Validation Class Initialized
INFO - 2025-11-21 12:26:41 --> Controller Class Initialized
DEBUG - 2025-11-21 12:26:41 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:26:41 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:26:41 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:26:41 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:26:41 --> Model Class Initialized
INFO - 2025-11-21 12:26:41 --> Model Class Initialized
INFO - 2025-11-21 12:26:41 --> Model Class Initialized
INFO - 2025-11-21 12:26:41 --> Model Class Initialized
INFO - 2025-11-21 12:26:41 --> Model Class Initialized
INFO - 2025-11-21 12:26:41 --> Model Class Initialized
DEBUG - 2025-11-21 12:26:41 --> Controller_Orders::create POST: {"customer_name":"DIWANI","customer_phone":"","customer_address":"","store_id":"7","product":["116","103"],"qty":["550","250"],"rate":["650.00","380.00"],"rate_value":["650.00","380.00"],"amount":["357500","95000"],"amount_value":["357500","95000"],"discount":"0","paid_status":"2","amount_paid":"452500.00","gross_amount_value":"452500.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"452500.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:26:41 --> Final output sent to browser
DEBUG - 2025-11-21 12:26:41 --> Total execution time: 0.1354
INFO - 2025-11-21 12:28:55 --> Config Class Initialized
INFO - 2025-11-21 12:28:55 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:28:55 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:28:55 --> Utf8 Class Initialized
INFO - 2025-11-21 12:28:55 --> URI Class Initialized
INFO - 2025-11-21 12:28:55 --> Router Class Initialized
INFO - 2025-11-21 12:28:55 --> Output Class Initialized
INFO - 2025-11-21 12:28:55 --> Security Class Initialized
DEBUG - 2025-11-21 12:28:55 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:28:55 --> Input Class Initialized
INFO - 2025-11-21 12:28:55 --> Language Class Initialized
INFO - 2025-11-21 12:28:55 --> Loader Class Initialized
INFO - 2025-11-21 12:28:55 --> Helper loaded: url_helper
INFO - 2025-11-21 12:28:55 --> Helper loaded: form_helper
INFO - 2025-11-21 12:28:55 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:28:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:28:55 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:28:55 --> Form Validation Class Initialized
INFO - 2025-11-21 12:28:55 --> Controller Class Initialized
DEBUG - 2025-11-21 12:28:55 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:28:55 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:28:55 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:28:55 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:28:55 --> Model Class Initialized
INFO - 2025-11-21 12:28:55 --> Model Class Initialized
INFO - 2025-11-21 12:28:55 --> Model Class Initialized
INFO - 2025-11-21 12:28:55 --> Model Class Initialized
INFO - 2025-11-21 12:28:55 --> Model Class Initialized
INFO - 2025-11-21 12:28:55 --> Model Class Initialized
DEBUG - 2025-11-21 12:28:55 --> Controller_Orders::create POST: {"customer_name":"M.JOSHUA","customer_phone":"","customer_address":"","store_id":"7","product":["116","86","87","117","82","110"],"qty":["50","1","1","3","1","2"],"rate":["640.00","2800.00","2000.00","900.00","500.00","1000.00"],"rate_value":["640.00","2800.00","2000.00","900.00","500.00","1000.00"],"amount":["32000.00","2800.00","2000.00","2700.00","500.00","2000.00"],"amount_value":["32000.00","2800.00","2000.00","2700.00","500.00","2000.00"],"discount":"0","paid_status":"2","amount_paid":"42000.00","gross_amount_value":"42000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"42000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:28:55 --> Final output sent to browser
DEBUG - 2025-11-21 12:28:55 --> Total execution time: 0.1590
INFO - 2025-11-21 12:36:39 --> Config Class Initialized
INFO - 2025-11-21 12:36:39 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:36:39 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:36:39 --> Utf8 Class Initialized
INFO - 2025-11-21 12:36:39 --> URI Class Initialized
INFO - 2025-11-21 12:36:39 --> Router Class Initialized
INFO - 2025-11-21 12:36:39 --> Output Class Initialized
INFO - 2025-11-21 12:36:39 --> Security Class Initialized
DEBUG - 2025-11-21 12:36:39 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:36:39 --> Input Class Initialized
INFO - 2025-11-21 12:36:39 --> Language Class Initialized
INFO - 2025-11-21 12:36:39 --> Loader Class Initialized
INFO - 2025-11-21 12:36:39 --> Helper loaded: url_helper
INFO - 2025-11-21 12:36:39 --> Helper loaded: form_helper
INFO - 2025-11-21 12:36:39 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:36:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:36:39 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:36:39 --> Form Validation Class Initialized
INFO - 2025-11-21 12:36:39 --> Controller Class Initialized
DEBUG - 2025-11-21 12:36:39 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:36:39 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:36:39 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:36:39 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:36:39 --> Model Class Initialized
INFO - 2025-11-21 12:36:39 --> Model Class Initialized
INFO - 2025-11-21 12:36:39 --> Model Class Initialized
INFO - 2025-11-21 12:36:39 --> Model Class Initialized
INFO - 2025-11-21 12:36:39 --> Model Class Initialized
INFO - 2025-11-21 12:36:39 --> Model Class Initialized
DEBUG - 2025-11-21 12:36:39 --> Controller_Orders::create POST: {"customer_name":"HARUNA","customer_phone":"","customer_address":"","store_id":"7","product":["116","117","123","106","105","110"],"qty":["250","25","35","10","10","10"],"rate":["650.00","900.00","2428.57","1000.00","1000.00","1000.00"],"rate_value":["650.00","900.00","2428.57","1000.00","1000.00","1000.00"],"amount":["162500.00","22500.00","85000","10000.00","10000.00","10000.00"],"amount_value":["162500.00","22500.00","85000","10000.00","10000.00","10000.00"],"discount":"0","paid_status":"2","amount_paid":"300000.00","gross_amount_value":"300000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"300000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:36:39 --> Final output sent to browser
DEBUG - 2025-11-21 12:36:39 --> Total execution time: 0.2082
INFO - 2025-11-21 12:37:23 --> Config Class Initialized
INFO - 2025-11-21 12:37:23 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:37:23 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:37:23 --> Utf8 Class Initialized
INFO - 2025-11-21 12:37:23 --> URI Class Initialized
INFO - 2025-11-21 12:37:23 --> Router Class Initialized
INFO - 2025-11-21 12:37:23 --> Output Class Initialized
INFO - 2025-11-21 12:37:23 --> Security Class Initialized
DEBUG - 2025-11-21 12:37:23 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:37:23 --> Input Class Initialized
INFO - 2025-11-21 12:37:23 --> Language Class Initialized
INFO - 2025-11-21 12:37:23 --> Loader Class Initialized
INFO - 2025-11-21 12:37:23 --> Helper loaded: url_helper
INFO - 2025-11-21 12:37:23 --> Helper loaded: form_helper
INFO - 2025-11-21 12:37:23 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:37:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:37:23 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:37:23 --> Form Validation Class Initialized
INFO - 2025-11-21 12:37:23 --> Controller Class Initialized
DEBUG - 2025-11-21 12:37:23 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:37:23 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:37:23 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:37:23 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:37:23 --> Model Class Initialized
INFO - 2025-11-21 12:37:23 --> Model Class Initialized
INFO - 2025-11-21 12:37:23 --> Model Class Initialized
INFO - 2025-11-21 12:37:23 --> Model Class Initialized
INFO - 2025-11-21 12:37:23 --> Model Class Initialized
INFO - 2025-11-21 12:37:23 --> Model Class Initialized
DEBUG - 2025-11-21 12:37:23 --> Controller_Orders::create POST: {"customer_name":"JOSE","customer_phone":"","customer_address":"","store_id":"7","product":["123","105"],"qty":["2","5"],"rate":["3500.00","1000.00"],"rate_value":["3500.00","1000.00"],"amount":["7000.00","5000.00"],"amount_value":["7000.00","5000.00"],"discount":"0","paid_status":"2","amount_paid":"12000.00","gross_amount_value":"12000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"12000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:37:23 --> Final output sent to browser
DEBUG - 2025-11-21 12:37:23 --> Total execution time: 0.1621
INFO - 2025-11-21 12:38:07 --> Config Class Initialized
INFO - 2025-11-21 12:38:07 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:38:07 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:38:07 --> Utf8 Class Initialized
INFO - 2025-11-21 12:38:07 --> URI Class Initialized
INFO - 2025-11-21 12:38:07 --> Router Class Initialized
INFO - 2025-11-21 12:38:07 --> Output Class Initialized
INFO - 2025-11-21 12:38:07 --> Security Class Initialized
DEBUG - 2025-11-21 12:38:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:38:07 --> Input Class Initialized
INFO - 2025-11-21 12:38:07 --> Language Class Initialized
INFO - 2025-11-21 12:38:07 --> Loader Class Initialized
INFO - 2025-11-21 12:38:07 --> Helper loaded: url_helper
INFO - 2025-11-21 12:38:07 --> Helper loaded: form_helper
INFO - 2025-11-21 12:38:07 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:38:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:38:07 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:38:07 --> Form Validation Class Initialized
INFO - 2025-11-21 12:38:07 --> Controller Class Initialized
DEBUG - 2025-11-21 12:38:07 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:38:07 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:38:07 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:38:07 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:38:07 --> Model Class Initialized
INFO - 2025-11-21 12:38:07 --> Model Class Initialized
INFO - 2025-11-21 12:38:07 --> Model Class Initialized
INFO - 2025-11-21 12:38:07 --> Model Class Initialized
INFO - 2025-11-21 12:38:07 --> Model Class Initialized
INFO - 2025-11-21 12:38:07 --> Model Class Initialized
DEBUG - 2025-11-21 12:38:07 --> Controller_Orders::create POST: {"customer_name":"JEREMIAH","customer_phone":"","customer_address":"","store_id":"7","product":["103"],"qty":["450"],"rate":["380"],"rate_value":["380"],"amount":["171000.00"],"amount_value":["171000.00"],"discount":"0","paid_status":"2","amount_paid":"171000.00","gross_amount_value":"171000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"171000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:38:07 --> Final output sent to browser
DEBUG - 2025-11-21 12:38:07 --> Total execution time: 0.1584
INFO - 2025-11-21 12:39:15 --> Config Class Initialized
INFO - 2025-11-21 12:39:15 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:39:15 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:39:15 --> Utf8 Class Initialized
INFO - 2025-11-21 12:39:15 --> URI Class Initialized
INFO - 2025-11-21 12:39:15 --> Router Class Initialized
INFO - 2025-11-21 12:39:15 --> Output Class Initialized
INFO - 2025-11-21 12:39:15 --> Security Class Initialized
DEBUG - 2025-11-21 12:39:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:39:15 --> Input Class Initialized
INFO - 2025-11-21 12:39:15 --> Language Class Initialized
INFO - 2025-11-21 12:39:15 --> Loader Class Initialized
INFO - 2025-11-21 12:39:15 --> Helper loaded: url_helper
INFO - 2025-11-21 12:39:15 --> Helper loaded: form_helper
INFO - 2025-11-21 12:39:15 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:39:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:39:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:39:15 --> Form Validation Class Initialized
INFO - 2025-11-21 12:39:15 --> Controller Class Initialized
DEBUG - 2025-11-21 12:39:15 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:39:15 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:39:15 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:39:15 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:39:15 --> Model Class Initialized
INFO - 2025-11-21 12:39:15 --> Model Class Initialized
INFO - 2025-11-21 12:39:15 --> Model Class Initialized
INFO - 2025-11-21 12:39:15 --> Model Class Initialized
INFO - 2025-11-21 12:39:15 --> Model Class Initialized
INFO - 2025-11-21 12:39:15 --> Model Class Initialized
DEBUG - 2025-11-21 12:39:15 --> Controller_Orders::create POST: {"customer_name":"LAZARO","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["1000"],"rate":["640"],"rate_value":["640"],"amount":["640000.00"],"amount_value":["640000.00"],"discount":"0","paid_status":"2","amount_paid":"640000.00","gross_amount_value":"640000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"640000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:39:15 --> Final output sent to browser
DEBUG - 2025-11-21 12:39:15 --> Total execution time: 0.1337
INFO - 2025-11-21 12:39:52 --> Config Class Initialized
INFO - 2025-11-21 12:39:52 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:39:52 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:39:52 --> Utf8 Class Initialized
INFO - 2025-11-21 12:39:52 --> URI Class Initialized
INFO - 2025-11-21 12:39:52 --> Router Class Initialized
INFO - 2025-11-21 12:39:52 --> Output Class Initialized
INFO - 2025-11-21 12:39:52 --> Security Class Initialized
DEBUG - 2025-11-21 12:39:52 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:39:52 --> Input Class Initialized
INFO - 2025-11-21 12:39:52 --> Language Class Initialized
INFO - 2025-11-21 12:39:52 --> Loader Class Initialized
INFO - 2025-11-21 12:39:52 --> Helper loaded: url_helper
INFO - 2025-11-21 12:39:52 --> Helper loaded: form_helper
INFO - 2025-11-21 12:39:52 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:39:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:39:52 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:39:52 --> Form Validation Class Initialized
INFO - 2025-11-21 12:39:52 --> Controller Class Initialized
DEBUG - 2025-11-21 12:39:52 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:39:52 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:39:52 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:39:52 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:39:52 --> Model Class Initialized
INFO - 2025-11-21 12:39:52 --> Model Class Initialized
INFO - 2025-11-21 12:39:52 --> Model Class Initialized
INFO - 2025-11-21 12:39:52 --> Model Class Initialized
INFO - 2025-11-21 12:39:52 --> Model Class Initialized
INFO - 2025-11-21 12:39:52 --> Model Class Initialized
DEBUG - 2025-11-21 12:39:52 --> Controller_Orders::create POST: {"customer_name":"MTEJA","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["500"],"rate":["640.00"],"rate_value":["640.00"],"amount":["320000"],"amount_value":["320000"],"discount":"0","paid_status":"2","amount_paid":"320000.00","gross_amount_value":"320000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"320000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:39:52 --> Final output sent to browser
DEBUG - 2025-11-21 12:39:52 --> Total execution time: 0.1400
INFO - 2025-11-21 12:41:14 --> Config Class Initialized
INFO - 2025-11-21 12:41:14 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:41:14 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:41:14 --> Utf8 Class Initialized
INFO - 2025-11-21 12:41:14 --> URI Class Initialized
INFO - 2025-11-21 12:41:14 --> Router Class Initialized
INFO - 2025-11-21 12:41:14 --> Output Class Initialized
INFO - 2025-11-21 12:41:14 --> Security Class Initialized
DEBUG - 2025-11-21 12:41:14 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:41:14 --> Input Class Initialized
INFO - 2025-11-21 12:41:14 --> Language Class Initialized
INFO - 2025-11-21 12:41:14 --> Loader Class Initialized
INFO - 2025-11-21 12:41:14 --> Helper loaded: url_helper
INFO - 2025-11-21 12:41:14 --> Helper loaded: form_helper
INFO - 2025-11-21 12:41:14 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:41:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:41:14 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:41:14 --> Form Validation Class Initialized
INFO - 2025-11-21 12:41:14 --> Controller Class Initialized
DEBUG - 2025-11-21 12:41:14 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:41:14 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:41:14 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:41:14 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:41:14 --> Model Class Initialized
INFO - 2025-11-21 12:41:14 --> Model Class Initialized
INFO - 2025-11-21 12:41:14 --> Model Class Initialized
INFO - 2025-11-21 12:41:14 --> Model Class Initialized
INFO - 2025-11-21 12:41:14 --> Model Class Initialized
INFO - 2025-11-21 12:41:14 --> Model Class Initialized
DEBUG - 2025-11-21 12:41:14 --> Controller_Orders::create POST: {"customer_name":"M.GODLISTEN","customer_phone":"","customer_address":"","store_id":"7","product":["116","108"],"qty":["10","10"],"rate":["650","1200.00"],"rate_value":["650","1200.00"],"amount":["6500.00","12000.00"],"amount_value":["6500.00","12000.00"],"discount":"0","paid_status":"2","amount_paid":"18500.00","gross_amount_value":"18500.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"18500.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:41:14 --> Final output sent to browser
DEBUG - 2025-11-21 12:41:14 --> Total execution time: 0.1959
INFO - 2025-11-21 12:43:59 --> Config Class Initialized
INFO - 2025-11-21 12:43:59 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:43:59 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:43:59 --> Utf8 Class Initialized
INFO - 2025-11-21 12:43:59 --> URI Class Initialized
INFO - 2025-11-21 12:43:59 --> Router Class Initialized
INFO - 2025-11-21 12:43:59 --> Output Class Initialized
INFO - 2025-11-21 12:43:59 --> Security Class Initialized
DEBUG - 2025-11-21 12:43:59 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:43:59 --> Input Class Initialized
INFO - 2025-11-21 12:43:59 --> Language Class Initialized
INFO - 2025-11-21 12:43:59 --> Loader Class Initialized
INFO - 2025-11-21 12:43:59 --> Helper loaded: url_helper
INFO - 2025-11-21 12:43:59 --> Helper loaded: form_helper
INFO - 2025-11-21 12:43:59 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:43:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:43:59 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:43:59 --> Form Validation Class Initialized
INFO - 2025-11-21 12:43:59 --> Controller Class Initialized
DEBUG - 2025-11-21 12:43:59 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:43:59 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:43:59 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:43:59 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:43:59 --> Model Class Initialized
INFO - 2025-11-21 12:43:59 --> Model Class Initialized
INFO - 2025-11-21 12:43:59 --> Model Class Initialized
INFO - 2025-11-21 12:43:59 --> Model Class Initialized
INFO - 2025-11-21 12:43:59 --> Model Class Initialized
INFO - 2025-11-21 12:43:59 --> Model Class Initialized
DEBUG - 2025-11-21 12:43:59 --> Controller_Orders::create POST: {"customer_name":"MLESHU","customer_phone":"","customer_address":"","store_id":"7","product":["102","116","117","87","111","127"],"qty":["100","100","50","20","3","5"],"rate":["450.00","650.00","900.00","2000.00","3000.00","1500.00"],"rate_value":["450.00","650.00","900.00","2000.00","3000.00","1500.00"],"amount":["45000.00","65000","45000.00","40000.00","9000.00","7500.00"],"amount_value":["45000.00","65000","45000.00","40000.00","9000.00","7500.00"],"discount":"0","paid_status":"2","amount_paid":"211500.00","gross_amount_value":"211500.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"211500.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:43:59 --> Final output sent to browser
DEBUG - 2025-11-21 12:43:59 --> Total execution time: 0.3015
INFO - 2025-11-21 12:44:51 --> Config Class Initialized
INFO - 2025-11-21 12:44:51 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:44:51 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:44:51 --> Utf8 Class Initialized
INFO - 2025-11-21 12:44:51 --> URI Class Initialized
INFO - 2025-11-21 12:44:51 --> Router Class Initialized
INFO - 2025-11-21 12:44:51 --> Output Class Initialized
INFO - 2025-11-21 12:44:51 --> Security Class Initialized
DEBUG - 2025-11-21 12:44:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:44:51 --> Input Class Initialized
INFO - 2025-11-21 12:44:51 --> Language Class Initialized
INFO - 2025-11-21 12:44:51 --> Loader Class Initialized
INFO - 2025-11-21 12:44:51 --> Helper loaded: url_helper
INFO - 2025-11-21 12:44:51 --> Helper loaded: form_helper
INFO - 2025-11-21 12:44:51 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:44:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:44:51 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:44:51 --> Form Validation Class Initialized
INFO - 2025-11-21 12:44:51 --> Controller Class Initialized
DEBUG - 2025-11-21 12:44:51 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:44:51 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:44:51 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:44:51 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:44:51 --> Model Class Initialized
INFO - 2025-11-21 12:44:51 --> Model Class Initialized
INFO - 2025-11-21 12:44:51 --> Model Class Initialized
INFO - 2025-11-21 12:44:51 --> Model Class Initialized
INFO - 2025-11-21 12:44:51 --> Model Class Initialized
INFO - 2025-11-21 12:44:51 --> Model Class Initialized
DEBUG - 2025-11-21 12:44:51 --> Controller_Orders::create POST: {"customer_name":"PUMBA","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["2"],"rate":["750.00"],"rate_value":["750.00"],"amount":["1500"],"amount_value":["1500"],"discount":"0","paid_status":"2","amount_paid":"1500.00","gross_amount_value":"1500.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"1500.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:44:51 --> Final output sent to browser
DEBUG - 2025-11-21 12:44:51 --> Total execution time: 0.1784
INFO - 2025-11-21 12:46:01 --> Config Class Initialized
INFO - 2025-11-21 12:46:01 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:46:01 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:46:01 --> Utf8 Class Initialized
INFO - 2025-11-21 12:46:01 --> URI Class Initialized
INFO - 2025-11-21 12:46:01 --> Router Class Initialized
INFO - 2025-11-21 12:46:01 --> Output Class Initialized
INFO - 2025-11-21 12:46:01 --> Security Class Initialized
DEBUG - 2025-11-21 12:46:01 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:46:01 --> Input Class Initialized
INFO - 2025-11-21 12:46:01 --> Language Class Initialized
INFO - 2025-11-21 12:46:01 --> Loader Class Initialized
INFO - 2025-11-21 12:46:01 --> Helper loaded: url_helper
INFO - 2025-11-21 12:46:01 --> Helper loaded: form_helper
INFO - 2025-11-21 12:46:01 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:46:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:46:01 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:46:01 --> Form Validation Class Initialized
INFO - 2025-11-21 12:46:01 --> Controller Class Initialized
DEBUG - 2025-11-21 12:46:01 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:46:01 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:46:01 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:46:01 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:46:01 --> Model Class Initialized
INFO - 2025-11-21 12:46:01 --> Model Class Initialized
INFO - 2025-11-21 12:46:01 --> Model Class Initialized
INFO - 2025-11-21 12:46:01 --> Model Class Initialized
INFO - 2025-11-21 12:46:01 --> Model Class Initialized
INFO - 2025-11-21 12:46:01 --> Model Class Initialized
DEBUG - 2025-11-21 12:46:01 --> Controller_Orders::create POST: {"customer_name":"KASANGA","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["50"],"rate":["640"],"rate_value":["640"],"amount":["32000.00"],"amount_value":["32000.00"],"discount":"0","paid_status":"2","amount_paid":"32000.00","gross_amount_value":"32000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"32000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:46:02 --> Final output sent to browser
DEBUG - 2025-11-21 12:46:02 --> Total execution time: 0.4764
INFO - 2025-11-21 12:47:41 --> Config Class Initialized
INFO - 2025-11-21 12:47:41 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:47:41 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:47:41 --> Utf8 Class Initialized
INFO - 2025-11-21 12:47:41 --> URI Class Initialized
INFO - 2025-11-21 12:47:41 --> Router Class Initialized
INFO - 2025-11-21 12:47:41 --> Output Class Initialized
INFO - 2025-11-21 12:47:41 --> Security Class Initialized
DEBUG - 2025-11-21 12:47:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:47:41 --> Input Class Initialized
INFO - 2025-11-21 12:47:41 --> Language Class Initialized
INFO - 2025-11-21 12:47:41 --> Loader Class Initialized
INFO - 2025-11-21 12:47:41 --> Helper loaded: url_helper
INFO - 2025-11-21 12:47:41 --> Helper loaded: form_helper
INFO - 2025-11-21 12:47:41 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:47:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:47:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:47:41 --> Form Validation Class Initialized
INFO - 2025-11-21 12:47:41 --> Controller Class Initialized
DEBUG - 2025-11-21 12:47:41 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:47:41 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:47:41 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:47:41 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:47:41 --> Model Class Initialized
INFO - 2025-11-21 12:47:41 --> Model Class Initialized
INFO - 2025-11-21 12:47:41 --> Model Class Initialized
INFO - 2025-11-21 12:47:41 --> Model Class Initialized
INFO - 2025-11-21 12:47:41 --> Model Class Initialized
INFO - 2025-11-21 12:47:41 --> Model Class Initialized
DEBUG - 2025-11-21 12:47:41 --> Controller_Orders::create POST: {"customer_name":"JENNY","customer_phone":"","customer_address":"","store_id":"7","product":["116","117","108"],"qty":["800","50","50"],"rate":["640","900.00","1200.00"],"rate_value":["640","900.00","1200.00"],"amount":["512000.00","45000.00","60000.00"],"amount_value":["512000.00","45000.00","60000.00"],"discount":"0","paid_status":"2","amount_paid":"617000.00","gross_amount_value":"617000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"617000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:47:41 --> Final output sent to browser
DEBUG - 2025-11-21 12:47:41 --> Total execution time: 0.1462
INFO - 2025-11-21 12:48:21 --> Config Class Initialized
INFO - 2025-11-21 12:48:21 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:48:21 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:48:21 --> Utf8 Class Initialized
INFO - 2025-11-21 12:48:21 --> URI Class Initialized
INFO - 2025-11-21 12:48:21 --> Router Class Initialized
INFO - 2025-11-21 12:48:21 --> Output Class Initialized
INFO - 2025-11-21 12:48:21 --> Security Class Initialized
DEBUG - 2025-11-21 12:48:21 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:48:21 --> Input Class Initialized
INFO - 2025-11-21 12:48:21 --> Language Class Initialized
INFO - 2025-11-21 12:48:21 --> Loader Class Initialized
INFO - 2025-11-21 12:48:21 --> Helper loaded: url_helper
INFO - 2025-11-21 12:48:21 --> Helper loaded: form_helper
INFO - 2025-11-21 12:48:21 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:48:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:48:21 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:48:21 --> Form Validation Class Initialized
INFO - 2025-11-21 12:48:21 --> Controller Class Initialized
DEBUG - 2025-11-21 12:48:21 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:48:21 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:48:21 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:48:21 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:48:21 --> Model Class Initialized
INFO - 2025-11-21 12:48:21 --> Model Class Initialized
INFO - 2025-11-21 12:48:21 --> Model Class Initialized
INFO - 2025-11-21 12:48:21 --> Model Class Initialized
INFO - 2025-11-21 12:48:21 --> Model Class Initialized
INFO - 2025-11-21 12:48:21 --> Model Class Initialized
DEBUG - 2025-11-21 12:48:21 --> Controller_Orders::create POST: {"customer_name":"JEREMIAH","customer_phone":"","customer_address":"","store_id":"7","product":["103"],"qty":["450"],"rate":["380"],"rate_value":["380"],"amount":["171000.00"],"amount_value":["171000.00"],"discount":"0","paid_status":"2","amount_paid":"171000.00","gross_amount_value":"171000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"171000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:48:21 --> Final output sent to browser
DEBUG - 2025-11-21 12:48:21 --> Total execution time: 0.1336
INFO - 2025-11-21 12:49:34 --> Config Class Initialized
INFO - 2025-11-21 12:49:34 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:49:34 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:49:34 --> Utf8 Class Initialized
INFO - 2025-11-21 12:49:34 --> URI Class Initialized
INFO - 2025-11-21 12:49:34 --> Router Class Initialized
INFO - 2025-11-21 12:49:34 --> Output Class Initialized
INFO - 2025-11-21 12:49:34 --> Security Class Initialized
DEBUG - 2025-11-21 12:49:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:49:34 --> Input Class Initialized
INFO - 2025-11-21 12:49:34 --> Language Class Initialized
INFO - 2025-11-21 12:49:34 --> Loader Class Initialized
INFO - 2025-11-21 12:49:34 --> Helper loaded: url_helper
INFO - 2025-11-21 12:49:34 --> Helper loaded: form_helper
INFO - 2025-11-21 12:49:34 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:49:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:49:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:49:34 --> Form Validation Class Initialized
INFO - 2025-11-21 12:49:34 --> Controller Class Initialized
DEBUG - 2025-11-21 12:49:34 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:49:34 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:49:34 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:49:34 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:49:34 --> Model Class Initialized
INFO - 2025-11-21 12:49:34 --> Model Class Initialized
INFO - 2025-11-21 12:49:34 --> Model Class Initialized
INFO - 2025-11-21 12:49:34 --> Model Class Initialized
INFO - 2025-11-21 12:49:34 --> Model Class Initialized
INFO - 2025-11-21 12:49:34 --> Model Class Initialized
DEBUG - 2025-11-21 12:49:34 --> Controller_Orders::create POST: {"customer_name":"JENNY","customer_phone":"","customer_address":"","store_id":"7","product":["115"],"qty":["140"],"rate":["714.29"],"rate_value":["714.29"],"amount":["100000"],"amount_value":["100000"],"discount":"0","paid_status":"2","amount_paid":"100000.00","gross_amount_value":"100000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"100000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:49:34 --> Final output sent to browser
DEBUG - 2025-11-21 12:49:34 --> Total execution time: 0.1532
INFO - 2025-11-21 12:50:33 --> Config Class Initialized
INFO - 2025-11-21 12:50:33 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:50:33 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:50:33 --> Utf8 Class Initialized
INFO - 2025-11-21 12:50:33 --> URI Class Initialized
INFO - 2025-11-21 12:50:33 --> Router Class Initialized
INFO - 2025-11-21 12:50:33 --> Output Class Initialized
INFO - 2025-11-21 12:50:33 --> Security Class Initialized
DEBUG - 2025-11-21 12:50:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:50:33 --> Input Class Initialized
INFO - 2025-11-21 12:50:33 --> Language Class Initialized
INFO - 2025-11-21 12:50:33 --> Loader Class Initialized
INFO - 2025-11-21 12:50:33 --> Helper loaded: url_helper
INFO - 2025-11-21 12:50:33 --> Helper loaded: form_helper
INFO - 2025-11-21 12:50:33 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:50:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:50:33 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:50:33 --> Form Validation Class Initialized
INFO - 2025-11-21 12:50:33 --> Controller Class Initialized
DEBUG - 2025-11-21 12:50:33 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:50:33 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:50:33 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:50:33 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:50:33 --> Model Class Initialized
INFO - 2025-11-21 12:50:33 --> Model Class Initialized
INFO - 2025-11-21 12:50:33 --> Model Class Initialized
INFO - 2025-11-21 12:50:33 --> Model Class Initialized
INFO - 2025-11-21 12:50:33 --> Model Class Initialized
INFO - 2025-11-21 12:50:33 --> Model Class Initialized
DEBUG - 2025-11-21 12:50:33 --> Controller_Orders::create POST: {"customer_name":"M.NAOMI","customer_phone":"","customer_address":"","store_id":"7","product":["116","123"],"qty":["4","0.5"],"rate":["640.00","3500.00"],"rate_value":["640.00","3500.00"],"amount":["2560","1750.00"],"amount_value":["2560","1750.00"],"discount":"0","paid_status":"2","amount_paid":"4310.00","gross_amount_value":"4310.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"4310.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:50:33 --> Final output sent to browser
DEBUG - 2025-11-21 12:50:33 --> Total execution time: 0.1592
INFO - 2025-11-21 12:51:24 --> Config Class Initialized
INFO - 2025-11-21 12:51:24 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:51:24 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:51:24 --> Utf8 Class Initialized
INFO - 2025-11-21 12:51:24 --> URI Class Initialized
INFO - 2025-11-21 12:51:24 --> Router Class Initialized
INFO - 2025-11-21 12:51:24 --> Output Class Initialized
INFO - 2025-11-21 12:51:24 --> Security Class Initialized
DEBUG - 2025-11-21 12:51:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:51:24 --> Input Class Initialized
INFO - 2025-11-21 12:51:24 --> Language Class Initialized
INFO - 2025-11-21 12:51:24 --> Loader Class Initialized
INFO - 2025-11-21 12:51:24 --> Helper loaded: url_helper
INFO - 2025-11-21 12:51:24 --> Helper loaded: form_helper
INFO - 2025-11-21 12:51:24 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:51:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:51:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:51:24 --> Form Validation Class Initialized
INFO - 2025-11-21 12:51:24 --> Controller Class Initialized
DEBUG - 2025-11-21 12:51:24 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:51:24 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:51:24 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:51:24 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:51:24 --> Model Class Initialized
INFO - 2025-11-21 12:51:24 --> Model Class Initialized
INFO - 2025-11-21 12:51:24 --> Model Class Initialized
INFO - 2025-11-21 12:51:24 --> Model Class Initialized
INFO - 2025-11-21 12:51:24 --> Model Class Initialized
INFO - 2025-11-21 12:51:24 --> Model Class Initialized
DEBUG - 2025-11-21 12:51:24 --> Controller_Orders::create POST: {"customer_name":"M.JENNY","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["150"],"rate":["640"],"rate_value":["640"],"amount":["96000.00"],"amount_value":["96000.00"],"discount":"0","paid_status":"2","amount_paid":"96000.00","gross_amount_value":"96000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"96000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 12:51:24 --> Final output sent to browser
DEBUG - 2025-11-21 12:51:24 --> Total execution time: 0.1419
INFO - 2025-11-21 12:55:02 --> Config Class Initialized
INFO - 2025-11-21 12:55:02 --> Hooks Class Initialized
DEBUG - 2025-11-21 12:55:02 --> UTF-8 Support Enabled
INFO - 2025-11-21 12:55:02 --> Utf8 Class Initialized
INFO - 2025-11-21 12:55:02 --> URI Class Initialized
INFO - 2025-11-21 12:55:02 --> Router Class Initialized
INFO - 2025-11-21 12:55:02 --> Output Class Initialized
INFO - 2025-11-21 12:55:02 --> Security Class Initialized
DEBUG - 2025-11-21 12:55:02 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 12:55:02 --> Input Class Initialized
INFO - 2025-11-21 12:55:02 --> Language Class Initialized
INFO - 2025-11-21 12:55:03 --> Loader Class Initialized
INFO - 2025-11-21 12:55:03 --> Helper loaded: url_helper
INFO - 2025-11-21 12:55:03 --> Helper loaded: form_helper
INFO - 2025-11-21 12:55:03 --> Database Driver Class Initialized
DEBUG - 2025-11-21 12:55:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 12:55:03 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 12:55:03 --> Form Validation Class Initialized
INFO - 2025-11-21 12:55:03 --> Controller Class Initialized
DEBUG - 2025-11-21 12:55:03 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 12:55:03 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 12:55:03 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 12:55:03 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 12:55:03 --> Model Class Initialized
INFO - 2025-11-21 12:55:03 --> Model Class Initialized
INFO - 2025-11-21 12:55:03 --> Model Class Initialized
ERROR - 2025-11-21 12:55:03 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 12:55:03 --> Model Class Initialized
INFO - 2025-11-21 12:55:03 --> Model Class Initialized
INFO - 2025-11-21 12:55:03 --> Model Class Initialized
INFO - 2025-11-21 12:55:03 --> Model Class Initialized
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 12:55:03 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 12:55:03 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 12:55:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 12:55:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 12:55:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 12:55:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 12:55:03 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 12:55:03 --> Final output sent to browser
DEBUG - 2025-11-21 12:55:03 --> Total execution time: 1.0483
INFO - 2025-11-21 13:03:24 --> Config Class Initialized
INFO - 2025-11-21 13:03:24 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:03:24 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:03:24 --> Utf8 Class Initialized
INFO - 2025-11-21 13:03:24 --> URI Class Initialized
INFO - 2025-11-21 13:03:24 --> Router Class Initialized
INFO - 2025-11-21 13:03:24 --> Output Class Initialized
INFO - 2025-11-21 13:03:24 --> Security Class Initialized
DEBUG - 2025-11-21 13:03:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:03:24 --> Input Class Initialized
INFO - 2025-11-21 13:03:24 --> Language Class Initialized
INFO - 2025-11-21 13:03:24 --> Loader Class Initialized
INFO - 2025-11-21 13:03:24 --> Helper loaded: url_helper
INFO - 2025-11-21 13:03:24 --> Helper loaded: form_helper
INFO - 2025-11-21 13:03:24 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:03:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:03:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:03:24 --> Form Validation Class Initialized
INFO - 2025-11-21 13:03:24 --> Controller Class Initialized
DEBUG - 2025-11-21 13:03:24 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:03:24 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:03:24 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:03:24 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:03:24 --> Model Class Initialized
INFO - 2025-11-21 13:03:24 --> Model Class Initialized
INFO - 2025-11-21 13:03:24 --> Model Class Initialized
INFO - 2025-11-21 13:03:24 --> Model Class Initialized
INFO - 2025-11-21 13:03:24 --> Model Class Initialized
INFO - 2025-11-21 13:03:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:03:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:03:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
ERROR - 2025-11-21 13:03:25 --> Severity: error --> Exception: Unknown column 'quantity' in 'where clause' C:\xampp\htdocs\Inventory_CI\system\database\drivers\mysqli\mysqli_driver.php 305
INFO - 2025-11-21 13:04:55 --> Config Class Initialized
INFO - 2025-11-21 13:04:55 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:04:55 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:04:55 --> Utf8 Class Initialized
INFO - 2025-11-21 13:04:55 --> URI Class Initialized
INFO - 2025-11-21 13:04:55 --> Router Class Initialized
INFO - 2025-11-21 13:04:55 --> Output Class Initialized
INFO - 2025-11-21 13:04:55 --> Security Class Initialized
DEBUG - 2025-11-21 13:04:55 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:04:55 --> Input Class Initialized
INFO - 2025-11-21 13:04:55 --> Language Class Initialized
INFO - 2025-11-21 13:04:55 --> Loader Class Initialized
INFO - 2025-11-21 13:04:55 --> Helper loaded: url_helper
INFO - 2025-11-21 13:04:55 --> Helper loaded: form_helper
INFO - 2025-11-21 13:04:55 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:04:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:04:55 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:04:55 --> Form Validation Class Initialized
INFO - 2025-11-21 13:04:55 --> Controller Class Initialized
DEBUG - 2025-11-21 13:04:55 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:04:55 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:04:55 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:04:55 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:04:55 --> Model Class Initialized
INFO - 2025-11-21 13:04:55 --> Model Class Initialized
INFO - 2025-11-21 13:04:55 --> Model Class Initialized
INFO - 2025-11-21 13:04:55 --> Model Class Initialized
INFO - 2025-11-21 13:04:55 --> Model Class Initialized
INFO - 2025-11-21 13:04:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:04:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:04:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
ERROR - 2025-11-21 13:04:55 --> Severity: error --> Exception: Unknown column 'qty' in 'where clause' C:\xampp\htdocs\Inventory_CI\system\database\drivers\mysqli\mysqli_driver.php 305
INFO - 2025-11-21 13:05:52 --> Config Class Initialized
INFO - 2025-11-21 13:05:52 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:05:52 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:05:52 --> Utf8 Class Initialized
INFO - 2025-11-21 13:05:52 --> URI Class Initialized
INFO - 2025-11-21 13:05:52 --> Router Class Initialized
INFO - 2025-11-21 13:05:52 --> Output Class Initialized
INFO - 2025-11-21 13:05:52 --> Security Class Initialized
DEBUG - 2025-11-21 13:05:52 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:05:52 --> Input Class Initialized
INFO - 2025-11-21 13:05:52 --> Language Class Initialized
INFO - 2025-11-21 13:05:52 --> Loader Class Initialized
INFO - 2025-11-21 13:05:52 --> Helper loaded: url_helper
INFO - 2025-11-21 13:05:52 --> Helper loaded: form_helper
INFO - 2025-11-21 13:05:52 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:05:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:05:52 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:05:52 --> Form Validation Class Initialized
INFO - 2025-11-21 13:05:52 --> Controller Class Initialized
DEBUG - 2025-11-21 13:05:52 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:05:52 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:05:52 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:05:52 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:05:52 --> Model Class Initialized
INFO - 2025-11-21 13:05:52 --> Model Class Initialized
INFO - 2025-11-21 13:05:52 --> Model Class Initialized
INFO - 2025-11-21 13:05:52 --> Model Class Initialized
INFO - 2025-11-21 13:05:52 --> Model Class Initialized
INFO - 2025-11-21 13:05:52 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:05:52 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:05:52 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
ERROR - 2025-11-21 13:05:52 --> Severity: error --> Exception: Unknown column 'quantity' in 'where clause' C:\xampp\htdocs\Inventory_CI\system\database\drivers\mysqli\mysqli_driver.php 305
INFO - 2025-11-21 13:06:25 --> Config Class Initialized
INFO - 2025-11-21 13:06:25 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:06:25 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:06:25 --> Utf8 Class Initialized
INFO - 2025-11-21 13:06:25 --> URI Class Initialized
INFO - 2025-11-21 13:06:25 --> Router Class Initialized
INFO - 2025-11-21 13:06:25 --> Output Class Initialized
INFO - 2025-11-21 13:06:25 --> Security Class Initialized
DEBUG - 2025-11-21 13:06:25 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:06:25 --> Input Class Initialized
INFO - 2025-11-21 13:06:25 --> Language Class Initialized
INFO - 2025-11-21 13:06:25 --> Loader Class Initialized
INFO - 2025-11-21 13:06:25 --> Helper loaded: url_helper
INFO - 2025-11-21 13:06:25 --> Helper loaded: form_helper
INFO - 2025-11-21 13:06:25 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:06:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:06:25 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:06:25 --> Form Validation Class Initialized
INFO - 2025-11-21 13:06:25 --> Controller Class Initialized
DEBUG - 2025-11-21 13:06:25 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:06:25 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:06:25 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:06:25 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:06:25 --> Model Class Initialized
INFO - 2025-11-21 13:06:25 --> Model Class Initialized
INFO - 2025-11-21 13:06:25 --> Model Class Initialized
INFO - 2025-11-21 13:06:25 --> Model Class Initialized
INFO - 2025-11-21 13:06:25 --> Model Class Initialized
INFO - 2025-11-21 13:06:25 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:06:25 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:06:25 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
ERROR - 2025-11-21 13:06:25 --> Severity: error --> Exception: Unknown column 'quantity' in 'where clause' C:\xampp\htdocs\Inventory_CI\system\database\drivers\mysqli\mysqli_driver.php 305
INFO - 2025-11-21 13:06:26 --> Config Class Initialized
INFO - 2025-11-21 13:06:26 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:06:26 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:06:26 --> Utf8 Class Initialized
INFO - 2025-11-21 13:06:26 --> URI Class Initialized
INFO - 2025-11-21 13:06:26 --> Router Class Initialized
INFO - 2025-11-21 13:06:26 --> Output Class Initialized
INFO - 2025-11-21 13:06:26 --> Security Class Initialized
DEBUG - 2025-11-21 13:06:26 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:06:26 --> Input Class Initialized
INFO - 2025-11-21 13:06:26 --> Language Class Initialized
INFO - 2025-11-21 13:06:26 --> Loader Class Initialized
INFO - 2025-11-21 13:06:26 --> Helper loaded: url_helper
INFO - 2025-11-21 13:06:26 --> Helper loaded: form_helper
INFO - 2025-11-21 13:06:26 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:06:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:06:26 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:06:26 --> Form Validation Class Initialized
INFO - 2025-11-21 13:06:26 --> Controller Class Initialized
DEBUG - 2025-11-21 13:06:26 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:06:26 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:06:26 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:06:26 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:06:26 --> Model Class Initialized
INFO - 2025-11-21 13:06:26 --> Model Class Initialized
INFO - 2025-11-21 13:06:26 --> Model Class Initialized
INFO - 2025-11-21 13:06:26 --> Model Class Initialized
INFO - 2025-11-21 13:06:26 --> Model Class Initialized
INFO - 2025-11-21 13:06:26 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:06:26 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:06:26 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
ERROR - 2025-11-21 13:06:26 --> Severity: error --> Exception: Unknown column 'quantity' in 'where clause' C:\xampp\htdocs\Inventory_CI\system\database\drivers\mysqli\mysqli_driver.php 305
INFO - 2025-11-21 13:07:13 --> Config Class Initialized
INFO - 2025-11-21 13:07:13 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:07:13 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:07:13 --> Utf8 Class Initialized
INFO - 2025-11-21 13:07:13 --> URI Class Initialized
INFO - 2025-11-21 13:07:13 --> Router Class Initialized
INFO - 2025-11-21 13:07:13 --> Output Class Initialized
INFO - 2025-11-21 13:07:13 --> Security Class Initialized
DEBUG - 2025-11-21 13:07:13 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:07:13 --> Input Class Initialized
INFO - 2025-11-21 13:07:13 --> Language Class Initialized
INFO - 2025-11-21 13:07:13 --> Loader Class Initialized
INFO - 2025-11-21 13:07:13 --> Helper loaded: url_helper
INFO - 2025-11-21 13:07:13 --> Helper loaded: form_helper
INFO - 2025-11-21 13:07:13 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:07:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:07:13 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:07:13 --> Form Validation Class Initialized
INFO - 2025-11-21 13:07:13 --> Controller Class Initialized
DEBUG - 2025-11-21 13:07:13 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:07:13 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:07:13 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:07:13 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:07:13 --> Model Class Initialized
INFO - 2025-11-21 13:07:13 --> Model Class Initialized
INFO - 2025-11-21 13:07:13 --> Model Class Initialized
INFO - 2025-11-21 13:07:13 --> Model Class Initialized
INFO - 2025-11-21 13:07:13 --> Model Class Initialized
INFO - 2025-11-21 13:07:13 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:07:13 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:07:13 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
ERROR - 2025-11-21 13:07:13 --> Severity: error --> Exception: Unknown column 'qty' in 'where clause' C:\xampp\htdocs\Inventory_CI\system\database\drivers\mysqli\mysqli_driver.php 305
INFO - 2025-11-21 13:10:17 --> Config Class Initialized
INFO - 2025-11-21 13:10:17 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:10:17 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:10:17 --> Utf8 Class Initialized
INFO - 2025-11-21 13:10:17 --> URI Class Initialized
INFO - 2025-11-21 13:10:17 --> Router Class Initialized
INFO - 2025-11-21 13:10:17 --> Output Class Initialized
INFO - 2025-11-21 13:10:17 --> Security Class Initialized
DEBUG - 2025-11-21 13:10:17 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:10:17 --> Input Class Initialized
INFO - 2025-11-21 13:10:17 --> Language Class Initialized
INFO - 2025-11-21 13:10:17 --> Loader Class Initialized
INFO - 2025-11-21 13:10:17 --> Helper loaded: url_helper
INFO - 2025-11-21 13:10:17 --> Helper loaded: form_helper
INFO - 2025-11-21 13:10:17 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:10:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:10:17 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:10:17 --> Form Validation Class Initialized
INFO - 2025-11-21 13:10:17 --> Controller Class Initialized
DEBUG - 2025-11-21 13:10:17 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:10:17 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:10:17 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:10:17 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:10:17 --> Model Class Initialized
INFO - 2025-11-21 13:10:17 --> Model Class Initialized
INFO - 2025-11-21 13:10:17 --> Model Class Initialized
INFO - 2025-11-21 13:10:17 --> Model Class Initialized
INFO - 2025-11-21 13:10:17 --> Model Class Initialized
INFO - 2025-11-21 13:10:17 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:10:17 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:10:17 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
ERROR - 2025-11-21 13:10:17 --> Severity: error --> Exception: Unknown column 'p.quantity' in 'field list' C:\xampp\htdocs\Inventory_CI\system\database\drivers\mysqli\mysqli_driver.php 305
INFO - 2025-11-21 13:10:54 --> Config Class Initialized
INFO - 2025-11-21 13:10:54 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:10:54 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:10:54 --> Utf8 Class Initialized
INFO - 2025-11-21 13:10:54 --> URI Class Initialized
INFO - 2025-11-21 13:10:54 --> Router Class Initialized
INFO - 2025-11-21 13:10:54 --> Output Class Initialized
INFO - 2025-11-21 13:10:54 --> Security Class Initialized
DEBUG - 2025-11-21 13:10:55 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:10:55 --> Input Class Initialized
INFO - 2025-11-21 13:10:55 --> Language Class Initialized
INFO - 2025-11-21 13:10:55 --> Loader Class Initialized
INFO - 2025-11-21 13:10:55 --> Helper loaded: url_helper
INFO - 2025-11-21 13:10:55 --> Helper loaded: form_helper
INFO - 2025-11-21 13:10:55 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:10:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:10:55 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:10:55 --> Form Validation Class Initialized
INFO - 2025-11-21 13:10:55 --> Controller Class Initialized
DEBUG - 2025-11-21 13:10:55 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:10:55 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:10:55 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:10:55 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:10:55 --> Model Class Initialized
INFO - 2025-11-21 13:10:55 --> Model Class Initialized
INFO - 2025-11-21 13:10:55 --> Model Class Initialized
INFO - 2025-11-21 13:10:55 --> Model Class Initialized
INFO - 2025-11-21 13:10:55 --> Model Class Initialized
INFO - 2025-11-21 13:10:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:10:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:10:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
ERROR - 2025-11-21 13:10:55 --> Dashboard Chart Data Error: Unknown column 'quantity' in 'where clause'
ERROR - 2025-11-21 13:10:55 --> Severity: Warning --> Undefined variable $paid_data C:\xampp\htdocs\Inventory_CI\application\views\dashboard.php 442
ERROR - 2025-11-21 13:10:55 --> Severity: Warning --> Undefined variable $partial_data C:\xampp\htdocs\Inventory_CI\application\views\dashboard.php 448
INFO - 2025-11-21 13:10:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\dashboard.php
INFO - 2025-11-21 13:10:55 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 13:10:55 --> Final output sent to browser
DEBUG - 2025-11-21 13:10:55 --> Total execution time: 0.2317
INFO - 2025-11-21 13:11:11 --> Config Class Initialized
INFO - 2025-11-21 13:11:11 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:11:11 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:11:11 --> Utf8 Class Initialized
INFO - 2025-11-21 13:11:11 --> URI Class Initialized
INFO - 2025-11-21 13:11:11 --> Router Class Initialized
INFO - 2025-11-21 13:11:11 --> Output Class Initialized
INFO - 2025-11-21 13:11:11 --> Security Class Initialized
DEBUG - 2025-11-21 13:11:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:11:11 --> Input Class Initialized
INFO - 2025-11-21 13:11:11 --> Language Class Initialized
INFO - 2025-11-21 13:11:11 --> Loader Class Initialized
INFO - 2025-11-21 13:11:11 --> Helper loaded: url_helper
INFO - 2025-11-21 13:11:11 --> Helper loaded: form_helper
INFO - 2025-11-21 13:11:11 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:11:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:11:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:11:11 --> Form Validation Class Initialized
INFO - 2025-11-21 13:11:11 --> Controller Class Initialized
DEBUG - 2025-11-21 13:11:11 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:11:11 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:11:11 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:11:11 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:11:11 --> Model Class Initialized
INFO - 2025-11-21 13:11:11 --> Model Class Initialized
INFO - 2025-11-21 13:11:11 --> Model Class Initialized
ERROR - 2025-11-21 13:11:11 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:11:11 --> Model Class Initialized
INFO - 2025-11-21 13:11:11 --> Model Class Initialized
INFO - 2025-11-21 13:11:11 --> Model Class Initialized
INFO - 2025-11-21 13:11:11 --> Model Class Initialized
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 13:11:11 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 13:11:11 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 13:11:11 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:11:11 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:11:11 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 13:11:11 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 13:11:11 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 13:11:11 --> Final output sent to browser
DEBUG - 2025-11-21 13:11:11 --> Total execution time: 0.1997
INFO - 2025-11-21 13:11:12 --> Config Class Initialized
INFO - 2025-11-21 13:11:12 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:11:12 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:11:12 --> Utf8 Class Initialized
INFO - 2025-11-21 13:11:12 --> URI Class Initialized
INFO - 2025-11-21 13:11:12 --> Router Class Initialized
INFO - 2025-11-21 13:11:12 --> Output Class Initialized
INFO - 2025-11-21 13:11:12 --> Security Class Initialized
DEBUG - 2025-11-21 13:11:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:11:12 --> Input Class Initialized
INFO - 2025-11-21 13:11:12 --> Language Class Initialized
INFO - 2025-11-21 13:11:12 --> Loader Class Initialized
INFO - 2025-11-21 13:11:12 --> Helper loaded: url_helper
INFO - 2025-11-21 13:11:12 --> Helper loaded: form_helper
INFO - 2025-11-21 13:11:12 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:11:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:11:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:11:12 --> Form Validation Class Initialized
INFO - 2025-11-21 13:11:12 --> Controller Class Initialized
DEBUG - 2025-11-21 13:11:12 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:11:12 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:11:12 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:11:12 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:11:12 --> Model Class Initialized
INFO - 2025-11-21 13:11:12 --> Model Class Initialized
INFO - 2025-11-21 13:11:12 --> Model Class Initialized
ERROR - 2025-11-21 13:11:12 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:11:12 --> Model Class Initialized
INFO - 2025-11-21 13:11:12 --> Model Class Initialized
INFO - 2025-11-21 13:11:12 --> Model Class Initialized
INFO - 2025-11-21 13:11:12 --> Model Class Initialized
DEBUG - 2025-11-21 13:11:12 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 13:11:12 --> Final output sent to browser
DEBUG - 2025-11-21 13:11:12 --> Total execution time: 0.0688
INFO - 2025-11-21 13:16:11 --> Config Class Initialized
INFO - 2025-11-21 13:16:11 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:16:11 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:16:11 --> Utf8 Class Initialized
INFO - 2025-11-21 13:16:11 --> URI Class Initialized
INFO - 2025-11-21 13:16:11 --> Router Class Initialized
INFO - 2025-11-21 13:16:11 --> Output Class Initialized
INFO - 2025-11-21 13:16:11 --> Security Class Initialized
DEBUG - 2025-11-21 13:16:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:16:11 --> Input Class Initialized
INFO - 2025-11-21 13:16:11 --> Language Class Initialized
INFO - 2025-11-21 13:16:11 --> Loader Class Initialized
INFO - 2025-11-21 13:16:11 --> Helper loaded: url_helper
INFO - 2025-11-21 13:16:11 --> Helper loaded: form_helper
INFO - 2025-11-21 13:16:11 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:16:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:16:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:16:11 --> Form Validation Class Initialized
INFO - 2025-11-21 13:16:11 --> Controller Class Initialized
DEBUG - 2025-11-21 13:16:11 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:16:11 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:16:11 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:16:11 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:16:11 --> Model Class Initialized
INFO - 2025-11-21 13:16:11 --> Model Class Initialized
INFO - 2025-11-21 13:16:11 --> Model Class Initialized
ERROR - 2025-11-21 13:16:11 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:16:11 --> Model Class Initialized
INFO - 2025-11-21 13:16:11 --> Model Class Initialized
INFO - 2025-11-21 13:16:11 --> Model Class Initialized
INFO - 2025-11-21 13:16:11 --> Model Class Initialized
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 13:16:11 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 13:16:11 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 13:16:11 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:16:11 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:16:11 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 13:16:11 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 13:16:11 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 13:16:11 --> Final output sent to browser
DEBUG - 2025-11-21 13:16:11 --> Total execution time: 0.4183
INFO - 2025-11-21 13:16:11 --> Config Class Initialized
INFO - 2025-11-21 13:16:11 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:16:11 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:16:11 --> Utf8 Class Initialized
INFO - 2025-11-21 13:16:11 --> URI Class Initialized
INFO - 2025-11-21 13:16:11 --> Router Class Initialized
INFO - 2025-11-21 13:16:11 --> Output Class Initialized
INFO - 2025-11-21 13:16:11 --> Security Class Initialized
DEBUG - 2025-11-21 13:16:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:16:11 --> Input Class Initialized
INFO - 2025-11-21 13:16:11 --> Language Class Initialized
INFO - 2025-11-21 13:16:12 --> Loader Class Initialized
INFO - 2025-11-21 13:16:12 --> Helper loaded: url_helper
INFO - 2025-11-21 13:16:12 --> Helper loaded: form_helper
INFO - 2025-11-21 13:16:12 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:16:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:16:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:16:12 --> Form Validation Class Initialized
INFO - 2025-11-21 13:16:12 --> Controller Class Initialized
DEBUG - 2025-11-21 13:16:12 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:16:12 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:16:12 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:16:12 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:16:12 --> Model Class Initialized
INFO - 2025-11-21 13:16:12 --> Model Class Initialized
INFO - 2025-11-21 13:16:12 --> Model Class Initialized
ERROR - 2025-11-21 13:16:12 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:16:12 --> Model Class Initialized
INFO - 2025-11-21 13:16:12 --> Model Class Initialized
INFO - 2025-11-21 13:16:12 --> Model Class Initialized
INFO - 2025-11-21 13:16:12 --> Model Class Initialized
DEBUG - 2025-11-21 13:16:12 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 13:16:12 --> Final output sent to browser
DEBUG - 2025-11-21 13:16:12 --> Total execution time: 0.1479
INFO - 2025-11-21 13:17:12 --> Config Class Initialized
INFO - 2025-11-21 13:17:12 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:17:12 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:17:12 --> Utf8 Class Initialized
INFO - 2025-11-21 13:17:12 --> URI Class Initialized
INFO - 2025-11-21 13:17:12 --> Router Class Initialized
INFO - 2025-11-21 13:17:12 --> Output Class Initialized
INFO - 2025-11-21 13:17:12 --> Security Class Initialized
DEBUG - 2025-11-21 13:17:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:17:12 --> Input Class Initialized
INFO - 2025-11-21 13:17:12 --> Language Class Initialized
INFO - 2025-11-21 13:17:12 --> Loader Class Initialized
INFO - 2025-11-21 13:17:12 --> Helper loaded: url_helper
INFO - 2025-11-21 13:17:12 --> Helper loaded: form_helper
INFO - 2025-11-21 13:17:12 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:17:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:17:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:17:12 --> Form Validation Class Initialized
INFO - 2025-11-21 13:17:12 --> Controller Class Initialized
DEBUG - 2025-11-21 13:17:12 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:17:12 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:17:12 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:17:12 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:17:12 --> Model Class Initialized
INFO - 2025-11-21 13:17:12 --> Model Class Initialized
INFO - 2025-11-21 13:17:12 --> Model Class Initialized
ERROR - 2025-11-21 13:17:12 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:17:12 --> Model Class Initialized
INFO - 2025-11-21 13:17:12 --> Model Class Initialized
INFO - 2025-11-21 13:17:12 --> Model Class Initialized
INFO - 2025-11-21 13:17:12 --> Model Class Initialized
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 13:17:12 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 13:17:12 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 13:17:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:17:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:17:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 13:17:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 13:17:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 13:17:12 --> Final output sent to browser
DEBUG - 2025-11-21 13:17:12 --> Total execution time: 0.2812
INFO - 2025-11-21 13:17:12 --> Config Class Initialized
INFO - 2025-11-21 13:17:12 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:17:12 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:17:12 --> Utf8 Class Initialized
INFO - 2025-11-21 13:17:12 --> URI Class Initialized
INFO - 2025-11-21 13:17:12 --> Router Class Initialized
INFO - 2025-11-21 13:17:12 --> Output Class Initialized
INFO - 2025-11-21 13:17:12 --> Security Class Initialized
DEBUG - 2025-11-21 13:17:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:17:12 --> Input Class Initialized
INFO - 2025-11-21 13:17:12 --> Language Class Initialized
INFO - 2025-11-21 13:17:12 --> Loader Class Initialized
INFO - 2025-11-21 13:17:12 --> Helper loaded: url_helper
INFO - 2025-11-21 13:17:12 --> Helper loaded: form_helper
INFO - 2025-11-21 13:17:12 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:17:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:17:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:17:12 --> Form Validation Class Initialized
INFO - 2025-11-21 13:17:12 --> Controller Class Initialized
DEBUG - 2025-11-21 13:17:12 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:17:12 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:17:12 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:17:12 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:17:12 --> Model Class Initialized
INFO - 2025-11-21 13:17:12 --> Model Class Initialized
INFO - 2025-11-21 13:17:12 --> Model Class Initialized
ERROR - 2025-11-21 13:17:12 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:17:12 --> Model Class Initialized
INFO - 2025-11-21 13:17:12 --> Model Class Initialized
INFO - 2025-11-21 13:17:12 --> Model Class Initialized
INFO - 2025-11-21 13:17:12 --> Model Class Initialized
DEBUG - 2025-11-21 13:17:12 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 13:17:12 --> Final output sent to browser
DEBUG - 2025-11-21 13:17:12 --> Total execution time: 0.0619
INFO - 2025-11-21 13:21:49 --> Config Class Initialized
INFO - 2025-11-21 13:21:49 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:21:49 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:21:49 --> Utf8 Class Initialized
INFO - 2025-11-21 13:21:49 --> URI Class Initialized
INFO - 2025-11-21 13:21:49 --> Router Class Initialized
INFO - 2025-11-21 13:21:49 --> Output Class Initialized
INFO - 2025-11-21 13:21:49 --> Security Class Initialized
DEBUG - 2025-11-21 13:21:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:21:49 --> Input Class Initialized
INFO - 2025-11-21 13:21:49 --> Language Class Initialized
INFO - 2025-11-21 13:21:49 --> Loader Class Initialized
INFO - 2025-11-21 13:21:49 --> Helper loaded: url_helper
INFO - 2025-11-21 13:21:49 --> Helper loaded: form_helper
INFO - 2025-11-21 13:21:49 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:21:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:21:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:21:49 --> Form Validation Class Initialized
INFO - 2025-11-21 13:21:49 --> Controller Class Initialized
DEBUG - 2025-11-21 13:21:49 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:21:49 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:21:49 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:21:49 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:21:49 --> Model Class Initialized
INFO - 2025-11-21 13:21:49 --> Model Class Initialized
INFO - 2025-11-21 13:21:49 --> Model Class Initialized
ERROR - 2025-11-21 13:21:49 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:21:49 --> Model Class Initialized
INFO - 2025-11-21 13:21:49 --> Model Class Initialized
INFO - 2025-11-21 13:21:49 --> Model Class Initialized
INFO - 2025-11-21 13:21:49 --> Model Class Initialized
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 13:21:49 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 13:21:49 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 13:21:49 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:21:49 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:21:49 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 13:21:49 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 13:21:49 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 13:21:49 --> Final output sent to browser
DEBUG - 2025-11-21 13:21:49 --> Total execution time: 0.2513
INFO - 2025-11-21 13:21:49 --> Config Class Initialized
INFO - 2025-11-21 13:21:49 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:21:49 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:21:49 --> Utf8 Class Initialized
INFO - 2025-11-21 13:21:49 --> URI Class Initialized
INFO - 2025-11-21 13:21:49 --> Router Class Initialized
INFO - 2025-11-21 13:21:49 --> Output Class Initialized
INFO - 2025-11-21 13:21:49 --> Security Class Initialized
DEBUG - 2025-11-21 13:21:49 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:21:49 --> Input Class Initialized
INFO - 2025-11-21 13:21:49 --> Language Class Initialized
INFO - 2025-11-21 13:21:49 --> Loader Class Initialized
INFO - 2025-11-21 13:21:49 --> Helper loaded: url_helper
INFO - 2025-11-21 13:21:49 --> Helper loaded: form_helper
INFO - 2025-11-21 13:21:49 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:21:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:21:49 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:21:49 --> Form Validation Class Initialized
INFO - 2025-11-21 13:21:49 --> Controller Class Initialized
DEBUG - 2025-11-21 13:21:49 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:21:49 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:21:49 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:21:49 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:21:49 --> Model Class Initialized
INFO - 2025-11-21 13:21:49 --> Model Class Initialized
INFO - 2025-11-21 13:21:49 --> Model Class Initialized
ERROR - 2025-11-21 13:21:49 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:21:49 --> Model Class Initialized
INFO - 2025-11-21 13:21:49 --> Model Class Initialized
INFO - 2025-11-21 13:21:49 --> Model Class Initialized
INFO - 2025-11-21 13:21:49 --> Model Class Initialized
DEBUG - 2025-11-21 13:21:49 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 13:21:49 --> Final output sent to browser
DEBUG - 2025-11-21 13:21:49 --> Total execution time: 0.0670
INFO - 2025-11-21 13:53:15 --> Config Class Initialized
INFO - 2025-11-21 13:53:15 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:53:15 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:53:15 --> Utf8 Class Initialized
INFO - 2025-11-21 13:53:15 --> URI Class Initialized
INFO - 2025-11-21 13:53:15 --> Router Class Initialized
INFO - 2025-11-21 13:53:15 --> Output Class Initialized
INFO - 2025-11-21 13:53:15 --> Security Class Initialized
DEBUG - 2025-11-21 13:53:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:53:15 --> Input Class Initialized
INFO - 2025-11-21 13:53:15 --> Language Class Initialized
INFO - 2025-11-21 13:53:16 --> Loader Class Initialized
INFO - 2025-11-21 13:53:16 --> Helper loaded: url_helper
INFO - 2025-11-21 13:53:16 --> Helper loaded: form_helper
INFO - 2025-11-21 13:53:16 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:53:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:53:16 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:53:16 --> Form Validation Class Initialized
INFO - 2025-11-21 13:53:16 --> Controller Class Initialized
DEBUG - 2025-11-21 13:53:16 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:53:16 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:53:16 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:53:16 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:53:16 --> Model Class Initialized
INFO - 2025-11-21 13:53:16 --> Model Class Initialized
INFO - 2025-11-21 13:53:16 --> Model Class Initialized
ERROR - 2025-11-21 13:53:16 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:53:16 --> Model Class Initialized
INFO - 2025-11-21 13:53:16 --> Model Class Initialized
INFO - 2025-11-21 13:53:16 --> Model Class Initialized
INFO - 2025-11-21 13:53:16 --> Model Class Initialized
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 13:53:16 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 13:53:17 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 13:53:17 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:53:17 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 13:53:17 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:53:17 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 13:53:17 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 13:53:17 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 13:53:17 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 13:53:17 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 13:53:17 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 13:53:17 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:53:17 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:53:17 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 13:53:17 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 13:53:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 13:53:18 --> Final output sent to browser
DEBUG - 2025-11-21 13:53:18 --> Total execution time: 2.9655
INFO - 2025-11-21 13:53:18 --> Config Class Initialized
INFO - 2025-11-21 13:53:18 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:53:18 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:53:18 --> Utf8 Class Initialized
INFO - 2025-11-21 13:53:18 --> URI Class Initialized
INFO - 2025-11-21 13:53:18 --> Router Class Initialized
INFO - 2025-11-21 13:53:18 --> Output Class Initialized
INFO - 2025-11-21 13:53:18 --> Security Class Initialized
DEBUG - 2025-11-21 13:53:18 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:53:18 --> Input Class Initialized
INFO - 2025-11-21 13:53:18 --> Language Class Initialized
INFO - 2025-11-21 13:53:18 --> Loader Class Initialized
INFO - 2025-11-21 13:53:18 --> Helper loaded: url_helper
INFO - 2025-11-21 13:53:18 --> Helper loaded: form_helper
INFO - 2025-11-21 13:53:18 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:53:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:53:18 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:53:18 --> Form Validation Class Initialized
INFO - 2025-11-21 13:53:18 --> Controller Class Initialized
DEBUG - 2025-11-21 13:53:18 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:53:18 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:53:18 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:53:18 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:53:18 --> Model Class Initialized
INFO - 2025-11-21 13:53:18 --> Model Class Initialized
INFO - 2025-11-21 13:53:18 --> Model Class Initialized
ERROR - 2025-11-21 13:53:18 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:53:18 --> Model Class Initialized
INFO - 2025-11-21 13:53:18 --> Model Class Initialized
INFO - 2025-11-21 13:53:18 --> Model Class Initialized
INFO - 2025-11-21 13:53:18 --> Model Class Initialized
DEBUG - 2025-11-21 13:53:18 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 13:53:18 --> Final output sent to browser
DEBUG - 2025-11-21 13:53:18 --> Total execution time: 0.0676
INFO - 2025-11-21 13:56:40 --> Config Class Initialized
INFO - 2025-11-21 13:56:40 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:56:40 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:56:40 --> Utf8 Class Initialized
INFO - 2025-11-21 13:56:40 --> URI Class Initialized
INFO - 2025-11-21 13:56:40 --> Router Class Initialized
INFO - 2025-11-21 13:56:40 --> Output Class Initialized
INFO - 2025-11-21 13:56:40 --> Security Class Initialized
DEBUG - 2025-11-21 13:56:40 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:56:40 --> Input Class Initialized
INFO - 2025-11-21 13:56:40 --> Language Class Initialized
INFO - 2025-11-21 13:56:40 --> Loader Class Initialized
INFO - 2025-11-21 13:56:40 --> Helper loaded: url_helper
INFO - 2025-11-21 13:56:40 --> Helper loaded: form_helper
INFO - 2025-11-21 13:56:40 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:56:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:56:40 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:56:40 --> Form Validation Class Initialized
INFO - 2025-11-21 13:56:40 --> Controller Class Initialized
DEBUG - 2025-11-21 13:56:40 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:56:40 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:56:40 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:56:40 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:56:40 --> Model Class Initialized
INFO - 2025-11-21 13:56:40 --> Model Class Initialized
INFO - 2025-11-21 13:56:40 --> Model Class Initialized
ERROR - 2025-11-21 13:56:41 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:56:41 --> Model Class Initialized
INFO - 2025-11-21 13:56:41 --> Model Class Initialized
INFO - 2025-11-21 13:56:41 --> Model Class Initialized
INFO - 2025-11-21 13:56:41 --> Model Class Initialized
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 13:56:41 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 13:56:41 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 13:56:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:56:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:56:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 13:56:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 13:56:41 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 13:56:41 --> Final output sent to browser
DEBUG - 2025-11-21 13:56:41 --> Total execution time: 0.4110
INFO - 2025-11-21 13:56:41 --> Config Class Initialized
INFO - 2025-11-21 13:56:41 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:56:41 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:56:41 --> Utf8 Class Initialized
INFO - 2025-11-21 13:56:41 --> URI Class Initialized
INFO - 2025-11-21 13:56:41 --> Router Class Initialized
INFO - 2025-11-21 13:56:41 --> Output Class Initialized
INFO - 2025-11-21 13:56:41 --> Security Class Initialized
DEBUG - 2025-11-21 13:56:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:56:41 --> Input Class Initialized
INFO - 2025-11-21 13:56:41 --> Language Class Initialized
INFO - 2025-11-21 13:56:41 --> Loader Class Initialized
INFO - 2025-11-21 13:56:41 --> Helper loaded: url_helper
INFO - 2025-11-21 13:56:41 --> Helper loaded: form_helper
INFO - 2025-11-21 13:56:41 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:56:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:56:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:56:41 --> Form Validation Class Initialized
INFO - 2025-11-21 13:56:41 --> Controller Class Initialized
DEBUG - 2025-11-21 13:56:41 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:56:41 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:56:41 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:56:41 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:56:41 --> Model Class Initialized
INFO - 2025-11-21 13:56:41 --> Model Class Initialized
INFO - 2025-11-21 13:56:41 --> Model Class Initialized
ERROR - 2025-11-21 13:56:41 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:56:41 --> Model Class Initialized
INFO - 2025-11-21 13:56:41 --> Model Class Initialized
INFO - 2025-11-21 13:56:41 --> Model Class Initialized
INFO - 2025-11-21 13:56:41 --> Model Class Initialized
DEBUG - 2025-11-21 13:56:41 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 13:56:41 --> Final output sent to browser
DEBUG - 2025-11-21 13:56:41 --> Total execution time: 0.0761
INFO - 2025-11-21 13:58:28 --> Config Class Initialized
INFO - 2025-11-21 13:58:28 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:58:28 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:58:28 --> Utf8 Class Initialized
INFO - 2025-11-21 13:58:28 --> URI Class Initialized
INFO - 2025-11-21 13:58:28 --> Router Class Initialized
INFO - 2025-11-21 13:58:28 --> Output Class Initialized
INFO - 2025-11-21 13:58:28 --> Security Class Initialized
DEBUG - 2025-11-21 13:58:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:58:28 --> Input Class Initialized
INFO - 2025-11-21 13:58:28 --> Language Class Initialized
INFO - 2025-11-21 13:58:28 --> Loader Class Initialized
INFO - 2025-11-21 13:58:28 --> Helper loaded: url_helper
INFO - 2025-11-21 13:58:28 --> Helper loaded: form_helper
INFO - 2025-11-21 13:58:28 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:58:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:58:28 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:58:28 --> Form Validation Class Initialized
INFO - 2025-11-21 13:58:28 --> Controller Class Initialized
DEBUG - 2025-11-21 13:58:28 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:58:28 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:58:28 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:58:28 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:58:28 --> Model Class Initialized
INFO - 2025-11-21 13:58:28 --> Model Class Initialized
INFO - 2025-11-21 13:58:28 --> Model Class Initialized
ERROR - 2025-11-21 13:58:28 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:58:28 --> Model Class Initialized
INFO - 2025-11-21 13:58:28 --> Model Class Initialized
INFO - 2025-11-21 13:58:28 --> Model Class Initialized
INFO - 2025-11-21 13:58:28 --> Model Class Initialized
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 13:58:28 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 13:58:28 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 13:58:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 13:58:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 13:58:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 13:58:29 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 13:58:29 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 13:58:29 --> Final output sent to browser
DEBUG - 2025-11-21 13:58:29 --> Total execution time: 0.3903
INFO - 2025-11-21 13:58:29 --> Config Class Initialized
INFO - 2025-11-21 13:58:29 --> Hooks Class Initialized
DEBUG - 2025-11-21 13:58:29 --> UTF-8 Support Enabled
INFO - 2025-11-21 13:58:29 --> Utf8 Class Initialized
INFO - 2025-11-21 13:58:29 --> URI Class Initialized
INFO - 2025-11-21 13:58:29 --> Router Class Initialized
INFO - 2025-11-21 13:58:29 --> Output Class Initialized
INFO - 2025-11-21 13:58:29 --> Security Class Initialized
DEBUG - 2025-11-21 13:58:29 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 13:58:29 --> Input Class Initialized
INFO - 2025-11-21 13:58:29 --> Language Class Initialized
INFO - 2025-11-21 13:58:29 --> Loader Class Initialized
INFO - 2025-11-21 13:58:29 --> Helper loaded: url_helper
INFO - 2025-11-21 13:58:29 --> Helper loaded: form_helper
INFO - 2025-11-21 13:58:29 --> Database Driver Class Initialized
DEBUG - 2025-11-21 13:58:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 13:58:29 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 13:58:29 --> Form Validation Class Initialized
INFO - 2025-11-21 13:58:29 --> Controller Class Initialized
DEBUG - 2025-11-21 13:58:29 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 13:58:29 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 13:58:29 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 13:58:29 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 13:58:29 --> Model Class Initialized
INFO - 2025-11-21 13:58:29 --> Model Class Initialized
INFO - 2025-11-21 13:58:29 --> Model Class Initialized
ERROR - 2025-11-21 13:58:29 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 13:58:29 --> Model Class Initialized
INFO - 2025-11-21 13:58:29 --> Model Class Initialized
INFO - 2025-11-21 13:58:29 --> Model Class Initialized
INFO - 2025-11-21 13:58:29 --> Model Class Initialized
DEBUG - 2025-11-21 13:58:29 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 13:58:29 --> Final output sent to browser
DEBUG - 2025-11-21 13:58:29 --> Total execution time: 0.0677
INFO - 2025-11-21 14:01:06 --> Config Class Initialized
INFO - 2025-11-21 14:01:06 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:01:06 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:01:06 --> Utf8 Class Initialized
INFO - 2025-11-21 14:01:06 --> URI Class Initialized
INFO - 2025-11-21 14:01:06 --> Router Class Initialized
INFO - 2025-11-21 14:01:06 --> Output Class Initialized
INFO - 2025-11-21 14:01:06 --> Security Class Initialized
DEBUG - 2025-11-21 14:01:06 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:01:06 --> Input Class Initialized
INFO - 2025-11-21 14:01:06 --> Language Class Initialized
INFO - 2025-11-21 14:01:06 --> Loader Class Initialized
INFO - 2025-11-21 14:01:06 --> Helper loaded: url_helper
INFO - 2025-11-21 14:01:06 --> Helper loaded: form_helper
INFO - 2025-11-21 14:01:06 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:01:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:01:06 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:01:06 --> Form Validation Class Initialized
INFO - 2025-11-21 14:01:06 --> Controller Class Initialized
DEBUG - 2025-11-21 14:01:06 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:01:06 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:01:06 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:01:06 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:01:06 --> Model Class Initialized
INFO - 2025-11-21 14:01:06 --> Model Class Initialized
INFO - 2025-11-21 14:01:06 --> Model Class Initialized
ERROR - 2025-11-21 14:01:06 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:01:06 --> Model Class Initialized
INFO - 2025-11-21 14:01:06 --> Model Class Initialized
INFO - 2025-11-21 14:01:06 --> Model Class Initialized
INFO - 2025-11-21 14:01:06 --> Model Class Initialized
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 14:01:06 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 14:01:06 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 14:01:06 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 14:01:06 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 14:01:06 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 14:01:07 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 14:01:07 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 14:01:07 --> Final output sent to browser
DEBUG - 2025-11-21 14:01:07 --> Total execution time: 0.3985
INFO - 2025-11-21 14:01:07 --> Config Class Initialized
INFO - 2025-11-21 14:01:07 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:01:07 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:01:07 --> Utf8 Class Initialized
INFO - 2025-11-21 14:01:07 --> URI Class Initialized
INFO - 2025-11-21 14:01:07 --> Router Class Initialized
INFO - 2025-11-21 14:01:07 --> Output Class Initialized
INFO - 2025-11-21 14:01:07 --> Security Class Initialized
DEBUG - 2025-11-21 14:01:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:01:07 --> Input Class Initialized
INFO - 2025-11-21 14:01:07 --> Language Class Initialized
INFO - 2025-11-21 14:01:07 --> Loader Class Initialized
INFO - 2025-11-21 14:01:07 --> Helper loaded: url_helper
INFO - 2025-11-21 14:01:07 --> Helper loaded: form_helper
INFO - 2025-11-21 14:01:07 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:01:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:01:07 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:01:07 --> Form Validation Class Initialized
INFO - 2025-11-21 14:01:07 --> Controller Class Initialized
DEBUG - 2025-11-21 14:01:07 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:01:07 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:01:07 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:01:07 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:01:07 --> Model Class Initialized
INFO - 2025-11-21 14:01:07 --> Model Class Initialized
INFO - 2025-11-21 14:01:07 --> Model Class Initialized
ERROR - 2025-11-21 14:01:07 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:01:07 --> Model Class Initialized
INFO - 2025-11-21 14:01:07 --> Model Class Initialized
INFO - 2025-11-21 14:01:07 --> Model Class Initialized
INFO - 2025-11-21 14:01:07 --> Model Class Initialized
DEBUG - 2025-11-21 14:01:07 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 14:01:07 --> Final output sent to browser
DEBUG - 2025-11-21 14:01:07 --> Total execution time: 0.0598
INFO - 2025-11-21 14:02:12 --> Config Class Initialized
INFO - 2025-11-21 14:02:12 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:02:12 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:02:12 --> Utf8 Class Initialized
INFO - 2025-11-21 14:02:12 --> URI Class Initialized
INFO - 2025-11-21 14:02:12 --> Router Class Initialized
INFO - 2025-11-21 14:02:12 --> Output Class Initialized
INFO - 2025-11-21 14:02:12 --> Security Class Initialized
DEBUG - 2025-11-21 14:02:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:02:12 --> Input Class Initialized
INFO - 2025-11-21 14:02:12 --> Language Class Initialized
INFO - 2025-11-21 14:02:12 --> Loader Class Initialized
INFO - 2025-11-21 14:02:12 --> Helper loaded: url_helper
INFO - 2025-11-21 14:02:12 --> Helper loaded: form_helper
INFO - 2025-11-21 14:02:12 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:02:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:02:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:02:12 --> Form Validation Class Initialized
INFO - 2025-11-21 14:02:12 --> Controller Class Initialized
DEBUG - 2025-11-21 14:02:12 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:02:12 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:02:12 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:02:12 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:02:12 --> Model Class Initialized
INFO - 2025-11-21 14:02:12 --> Model Class Initialized
INFO - 2025-11-21 14:02:12 --> Model Class Initialized
ERROR - 2025-11-21 14:02:12 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:02:12 --> Model Class Initialized
INFO - 2025-11-21 14:02:12 --> Model Class Initialized
INFO - 2025-11-21 14:02:12 --> Model Class Initialized
INFO - 2025-11-21 14:02:12 --> Model Class Initialized
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 14:02:12 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 14:02:12 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 14:02:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 14:02:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 14:02:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 14:02:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 14:02:12 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 14:02:12 --> Final output sent to browser
DEBUG - 2025-11-21 14:02:12 --> Total execution time: 0.3882
INFO - 2025-11-21 14:02:13 --> Config Class Initialized
INFO - 2025-11-21 14:02:13 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:02:13 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:02:13 --> Utf8 Class Initialized
INFO - 2025-11-21 14:02:13 --> URI Class Initialized
INFO - 2025-11-21 14:02:13 --> Router Class Initialized
INFO - 2025-11-21 14:02:13 --> Output Class Initialized
INFO - 2025-11-21 14:02:13 --> Security Class Initialized
DEBUG - 2025-11-21 14:02:13 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:02:13 --> Input Class Initialized
INFO - 2025-11-21 14:02:13 --> Language Class Initialized
INFO - 2025-11-21 14:02:13 --> Loader Class Initialized
INFO - 2025-11-21 14:02:13 --> Helper loaded: url_helper
INFO - 2025-11-21 14:02:13 --> Helper loaded: form_helper
INFO - 2025-11-21 14:02:13 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:02:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:02:13 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:02:13 --> Form Validation Class Initialized
INFO - 2025-11-21 14:02:13 --> Controller Class Initialized
DEBUG - 2025-11-21 14:02:13 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:02:13 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:02:13 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:02:13 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:02:13 --> Model Class Initialized
INFO - 2025-11-21 14:02:13 --> Model Class Initialized
INFO - 2025-11-21 14:02:13 --> Model Class Initialized
ERROR - 2025-11-21 14:02:13 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:02:13 --> Model Class Initialized
INFO - 2025-11-21 14:02:13 --> Model Class Initialized
INFO - 2025-11-21 14:02:13 --> Model Class Initialized
INFO - 2025-11-21 14:02:13 --> Model Class Initialized
DEBUG - 2025-11-21 14:02:13 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 14:02:13 --> Final output sent to browser
DEBUG - 2025-11-21 14:02:13 --> Total execution time: 0.0697
INFO - 2025-11-21 14:05:07 --> Config Class Initialized
INFO - 2025-11-21 14:05:07 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:05:07 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:05:07 --> Utf8 Class Initialized
INFO - 2025-11-21 14:05:07 --> URI Class Initialized
INFO - 2025-11-21 14:05:07 --> Router Class Initialized
INFO - 2025-11-21 14:05:07 --> Output Class Initialized
INFO - 2025-11-21 14:05:07 --> Security Class Initialized
DEBUG - 2025-11-21 14:05:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:05:07 --> Input Class Initialized
INFO - 2025-11-21 14:05:07 --> Language Class Initialized
INFO - 2025-11-21 14:05:07 --> Loader Class Initialized
INFO - 2025-11-21 14:05:07 --> Helper loaded: url_helper
INFO - 2025-11-21 14:05:07 --> Helper loaded: form_helper
INFO - 2025-11-21 14:05:07 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:05:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:05:07 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:05:07 --> Form Validation Class Initialized
INFO - 2025-11-21 14:05:07 --> Controller Class Initialized
DEBUG - 2025-11-21 14:05:07 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:05:07 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:05:07 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:05:07 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:05:07 --> Model Class Initialized
INFO - 2025-11-21 14:05:07 --> Model Class Initialized
INFO - 2025-11-21 14:05:07 --> Model Class Initialized
ERROR - 2025-11-21 14:05:07 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:05:07 --> Model Class Initialized
INFO - 2025-11-21 14:05:07 --> Model Class Initialized
INFO - 2025-11-21 14:05:07 --> Model Class Initialized
INFO - 2025-11-21 14:05:07 --> Model Class Initialized
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 14:05:07 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 14:05:07 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 14:05:07 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 14:05:07 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 14:05:07 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 14:05:07 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 14:05:07 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 14:05:07 --> Final output sent to browser
DEBUG - 2025-11-21 14:05:07 --> Total execution time: 0.3658
INFO - 2025-11-21 14:05:07 --> Config Class Initialized
INFO - 2025-11-21 14:05:07 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:05:07 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:05:07 --> Utf8 Class Initialized
INFO - 2025-11-21 14:05:07 --> URI Class Initialized
INFO - 2025-11-21 14:05:07 --> Router Class Initialized
INFO - 2025-11-21 14:05:07 --> Output Class Initialized
INFO - 2025-11-21 14:05:07 --> Security Class Initialized
DEBUG - 2025-11-21 14:05:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:05:07 --> Input Class Initialized
INFO - 2025-11-21 14:05:07 --> Language Class Initialized
INFO - 2025-11-21 14:05:07 --> Loader Class Initialized
INFO - 2025-11-21 14:05:07 --> Helper loaded: url_helper
INFO - 2025-11-21 14:05:07 --> Helper loaded: form_helper
INFO - 2025-11-21 14:05:07 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:05:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:05:07 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:05:07 --> Form Validation Class Initialized
INFO - 2025-11-21 14:05:07 --> Controller Class Initialized
DEBUG - 2025-11-21 14:05:07 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:05:07 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:05:07 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:05:07 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:05:07 --> Model Class Initialized
INFO - 2025-11-21 14:05:07 --> Model Class Initialized
INFO - 2025-11-21 14:05:07 --> Model Class Initialized
ERROR - 2025-11-21 14:05:07 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:05:07 --> Model Class Initialized
INFO - 2025-11-21 14:05:07 --> Model Class Initialized
INFO - 2025-11-21 14:05:07 --> Model Class Initialized
INFO - 2025-11-21 14:05:07 --> Model Class Initialized
DEBUG - 2025-11-21 14:05:07 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 14:05:07 --> Final output sent to browser
DEBUG - 2025-11-21 14:05:07 --> Total execution time: 0.0657
INFO - 2025-11-21 14:06:07 --> Config Class Initialized
INFO - 2025-11-21 14:06:07 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:06:07 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:06:07 --> Utf8 Class Initialized
INFO - 2025-11-21 14:06:07 --> URI Class Initialized
INFO - 2025-11-21 14:06:07 --> Router Class Initialized
INFO - 2025-11-21 14:06:07 --> Output Class Initialized
INFO - 2025-11-21 14:06:07 --> Security Class Initialized
DEBUG - 2025-11-21 14:06:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:06:07 --> Input Class Initialized
INFO - 2025-11-21 14:06:07 --> Language Class Initialized
INFO - 2025-11-21 14:06:07 --> Loader Class Initialized
INFO - 2025-11-21 14:06:07 --> Helper loaded: url_helper
INFO - 2025-11-21 14:06:07 --> Helper loaded: form_helper
INFO - 2025-11-21 14:06:07 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:06:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:06:07 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:06:07 --> Form Validation Class Initialized
INFO - 2025-11-21 14:06:07 --> Controller Class Initialized
DEBUG - 2025-11-21 14:06:07 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:06:07 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:06:07 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:06:07 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:06:07 --> Model Class Initialized
INFO - 2025-11-21 14:06:07 --> Model Class Initialized
INFO - 2025-11-21 14:06:07 --> Model Class Initialized
INFO - 2025-11-21 14:06:07 --> Model Class Initialized
INFO - 2025-11-21 14:06:07 --> Model Class Initialized
INFO - 2025-11-21 14:06:07 --> Model Class Initialized
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 78, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 138, purchased: 16, ordered: 0, stock: 16
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 79, purchased: 989, ordered: 8, stock: 981
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 80, purchased: 205, ordered: 47, stock: 158
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 81, purchased: 1996, ordered: 905, stock: 1091
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 139, purchased: 2, ordered: 1, stock: 1
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 82, purchased: 0, ordered: 7794, stock: 0
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 83, purchased: 0, ordered: 2784, stock: 0
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 84, purchased: 189, ordered: 17, stock: 172
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 85, purchased: 137, ordered: 3, stock: 134
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 127, purchased: 2000, ordered: 327, stock: 1673
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 86, purchased: 384, ordered: 335, stock: 49
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 87, purchased: 588, ordered: 548, stock: 40
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 88, purchased: 837, ordered: 508, stock: 329
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 89, purchased: 2114, ordered: 659, stock: 1455
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 90, purchased: 470, ordered: 284, stock: 186
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 126, purchased: 25, ordered: 0, stock: 25
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 91, purchased: 26, ordered: 0, stock: 26
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 92, purchased: 25, ordered: 24, stock: 1
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 93, purchased: 752, ordered: 854, stock: 0
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 94, purchased: 764, ordered: 582, stock: 182
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 95, purchased: 2263, ordered: 365, stock: 1898
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 96, purchased: 18856, ordered: 2884, stock: 15972
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 134, purchased: 604, ordered: 69, stock: 535
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 130, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 133, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 131, purchased: 19, ordered: 0, stock: 19
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 97, purchased: 5951, ordered: 2100, stock: 3851
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 98, purchased: 442, ordered: 39, stock: 403
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 99, purchased: 2, ordered: 0, stock: 2
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 100, purchased: 34587, ordered: 24897, stock: 9690
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 137, purchased: 189, ordered: 4, stock: 185
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 101, purchased: 107, ordered: 22, stock: 85
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 102, purchased: 9799, ordered: 6456, stock: 3343
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 103, purchased: 16701, ordered: 20283, stock: 0
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 104, purchased: 7500, ordered: 784, stock: 6716
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 142, purchased: 36, ordered: 0, stock: 36
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 140, purchased: 10, ordered: 0, stock: 10
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 105, purchased: 358, ordered: 201, stock: 157
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 106, purchased: 738, ordered: 641, stock: 97
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 125, purchased: 253, ordered: 0, stock: 253
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 108, purchased: 2503, ordered: 2027, stock: 476
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 109, purchased: 2571, ordered: 660, stock: 1911
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 110, purchased: 1616, ordered: 1493, stock: 123
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 132, purchased: 200, ordered: 175, stock: 25
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 111, purchased: 406, ordered: 80, stock: 326
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 112, purchased: 1900, ordered: 1273, stock: 627
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 113, purchased: 2241, ordered: 825, stock: 1416
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 135, purchased: 1990, ordered: 604, stock: 1386
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 114, purchased: 922, ordered: 45, stock: 877
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 115, purchased: 12262, ordered: 13298, stock: 0
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 116, purchased: 174549, ordered: 204804, stock: 0
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 107, purchased: 1200, ordered: 836, stock: 364
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 117, purchased: 8276, ordered: 5943, stock: 2333
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 118, purchased: 21409, ordered: 19419, stock: 1990
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 129, purchased: 1206, ordered: 1250, stock: 0
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 119, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 120, purchased: 758, ordered: 376, stock: 382
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 121, purchased: 63, ordered: 1, stock: 62
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 122, purchased: 688, ordered: 207, stock: 481
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 123, purchased: 2020, ordered: 1660, stock: 360
DEBUG - 2025-11-21 14:06:07 --> getProductsWithStock - ID: 124, purchased: 3646, ordered: 4439, stock: 0
DEBUG - 2025-11-21 14:06:07 --> Prepared products for create view: [{"id":78,"name":"BROILER BOOSTER","price":3000,"current_stock":0,"unit":""},{"id":138,"name":"BROILER EXTRA","price":3000,"current_stock":16,"unit":""},{"id":79,"name":"BROILER FINISHER MASH","price":1000,"current_stock":981,"unit":""},{"id":80,"name":"BROILER PREMIX","price":3000,"current_stock":158,"unit":""},{"id":81,"name":"BROILER STARTER MASH","price":1000,"current_stock":1091,"unit":""},{"id":139,"name":"CHIKWIDI","price":15000,"current_stock":1,"unit":""},{"id":82,"name":"CHOKAA","price":500,"current_stock":0,"unit":""},{"id":83,"name":"CHUMVI","price":500,"current_stock":0,"unit":""},{"id":84,"name":"D.C.P KOPO (1\/2)","price":2000,"current_stock":172,"unit":""},{"id":85,"name":"D.C.P KOPO 1KG","price":3000,"current_stock":134,"unit":""},{"id":127,"name":"D.C.P KUPIMA","price":1500,"current_stock":1673,"unit":""},{"id":86,"name":"DAGAA KAUZU","price":2800,"current_stock":49,"unit":""},{"id":87,"name":"DAGAA SAGWA","price":2000,"current_stock":40,"unit":""},{"id":88,"name":"DAMU","price":1500,"current_stock":329,"unit":""},{"id":89,"name":"GROWER MASH","price":1000,"current_stock":1455,"unit":""},{"id":90,"name":"HAMIRA","price":1500,"current_stock":186,"unit":""},{"id":126,"name":"HIPHOS PLUS","price":5000,"current_stock":25,"unit":""},{"id":91,"name":"JOSERA MADUME","price":11000,"current_stock":26,"unit":""},{"id":92,"name":"JOSERA MAZIWA","price":11000,"current_stock":1,"unit":""},{"id":93,"name":"KARANGA","price":700,"current_stock":0,"unit":""},{"id":94,"name":"KAUDIS NGURUWE","price":4000,"current_stock":182,"unit":""},{"id":95,"name":"KAYABO","price":2000,"current_stock":1898,"unit":""},{"id":96,"name":"KONOKONO","price":350,"current_stock":15972,"unit":""},{"id":134,"name":"KONOKONO NZIMA","price":400,"current_stock":535,"unit":""},{"id":130,"name":"KONOKONO SAGWA","price":470,"current_stock":0,"unit":""},{"id":133,"name":"KONOKONO SAGWA","price":600,"current_stock":0,"unit":""},{"id":131,"name":"LAYERS EXTRA","price":3500,"current_stock":19,"unit":""},{"id":97,"name":"LAYERS MASH","price":1000,"current_stock":3851,"unit":""},{"id":98,"name":"LAYERS PREMIX","price":3500,"current_stock":403,"unit":""},{"id":99,"name":"MADUME LICK","price":5000,"current_stock":2,"unit":""},{"id":100,"name":"MAHINDI","price":730,"current_stock":9690,"unit":""},{"id":137,"name":"MAZIWA MENGI 1KG","price":1500,"current_stock":185,"unit":""},{"id":101,"name":"MAZIWA MENGI 2kg","price":3000,"current_stock":85,"unit":""},{"id":102,"name":"MCHELE LAINI","price":400,"current_stock":3343,"unit":""},{"id":103,"name":"MCHELE NGUMU","price":320,"current_stock":0,"unit":""},{"id":104,"name":"MFUPA","price":700,"current_stock":6716,"unit":""},{"id":142,"name":"MOLLASSES 1LITRE","price":5000,"current_stock":36,"unit":""},{"id":140,"name":"MOLLASSES 5LITRE","price":15000,"current_stock":10,"unit":""},{"id":105,"name":"MTAMA","price":1000,"current_stock":157,"unit":""},{"id":106,"name":"NGANO","price":1000,"current_stock":97,"unit":""},{"id":125,"name":"NGURUWE MIX","price":3500,"current_stock":253,"unit":""},{"id":108,"name":"PAMBA LAINI","price":1200,"current_stock":476,"unit":""},{"id":109,"name":"PAMBA NGUMU","price":1200,"current_stock":1911,"unit":""},{"id":110,"name":"PARAZA","price":1000,"current_stock":123,"unit":""},{"id":132,"name":"PELLET FINISHER","price":2000,"current_stock":25,"unit":""},{"id":111,"name":"PIG BOOSTER","price":3000,"current_stock":326,"unit":""},{"id":112,"name":"PIG GROWER","price":1000,"current_stock":627,"unit":""},{"id":113,"name":"PIG STARTER","price":1000,"current_stock":1416,"unit":""},{"id":135,"name":"PILLET STARTER","price":2000,"current_stock":1386,"unit":""},{"id":114,"name":"PILLLET GROWER","price":2000,"current_stock":877,"unit":""},{"id":115,"name":"POLLARD","price":750,"current_stock":0,"unit":""},{"id":116,"name":"PUMBA","price":660,"current_stock":0,"unit":""},{"id":107,"name":"PUMBA MAHINDI LAINI","price":600,"current_stock":364,"unit":""},{"id":117,"name":"SHUDU LAINI","price":900,"current_stock":2333,"unit":""},{"id":118,"name":"SHUDU NGUMU","price":800,"current_stock":1990,"unit":""},{"id":129,"name":"SOYA CHENGA","price":2500,"current_stock":0,"unit":""},{"id":119,"name":"SOYA MAFUTA","price":2500,"current_stock":0,"unit":""},{"id":120,"name":"SOYA UNGA","price":2000,"current_stock":382,"unit":""},{"id":121,"name":"SUPER MACLICK","price":3500,"current_stock":62,"unit":""},{"id":122,"name":"UBUYU","price":700,"current_stock":481,"unit":""},{"id":123,"name":"UDUVI","price":3500,"current_stock":360,"unit":""},{"id":124,"name":"WHEAT","price":650,"current_stock":0,"unit":""}]
ERROR - 2025-11-21 14:06:07 --> Severity: Warning --> Undefined variable $page_title C:\xampp\htdocs\Inventory_CI\application\views\templates\header.php 7
INFO - 2025-11-21 14:06:07 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 14:06:07 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 14:06:07 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 14:06:07 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\orders/create.php
INFO - 2025-11-21 14:06:07 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 14:06:07 --> Final output sent to browser
DEBUG - 2025-11-21 14:06:07 --> Total execution time: 0.3750
INFO - 2025-11-21 14:06:07 --> Config Class Initialized
INFO - 2025-11-21 14:06:07 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:06:07 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:06:07 --> Utf8 Class Initialized
INFO - 2025-11-21 14:06:07 --> URI Class Initialized
INFO - 2025-11-21 14:06:07 --> Router Class Initialized
INFO - 2025-11-21 14:06:07 --> Output Class Initialized
INFO - 2025-11-21 14:06:07 --> Security Class Initialized
DEBUG - 2025-11-21 14:06:07 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:06:07 --> Input Class Initialized
INFO - 2025-11-21 14:06:07 --> Language Class Initialized
ERROR - 2025-11-21 14:06:07 --> 404 Page Not Found: Assets/plugins
INFO - 2025-11-21 14:10:24 --> Config Class Initialized
INFO - 2025-11-21 14:10:24 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:10:24 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:10:24 --> Utf8 Class Initialized
INFO - 2025-11-21 14:10:24 --> URI Class Initialized
INFO - 2025-11-21 14:10:24 --> Router Class Initialized
INFO - 2025-11-21 14:10:24 --> Output Class Initialized
INFO - 2025-11-21 14:10:24 --> Security Class Initialized
DEBUG - 2025-11-21 14:10:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:10:24 --> Input Class Initialized
INFO - 2025-11-21 14:10:24 --> Language Class Initialized
INFO - 2025-11-21 14:10:24 --> Loader Class Initialized
INFO - 2025-11-21 14:10:24 --> Helper loaded: url_helper
INFO - 2025-11-21 14:10:24 --> Helper loaded: form_helper
INFO - 2025-11-21 14:10:24 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:10:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:10:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:10:24 --> Form Validation Class Initialized
INFO - 2025-11-21 14:10:24 --> Controller Class Initialized
DEBUG - 2025-11-21 14:10:24 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:10:24 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:10:24 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:10:24 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:10:24 --> Model Class Initialized
INFO - 2025-11-21 14:10:24 --> Model Class Initialized
INFO - 2025-11-21 14:10:24 --> Model Class Initialized
ERROR - 2025-11-21 14:10:24 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:10:24 --> Model Class Initialized
INFO - 2025-11-21 14:10:24 --> Model Class Initialized
INFO - 2025-11-21 14:10:24 --> Model Class Initialized
INFO - 2025-11-21 14:10:24 --> Model Class Initialized
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 14:10:24 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 14:10:24 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 14:10:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 14:10:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 14:10:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 14:10:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 14:10:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 14:10:24 --> Final output sent to browser
DEBUG - 2025-11-21 14:10:24 --> Total execution time: 0.3465
INFO - 2025-11-21 14:10:24 --> Config Class Initialized
INFO - 2025-11-21 14:10:24 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:10:24 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:10:24 --> Utf8 Class Initialized
INFO - 2025-11-21 14:10:24 --> URI Class Initialized
INFO - 2025-11-21 14:10:24 --> Router Class Initialized
INFO - 2025-11-21 14:10:24 --> Output Class Initialized
INFO - 2025-11-21 14:10:24 --> Security Class Initialized
DEBUG - 2025-11-21 14:10:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:10:24 --> Input Class Initialized
INFO - 2025-11-21 14:10:24 --> Language Class Initialized
INFO - 2025-11-21 14:10:24 --> Loader Class Initialized
INFO - 2025-11-21 14:10:24 --> Helper loaded: url_helper
INFO - 2025-11-21 14:10:24 --> Helper loaded: form_helper
INFO - 2025-11-21 14:10:24 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:10:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:10:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:10:24 --> Form Validation Class Initialized
INFO - 2025-11-21 14:10:24 --> Controller Class Initialized
DEBUG - 2025-11-21 14:10:24 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:10:24 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:10:24 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:10:24 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:10:24 --> Model Class Initialized
INFO - 2025-11-21 14:10:24 --> Model Class Initialized
INFO - 2025-11-21 14:10:24 --> Model Class Initialized
ERROR - 2025-11-21 14:10:24 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:10:24 --> Model Class Initialized
INFO - 2025-11-21 14:10:24 --> Model Class Initialized
INFO - 2025-11-21 14:10:24 --> Model Class Initialized
INFO - 2025-11-21 14:10:24 --> Model Class Initialized
DEBUG - 2025-11-21 14:10:24 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 14:10:24 --> Final output sent to browser
DEBUG - 2025-11-21 14:10:24 --> Total execution time: 0.0647
INFO - 2025-11-21 14:12:23 --> Config Class Initialized
INFO - 2025-11-21 14:12:23 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:12:23 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:12:23 --> Utf8 Class Initialized
INFO - 2025-11-21 14:12:23 --> URI Class Initialized
INFO - 2025-11-21 14:12:23 --> Router Class Initialized
INFO - 2025-11-21 14:12:23 --> Output Class Initialized
INFO - 2025-11-21 14:12:23 --> Security Class Initialized
DEBUG - 2025-11-21 14:12:23 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:12:23 --> Input Class Initialized
INFO - 2025-11-21 14:12:23 --> Language Class Initialized
INFO - 2025-11-21 14:12:23 --> Loader Class Initialized
INFO - 2025-11-21 14:12:23 --> Helper loaded: url_helper
INFO - 2025-11-21 14:12:23 --> Helper loaded: form_helper
INFO - 2025-11-21 14:12:23 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:12:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:12:23 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:12:23 --> Form Validation Class Initialized
INFO - 2025-11-21 14:12:23 --> Controller Class Initialized
DEBUG - 2025-11-21 14:12:23 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:12:23 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:12:23 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:12:23 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:12:23 --> Model Class Initialized
INFO - 2025-11-21 14:12:23 --> Model Class Initialized
INFO - 2025-11-21 14:12:23 --> Model Class Initialized
ERROR - 2025-11-21 14:12:23 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:12:23 --> Model Class Initialized
INFO - 2025-11-21 14:12:23 --> Model Class Initialized
INFO - 2025-11-21 14:12:23 --> Model Class Initialized
INFO - 2025-11-21 14:12:23 --> Model Class Initialized
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 14:12:23 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 14:12:23 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 14:12:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 14:12:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 14:12:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 14:12:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 14:12:24 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 14:12:24 --> Final output sent to browser
DEBUG - 2025-11-21 14:12:24 --> Total execution time: 0.3998
INFO - 2025-11-21 14:12:24 --> Config Class Initialized
INFO - 2025-11-21 14:12:24 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:12:24 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:12:24 --> Utf8 Class Initialized
INFO - 2025-11-21 14:12:24 --> URI Class Initialized
INFO - 2025-11-21 14:12:24 --> Router Class Initialized
INFO - 2025-11-21 14:12:24 --> Output Class Initialized
INFO - 2025-11-21 14:12:24 --> Security Class Initialized
DEBUG - 2025-11-21 14:12:24 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:12:24 --> Input Class Initialized
INFO - 2025-11-21 14:12:24 --> Language Class Initialized
INFO - 2025-11-21 14:12:24 --> Loader Class Initialized
INFO - 2025-11-21 14:12:24 --> Helper loaded: url_helper
INFO - 2025-11-21 14:12:24 --> Helper loaded: form_helper
INFO - 2025-11-21 14:12:24 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:12:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:12:24 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:12:24 --> Form Validation Class Initialized
INFO - 2025-11-21 14:12:24 --> Controller Class Initialized
DEBUG - 2025-11-21 14:12:24 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:12:24 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:12:24 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:12:24 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:12:24 --> Model Class Initialized
INFO - 2025-11-21 14:12:24 --> Model Class Initialized
INFO - 2025-11-21 14:12:24 --> Model Class Initialized
ERROR - 2025-11-21 14:12:24 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:12:24 --> Model Class Initialized
INFO - 2025-11-21 14:12:24 --> Model Class Initialized
INFO - 2025-11-21 14:12:24 --> Model Class Initialized
INFO - 2025-11-21 14:12:24 --> Model Class Initialized
DEBUG - 2025-11-21 14:12:24 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 14:12:24 --> Final output sent to browser
DEBUG - 2025-11-21 14:12:24 --> Total execution time: 0.0668
INFO - 2025-11-21 14:14:17 --> Config Class Initialized
INFO - 2025-11-21 14:14:17 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:14:17 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:14:17 --> Utf8 Class Initialized
INFO - 2025-11-21 14:14:17 --> URI Class Initialized
INFO - 2025-11-21 14:14:17 --> Router Class Initialized
INFO - 2025-11-21 14:14:17 --> Output Class Initialized
INFO - 2025-11-21 14:14:17 --> Security Class Initialized
DEBUG - 2025-11-21 14:14:17 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:14:17 --> Input Class Initialized
INFO - 2025-11-21 14:14:17 --> Language Class Initialized
INFO - 2025-11-21 14:14:17 --> Loader Class Initialized
INFO - 2025-11-21 14:14:17 --> Helper loaded: url_helper
INFO - 2025-11-21 14:14:17 --> Helper loaded: form_helper
INFO - 2025-11-21 14:14:17 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:14:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:14:17 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:14:17 --> Form Validation Class Initialized
INFO - 2025-11-21 14:14:17 --> Controller Class Initialized
DEBUG - 2025-11-21 14:14:17 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:14:17 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:14:17 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:14:17 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:14:17 --> Model Class Initialized
INFO - 2025-11-21 14:14:17 --> Model Class Initialized
INFO - 2025-11-21 14:14:17 --> Model Class Initialized
ERROR - 2025-11-21 14:14:17 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:14:17 --> Model Class Initialized
INFO - 2025-11-21 14:14:17 --> Model Class Initialized
INFO - 2025-11-21 14:14:17 --> Model Class Initialized
INFO - 2025-11-21 14:14:17 --> Model Class Initialized
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=905, Available=1091
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7794, Available=0
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2784, Available=0
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=335, Available=49
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2100, Available=3851
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=24897, Available=9690
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=6456, Available=3343
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20283, Available=0
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1493, Available=123
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 14:14:17 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1273, Available=627
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=604, Available=1386
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13298, Available=0
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=204804, Available=0
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5943, Available=2333
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=19419, Available=1990
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1250, Available=0
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 14:14:18 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 14:14:18 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 14:14:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 14:14:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 14:14:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 14:14:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 14:14:18 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 14:14:18 --> Final output sent to browser
DEBUG - 2025-11-21 14:14:18 --> Total execution time: 0.2695
INFO - 2025-11-21 14:14:20 --> Config Class Initialized
INFO - 2025-11-21 14:14:20 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:14:20 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:14:20 --> Utf8 Class Initialized
INFO - 2025-11-21 14:14:20 --> URI Class Initialized
INFO - 2025-11-21 14:14:20 --> Router Class Initialized
INFO - 2025-11-21 14:14:20 --> Output Class Initialized
INFO - 2025-11-21 14:14:20 --> Security Class Initialized
DEBUG - 2025-11-21 14:14:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:14:20 --> Input Class Initialized
INFO - 2025-11-21 14:14:20 --> Language Class Initialized
INFO - 2025-11-21 14:14:20 --> Loader Class Initialized
INFO - 2025-11-21 14:14:20 --> Helper loaded: url_helper
INFO - 2025-11-21 14:14:20 --> Helper loaded: form_helper
INFO - 2025-11-21 14:14:20 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:14:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:14:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:14:20 --> Form Validation Class Initialized
INFO - 2025-11-21 14:14:20 --> Controller Class Initialized
DEBUG - 2025-11-21 14:14:20 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:14:20 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:14:20 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:14:20 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:14:20 --> Model Class Initialized
INFO - 2025-11-21 14:14:20 --> Model Class Initialized
INFO - 2025-11-21 14:14:20 --> Model Class Initialized
ERROR - 2025-11-21 14:14:20 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:14:20 --> Model Class Initialized
INFO - 2025-11-21 14:14:20 --> Model Class Initialized
INFO - 2025-11-21 14:14:20 --> Model Class Initialized
INFO - 2025-11-21 14:14:20 --> Model Class Initialized
DEBUG - 2025-11-21 14:14:20 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 14:14:20 --> Final output sent to browser
DEBUG - 2025-11-21 14:14:20 --> Total execution time: 0.0846
INFO - 2025-11-21 14:14:28 --> Config Class Initialized
INFO - 2025-11-21 14:14:28 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:14:28 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:14:28 --> Utf8 Class Initialized
INFO - 2025-11-21 14:14:28 --> URI Class Initialized
INFO - 2025-11-21 14:14:28 --> Router Class Initialized
INFO - 2025-11-21 14:14:28 --> Output Class Initialized
INFO - 2025-11-21 14:14:28 --> Security Class Initialized
DEBUG - 2025-11-21 14:14:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:14:28 --> Input Class Initialized
INFO - 2025-11-21 14:14:28 --> Language Class Initialized
INFO - 2025-11-21 14:14:28 --> Loader Class Initialized
INFO - 2025-11-21 14:14:28 --> Helper loaded: url_helper
INFO - 2025-11-21 14:14:28 --> Helper loaded: form_helper
INFO - 2025-11-21 14:14:28 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:14:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:14:28 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:14:28 --> Form Validation Class Initialized
INFO - 2025-11-21 14:14:28 --> Controller Class Initialized
DEBUG - 2025-11-21 14:14:28 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:14:28 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:14:28 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:14:28 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:14:28 --> Model Class Initialized
INFO - 2025-11-21 14:14:28 --> Model Class Initialized
INFO - 2025-11-21 14:14:28 --> Model Class Initialized
INFO - 2025-11-21 14:14:28 --> Model Class Initialized
INFO - 2025-11-21 14:14:28 --> Model Class Initialized
INFO - 2025-11-21 14:14:28 --> Model Class Initialized
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 78, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 138, purchased: 16, ordered: 0, stock: 16
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 79, purchased: 989, ordered: 8, stock: 981
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 80, purchased: 205, ordered: 47, stock: 158
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 81, purchased: 1996, ordered: 905, stock: 1091
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 139, purchased: 2, ordered: 1, stock: 1
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 82, purchased: 0, ordered: 7794, stock: 0
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 83, purchased: 0, ordered: 2784, stock: 0
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 84, purchased: 189, ordered: 17, stock: 172
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 85, purchased: 137, ordered: 3, stock: 134
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 127, purchased: 2000, ordered: 327, stock: 1673
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 86, purchased: 384, ordered: 335, stock: 49
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 87, purchased: 588, ordered: 548, stock: 40
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 88, purchased: 837, ordered: 508, stock: 329
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 89, purchased: 2114, ordered: 659, stock: 1455
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 90, purchased: 470, ordered: 284, stock: 186
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 126, purchased: 25, ordered: 0, stock: 25
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 91, purchased: 26, ordered: 0, stock: 26
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 92, purchased: 25, ordered: 24, stock: 1
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 93, purchased: 752, ordered: 854, stock: 0
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 94, purchased: 764, ordered: 582, stock: 182
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 95, purchased: 2263, ordered: 365, stock: 1898
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 96, purchased: 18856, ordered: 2884, stock: 15972
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 134, purchased: 604, ordered: 69, stock: 535
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 130, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 133, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 131, purchased: 19, ordered: 0, stock: 19
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 97, purchased: 5951, ordered: 2100, stock: 3851
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 98, purchased: 442, ordered: 39, stock: 403
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 99, purchased: 2, ordered: 0, stock: 2
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 100, purchased: 34587, ordered: 24897, stock: 9690
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 137, purchased: 189, ordered: 4, stock: 185
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 101, purchased: 107, ordered: 22, stock: 85
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 102, purchased: 9799, ordered: 6456, stock: 3343
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 103, purchased: 16701, ordered: 20283, stock: 0
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 104, purchased: 7500, ordered: 784, stock: 6716
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 142, purchased: 36, ordered: 0, stock: 36
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 140, purchased: 10, ordered: 0, stock: 10
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 105, purchased: 358, ordered: 201, stock: 157
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 106, purchased: 738, ordered: 641, stock: 97
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 125, purchased: 253, ordered: 0, stock: 253
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 108, purchased: 2503, ordered: 2027, stock: 476
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 109, purchased: 2571, ordered: 660, stock: 1911
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 110, purchased: 1616, ordered: 1493, stock: 123
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 132, purchased: 200, ordered: 175, stock: 25
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 111, purchased: 406, ordered: 80, stock: 326
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 112, purchased: 1900, ordered: 1273, stock: 627
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 113, purchased: 2241, ordered: 825, stock: 1416
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 135, purchased: 1990, ordered: 604, stock: 1386
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 114, purchased: 922, ordered: 45, stock: 877
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 115, purchased: 12262, ordered: 13298, stock: 0
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 116, purchased: 174549, ordered: 204804, stock: 0
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 107, purchased: 1200, ordered: 836, stock: 364
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 117, purchased: 8276, ordered: 5943, stock: 2333
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 118, purchased: 21409, ordered: 19419, stock: 1990
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 129, purchased: 1206, ordered: 1250, stock: 0
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 119, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 120, purchased: 758, ordered: 376, stock: 382
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 121, purchased: 63, ordered: 1, stock: 62
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 122, purchased: 688, ordered: 207, stock: 481
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 123, purchased: 2020, ordered: 1660, stock: 360
DEBUG - 2025-11-21 14:14:28 --> getProductsWithStock - ID: 124, purchased: 3646, ordered: 4439, stock: 0
DEBUG - 2025-11-21 14:14:28 --> Prepared products for create view: [{"id":78,"name":"BROILER BOOSTER","price":3000,"current_stock":0,"unit":""},{"id":138,"name":"BROILER EXTRA","price":3000,"current_stock":16,"unit":""},{"id":79,"name":"BROILER FINISHER MASH","price":1000,"current_stock":981,"unit":""},{"id":80,"name":"BROILER PREMIX","price":3000,"current_stock":158,"unit":""},{"id":81,"name":"BROILER STARTER MASH","price":1000,"current_stock":1091,"unit":""},{"id":139,"name":"CHIKWIDI","price":15000,"current_stock":1,"unit":""},{"id":82,"name":"CHOKAA","price":500,"current_stock":0,"unit":""},{"id":83,"name":"CHUMVI","price":500,"current_stock":0,"unit":""},{"id":84,"name":"D.C.P KOPO (1\/2)","price":2000,"current_stock":172,"unit":""},{"id":85,"name":"D.C.P KOPO 1KG","price":3000,"current_stock":134,"unit":""},{"id":127,"name":"D.C.P KUPIMA","price":1500,"current_stock":1673,"unit":""},{"id":86,"name":"DAGAA KAUZU","price":2800,"current_stock":49,"unit":""},{"id":87,"name":"DAGAA SAGWA","price":2000,"current_stock":40,"unit":""},{"id":88,"name":"DAMU","price":1500,"current_stock":329,"unit":""},{"id":89,"name":"GROWER MASH","price":1000,"current_stock":1455,"unit":""},{"id":90,"name":"HAMIRA","price":1500,"current_stock":186,"unit":""},{"id":126,"name":"HIPHOS PLUS","price":5000,"current_stock":25,"unit":""},{"id":91,"name":"JOSERA MADUME","price":11000,"current_stock":26,"unit":""},{"id":92,"name":"JOSERA MAZIWA","price":11000,"current_stock":1,"unit":""},{"id":93,"name":"KARANGA","price":700,"current_stock":0,"unit":""},{"id":94,"name":"KAUDIS NGURUWE","price":4000,"current_stock":182,"unit":""},{"id":95,"name":"KAYABO","price":2000,"current_stock":1898,"unit":""},{"id":96,"name":"KONOKONO","price":350,"current_stock":15972,"unit":""},{"id":134,"name":"KONOKONO NZIMA","price":400,"current_stock":535,"unit":""},{"id":130,"name":"KONOKONO SAGWA","price":470,"current_stock":0,"unit":""},{"id":133,"name":"KONOKONO SAGWA","price":600,"current_stock":0,"unit":""},{"id":131,"name":"LAYERS EXTRA","price":3500,"current_stock":19,"unit":""},{"id":97,"name":"LAYERS MASH","price":1000,"current_stock":3851,"unit":""},{"id":98,"name":"LAYERS PREMIX","price":3500,"current_stock":403,"unit":""},{"id":99,"name":"MADUME LICK","price":5000,"current_stock":2,"unit":""},{"id":100,"name":"MAHINDI","price":730,"current_stock":9690,"unit":""},{"id":137,"name":"MAZIWA MENGI 1KG","price":1500,"current_stock":185,"unit":""},{"id":101,"name":"MAZIWA MENGI 2kg","price":3000,"current_stock":85,"unit":""},{"id":102,"name":"MCHELE LAINI","price":400,"current_stock":3343,"unit":""},{"id":103,"name":"MCHELE NGUMU","price":320,"current_stock":0,"unit":""},{"id":104,"name":"MFUPA","price":700,"current_stock":6716,"unit":""},{"id":142,"name":"MOLLASSES 1LITRE","price":5000,"current_stock":36,"unit":""},{"id":140,"name":"MOLLASSES 5LITRE","price":15000,"current_stock":10,"unit":""},{"id":105,"name":"MTAMA","price":1000,"current_stock":157,"unit":""},{"id":106,"name":"NGANO","price":1000,"current_stock":97,"unit":""},{"id":125,"name":"NGURUWE MIX","price":3500,"current_stock":253,"unit":""},{"id":108,"name":"PAMBA LAINI","price":1200,"current_stock":476,"unit":""},{"id":109,"name":"PAMBA NGUMU","price":1200,"current_stock":1911,"unit":""},{"id":110,"name":"PARAZA","price":1000,"current_stock":123,"unit":""},{"id":132,"name":"PELLET FINISHER","price":2000,"current_stock":25,"unit":""},{"id":111,"name":"PIG BOOSTER","price":3000,"current_stock":326,"unit":""},{"id":112,"name":"PIG GROWER","price":1000,"current_stock":627,"unit":""},{"id":113,"name":"PIG STARTER","price":1000,"current_stock":1416,"unit":""},{"id":135,"name":"PILLET STARTER","price":2000,"current_stock":1386,"unit":""},{"id":114,"name":"PILLLET GROWER","price":2000,"current_stock":877,"unit":""},{"id":115,"name":"POLLARD","price":750,"current_stock":0,"unit":""},{"id":116,"name":"PUMBA","price":660,"current_stock":0,"unit":""},{"id":107,"name":"PUMBA MAHINDI LAINI","price":600,"current_stock":364,"unit":""},{"id":117,"name":"SHUDU LAINI","price":900,"current_stock":2333,"unit":""},{"id":118,"name":"SHUDU NGUMU","price":800,"current_stock":1990,"unit":""},{"id":129,"name":"SOYA CHENGA","price":2500,"current_stock":0,"unit":""},{"id":119,"name":"SOYA MAFUTA","price":2500,"current_stock":0,"unit":""},{"id":120,"name":"SOYA UNGA","price":2000,"current_stock":382,"unit":""},{"id":121,"name":"SUPER MACLICK","price":3500,"current_stock":62,"unit":""},{"id":122,"name":"UBUYU","price":700,"current_stock":481,"unit":""},{"id":123,"name":"UDUVI","price":3500,"current_stock":360,"unit":""},{"id":124,"name":"WHEAT","price":650,"current_stock":0,"unit":""}]
ERROR - 2025-11-21 14:14:28 --> Severity: Warning --> Undefined variable $page_title C:\xampp\htdocs\Inventory_CI\application\views\templates\header.php 7
INFO - 2025-11-21 14:14:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 14:14:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 14:14:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 14:14:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\orders/create.php
INFO - 2025-11-21 14:14:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 14:14:28 --> Final output sent to browser
DEBUG - 2025-11-21 14:14:28 --> Total execution time: 0.1353
INFO - 2025-11-21 14:14:28 --> Config Class Initialized
INFO - 2025-11-21 14:14:28 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:14:28 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:14:28 --> Utf8 Class Initialized
INFO - 2025-11-21 14:14:28 --> URI Class Initialized
INFO - 2025-11-21 14:14:28 --> Router Class Initialized
INFO - 2025-11-21 14:14:28 --> Output Class Initialized
INFO - 2025-11-21 14:14:28 --> Security Class Initialized
DEBUG - 2025-11-21 14:14:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:14:28 --> Input Class Initialized
INFO - 2025-11-21 14:14:28 --> Language Class Initialized
ERROR - 2025-11-21 14:14:28 --> 404 Page Not Found: Assets/plugins
INFO - 2025-11-21 14:15:44 --> Config Class Initialized
INFO - 2025-11-21 14:15:44 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:15:44 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:15:44 --> Utf8 Class Initialized
INFO - 2025-11-21 14:15:44 --> URI Class Initialized
INFO - 2025-11-21 14:15:44 --> Router Class Initialized
INFO - 2025-11-21 14:15:44 --> Output Class Initialized
INFO - 2025-11-21 14:15:44 --> Security Class Initialized
DEBUG - 2025-11-21 14:15:44 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:15:44 --> Input Class Initialized
INFO - 2025-11-21 14:15:44 --> Language Class Initialized
INFO - 2025-11-21 14:15:44 --> Loader Class Initialized
INFO - 2025-11-21 14:15:44 --> Helper loaded: url_helper
INFO - 2025-11-21 14:15:44 --> Helper loaded: form_helper
INFO - 2025-11-21 14:15:44 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:15:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:15:44 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:15:44 --> Form Validation Class Initialized
INFO - 2025-11-21 14:15:44 --> Controller Class Initialized
DEBUG - 2025-11-21 14:15:44 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:15:44 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:15:44 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:15:44 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:15:44 --> Model Class Initialized
INFO - 2025-11-21 14:15:44 --> Model Class Initialized
INFO - 2025-11-21 14:15:44 --> Model Class Initialized
INFO - 2025-11-21 14:15:44 --> Model Class Initialized
INFO - 2025-11-21 14:15:44 --> Model Class Initialized
INFO - 2025-11-21 14:15:44 --> Model Class Initialized
DEBUG - 2025-11-21 14:15:44 --> Controller_Orders::create POST: {"customer_name":"M.HIMBO","customer_phone":"","customer_address":"","store_id":"7","product":["116","118","83","103"],"qty":["150","150","1.5","50"],"rate":["646.67","800.00","500.00","450.00"],"rate_value":["646.67","800.00","500.00","450.00"],"amount":["97000","120000.00","750.00","22500"],"amount_value":["97000","120000.00","750.00","22500"],"discount":"0","paid_status":"2","amount_paid":"240250.00","gross_amount_value":"240250.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"240250.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:15:44 --> Final output sent to browser
DEBUG - 2025-11-21 14:15:44 --> Total execution time: 0.3275
INFO - 2025-11-21 14:20:53 --> Config Class Initialized
INFO - 2025-11-21 14:20:53 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:20:53 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:20:53 --> Utf8 Class Initialized
INFO - 2025-11-21 14:20:53 --> URI Class Initialized
INFO - 2025-11-21 14:20:53 --> Router Class Initialized
INFO - 2025-11-21 14:20:53 --> Output Class Initialized
INFO - 2025-11-21 14:20:53 --> Security Class Initialized
DEBUG - 2025-11-21 14:20:53 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:20:53 --> Input Class Initialized
INFO - 2025-11-21 14:20:53 --> Language Class Initialized
INFO - 2025-11-21 14:20:53 --> Loader Class Initialized
INFO - 2025-11-21 14:20:53 --> Helper loaded: url_helper
INFO - 2025-11-21 14:20:53 --> Helper loaded: form_helper
INFO - 2025-11-21 14:20:53 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:20:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:20:53 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:20:53 --> Form Validation Class Initialized
INFO - 2025-11-21 14:20:53 --> Controller Class Initialized
DEBUG - 2025-11-21 14:20:53 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:20:53 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:20:53 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:20:53 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:20:53 --> Model Class Initialized
INFO - 2025-11-21 14:20:53 --> Model Class Initialized
INFO - 2025-11-21 14:20:53 --> Model Class Initialized
INFO - 2025-11-21 14:20:53 --> Model Class Initialized
INFO - 2025-11-21 14:20:53 --> Model Class Initialized
INFO - 2025-11-21 14:20:53 --> Model Class Initialized
DEBUG - 2025-11-21 14:20:53 --> Controller_Orders::create POST: {"customer_name":"BABA","customer_phone":"","customer_address":"","store_id":"7","product":["116","118"],"qty":["50","25"],"rate":["650.00","800.00"],"rate_value":["650.00","800.00"],"amount":["32500","20000.00"],"amount_value":["32500","20000.00"],"discount":"0","paid_status":"2","amount_paid":"52500.00","gross_amount_value":"52500.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"52500.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:20:53 --> Final output sent to browser
DEBUG - 2025-11-21 14:20:53 --> Total execution time: 0.2799
INFO - 2025-11-21 14:23:42 --> Config Class Initialized
INFO - 2025-11-21 14:23:42 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:23:42 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:23:42 --> Utf8 Class Initialized
INFO - 2025-11-21 14:23:42 --> URI Class Initialized
INFO - 2025-11-21 14:23:42 --> Router Class Initialized
INFO - 2025-11-21 14:23:42 --> Output Class Initialized
INFO - 2025-11-21 14:23:42 --> Security Class Initialized
DEBUG - 2025-11-21 14:23:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:23:42 --> Input Class Initialized
INFO - 2025-11-21 14:23:42 --> Language Class Initialized
INFO - 2025-11-21 14:23:42 --> Loader Class Initialized
INFO - 2025-11-21 14:23:42 --> Helper loaded: url_helper
INFO - 2025-11-21 14:23:42 --> Helper loaded: form_helper
INFO - 2025-11-21 14:23:42 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:23:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:23:42 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:23:42 --> Form Validation Class Initialized
INFO - 2025-11-21 14:23:42 --> Controller Class Initialized
DEBUG - 2025-11-21 14:23:42 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:23:42 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:23:42 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:23:42 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:23:42 --> Model Class Initialized
INFO - 2025-11-21 14:23:42 --> Model Class Initialized
INFO - 2025-11-21 14:23:42 --> Model Class Initialized
INFO - 2025-11-21 14:23:42 --> Model Class Initialized
INFO - 2025-11-21 14:23:42 --> Model Class Initialized
INFO - 2025-11-21 14:23:42 --> Model Class Initialized
DEBUG - 2025-11-21 14:23:42 --> Controller_Orders::create POST: {"customer_name":"SPORAH","customer_phone":"","customer_address":"","store_id":"7","product":["100","118","82","116","102",""],"qty":["550","160","100","150","50","1"],"rate":["750.00","800.00","250.00","650","450.00","140000.00"],"rate_value":["750.00","800.00","250.00","650","450.00","140000.00"],"amount":["412500","128000.00","25000","97500.00","22500","140000"],"amount_value":["412500","128000.00","25000","97500.00","22500","140000"],"discount":"0","paid_status":"2","amount_paid":"825500.00","gross_amount_value":"825500.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"825500.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:23:42 --> Final output sent to browser
DEBUG - 2025-11-21 14:23:42 --> Total execution time: 0.2189
INFO - 2025-11-21 14:31:15 --> Config Class Initialized
INFO - 2025-11-21 14:31:15 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:31:15 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:31:15 --> Utf8 Class Initialized
INFO - 2025-11-21 14:31:15 --> URI Class Initialized
INFO - 2025-11-21 14:31:15 --> Router Class Initialized
INFO - 2025-11-21 14:31:15 --> Output Class Initialized
INFO - 2025-11-21 14:31:15 --> Security Class Initialized
DEBUG - 2025-11-21 14:31:15 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:31:15 --> Input Class Initialized
INFO - 2025-11-21 14:31:15 --> Language Class Initialized
INFO - 2025-11-21 14:31:15 --> Loader Class Initialized
INFO - 2025-11-21 14:31:15 --> Helper loaded: url_helper
INFO - 2025-11-21 14:31:15 --> Helper loaded: form_helper
INFO - 2025-11-21 14:31:15 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:31:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:31:15 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:31:15 --> Form Validation Class Initialized
INFO - 2025-11-21 14:31:15 --> Controller Class Initialized
DEBUG - 2025-11-21 14:31:15 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:31:15 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:31:15 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:31:15 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:31:15 --> Model Class Initialized
INFO - 2025-11-21 14:31:15 --> Model Class Initialized
INFO - 2025-11-21 14:31:15 --> Model Class Initialized
INFO - 2025-11-21 14:31:15 --> Model Class Initialized
INFO - 2025-11-21 14:31:15 --> Model Class Initialized
INFO - 2025-11-21 14:31:15 --> Model Class Initialized
DEBUG - 2025-11-21 14:31:15 --> Controller_Orders::create POST: {"customer_name":"M.HILDA","customer_phone":"","customer_address":"","store_id":"7","product":["116","102"],"qty":["50","50"],"rate":["650","450"],"rate_value":["650","450"],"amount":["32500.00","22500.00"],"amount_value":["32500.00","22500.00"],"discount":"0","paid_status":"2","amount_paid":"55000.00","gross_amount_value":"55000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"55000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:31:15 --> Final output sent to browser
DEBUG - 2025-11-21 14:31:15 --> Total execution time: 0.1810
INFO - 2025-11-21 14:32:11 --> Config Class Initialized
INFO - 2025-11-21 14:32:11 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:32:11 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:32:11 --> Utf8 Class Initialized
INFO - 2025-11-21 14:32:11 --> URI Class Initialized
INFO - 2025-11-21 14:32:11 --> Router Class Initialized
INFO - 2025-11-21 14:32:11 --> Output Class Initialized
INFO - 2025-11-21 14:32:11 --> Security Class Initialized
DEBUG - 2025-11-21 14:32:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:32:11 --> Input Class Initialized
INFO - 2025-11-21 14:32:11 --> Language Class Initialized
INFO - 2025-11-21 14:32:11 --> Loader Class Initialized
INFO - 2025-11-21 14:32:11 --> Helper loaded: url_helper
INFO - 2025-11-21 14:32:11 --> Helper loaded: form_helper
INFO - 2025-11-21 14:32:11 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:32:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:32:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:32:11 --> Form Validation Class Initialized
INFO - 2025-11-21 14:32:11 --> Controller Class Initialized
DEBUG - 2025-11-21 14:32:11 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:32:11 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:32:11 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:32:11 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:32:11 --> Model Class Initialized
INFO - 2025-11-21 14:32:11 --> Model Class Initialized
INFO - 2025-11-21 14:32:11 --> Model Class Initialized
INFO - 2025-11-21 14:32:11 --> Model Class Initialized
INFO - 2025-11-21 14:32:11 --> Model Class Initialized
INFO - 2025-11-21 14:32:11 --> Model Class Initialized
DEBUG - 2025-11-21 14:32:11 --> Controller_Orders::create POST: {"customer_name":"M.LOVE","customer_phone":"","customer_address":"","store_id":"7","product":["116","102"],"qty":["50","50"],"rate":["650","450"],"rate_value":["650","450"],"amount":["32500.00","22500.00"],"amount_value":["32500.00","22500.00"],"discount":"0","paid_status":"2","amount_paid":"55000.00","gross_amount_value":"55000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"55000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:32:11 --> Final output sent to browser
DEBUG - 2025-11-21 14:32:11 --> Total execution time: 0.2005
INFO - 2025-11-21 14:33:02 --> Config Class Initialized
INFO - 2025-11-21 14:33:02 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:33:02 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:33:02 --> Utf8 Class Initialized
INFO - 2025-11-21 14:33:02 --> URI Class Initialized
INFO - 2025-11-21 14:33:02 --> Router Class Initialized
INFO - 2025-11-21 14:33:02 --> Output Class Initialized
INFO - 2025-11-21 14:33:02 --> Security Class Initialized
DEBUG - 2025-11-21 14:33:02 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:33:02 --> Input Class Initialized
INFO - 2025-11-21 14:33:02 --> Language Class Initialized
INFO - 2025-11-21 14:33:02 --> Loader Class Initialized
INFO - 2025-11-21 14:33:02 --> Helper loaded: url_helper
INFO - 2025-11-21 14:33:02 --> Helper loaded: form_helper
INFO - 2025-11-21 14:33:02 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:33:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:33:02 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:33:02 --> Form Validation Class Initialized
INFO - 2025-11-21 14:33:02 --> Controller Class Initialized
DEBUG - 2025-11-21 14:33:02 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:33:02 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:33:02 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:33:02 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:33:02 --> Model Class Initialized
INFO - 2025-11-21 14:33:02 --> Model Class Initialized
INFO - 2025-11-21 14:33:02 --> Model Class Initialized
INFO - 2025-11-21 14:33:02 --> Model Class Initialized
INFO - 2025-11-21 14:33:02 --> Model Class Initialized
INFO - 2025-11-21 14:33:02 --> Model Class Initialized
DEBUG - 2025-11-21 14:33:02 --> Controller_Orders::create POST: {"customer_name":"JENNY","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["58.6"],"rate":["640.00"],"rate_value":["640.00"],"amount":["37504"],"amount_value":["37504"],"discount":"0","paid_status":"2","amount_paid":"37504.00","gross_amount_value":"37504.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"37504.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:33:02 --> Final output sent to browser
DEBUG - 2025-11-21 14:33:02 --> Total execution time: 0.1812
INFO - 2025-11-21 14:34:43 --> Config Class Initialized
INFO - 2025-11-21 14:34:43 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:34:43 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:34:43 --> Utf8 Class Initialized
INFO - 2025-11-21 14:34:43 --> URI Class Initialized
INFO - 2025-11-21 14:34:43 --> Router Class Initialized
INFO - 2025-11-21 14:34:43 --> Output Class Initialized
INFO - 2025-11-21 14:34:43 --> Security Class Initialized
DEBUG - 2025-11-21 14:34:43 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:34:43 --> Input Class Initialized
INFO - 2025-11-21 14:34:43 --> Language Class Initialized
INFO - 2025-11-21 14:34:43 --> Loader Class Initialized
INFO - 2025-11-21 14:34:43 --> Helper loaded: url_helper
INFO - 2025-11-21 14:34:43 --> Helper loaded: form_helper
INFO - 2025-11-21 14:34:43 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:34:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:34:43 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:34:43 --> Form Validation Class Initialized
INFO - 2025-11-21 14:34:43 --> Controller Class Initialized
DEBUG - 2025-11-21 14:34:43 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:34:43 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:34:43 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:34:43 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:34:43 --> Model Class Initialized
INFO - 2025-11-21 14:34:43 --> Model Class Initialized
INFO - 2025-11-21 14:34:43 --> Model Class Initialized
INFO - 2025-11-21 14:34:43 --> Model Class Initialized
INFO - 2025-11-21 14:34:43 --> Model Class Initialized
INFO - 2025-11-21 14:34:43 --> Model Class Initialized
DEBUG - 2025-11-21 14:34:43 --> Controller_Orders::create POST: {"customer_name":"M.SHISHI","customer_phone":"","customer_address":"","store_id":"7","product":["116","129","103","118"],"qty":["750","250","250","250"],"rate":["640","1950","370","770"],"rate_value":["640","1950","370","770"],"amount":["480000.00","487500.00","92500.00","192500.00"],"amount_value":["480000.00","487500.00","92500.00","192500.00"],"discount":"0","paid_status":"2","amount_paid":"1252500.00","gross_amount_value":"1252500.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"1252500.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:34:43 --> Final output sent to browser
DEBUG - 2025-11-21 14:34:43 --> Total execution time: 0.1734
INFO - 2025-11-21 14:36:42 --> Config Class Initialized
INFO - 2025-11-21 14:36:42 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:36:42 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:36:42 --> Utf8 Class Initialized
INFO - 2025-11-21 14:36:42 --> URI Class Initialized
INFO - 2025-11-21 14:36:42 --> Router Class Initialized
INFO - 2025-11-21 14:36:42 --> Output Class Initialized
INFO - 2025-11-21 14:36:42 --> Security Class Initialized
DEBUG - 2025-11-21 14:36:42 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:36:42 --> Input Class Initialized
INFO - 2025-11-21 14:36:42 --> Language Class Initialized
INFO - 2025-11-21 14:36:42 --> Loader Class Initialized
INFO - 2025-11-21 14:36:42 --> Helper loaded: url_helper
INFO - 2025-11-21 14:36:42 --> Helper loaded: form_helper
INFO - 2025-11-21 14:36:42 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:36:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:36:42 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:36:42 --> Form Validation Class Initialized
INFO - 2025-11-21 14:36:42 --> Controller Class Initialized
DEBUG - 2025-11-21 14:36:42 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:36:42 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:36:42 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:36:42 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:36:42 --> Model Class Initialized
INFO - 2025-11-21 14:36:42 --> Model Class Initialized
INFO - 2025-11-21 14:36:42 --> Model Class Initialized
INFO - 2025-11-21 14:36:42 --> Model Class Initialized
INFO - 2025-11-21 14:36:42 --> Model Class Initialized
INFO - 2025-11-21 14:36:42 --> Model Class Initialized
DEBUG - 2025-11-21 14:36:42 --> Controller_Orders::create POST: {"customer_name":"M.G","customer_phone":"","customer_address":"","store_id":"7","product":["97","97","81","135","112"],"qty":["100","50","50","50","50"],"rate":["940.00","940.00","940.00","1760.00","920.00"],"rate_value":["940.00","940.00","940.00","1760.00","920.00"],"amount":["94000","47000","47000","88000","46000"],"amount_value":["94000","47000","47000","88000","46000"],"discount":"0","paid_status":"2","amount_paid":"322000.00","gross_amount_value":"322000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"322000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:36:42 --> Final output sent to browser
DEBUG - 2025-11-21 14:36:42 --> Total execution time: 0.1644
INFO - 2025-11-21 14:37:22 --> Config Class Initialized
INFO - 2025-11-21 14:37:22 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:37:22 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:37:22 --> Utf8 Class Initialized
INFO - 2025-11-21 14:37:22 --> URI Class Initialized
INFO - 2025-11-21 14:37:22 --> Router Class Initialized
INFO - 2025-11-21 14:37:22 --> Output Class Initialized
INFO - 2025-11-21 14:37:22 --> Security Class Initialized
DEBUG - 2025-11-21 14:37:22 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:37:22 --> Input Class Initialized
INFO - 2025-11-21 14:37:22 --> Language Class Initialized
INFO - 2025-11-21 14:37:22 --> Loader Class Initialized
INFO - 2025-11-21 14:37:22 --> Helper loaded: url_helper
INFO - 2025-11-21 14:37:22 --> Helper loaded: form_helper
INFO - 2025-11-21 14:37:22 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:37:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:37:22 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:37:22 --> Form Validation Class Initialized
INFO - 2025-11-21 14:37:22 --> Controller Class Initialized
DEBUG - 2025-11-21 14:37:22 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:37:22 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:37:22 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:37:22 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:37:22 --> Model Class Initialized
INFO - 2025-11-21 14:37:22 --> Model Class Initialized
INFO - 2025-11-21 14:37:22 --> Model Class Initialized
INFO - 2025-11-21 14:37:22 --> Model Class Initialized
INFO - 2025-11-21 14:37:22 --> Model Class Initialized
INFO - 2025-11-21 14:37:22 --> Model Class Initialized
DEBUG - 2025-11-21 14:37:22 --> Controller_Orders::create POST: {"customer_name":"MAU","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["50"],"rate":["650"],"rate_value":["650"],"amount":["32500.00"],"amount_value":["32500.00"],"discount":"0","paid_status":"2","amount_paid":"32500.00","gross_amount_value":"32500.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"32500.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:37:23 --> Final output sent to browser
DEBUG - 2025-11-21 14:37:23 --> Total execution time: 0.1631
INFO - 2025-11-21 14:39:12 --> Config Class Initialized
INFO - 2025-11-21 14:39:12 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:39:12 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:39:12 --> Utf8 Class Initialized
INFO - 2025-11-21 14:39:12 --> URI Class Initialized
INFO - 2025-11-21 14:39:12 --> Router Class Initialized
INFO - 2025-11-21 14:39:12 --> Output Class Initialized
INFO - 2025-11-21 14:39:12 --> Security Class Initialized
DEBUG - 2025-11-21 14:39:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:39:12 --> Input Class Initialized
INFO - 2025-11-21 14:39:12 --> Language Class Initialized
INFO - 2025-11-21 14:39:12 --> Loader Class Initialized
INFO - 2025-11-21 14:39:12 --> Helper loaded: url_helper
INFO - 2025-11-21 14:39:12 --> Helper loaded: form_helper
INFO - 2025-11-21 14:39:12 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:39:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:39:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:39:12 --> Form Validation Class Initialized
INFO - 2025-11-21 14:39:12 --> Controller Class Initialized
DEBUG - 2025-11-21 14:39:12 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:39:12 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:39:12 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:39:12 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:39:12 --> Model Class Initialized
INFO - 2025-11-21 14:39:12 --> Model Class Initialized
INFO - 2025-11-21 14:39:12 --> Model Class Initialized
INFO - 2025-11-21 14:39:12 --> Model Class Initialized
INFO - 2025-11-21 14:39:12 --> Model Class Initialized
INFO - 2025-11-21 14:39:12 --> Model Class Initialized
DEBUG - 2025-11-21 14:39:12 --> Controller_Orders::create POST: {"customer_name":"UNKNOWN","customer_phone":"","customer_address":"","store_id":"7","product":["116","110","115","83","117"],"qty":["50","20","50.6","1","20"],"rate":["650.00","1000.00","790.51","500.00","900.00"],"rate_value":["650.00","1000.00","790.51","500.00","900.00"],"amount":["32500","20000.00","40000","500.00","18000.00"],"amount_value":["32500","20000.00","40000","500.00","18000.00"],"discount":"0","paid_status":"2","amount_paid":"111000.00","gross_amount_value":"111000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"111000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:39:12 --> Final output sent to browser
DEBUG - 2025-11-21 14:39:12 --> Total execution time: 0.2693
INFO - 2025-11-21 14:39:48 --> Config Class Initialized
INFO - 2025-11-21 14:39:48 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:39:48 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:39:48 --> Utf8 Class Initialized
INFO - 2025-11-21 14:39:48 --> URI Class Initialized
INFO - 2025-11-21 14:39:48 --> Router Class Initialized
INFO - 2025-11-21 14:39:48 --> Output Class Initialized
INFO - 2025-11-21 14:39:48 --> Security Class Initialized
DEBUG - 2025-11-21 14:39:48 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:39:48 --> Input Class Initialized
INFO - 2025-11-21 14:39:48 --> Language Class Initialized
INFO - 2025-11-21 14:39:48 --> Loader Class Initialized
INFO - 2025-11-21 14:39:48 --> Helper loaded: url_helper
INFO - 2025-11-21 14:39:48 --> Helper loaded: form_helper
INFO - 2025-11-21 14:39:48 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:39:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:39:48 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:39:48 --> Form Validation Class Initialized
INFO - 2025-11-21 14:39:48 --> Controller Class Initialized
DEBUG - 2025-11-21 14:39:48 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:39:48 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:39:48 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:39:48 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:39:48 --> Model Class Initialized
INFO - 2025-11-21 14:39:48 --> Model Class Initialized
INFO - 2025-11-21 14:39:48 --> Model Class Initialized
INFO - 2025-11-21 14:39:48 --> Model Class Initialized
INFO - 2025-11-21 14:39:48 --> Model Class Initialized
INFO - 2025-11-21 14:39:48 --> Model Class Initialized
DEBUG - 2025-11-21 14:39:48 --> Controller_Orders::create POST: {"customer_name":"MAKUYU","customer_phone":"","customer_address":"","store_id":"7","product":["103"],"qty":["5.2"],"rate":["384.62"],"rate_value":["384.62"],"amount":["2000"],"amount_value":["2000"],"discount":"0","paid_status":"2","amount_paid":"2000.00","gross_amount_value":"2000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"2000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:39:48 --> Final output sent to browser
DEBUG - 2025-11-21 14:39:48 --> Total execution time: 0.1563
INFO - 2025-11-21 14:40:30 --> Config Class Initialized
INFO - 2025-11-21 14:40:30 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:40:30 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:40:30 --> Utf8 Class Initialized
INFO - 2025-11-21 14:40:30 --> URI Class Initialized
INFO - 2025-11-21 14:40:30 --> Router Class Initialized
INFO - 2025-11-21 14:40:30 --> Output Class Initialized
INFO - 2025-11-21 14:40:30 --> Security Class Initialized
DEBUG - 2025-11-21 14:40:30 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:40:30 --> Input Class Initialized
INFO - 2025-11-21 14:40:30 --> Language Class Initialized
INFO - 2025-11-21 14:40:30 --> Loader Class Initialized
INFO - 2025-11-21 14:40:30 --> Helper loaded: url_helper
INFO - 2025-11-21 14:40:30 --> Helper loaded: form_helper
INFO - 2025-11-21 14:40:30 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:40:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:40:30 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:40:30 --> Form Validation Class Initialized
INFO - 2025-11-21 14:40:30 --> Controller Class Initialized
DEBUG - 2025-11-21 14:40:30 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:40:30 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:40:30 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:40:30 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:40:30 --> Model Class Initialized
INFO - 2025-11-21 14:40:30 --> Model Class Initialized
INFO - 2025-11-21 14:40:30 --> Model Class Initialized
INFO - 2025-11-21 14:40:30 --> Model Class Initialized
INFO - 2025-11-21 14:40:30 --> Model Class Initialized
INFO - 2025-11-21 14:40:30 --> Model Class Initialized
DEBUG - 2025-11-21 14:40:30 --> Controller_Orders::create POST: {"customer_name":"MAKUYU","customer_phone":"","customer_address":"","store_id":"7","product":["103"],"qty":["42.1"],"rate":["380.05"],"rate_value":["380.05"],"amount":["16000"],"amount_value":["16000"],"discount":"0","paid_status":"2","amount_paid":"16000.00","gross_amount_value":"16000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"16000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:40:30 --> Final output sent to browser
DEBUG - 2025-11-21 14:40:30 --> Total execution time: 0.1609
INFO - 2025-11-21 14:40:54 --> Config Class Initialized
INFO - 2025-11-21 14:40:54 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:40:54 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:40:54 --> Utf8 Class Initialized
INFO - 2025-11-21 14:40:54 --> URI Class Initialized
INFO - 2025-11-21 14:40:54 --> Router Class Initialized
INFO - 2025-11-21 14:40:54 --> Output Class Initialized
INFO - 2025-11-21 14:40:54 --> Security Class Initialized
DEBUG - 2025-11-21 14:40:54 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:40:54 --> Input Class Initialized
INFO - 2025-11-21 14:40:54 --> Language Class Initialized
INFO - 2025-11-21 14:40:54 --> Loader Class Initialized
INFO - 2025-11-21 14:40:54 --> Helper loaded: url_helper
INFO - 2025-11-21 14:40:54 --> Helper loaded: form_helper
INFO - 2025-11-21 14:40:54 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:40:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:40:54 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:40:54 --> Form Validation Class Initialized
INFO - 2025-11-21 14:40:54 --> Controller Class Initialized
DEBUG - 2025-11-21 14:40:54 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:40:54 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:40:54 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:40:54 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:40:54 --> Model Class Initialized
INFO - 2025-11-21 14:40:54 --> Model Class Initialized
INFO - 2025-11-21 14:40:54 --> Model Class Initialized
INFO - 2025-11-21 14:40:54 --> Model Class Initialized
INFO - 2025-11-21 14:40:54 --> Model Class Initialized
INFO - 2025-11-21 14:40:54 --> Model Class Initialized
DEBUG - 2025-11-21 14:40:54 --> Controller_Orders::create POST: {"customer_name":"M.SHISHI","customer_phone":"","customer_address":"","store_id":"7","product":["86"],"qty":["60"],"rate":["2800.00"],"rate_value":["2800.00"],"amount":["168000.00"],"amount_value":["168000.00"],"discount":"0","paid_status":"2","amount_paid":"168000.00","gross_amount_value":"168000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"168000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:40:54 --> Final output sent to browser
DEBUG - 2025-11-21 14:40:54 --> Total execution time: 0.1807
INFO - 2025-11-21 14:41:56 --> Config Class Initialized
INFO - 2025-11-21 14:41:56 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:41:56 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:41:56 --> Utf8 Class Initialized
INFO - 2025-11-21 14:41:56 --> URI Class Initialized
INFO - 2025-11-21 14:41:56 --> Router Class Initialized
INFO - 2025-11-21 14:41:56 --> Output Class Initialized
INFO - 2025-11-21 14:41:56 --> Security Class Initialized
DEBUG - 2025-11-21 14:41:56 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:41:56 --> Input Class Initialized
INFO - 2025-11-21 14:41:56 --> Language Class Initialized
INFO - 2025-11-21 14:41:56 --> Loader Class Initialized
INFO - 2025-11-21 14:41:56 --> Helper loaded: url_helper
INFO - 2025-11-21 14:41:56 --> Helper loaded: form_helper
INFO - 2025-11-21 14:41:56 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:41:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:41:56 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:41:56 --> Form Validation Class Initialized
INFO - 2025-11-21 14:41:56 --> Controller Class Initialized
DEBUG - 2025-11-21 14:41:56 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:41:56 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:41:56 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:41:56 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:41:56 --> Model Class Initialized
INFO - 2025-11-21 14:41:56 --> Model Class Initialized
INFO - 2025-11-21 14:41:56 --> Model Class Initialized
INFO - 2025-11-21 14:41:56 --> Model Class Initialized
INFO - 2025-11-21 14:41:56 --> Model Class Initialized
INFO - 2025-11-21 14:41:56 --> Model Class Initialized
DEBUG - 2025-11-21 14:41:56 --> Controller_Orders::create POST: {"customer_name":"PAULO","customer_phone":"","customer_address":"","store_id":"7","product":["116","102"],"qty":["1200","800"],"rate":["640.00","400.00"],"rate_value":["640.00","400.00"],"amount":["768000","320000.00"],"amount_value":["768000","320000.00"],"discount":"0","paid_status":"1","amount_paid":"0.00","gross_amount_value":"1088000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"1088000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:41:56 --> Final output sent to browser
DEBUG - 2025-11-21 14:41:56 --> Total execution time: 0.2093
INFO - 2025-11-21 14:42:36 --> Config Class Initialized
INFO - 2025-11-21 14:42:36 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:42:36 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:42:36 --> Utf8 Class Initialized
INFO - 2025-11-21 14:42:36 --> URI Class Initialized
INFO - 2025-11-21 14:42:36 --> Router Class Initialized
INFO - 2025-11-21 14:42:36 --> Output Class Initialized
INFO - 2025-11-21 14:42:36 --> Security Class Initialized
DEBUG - 2025-11-21 14:42:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:42:36 --> Input Class Initialized
INFO - 2025-11-21 14:42:36 --> Language Class Initialized
INFO - 2025-11-21 14:42:36 --> Loader Class Initialized
INFO - 2025-11-21 14:42:36 --> Helper loaded: url_helper
INFO - 2025-11-21 14:42:36 --> Helper loaded: form_helper
INFO - 2025-11-21 14:42:36 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:42:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:42:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:42:36 --> Form Validation Class Initialized
INFO - 2025-11-21 14:42:36 --> Controller Class Initialized
DEBUG - 2025-11-21 14:42:36 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:42:36 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:42:36 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:42:36 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:42:36 --> Model Class Initialized
INFO - 2025-11-21 14:42:36 --> Model Class Initialized
INFO - 2025-11-21 14:42:36 --> Model Class Initialized
INFO - 2025-11-21 14:42:36 --> Model Class Initialized
INFO - 2025-11-21 14:42:36 --> Model Class Initialized
INFO - 2025-11-21 14:42:36 --> Model Class Initialized
DEBUG - 2025-11-21 14:42:36 --> Controller_Orders::create POST: {"customer_name":"M.CAREN","customer_phone":"","customer_address":"","store_id":"7","product":["115"],"qty":["6"],"rate":["800.00"],"rate_value":["800.00"],"amount":["4800"],"amount_value":["4800"],"discount":"0","paid_status":"2","amount_paid":"4800.00","gross_amount_value":"4800.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"4800.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:42:36 --> Final output sent to browser
DEBUG - 2025-11-21 14:42:36 --> Total execution time: 0.1804
INFO - 2025-11-21 14:43:45 --> Config Class Initialized
INFO - 2025-11-21 14:43:45 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:43:45 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:43:45 --> Utf8 Class Initialized
INFO - 2025-11-21 14:43:45 --> URI Class Initialized
INFO - 2025-11-21 14:43:45 --> Router Class Initialized
INFO - 2025-11-21 14:43:45 --> Output Class Initialized
INFO - 2025-11-21 14:43:45 --> Security Class Initialized
DEBUG - 2025-11-21 14:43:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:43:45 --> Input Class Initialized
INFO - 2025-11-21 14:43:45 --> Language Class Initialized
INFO - 2025-11-21 14:43:45 --> Loader Class Initialized
INFO - 2025-11-21 14:43:45 --> Helper loaded: url_helper
INFO - 2025-11-21 14:43:45 --> Helper loaded: form_helper
INFO - 2025-11-21 14:43:45 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:43:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:43:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:43:45 --> Form Validation Class Initialized
INFO - 2025-11-21 14:43:45 --> Controller Class Initialized
DEBUG - 2025-11-21 14:43:45 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:43:45 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:43:45 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:43:45 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:43:45 --> Model Class Initialized
INFO - 2025-11-21 14:43:45 --> Model Class Initialized
INFO - 2025-11-21 14:43:45 --> Model Class Initialized
INFO - 2025-11-21 14:43:45 --> Model Class Initialized
INFO - 2025-11-21 14:43:45 --> Model Class Initialized
INFO - 2025-11-21 14:43:45 --> Model Class Initialized
DEBUG - 2025-11-21 14:43:45 --> Controller_Orders::create POST: {"customer_name":"M.HEKIMA","customer_phone":"","customer_address":"","store_id":"7","product":["97"],"qty":["50"],"rate":["960.00"],"rate_value":["960.00"],"amount":["48000"],"amount_value":["48000"],"discount":"0","paid_status":"2","amount_paid":"48000.00","gross_amount_value":"48000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"48000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:43:45 --> Final output sent to browser
DEBUG - 2025-11-21 14:43:45 --> Total execution time: 0.1858
INFO - 2025-11-21 14:44:11 --> Config Class Initialized
INFO - 2025-11-21 14:44:11 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:44:11 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:44:11 --> Utf8 Class Initialized
INFO - 2025-11-21 14:44:11 --> URI Class Initialized
INFO - 2025-11-21 14:44:11 --> Router Class Initialized
INFO - 2025-11-21 14:44:11 --> Output Class Initialized
INFO - 2025-11-21 14:44:11 --> Security Class Initialized
DEBUG - 2025-11-21 14:44:11 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:44:11 --> Input Class Initialized
INFO - 2025-11-21 14:44:11 --> Language Class Initialized
INFO - 2025-11-21 14:44:11 --> Loader Class Initialized
INFO - 2025-11-21 14:44:11 --> Helper loaded: url_helper
INFO - 2025-11-21 14:44:11 --> Helper loaded: form_helper
INFO - 2025-11-21 14:44:11 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:44:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:44:11 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:44:11 --> Form Validation Class Initialized
INFO - 2025-11-21 14:44:11 --> Controller Class Initialized
DEBUG - 2025-11-21 14:44:11 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:44:11 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:44:11 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:44:11 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:44:11 --> Model Class Initialized
INFO - 2025-11-21 14:44:11 --> Model Class Initialized
INFO - 2025-11-21 14:44:11 --> Model Class Initialized
INFO - 2025-11-21 14:44:11 --> Model Class Initialized
INFO - 2025-11-21 14:44:11 --> Model Class Initialized
INFO - 2025-11-21 14:44:11 --> Model Class Initialized
DEBUG - 2025-11-21 14:44:11 --> Controller_Orders::create POST: {"customer_name":"PASCO","customer_phone":"","customer_address":"","store_id":"7","product":["116"],"qty":["35"],"rate":["650"],"rate_value":["650"],"amount":["22750.00"],"amount_value":["22750.00"],"discount":"0","paid_status":"2","amount_paid":"22750.00","gross_amount_value":"22750.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"22750.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:44:11 --> Final output sent to browser
DEBUG - 2025-11-21 14:44:11 --> Total execution time: 0.2305
INFO - 2025-11-21 14:44:36 --> Config Class Initialized
INFO - 2025-11-21 14:44:36 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:44:36 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:44:36 --> Utf8 Class Initialized
INFO - 2025-11-21 14:44:36 --> URI Class Initialized
INFO - 2025-11-21 14:44:36 --> Router Class Initialized
INFO - 2025-11-21 14:44:36 --> Output Class Initialized
INFO - 2025-11-21 14:44:36 --> Security Class Initialized
DEBUG - 2025-11-21 14:44:36 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:44:36 --> Input Class Initialized
INFO - 2025-11-21 14:44:36 --> Language Class Initialized
INFO - 2025-11-21 14:44:36 --> Loader Class Initialized
INFO - 2025-11-21 14:44:36 --> Helper loaded: url_helper
INFO - 2025-11-21 14:44:36 --> Helper loaded: form_helper
INFO - 2025-11-21 14:44:36 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:44:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:44:36 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:44:36 --> Form Validation Class Initialized
INFO - 2025-11-21 14:44:36 --> Controller Class Initialized
DEBUG - 2025-11-21 14:44:36 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:44:36 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:44:36 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:44:36 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:44:36 --> Model Class Initialized
INFO - 2025-11-21 14:44:36 --> Model Class Initialized
INFO - 2025-11-21 14:44:36 --> Model Class Initialized
INFO - 2025-11-21 14:44:36 --> Model Class Initialized
INFO - 2025-11-21 14:44:36 --> Model Class Initialized
INFO - 2025-11-21 14:44:36 --> Model Class Initialized
DEBUG - 2025-11-21 14:44:36 --> Controller_Orders::create POST: {"customer_name":"M.JOSHUA","customer_phone":"","customer_address":"","store_id":"7","product":["100"],"qty":["1500"],"rate":["730.00"],"rate_value":["730.00"],"amount":["1095000.00"],"amount_value":["1095000.00"],"discount":"0","paid_status":"2","amount_paid":"1095000.00","gross_amount_value":"1095000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"1095000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:44:36 --> Final output sent to browser
DEBUG - 2025-11-21 14:44:36 --> Total execution time: 0.1338
INFO - 2025-11-21 14:46:19 --> Config Class Initialized
INFO - 2025-11-21 14:46:19 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:46:19 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:46:19 --> Utf8 Class Initialized
INFO - 2025-11-21 14:46:19 --> URI Class Initialized
INFO - 2025-11-21 14:46:19 --> Router Class Initialized
INFO - 2025-11-21 14:46:19 --> Output Class Initialized
INFO - 2025-11-21 14:46:19 --> Security Class Initialized
DEBUG - 2025-11-21 14:46:19 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:46:19 --> Input Class Initialized
INFO - 2025-11-21 14:46:19 --> Language Class Initialized
INFO - 2025-11-21 14:46:19 --> Loader Class Initialized
INFO - 2025-11-21 14:46:19 --> Helper loaded: url_helper
INFO - 2025-11-21 14:46:19 --> Helper loaded: form_helper
INFO - 2025-11-21 14:46:19 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:46:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:46:19 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:46:19 --> Form Validation Class Initialized
INFO - 2025-11-21 14:46:19 --> Controller Class Initialized
DEBUG - 2025-11-21 14:46:19 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:46:19 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:46:19 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:46:19 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:46:19 --> Model Class Initialized
INFO - 2025-11-21 14:46:19 --> Model Class Initialized
INFO - 2025-11-21 14:46:19 --> Model Class Initialized
ERROR - 2025-11-21 14:46:19 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:46:19 --> Model Class Initialized
INFO - 2025-11-21 14:46:19 --> Model Class Initialized
INFO - 2025-11-21 14:46:19 --> Model Class Initialized
INFO - 2025-11-21 14:46:19 --> Model Class Initialized
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=955, Available=1041
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7894, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2786, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=395, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2300, Available=3651
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=26947, Available=7640
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=7406, Available=2393
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20630, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1513, Available=103
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1323, Available=577
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=654, Available=1336
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13354, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=207397, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5963, Available=2313
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=20004, Available=1405
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1500, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 14:46:19 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 14:46:19 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 14:46:19 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 14:46:19 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 14:46:19 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
ERROR - 2025-11-21 14:46:19 --> Severity: Warning --> Undefined variable $stores C:\xampp\htdocs\Inventory_CI\application\views\products\purchases.php 99
ERROR - 2025-11-21 14:46:19 --> Severity: Warning --> foreach() argument must be of type array|object, null given C:\xampp\htdocs\Inventory_CI\application\views\products\purchases.php 99
INFO - 2025-11-21 14:46:19 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 14:46:19 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 14:46:19 --> Final output sent to browser
DEBUG - 2025-11-21 14:46:19 --> Total execution time: 0.4071
INFO - 2025-11-21 14:46:20 --> Config Class Initialized
INFO - 2025-11-21 14:46:20 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:46:20 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:46:20 --> Utf8 Class Initialized
INFO - 2025-11-21 14:46:20 --> URI Class Initialized
INFO - 2025-11-21 14:46:20 --> Router Class Initialized
INFO - 2025-11-21 14:46:20 --> Output Class Initialized
INFO - 2025-11-21 14:46:20 --> Security Class Initialized
DEBUG - 2025-11-21 14:46:20 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:46:20 --> Input Class Initialized
INFO - 2025-11-21 14:46:20 --> Language Class Initialized
INFO - 2025-11-21 14:46:20 --> Loader Class Initialized
INFO - 2025-11-21 14:46:20 --> Helper loaded: url_helper
INFO - 2025-11-21 14:46:20 --> Helper loaded: form_helper
INFO - 2025-11-21 14:46:20 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:46:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:46:20 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:46:20 --> Form Validation Class Initialized
INFO - 2025-11-21 14:46:20 --> Controller Class Initialized
DEBUG - 2025-11-21 14:46:20 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:46:20 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:46:20 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:46:20 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:46:20 --> Model Class Initialized
INFO - 2025-11-21 14:46:20 --> Model Class Initialized
INFO - 2025-11-21 14:46:20 --> Model Class Initialized
ERROR - 2025-11-21 14:46:20 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:46:20 --> Model Class Initialized
INFO - 2025-11-21 14:46:20 --> Model Class Initialized
INFO - 2025-11-21 14:46:20 --> Model Class Initialized
INFO - 2025-11-21 14:46:20 --> Model Class Initialized
DEBUG - 2025-11-21 14:46:20 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 14:46:20 --> Final output sent to browser
DEBUG - 2025-11-21 14:46:20 --> Total execution time: 0.0668
INFO - 2025-11-21 14:46:23 --> Config Class Initialized
INFO - 2025-11-21 14:46:23 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:46:23 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:46:23 --> Utf8 Class Initialized
INFO - 2025-11-21 14:46:23 --> URI Class Initialized
INFO - 2025-11-21 14:46:23 --> Router Class Initialized
INFO - 2025-11-21 14:46:23 --> Output Class Initialized
INFO - 2025-11-21 14:46:23 --> Security Class Initialized
DEBUG - 2025-11-21 14:46:23 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:46:23 --> Input Class Initialized
INFO - 2025-11-21 14:46:23 --> Language Class Initialized
INFO - 2025-11-21 14:46:23 --> Loader Class Initialized
INFO - 2025-11-21 14:46:23 --> Helper loaded: url_helper
INFO - 2025-11-21 14:46:23 --> Helper loaded: form_helper
INFO - 2025-11-21 14:46:23 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:46:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:46:23 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:46:23 --> Form Validation Class Initialized
INFO - 2025-11-21 14:46:23 --> Controller Class Initialized
DEBUG - 2025-11-21 14:46:23 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:46:23 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:46:23 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:46:23 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:46:23 --> Model Class Initialized
INFO - 2025-11-21 14:46:23 --> Model Class Initialized
INFO - 2025-11-21 14:46:23 --> Model Class Initialized
ERROR - 2025-11-21 14:46:23 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:46:23 --> Model Class Initialized
INFO - 2025-11-21 14:46:23 --> Model Class Initialized
INFO - 2025-11-21 14:46:23 --> Model Class Initialized
INFO - 2025-11-21 14:46:23 --> Model Class Initialized
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 78 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 138 in store 7: Purchased=16, Sold=0, Available=16
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 79 in store 7: Purchased=989, Sold=8, Available=981
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 80 in store 7: Purchased=205, Sold=47, Available=158
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 81 in store 7: Purchased=1996, Sold=955, Available=1041
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 145 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 139 in store 7: Purchased=2, Sold=1, Available=1
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 82 in store 7: Purchased=0, Sold=7894, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 83 in store 7: Purchased=0, Sold=2786, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 84 in store 7: Purchased=189, Sold=17, Available=172
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 85 in store 7: Purchased=137, Sold=3, Available=134
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 127 in store 7: Purchased=2000, Sold=327, Available=1673
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 86 in store 7: Purchased=384, Sold=395, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 87 in store 7: Purchased=588, Sold=548, Available=40
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 88 in store 7: Purchased=837, Sold=508, Available=329
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 89 in store 7: Purchased=2114, Sold=659, Available=1455
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 90 in store 7: Purchased=470, Sold=284, Available=186
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 126 in store 7: Purchased=25, Sold=0, Available=25
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 91 in store 7: Purchased=26, Sold=0, Available=26
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 92 in store 7: Purchased=25, Sold=24, Available=1
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 93 in store 7: Purchased=752, Sold=854, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 94 in store 7: Purchased=764, Sold=582, Available=182
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 95 in store 7: Purchased=2263, Sold=365, Available=1898
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 96 in store 7: Purchased=18856, Sold=2884, Available=15972
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 134 in store 7: Purchased=604, Sold=69, Available=535
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 130 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 133 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 131 in store 7: Purchased=19, Sold=0, Available=19
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 97 in store 7: Purchased=5951, Sold=2300, Available=3651
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 98 in store 7: Purchased=442, Sold=39, Available=403
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 99 in store 7: Purchased=2, Sold=0, Available=2
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 100 in store 7: Purchased=34587, Sold=26947, Available=7640
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 137 in store 7: Purchased=189, Sold=4, Available=185
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 101 in store 7: Purchased=107, Sold=22, Available=85
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 102 in store 7: Purchased=9799, Sold=7406, Available=2393
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 103 in store 7: Purchased=16701, Sold=20630, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 104 in store 7: Purchased=7500, Sold=784, Available=6716
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 142 in store 7: Purchased=36, Sold=0, Available=36
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 140 in store 7: Purchased=10, Sold=0, Available=10
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 105 in store 7: Purchased=358, Sold=201, Available=157
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 106 in store 7: Purchased=738, Sold=641, Available=97
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 125 in store 7: Purchased=253, Sold=0, Available=253
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 108 in store 7: Purchased=2503, Sold=2027, Available=476
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 109 in store 7: Purchased=2571, Sold=660, Available=1911
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 110 in store 7: Purchased=1616, Sold=1513, Available=103
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 132 in store 7: Purchased=200, Sold=175, Available=25
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 111 in store 7: Purchased=406, Sold=80, Available=326
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 112 in store 7: Purchased=1900, Sold=1323, Available=577
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 113 in store 7: Purchased=2241, Sold=825, Available=1416
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 135 in store 7: Purchased=1990, Sold=654, Available=1336
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 114 in store 7: Purchased=922, Sold=45, Available=877
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 115 in store 7: Purchased=12262, Sold=13354, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 116 in store 7: Purchased=174549, Sold=207397, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 107 in store 7: Purchased=1200, Sold=836, Available=364
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 117 in store 7: Purchased=8276, Sold=5963, Available=2313
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 118 in store 7: Purchased=21409, Sold=20004, Available=1405
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 144 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 129 in store 7: Purchased=1206, Sold=1500, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 119 in store 7: Purchased=0, Sold=0, Available=0
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 120 in store 7: Purchased=758, Sold=376, Available=382
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 121 in store 7: Purchased=63, Sold=1, Available=62
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 122 in store 7: Purchased=688, Sold=207, Available=481
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 123 in store 7: Purchased=2020, Sold=1660, Available=360
DEBUG - 2025-11-21 14:46:23 --> Stock calculation for product 124 in store 7: Purchased=3646, Sold=4439, Available=0
DEBUG - 2025-11-21 14:46:23 --> Purchases view loaded - Store ID: 7, Is Admin: No, Products Count: 64
INFO - 2025-11-21 14:46:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 14:46:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 14:46:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
ERROR - 2025-11-21 14:46:23 --> Severity: Warning --> Undefined variable $stores C:\xampp\htdocs\Inventory_CI\application\views\products\purchases.php 99
ERROR - 2025-11-21 14:46:23 --> Severity: Warning --> foreach() argument must be of type array|object, null given C:\xampp\htdocs\Inventory_CI\application\views\products\purchases.php 99
INFO - 2025-11-21 14:46:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\products/purchases.php
INFO - 2025-11-21 14:46:23 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 14:46:23 --> Final output sent to browser
DEBUG - 2025-11-21 14:46:23 --> Total execution time: 0.2008
INFO - 2025-11-21 14:46:23 --> Config Class Initialized
INFO - 2025-11-21 14:46:23 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:46:23 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:46:23 --> Utf8 Class Initialized
INFO - 2025-11-21 14:46:23 --> URI Class Initialized
INFO - 2025-11-21 14:46:23 --> Router Class Initialized
INFO - 2025-11-21 14:46:23 --> Output Class Initialized
INFO - 2025-11-21 14:46:23 --> Security Class Initialized
DEBUG - 2025-11-21 14:46:23 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:46:23 --> Input Class Initialized
INFO - 2025-11-21 14:46:23 --> Language Class Initialized
INFO - 2025-11-21 14:46:23 --> Loader Class Initialized
INFO - 2025-11-21 14:46:23 --> Helper loaded: url_helper
INFO - 2025-11-21 14:46:23 --> Helper loaded: form_helper
INFO - 2025-11-21 14:46:23 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:46:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:46:23 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:46:23 --> Form Validation Class Initialized
INFO - 2025-11-21 14:46:23 --> Controller Class Initialized
DEBUG - 2025-11-21 14:46:23 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:46:23 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:46:23 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:46:23 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:46:23 --> Model Class Initialized
INFO - 2025-11-21 14:46:23 --> Model Class Initialized
INFO - 2025-11-21 14:46:23 --> Model Class Initialized
ERROR - 2025-11-21 14:46:23 --> Purchases model not found. Expected Model_purchases.php or model_purchases.php
INFO - 2025-11-21 14:46:23 --> Model Class Initialized
INFO - 2025-11-21 14:46:23 --> Model Class Initialized
INFO - 2025-11-21 14:46:23 --> Model Class Initialized
INFO - 2025-11-21 14:46:23 --> Model Class Initialized
DEBUG - 2025-11-21 14:46:23 --> getPurchasesData SQL: SELECT `purchases`.*, `products`.`name` as `product_name`, `products`.`unit`, `stores`.`name` as `store_name`, `users`.`username` as `created_by_name`
FROM `purchases`
JOIN `products` ON `products`.`id` = `purchases`.`product_id`
JOIN `stores` ON `stores`.`id` = `purchases`.`store_id`
LEFT JOIN `users` ON `users`.`id` = `purchases`.`user_id`
WHERE `purchases`.`store_id` = '7'
ORDER BY `purchases`.`purchase_date` DESC
INFO - 2025-11-21 14:46:23 --> Final output sent to browser
DEBUG - 2025-11-21 14:46:23 --> Total execution time: 0.0569
INFO - 2025-11-21 14:49:28 --> Config Class Initialized
INFO - 2025-11-21 14:49:28 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:49:28 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:49:28 --> Utf8 Class Initialized
INFO - 2025-11-21 14:49:28 --> URI Class Initialized
INFO - 2025-11-21 14:49:28 --> Router Class Initialized
INFO - 2025-11-21 14:49:28 --> Output Class Initialized
INFO - 2025-11-21 14:49:28 --> Security Class Initialized
DEBUG - 2025-11-21 14:49:28 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:49:28 --> Input Class Initialized
INFO - 2025-11-21 14:49:28 --> Language Class Initialized
INFO - 2025-11-21 14:49:28 --> Loader Class Initialized
INFO - 2025-11-21 14:49:28 --> Helper loaded: url_helper
INFO - 2025-11-21 14:49:28 --> Helper loaded: form_helper
INFO - 2025-11-21 14:49:28 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:49:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:49:28 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:49:28 --> Form Validation Class Initialized
INFO - 2025-11-21 14:49:28 --> Controller Class Initialized
DEBUG - 2025-11-21 14:49:28 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:49:28 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:49:28 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:49:28 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:49:28 --> Model Class Initialized
INFO - 2025-11-21 14:49:28 --> Model Class Initialized
INFO - 2025-11-21 14:49:28 --> Model Class Initialized
INFO - 2025-11-21 14:49:28 --> Model Class Initialized
INFO - 2025-11-21 14:49:28 --> Model Class Initialized
INFO - 2025-11-21 14:49:28 --> Model Class Initialized
DEBUG - 2025-11-21 14:49:28 --> Index loaded - Store: 7, Is Privileged: No
ERROR - 2025-11-21 14:49:28 --> Severity: Warning --> Undefined variable $page_title C:\xampp\htdocs\Inventory_CI\application\views\templates\header.php 7
INFO - 2025-11-21 14:49:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 14:49:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 14:49:28 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 14:49:29 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\orders/index.php
INFO - 2025-11-21 14:49:29 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 14:49:29 --> Final output sent to browser
DEBUG - 2025-11-21 14:49:29 --> Total execution time: 0.4210
INFO - 2025-11-21 14:49:29 --> Config Class Initialized
INFO - 2025-11-21 14:49:29 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:49:29 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:49:29 --> Utf8 Class Initialized
INFO - 2025-11-21 14:49:29 --> URI Class Initialized
INFO - 2025-11-21 14:49:29 --> Router Class Initialized
INFO - 2025-11-21 14:49:29 --> Output Class Initialized
INFO - 2025-11-21 14:49:29 --> Security Class Initialized
DEBUG - 2025-11-21 14:49:29 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:49:29 --> Input Class Initialized
INFO - 2025-11-21 14:49:29 --> Language Class Initialized
INFO - 2025-11-21 14:49:29 --> Loader Class Initialized
INFO - 2025-11-21 14:49:29 --> Helper loaded: url_helper
INFO - 2025-11-21 14:49:29 --> Helper loaded: form_helper
INFO - 2025-11-21 14:49:29 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:49:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:49:29 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:49:29 --> Form Validation Class Initialized
INFO - 2025-11-21 14:49:29 --> Controller Class Initialized
DEBUG - 2025-11-21 14:49:29 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:49:29 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:49:29 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:49:29 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:49:29 --> Model Class Initialized
INFO - 2025-11-21 14:49:29 --> Model Class Initialized
INFO - 2025-11-21 14:49:29 --> Model Class Initialized
INFO - 2025-11-21 14:49:29 --> Model Class Initialized
INFO - 2025-11-21 14:49:29 --> Model Class Initialized
INFO - 2025-11-21 14:49:29 --> Model Class Initialized
DEBUG - 2025-11-21 14:49:29 --> fetchOrdersData - Store ID: 7, Group ID: , Is Privileged: No
DEBUG - 2025-11-21 14:49:29 --> Adding store restriction for store_id: 7
DEBUG - 2025-11-21 14:49:29 --> Executing query: SELECT o.*,
                    COALESCE(s.name, 'N/A') as store_name,
                    COALESCE(u.username, 'Unknown') as clerk_name
                    FROM orders o
                    LEFT JOIN stores s ON o.store_id = s.id
                    LEFT JOIN users u ON o.user_id = u.id WHERE o.store_id = '7' ORDER BY o.id DESC
DEBUG - 2025-11-21 14:49:29 --> Query returned 1024 results
DEBUG - 2025-11-21 14:49:29 --> Found 1024 orders for user
INFO - 2025-11-21 14:49:29 --> Final output sent to browser
DEBUG - 2025-11-21 14:49:29 --> Total execution time: 0.0704
INFO - 2025-11-21 14:49:41 --> Config Class Initialized
INFO - 2025-11-21 14:49:41 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:49:41 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:49:41 --> Utf8 Class Initialized
INFO - 2025-11-21 14:49:41 --> URI Class Initialized
INFO - 2025-11-21 14:49:41 --> Router Class Initialized
INFO - 2025-11-21 14:49:41 --> Output Class Initialized
INFO - 2025-11-21 14:49:41 --> Security Class Initialized
DEBUG - 2025-11-21 14:49:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:49:41 --> Input Class Initialized
INFO - 2025-11-21 14:49:41 --> Language Class Initialized
INFO - 2025-11-21 14:49:41 --> Loader Class Initialized
INFO - 2025-11-21 14:49:41 --> Helper loaded: url_helper
INFO - 2025-11-21 14:49:41 --> Helper loaded: form_helper
INFO - 2025-11-21 14:49:41 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:49:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:49:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:49:41 --> Form Validation Class Initialized
INFO - 2025-11-21 14:49:41 --> Controller Class Initialized
DEBUG - 2025-11-21 14:49:41 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:49:41 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:49:41 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:49:41 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:49:41 --> Model Class Initialized
INFO - 2025-11-21 14:49:41 --> Model Class Initialized
INFO - 2025-11-21 14:49:41 --> Model Class Initialized
INFO - 2025-11-21 14:49:41 --> Model Class Initialized
INFO - 2025-11-21 14:49:41 --> Model Class Initialized
INFO - 2025-11-21 14:49:41 --> Model Class Initialized
DEBUG - 2025-11-21 14:49:41 --> User Info - Store ID: 7, Group ID: , Is Privileged: No
DEBUG - 2025-11-21 14:49:41 --> Single order query: SELECT o.*,
                        COALESCE(s.name, 'N/A') as store_name,
                        COALESCE(u.username, 'Unknown') as clerk_name
                        FROM orders o
                        LEFT JOIN stores s ON o.store_id = s.id
                        LEFT JOIN users u ON o.user_id = u.id
                        WHERE o.id = '1204' AND o.store_id = '7'
INFO - 2025-11-21 14:49:41 --> Final output sent to browser
DEBUG - 2025-11-21 14:49:41 --> Total execution time: 0.1273
INFO - 2025-11-21 14:49:41 --> Config Class Initialized
INFO - 2025-11-21 14:49:41 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:49:41 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:49:41 --> Utf8 Class Initialized
INFO - 2025-11-21 14:49:41 --> URI Class Initialized
INFO - 2025-11-21 14:49:41 --> Router Class Initialized
INFO - 2025-11-21 14:49:41 --> Output Class Initialized
INFO - 2025-11-21 14:49:41 --> Security Class Initialized
DEBUG - 2025-11-21 14:49:41 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:49:41 --> Input Class Initialized
INFO - 2025-11-21 14:49:41 --> Language Class Initialized
INFO - 2025-11-21 14:49:41 --> Loader Class Initialized
INFO - 2025-11-21 14:49:41 --> Helper loaded: url_helper
INFO - 2025-11-21 14:49:41 --> Helper loaded: form_helper
INFO - 2025-11-21 14:49:41 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:49:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:49:41 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:49:41 --> Form Validation Class Initialized
INFO - 2025-11-21 14:49:41 --> Controller Class Initialized
DEBUG - 2025-11-21 14:49:41 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:49:41 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:49:41 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:49:41 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:49:41 --> Model Class Initialized
INFO - 2025-11-21 14:49:41 --> Model Class Initialized
INFO - 2025-11-21 14:49:41 --> Model Class Initialized
INFO - 2025-11-21 14:49:41 --> Model Class Initialized
INFO - 2025-11-21 14:49:41 --> Model Class Initialized
INFO - 2025-11-21 14:49:41 --> Model Class Initialized
DEBUG - 2025-11-21 14:49:41 --> fetchOrdersData - Store ID: 7, Group ID: , Is Privileged: No
DEBUG - 2025-11-21 14:49:41 --> Adding store restriction for store_id: 7
DEBUG - 2025-11-21 14:49:41 --> Executing query: SELECT o.*,
                    COALESCE(s.name, 'N/A') as store_name,
                    COALESCE(u.username, 'Unknown') as clerk_name
                    FROM orders o
                    LEFT JOIN stores s ON o.store_id = s.id
                    LEFT JOIN users u ON o.user_id = u.id WHERE o.store_id = '7' ORDER BY o.id DESC
DEBUG - 2025-11-21 14:49:41 --> Query returned 1023 results
DEBUG - 2025-11-21 14:49:41 --> Found 1023 orders for user
INFO - 2025-11-21 14:49:41 --> Final output sent to browser
DEBUG - 2025-11-21 14:49:41 --> Total execution time: 0.0583
INFO - 2025-11-21 14:49:45 --> Config Class Initialized
INFO - 2025-11-21 14:49:45 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:49:45 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:49:45 --> Utf8 Class Initialized
INFO - 2025-11-21 14:49:45 --> URI Class Initialized
INFO - 2025-11-21 14:49:45 --> Router Class Initialized
INFO - 2025-11-21 14:49:45 --> Output Class Initialized
INFO - 2025-11-21 14:49:45 --> Security Class Initialized
DEBUG - 2025-11-21 14:49:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:49:45 --> Input Class Initialized
INFO - 2025-11-21 14:49:45 --> Language Class Initialized
INFO - 2025-11-21 14:49:45 --> Loader Class Initialized
INFO - 2025-11-21 14:49:45 --> Helper loaded: url_helper
INFO - 2025-11-21 14:49:45 --> Helper loaded: form_helper
INFO - 2025-11-21 14:49:45 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:49:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:49:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:49:45 --> Form Validation Class Initialized
INFO - 2025-11-21 14:49:45 --> Controller Class Initialized
DEBUG - 2025-11-21 14:49:45 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:49:45 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:49:45 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:49:45 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:49:45 --> Model Class Initialized
INFO - 2025-11-21 14:49:45 --> Model Class Initialized
INFO - 2025-11-21 14:49:45 --> Model Class Initialized
INFO - 2025-11-21 14:49:45 --> Model Class Initialized
INFO - 2025-11-21 14:49:45 --> Model Class Initialized
INFO - 2025-11-21 14:49:45 --> Model Class Initialized
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 78, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 138, purchased: 16, ordered: 0, stock: 16
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 79, purchased: 989, ordered: 8, stock: 981
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 80, purchased: 205, ordered: 47, stock: 158
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 81, purchased: 1996, ordered: 955, stock: 1041
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 139, purchased: 2, ordered: 1, stock: 1
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 82, purchased: 0, ordered: 7894, stock: 0
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 83, purchased: 0, ordered: 2786, stock: 0
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 84, purchased: 189, ordered: 17, stock: 172
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 85, purchased: 137, ordered: 3, stock: 134
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 127, purchased: 2000, ordered: 327, stock: 1673
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 86, purchased: 384, ordered: 335, stock: 49
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 87, purchased: 588, ordered: 548, stock: 40
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 88, purchased: 837, ordered: 508, stock: 329
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 89, purchased: 2114, ordered: 659, stock: 1455
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 90, purchased: 470, ordered: 284, stock: 186
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 126, purchased: 25, ordered: 0, stock: 25
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 91, purchased: 26, ordered: 0, stock: 26
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 92, purchased: 25, ordered: 24, stock: 1
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 93, purchased: 752, ordered: 854, stock: 0
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 94, purchased: 764, ordered: 582, stock: 182
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 95, purchased: 2263, ordered: 365, stock: 1898
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 96, purchased: 18856, ordered: 2884, stock: 15972
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 134, purchased: 604, ordered: 69, stock: 535
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 130, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 133, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 131, purchased: 19, ordered: 0, stock: 19
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 97, purchased: 5951, ordered: 2300, stock: 3651
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 98, purchased: 442, ordered: 39, stock: 403
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 99, purchased: 2, ordered: 0, stock: 2
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 100, purchased: 34587, ordered: 26947, stock: 7640
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 137, purchased: 189, ordered: 4, stock: 185
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 101, purchased: 107, ordered: 22, stock: 85
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 102, purchased: 9799, ordered: 7406, stock: 2393
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 103, purchased: 16701, ordered: 20630, stock: 0
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 104, purchased: 7500, ordered: 784, stock: 6716
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 142, purchased: 36, ordered: 0, stock: 36
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 140, purchased: 10, ordered: 0, stock: 10
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 105, purchased: 358, ordered: 201, stock: 157
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 106, purchased: 738, ordered: 641, stock: 97
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 125, purchased: 253, ordered: 0, stock: 253
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 108, purchased: 2503, ordered: 2027, stock: 476
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 109, purchased: 2571, ordered: 660, stock: 1911
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 110, purchased: 1616, ordered: 1513, stock: 103
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 132, purchased: 200, ordered: 175, stock: 25
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 111, purchased: 406, ordered: 80, stock: 326
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 112, purchased: 1900, ordered: 1323, stock: 577
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 113, purchased: 2241, ordered: 825, stock: 1416
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 135, purchased: 1990, ordered: 654, stock: 1336
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 114, purchased: 922, ordered: 45, stock: 877
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 115, purchased: 12262, ordered: 13354, stock: 0
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 116, purchased: 174549, ordered: 207397, stock: 0
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 107, purchased: 1200, ordered: 836, stock: 364
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 117, purchased: 8276, ordered: 5963, stock: 2313
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 118, purchased: 21409, ordered: 20004, stock: 1405
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 129, purchased: 1206, ordered: 1500, stock: 0
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 119, purchased: 0, ordered: 0, stock: 0
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 120, purchased: 758, ordered: 376, stock: 382
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 121, purchased: 63, ordered: 1, stock: 62
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 122, purchased: 688, ordered: 207, stock: 481
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 123, purchased: 2020, ordered: 1660, stock: 360
DEBUG - 2025-11-21 14:49:45 --> getProductsWithStock - ID: 124, purchased: 3646, ordered: 4439, stock: 0
DEBUG - 2025-11-21 14:49:45 --> Prepared products for create view: [{"id":78,"name":"BROILER BOOSTER","price":3000,"current_stock":0,"unit":""},{"id":138,"name":"BROILER EXTRA","price":3000,"current_stock":16,"unit":""},{"id":79,"name":"BROILER FINISHER MASH","price":1000,"current_stock":981,"unit":""},{"id":80,"name":"BROILER PREMIX","price":3000,"current_stock":158,"unit":""},{"id":81,"name":"BROILER STARTER MASH","price":1000,"current_stock":1041,"unit":""},{"id":139,"name":"CHIKWIDI","price":15000,"current_stock":1,"unit":""},{"id":82,"name":"CHOKAA","price":500,"current_stock":0,"unit":""},{"id":83,"name":"CHUMVI","price":500,"current_stock":0,"unit":""},{"id":84,"name":"D.C.P KOPO (1\/2)","price":2000,"current_stock":172,"unit":""},{"id":85,"name":"D.C.P KOPO 1KG","price":3000,"current_stock":134,"unit":""},{"id":127,"name":"D.C.P KUPIMA","price":1500,"current_stock":1673,"unit":""},{"id":86,"name":"DAGAA KAUZU","price":2800,"current_stock":49,"unit":""},{"id":87,"name":"DAGAA SAGWA","price":2000,"current_stock":40,"unit":""},{"id":88,"name":"DAMU","price":1500,"current_stock":329,"unit":""},{"id":89,"name":"GROWER MASH","price":1000,"current_stock":1455,"unit":""},{"id":90,"name":"HAMIRA","price":1500,"current_stock":186,"unit":""},{"id":126,"name":"HIPHOS PLUS","price":5000,"current_stock":25,"unit":""},{"id":91,"name":"JOSERA MADUME","price":11000,"current_stock":26,"unit":""},{"id":92,"name":"JOSERA MAZIWA","price":11000,"current_stock":1,"unit":""},{"id":93,"name":"KARANGA","price":700,"current_stock":0,"unit":""},{"id":94,"name":"KAUDIS NGURUWE","price":4000,"current_stock":182,"unit":""},{"id":95,"name":"KAYABO","price":2000,"current_stock":1898,"unit":""},{"id":96,"name":"KONOKONO","price":350,"current_stock":15972,"unit":""},{"id":134,"name":"KONOKONO NZIMA","price":400,"current_stock":535,"unit":""},{"id":130,"name":"KONOKONO SAGWA","price":470,"current_stock":0,"unit":""},{"id":133,"name":"KONOKONO SAGWA","price":600,"current_stock":0,"unit":""},{"id":131,"name":"LAYERS EXTRA","price":3500,"current_stock":19,"unit":""},{"id":97,"name":"LAYERS MASH","price":1000,"current_stock":3651,"unit":""},{"id":98,"name":"LAYERS PREMIX","price":3500,"current_stock":403,"unit":""},{"id":99,"name":"MADUME LICK","price":5000,"current_stock":2,"unit":""},{"id":100,"name":"MAHINDI","price":730,"current_stock":7640,"unit":""},{"id":137,"name":"MAZIWA MENGI 1KG","price":1500,"current_stock":185,"unit":""},{"id":101,"name":"MAZIWA MENGI 2kg","price":3000,"current_stock":85,"unit":""},{"id":102,"name":"MCHELE LAINI","price":400,"current_stock":2393,"unit":""},{"id":103,"name":"MCHELE NGUMU","price":320,"current_stock":0,"unit":""},{"id":104,"name":"MFUPA","price":700,"current_stock":6716,"unit":""},{"id":142,"name":"MOLLASSES 1LITRE","price":5000,"current_stock":36,"unit":""},{"id":140,"name":"MOLLASSES 5LITRE","price":15000,"current_stock":10,"unit":""},{"id":105,"name":"MTAMA","price":1000,"current_stock":157,"unit":""},{"id":106,"name":"NGANO","price":1000,"current_stock":97,"unit":""},{"id":125,"name":"NGURUWE MIX","price":3500,"current_stock":253,"unit":""},{"id":108,"name":"PAMBA LAINI","price":1200,"current_stock":476,"unit":""},{"id":109,"name":"PAMBA NGUMU","price":1200,"current_stock":1911,"unit":""},{"id":110,"name":"PARAZA","price":1000,"current_stock":103,"unit":""},{"id":132,"name":"PELLET FINISHER","price":2000,"current_stock":25,"unit":""},{"id":111,"name":"PIG BOOSTER","price":3000,"current_stock":326,"unit":""},{"id":112,"name":"PIG GROWER","price":1000,"current_stock":577,"unit":""},{"id":113,"name":"PIG STARTER","price":1000,"current_stock":1416,"unit":""},{"id":135,"name":"PILLET STARTER","price":2000,"current_stock":1336,"unit":""},{"id":114,"name":"PILLLET GROWER","price":2000,"current_stock":877,"unit":""},{"id":115,"name":"POLLARD","price":750,"current_stock":0,"unit":""},{"id":116,"name":"PUMBA","price":660,"current_stock":0,"unit":""},{"id":107,"name":"PUMBA MAHINDI LAINI","price":600,"current_stock":364,"unit":""},{"id":117,"name":"SHUDU LAINI","price":900,"current_stock":2313,"unit":""},{"id":118,"name":"SHUDU NGUMU","price":800,"current_stock":1405,"unit":""},{"id":129,"name":"SOYA CHENGA","price":2500,"current_stock":0,"unit":""},{"id":119,"name":"SOYA MAFUTA","price":2500,"current_stock":0,"unit":""},{"id":120,"name":"SOYA UNGA","price":2000,"current_stock":382,"unit":""},{"id":121,"name":"SUPER MACLICK","price":3500,"current_stock":62,"unit":""},{"id":122,"name":"UBUYU","price":700,"current_stock":481,"unit":""},{"id":123,"name":"UDUVI","price":3500,"current_stock":360,"unit":""},{"id":124,"name":"WHEAT","price":650,"current_stock":0,"unit":""}]
ERROR - 2025-11-21 14:49:45 --> Severity: Warning --> Undefined variable $page_title C:\xampp\htdocs\Inventory_CI\application\views\templates\header.php 7
INFO - 2025-11-21 14:49:45 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header.php
INFO - 2025-11-21 14:49:45 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/header_menu.php
INFO - 2025-11-21 14:49:45 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/side_menubar.php
INFO - 2025-11-21 14:49:45 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\orders/create.php
INFO - 2025-11-21 14:49:45 --> File loaded: C:\xampp\htdocs\Inventory_CI\application\views\templates/footer.php
INFO - 2025-11-21 14:49:45 --> Final output sent to browser
DEBUG - 2025-11-21 14:49:45 --> Total execution time: 0.1487
INFO - 2025-11-21 14:49:45 --> Config Class Initialized
INFO - 2025-11-21 14:49:45 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:49:45 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:49:45 --> Utf8 Class Initialized
INFO - 2025-11-21 14:49:45 --> URI Class Initialized
INFO - 2025-11-21 14:49:45 --> Router Class Initialized
INFO - 2025-11-21 14:49:45 --> Output Class Initialized
INFO - 2025-11-21 14:49:45 --> Security Class Initialized
DEBUG - 2025-11-21 14:49:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:49:45 --> Input Class Initialized
INFO - 2025-11-21 14:49:45 --> Language Class Initialized
ERROR - 2025-11-21 14:49:45 --> 404 Page Not Found: Assets/plugins
INFO - 2025-11-21 14:52:02 --> Config Class Initialized
INFO - 2025-11-21 14:52:02 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:52:02 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:52:02 --> Utf8 Class Initialized
INFO - 2025-11-21 14:52:02 --> URI Class Initialized
INFO - 2025-11-21 14:52:02 --> Router Class Initialized
INFO - 2025-11-21 14:52:02 --> Output Class Initialized
INFO - 2025-11-21 14:52:02 --> Security Class Initialized
DEBUG - 2025-11-21 14:52:02 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:52:02 --> Input Class Initialized
INFO - 2025-11-21 14:52:02 --> Language Class Initialized
INFO - 2025-11-21 14:52:02 --> Loader Class Initialized
INFO - 2025-11-21 14:52:02 --> Helper loaded: url_helper
INFO - 2025-11-21 14:52:02 --> Helper loaded: form_helper
INFO - 2025-11-21 14:52:02 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:52:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:52:02 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:52:02 --> Form Validation Class Initialized
INFO - 2025-11-21 14:52:02 --> Controller Class Initialized
DEBUG - 2025-11-21 14:52:02 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:52:02 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:52:02 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:52:02 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:52:02 --> Model Class Initialized
INFO - 2025-11-21 14:52:02 --> Model Class Initialized
INFO - 2025-11-21 14:52:02 --> Model Class Initialized
INFO - 2025-11-21 14:52:02 --> Model Class Initialized
INFO - 2025-11-21 14:52:02 --> Model Class Initialized
INFO - 2025-11-21 14:52:02 --> Model Class Initialized
DEBUG - 2025-11-21 14:52:02 --> Controller_Orders::create POST: {"customer_name":"M.KEV","customer_phone":"","customer_address":"","store_id":"7","product":["100","116","118","82"],"qty":["1500","350","300","300"],"rate":["730.00","640","800.00","240.00"],"rate_value":["730.00","640","800.00","240.00"],"amount":["1095000.00","224000.00","240000.00","72000"],"amount_value":["1095000.00","224000.00","240000.00","72000"],"discount":"0","paid_status":"2","amount_paid":"1631000.00","gross_amount_value":"1631000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"1631000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:52:02 --> Final output sent to browser
DEBUG - 2025-11-21 14:52:02 --> Total execution time: 0.1869
INFO - 2025-11-21 14:52:30 --> Config Class Initialized
INFO - 2025-11-21 14:52:30 --> Hooks Class Initialized
DEBUG - 2025-11-21 14:52:30 --> UTF-8 Support Enabled
INFO - 2025-11-21 14:52:30 --> Utf8 Class Initialized
INFO - 2025-11-21 14:52:30 --> URI Class Initialized
INFO - 2025-11-21 14:52:30 --> Router Class Initialized
INFO - 2025-11-21 14:52:30 --> Output Class Initialized
INFO - 2025-11-21 14:52:30 --> Security Class Initialized
DEBUG - 2025-11-21 14:52:30 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-11-21 14:52:30 --> Input Class Initialized
INFO - 2025-11-21 14:52:30 --> Language Class Initialized
INFO - 2025-11-21 14:52:30 --> Loader Class Initialized
INFO - 2025-11-21 14:52:30 --> Helper loaded: url_helper
INFO - 2025-11-21 14:52:30 --> Helper loaded: form_helper
INFO - 2025-11-21 14:52:30 --> Database Driver Class Initialized
DEBUG - 2025-11-21 14:52:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2025-11-21 14:52:30 --> Session: Class initialized using 'files' driver.
INFO - 2025-11-21 14:52:30 --> Form Validation Class Initialized
INFO - 2025-11-21 14:52:30 --> Controller Class Initialized
DEBUG - 2025-11-21 14:52:30 --> Session class already loaded. Second attempt ignored.
DEBUG - 2025-11-21 14:52:30 --> MY_Controller - Role: administrator
DEBUG - 2025-11-21 14:52:30 --> MY_Controller - Is Admin: true
DEBUG - 2025-11-21 14:52:30 --> MY_Controller - Permissions: Array
(
)

INFO - 2025-11-21 14:52:30 --> Model Class Initialized
INFO - 2025-11-21 14:52:30 --> Model Class Initialized
INFO - 2025-11-21 14:52:30 --> Model Class Initialized
INFO - 2025-11-21 14:52:30 --> Model Class Initialized
INFO - 2025-11-21 14:52:30 --> Model Class Initialized
INFO - 2025-11-21 14:52:30 --> Model Class Initialized
DEBUG - 2025-11-21 14:52:30 --> Controller_Orders::create POST: {"customer_name":"SPORAH","customer_phone":"","customer_address":"","store_id":"7","product":["140"],"qty":["1"],"rate":["15000.00"],"rate_value":["15000.00"],"amount":["15000.00"],"amount_value":["15000.00"],"discount":"0","paid_status":"2","amount_paid":"15000.00","gross_amount_value":"15000.00","service_charge_value":"0.00","vat_charge_value":"0.00","net_amount_value":"15000.00","service_charge_rate":"0","vat_charge_rate":"0"}
INFO - 2025-11-21 14:52:30 --> Final output sent to browser
DEBUG - 2025-11-21 14:52:30 --> Total execution time: 0.1586
