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
                        'static/plugs/bootstrap/css/bootstrap.min.css',
                        'static/plugs/layui/css/layui.css',
                        'static/theme/default/css/console.css',
                        'static/theme/default/css/animate.css'
                ],
                'script' => [
                    'static/plugs/require/require.js',
                    'static/admin/app.js',
                ]
            ];
        $options = [];
        switch ($page) {
            case 'index.index':
                $options = [
                    'title' => 'Mango16 - login',
                    'keywords' => '',
                    'description' => '',
                    'style' => [
                        'static/theme/default/css/login.css',
                    ],
                    'script' => [
                    ]
                ];
                break;
        }

        return  array_merge_recursive($common, $options);

    }
}
