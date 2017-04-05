<?php
namespace modules\Admin\controllers\Traits;
/**
 * 静态资源配置项
 * @author:Shaowei pu
 */
trait StaticConf
{
	public function options( $page )
  {
        //  公共部分
        $common = [
                'style' => [
                		'lib/dist/css/zui.min.css',
                ],
                'script' => [
										'lib/dist/lib/jquery/jquery.js',
                    'lib/dist/js/zui.min.js',
                ]
            ];
        $options = [];
        switch ($page) {
            case 'index.login':
                $options = [
                    'title' => 'Mango16 - login',
                    'keywords' => '',
                    'description' => '',
                    'style' => [
											'mango16/admin/css/login.css',
                    ],
                    'script' => [
                    ]
                ];
                break;
        }

        return  array_merge_recursive($common, $options);

    }
}
