<?php

namespace Modules\Subscription\PageBuilder;

use App\PageBuilder;
use Modules\Subscription\PageBuilder\Addons\PricePlan;
use Modules\Subscription\PageBuilder\Addons\TestPlan;

class PageBuilderSetup extends PageBuilder\PageBuilderSetup
{
    public static function register_widgets(): array
    {
        return [
           PricePlan::class
        ];
    }
}