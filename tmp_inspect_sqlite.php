<?php
$db = new PDO('sqlite:' . __DIR__ . '/database/database.sqlite');
$schema = $db->query("SELECT sql FROM sqlite_master WHERE tbl_name = 'users' AND type = 'table';")->fetchColumn();
$info = $db->query("PRAGMA table_info('users');")->fetchAll(PDO::FETCH_ASSOC);
echo "SCHEMA:\n" . $schema . "\n\n";
echo "COLUMNS:\n";
foreach ($info as $col) {
    echo "- {$col['cid']} {$col['name']} {$col['type']} NOTNULL={$col['notnull']} DFLT_VALUE={$col['dflt_value']} PK={$col['pk']}\n";
}
