<?php

namespace App\View\Components;

use App\Models\HostingPlan;
use Cache;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HostingPlanComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $hostingPlans =Cache::remember('active_hosting_plans', now()->addMinutes(30), function () {
            return HostingPlan::where('status', 'active')
                ->select(['name', 'is_featured', 'yearly_price', 'uuid', 'slug'])
                ->with('features')
                ->get();
        });


        return view('components.hosting-plan-component', ['hostingPlans' => $hostingPlans]);
    }
}
