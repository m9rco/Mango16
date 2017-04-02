<?php
namespace modules\Home\controllers\Traits;
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
									'mango16/home/css/style.css',
                ],
                'script' => [
									'lib/jquery/jquery.min.js',
									'lib/jquery/jquery.dropotron.js',
									'lib/skel/skel.min.js',
									'lib/skel/skel-panels.min.js',
								]
            ];

        $options = [];
        switch ($page) {
            case 'index.index':
                $options = [
                    'title' => 'Mango16',
                    'keywords' => '',
                    'description' => '',
                    'style' => [
											'mango16/home/css/astyle.css',
											'mango16/home/css/style-mobile.css',
											'mango16/home/css/style-narrower.css',
											'mango16/home/css/style-normal.css',
											'mango16/home/css/style-wide.css',
                    ],
                    'script' => [
											'mango16/home/js/init.js',
                    ]
                ];
                break;
        }

        return  array_merge_recursive($common, $options);

    }
}
