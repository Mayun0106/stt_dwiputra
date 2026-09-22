<?php

return [
    'show_warnings' => false,
    'public_path' => base_path('public'),
    'convert_entities' => true,
    'options' => [
        'font_dir' => storage_path('fonts'),
        'font_cache' => storage_path('fonts'),
        'temp_dir' => storage_path('temp'),
        'chroot' => base_path(),
        'default_font' => 'sans-serif',
        'enable_html5_parser' => true,
        'enable_remote' => true,
    ],
];
