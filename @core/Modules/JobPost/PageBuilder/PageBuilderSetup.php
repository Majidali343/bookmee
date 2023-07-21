<?php

namespace Modules\JobPost\PageBuilder;

use App\PageBuilder;
use Modules\JobPost\PageBuilder\Addons\Jobs;
use Modules\JobPost\PageBuilder\Addons\HomeJobs;

class PageBuilderSetup extends PageBuilder\PageBuilderSetup
{
    public static function register_widgets(): array
    {
        return [
            Jobs::class,
            HomeJobs::class,
        ];
    }
}