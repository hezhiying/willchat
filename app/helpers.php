<?php

/**
 * helpers.php.
 *
 * 工具函数
 *
 * @author tianyong90 <412039588@qq.com>
 */

/**
 * 返回操作成功提示及跳转地址
 *
 * @param        $info
 * @param string $redirectUrl
 *
 * @return \Illuminate\Http\JsonResponse
 */
function success($info, $redirectUrl = '')
{
    return response()->json(['status' => 1, 'info' => $info, 'url' => $redirectUrl]);
}

/**
 * 返回操作失败提示及跳转地址
 *
 * @param        $info
 * @param string $redirectUrl
 *
 * @return \Illuminate\Http\JsonResponse
 */
function error($info, $redirectUrl = '')
{
    return response()->json(['status' => 0, 'info' => $info, 'url' => $redirectUrl]);
}

/**
 * 获取自定义菜单类型列表.
 *
 * @return array
 */
function getMenuTypes()
{
    $typeMap = [
        'click'              => '点击',
        'view'               => '页面跳转',
        'scancode_push'      => '扫码推事件',
        'scancode_waitmsg'   => '扫码待提示',
        'pic_sysphoto'       => '系统拍照发图',
        'pic_photo_or_album' => '拍照或相册发图',
        'pic_weixin'         => '微信相册发图',
        'location_select'    => '发送位置',
        'media_id'           => '图片',
        'view_limited'       => '图文消息',
    ];

    return $typeMap;
}
