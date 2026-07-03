<?php
declare(strict_types=1);

// IssCurrentLocation SDK configuration

class IssCurrentLocationConfig
{
    public static function make_config(): array
    {
        return [
            "main" => [
                "name" => "IssCurrentLocation",
            ],
            "feature" => [
                "test" => [
          'options' => [
            'active' => false,
          ],
        ],
            ],
            "options" => [
                "base" => "http://api.open-notify.org",
                "auth" => [
                    "prefix" => "Bearer",
                ],
                "headers" => [
          'content-type' => 'application/json',
        ],
                "entity" => [
                    "iss_location" => [],
                ],
            ],
            "entity" => [
        'iss_location' => [
          'fields' => [
            [
              'active' => true,
              'name' => 'iss_position',
              'req' => true,
              'type' => '`$OBJECT`',
              'index$' => 0,
            ],
            [
              'active' => true,
              'name' => 'message',
              'req' => true,
              'type' => '`$STRING`',
              'index$' => 1,
            ],
            [
              'active' => true,
              'name' => 'timestamp',
              'req' => true,
              'type' => '`$INTEGER`',
              'index$' => 2,
            ],
          ],
          'name' => 'iss_location',
          'op' => [
            'load' => [
              'input' => 'data',
              'name' => 'load',
              'points' => [
                [
                  'active' => true,
                  'args' => [
                    'query' => [
                      [
                        'active' => true,
                        'kind' => 'query',
                        'name' => 'callback',
                        'orig' => 'callback',
                        'reqd' => false,
                        'type' => '`$STRING`',
                      ],
                    ],
                  ],
                  'method' => 'GET',
                  'orig' => '/iss-now.json',
                  'parts' => [
                    'iss-now.json',
                  ],
                  'select' => [
                    'exist' => [
                      'callback',
                    ],
                  ],
                  'transform' => [
                    'req' => '`reqdata`',
                    'res' => '`body`',
                  ],
                  'index$' => 0,
                ],
              ],
              'key$' => 'load',
            ],
          ],
          'relations' => [
            'ancestors' => [],
          ],
        ],
      ],
        ];
    }


    public static function make_feature(string $name)
    {
        require_once __DIR__ . '/features.php';
        return IssCurrentLocationFeatures::make_feature($name);
    }
}
