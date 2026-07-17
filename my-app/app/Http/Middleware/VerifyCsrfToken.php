<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        'posts/create/normalsql', // このルートをCSRF保護の対象外にする
        'posts/update/normalsql', // このルートをCSRF保護の対象外にする
        'posts/delete/normalsql', // このルートをCSRF保護の対象外にする
        'posts/bulkcreate/transaction', // このルートをCSRF保護の対象外にする
        'posts/create/querybuilder', // このルートをCSRF保護の対象外にする
        'posts/show/querybuilder', // このルートをCSRF保護の対象外にする
        'posts/update/querybuilder', // このルートをCSRF保護の対象外にする
        'posts/delete/querybuilder', // このルートをCSRF保護の対象外にする
        'posts/filter/querybuilder', // このルートをCSRF保護の対象外にする
        'posts/count/querybuilder', // このルートをCSRF保護の対象外にする
        'posts/join/querybuilder', // このルートをCSRF保護の対象外にする
        'posts/subquery/querybuilder', // このルートをCSRF保護の対象外にする
        'posts/eloquent', // このルートをCSRF保護の対象外にする
        'posts/eloquent/find/*', // このルートをCSRF保護の対象外にする
        'posts/eloquent/create', // このルートをCSRF保護の対象外にする
        'posts/eloquent/update', // このルートをCSRF保護の対象外にする
        'posts/eloquent/delete/*', // このルートをCSRF保護の対象外にする
        'posts/eloquent/findbyid/*', // このルートをCSRF保護の対象外にする
        'posts/show/eloquent/*', // このルートをCSRF保護の対象外にする
        'posts/eloquent/onlytrashed', // このルートをCSRF保護の対象外にする
        'posts/redirect', // このルートをCSRF保護の対象外にする
    ];
}
