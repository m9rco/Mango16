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
                'sporte/b/desktop/css/base.css',
                'sporte/b/desktop/css/match/style.css',
                'libs/icon/iconfont.css',               
                ],
                'script' => [
                     'libs/js/jquery.min.js',
                     'sporte/b/desktop/js/base.js',
                     'sporte/component/utils.js',
                ]
            ];

        $options = [];
        switch ($page) {
    // ==================================================================
    // 公司信息 && 设置
    // ------------------------------------------------------------------    

            case 'account.account.company':
                $options = [
                    'title' => '息',
                    'keywords' => '',
                    'description' => '',
                    'style' => [
                     'sporte/b/desktop/css/account/b-account-company.css',
                    ],
                    'script' => [
                        'sporte/b/desktop/js/manage/account/b-account-company.js',
                        'libs/webuploader/webuploader.nolog.min.js',
                    ]
                ];
                break;
        }

        return  array_merge_recursive($common, $options);

    }
}
