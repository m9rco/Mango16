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
                'libs/icon/iconfont.css',
                ],
                'script' => [
                     'libs/js/jquery.min.js',
                ]
            ];
        $options = [];
        switch ($page) {
            case 'account.account.company':
                $options = [
                    'title' => '',
                    'keywords' => '',
                    'description' => '',
                    'style' => [
                    ],
                    'script' => [
                        'libs/webuploader/webuploader.nolog.min.js',
                    ]
                ];
                break;
        }

        return  array_merge_recursive($common, $options);

    }
}
