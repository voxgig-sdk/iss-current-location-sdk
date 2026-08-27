<?php
declare(strict_types=1);

// IssCurrentLocation SDK configuration

class IssCurrentLocationConfig
{
    /** @var array<string,mixed>|null */
    private static ?array $shared_config = null;

    /**
     * Return the process-wide config, built once on first use. The SDK reads
     * the config on every request and never writes to it, so one instance is
     * shared by every client rather than rebuilt per client.
     *
     * PHP arrays are copy-on-write, so callers that do mutate the result get
     * their own copy and cannot disturb the shared one.
     */
    public static function shared_config(): array
    {
        if (self::$shared_config === null) {
            self::$shared_config = self::make_config();
        }
        return self::$shared_config;
    }

    /**
     * Build a fresh, fully materialised config array. Every call rebuilds the
     * whole structure, so prefer shared_config unless you need a private copy.
     */
    public static function make_config(): array
    {
        return [
            "main" => [
                "name" => "IssCurrentLocation",
                "slug" => "iss-current-location",
                "version" => "0.0.1",
                "target" => "php",
            ],
            "feature" => [
                "test" => [
          'options' => [
            'active' => false,
          ],
          'transport' => 'base',
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
              'name' => 'latitude',
              'req' => true,
              'short' => 'Latitude coordinate of the ISS',
              'type' => '`$STRING`',
            ],
            [
              'name' => 'longitude',
              'req' => true,
              'short' => 'Longitude coordinate of the ISS',
              'type' => '`$STRING`',
            ],
          ],
          'name' => 'iss_location',
          'op' => [
            'load' => [
              'input' => 'data',
              'name' => 'load',
              'points' => [
                [
                  'args' => [
                    'query' => [
                      [
                        'kind' => 'query',
                        'name' => 'callback',
                        'orig' => 'callback',
                        'type' => '`$STRING`',
                      ],
                    ],
                  ],
                  'kind' => 'http',
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
                    'res' => '`body.iss_position`',
                  ],
                ],
              ],
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
