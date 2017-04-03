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
									'lib/bootstrap/css/bootstrap.min.css',
                ],
                'script' => [
									'lib/jquery/jquery.min.js',
								]
            ];

        $options = [];
        switch ($page) {
            case 'index.index':
                $options = [
                    'title' => 'Mango16 - 致敬勤奋好学的你',
                    'keywords' => '',
                    'description' => '',
                    'style' => [
											'mango16/home/css/font-awesome.min.css',
											'mango16/home/css/simple-line-icons.css',
											'mango16/home/css/animate.css',
											'mango16/home/css/style.css',
                    ],
                    'script' => [
											'mango16/home/js/modernizr.custom.js',
											'lib/bootstrap/js/bootstrap.min.js',
											'lib/jquery/jquery.parallax-1.1.3.js',
											'mango16/home/js/imagesloaded.pkgd.js',
											'lib/jquery/jquery.sticky.js',
											'mango16/home/js/smoothscroll.js',
											'mango16/home/js/wow.min.js',
											'lib/jquery/jquery.easypiechart.js',
											'lib/jquery/waypoints.min.js',
											'lib/jquery/jquery.cbpQTRotator.js',
											'mango16/home/js/custom.js',
                    ]
                ];
                break;
        }

        return  array_merge_recursive($common, $options);

    }
}
