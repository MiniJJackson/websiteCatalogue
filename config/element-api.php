<?php

use craft\elements\Entry;
use craft\elements\Asset;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        '/api/clothing' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'clothing'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function(Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'brand' => $entry->brand,
                        'intro' => $entry->introText,
                        'bannerImg' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
                        'thumbImg' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('thumbnailImage')),
                    ];
                },
            ];
        },
        '/api/clothing/<entryId:\d+>' => function($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function(Entry $entry) {
                  return [
                      'id' => $entry->id,
                      'title' => $entry->title,
                      'fullText' => $entry->fullText,
                      'brand' => $entry->brand,
                      'price' => $entry->price,
                      'bannerImg' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
                      'thumbImg' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('thumbnailImage')),
                  ];
              },
            ];
        },
    ]
];