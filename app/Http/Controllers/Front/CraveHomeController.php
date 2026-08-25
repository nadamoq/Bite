<?php

namespace App\Http\Controllers\Front;

use App\Actions\Menu\GetCraveShowcaseAction;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class CraveHomeController extends Controller
{
    /**
     * Display the dynamic Crave landing page.
     */
    public function index(GetCraveShowcaseAction $showcaseAction): View
    {
        $showcaseData = $showcaseAction->execute();

        return view('food.crave', [
            'featuredDish' => $showcaseData['featuredDish'],
            'showcaseDishes' => $showcaseData['showcaseDishes'],
        ]);
    }
}
