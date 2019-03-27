<?php

return [
    'url' => env('CLOUDINARY_URL'),
    'default_params' => [
        'secure'       => true,
        'fetch_format' => 'auto',
    ],
    'base_folder' => env('CLOUDINARY_BASE_FOLDER', ''),
];
