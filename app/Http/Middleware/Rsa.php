<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Rsa
{

    protected $except = [
        'api/*'
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $pdata = json_decode($request->getContent(), true);
        $pdata = $pdata['data'];
        if ($data = \Rsa::privDecrypt($pdata)) {
            $data = json_decode($data, true);
            \Tools::cknull($data, ['__access_time__']);

            $accessTime = $data['__access_time__'];

            if (time() - $accessTime > 3000) {
                \Tools::apiret(-1, null, '接口签名已过期');
            }

        } else {
            \Tools::apiret(-1, null, '接口签名不通过');
        }

        $request->pdata = $data;

        return $next($request);
    }
}
