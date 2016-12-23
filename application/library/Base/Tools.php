<?php
# function GetUrlToDomain($domain)  获取域名的主域 

# checkBadWord($string,$badword='complex')  检查是否有违禁词

# setHeaderUtf8()  设置header-utf8头

# passwdGen($length = 8, $flag = self::FLAG_NO_NUMERIC)  生成随机密码

# redirect($url, $headers = null) URL 跳转

# cleanUrl($url, $cleanall = true) 清理URL中的header头

# getHttpHost($http = false, $entities = false) 获取当前域名

# getServerName()  获取当前服务器名

# getRemoteAddr()  获取用户IP地址

# get_client_ip($type = 0,$adv=false) 获取客户端IP地址

# getReferer()  获取用户来源

# usingSecureMode() 判断是否使用了https

# getCurrentUrlProtocolPrefix() 获取当前URL协议

# secureReferrer($referrer) 判断是否本站链接 

# getValue($key, $default_value = false) 获取POST或GET的指定字段内容

# getIsset($key) 判断POST或GET中是否包含指定字段

# isSubmit($submit) 判断是否为提交操作

# deleteDirectory($dirname, $delete_self = true) 删除文件夹

# replaceAccentedChars($str)

# cleanNonUnicodeSupport($pattern) 

# dateYears()  生成年份

# dateDays() 生成日

# dateMonths() 生成月

# hourGenerate($hours, $minutes, $seconds)  

# dateFrom($date)  一日之初

# dateTo($date) 一日之终 

# getExactTime() 获取精准的时间

# strtolower($str) 转换成小写字符，支持中文

# intval($val) 转换为int类型
 
# strlen($str, $encoding = 'UTF-8') 计算字符串长度

# isEmpty($field)  判断是否真为空

# ceilf($value, $precision = 0)

# floorf($value, $precision = 0) 

# replaceSpace($url)

# getSimpleDate($timestamp = null)获取日期 

# getFullDate($timestamp = null) 获取完整时间

# isX86_64arch() 判断是否64位架构

# getMaxUploadSize($max_size = 0) 获取服务器配置允许最大上传文件大小

# convertBytes($value)

# getMemoryLimit() 获取内存限制

# simpleArray($array, $key) 从array中取出指定字段

# object2array(&$object) 对象转数组

# getmicrotime() 

# getTimeImageName($image_type = "image/jpeg") 根据时间生成图片名

# dateadd($interval, $step, $date) 日期计算

# echo_microtime($tag) 

# redirectTo($link)

# returnAjaxJson($array)获取json字符串

# 判断大小cmpWord($a, $b)

# getGravity($time, $viewcount) HackNews热度计算公式

# getGravityS($stime, $viewcount) 

# getFileExtension($file) 获取文件扩展名

# returnMobileJson($code, $data, $native = false) 以固定格式将数据及状态码返回手机端

# walkArray(&$array, $function, $keys = false) 遍历数组

# scandir($path, $ext = 'php', $dir = '', $recursive = false) 遍历路径

# arrayUnique($array)函数移除数组中的重复的值，并返回结果数组。

# arrayUnique2d($array, $keepkeys = true)

# sys_get_temp_dir() 

# saveFile($url, $filepath) 下载文件保存到指定位置

# copyFile($source, $dest) 文件复制

# isSpider() 判断是否爬虫，范围略大

# isCli() 判断是否命令行执行

# sendToBrowser($file, $delaftersend = true, $exitaftersend = true)

# formatTags($tags) 格式化字符串将, 、等转换成数组

# changeTimeToWeek($time) 转换时间为星期

# change_href_blank($str) 修改文本中的连接在新的窗口打开

# trimUriExtend($uri) 修改url过滤最后的html

# check_url($str) 判断是否是合法rul

# change_img_size($str,$w=80,$h=80)  修改图片显示尺寸

# filterBanZheng ($str, $istitle = false) 过滤办证违禁词

# mhtmlentities 转义

# wapdecoder($str) unicode 码转换为utf-8编码

# displayError($string = 'Fatal error', $error = array(), $htmlentities = true) 显示错误信息

# is_mobile_request() 判断是否手机访问

# is_weixin_request() 判断是否微信访问

# json_encode($obj)

# json_decode($obj)

# getSinaShortUrl($longurl) 新浪短网址

# getBaiduShortUrl($longUrl) 百度短网址

# list_search($list,$condition) 在数据列表中搜索

# list_sort_by($list,$field, $sortby='asc') 对查询结果集进行排序

# list_to_tree($list, $pk='id',$pid = 'pid',$child = '_child',$root=0) 把返回的数据集转换成Tree

namespace library\Base;
class Tools {

	const FLAG_NUMERIC = 1;
	const FLAG_NO_NUMERIC = 2;
	const FLAG_ALPHANUMERIC = 3;

	
	/**
	* 获取域名的主域
	* 
	* @param string $domain
	*/
	public static function GetUrlToDomain($domain) {
		
		$re_domain = '';
		$domain_postfix_cn_array = array("com", "net", "org", "gov", "edu", "com.cn", "cn");
		$array_domain = explode(".", $domain);
		$array_num = count($array_domain) - 1;
		if ($array_domain[$array_num] == 'cn') {
			if (in_array($array_domain[$array_num - 1], $domain_postfix_cn_array)) {
				$re_domain = $array_domain[$array_num - 2] . "." . $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
			} else {
				$re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
			}
		} else {
			$re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
		}
		return $re_domain;
	}
	
	/**
	* 检查是否有违禁词
	* 
	* @param string $string
	* @param string $badword
	*/
	public static function checkBadWord($string,$badword='complex',$count=14){
		$cache = EMemcached::getInstance();
		if($badword=='complex'){
			for($i=1;$i<=$count;$i++){

				$xiaodongcache = $cache->get('evente_base','badword_cache'.$i);
				if(!$xiaodongcache){
					$xiaodongcache = include ELIB.'Badword/cache/xiaodong_'.$i.'.cache.php';
					$cache->set('evente_base','badword_cache'.$i,$xiaodongcache);
				}

				$badword = Badkeywords::searchKeyword($xiaodongcache,$string);
				if(!empty($badword)){
					return $badword;
				}
			}
			return false;
			
		}else{
			return false;
		}

		
	}
	
	/**
	 * 设置header-utf8头
	 *
	 */
	public static function setHeaderUtf8() {
		header("Content-type:text/html;charset=utf-8");
	}

	/**
	 * 生成随机密码
	 *
	 * @param integer $length Desired length (optional)
	 * @param string  $flag   Output type (NUMERIC, ALPHANUMERIC, NO_NUMERIC)
	 *
	 * @return string Password
	 */
	public static function passwdGen($length = 8, $flag = self::FLAG_NO_NUMERIC) {
		switch ($flag)
		{
			case self::FLAG_NUMERIC:
				$str = '0123456789';
				break;
			case self::FLAG_NO_NUMERIC:
				$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case self::FLAG_ALPHANUMERIC:
			default:
				$str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
		}

		for ($i = 0, $passwd = ''; $i < $length; $i++){
			$passwd .= Tools::substr($str, mt_rand(0, Tools::strlen($str) - 1), 1);
		}

		return $passwd;
	}

    /**
     * 截取字符串
     *
     * @param        $str
     * @param        $start
     * @param bool   $length
     * @param string $encoding
     *
     * @return bool|string
     */
    public static function substr($str, $start, $length = false, $encoding = 'utf-8') {
        if (is_array($str) || is_object($str))
            return false;
        if (function_exists('mb_substr'))
            return mb_substr($str, intval($start), ($length === false ? self::strlen($str) : intval($length)), $encoding);
        return substr($str, $start, ($length === false ? Tools::strlen($str) : intval($length)));
    }


	
	/**
	 * URL跳转
	 *
	 * @param      $url
	 * @param null $headers
	 */
	public static function redirect($url, $headers = null) {
		if (!empty($url)){
			if ($headers){
				if (!is_array($headers)){
					$headers = array($headers);
				}
				foreach ($headers as $header){
					header($header);
				}
			}
			header('Location: ' . $url);
			exit;
		}
	}

	/**
	 * 清理URL中的http头
	 *
	 * @param      $url
	 * @param bool $cleanall
	 *
	 * @return mixed|string
	 */
	public static function cleanUrl($url, $cleanall = true) {
		if (strpos($url, 'http://') !== false){
			if ($cleanall){
				return '/';
			}else{
				return str_replace('http://', '', $url);
			}
		}

		return $url;
	}

	/**
	 * 获取当前域名
	 *
	 * @param bool $http
	 * @param bool $entities
	 *
	 * @return string
	 */
	public static function getHttpHost($http = false, $entities = false) {
		$host = (isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']);
		if ($entities){
			$host = htmlspecialchars($host, ENT_COMPAT, 'UTF-8');
		}
		if ($http){
			$host = self::getCurrentUrlProtocolPrefix() . $host;
		}

		return $host;
	}

	/**
	 * 获取当前服务器名
	 *
	 * @return mixed
	 */
	public static function getServerName() {
		if (isset($_SERVER['HTTP_X_FORWARDED_SERVER']) && $_SERVER['HTTP_X_FORWARDED_SERVER']){
			return $_SERVER['HTTP_X_FORWARDED_SERVER'];
		}

		return $_SERVER['SERVER_NAME'];
	}

	/**
	 * 获取用户IP地址
	 *
	 * @return mixed
	 */
	public static function getRemoteAddr() {
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && (!isset($_SERVER['REMOTE_ADDR']) || preg_match('/^127\..*/i', trim($_SERVER['REMOTE_ADDR'])) || preg_match('/^172\.16.*/i', trim($_SERVER['REMOTE_ADDR'])) || preg_match('/^192\.168\.*/i', trim($_SERVER['REMOTE_ADDR'])) || preg_match('/^10\..*/i', trim($_SERVER['REMOTE_ADDR']))))
		{
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')){
				$ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				return $ips[0];
			}else{
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		}

		return $_SERVER['REMOTE_ADDR'];
	}
    
    /**
     * 获取客户端IP地址
     * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @param boolean $adv 是否进行高级模式获取（有可能被伪装） 
     * @return mixed
     */
    public static function get_client_ip($type = 0,$adv=false) {
        $type       =  $type ? 1 : 0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if($adv){
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos    =   array_search('unknown',$arr);
                if(false !== $pos) unset($arr[$pos]);
                $ip     =   trim($arr[0]);
            }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip     =   $_SERVER['HTTP_CLIENT_IP'];
            }elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip     =   $_SERVER['REMOTE_ADDR'];
            }
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }

    /**
     * IP转成整形数值
     * @param string $ip IP
     * @return int
     */
    public static function ipToInt( $ip )
    {
    	$ips = explode('.',$ip);
		if (count($ips)>=4) {
			$int = $ips[0]*256*256*256+$ips[1]*256*256+$ips[2]*256+$ips[3];//根据IP,a,b,c类进行计算
		} else {
			throw new \Exception('ip is error');
		}
		return $int;
    }
    
    /**
     * 获取 IP  地理位置
     * 淘宝IP接口
     * @Return: array
     */
    public static function getAreaInfo($ip) {
        $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
        $ip=json_decode(file_get_contents($url)); 
        if((string)$ip->code=='1'){
            return false;
        }
        $data = (array)$ip->data;
        return $data; 
    }



	/**
	 * 获取用户来源地址
	 *
	 * @return null
	 */
	public static function getReferer() {
		if (isset($_SERVER['HTTP_REFERER'])){
			return $_SERVER['HTTP_REFERER'];
		}else{
			return null;
		}
	}

	/**
	 * 获取当前页面链接
	 *
	 * @return null
	 */
	function curPageURL() {
	    $pageURL = 'http';
	    if (@$_SERVER["HTTPS"] == "on") {
	        $pageURL .= "s";
	    }
	    $pageURL .= "://";
	    if ($_SERVER["SERVER_PORT"] != "80") {
	        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	    } 
	    else {
	        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	    }
	    return $pageURL;
	}

	/**
	 * 判断是否使用了HTTPS
	 *
	 * @return bool
	 */
	public static function usingSecureMode() {
		if (isset($_SERVER['HTTPS'])){
			return ($_SERVER['HTTPS'] == 1 || strtolower($_SERVER['HTTPS']) == 'on');
		}
		if (isset($_SERVER['SSL'])){
			return ($_SERVER['SSL'] == 1 || strtolower($_SERVER['SSL']) == 'on');
		}
		return false;
	}

	/**
	 * 获取当前URL协议
	 *
	 * @return string
	 */
	public static function getCurrentUrlProtocolPrefix() {
		if (Tools::usingSecureMode()){
			return 'https://';
		}else{
			return 'http://';
		}
	}

	/**
	 * 判断是否本站链接
	 *
	 * @param $referrer
	 *
	 * @return string
	 */
	public static function secureReferrer($referrer) {
		if (preg_match('/^http[s]?:\/\/' . Tools::getServerName() . '(:443)?\/.*$/Ui', $referrer)){
			return $referrer;
		}

		return '/';
	}

	/**
	 * 获取POST或GET的指定字段内容
	 *
	 * @param      $key
	 * @param bool $default_value
	 *
	 * @return bool|string
	 */
	public static function getValue($key, $default_value = false) {
		if (!isset($key) || empty($key) || !is_string($key)){
			return false;
		}
		$ret = (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $default_value));

		if (is_string($ret) === true){
			$ret = trim(urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($ret))));
		}
		return !is_string($ret) ? $ret : stripslashes($ret);
	}

	/**
	 * 判断POST或GET中是否包含指定字段
	 *
	 * @param $key
	 *
	 * @return bool
	 */
	public static function getIsset($key) {
		if (!isset($key) || empty($key) || !is_string($key)){
			return false;
		}
		return isset($_POST[$key]) ? true : (isset($_GET[$key]) ? true : false);
	}

	/**
	 * 判断是否为提交操作
	 *
	 * @param $submit
	 *
	 * @return bool
	 */
	public static function isSubmit($submit) {
		return (isset($_POST[$submit]) || isset($_POST[$submit . '_x']) || isset($_POST[$submit . '_y']) || isset($_GET[$submit]) || isset($_GET[$submit . '_x']) || isset($_GET[$submit . '_y']));
	}

	/**
	 * 删除文件夹
	 *
	 * @param      $dirname
	 * @param bool $delete_self
	 */
	public static function deleteDirectory($dirname, $delete_self = true) {
		$dirname = rtrim($dirname, '/') . '/';
		if (is_dir($dirname)){
			$files = scandir($dirname);
			foreach ($files as $file)
				if ($file != '.' && $file != '..' && $file != '.svn'){
					if (is_dir($dirname . $file)){
						Tools::deleteDirectory($dirname . $file, true);
					}elseif (file_exists($dirname . $file)){
						unlink($dirname . $file);
					}
				}
			if ($delete_self){
				rmdir($dirname);
			}
		}
	}

	public static function cleanNonUnicodeSupport($pattern) {
		if (!defined('PREG_BAD_UTF8_OFFSET'))
			return $pattern;

		return preg_replace('/\\\[px]\{[a-z]\}{1,2}|(\/[a-z]*)u([a-z]*)$/i', "$1$2", $pattern);
	}

	/**
	 * 生成年份
	 *
	 * @return array
	 */
	public static function dateYears() {
		$tab = array();

		for ($i = date('Y') - 10; $i >= 1900; $i--){
			$tab[] = $i;
		}

		return $tab;
	}

	/**
	 * 生成日
	 *
	 * @return array
	 */
	public static function dateDays() {
		$tab = array();

		for ($i = 1; $i != 32; $i++){
			$tab[] = $i;
		}

		return $tab;
	}

	/**
	 * 生成月
	 *
	 * @return array
	 */
	public static function dateMonths() {
		$tab = array();

		for ($i = 1; $i != 13; $i++){
			$tab[$i] = date('F', mktime(0, 0, 0, $i, date('m'), date('Y')));
		}
		return $tab;
	}

	/**
	 * 根据时分秒生成时间字符串
	 *
	 * @param $hours
	 * @param $minutes
	 * @param $seconds
	 *
	 * @return string
	 */
	public static function hourGenerate($hours, $minutes, $seconds) {
		return implode(':', array($hours, $minutes, $seconds));
	}

	/**
	 * 一日之初
	 *
	 * @param $date
	 *
	 * @return string
	 */
	public static function dateFrom($date) {
		$tab = explode(' ', $date);
		if (!isset($tab[1])){
			$date .= ' ' . self::hourGenerate(0, 0, 0);
		}
		return $date;
	}

	/**
	 * 一日之终
	 *
	 * @param $date
	 *
	 * @return string
	 */
	public static function dateTo($date) {
		$tab = explode(' ', $date);
		if (!isset($tab[1])){
			$date .= ' ' . self::hourGenerate(23, 59, 59);
		}
		return $date;
	}

	/**
	 * 获取精准的时间
	 *
	 * @return int
	 */
	public static function getExactTime() {
		return microtime(true);
	}
	//时间函数
	function microtime_float()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}

	/**
	 * 转换成小写字符，支持中文
	 *
	 * @param $str
	 *
	 * @return bool|string
	 */
	public static function strtolower($str) {
		if (is_array($str)){
			return false;
		}
		if (function_exists('mb_strtolower')){
			return mb_strtolower($str, 'utf-8');
		}
		return strtolower($str);
	}

	/**
	 * 转换为int类型
	 *
	 * @param $val
	 *
	 * @return int
	 */
	public static function intval($val) {
		if (is_int($val)){
			return $val;
		}
		if (is_string($val)){
			return (int)$val;
		}

		return (int)(string)$val;
	}

	/**
	 * 计算字符串长度
	 *
	 * @param        $str
	 * @param string $encoding
	 *
	 * @return bool|int
	 */
	public static function strlen($str, $encoding = 'UTF-8') {
		if (is_array($str) || is_object($str)){
			return false;
		}
		$str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
		if (function_exists('mb_strlen')){
			return mb_strlen($str, $encoding);
		}

		return strlen($str);
	}

	/**
	 * 判断是否真为空
	 *
	 * @param $field
	 *
	 * @return bool
	 */
	public static function isEmpty($field) {
		return ($field === '' || $field === null);
	}

	public static function ceilf($value, $precision = 0) {
		$precisionFactor = $precision == 0 ? 1 : pow(10, $precision);
		$tmp = $value * $precisionFactor;
		$tmp2 = (string)$tmp;
		// If the current value has already the desired precision
		if (strpos($tmp2, '.') === false){
			return ($value);
		}
		if ($tmp2[strlen($tmp2) - 1] == 0){
			return $value;
		}

		return ceil($tmp) / $precisionFactor;
	}

	public static function floorf($value, $precision = 0) {
		$precisionFactor = $precision == 0 ? 1 : pow(10, $precision);
		$tmp = $value * $precisionFactor;
		$tmp2 = (string)$tmp;
		// If the current value has already the desired precision
		if (strpos($tmp2, '.') === false){
			return ($value);
		}
		if ($tmp2[strlen($tmp2) - 1] == 0){
			return $value;
		}

		return floor($tmp) / $precisionFactor;
	}

	public static function replaceSpace($url) {
		return urlencode(strtolower(preg_replace('/[ ]+/', '-', trim($url, ' -/,.?'))));
	}

	/**
	 * 获取日期
	 *
	 * @param null $timestamp
	 *
	 * @return bool|string
	 */
	public static function getSimpleDate($timestamp = null) {
		if ($timestamp == null){
			return date('Y-m-d');
		}else{
			return date('Y-m-d', $timestamp);
		}
	}

	/**
	 * 获取完整时间
	 *
	 * @param null $timestamp
	 *
	 * @return bool|string
	 */
	public static function getFullDate($timestamp = null) {
		if ($timestamp == null){
			return date('Y-m-d H:i:s');
		}else{
			return date('Y-m-d H:i:s', $timestamp);
		}
	}

	/**
	 * 判断是否64位架构
	 *
	 * @return bool
	 */
	public static function isX86_64arch() {
		return (PHP_INT_MAX == '9223372036854775807');
	}

	/**
	 * 获取服务器配置允许最大上传文件大小
	 *
	 * @param int $max_size
	 *
	 * @return mixed
	 */
	public static function getMaxUploadSize($max_size = 0) {
		$post_max_size = Tools::convertBytes(ini_get('post_max_size'));
		$upload_max_filesize = Tools::convertBytes(ini_get('upload_max_filesize'));
		if ($max_size > 0){
			$result = min($post_max_size, $upload_max_filesize, $max_size);
		}else{
			$result = min($post_max_size, $upload_max_filesize);
		}
		return $result;
	}

	public static function convertBytes($value) {
		if (is_numeric($value)){
			return $value;
		}else{
			$value_length = strlen($value);
			$qty = (int)substr($value, 0, $value_length - 1);
			$unit = strtolower(substr($value, $value_length - 1));
			switch ($unit)
			{
				case 'k':
					$qty *= 1024;
					break;
				case 'm':
					$qty *= 1048576;
					break;
				case 'g':
					$qty *= 1073741824;
					break;
			}

			return $qty;
		}
	}

	/**
	 * 获取内存限制
	 *
	 * @return int
	 */
	public static function getMemoryLimit() {
		$memory_limit = @ini_get('memory_limit');

		return Tools::getOctets($memory_limit);
	}

	/**
	 * 从array中取出指定字段
	 *
	 * @param $array
	 * @param $key
	 *
	 * @return array|null
	 */
	public static function simpleArray($array, $key) {
		if (!empty($array) && is_array($array)){
			$result = array();
			foreach ($array as $k => $item){
				$result[$k] = $item[$key];
			}

			return $result;
		}

		return null;
	}

	public static function object2array(&$object) {
		return json_decode(json_encode($object), true);
	}

	public static function getmicrotime() {
		list($usec, $sec) = explode(" ", microtime());

		return floor($sec + $usec * 1000000);
	}

	/**
	 * 根据时间生成图片名
	 *
	 * @param string $image_type
	 *
	 * @return float|string
	 */
	public static function getTimeImageName($image_type = "image/jpeg") {
		if ($image_type == "image/jpeg" || $image_type == "image/pjpeg"){
			return self::getmicrotime() . ".jpg";
		}elseif ($image_type == "image/gif"){
			return self::getmicrotime() . ".gif";
		}elseif ($image_type == "image/png"){
			return self::getmicrotime() . ".png";
		}else{
			return self::getmicrotime();
		}
	}

	/**
	 * 日期计算
	 *
	 * @param $interval
	 * @param $step
	 * @param $date
	 *
	 * @return bool|string
	 */
	public static function dateadd($interval, $step, $date) {
		list($year, $month, $day) = explode('-', $date);
		if (strtolower($interval) == 'y'){
			return date('Y-m-d', mktime(0, 0, 0, $month, $day, intval($year) + intval($step)));
		}elseif (strtolower($interval) == 'm'){
			return date('Y-m-d', mktime(0, 0, 0, intval($month) + intval($step), $day, $year));
		}elseif (strtolower($interval) == 'd'){
			return date('Y-m-d', mktime(0, 0, 0, $month, intval($day) + intval($step), $year));
		}

		return date('Y-m-d');
	}

	public static function echo_microtime($tag) {
		list($usec, $sec) = explode(' ', microtime());
		echo $tag . ':' . ((float)$usec + (float)$sec) . "\n";
	}

	public static function redirectTo($link) {
		if (strpos($link, 'http') !== false){
			header('Location: ' . $link);
		}else{
			header('Location: ' . Tools::getHttpHost(true) . '/' . $link);
		}
		exit;
	}
	/**
	 * 获取json字符串
	 *
	 * @param $array
	 * @return string
	 */
	public static function returnAjaxJson($array) {
		if (!headers_sent()){
			header("Content-Type: application/json; charset=utf-8");
		}
		echo(json_encode($array));
		ob_end_flush();
		exit;
	}
	/**
	 * 判断大小
	 *
	 * @param $a
	 * @param $b
	 * @return int
	 */
	public static function cmpWord($a, $b) {
		if ($a['word'] > $b['word']){
			return 1;
		}elseif ($a['word'] == $b['word']){
			return 0;
		}else{
			return -1;
		}
	}

	/**
	 * HackNews热度计算公式
	 *
	 * @param $time
	 * @param $viewcount
	 *
	 * @return float|int
	 */
	public static function getGravity($time, $viewcount) {
		$timegap = ($_SERVER['REQUEST_TIME'] - strtotime($time)) / 3600;
		if ($timegap <= 24){
			return 999999;
		}

		return round((pow($viewcount, 0.8) / pow(($timegap + 24), 1.2)), 3) * 1000;
	}

	public static function getGravityS($stime, $viewcount) {
		$timegap = ($_SERVER['REQUEST_TIME'] - $stime) / 3600;
		if ($timegap <= 24){
			return 999999;
		}

		return round((pow($viewcount, 0.8) / pow(($timegap + 24), 1.2)), 3) * 1000;
	}

	/**
	 * 获取文件扩展名
	 *
	 * @param $file
	 *
	 * @return mixed|string
	 */
	public static function getFileExtension($file) {
		if (is_uploaded_file($file)){
			return "unknown";
		}

		return pathinfo($file, PATHINFO_EXTENSION);
	}

	/**
	 * 以固定格式将数据及状态码返回手机端
	 *
	 * @param      $code
	 * @param      $data
	 * @param bool $native
	 */
	public static function returnMobileJson($code, $data, $native = false) {
		if (!headers_sent()){
			header("Content-Type: application/json; charset=utf-8");
		}
		if (is_array($data) && $native){
			self::walkArray($data, 'urlencode', true);
			echo(urldecode(json_encode(array('code' => $code, 'data' => $data))));
		}elseif (is_string($data) && $native){
			echo(urldecode(json_encode(array('code' => $code, 'data' => urlencode($data)))));
		}else{
			echo(json_encode(array('code' => $code, 'data' => $data)));
		}
		ob_end_flush();
		exit;
	}

	/**
	 * 遍历数组
	 *
	 * @param      $array
	 * @param      $function
	 * @param bool $keys
	 */
	public static function walkArray(&$array, $function, $keys = false) {
		foreach ($array as $key => $value){
			if (is_array($value)){
				self::walkArray($array[$key], $function, $keys);
			}elseif (is_string($value)){
				$array[$key] = $function($value);
			}

			if ($keys && is_string($key)){
				$newkey = $function($key);
				if ($newkey != $key){
					$array[$newkey] = $array[$key];
					unset($array[$key]);
				}
			}
		}
	}

	/**
	 * 遍历路径
	 *
	 * @param        $path
	 * @param string $ext
	 * @param string $dir
	 * @param bool   $recursive
	 *
	 * @return array
	 */
	public static function scandir($path, $ext = 'php', $dir = '', $recursive = false) {
		$path = rtrim(rtrim($path, '\\'), '/') . '/';
		$real_path = rtrim(rtrim($path . $dir, '\\'), '/') . '/';
		$files = scandir($real_path);
		if (!$files)
			return array();

		$filtered_files = array();

		$real_ext = false;
		if (!empty($ext))
			$real_ext = '.' . $ext;
		$real_ext_length = strlen($real_ext);

		$subdir = ($dir) ? $dir . '/' : '';
		foreach ($files as $file)
		{
			if (!$real_ext || (strpos($file, $real_ext) && strpos($file, $real_ext) == (strlen($file) - $real_ext_length)))
				$filtered_files[] = $subdir . $file;

			if ($recursive && $file[0] != '.' && is_dir($real_path . $file))
				foreach (Tools::scandir($path, $ext, $subdir . $file, $recursive) as $subfile)
					$filtered_files[] = $subfile;
		}

		return $filtered_files;
	}
	
	/**
	 * 移除一维数组中重复的值
	 * @return array
	 */
	public static function arrayUnique($array) {
		if (version_compare(phpversion(), '5.2.9', '<'))
			return array_unique($array);
		else
			return array_unique($array, SORT_REGULAR);
	}
    
    /*
	* 移除二维数组中重复的值
	* @return array
	*/
	public static function arrayUnique2d($array, $keepkeys = true) {
		$output = array();
		if (!empty($array) && is_array($array)) {
			$stArr = array_keys($array);
			$ndArr = array_keys(end($array));

			$tmp = array();
			foreach ($array as $i) {
				$i = join("¤", $i);
				$tmp[] = $i;
			}

			$tmp = array_unique($tmp);

			foreach ($tmp as $k => $v) {
				if ($keepkeys)
					$k = $stArr[$k];
				if ($keepkeys) {
					$tmpArr = explode("¤", $v);
					foreach ($tmpArr as $ndk => $ndv) {
						$output[$k][$ndArr[$ndk]] = $ndv;
					}
				}
				else {
					$output[$k] = explode("¤", $v);
				}
			}
		}
		return $output;
	}	

	public static function sys_get_temp_dir() {
		if (function_exists('sys_get_temp_dir')){
			return sys_get_temp_dir();
		}
		if ($temp = getenv('TMP')){
			return $temp;
		}
		if ($temp = getenv('TEMP')){
			return $temp;
		}
		if ($temp = getenv('TMPDIR')){
			return $temp;
		}
		$temp = tempnam(__FILE__, '');
		if (file_exists($temp)){
			unlink($temp);

			return dirname($temp);
		}

		return null;
	}

	/**
	 * 下载文件保存到指定位置
	 *
	 * @param $url
	 * @param $filepath
	 *
	 * @return bool
	 */
	public static function saveFile($url, $filepath) {
		if ($url && !empty($filepath)){
			$file = self::file_get_contents($url);
			$fp = @fopen($filepath, 'w');
			if ($fp){
				@fwrite($fp, $file);
				@fclose($fp);

				return $filepath;
			}
		}

		return false;
	}

	/**
	 * 文件复制
	 *
	 * @param $source
	 * @param $dest
	 *
	 * @return bool
	 */
	public static function copyFile($source, $dest) {
		if (file_exists($dest) || is_dir($dest)){
			return false;
		}

		return copy($source, $dest);
	}

	/**
	 * 判断是否爬虫，范围略大
	 *
	 * @return bool
	 */
	public static function isSpider() {
		if(isset($_SERVER['HTTP_USER_AGENT'])){
			$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
			$spiders = array('spider', 'bot');
			foreach ($spiders as $spider){
				if (strpos($ua, $spider) !== false){
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * 判断是否命令行执行
	 *
	 * @return bool
	 */
	public static function isCli() {
		if (isset($_SERVER['SHELL']) && !isset($_SERVER['HTTP_HOST'])){
			return true;
		}

		return false;
	}

	public static function sendToBrowser($file, $delaftersend = true, $exitaftersend = true) {
		if (file_exists($file) && is_readable($file)){
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment;filename = ' . basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check = 0, pre-check = 0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			if ($delaftersend){
				unlink($file);
			}
			if ($exitaftersend){
				exit;
			}
		}
	}

	//==============================
	
	

	
	/**
	 * 格式化字符串将, 、等转换成数组
	 *
	 * @param string $tags 原有字符串
	 * @return string 返回拆分数组
	 */
	public static function formatTags($tags) {

		$tags = str_replace("，", " ", $tags);
		$tags = str_replace(", ", " ", $tags);
		$tags = str_replace(",", " ", $tags);
		$tags = str_replace("、", " ", $tags);
		$tags = str_replace("　", " ", $tags);
		$tags = str_replace("\n", " ", $tags);

		$info = explode(" ", $tags);
		for ($i = 0; $i < count($info); $i++){
			$str = trim($info[$i]);
			if (strlen($str) > 0) {
				$temp[] = $str;
			}
		}

		if (is_array($temp)) {
			return $temp;
		}
		return NULL;
	}

	
	/**
	 * 转换时间为星期
	 *
	 * @param string/int $time 时间
	 * @return string
	 */
	public static function changeTimeToWeek($time) {
		$oldTime = $time;
		$time = intval($time);
		if(strlen($time) != 10) {
			$time = strtotime($oldTime);
		}
		if(empty($time)) {
			return true;
		}
		$timeArr = array('日','一','二','三','四','五','六');
		$date = date('w', $time);
		if($date >= 0 && $date <= 6) {
			return "星期" . $timeArr[$date];
		} else {
			return false;
		}
	}

	/**
	 * 修改文本中的连接在新的窗口打开
	 *
	 * @param unknown_type $str
	 * @return unknown
	 */
	public static function change_href_blank($str) {
		 $str = preg_replace ("/target=([_a-zA-Z]+)/i","",$str);
		 $str = preg_replace("/<a([^>]+)>/i","<a target='_blank' $1 >", $str);
		 return $str;
	}

	/**
	 * 修改url过滤最后的html
	 *
	 * @param string $uri
	 * @return string
	 */
	public static function trimUriExtend($uri) {
		$val = preg_replace("|^(.*)".URI_EXTEND."$|isU",'\\1',$uri);
		return $val;
	}
	/**
	 * 判断是否是合法rul
	 *
	 * @param string $str
	 * @return string
	 */
	public static function check_url($str){
		return preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"])*$/", $str);
	}
	/**
	 * 修改图片显示尺寸
	 *
	 * @param string $str
	 * @param int $w
	 * @param int $h
	 * @return string
	 */
	public static function change_img_size($str,$w=80,$h=80) {
		 $str = preg_replace("/<img(.+?)src=('|\")?([^\s]+?)('|\"|\/|'\/|\"\/)?(\s|>).+>/is","<img width='{$w}' height='{$h}' src=$3 />", $str);
		 return $str;
	}

	public static function filterBanZheng($str, $istitle = false) {
		if($istitle == false) {
			$middle = " |　|\.|\*|★|\/|\\\\";
		} else {
			$middle = ".";
		}
		return 
			preg_match('/办('.$middle.')*証|辬('.$middle.')*証|办('.$middle.')*证|办('.$middle.')*證|辬('.$middle.')*证|辬('.$middle.')*證|辦('.$middle.')*証|辦('.$middle.')*证|辦('.$middle.')*證/isU', $str);//辦
	}
	
	/**
	 * 转义
	 *
	 * @param str $text
	 * @return str
	 */
	public function mhtmlentities($text) {
		$text = htmlentities($text, ENT_QUOTES, 'UTF-8');
		return $text;
	}


	//unicode 码转换为utf-8编码
	public function  wapdecoder($str) {
		$str = rawurldecode($str);
		preg_match_all("/(?:%u.{4})|.{4};|&#\d+;|.+/U",$str,$r);
		$ar = $r[0];
		
		foreach($ar as $k=>$v) {
			if(substr($v,0,2) == "%u") {
				$ar[$k] = iconv("UCS-2","UTF-8",pack("H4",substr($v,-4)));
			} elseif(substr($v,0,3) == "") {
				$ar[$k] = iconv("UCS-2","UTF-8",pack("H4",substr($v,3,-1)));
			} elseif(substr($v,0,2) == "&#") {
				$ar[$k] = mb_convert_encoding(pack("n",substr($v,2,-1)), "UTF-8","UCS-2");
			}
		}
		return join("",$ar);
	}

	/**
	 * 显示错误信息
	 *
	 * @param string $string
	 * @param array  $error
	 * @param bool   $htmlentities
	 *
	 * @return mixed|string
	 */
	public static function displayError($string = 'Fatal error', $error = array(), $htmlentities = true) {
		if (DEBUG_MODE){
			if (!is_array($error) || empty($error))
				return str_replace('"', '&quot;', $string) . ('<pre>' . print_r(debug_backtrace(), true) . '</pre>');
			$key = md5(str_replace('\'', '\\\'', $string));
			$str = (isset($error) AND is_array($error) AND key_exists($key, $error)) ? ($htmlentities ? htmlentities($error[$key], ENT_COMPAT, 'UTF-8') : $error[$key]) : $string;

			return str_replace('"', '&quot;', stripslashes($str));
		}else{
			return str_replace('"', '&quot;', $string);
		}
	}
    
    /**
	 * 判断是否手机访问
	 * @return bool
	 */	
	public static function is_mobile_request() {
		$_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
	 
		$mobile_browser = '0';
	 
		if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
			$mobile_browser++;
	 
		if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))
			$mobile_browser++;
	 
		if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
			$mobile_browser++;
	 
		if(isset($_SERVER['HTTP_PROFILE']))
			$mobile_browser++;
	 
		$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
		$mobile_agents = array(
							'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
							'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
							'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
							'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
							'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
							'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
							'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
							'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
							'wapr','webc','winw','winw','xda','xda-'
							);
	 
		if(in_array($mobile_ua, $mobile_agents))
			$mobile_browser++;
	 
		if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
			$mobile_browser++;
	 
		// Pre-final check to reset everything if the user is on Windows
		if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
			$mobile_browser=0;
	 
		// But WP7 is also Windows, with a slightly different characteristic
		if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
			$mobile_browser++;
	 
		if($mobile_browser>0)
			return true;
		else
			return false;
	}
    
    /**
	 * 判断是否微信访问
	 * @return bool
	 */	
    public static function is_weixin_request() {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
            return true;
        } 
        return false;
    }
    
    /**
	 * 对象转换成 json 格式
	 */	
	public static function json_encode($obj) {
		return json_encode($obj,JSON_UNESCAPED_UNICODE);
	}
    
	/**
	 * json 转换成对象
	 */	
	public static function json_decode($obj) {
		return json_decode($obj,true);

	}
    
    
    /**
     * 新浪短网址
     */
    public static function getSinaShortUrl($longurl) {
        $appkey = '2287459279'; //活动易的新浪key
		$url="http://api.weibo.com/2/short_url/shorten.json?source=".$appkey."&url_long=".urlencode($longurl);

        $ch = curl_init();
        $timeout = 1;
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);

        $file_contents = json_decode($file_contents,true);
        $tinyurl =  $file_contents['urls'][0]['url_short'];
        return $tinyurl;
		
    }
    
    /**
     * 百度短网址
     */
    public static function getBaiduShortUrl($longUrl) { 

		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,"http://dwz.cn/create.php");
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$data=array('url'=>$longUrl);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		$strRes=curl_exec($ch);
		curl_close($ch);
		$arrResponse=json_decode($strRes,true);
		if($arrResponse['status']==0){
            echo iconv('UTF-8','GBK',$arrResponse['err_msg'])."\n";
		}
		return $arrResponse['tinyurl']."\n";
		exit;
	}
    
    /**
     * 在数据列表中搜索
     * @access public
     * @param array $list 数据列表
     * @param mixed $condition 查询条件
     * 支持 array('name'=>$value) 或者 name=$value
     * @return array
     */
    public static function list_search($list,$condition) {
        if(is_string($condition))
            parse_str($condition,$condition);
        // 返回的结果集合
        $resultSet = array();
        foreach ($list as $key=>$data){
            $find   =   false;
            foreach ($condition as $field=>$value){
                if(isset($data[$field])) {
                    if(0 === strpos($value,'/')) {
                        $find   =   preg_match($value,$data[$field]);
                    }elseif($data[$field]==$value){
                        $find = true;
                    }
                }
            }
            if($find)
                $resultSet[]     =   &$list[$key];
        }
        return $resultSet;
    }
    
    /**
     * 对查询结果集进行排序
     * @access public
     * @param array $list 查询结果
     * @param string $field 排序的字段名
     * @param array $sortby 排序类型
     * asc正向排序 desc逆向排序 nat自然排序
     * @return array
     */
    // public static function list_sort_by($list,$field, $sortby='asc') {
    //    if(is_array($list)){
    //        $refer = $resultSet = array();
    //        foreach ($list as $i => $data)
    //            $refer[$i] = &$data[$field];
    //        switch ($sortby) {
    //            case 'asc': // 正向排序
    //                 asort($refer);
    //                 break;
    //            case 'desc':// 逆向排序
    //                 arsort($refer);
    //                 break;
    //            case 'nat': // 自然排序
    //                 natcasesort($refer);
    //                 break;
    //        }
    //        foreach ( $refer as $key=> $val)
    //            $resultSet[] = &$list[$key];
    //        return $resultSet;
    //    }
    //    return false;
    // }
    public static function list_sort_by($list,$field, $sortby='asc', $remain_key = true) {
       if(is_array($list)){
           $refer = $resultSet = array();
           foreach ($list as $i => $data)
               $refer[$i] = &$data[$field];
           switch ($sortby) {
               case 'asc': // 正向排序
                    asort($refer);
                    break;
               case 'desc':// 逆向排序
                    arsort($refer);
                    break;
               case 'nat': // 自然排序
                    natcasesort($refer);
                    break;
           }
           foreach ( $refer as $key=> $val) {
           		if ($remain_key)
           			$resultSet[$key] = &$list[$key];
           		else
           			$resultSet[] = &$list[$key];
           }
           return $resultSet;
       }
       return [];
    }
    
    /**
     * 把返回的数据集转换成Tree
     * @access public
     * @param array $list 要转换的数据集
     * @param string $pid parent标记字段
     * @param string $level level标记字段
     * @return array
     */
    public static function list_to_tree($list, $pk='id',$pid = 'pid',$child = '_child',$root=0) {
        // 创建Tree
        $tree = array();
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }


	/**
	 * [将多维数组合并为一位数组]	
	 *
	 * @method array_multiToSingle
	 *
	 * @param  [type]              $array         [需要合并的数组]
	 * @param  boolean             $clearRepeated [是否清除并后的数组中得重复值]
	 *
	 * @return [type]              [description]
	 */
	public static function array_multiToSingle($array,$clearRepeated=false)
	{
		if(!isset($array)||!is_array($array)||empty($array)){
			return false;
		}
		if(!in_array($clearRepeated,array('true','false',''))){
			return false;
		}
		static $result_array=array();
		foreach($array as $value){
			if(is_array($value)){
				Tools::array_multiToSingle($value);
			}else{
				$result_array[]=$value;
			}
		}
		if($clearRepeated){
			$result_array=array_unique($result_array);
		}
		return $result_array;
	}

	/**
	 * 开启静态文件合并:
	 *	1. nginx配置文件修改
	 *	2. 将css中内联的拿出来放到静态文件配置中
     *	3. 在入口文件中关闭debug模式 define('DEBUG_MODE',false);
	 */
	
    //静态资源url
    public static function asset_static($path){
		return ESTATICS.ltrim($path,'/');
	}

	/**
     * 样式别名加载（支持批量加载，后期可拓展为自动多文件压缩合并）
     * @return string
     * @modify jingwentian 新增了数组的传入方式 style(['a.css','b.css'])
     */
    public static function style()
    {
    	$tag = STATIC_VERSION;
    	if ( true ) {
    		
			$cssTag = "?v=".$tag;

			$res = func_get_args();
			if (count($res) != count($res, 1)) {
				$res = $res[0];//如果不是一维数组转成一维
			}

			$styleArray = array_map(function ($aliases)use($cssTag) {
				$cssUrl = self::asset_static($aliases);
			    return '<link href="'.$cssUrl.$cssTag.'" rel="stylesheet" onerror="_cdnFallback(this)" />';
			}, $res);
			return implode('', array_filter($styleArray));

    	} else {

	    	$cssTag = "&version=".$tag;

	    	$res = func_get_args();
	    	if (count($res) != count($res, 1)) {
	    		$res = $res[0];
	    	}
	        
	        $min_static_url = ESTATICS . 'min/?f=';
	        $styleString = implode(',', $res);
	        return '<link href="' . $min_static_url . $styleString . $cssTag.'" rel="stylesheet" onerror="_cdnFallback(this)" />';
    	}

    }

    /**
     * 脚本别名加载（支持批量加载，后期可拓展为自动多文件压缩合并）
     * @return string
     * @modify jingwentian 新增了数组的传入方式 script(['a.js','b.js'])
     */
    public static function script()
    {
    	$tag = STATIC_VERSION;

    	if ( true ) {

			$jsTag = "?v=".$tag;

			$res = func_get_args();
			if (count($res) != count($res, 1)) {
				$res = $res[0];
			}

			$styleArray = array_map(function ($aliases)use($jsTag) {
				$jsUrl = self::asset_static($aliases);
			    return '<script src="'.$jsUrl.$jsTag.'" onerror="_cdnFallback(this)"></script>';
			}, $res);
			return implode('', array_filter($styleArray));

		} else {
		
	    	$jsTag = "&version=".$tag;

	    	$res = func_get_args();
	    	if (count($res) != count($res, 1)) {
	    		$res = $res[0];
	    	}
	        
	        $min_static_url = ESTATICS . 'min/?f=';
	        $scriptString = implode(',', $res);
	        return '<script src="' . $min_static_url . $scriptString . $jsTag.'" onerror="_cdnFallback(this)"></script>';
	    }

    }

    public static function json($response)
    {
    	header('Content-type: application/json; charset=utf-8');	
		//printf(json_encode($response));
		echo json_encode($response);
    }



    /**
     * 对富文本编辑器添加的信息的二次处理方法
     *
     * @param [type] $content [HTML内容]
     * @param array  $options [配置] ex: $options = [
     *                        				'lazyload', //对图片进行lazyload处理,需要配合lazyload前端插件
     * 									];
     */
    public static function set_content_rich( $content, $options = ['text', 'lazyload', 'video'] )
    {
    	// 处理内容
    	if (in_array('text', $options)) {
    		$content = preg_replace("/<p[^>]*>[\s|&nbsp;]*<\/p>/", '', $content);
    	}

    	// 配置图片懒加载模式
    	if (in_array('lazyload', $options)) {
    		//$preg = '/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i'; //匹配图片正则
    		$preg = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i';
    		if (preg_match($preg, $content)) {
    			//$replaced = "<img class=\"lazy\"\$1data-original=\"\$2\"\$3>\n<noscript>\$0</noscript>";//替换成懒加载的模式,并且加上兼容
    			$replaced = "<img class=\"lazy\" data-original=\"\$2\">";
				$content = preg_replace($preg, $replaced, $content);
    		}
    	}

    	if (in_array('video', $options)) {
    		// 正则替换
            /**
             * 各大网站的视频地址格式经常变，能识别一些，不能识别了再改
             */
            //优酷
            if(strpos($content, 'player.youku.com')){
                //截取出sid
                $videoIdReg = "/sid[^.]+/";
                preg_match($videoIdReg, $content, $vidowMatches);
                $videoIdString = $vidowMatches[0];
                $videoIdString = mb_substr($videoIdString, 4);
                $videoIdString = mb_substr($videoIdString, 0, -2);
                $youkuUrl = '<iframe height=280 width=420 src="http://player.youku.com/embed/'.$videoIdString.'" frameborder=0 allowfullscreen></iframe>';
                //替换embed内容为iframe
                $videoReg = "/<\s*(embed)[^>]*\/?>\s*(?:<\s*\/\s*\1\s*>)?/i";
                $content = preg_replace($videoReg, $youkuUrl, $content);
            //土豆
            }
            if (strpos($content, 'www.tudou.com')){
                //正则取出src

                //可用正则 操蛋的正则，我日
                //$videoIdReg = "/<\s*(embed)[^\>]*((src)\s*\=\s*['|\"]\s*([^\s]+)\s*['|\"])[^\>]*\/?\>\s*(?:\<\s*\/\s*embed\s*\>)?/i";
                //$videoIdReg = '/<\s*embed\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i';
                $videoIdReg = '/<\s*(embed)[^>]*((src)\s*\=\s*([\'|"])\s*([^\s]+)\s*\4)[^>]*\/?>\s*(?:<\s*\/\s*\1\s*>)?/i';

                /* 此正则不可用，有时间了再看鸟原因吧
                $videoIdReg = "/<\s*(embed)[^>]*((src)\s*\=\s*(['|\"])\s*([^\s]+)\s*\4)[^>]*\/?>\s*(?:<\s*\/\s*\1\s*>)?/i";
                */

                preg_match($videoIdReg, $content, $vidowMatches);
                $tudouUrlArray = explode('/', $vidowMatches[5]);

                $tudouUrl = '<iframe src="http://www.tudou.com/programs/view/html5embed.action?type=0&code='.$tudouUrlArray[4].'&lcode=&resourceId=0_06_05_99" allowtransparency="true" allowfullscreen="true" allowfullscreenInteractive="true" scrolling="no" border="0" frameborder="0" style="width:480px;height:400px;"></iframe>';
                //替换embed内容为iframe
                $videoReg = "/<\s*(embed)[^>]*\/?>\s*(?:<\s*\/\s*\1\s*>)?/i";
                $content = preg_replace($videoReg, $tudouUrl, $content);
            }
            if (strpos($content, 'static.video.qq.com')){
                //获取src
                $videoIdReg = '/<\s*(embed)[^>]*((src)\s*\=\s*([\'|"])\s*([^\s]+)\s*\4)[^>]*\/?>\s*(?:<\s*\/\s*\1\s*>)?/i';
                preg_match($videoIdReg, $content, $vidowMatches);
                $urlAttr = parse_url($vidowMatches[5]);
                $urlAttrArray = self::_convertUrlQuery($urlAttr['query']);
                $qqUrl = '<iframe frameborder="0" width="420" height="280" src="http://v.qq.com/iframe/player.html?vid='.$urlAttrArray['vid'].'&tiny=0&auto=0" allowfullscreen></iframe>';
                //替换embed内容为iframe
                $videoReg = "/<\s*(embed)[^>]*\/?>\s*(?:<\s*\/\s*\1\s*>)?/i";
                $content = preg_replace($videoReg, $qqUrl, $content);
            }
    	}

    	return $content;

    }

    /**
     * 将字符串参数变为数组
     * @param $query
     * @return array array (size=10)
            'm' => string 'content' (length=7)
            'c' => string 'index' (length=5)
            'a' => string 'lists' (length=5)
            'catid' => string '6' (length=1)
            'area' => string '0' (length=1)
            'author' => string '0' (length=1)
            'h' => string '0' (length=1)
            'region' => string '0' (length=1)
            's' => string '1' (length=1)
            'page' => string '1' (length=1)
     */
    public static function _convertUrlQuery($query)
    {
        $queryParts = explode('&', $query);
        $params = array();
        foreach ($queryParts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }
        return $params;
    }

    /**
     * 可逆的数据加密方法[用于数据库信息加密]
     *
     * @method dataEncrypt
     *
     * @param  [type]      $str [加密字符串]
     *
     * @return [type]      [description]
     */
    public static function dataEncrypt( $str )
    {
        $Mcrypt = new Mcrypt();
        $encrypt_str = $Mcrypt->encrypt($str);
        return base64_encode($encrypt_str);
    }

    /**
     * 可逆的数据解密方法[用于数据库信息解密]
     *
     * @method dataDecrypt
     *
     * @param  [type]      $str [解密字符串]
     *
     * @return [type]      [description]
     */
    public static function dataDecrypt( $str )
    {
        $Mcrypt = new Mcrypt();
        $str = base64_decode($str);
        $decrypt_str = $Mcrypt->decrypt($str);
        return $decrypt_str;
    }

}

?>
