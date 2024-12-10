<?php return array (
  'app' => 
  array (
    'name' => 'Realtag',
    'env' => 'local',
    'debug' => true,
    'url' => 'https://dev.realtagportal.com',
    'asset_url' => NULL,
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:/26ot5ufn+x9YZ4PyJF8KYBe3ZPCNWpLDSSIexAL3q4=',
    'cipher' => 'AES-256-CBC',
    'maintenance' => 
    array (
      'driver' => 'file',
    ),
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
      26 => 'Barryvdh\\DomPDF\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Js' => 'Illuminate\\Support\\Js',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'RateLimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Vite' => 'Illuminate\\Support\\Facades\\Vite',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'user' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'tenent' => 
      array (
        'driver' => 'session',
        'provider' => 'tenents',
      ),
      'sanctum' => 
      array (
        'driver' => 'sanctum',
        'provider' => NULL,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
      'tenents' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\Tanent',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'host' => 'api-mt1.pusher.com',
          'port' => '443',
          'scheme' => 'https',
          'encrypted' => true,
          'useTLS' => true,
        ),
        'client_options' => 
        array (
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
        'lock_connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'E:\\wamp\\www\\realtagportal\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
    ),
    'prefix' => 'realtag_cache_',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'realtagp_rentalmsdev',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'realtagp_rentalmsdev',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'realtagp_rentalmsdev',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'search_path' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'realtagp_rentalmsdev',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'realtag_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'E:\\wamp\\www\\realtagportal\\storage\\app',
        'throw' => false,
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'E:\\wamp\\www\\realtagportal\\storage\\app/public',
        'url' => 'https://dev.realtagportal.com/storage',
        'visibility' => 'public',
        'throw' => false,
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
        'throw' => false,
      ),
      'uploads' => 
      array (
        'driver' => 'local',
        'root' => 'E:\\wamp\\www\\realtagportal\\public/uploads',
        'url' => 'https://dev.realtagportal.com/uploads',
        'visibility' => 'public',
      ),
    ),
    'links' => 
    array (
      'E:\\wamp\\www\\realtagportal\\public\\storage' => 'E:\\wamp\\www\\realtagportal\\storage\\app/public',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 65536,
      'threads' => 1,
      'time' => 4,
    ),
  ),
  'horizon' => 
  array (
    'domain' => NULL,
    'path' => 'horizon',
    'use' => 'default',
    'prefix' => 'realtag_horizon:',
    'middleware' => 
    array (
      0 => 'web',
    ),
    'waits' => 
    array (
      'redis:default' => 60,
    ),
    'trim' => 
    array (
      'recent' => 60,
      'pending' => 60,
      'completed' => 60,
      'recent_failed' => 10080,
      'failed' => 10080,
      'monitored' => 10080,
    ),
    'silenced' => 
    array (
    ),
    'metrics' => 
    array (
      'trim_snapshots' => 
      array (
        'job' => 24,
        'queue' => 24,
      ),
    ),
    'fast_termination' => false,
    'memory_limit' => 64,
    'defaults' => 
    array (
      'supervisor-1' => 
      array (
        'connection' => 'redis',
        'queue' => 
        array (
          0 => 'default',
        ),
        'balance' => 'auto',
        'autoScalingStrategy' => 'time',
        'maxProcesses' => 1,
        'maxTime' => 0,
        'maxJobs' => 0,
        'memory' => 128,
        'tries' => 1,
        'timeout' => 60,
        'nice' => 0,
      ),
    ),
    'environments' => 
    array (
      'production' => 
      array (
        'supervisor-1' => 
        array (
          'maxProcesses' => 10,
          'balanceMaxShift' => 1,
          'balanceCooldown' => 3,
        ),
      ),
      'local' => 
      array (
        'supervisor-1' => 
        array (
          'maxProcesses' => 3,
        ),
      ),
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'deprecations' => 
    array (
      'channel' => NULL,
      'trace' => false,
    ),
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'E:\\wamp\\www\\realtagportal\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'E:\\wamp\\www\\realtagportal\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'debug',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
          'connectionString' => 'tls://:',
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => 'E:\\wamp\\www\\realtagportal\\storage\\logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'sg1-ts108.a2hosting.com',
        'port' => '465',
        'encryption' => 'ssl',
        'username' => 'noreply-accountcreation@realtagportal.com',
        'password' => 'techeasecalvinsimon',
        'timeout' => NULL,
        'local_domain' => NULL,
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs -i',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
      ),
    ),
    'from' => 
    array (
      'address' => 'noreply-accountcreation@realtagportal.com',
      'name' => 'Realtag',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'E:\\wamp\\www\\realtagportal\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'sanctum' => 
  array (
    'stateful' => 
    array (
      0 => 'localhost',
      1 => 'localhost:3000',
      2 => '127.0.0.1',
      3 => '127.0.0.1:8000',
      4 => '::1',
      5 => 'dev.realtagportal.com',
    ),
    'guard' => 
    array (
      0 => 'web',
    ),
    'expiration' => NULL,
    'token_prefix' => '',
    'middleware' => 
    array (
      'verify_csrf_token' => 'App\\Http\\Middleware\\VerifyCsrfToken',
      'encrypt_cookies' => 'App\\Http\\Middleware\\EncryptCookies',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
      'scheme' => 'https',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'E:\\wamp\\www\\realtagportal\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'realtag_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
  ),
  'site-config' => 
  array (
    'status' => 
    array (
      1 => 'Active',
      0 => 'Inactive',
    ),
    'country' => 
    array (
      1 => 'Afghanistan',
      2 => 'Albania',
      3 => 'Algeria',
      4 => 'American Samoa',
      5 => 'Andorra',
      6 => 'Angola',
      7 => 'Anguilla',
      8 => 'Antarctica',
      9 => 'Antigua and Barbuda',
      10 => 'Argentina',
      11 => 'Armenia',
      12 => 'Aruba',
      13 => 'Australia',
      14 => 'Austria',
      15 => 'Azerbaijan',
      16 => 'Bahamas',
      17 => 'Bahrain',
      18 => 'Bangladesh',
      19 => 'Barbados',
      20 => 'Belarus',
      21 => 'Belgium',
      22 => 'Belize',
      23 => 'Benin',
      24 => 'Bermuda',
      25 => 'Bhutan',
      26 => 'Bolivia',
      27 => 'Bosnia and Herzegowina',
      28 => 'Botswana',
      29 => 'Bouvet Island',
      30 => 'Brazil',
      31 => 'British Indian Ocean Territory',
      32 => 'Brunei Darussalam',
      33 => 'Bulgaria',
      34 => 'Burkina Faso',
      35 => 'Burundi',
      36 => 'Cambodia',
      37 => 'Cameroon',
      38 => 'Canada',
      39 => 'Cape Verde',
      40 => 'Cayman Islands',
      41 => 'Central African Republic',
      42 => 'Chad',
      43 => 'Chile',
      44 => 'China',
      45 => 'Christmas Island',
      46 => 'Cocos (Keeling) Islands',
      47 => 'Colombia',
      48 => 'Comoros',
      49 => 'Congo',
      50 => 'Cook Islands',
      51 => 'Costa Rica',
      52 => 'Cote D\'Ivoire',
      53 => 'Croatia',
      54 => 'Cuba',
      55 => 'Cyprus',
      56 => 'Czech Republic',
      57 => 'Democratic Republic of Congo',
      58 => 'Denmark',
      59 => 'Djibouti',
      60 => 'Dominica',
      61 => 'Dominican Republic',
      62 => 'East Timor',
      63 => 'Ecuador',
      64 => 'Egypt',
      65 => 'El Salvador',
      66 => 'Equatorial Guinea',
      67 => 'Eritrea',
      68 => 'Estonia',
      69 => 'Ethiopia',
      70 => 'Falkland Islands (Malvinas)',
      71 => 'Faroe Islands',
      72 => 'Fiji',
      73 => 'Finland',
      74 => 'France',
      75 => 'France, Metropolitan',
      76 => 'French Guiana',
      77 => 'French Polynesia',
      78 => 'French Southern Territories',
      79 => 'Gabon',
      80 => 'Gambia',
      81 => 'Georgia',
      82 => 'Germany',
      83 => 'Ghana',
      84 => 'Gibraltar',
      85 => 'Greece',
      86 => 'Greenland',
      87 => 'Grenada',
      88 => 'Guadeloupe',
      89 => 'Guam',
      90 => 'Guatemala',
      91 => 'Guinea',
      92 => 'Guinea-bissau',
      93 => 'Guyana',
      94 => 'Haiti',
      95 => 'Heard and Mc Donald Islands',
      96 => 'Honduras',
      97 => 'Hong Kong',
      98 => 'Hungary',
      99 => 'Iceland',
      100 => 'India',
      101 => 'Indonesia',
      102 => 'Iran (Islamic Republic of)',
      103 => 'Iraq',
      104 => 'Ireland',
      105 => 'Israel',
      106 => 'Italy',
      107 => 'Jamaica',
      108 => 'Japan',
      109 => 'Jordan',
      110 => 'Kazakhstan',
      111 => 'Kenya',
      112 => 'Kiribati',
      113 => 'Korea, Republic of',
      114 => 'Kuwait',
      115 => 'Kyrgyzstan',
      116 => 'Lao People\'s Democratic Republic',
      117 => 'Latvia',
      118 => 'Lebanon',
      119 => 'Lesotho',
      120 => 'Liberia',
      121 => 'Libyan Arab Jamahiriya',
      122 => 'Liechtenstein',
      123 => 'Lithuania',
      124 => 'Luxembourg',
      125 => 'Macau',
      126 => 'Macedonia',
      127 => 'Madagascar',
      128 => 'Malawi',
      129 => 'Malaysia',
      130 => 'Maldives',
      131 => 'Mali',
      132 => 'Malta',
      133 => 'Marshall Islands',
      134 => 'Martinique',
      135 => 'Mauritania',
      136 => 'Mauritius',
      137 => 'Mayotte',
      138 => 'Mexico',
      139 => 'Micronesia, Federated States of',
      140 => 'Monaco',
      141 => 'Mongolia',
      142 => 'Montserrat',
      143 => 'Morocco',
      144 => 'Mozambique',
      150 => 'Myanmar',
      151 => 'Namibia',
      152 => 'Nauru',
      153 => 'Nepal',
      154 => 'Netherlands',
      155 => 'Netherlands Antilles',
      156 => 'New Caledonia',
      157 => 'New Zealand',
      158 => 'Nicaragua',
      159 => 'Niger',
      160 => 'Nigeria',
      161 => 'Niue',
      162 => 'Norfolk Island',
      163 => 'North Korea',
      164 => 'Northern Mariana Islands',
      165 => 'Norway',
      166 => 'Oman',
      167 => 'Pakistan',
      168 => 'Palau',
      169 => 'Panama',
      170 => 'Papua New Guinea',
      171 => 'Paraguay',
      172 => 'Peru',
      173 => 'Philippines',
      174 => 'Pitcairn',
      175 => 'Poland',
      176 => 'Portugal',
      177 => 'Puerto Rico',
      178 => 'Qatar',
      179 => 'Reunion',
      180 => 'Romania',
      181 => 'Russian Federation',
      182 => 'Rwanda',
      183 => 'Saint Kitts and Nevis',
      184 => 'Saint Lucia',
      185 => 'Saint Vincent and the Grenadines',
      186 => 'Samoa',
      187 => 'San Marino',
      188 => 'Sao Tome and Principe',
      189 => 'Saudi Arabia',
      190 => 'Senegal',
      191 => 'Seychelles',
      192 => 'Sierra Leone',
      193 => 'Singapore',
      194 => 'Slovak Republic',
      195 => 'Slovenia',
      196 => 'Solomon Islands',
      197 => 'Somalia',
      198 => 'South Africa',
      199 => 'South Georgia & South Sandwich Islands',
      200 => 'Spain',
      201 => 'Sri Lanka',
      202 => 'St. Helena',
      203 => 'St. Pierre and Miquelon',
      204 => 'Sudan',
      205 => 'Suriname',
      206 => 'Svalbard and Jan Mayen Islands',
      207 => 'Swaziland',
      208 => 'Sweden',
      209 => 'Switzerland',
      210 => 'Syrian Arab Republic',
      211 => 'Taiwan',
      212 => 'Tajikistan',
      213 => 'Tanzania, United Republic of',
      214 => 'Thailand',
      215 => 'Togo',
      216 => 'Tokelau',
      217 => 'Tonga',
      218 => 'Trinidad and Tobago',
      219 => false,
      220 => 'Turkey',
      221 => 'Turkmenistan',
      222 => 'Turks and Caicos Islands',
      223 => 'Tuvalu',
      224 => 'Uganda',
      225 => 'Ukraine',
      226 => 'United Arab Emirates',
      227 => 'United Kingdom',
      228 => 'United States',
      229 => 'United States Minor Outlying Islands',
      230 => 'Uruguay',
      231 => 'Uzbekistan',
      232 => 'Vanuatu',
      233 => 'Vatican City State (Holy See)',
      234 => 'Venezuela',
      235 => 'Viet Nam',
      236 => 'Virgin Islands (British)',
      237 => 'Virgin Islands (U.S.)',
      238 => 'Wallis and Futuna Islands',
      239 => 'Western Sahara',
      240 => 'Yemen',
      241 => 'Yugoslavia',
      242 => 'Zambia',
      243 => 'Zimbabwe',
    ),
    'title' => 
    array (
      1 => 'Mr',
      2 => 'Mrs',
      3 => 'Miss',
      4 => 'Ms',
      5 => 'Dr',
      6 => 'Rn',
      7 => 'Prof',
    ),
    'payment_types' => 
    array (
      1 => 'online',
      2 => 'Cash',
      3 => 'Company Funded',
    ),
    'employment_status' => 
    array (
      1 => 'Working Full-Time',
      2 => 'Working Part-Time',
      3 => 'Not Working',
      4 => 'Apprenticeship/internship',
      5 => 'Student/learner',
      6 => 'Disabled/medically boarded',
      7 => 'Housewife',
      8 => 'Pensioner',
      9 => 'Other',
    ),
    'marital_status' => 
    array (
      1 => 'Married',
      2 => 'Married - Not Living with Spouse',
      3 => 'Living in a Non-Married Intimate Relationship',
      4 => 'Divorced',
      5 => 'Widowed',
      6 => 'Single',
      7 => 'Other',
    ),
    'payment_of_rent' => 
    array (
      1 => 'Online',
      2 => 'Family',
      3 => 'Friend',
      4 => 'Self',
      5 => 'Employee',
      6 => 'Unknown',
      7 => 'Other',
    ),
    'family_relation' => 
    array (
      1 => 'Spouse',
      2 => 'Mother',
      3 => 'Father',
      4 => 'Brother',
      5 => 'Sister',
      6 => 'Aunt',
      7 => 'Uncle',
      8 => 'Cousin',
      9 => 'Relative',
      10 => 'Employer',
      11 => 'Fiance',
      12 => 'Partner',
      13 => 'Daughter',
      14 => 'Son',
      15 => 'Step Mother',
      16 => 'Step Father',
      17 => 'Step Sibling',
      18 => 'Social Worker',
      19 => 'EAP Manager',
    ),
    'employment_proof' => 
    array (
      1 => 'Salary Advise',
      2 => 'Pay Slip',
      3 => 'Wages',
      4 => 'Accounts Letter',
      5 => 'Other',
    ),
    'confirm_status' => 
    array (
      1 => 'Yes',
      2 => 'No',
    ),
    'gender' => 
    array (
      1 => 'Male',
      2 => 'Female',
    ),
    'YesNo' => 
    array (
      'Yes' => 'Yes',
      'No' => 'No',
    ),
    'YesNoUnsure' => 
    array (
      'Yes' => 'Yes',
      'No' => 'No',
      'Unsure' => 'Unsure',
    ),
    'template_type' => 
    array (
      1 => 'Whatsapp Message',
      2 => 'Email',
    ),
    'template_sub_type' => 
    array (
      1 => 'Landlord Whatsapp Birthday Template',
      2 => 'Tenant Whatsapp Birthday Template',
      3 => 'Rental Reminder Email Template',
    ),
    'upload_template_type' => 
    array (
      1 => 'Invoice Template',
      2 => 'Tenancy Agreement Template',
      3 => 'Receipt Template',
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'E:\\wamp\\www\\realtagportal\\resources\\views',
    ),
    'compiled' => 'E:\\wamp\\www\\realtagportal\\storage\\framework\\views',
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'public_path' => NULL,
    'convert_entities' => true,
    'options' => 
    array (
      'font_dir' => 'E:\\wamp\\www\\realtagportal\\storage\\fonts',
      'font_cache' => 'E:\\wamp\\www\\realtagportal\\storage\\fonts',
      'temp_dir' => 'C:\\Users\\emirr\\AppData\\Local\\Temp',
      'chroot' => 'E:\\wamp\\www\\realtagportal',
      'allowed_protocols' => 
      array (
        'file://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'http://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'https://' => 
        array (
          'rules' => 
          array (
          ),
        ),
      ),
      'log_output_file' => NULL,
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_paper_orientation' => 'portrait',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => true,
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'flare_middleware' => 
    array (
      0 => 'Spatie\\FlareClient\\FlareMiddleware\\RemoveRequestIp',
      1 => 'Spatie\\FlareClient\\FlareMiddleware\\AddGitInformation',
      2 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddNotifierName',
      3 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddEnvironmentInformation',
      4 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddExceptionInformation',
      5 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddDumps',
      'Spatie\\LaravelIgnition\\FlareMiddleware\\AddLogs' => 
      array (
        'maximum_number_of_collected_logs' => 200,
      ),
      'Spatie\\LaravelIgnition\\FlareMiddleware\\AddQueries' => 
      array (
        'maximum_number_of_collected_queries' => 200,
        'report_query_bindings' => true,
      ),
      'Spatie\\LaravelIgnition\\FlareMiddleware\\AddJobs' => 
      array (
        'max_chained_job_reporting_depth' => 5,
      ),
      'Spatie\\FlareClient\\FlareMiddleware\\CensorRequestBodyFields' => 
      array (
        'censor_fields' => 
        array (
          0 => 'password',
          1 => 'password_confirmation',
        ),
      ),
      'Spatie\\FlareClient\\FlareMiddleware\\CensorRequestHeaders' => 
      array (
        'headers' => 
        array (
          0 => 'API-KEY',
        ),
      ),
    ),
    'send_logs_as_events' => true,
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'auto',
    'enable_share_button' => true,
    'register_commands' => false,
    'solution_providers' => 
    array (
      0 => 'Spatie\\Ignition\\Solutions\\SolutionProviders\\BadMethodCallSolutionProvider',
      1 => 'Spatie\\Ignition\\Solutions\\SolutionProviders\\MergeConflictSolutionProvider',
      2 => 'Spatie\\Ignition\\Solutions\\SolutionProviders\\UndefinedPropertySolutionProvider',
      3 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\IncorrectValetDbCredentialsSolutionProvider',
      4 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingAppKeySolutionProvider',
      5 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\DefaultDbNameSolutionProvider',
      6 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\TableNotFoundSolutionProvider',
      7 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingImportSolutionProvider',
      8 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\InvalidRouteActionSolutionProvider',
      9 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\ViewNotFoundSolutionProvider',
      10 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\RunningLaravelDuskInProductionProvider',
      11 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingColumnSolutionProvider',
      12 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\UnknownValidationSolutionProvider',
      13 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingMixManifestSolutionProvider',
      14 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingViteManifestSolutionProvider',
      15 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingLivewireComponentSolutionProvider',
      16 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\UndefinedViewVariableSolutionProvider',
      17 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\GenericLaravelExceptionSolutionProvider',
    ),
    'ignored_solution_providers' => 
    array (
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => 'E:\\wamp\\www\\realtagportal',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
    'settings_file_path' => '',
    'recorders' => 
    array (
      0 => 'Spatie\\LaravelIgnition\\Recorders\\DumpRecorder\\DumpRecorder',
      1 => 'Spatie\\LaravelIgnition\\Recorders\\JobRecorder\\JobRecorder',
      2 => 'Spatie\\LaravelIgnition\\Recorders\\LogRecorder\\LogRecorder',
      3 => 'Spatie\\LaravelIgnition\\Recorders\\QueryRecorder\\QueryRecorder',
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
