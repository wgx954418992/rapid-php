<?php

return [
    'application' => [
        'scans' => [
            'controller' => [
                '${PATH_APP}classier/controller/',
            ],
        ],

        'web' => [
            'view' => [
                'ext' => ['php', 'html', 'htm'],
                'template_path' => '${PATH_APP}classier/view/',
                'cache_path' => '${PATH_APP}runtime/build/view/',
                'template_service' => \rapidPHP\modules\core\classier\web\template\TemplateService::class,
            ],
        ],
    ],
    'log' => [
        'error' => [
            'name' => 'error',
            'size' => 1024 * 1024 * 5,
            'path' => '${PATH_APP_RUNTIME}log/error/{number}.log',
        ],
        'warning' => [
            'name' => 'warning',
            'size' => 1024 * 1024 * 5,
            'path' => '${PATH_APP_RUNTIME}log/warning/{number}.log',
        ],
        'debug' => [
            'name' => 'debug',
            'size' => 1024 * 1024 * 5,
            'path' => '${PATH_APP_RUNTIME}log/debug/{number}.log',
        ],
        'access' => [
            'name' => 'access',
            'size' => 1024 * 1024 * 5,
            'path' => '${PATH_APP_RUNTIME}log/access/{number}.log',
        ],
    ],
    'console'=>[
        'session' => [
            'key' => 'PHPSESSID',

            'service' => null,
        ],

        'context' => \rapidPHP\modules\application\classier\context\ConsoleContext::class,
    ],
    'server' => [
        'cgi' => [
            'session' => [
                'key' => 'PHPSESSID',

                'service' => null,
            ],

            'context' => \rapidPHP\modules\application\classier\context\WebContext::class,
        ],
        'swoole' => [
            'session' => [
                'key' => 'PHPSESSID',

                'service' => null,
            ],

            'context' => \rapidPHP\modules\application\classier\context\WebContext::class,

            'co' => [
                'hook_flags' => SWOOLE_HOOK_ALL | SWOOLE_HOOK_CURL
            ],

            'options' => [
                /**
                 * 开启静态文件处理
                 */
                'enable_static_handler' => true,

                /**
                 * 静态文件目录
                 */
                'document_root' => '${PATH_APP}public/',

                /**
                 * 设置异步重启开关。设置为true时，将启用异步安全重启特性，Worker进程会等待异步事件完成后再退出
                 */
                'reload_async' => true,

                /**
                 * enable_coroutine 选项相当于在回调中关闭以前版本的SW_COROUTINE宏开关, 关闭时在回调事件中不再创建协程，但是保留用户创建协程的能力。
                 */
                'enable_coroutine' => true,

                /**
                 * 设置最大数据包尺寸，单位为字节。
                 * 开启open_length_check/open_eof_check/open_http_protocol等协议解析后。
                 * 底层会进行数据包拼接。
                 * 这时在数据包未收取完整时，所有数据都是保存在内存中的。
                 */
                'package_max_length' => 50 * 1024 * 1024,

                /**
                 * 设置启动的Worker进程数。
                 * 业务代码是全异步非阻塞的，这里设置为CPU核数的1-4倍最合理
                 * 业务代码为同步阻塞，需要根据请求响应时间和系统负载来调整，例如：100-500
                 * 默认设置为SWOOLE_CPU_NUM，最大不得超过SWOOLE_CPU_NUM * 1000
                 * 比如1个请求耗时100ms，要提供1000QPS的处理能力，那必须配置100个进程或更多。但开的进程越多，占用的内存就会大大增加，而且进程间切换的开销就会越来越大。所以这里适当即可。不要配置过大。
                 * 假设每个进程占用40M内存，100个进程就需要占用4G内存
                 * @var int
                 */
                'worker_num' => 1,

                /**
                 * 配置Task进程的数量，配置此参数后将会启用task功能。所以Server务必要注册onTask、onFinish2个事件回调函数。如果没有注册，服务器程序将无法启动。
                 * Task进程是同步阻塞的，配置方式与Worker同步模式一致
                 * 最大值不得超过SWOOLE_CPU_NUM * 1000
                 * 单个task的处理耗时，如100ms，那一个进程1秒就可以处理1/0.1=10个task
                 * task投递的速度，如每秒产生2000个task
                 * 2000/10=200，需要设置task_worker_num => 200，启用200个task进程
                 * @var int
                 */
                'task_worker_num' => 10,

            ],

            'http' => [
                'ip' => '0.0.0.0',

                'port' => 1700,

                'options' => [

                    /**
                     * ssl key 证书文件
                     */
                    'ssl_key_file' => null,

                    /**
                     * ssl cert 证书文件
                     */
                    'ssl_cert_file' => null,
                ]
            ],

            'websocket' => [

                'ip' => '0.0.0.0',

                'port' => 1701,

                'return_key' => '__c', //定义websocket回调块

                'options' => [

                    /**
                     * ssl key 证书文件
                     */
                    'ssl_key_file' => null,

                    /**
                     * ssl cert 证书文件
                     */
                    'ssl_cert_file' => null,
                    /**
                     * 心跳检测 每隔多少秒，遍历一遍所有的连接
                     */
                    'heartbeat_check_interval' => 30,

                    /**
                     * 心跳检测 最大闲置时间，超时触发close并关闭
                     * 默认为heartbeat_check_interval的2倍，
                     * 两倍是容错机制，多一点是网络延迟的弥补
                     */
                    'heartbeat_idle_time' => 30,
                ],
            ],
        ],
    ],

    'redis' => [
        'master' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'select' => 0,
        ],
        'salve' => null
    ],
    'database' => [
        'sql' => [
            'master' => [
                'url' => '',
                'username' => '',
                'password' => '',
            ],
            'salve' => null,
        ],
        'nosql' => null
    ]
];
