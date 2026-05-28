<?php
use Cloudinary\Configuration\Configuration;

$cloudinary = $_ENV['CLOUDINARY_LINK'] ?? $_SERVER['CLOUDINARY_LINK'] ?? getenv('CLOUDINARY_LINK');

Configuration::instance($cloudinary);

use Cloudinary\Api\Upload\UploadApi;

function uploadImage(mixed $file) {
    $upload = new UploadApi();

    $res = $upload->upload($file['tmp_name'], [
        'folder' => 'php_crm',
        'public_id' => 'contact_' . $file['name'] . '_' .time()
    ]);

    return [
        'link' => $res['secure_url'],
        'id'=> $res['public_id'],
    ];
}

function deleteImage(string $public_id)
{
    $upload = new UploadApi();

    $upload->destroy($public_id);

    return;
}