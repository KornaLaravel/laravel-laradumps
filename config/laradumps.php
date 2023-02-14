<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Host
    |--------------------------------------------------------------------------
    |
    | Dumps App Host address. By default: '127.0.0.1',
    | Uncomment the line below according to your environment.
    |
    */

    'host' => $_ENV['DS_APP_HOST'] ?? '127.0.0.1',

    //'host' => 'host.docker.internal',    //Docker on Mac or Windows
    //'host' => '127.0.0.1',               //Homestead with the VirtualBox provider,
    //'host' => '10.211.55.2',             //Homestead with the Parallels provider,

    /*
    |--------------------------------------------------------------------------
    | Port
    |--------------------------------------------------------------------------
    |
    | Dumps App port. By default: 9191
    |
    */

    'port' => $_ENV['DS_APP_PORT'] ?? 9191,

    /*
    |--------------------------------------------------------------------------
    | Auto Invoke Desktop App
    |--------------------------------------------------------------------------
    |
    | Invoke LaraDumps Desktop App to gain focus when a new dump arrives.
    |
    */

    'auto_invoke_app' => $_ENV['DS_AUTO_INVOKE_APP'] ?? true,

    /*
    |--------------------------------------------------------------------------
    | SQL Query dump
    |--------------------------------------------------------------------------
    |
    | When `true`, it allows to dump database and send them to Desktop App.
    | Required for: ds()->queriesOn() method.
    |
    */

    'send_queries' => $_ENV['DS_SEND_QUERIES'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | HTTP Client dump
    |--------------------------------------------------------------------------
    |
    | When `true`, it allows to dump HTTP and send them to Desktop App.
    | Required for: ds()->httpOn() method.
    |
    */

    'send_http_client_requests' => $_ENV['DS_SEND_HTTP_CLIENT_REQUESTS'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | Commands dump
    |--------------------------------------------------------------------------
    |
    | When `true`, it allows to dump Commands and send them to Desktop App.
    | Required for: ds()->commandsOn() method.
    |
    */

    'send_commands' => $_ENV['DS_SEND_COMMANDS'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | Job dump
    |--------------------------------------------------------------------------
    |
    | When `true`, it allows to dump Job and send them to Desktop App.
    | Required for: ds()->jobsOn() method.
    |
    */

    'send_jobs' => $_ENV['DS_SEND_JOBS'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | Cache dump
    |--------------------------------------------------------------------------
    |
    | When `true`, it allows to dump Cache and send them to Desktop App.
    | Required for: ds()->cacheOn() method.
    |
    */

    'send_cache' => $_ENV['DS_SEND_CACHE'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | Log dump
    |--------------------------------------------------------------------------
    |
    | When `true`, it allows to dump Laravel logs and send them to Desktop App.
    | Required for logs dumping.
    |
    */

    'send_log_applications' => $_ENV['DS_SEND_LOGS'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | Livewire Components
    |--------------------------------------------------------------------------
    |
    | When `true`, it allows LaraDumps to dump and send Livewire components
    | private and protected properties to the Desktop App.
    */

    'send_livewire_components' => $_ENV['DS_SEND_LIVEWIRE_COMPONENTS'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | Livewire - Ignore Components
    |--------------------------------------------------------------------------
    |
    | LaraDumps will ignore and not listen to the Livewire Components listed below.
    |
    */

    'ignore_livewire_components' => [
        // \App\Http\Livewire\Example::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire - Allowed Components
    |--------------------------------------------------------------------------
    |
    | List of Livewire Components which will be tracked by the Desktop application.
    | The list must be comma separated. E,g: 'MyComponent,NotesComponent,AttachmentsComponent'
    |
    */

    'livewire_components' => $_ENV['DS_LIVEWIRE_COMPONENTS'] ?? '',

    /*
    |--------------------------------------------------------------------------
    | Livewire - Protected Properties
    |--------------------------------------------------------------------------
    |
    | When `true`, it allows LaraDumps to access and dump protected
    | and private properties of Livewire components
    |
    */

    'send_livewire_protected_properties' => $_ENV['DS_LIVEWIRE_PROTECTED_PROPERTIES'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | Livewire - Events
    |--------------------------------------------------------------------------
    |
    | When `true`, it allows to dump Livewire Events and send them to Desktop App.
    |
    */
    'send_livewire_events' => $_ENV['DS_LIVEWIRE_EVENTS'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | Livewire - Dispatch
    |--------------------------------------------------------------------------
    |
    | When `true`, it allows to dump Livewire Browser Events dispatch
    | and send them to Desktop App.
    |
    */
    'send_livewire_dispatch' => $_ENV['DS_LIVEWIRE_DISPATCH'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | Livewire - Components HighLight
    |--------------------------------------------------------------------------
    |
    | Enables highLighting the component on the page when
    | it is selected in the Desktop App.
    |
    */

    'send_livewire_components_highlight' => $_ENV['DS_LIVEWIRE_COMPONENTS_HIGHLIGHT'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | Livewire - Auto-Clear on page reload
    |--------------------------------------------------------------------------
    |
    | When debugging Livewire, you need to clear your LaraDumps APP history
    | every time the page is reloaded to keep track of your components.
    | Set auto_clear_on_page_reload to true so LaraDumps will clear history
    | automatically on page reload.
    |
    */

    'auto_clear_on_page_reload' => $_ENV['DS_AUTO_CLEAR_ON_PAGE_RELOAD'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | Preferred IDE
    |--------------------------------------------------------------------------
    |
    | Configure your preferred IDE to be used in Dumps App file links.
    |
    */

    'preferred_ide' => $_ENV['DS_PREFERRED_IDE'] ?? 'phpstorm',

    /*
    |--------------------------------------------------------------------------
    | IDE Handlers
    |--------------------------------------------------------------------------
    |
    | Dumps already ships with pre-configured IDE protocol handlers.
    | You may adjust the handler or include custom ones, if needed.
    |
    */

    'ide_handlers' => [
        'atom' => [
            'handler'        => 'atom://core/open/file?filename=',
            'line_separator' => '&line=',
        ],
        'phpstorm' => [
            'handler'        => 'phpstorm://open?file=',
            'line_separator' => '&line=',
        ],
        'sublime' => [
            'handler'        => 'subl://open?url=file://',
            'line_separator' => '&line=',
        ],
        'vscode' => [
            'handler'        => 'vscode://file/',
            'line_separator' => ':',
        ],
        'vscode_remote' => [
            'handler'        => 'vscode://vscode-remote/',
            'line_separator' => ':',
            'local_path'     => 'wsl+' . ($_ENV['DS_PREFERRED_WSL_DISTRO'] ?? 'Ubuntu20.04LTS'),
            'remote_path'    => $_ENV['DS_REMOTE_PATH']                   ?? null,
            'work_dir'       => $_ENV['DS_WORKDIR']                       ?? '/var/www/html',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Ignore Routes
    |--------------------------------------------------------------------------
    |
    | Routes containing the words listed below will NOT be dumped with
    | ds()->routes() command.
    |
    */

    'ignore_route_contains' => [
        'debugbar',
        'ignition',
        'horizon',
        'livewire',
    ],

    /*
    |--------------------------------------------------------------------------
    | Sleep
    |--------------------------------------------------------------------------
    |
    | You can specify an interval in 'seconds' between sending dumps
    | to the Desktop App.
    |
    */

    'sleep' => $_ENV['DS_SLEEP'] ?? null,

    /*
    |--------------------------------------------------------------------------
    | CI Check
    |--------------------------------------------------------------------------
    |
    | List of directories and text to be searched when running the
    |  "php artisan ds:check" command.
    |
    */

    'ci_check' => [
        'directories' => [
            base_path('app'),
            base_path('resources'),
        ],
        'ignore_line_when_contains_text' => [
            //'ads()'
        ],
        'text_to_search' => [
            'ds(',
            'dsq(',
            'dsd(',
            'ds1(',
            'ds2(',
            'ds3(',
            'ds4(',
            'ds5(',
            'dsAutoClearOnPageReload',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Color in Screen
    |--------------------------------------------------------------------------
    |
    | If true, LaraDumps will separate colors into screens with the name of the
    | submitted color.
    |
    */

    'send_color_in_screen' => $_ENV['DS_SEND_COLOR_IN_SCREEN'] ?? false,

    /*
    |--------------------------------------------------------------------------
    | Color in Screen - Color Map
    |--------------------------------------------------------------------------
    |
    | Color map for "Color in Screen" feature.
    |
    */

    'screen_btn_colors_map' => [
        'default' => [
            'default' => 'btn-white',
        ],
        'danger' => [
            'default' => 'btn-danger',
        ],
        'info' => [
            'default' => 'btn-info',
        ],
        'success' => [
            'default' => 'btn-success',
        ],
        'warning' => [
            'default' => 'btn-warning',
        ],
    ],

    /*
   |--------------------------------------------------------------------------
   | Level Log Colors Map
   |--------------------------------------------------------------------------
   |
   | Definition of Tailwind CSS class for LaraDumps color tag.
   |
   */

    'level_log_colors_map' => [
        'error'     => $_ENV['DS_LOG_COLOR_ERROR']     ?? 'border-red-600',
        'critical'  => $_ENV['DS_LOG_COLOR_CRITICAL']  ?? 'border-red-900',
        'alert'     => $_ENV['DS_LOG_COLOR_ALERT']     ?? 'border-red-500',
        'emergency' => $_ENV['DS_LOG_COLOR_EMERGENCY'] ?? 'border-red-600',
        'warning'   => $_ENV['DS_LOG_COLOR_WARNING']   ?? 'border-orange-300',
        'notice'    => $_ENV['DS_LOG_COLOR_NOTICE']    ?? 'border-green-300',
        'info'      => $_ENV['DS_LOG_COLOR_INFO']      ?? 'border-blue-300',
        'debug'     => $_ENV['DS_LOG_COLOR_INFO']      ?? 'border-black',
    ],
];
