<?php 
namespace library\Base;
use Yaf\Session as YafSession;
ini_set('session.cookie_domain', '.sporte.cn');

/**
* Session 对Yaf\Session封装
* @author wlw <wangliwei@eventmosh.com>
* @date 2015.8.21 17:38(周五啊 快要下班了 啊哈哈)
*/
class Session 
{
	/**
	 * 	Yaf\Session
	 */
	private $yaf_session = null;
	

	/**
     *
     * Session key for the "next" flash values.
     *
     * @const string
     *
     */
	const FLASH_NEXT = 'library\Session\Session\Flash\Next';

    /**
     *
     * Session key for the "current" flash values.
     *
     * @const string
     *
     */
    const FLASH_NOW = 'library\Session\Session\Flash\Now';

	private static $session = null;


    public static function getInstance()
    {
/*    	if(is_null(self::$session)){
	    	self::$session = new Session();
    	}*/
    	if(self::$session instanceof self)
    	{
    		return self::$session;
    	}
    	self::$session =new self();
    	return self::$session;
    }

	private function __construct( )
	{
		if (session_status() === PHP_SESSION_ACTIVE) {
        	session_destroy();
        }
		
		$this->yaf_session = YafSession::getInstance();
		$this->yaf_session->start();

		$this->moveFlash();
	}

	/**
	 * 储存数据到 Session 中
	 * @param  [type] $key   [key]
	 * @param  [type] $value [value]
	 * @return boolean
	 */
	public function put($key,$value)
	{
		return $this->yaf_session->set($key,$value);
	}

	/**
	 * 从 Session 取回数据
	 * @param  [type] $key   [description]
	 * @param  string $value [description]
	 * @return mixed
	 */
	public function get($key,$default='')
	{
		$value = $this->yaf_session->get($key);

		return !empty($value) ? $value : $default; 
	}

	/**
	 * 从 Session 取出所有数据
	 * @return mixed
	 */
	public function all()
	{
		return $this->yaf_session->get();
	}

	/**
	 * 判断数据在 Session 中是否存在
	 * @param  [type]  $key [description]
	 * @return boolean      
	 */
	public function has($key)
	{
		return $this->yaf_session->has($key);
	}

	/**
	 * 移除 Session 中指定的数据
	 * @param  [type] $key [description]
	 * @return [boolean] 
	 */
	public function forget($key)
	{
		return $this->yaf_session->del($key);
	}


	/**
	 * 从 Session 取回数据，并删除
	 * @param  [type] $key     [description]
	 * @param  string $default [description]
	 * @return mixed
	 */
	public function pull($key,$default='')
	{
		$value = $this->get($key,$default);
		$this->forget($key);
		return $value;
	}

	/**
     *
     * Moves the "next" flash values to the "now" values, thereby clearing the
     * "next" values.
     * @return null
     */
	private function moveFlash()
    {
        if (! $this->has(self::FLASH_NEXT)) {
        	$this->put(self::FLASH_NEXT , []);
        }

        $this->put(self::FLASH_NOW , $this->get(self::FLASH_NEXT));

        $this->put(self::FLASH_NEXT , []);

    }

    /**
     * 设置快闪数据(只有下次请求request有效 第三次请求request无效)
     * @param [type] $key   [description]
     * @param [type] $value [description]
     * @return boolean
     */
	public function setFlash($key,$value)
	{
		$data = $this->get(self::FLASH_NEXT,[]);

		$data[$key] = $value;

		return $this->put(self::FLASH_NEXT , $data);

	}

	/**
	 * 获取快闪数据
	 * @param  [type] $key     [description]
	 * @param  string $default [description]
	 * @return mixed          [description]
	 */
	public function getFlash($key,$default='')
	{
		$data = $this->get(self::FLASH_NOW,[]);
		
		return isset($data[$key]) ? $data[$key] : $default; 

	}

}