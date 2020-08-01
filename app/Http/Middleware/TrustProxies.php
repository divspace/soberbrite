<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

final class TrustProxies extends Middleware
{
    /**
     * @var array|string|null
     */
    protected $proxies;

    /**
     * @var int|string|null
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
