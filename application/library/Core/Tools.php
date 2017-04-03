<?php
namespace library\Core;
use YaConf;
/**
 * [style 核心小工具]
 * @return [type] [description]
 */
class Tools {

	private static $collect		=[];
	private static $validator	=[];

	/**
	 * [Collection 数组处理器]
	 * @param [type] $value [description]
	 */
	public static function Collection(array $receive )
	{
			return new \Illuminate\Support\Collection( $receive );
	}

	/**
	 * [Validator 验证器]
	 * @param [type] $receivee [description]
	 */
	public static function Validator(array $receivee )
	{
			return new \Illuminate\Validatio\Validator( $receive );
	}

		/**
		 * [style CSS]
		 * @return [type] [description]
		 */
    public static function style()
    {
			$res = func_get_args();
			if( count($res) != count($res, 1) ) $res = $res[0];

			$tag = '?v='.YaConf::get('MconfInit.global.vesion');
			$url = YaConf::get('MconfInit.global.estatics');
			$style = self::Collection( $res );
			return $style->filter()
									 ->unique()
									 ->map( function ( $aliases )use( $url ,$tag ) {
				return '<link href="'.$url.$aliases.$tag.'" rel="stylesheet" />';
			})->implode('');
    }

		 /**
		  * [script Js 加载]
		  * @return [type] [description]
		  */
    public static function script()
    {
			$res = func_get_args();
			if( count($res) != count($res, 1) ) $res = $res[0];

			$tag = '?v='.YaConf::get('MconfInit.global.vesion');
			$url = YaConf::get('MconfInit.global.estatics');
			$style = self::Collection( $res );
			return $style->filter()
									 ->unique()
									 ->map( function ( $aliases )use( $url ,$tag ) {
					return '<script src="'.$url.$aliases.$tag.'" ></script>';
			})->implode('');
    }

		/**
		 * [is_mobile_request 判断是否是手机]
		 * @return boolean [description]
		 */
		public static function is_mobile_request()
		{
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
}
