var lan = {
	"get":function(key,args){
		var msgs = {
			"diskinfo_span_1":"磁盘分区[{1}]的可用容量小于1GB，这可能会导致MySQL自动停止，面板无法访问等问题，请及时清理！",
			"process_kill_confirm":"结束进程名[{1}],PID[{2}]后可能会影响服务器的正常运行，继续吗？",
			"del":"删除[{1}]",
			"del_all_task":"您共选择了[{1}]个任务,删除后将无法恢复,真的要删除吗?",
			"del_all_task_ok":"成功删除[{1}]个任务!",
			"del_all_task_the":"正在删除[{1}],请稍候...",
			"add_all_task_ok":"成功添加[{1}]个计划任务!",
			"add":"正在添加[{1}],请稍候...",
			"confirm_del":"您真的要删除[{1}]吗？",
			"update_num":"一次只能选择{1}个文件上传，剩下的不作处理！",
			"service_confirm":"您真的要{1}{2}服务吗？",
			"service_the":"正在{1}{2}服务,请稍候...",
			"service_ok":"{1}服务已{2}",
			"service_err":"{1}服务{2}失败!",
            "recycle_bin_confirm": "您确实要把此文件[{1}]放入回收站吗?",
            "del_dir_confirm": "您确实要把此目录[{1}]删除吗，删除后将无法恢复，继续删除吗?",
            "del_file_confirm": "您确实要把此文件[{1}]删除吗，删除后将无法恢复，继续删除吗?",
			"recycle_bin_confirm_dir":"您确实要把此目录[{1}]放入回收站吗?",
			"del_all_ftp":"您共选择了[{1}]个FTP,删除后将无法恢复,真的要删除吗?",
			"del_all_ftp_ok":"成功删除{1}个FTP帐户",
			"del_all_database":"您共选择了[{1}]个数据库,删除后将无法恢复,真的要删除吗?",
			"del_all_database_ok":"成功删除[{1}]个数据库!",
			"config_edit_ps":"此处为{1}主配置文件,若您不了解配置规则,请勿随意修改。",
			"install_confirm":"您真的要安装{1}-{2}吗?",
			"del_all_site":"您共选择了[{1}]个站点,删除后将无法恢复,真的要删除吗?",
			"del_all_site_ok":"成功删除[{1}]个站点!",
			"ssl_enable":"您已启用[{1}]证书，如需关闭，请点击\"关闭SSL\"按钮。",
			"lack_param":"缺少必要参数[{1}]",
			"del_ftp":'是否删除[{1}]该FTP账号？',
		}
		
		if(!msgs[key]) return '';
		msg = msgs[key];
		for(var i=0;i<args.length;i++){
			console.log('test',args[i])
			msg = msg.replace('{'+(i+1)+'}',args[i]+'');
		}
		
		return msg;
	},
	"index":{
		"memre":"内存释放",
		"memre_ok":"释放完成",
		"memre_ok_0":"释放中",
		"memre_ok_1":"已释放",
		"memre_ok_2":"状态最佳",
		"mem_warning":"当前可用物理内存小于64M，这可能导致MySQL自动停止，站点502等错误，请尝试释放内存！",
		"user_warning":"当前面板用户为admin,这可能为面板安全带来风险！",
		"cpu_core":"核心",
		"interfacespeed":"接口速率",
		"package_num":"报文数量",
		"interface_net":"接口流量实时",
		"net_up":"上行",
		"net_down":"下行",
		"unit":"单位",
		"net_font":"宋体",
		"update_go":"立即更新",
		"update_get":"正在获取版本信息...",
		"update_check":"检查更新",
		"update_to":"升级到",
		"update_the":"正在升级面板..",
		"update_ok":"升级成功!",
		"update_log":"版本更新",
		"reboot_title":"安全重启服务器",
		"reboot_warning":"注意，若您的服务器是一个容器，请取消。",
		"reboot_ps":"安全重启有利于保障文件安全，将执行以下操作：",
		"reboot_ps_1":"1.停止Web服务",
		"reboot_ps_2":"2.停止MySQL服务",
		"reboot_ps_3":"3.开始重启服务器",
		"reboot_ps_4":"4.等待服务器启动",
		"reboot_msg_1":"正在停止Web服务",
		"reboot_msg_2":"正在停止MySQL服务",
		"reboot_msg_3":"开始重启服务器",
		"reboot_msg_4":"等待服务器启动",
		"reboot_msg_5":"服务器重启成功!",
		"panel_reboot_title":"重启面板服务",
		"panel_reboot_msg":"即将重启面板服务，继续吗？",
		"panel_reboot_to":"正在重启面板服务,请稍候...",
		"panel_reboot_ok":"面板服务重启成功!",
		"net_dorp_ip":"屏蔽此IP",
		"net_doup_ip_msg":"屏蔽此IP后，对方将无法访问本服务器，你可以在【安全】中删除，继续吗？",
		"net_doup_ip_ps":"手动屏蔽",
		"net_doup_ip_to":"手动屏蔽",
		"net_status_title":"网络状态",
		"net_protocol":"协议",
		"net_address_dst":"本地地址",
		"net_address_src":"远程地址",
		"net_address_status":"状态",
		"net_process":"进程",
		"net_process_pid":"PID",
		"process_check":"正在分析...",
		"process_kill":"结束",
		"process_kill_title":"结束此进程",
		"process_title":"进程管理",
		"process_pid":"PID",
		"process_name":"名称",
		"process_cpu":"CPU",
		"process_mem":"内存",
		"process_disk":"读/写",
		"process_status":"状态",
		"process_thread":"线程",
		"process_user":"用户",
		"process_act":"操作",
		"kill_msg":"正在结束进程...",
		"rep_panel_msg":"将尝试校验并修复面板程序，继续吗？",
		"rep_panel_title":"修复面板",
		"rep_panel_the":"正在校验模块...",
		"rep_panel_ok":"修复完成，请按 Ctrl+F5 刷新缓存!"
	},
	
	"config":{
		"close_panel_msg":"关闭面板会导致您无法访问面板 ,您真的要关闭宝塔Windows面板吗？",
		"close_panel_title":"关闭面板",
		"config_save":"正在保存配置...",
		"config_sync":"正在同步时间...",
		"config_user_binding":"绑定宝塔帐号",
		"config_user_edit":"修改绑定宝塔账号",
		"binding":"绑定",
		"token_get":"正在获取密钥...",
		"user_bt":"宝塔官网账户",
		"pass_bt":"宝塔官网密码",
		"binding_un_msg":"您确定要解除绑定宝塔帐号码？",
		"binding_un_title":"解除绑定",
		"binding_un":"解绑",
		"ssl_close_msg":"关闭SSL后,必需使用http协议访问面板,继续吗?",
		"ssl_open_ps":"危险！此功能不懂别开启!",
		"ssl_open_ps_1":"必须要用到且了解此功能才决定自己是否要开启!",
		"ssl_open_ps_2":"面板SSL是自签证书，不被浏览器信任，显示不安全是正常现象",
		"ssl_open_ps_3":"开启后导致面板不能访问，可以点击下面链接了解解决方法",
		"ssl_open_ps_4":"我已了经解详情,并愿意承担风险",
		"ssl_open_ps_5":"了解详情",
		"ssl_title":"设置面板SSL",
		"ssl_ps":"请先确认风险!",
		"ssl_msg":"正在安装并设置SSL组件,这需要几分钟时间...",
		'qrcode_no_list':"当前绑定列表为空,请先绑定然后重试"
	},
	
	"control":{
		"save_day_err":"保存天数不合法!",
		"close_log":"清空记录",
		"close_log_msg":"您真的清空所有监控记录吗？",
		"disk_read_num":"读取次数",
		"disk_write_num":"写入次数",
		"disk_read_bytes":"读取字节数",
		"disk_write_bytes":"写入字节数"
	},
	
	"crontab":{
		"task_log_title": "任务执行日志",
		"task_empty":"当前没有计划任务",
		"del_task":"您确定要删除该任务吗?",
		"del_task_all_title":"批量删除任务",
		"del_task_err":"以下任务删除失败:",
		"add_task_empty":"任务名称不能为空!",
		"input_hour_err":"小时值不合法!",
		"input_minute_err":"分钟值不合法!",
		"input_number_err":"不能有负数!",
		"input_file_err":"请选择脚本文件!",
		"input_script_err":"脚本代码不能为空!",
		"input_url_err":"URL地址不正确!",
		"input_empty_err":"对象列表为空，无法继续!",
		"backup_site":"备份网站",
		"backup_database":"备份数据库",
		"backup_log":"切割日志",
		"backup_all_err":"以下对象添加任务失败:",
		"day":"天",
		"hour":"小时",
		"minute":"分钟",
		"sun":"日",
		"sbody":"脚本内容",
		"log_site":"切割网站",
		"url_address":"URL地址",
		"backup_to":"备份到",
		"disk":"服务器磁盘",
		"save_new":"保留最新",
		"save_num":"份",
		"TZZ1":"周一",
		"TZZ2":"周二",
		"TZZ3":"周三",
		"TZZ4":"周四",
		"TZZ5":"周五",
		"TZZ6":"周六",
		"TZZ7":"周日",
		"mem_ps":"释放PHP、MYSQL、PURE-FTPD、APACHE、NGINX的内存占用,建议在每天半夜执行!",
		"mem":"释放内存"
		
	},
	
	"firewall":{
		"empty":"已清理!",
		"port":"端口",
		"accept":"放行",
		"port_ps":"说明: 支持放行端口范围，如: 3000:3500",
		"ip":"欲屏蔽的IP地址",
		"drop":"屏蔽",
		"ip_ps":"说明: 支持屏蔽IP段，如: 192.168.0.0/24",
		"ssh_port_msg":"更改远程端口时，将会注消所有已登录帐户，您真的要更改远程端口吗？",
		"ssh_port_title":"远程端口",
		"ssh_off_msg":"停用远程桌面服务的同时也将注销所有已登录用户,继续吗？",
		"ssh_on_msg":"确定启用远程桌面服务吗？",
		"ping_msg":"禁PING后不影响服务器正常使用，但无法ping通服务器，您真的要禁PING吗？",
		"ping_un_msg":"解除禁PING状态可能会被黑客发现您的服务器，您真的要解禁吗？",
		"ping_title":"是否禁ping",
		"ping":"已禁Ping",
		"ping_un":"已解除禁Ping",
		"ping_err":"连接服务器失败",
		"status_not":"未使用",
		"status_net":"外网不通",
		"status_ok":"正常",
		"drop_ip":"屏蔽IP",
		"accept_port":"放行端口",
		"port_err":"端口范围不合法!",
		"ps_err":"备注/说明 不能为空!",
		"del_title":"删除防火墙规则",
		"close_log":"清空日志",
		"close_log_msg":"即将清空面板日志，继续吗？",
		"close_the":"正在清理,请稍候..."
	},
	
	"upload":{
		"file_type_err":"不允许上传的文件类型!",
		"file_err":"错误的文件",
		"file_err_empty":"不能为空字节文件!",
		"select_file":"请选择文件!",
		"select_empty":"没有可用文件上传，重新选择文件",
		"up_sleep":"等待上传",
		"up_the":"已上传",
		"up_save":"正在保存..",
		"up_ok":"已上传成功",
		"up_ok_1":"上传完成",
		"up_ok_2":"已上传",
		"up_speed":"上传进度:",
		"up_err":" 上传错误",
		"ie_err":"抱歉,IE 6/7/8 不支持请更换浏览器再上传"
	},
	
	"bt":{
		"empty":"空",
		"dir":"选择目录",
		"path":"当前路径",
		"comp":"计算机",
		"filename":"文件名",
		"etime":"修改时间",
		"access":"权限",
		"own":"所有者",
		"adddir":"新建文件夹",
		"path_ok":"选择",
		"save_file":"正在保存,请稍候...",
		"read_file":"正在读取文件,请稍候...",
		"edit_title":"在线编辑",
		"edit_ps":"提示：Ctrl+F 搜索关键字，Ctrl+G 查找下一个，Ctrl+S 保存，Ctrl+Shift+R 查找替换!",
		"stop":"停止",
		"start":"启动",
		"restart":"重启",
		"reload":"重载",
		"php_status_err":"抱歉，不支持PHP5.2",
		"php_status_title":"PHP负载状态",
		"php_pool":"应用池(pool)",
		"php_manager":"进程管理方式(process manager)",
		"dynamic":"动态",
		"static":"静态",
		"php_start":"启动日期(start time)",
		"php_accepted":"请求数(accepted conn)",
		"php_queue":"请求队列(listen queue)",
		"php_max_queue":"最大等待队列(max listen queue)",
		"php_len_queue":"socket队列长度(listen queue len)",
		"php_idle":"空闲进程数量(idle processes)",
		"php_active":"活跃进程数量(active processes)",
		"php_total":"总进程数量(total processes)",
		"php_max_active":"最大活跃进程数量(max active processes)",
		"php_max_children":"到达进程上限次数(max children reached)",
		"php_slow":"慢请求数量(slow requests)",
        "nginx_title": "Nginx负载状态",
        "nginx_active": "活动连接(Active connections)",
        "nginx_accepts": "总连接次数(accepts)",
        "nginx_handled": "总握手次数(handled)",
        "nginx_requests": "总请求数(requests)",
        "nginx_reading": "请求数(Reading)",
        "nginx_writing": "响应数(Writing)",
        "nginx_waiting": "驻留进程(Waiting)",
        "nginx_worker": "工作进程(Worker)",
        "nginx_workercpu": "Nginx占用CPU(Workercpu)",
        "nginx_workermen": "Nginx占用内存(Workermen)",
        "apache_uptime": "启动时间(Uptime)",
        "apache_restarttime": "重启时间(RestartTime)",
        "apache_totalaccesses": "总连接数(TotalAccesses)",
        "apache_totalkbytes": "传送总字节(TotalkBytes)",
        "apache_reqpersec": "每秒请求数(ReqPerSec)",
        "apache_idleworkers": "空闲进程(IdleWorkers)",
        "apache_busyworkers": "繁忙进程(BusyWorkers)",
        "apache_workercpu": "Apache使用CPU",
        "apache_workermem": "Apache使用内存",
		"drop_ip_title":"屏蔽此IP",
		"net_status_title":"网络状态",
		"net_pool":"协议",
		"copy_ok":"复制成功",
		"copy_empty":"密码为空",
		"cal_msg":"计算结果：",
		"cal_empty":"输入计算结果，否则无法删除",
		"cal_err":"计算错误，请重新计算",
		"loginout":"您真的要退出面板吗?",
		"pass_err_len":"面板密码不能少于8位!",
		"pass_err":"面板密码不能为弱口令",
		"pass_err_re":"两次输入的密码不一致",
		"pass_title":"修改密码",
		"pass_new_title":"新的密码",
		"pass_rep":"随机密码",
		"pass_rep_btn":"随机",
		"pass_re":"重复",
		"pass_re_title":"再输一次",
		"pass_rep_ps":"请在修改前记录好您的新密码!",
		"user_len":"用户名长度不能少于5位",
		"user_err_re":"两次输入的用户名不一致",
		"user_title":"修改面板用户名",
		"user":"用户名",
		"user_new":"新的用户名",
		"task_list":"任务列表",
		"task_msg":"消息列表",
		"task_not_list":"当前没有任务!",
		"task_scan":"正在扫描",
		"task_install":"正在安装",
		"task_sleep":"等待",
		"task_downloading":"下载中",
		"task_the":"正在处理",
		"task_ok":"已完成",
		"task_close":"任务已取消!",
		"time":"耗时",
		"s":"秒",
		"install_title":"推荐安装套件",
		"install_ps":"我们为您推荐以下一键套件，请按需选择或在",
		"install_s":"软件管理",
		"install_s1":"页面中自动选择，推荐安装IIS套件，兼容性最佳。",
        "install_lnmp":"IIS套件(推荐)",
		"install_type":"安装方式",
		"install_rpm":"极速安装",
		"install_rpm_title":"即rpm，安装时间极快（5~10分钟），性能与稳定性略低于编译安装",
		"install_src":"编译安装",
		"install_src_title":"安装时间长（30分钟到3小时），适合生产环境",
		"install_key":"一键安装",
		"install_apache22":"您选择的是Apache2.2,PHP将会以php5_module模式运行!",
		"install_apache24":"您选择的是Apache2.4,PHP将会以php-fpm模式运行!",
		"insatll_s22":"Apache2.2不支持",
		"insatll_s24":"Apache2.4不支持",
		"insatll_mem":"您的内存小于{1},不建议安装MySQL-{2}",
		"install_to":"正在添加到安装器...",
		"install_ok":"已将安装请求添加到安装器",
		"task_add":"已添加到队列",
		"panel_open":"正在打开面板...",
		"panel_add":"关联宝塔面板",
		"panel_edit":"修改关联",
		"panel_err_format":"面板地址格式不正确，示例：",
		"panel_err_empty":"面板资料不能为空",
		"panel_address":"面板地址",
		"panel_user":"用户名",
		"panel_pass":"密码",
		"panel_ps":"备注",
		"panel_ps_1":"收藏其它服务器面板资料，实现一键登录面板功能",
		"panel_ps_2":"面板备注不可重复",
		"panel_ps_3":"<font style='color:red'>注意，开启广告拦截会导致无法快捷登录。</font>",
		"task_time":"时间",
		"task_name":"名称",
		"task_msg_title":"消息提醒",
		"task_title":"消息盒子",
		"task_tip_read":"标记已读",
		"task_tip_all":"全部已读",
		"no_data" : "当前没有数据"
	},
	
	"files":{
		"recycle_bin_re":"恢复",
		"recycle_bin_del":"永久删除",
		"recycle_bin_on":"文件回收站",
		"recycle_bin_on_db":"数据库回收站",
		"recycle_bin_ps":"注意：关闭回收站，删除的文件无法恢复！",
		"recycle_bin_close":"清空回收站",
		"recycle_bin_type1":"全部",
		"recycle_bin_type2":"文件夹",
		"recycle_bin_type3":"文件",
		"recycle_bin_type4":"图片",
		"recycle_bin_type5":"文档",
		"recycle_bin_type6":"数据库",
		"recycle_bin_th1":"文件名",
		"recycle_bin_th2":"原位置",
		"recycle_bin_th3":"大小",
		"recycle_bin_th4":"删除时间",
		"recycle_bin_th5":"操作",
		"recycle_bin_title":"回收站",
		"recycle_bin_re_title":"恢复文件",
		"recycle_bin_re_msg":"若您的原位置已有同名文件或目录，将被覆盖，继续吗？",
		"recycle_bin_re_the":"正在恢复,请稍候...",
		"recycle_bin_del_title":"删除文件",
		"recycle_bin_del_msg":"删除操作不可逆，继续吗？",
		"recycle_bin_del_the":"正在删除,请稍候...",
		"recycle_bin_close_msg":"清空回收站操作会永久删除回收站中的文件，继续吗？",
		"recycle_bin_close_the":"正在删除,请稍候...",
		"dir_menu_webshell":"目录查杀",
		"file_menu_webshell":"查杀",
		"file_menu_copy":"复制",
		"file_menu_mv":"剪切",
		"file_menu_rename":"重命名",
		"file_menu_auth":"权限",
		"file_menu_zip":"压缩",
		"file_menu_unzip":"解压",
		"file_menu_edit":"编辑",
		"file_menu_img":"预览",
		"file_menu_down":"下载",
		"file_menu_del":"删除",
		"file_name":"文件名",
		"file_size":"大小",
		"file_etime":"修改时间",
		"file_auth":"权限",
		"file_own":"所有者",
		"file_read":"读取",
		"file_write":"写入",
		"file_exec":"执行",
		"file_public":"公共",
		"file_group":"用户组",
		"file_act":"操作",
		"get_size":"共{1}个目录与{2}个文件,大小:",
		"get":"获取",
		"new":"新建",
		"new_empty_file":"新建空白文件",
		"new_dir":"新建目录",
		"dir_name":"目录名称",
		"return":"返回上一级",
		"shell":"终端",
		"paste":"粘贴",
		"paste_all":"粘贴所有",
		"path_root":"根目录",
		"all":"批量",
		"set_auth":"设置权限",
		"up_title":"上传文件",
		"up_add":"添加文件",
		"up_start":"开始上传",
		"up_coding":"文件编码",
		"up_bin":"二进制",
		"unzip_title":"解压文件",
		"unzip_name":"文件名",
		"unzip_name_title":"压缩文件名",
		"unzip_to":"解压到",
		"unzip_coding":"编码",
		"unzip_the":"正在解压,请稍候...",
		"zip_title":"压缩文件",
		"zip_to":"压缩到",
		"zip_the":"正在压缩,请稍候...",
		"zip_ok":"服务器正在后台压缩文件,请稍候刷新文件列表查看进度!",
		"zip_pass_title":"解压密码",
		"zip_pass_msg":"不需要请留空",
		"mv_the":"正在移动,请稍候...",
		"copy_the":"正在复制,请稍候...",
		"copy_ok":"已复制",
		"mv_ok":"已剪切",
		"shell_title":"执行SHELL (仅支持非交互命令)",
		"shell_go":"发送",
		"shell_ps":"shell命令",
		"down_title":"下载文件",
		"down_url":"URL地址",
		"down_to":"下载到",
		"down_save":"保存文件名",
		"down_task":"正在添加到队列，请稍候..",
		"del_file":"删除文件",
		"del_dir":"删除目录",
		"del_all_file":"批量删除文件",
		"del_all_msg":"您确实要把这些文件放入回收站吗?",
		"file_conver_msg":"即将覆盖以下文件,是否确定？"
	},
	
	"ftp":{
		"empty":"当前没有FTP数据",
		"stop_title":"停用这个帐号",
		"start_title":"启用这个帐号",
		"stop":"已停用",
		"start":"已启用",
		"copy":"复制密码",
		"open_path":"打开目录",
		"edit_pass":"改密",
		"ps":"备注信息",
		"add_title":"添加FTP帐户",
		"add_user":"用户名",
		"add_user_tips":'请输入FTP用户名',
		"add_pass":"密码",
		"add_pass_tips":'请输入FTP密码',
		"add_pass_rep":"随机密码",
		"add_path":"根目录",
		"add_path_tips":'请输入或选择FTP目录',
		"add_path_rep":'选择文件目录',
		"add_path_title":"帐户根目录，会自动创建同名目录",
		"add_path_ps":"FTP所指向的目录",
		"add_ps":"备注",
		"add_ps_title":"备注信息(小于255个字符)",
		"del_all":"是否批量删除选中的FTP账号？",
		"del_all_err":"以下FTP帐户删除失败:",
		"stop_confirm":"您真的要停止{1}的FTP吗?",
		"stop_title":"FTP帐户",
		"pass_title":"修改FTP用户密码",
		"pass_user":"用户名",
		"pass_new":"新密码",
		"pass_confirm":"您确定要修改该FTP帐户密码吗?",
		"port_title":"修改FTP端口",
		"port_name":'端口',
		"port_tips":'请填写端口',
		"del_ftp_title":'删除FTP',
		"del_ftp_all_title":'删除选中FTP'
	},
	
	"database":{
		"empty":"当前没有数据库数据",
		"backup_empty":"无备份",
		"backup_ok":"有备份",
		"copy_pass":"复制密码",
		"input":"导入",
		"input_title":"导入数据库",
		"admin":"管理",
		"admin_title":"数据库管理",
		"auth":"权限",
		"auth_title":"设置访问权限",
		"edit_pass":"改密",
		"edit_pass_title":"修改数据库密码",
		"del_title":"删除数据库",
		"ps":"备注信息",
		"add_title":"添加数据库",
		"add_name":"数据库名",
		"add_name_title":"新的数据库名称",
		"add_pass":"密码",
		"add_pass_title":"数据库密码",
		"add_pass_rep":"随机密码",
		"add_auth":"访问权限",
		"add_auth_local":"本地服务器",
		"add_auth_all":"所有人",
		"add_auth_ip":"指定IP",
		"add_auth_ip_title":"请输允许访问此数据库的IP地址",
		"add_ps":"备注",
		"edit_root":"root密码",
		"user":"用户名",
		"edit_pass_new":"新密码",
		"edit_pass_new_title":"新的数据库密码",
		"edit_pass_confirm":"您确定要修改数据库密码吗?",
		"backup_re":"恢复",
		"backup_name":"文件名称",
		"backup_size":"文件大小",
		"backup_time":"备份时间",
		"backup_title":"数据库备份详情",
		"backup":"备份",
		"input_confirm":"数据库将被覆盖，继续吗?",
		"input_the":"正在导入,请稍候...",
		"backup_the":"正在备份,请稍候...",
		"backup_del_title":"删除备份文件",
		"backup_del_confirm":"您真的要删除备份文件吗?",
		"del_all_title":"批量删除数据库",
		"del_all_err":"以下数据库删除失败:",
		"input_title_file":"从文件导入数据库",
		"input_local_up":"从本地上传",
		"input_ps1":"仅支持sql、zip、(tar.gz|gz|tgz)",
		"input_ps2":"zip、tar.gz压缩包结构：test.zip或test.tar.gz压缩包内，必需包含test.sql",
		"input_ps3":"若文件过大，您还可以使用SFTP工具，将数据库文件上传到/www/backup/database",
		"input_up_type":"请上传sql或zip或tar.gz压缩包",
		"auth_err":"此数据库不能修改访问权限",
		"auth_title":"设置数据库权限",
		"auth_name":"访问权限",
		"sync_the":"正在同步,请稍候...",
		"phpmyadmin_err":"请先安装phpMyAdmin",
		"phpmyadmin":"正在打开phpMyAdmin"
	},
	
	"soft":{
		"php_main1":"php服务",
		"php_main2":"上传限制",
		"php_main3":"超时限制",
		"php_main4":"配置文件",
		"php_main5":"安装扩展",
		"php_main6":"禁用函数",
		"php_main7":"性能调整",
		"php_main8":"负载状态",
		"php_menu_ext":"扩展配置",
		"admin":"管理",
		"off":"关闭",
		"on":"开启",
		"stop":"停止",
		"start":"启动",
		"status":"当前状态",
		"restart":"重启",
		"reload":"重载配置",
		"mysql_mem_err":"机器内存小于1G，不建议使用mysql5.5以上版本</li><li>如果数据库经常自动停止，请尝试使用Windows工具箱增加SWAP或者升级服务器内存",
		"concurrency_m":"自定义",
		"concurrency":"并发",
		"concurrency_type":"并发方案",
		"php_fpm_model":"运行模式",
		"php_fpm_ps1":"PHP-FPM运行模式",
		"php_fpm_ps2":"允许创建的最大子进程数",
		"php_fpm_ps3":"起始进程数（服务启动后初始进程数量）",
		"php_fpm_ps4":"最小空闲进程数（清理空闲进程后的保留数量）",
		"php_fpm_ps5":"最大空闲进程数（当空闲进程达到此值时清理）",
		"php_fpm_err1":"max_spare_servers 不能大于 max_children",
		"php_fpm_err2":"min_spare_servers 不能大于 start_servers",
		"php_fpm_err3":"min_spare_servers 不能大于 max_spare_servers",
		"php_fpm_err4":"start_servers 不能大于 max_children",
		"php_fpm_err5":"配置值不能小于1",
		"phpinfo":"查看phpinfo()",
		"get":"正在获取...",
		"get_list":"正在获取列表...",
		"the_save":"正在保存数据...",
		"config_edit":"配置修改",
		"edit_empty":"不修改请留空",
		"php_upload_size":"上传大小限制不能小于2M",
		"mvc_ps":"MVC架构的程序需要开启,如typecho",
		"the_install":"正在安装...",
		"the_uninstall":"正在卸载...",
		"install_the":"安装中...",
		"sleep_install":"等待安装...",
		"install":"安装",
		"uninstall":"卸载",
		"php_ext_name":"名称",
		"php_ext_type":"类型",
		"php_ext_ps":"说明",
		"php_ext_status":"状态",
		"php_ext_install_confirm":"您真的要安装{1}吗?",
		"php_ext_uninstall_confirm":"您真的要安装{1}吗?",
		"add_install":"正在添加到安装器...",
		"install_title":"软件安装",
		"insatll_type":"安装方式",
		"install_version":"安装版本",
		"type_title":"选择安装方式",
		"err_install1":"请先卸载Apache",
		"err_install2":"请先卸载Nginx",
		"err_install3":"请先安装php",
		"err_install4":"请先安装MySQL",
		"setup":"设置",
		"apache22":"警告:当前为php-fpm模式,将不被Apache2.2支持,请重新安装此PHP版本!",
		"apache24":"警告:当前为php5_module模式,将不被nginx/apache2.4支持,请重新安装此PHP版本!",
		"apache22_err":"Apache2.2不支持多PHP版本共存,请先卸载已安装PHP版本,再安装此版本!",
		"mysql_f":"注意: 安装新的MySQL版本,会覆盖数据库数据,请先备份数据库!",
		"mysql_d":"抱歉,出于安全考虑,请先到[数据库]管理备份数据库,并中删除所有数据库!",
		"fun_ps1":"添加要被禁止的函数名,如: exec",
		"fun_ps2":"在此处可以禁用指定函数的调用,以增强环境安全性!",
		"fun_ps3":"强烈建议禁用如exec,system等危险函数!",
		"fun_msg":"您输入的函数已被禁用!",
		"nginx_status":"负载状态",
		"nginx_version":"切换版本",
		"waf_title":"过滤器",
		"web_service":"Web服务",
		"waf_not":"您当前Nginx版本不支持waf模块,请安装Nginx1.12,重装Nginx不会丢失您的网站配置!",
		"waf_edit":"编辑规则",
		"waf_up":"上传限制",
		"waf_input1":"URL过滤",
		"waf_input2":"Cookie过滤",
		"waf_input3":"POST过滤",
		"waf_input4":"防CC攻击",
		"waf_input5":"记录防御信息",
		"waf_input6":"CC攻击触发频率(次)",
		"waf_input7":"CC攻击触发周期",
		"waf_input8":"IP白名单",
		"waf_input9":"IP黑名单",
		"waf_ip":"IP地址",
		"waf_up_title":"文件上传后缀黑名单",
		"waf_up_from1":"添加禁止上传的扩展名,如: zip",
		"waf_up_from2":"扩展名",
		"waf_url_white":"URL白名单",
		"waf_index":"警告内容",
		"waf_cloud":"从云端更新",
		"waf_update":"正在更新规则文件,请稍候..",
		"waf_cc_err":"CC防御配置值超出可用值 (频率1-3000|周期1-1800)",
		"php_version":"php版本",
		"save_path":"存储位置",
		"service":"服务",
		"safe":"安全设置",
		"log":"日志",
		"mysql_to_msg":"迁移数据库文件过程中将会停止数据库运行,继续吗?",
		"mysql_to_msg1":"正在迁移文件,请稍候...",
		"mysql_to":"迁移",
		"mysql_log_close":"清空",
		"mysql_log_bin":"二进制日志",
		"mysql_log_err":"错误日志",
		"mysql_log_ps1":"当前没有日志内容!",
		"mysql_port_title":"修改数据库端口可能会导致您的站点无法连接数据库,确定要修改吗?",
		"select_version":"选择版本",
		"version_to":"切换",
		"pma_port":"访问端口",
		"pma_port_title":"phpmyadmin访问端口",
		"pma_pass":"密码访问",
		"pma_user":"授权账号",
		"pma_pass1":"访问密码",
		"pma_pass2":"重复密码",
		"pma_ps":"为phpmyadmin增加一道访问安全锁",
		"pma_pass_close":"您真的要关闭访问认证吗?",
		"pma_pass_empty":"授权用户或密码不能为空!",
		"menu_temp":"正在获取模板...",
		"menu_phpsafe":"php守护已启动，无需设置",
		"qiniu_lise":"正在从云端获取...",
		"qiniu_file_title":"文件列表",
		"qiniu_th1":"名称",
		"qiniu_th2":"类型",
		"qiniu_th3":"大小",
		"qiniu_th4":"更新时间",
		"mysql_del_err":"抱歉,为安全考虑,请先到[数据库]管理备份数据库并中删除所有数据库!",
		"uninstall_confirm":"您真的要卸载[{1}-{2}]吗?",
		"from_err":"表单错误!",
		"lib_the":"正在提交配置,请稍候...",
		"lib_config":"配置",
		"lib_insatll_confirm":"您真的要安装[{1}]插件吗？",
		"lib_uninsatll_confirm":"您真的要卸载[{1}]插件吗？",
		"lib_install":"安装插件",
		"lib_uninstall":"卸载插件",
		"lib_install_the":"正在安装,请稍候...",
		"lib_uninstall_the":"正在卸载,请稍候...",
		"mysql_set_msg":"优化方案",
		"mysql_set_select":"请选择",
		"mysql_set_maxmem":"最大使用内存",
		"mysql_set_key_buffer_size":"用于索引的缓冲区大小",
		"mysql_set_query_cache_size":"查询缓存,不开启请设为0",
		"mysql_set_tmp_table_size":"临时表缓存大小",
		"mysql_set_innodb_buffer_pool_size":"Innodb缓冲区大小",
		"mysql_set_innodb_log_buffer_size":"Innodb日志缓冲区大小",
		"mysql_set_sort_buffer_size":"每个线程排序的缓冲大小",
		"mysql_set_read_buffer_size":"读入缓冲区大小",
		"mysql_set_read_rnd_buffer_size":"随机读取缓冲区大小",
		"mysql_set_join_buffer_size":"关联表缓存大小",
		"mysql_set_thread_stack":"每个线程的堆栈大小",
		"mysql_set_binlog_cache_size":"二进制日志缓存大小(4096的倍数)",
		"mysql_set_thread_cache_size":"线程池大小",
		"mysql_set_table_open_cache":"表缓存(最大不要超过2048)",
		"mysql_set_max_connections":"最大连接数",
		"mysql_set_restart":"重启数据库",
		"mysql_set_conn":"连接数",
		"mysql_set_err":"错误,内存分配过高!<p style='color:red;'>物理内存: {1}MB<br>最大使用内存: {2}MB<br>可能造成的后果: 导致数据库不稳定,甚至无法启动MySQLd服务!</p>",
		"mysql_status_title1":"启动时间",
		"mysql_status_title2":"总连接次数",
		"mysql_status_title3":"发送",
		"mysql_status_title4":"接收",
		"mysql_status_title5":"每秒查询",
		"mysql_status_title6":"每秒事务",
		"mysql_status_title7":"File",
		"mysql_status_title8":"Position",
		"mysql_status_title9":"活动/峰值连接数",
		"mysql_status_title10":"线程缓存命中率",
		"mysql_status_title11":"索引命中率",
		"mysql_status_title12":"Innodb索引命中率",
		"mysql_status_title13":"查询缓存命中率",
		"mysql_status_title14":"创建临时表到磁盘",
		"mysql_status_title15":"已打开的表",
		"mysql_status_title16":"没有使用索引的量",
		"mysql_status_title17":"没有索引的JOIN量",
		"mysql_status_title18":"排序后的合并次数",
		"mysql_status_title19":"锁表次数",
		"mysql_status_ps1":"若值过大,增加max_connections",
		"mysql_status_ps2":"若过低,增加thread_cache_size",
		"mysql_status_ps3":"若过低,增加key_buffer_size",
		"mysql_status_ps4":"若过低,增加innodb_buffer_pool_size",
		"mysql_status_ps5":"若过低,增加query_cache_size",
		"mysql_status_ps6":"若过大,尝试增加tmp_table_size",
		"mysql_status_ps7":"若过大,增加table_cache_size",
		"mysql_status_ps8":"若不为0,请检查数据表的索引是否合理",
		"mysql_status_ps9":"若不为0,请检查数据表的索引是否合理",
		"mysql_status_ps10":"若值过大,增加sort_buffer_size",
		"mysql_status_ps11":"若值过大,请考虑增加您的数据库性能"
	},
	
	"site":{
		"running":"正在运行",
		"running_title":"停用这个站点",
		"running_text":"运行中",
		"stopped":"已停止",
		"stopped_title":"启用这个站点",
		"backup_yes":"有备份",
		"backup_no":"无备份",
		"web_end_time":"永久",
		"open_path_txt":"打开目录",
		"set":"设置",
		"site_del_title":"删除站点",
		"site_no_data":"当前没有站点数据",
		"site_null":"null",
		"site_bak":"备注信息",
		"saving_txt":"正在保存...",
		"domain_err_txt":"域名格式不正确，请重新输入!",
		"ftp":"FTP账号资料",
		"ftp_tips":"只要将网站上传至以上FTP即可访问!",
		"user":"用户",
		"password":"密码",
		"database_txt":"数据库账号资料",
		"database":"数据库",
		"database_name":"数据库名",
		"database_set":"数据库设置",
		"success_txt":"成功创建站点",
		"php_ver":"PHP版本",
		"site_add":"添加网站",
		"domain":"域名",
		"port":"端口",
		"note":"备注",
		"note_ph":"网站备注",
		"web_root_dir":"网站根目录",
		"web_dir":"网站目录",
		"root_dir":"根目录",
		"yes":"创建",
		"no":"不创建",
		"ftp_set":"FTP设置",
		"ftp_help":"创建站点的同时，为站点创建一个对应FTP帐户，并且FTP目录指向站点所在目录。",
		"database_help":"创建站点的同时，为站点创建一个对应的数据库帐户，方便不同站点使用不同数据库。",
		"domain_help":"每行填写一个域名，默认为80端口<br>泛解析添加方法 *.domain.com<br>如另加端口格式为 www.domain.com:88",
		"domain_len_msg":"不要超出20个字符",
		"anti_XSS_attack":"防跨站攻击",
		"write_access_log":"写访问日志",
		"run_dir":"运行目录",
		"site_help_1":"部分程序需要指定二级目录作为运行目录，如ThinkPHP5，Laravel",
		"site_help_2":"选择您的运行目录，点保存即可",
		"default_doc_help":"默认文档，每行一个，优先级由上至下。",
		"site_stop_txt":"站点停用后将无法访问，您真的要停用这个站点吗？",
		"site_start_txt":"即将启动站点，您真的要启用这个站点吗？",
		"site_del_info":"是否要删除同名的FTP、数据库、根目录",
		"all_del_info":"同时删除站点根目录",
		"all_del_site":"批量删除站点",
		"del_err":"以下站点删除失败",
		"click_access":"点击访问",
		"operate":"操作",
		"domain_man":"域名管理",
		"unresolved":"未解析",
		"parsed":"已解析",
		"this_domain_un":"该域名未解析",
		"analytic_ip":"域名解析IP为",
		"current_server_ip":"当前服务器IP",
		"parsed_info":"仅供参考,使用CDN的用户请无视",
		"domain_empty":"域名不能为空!",
		"domain_last_cannot":"最后一个域名不能删除",
		"domain_del_confirm":"您真的要从站点中删除这个域名吗？",
		"webback_del_confirm":"真的要删除备份包吗?",
		"del_bak_file":"删除备份文件",
		"filename":"文件名称",
		"filesize":"文件大小",
		"backuptime":"打包时间",
		"backup_title":"打包备份",
		"public_set":"全局设置",
		"local_site":"本站",
		"setindex":"设置网站默认文档",
		"default_doc":"默认文档",
		"default_site":"默认站点",
		"default_site_yes":"设置默认站点",
		"default_site_no":"未设置默认站点",
		"default_site_help_1":"设置默认站点后,所有未绑定的域名和IP都被定向到默认站点",
		"default_site_help_2":"可有效防止恶意解析",
		"site_menu_1":"子目录绑定",
		"site_menu_2":"网站目录",
		"site_menu_3":"流量限制",
		"site_menu_4":"伪静态",
		"site_menu_5":"默认文档",
		"site_menu_6":"配置文件",
		"site_menu_7":"SSL",
		"site_menu_8":"PHP版本",
		"site_menu_9":"Tomcat",
		"site_menu_10":"301重定向",
		"site_menu_11":"反向代理",
		"site_menu_12":"防盗链",
		"website_change":"站点修改",
		"addtime":"添加时间",
		"the_msg":"正在提交任务...",
		"start_scan":"开始扫描",
		"update_lib":"更新特征库",
		"scanned":"已扫描",
		"risk_quantity":"风险数量",
		"danger_fun":"危险函数",
		"danger_fun_no":"未禁用危险函数",
		"danger":"危险",
		"file":"文件",
		"ssh_port":"远程桌面端口",
		"high_risk":"高危",
		"sshd_tampering":"sshd文件被篡改",
		"xss_attack":"跨站攻击",
		"site_xss_attack":"站点未开启防跨站攻击!",
		"mod_time":"修改时间",
		"code":"代码",
		"behavior":"行为",
		"risk":"风险",
		"details":"详情",
		"to_update":"正在更新，请稍候...",
		"limit_net_1":"论坛/博客",
		"limit_net_2":"图片站",
		"limit_net_3":"下载站",
		"limit_net_4":"商城",
		"limit_net_5":"门户",
		"limit_net_6":"企业站",
		"limit_net_7":"视频站",
		"limit_net_8":"启用流量控制",
		"limit_net_9":"限制方案",
		"limit_net_10":"并发限制",
		"limit_net_11":"限制当前站点最大并发数",
		"limit_net_12":"单IP限制",
		"limit_net_13":"限制单个IP访问最大并发数",
		"limit_net_14":"流量限制",
		"limit_net_15":"限制每个请求的流量上限（单位：KB）",
		"subdirectories":"子目录",
		"url_rewrite_alter":"你真的要为这个子目录创建独立的伪静态规则吗？",
		"rule_cov_tool":"规则转换工具",
		"a_c_n":"Apache转Nginx",
		"save_as_template":"另存为模板",
		"url_rw_help_1":"请选择您的应用，若设置伪静态后，网站无法正常访问，请尝试设置回default",
		"url_rw_help_2":"您可以对伪静态规则进行修改，修改完后保存即可。",
		"config_url":"配置伪静态规则",
		"d_s_empty":"域名和子目录名称不能为空",
		"s_bin_del":"您真的要删除这个子目录绑定吗？",
		"proxy_url":"目标URL",
		"proxy_url_info":"请填写完整URL,例：http://www.test.com",
		"proxy_domain":"发送域名",
		"proxy_domian_info":"发送到目标服务器的域名,例：www.test.com",
		"proxy_cache":"开启缓存",
		"con_rep":"内容替换",
		"con_rep_info":"被替换的文本,可留空",
		"to_con":"替换为,可留空",
		"proxy_enable":"启用反向代理",
		"proxy_help_1":"目标Url必需是可以访问的，否则将直接502",
		"proxy_help_2":"默认本站点所有域名访问将被传递到目标服务器，请确保目标服务器已绑定域名",
		"proxy_help_3":"若您是被动代理，请在发送域名处填写上目标站点的域名",
		"proxy_help_4":"若您不需要内容替换功能，请直接留空",
		"proxy_help_5":"可通过purge清理指定URL的缓存,示例：http://test.com/purge/test.png",
		"access_domain":"访问域名",
		"all_site":"整站",
		"target_url":"目标URL",
		"eg_url":"请填写完整URL,例：http://www.test.com",
		"enable_301":"启用301",
		"to301_help_1":"选择[整站]时请不要将目标URL设为同一站点下的域名.",
		"to301_help_2":"取消301重定向后，需清空浏览器缓存才能看到生效结果.",
		"bt_ssl":"宝塔SSL",
		"lets_ssl":"Let\'s Encrypt免费证书",
		"other":"其它",
		"other_ssl":"其他证书",
		"use_other_ssl":"使用其他证书",
		"ssl_help_1":"本站点未设置SSL，如需设置SSL，请选择切换类目申请开启SSL<br><p style='color:red;'>关闭SSL以后,请务必清除浏览器缓存再访问站点</p>",
		"ssl_help_2":"已为您自动生成Let\'s Encrypt免费证书；",
		"ssl_help_3":"如需使用其他SSL,请切换其他证书后粘贴您的KEY以及PEM内容，然后保存即可。",
		"ssl_key":"密钥(KEY)",
		"ssl_crt":"证书(PEM格式)",
		"ssl_close":"关闭SSL",
		"bt_bind_no":"未绑定宝塔账号，请注册绑定，绑定宝塔账号(非论坛账号)可实现一键部署SSL",
		"bt_user":"宝塔账号",
		"login":"登录",
		"bt_reg":"注册宝塔账号",
		"bt_ssl_help_1":"宝塔SSL证书为亚洲诚信证书，需要实名认证才能申请使用",
		"bt_ssl_help_2":"已有宝塔账号请登录绑定",
		"bt_ssl_help_3":"宝塔SSL申请的是TrustAsia DV SSL CA - G5 原价：1900元/1年，宝塔用户免费！",
		"bt_ssl_help_4":"一年满期后免费颁发。",
		"btapply":"申请",
		"endtime":"到期时间",
		"status":"状态",
		"bt_ssl_help_5":"申请之前，请确保域名已解析，如未解析会导致审核失败",
		"bt_ssl_help_6":"宝塔SSL申请的是免费版TrustAsia DV SSL CA - G5证书，仅支持单个域名申请",
		"bt_ssl_help_7":"有效期1年，不支持续签，到期后需要重新申请",
		"bt_ssl_help_8":"Let\'s Encrypt免费证书，有效期3个月，支持多域名。默认会自动续签",
		"bt_ssl_help_9":"若您的站点使用了CDN或301重定向会导致续签失败",
		"bt_ssl_help_10":"粘贴您的*.key以及*.pem内容，然后保存即可<a href='http://www.bt.cn/bbs/thread-704-1-1.html' class='btlink' target='_blank'>[帮助]</a>。",
		"phone_input":"请输入手机号码",
		"ssl_apply_1":"正在提交订单，请稍后..",
		"ssl_apply_2":"正在校验域名，请稍后..",
		"ssl_apply_3":"正在部署证书，请稍后..",
		"ssl_apply_4":"正在更新证书，请稍后..",
		"lets_help_1":"不用实名认证，浏览器兼容较低，申请存在一定失败率",
		"lets_help_2":"let's Encrypt证书有效期为3个月",
		"lets_help_3":"3个月有效期后自动续签",
		"get_ssl_list":"正在获取证书列表，请稍后..",
		"order_success":"订单完成",
		"deploy":"部署",
		"deployed":"已部署",
		"domain_wait":"待域名确认",
		"domain_validate":"验证域名",
		"domain_check":"请检查域名是否解析到本服务器",
		"update_ssl":"更新证书",
		"get_ssl_err":"证书获取失败",
		"get_ssl_err1":"证书获取失败，返回如下错误信息",
		"err_type":"错误类型",
		"ssl_close_info":"已关闭SSL,请务必清除浏览器缓存后再访问站点!",
		"switch":"切换",
		"switch_php_help1":"请根据您的程序需求选择版本",
		"switch_php_help2":"若非必要,请尽量不要使用PHP5.2,这会降低您的服务器安全性；",
		"switch_php_help3":"PHP7不支持mysql扩展，默认安装mysqli以及mysql-pdo。",
		"enable_nodejs":"启用Node.js",
		"nodejs_help1":"当前版本为Node.js",
		"nodejs_help2":"Node.js可以与PHP共存,但无法与Tomcat共存；",
		"nodejs_help3":"若您的Node.js应用中有php脚本,访问时请添加.php扩展名",
		"a_n_n":"apache2.2暂不支持Tomcat!",
		"enable_tomcat":"启用Tomcat",
		"tomcat_help1":"当前版本为Tomcat",
		"tomcat_help2":"若您需要其它版本,请到软件管理 - 所有软件 中切换；",
		"tomcat_help3":"部署顺序: 安装Tomcat >> 创建站点 >> 上传并配置项目 >> 启用Tomcat",
		"tomcat_help4":"若您的tomcat应用中有php脚本,访问时请添加.php扩展名",
		"tomcat_help5":"开启成功后,大概需要1-5分钟时间生效!",
		"tomcat_err_msg":"您没有安装Tomcat，请先安装!",
		"tomcat_err_msg1":"请先安装Tomcat!",
		"web_config_help":"此处为站点主配置文件,若您不了解配置规则,请勿随意修改.",
		"rewritename":"0.当前",
		"template_empty":"模板名称不能为空",
		"save_rewrite_temp":"保存为Rewrite模板",
		"template_name":"模板名称",
		"change_defalut_page":"修改默认页",
		"err_404":"404错误页",
		"empty_page":"空白页",
		"default_page_stop":"默认站点停止页"
	},
	
	"public":{
		"success":"操作成功!",
		"error":"操作失败!",
		"add_success":"添加成功!",
		"del_success":"删除成功",
		"save":"保存",
		"edit":"修改",
		"edit_ok":"修改成功!",
		"edit_err":"修改失败!",
		"know":"知道了",
		"close":"关闭",
		"cancel":"取消",
		"ok":"确定",
		"empty":"清空",
		"submit":"提交",
		"exec":"执行",
		"script":"脚本",
		"log":"日志",
		"slow_log":"慢日志",
		"del":"删除",
		"add":"添加",
		"the_get":"正在获取,请稍候...",
		"fresh":"刷新",
		"config":"正在设置...",
		"config_ok":"设置成功!",
		"the":"正在处理,请稍候...",
		"user":"帐号",
		"pass":"密码",
		"read":"正在读取,请稍候...",
		"pre":"百分比",
		"num":"次数",
		"byte":"字节",
		"input_err":"表单不合法,请重新输入!",
		"the_add":"正在添加,请稍候...",
		"the_del":"正在删除,请稍候...",
		"msg":"提示",
		"list_empty":"列表为空!",
		"all":"所有",
		"upload":"上传",
		"download":"下载",
		"action":"操作",
		"warning":"警告",
		"return":"返回",
		"help":"帮助",
		"list":"列表",
		"off":"关闭",
		"on":"开启"
	}
}
