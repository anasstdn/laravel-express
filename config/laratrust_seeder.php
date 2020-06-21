<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'r,u',
            'user-menu'=>'r',
                'users'=>'r',
            'pegawai-menu'=>'r',
                'pegawai'=>'r',
            'region-menu'=>'r',
                'region'=>'r',
            'tarif-menu'=>'r',
                'tarif'=>'r',
            'laporan-menu'=>'r',
                'laporan'=>'r',
            'barang-menu'=>'r',
                'barang'=>'r',
            'kurir-menu'=>'r',
                'kurir'=>'r',
            'cek-lokasi-barang-menu'=>'r',
                'cek-lokasi-barang'=>'r',
            'pengiriman-barang-menu'=>'r',
                'pengiriman-barang'=>'r',
        ],
        'administrator' => [
            // 'users' => 'c,r,u,d',
            // 'profile' => 'r,u'
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'r,u',
            'user-menu'=>'r',
                'users'=>'r',
            'pegawai-menu'=>'r',
                'pegawai'=>'r',
            'region-menu'=>'r',
                'region'=>'r',
            'tarif-menu'=>'r',
                'tarif'=>'r',
            'laporan-menu'=>'r',
                'laporan'=>'r',
        ],
        'user' => [
            // 'profile' => 'r,u'
            'cek-lokasi-barang-menu'=>'r',
                'cek-lokasi-barang'=>'r',
        ],
        'kurir' => [
            // 'profile' => 'r,u'
            'pengiriman-barang-menu'=>'r',
                'pengiriman-barang'=>'r'
        ],
        'pegawai' => [
            'user-menu'=>'r',
                'users'=>'r',
            'barang-menu'=>'r',
                'barang'=>'r',
            'kurir-menu'=>'r',
                'kurir'=>'r',
        ],
    ],
    'permission_structure' => [
        // 'cru_user' => [
        //     'profile' => 'c,r,u'
        // ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
