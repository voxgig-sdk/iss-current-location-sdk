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
              'name' => 'iss_position',
              'req' => true,
              'type' => '`$OBJECT`',
              'active' => true,
              'index$' => 0,
            ],
            [
              'name' => 'message',
              'req' => true,
              'type' => '`$STRING`',
              'active' => true,
              'index$' => 1,
            ],
            [
              'name' => 'timestamp',
              'req' => true,
              'type' => '`$INTEGER`',
              'active' => true,
              'index$' => 2,
            ],
          ],
          'name' => 'iss_location',
          'op' => [
            'load' => [
              'name' => 'load',
              'points' => [
                [
                  'args' => [
                    'query' => [
                      [
                        'kind' => 'query',
                        'name' => 'callback',
                        'orig' => 'callback',
                        'reqd' => false,
                        'type' => '`$STRING`',
                        'active' => true,
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
                  'active' => true,
                  'index$' => 0,
                ],
              ],
              'input' => 'data',
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
