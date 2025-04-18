<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Sidebar Links
    |--------------------------------------------------------------------------
    |
    | Admin panel sidebar links.
    | Add links here to have them show up in the admin panel.
    | Users that do not have the listed power will not be able to
    | view the links in that section.
    |
    */

    'Admin'      => [
        'power' => 'admin',
        'links' => [
            [
                'name' => 'User Ranks',
                'url'  => 'admin/users/ranks',
            ],
            [
                'name' => 'Admin Logs',
                'url'  => 'admin/logs',
            ],
            [
                'name' => 'Staff Reward Settings',
                'url'  => 'admin/staff-reward-settings',
            ],
        ],
    ],
    'Reports'    => [
        'power' => 'manage_reports',
        'links' => [
            [
                'name' => 'Report Queue',
                'url'  => 'admin/reports/pending',
            ],
        ],
    ],
    'News' => [
        'power' => 'manage_news',
        'links' => [
            [
                'name' => 'News',
                'url'  => 'admin/news',
            ],
        ],
    ],
    'Sales' => [
        'power' => 'manage_sales',
        'links' => [
            [
                'name' => 'Sales',
                'url'  => 'admin/sales',
            ],
        ],
    ],
    'Pages'       => [
        'power' => 'edit_pages',
        'links' => [
            [
                'name' => 'Pages',
                'url'  => 'admin/pages',
            ],
            [
                'name' => 'Templates',
                'url' => 'admin/templates'
            ],
        ],
    ],
    'Users'      => [
        'power' => 'edit_user_info',
        'links' => [
            [
                'name' => 'User Index',
                'url'  => 'admin/users',
            ],
            [
                'name' => 'Invitation Keys',
                'url'  => 'admin/invitations',
            ],
        ],
    ],
    'Queues'     => [
        'power' => 'manage_submissions',
        'links' => [
            [
                'name' => 'Gallery Submissions',
                'url'  => 'admin/gallery/submissions',
            ],
            [
                'name' => 'Gallery Currency Awards',
                'url'  => 'admin/gallery/currency',
            ],
            [
                'name' => 'Prompt Submissions',
                'url'  => 'admin/submissions',
            ],
            [
                'name' => 'Claim Submissions',
                'url'  => 'admin/claims',
            ],
        ],
    ],
    'Grants'     => [
        'power' => 'edit_inventories',
        'links' => [
            [
                'name' => 'Currency Grants',
                'url'  => 'admin/grants/user-currency',
            ],
            [
                'name' => 'Item Grants',
                'url'  => 'admin/grants/items',
            ],
            [
                'name' => 'Award Grants',
                'url'  => 'admin/grants/awards',
            ],
            [
                'name' => 'Pet Grants',
                'url'  => 'admin/grants/pets',
            ],
            [
                'name' => 'Recipe Grants',
                'url'  => 'admin/grants/recipes',
            ],
            [
                'name' => 'Encounter Energy Grants',
                'url' => 'admin/grants/encounter-energy'
            ],
        ],
    ],
    'Foraging' => [
        'power' => 'edit_inventories',
        'links' => [
            [
                'name' => 'Forages',
                'url' => 'admin/data/forages'
            ],
        ]
    ],
    'Masterlist' => [
        'power' => 'manage_characters',
        'links' => [
            [
                'name' => 'Create Character',
                'url'  => 'admin/masterlist/create-character',
            ],
            [
                'name' => 'Create MYO Slot',
                'url'  => 'admin/masterlist/create-myo',
            ],
            [
                'name' => 'Character Transfers',
                'url'  => 'admin/masterlist/transfers/incoming',
            ],
            [
                'name' => 'Character Trades',
                'url'  => 'admin/masterlist/trades/incoming',
            ],
            [
                'name' => 'Design Updates',
                'url'  => 'admin/design-approvals/pending',
            ],
            [
                'name' => 'MYO Approvals',
                'url'  => 'admin/myo-approvals/pending',
            ],
        ],
    ],
    'Data'       => [
        'power' => 'edit_data',
        'links' => [
            [
                'name' => 'Galleries',
                'url'  => 'admin/data/galleries',
            ],
            [
                'name' => 'Award Categories',
                'url'  => 'admin/data/award-categories',
            ],
            [
                'name' => 'Awards',
                'url'  => 'admin/data/awards',
            ],
            [
                'name' => 'Character Categories',
                'url'  => 'admin/data/character-categories',
            ],
            [
                'name' => 'Sub Masterlists',
                'url'  => 'admin/data/sublists',
            ],
            [
                'name' => 'Rarities',
                'url'  => 'admin/data/rarities',
            ],
            [
                'name' => 'Species',
                'url'  => 'admin/data/species',
            ],
            [
                'name' => 'Subtypes',
                'url'  => 'admin/data/subtypes',
            ],
            [
                'name' => 'Traits',
                'url'  => 'admin/data/traits',
            ],
            [
                'name' => 'Character Titles',
                'url'  => 'admin/data/character-titles',
            ],
            [
                'name' => 'Shops',
                'url'  => 'admin/data/shops',
            ],
            [
                'name' => 'Dailies',
                'url' => 'admin/data/dailies'
            ],
            [
                'name' => 'Currencies',
                'url'  => 'admin/data/currencies',
            ],
            [
                'name' => 'Prompts',
                'url'  => 'admin/data/prompts',
            ],
            [
                'name' => 'Loot Tables',
                'url'  => 'admin/data/loot-tables',
            ],
            [
                'name' => 'Items',
                'url'  => 'admin/data/items',
            ],
            [
                'name' => 'Transformations',
                'url'  => 'admin/data/transformations',
            ],
            [
                'name' => 'Carousel',
                'url'  => 'admin/data/carousel',
            ],
            [
                'name' => 'Codes',
                'url' => 'admin/prizecodes'
            ],
            [
                'name' => 'FAQ',
                'url'  => 'admin/data/faq',
            ],

            [
                'name' => 'Collections',
                'url' => 'admin/data/collections'
            ],
            [
                'name' => 'Scavenger Hunts',
                'url' => 'admin/data/hunts'
            ],
            [
                'name' => 'Pets',
                'url'  => 'admin/data/pets',
            ],
            [
                'name' => 'Dynamic Limits',
                'url'  => 'admin/data/limits',
            ],
            [
                'name' => 'Recipes',
                'url'  => 'admin/data/recipes',
            ],
            [
                'name' => 'Encounters',
                'url' => 'admin/data/encounters'
            ],
            [
                'name' => 'Encounter Areas',
                'url' => 'admin/data/encounters/areas'
            ],
        ]
    ],
    'Raffles'    => [
        'power' => 'manage_raffles',
        'links' => [
            [
                'name' => 'Raffles',
                'url'  => 'admin/raffles',
            ],
        ],
    ],
    'Pairings'   => [
        'power' => 'edit_data',
        'links' => [
            [
                'name' => 'Pairing Roller',
                'url'  => 'admin/pairings/roller',
            ],
        ],
    ],
    'Cultivation' => [
        'power' => 'edit_data',
        'links' => [
            [
                'name' => 'Areas',
                'url' => 'admin/cultivation/areas'
            ],
            [
                'name' => 'Plots',
                'url' => 'admin/cultivation/plots'
            ],
        ]
    ],

    'Settings' => [
        'power' => 'edit_site_settings',
        'links' => [
            [
                'name' => 'Site Settings',
                'url'  => 'admin/settings',
            ],
            [
                'name' => 'Site Images',
                'url'  => 'admin/images',
            ],
            [
                'name' => 'File Manager',
                'url'  => 'admin/files',
            ],
        ],
    ],
];
