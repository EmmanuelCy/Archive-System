**Image Upload Bug**

open php.ini, remove ; from ;extensions=gd

goto xampp/php/ext/php_gd.dll
copy to System32 Folder.

**Set Admin Bug**

classes/Users.php
Line 16
comment out *$_POST['type'] = 2*