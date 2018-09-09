<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CdkController extends Controller
{
    public function makecdk($num = 1)
    {

        for ($i = 0; $i < $num; $i++) {

            $cdk = \Tools::createCdk();

            DB::insert('insert into com_cdkey (cdkey,add_time) values (?, ?)', [$cdk, time()]);
            echo $i + 1;
        }

    }

    public function authcdk(Request $request)
    {

        \Tools::cknull($request->pdata, ['cdk']);


        $cdk = $request->pdata['cdk'];
        $ret = DB::select('select * from com_cdkey where cdkey=? limit 1', [$cdk]);
        if (!empty($ret)) {

            if ($ret[0]->status !== 0) {
                \Tools::apiret(-1, null, '激活码已失效');
            }
            $ip = \Tools::getIP();
            DB::update('update com_cdkey set status=1,use_ip=?,use_time=? where id=?', [$ip, time(), $ret[0]->id]);

            \Tools::apiret(0, null, '激活成功');

        } else {
            \Tools::apiret(-1, null, '激活码不正确');
        }

    }


}
