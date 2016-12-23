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
                    'title' => '体育易 - 公司信息',
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

    // ==================================================================
    // 操作日志 
    // ------------------------------------------------------------------  
    //                 
            case 'account.account.opratelog':
                $options = [
                    'title' => '体育易 - 操作日志',
                    'keywords' => '',
                    'description' => '',
                    'style' => [
                       'libs/jedate/skin/jedate.css'
                    ],
                    'script' => [
                        'sporte/b/desktop/js/manage/account/b-account-company.js',
                        'libs/jedate/jedate.min.js',
                        'sporte/b/desktop/js/manage/account/b-account-opratelog.js',
                    ]
                ];
                break;
    // ==================================================================
    // 子账号
    // ------------------------------------------------------------------
            case 'account.children.make':
                $options = [
                    'title' => '体育易 - 子账号创建',
                    'keywords' => '',
                    'description' => '',
                    'style' => [
                    ],
                    'script' => [
                      'sporte/b/desktop/js/manage/account/b-account-common.js',
                    ]
                ];
                break;
            case 'account.children.edit':
                $options = [
                    'title' => '体育易 - 子账号编辑',
                    'keywords' => '',
                    'description' => '',
                    'style' => [
                    ],
                    'script' => [
                      'sporte/b/desktop/js/manage/account/b-account-common.js',
                    ]
                ];
                break;
            case 'account.children.list':
                $options = [
                    'title' => '体育易 - 子账号列表',
                    'keywords' => '',
                    'description' => '',
                    'style' => [
                    ],
                    'script' => [
                      'sporte/b/desktop/js/manage/account/b-account-childList.js',
                    ]
                ];
                break;

    // ==================================================================
    // 角色权限设置
    // ------------------------------------------------------------------
             case 'account.children.rolesetting':
                $options = [
                    'title' => '体育易 - 子账号管理',
                    'keywords' => '',
                    'description' => '',
                    'style' => [
                       'sporte/b/desktop/css/account/b-account-children.css',
                    ],
                    'script' => [
                       'sporte/b/desktop/js/manage/account/b-account-common.js',
                       'sporte/b/desktop/js/manage/account/b-account-roleseting.js',
                    ]
                ];
                break;
        }

        return  array_merge_recursive($common, $options);

    }
}
