<?php
/**
 * Created by IntelliJ IDEA.
 * User: yamei
 * Date: 2018/9/8
 * Time: 19:05
 */

class Tools
{
    public static function createCdk()
    {
        return strtoupper(substr(md5(uniqid()), 1, 10));
    }

    public static function getIP()
    {
        global $ip;
        if (getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else $ip = "Unknow";
        return $ip;
    }


    /**
     * 接口统一返回格式
     */
    static function apiret($code = 0, $data = null, $msg = '')
    {
        if (empty($data)) {
            $data = (object)[];
        }

        $ret = array('code' => $code, 'data' => $data, 'msg' => $msg);

        echo json_encode($ret);
        die();

    }

    static function cknull(Array $params, Array $field)
    {

        foreach ($field as $v) {
            if (empty($params[$v])) {
                self::apiret(-1, null, "参数{$v}不能为空");
            }
        }
    }

}