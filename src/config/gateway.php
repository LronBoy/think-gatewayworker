<?php
/***********************************************************
 * Description:  配置文件
 * Version:      v1.0.0
 * Function:     Include function

 * @author:      Jeffry
 * @datetime:    2023/7/11  13:46
 *
 * history:      Modify record
 ***********************************************************/
return [
	// 扩展自身需要的配置
	'protocol'              => 'websocket', // 协议 支持 tcp udp unix http websocket text
	'host'                  => '0.0.0.0',   // 监听地址
	'port'                  => 2348,        // 监听端口
	'socket'                => '',          // 完整监听地址
	'context'               => [            // socket 上下文选项，更多ssl选项请参考手册 http://php.net/manual/zh/context.ssl.php
		/*'ssl' => array(
			'local_cert'        => '',      // 也可以是crt文件，请使用绝对路径
			'local_pk'          => '',
			'verify_peer'       => true,    //是否需要验证 SSL 证书。默认值为 true。
			'allow_self_signed' => true,    //当 verify_peer 参数为 true 时才会根据 allow_self_signed 参数值来决定是否允许自签名证书
		)*/
	],
	'transport'             => 'tcp',       // 默认TCP协议，开启SSL，websocket+SSL 即wss
	
	'register_deploy'       => true,        // 是否需要部署register
	'businessWorker_deploy' => true,        // 是否需要部署businessWorker
	'gateway_deploy'        => true,        // 是否需要部署gateway
	
	// Register配置
	'registerAddress'       => '127.0.0.1:1236',// register 必须是text协议，当客户端与服务端部署不在同一服务器时 '0.0.0.0:1236'
	
	// Gateway配置
	'name'                  => 'GatewayName',   // gateway名称，status方便查看
	'count'                 => 1,           // gateway进程数，windows下仅支持1个，linux下改为4个
	'lanIp'                 => '127.0.0.1', // 本机ip，分布式部署时使用内网ip，当客户端与服务端部署不在同一服务器时'0.0.0.0'
	'startPort'             => 4000,        // 内部通讯起始端口，假如$gateway->count=4，起始端口为4000，则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口
	
	# https://www.workerman.net/doc/gateway-worker/start-and-stop.html
	'logFile'               => '/dev/null',         // 日志目录
	'pidFile'               => '/dev/null',         // pid
	'stdoutFile'            => '/dev/null',         // 以daemon方式启动，代码中echo、var_dump、print等打印会默认重定向到该文件
	'daemonize'             => false,               // 守护模式，windows下无法守护进程
	
	'pingInterval'          => 55,          // 心跳间隔
	'pingNotResponseLimit'  => 1,           // 客户端在55秒内有1次未回复就断开连接,代表服务端允许客户端不发送心跳，服务端不会因为客户端长时间没发送数据而断开连接
	'pingData'              => json_encode(["type"=>"system", "code"=>2000, "return_type"=>"ping", "msg" =>"心跳"], JSON_UNESCAPED_UNICODE),// 心跳数据
	
	// BusinessWorker配置
	'businessWorker'        => [
		'name'         => 'BusinessWorker',                 // worker名称
		'count'        => 1, // businessWorker进程数量，windows下仅支持1个，linux下改为4个
		'eventHandler' => env('workerman.event_handler', '\think\worker\Events'),  // 设置处理业务的类,此处制定Events的命名空间（其内容可参考/vendor/topthink/think-worker/src/Events.php）
	],

];