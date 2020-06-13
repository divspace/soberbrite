<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

final class TrustProxies extends Middleware
{
    /**
     * @var string|array|null
     */
    protected $proxies;

    /**
     * @var string|int|null
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
