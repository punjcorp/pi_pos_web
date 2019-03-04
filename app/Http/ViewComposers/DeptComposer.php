<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/19/2019
 * Time: 2:50 PM
 */
namespace App\Http\ViewComposers;

use App\Service\FoundationServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class DeptComposer
{

    public function __construct(FoundationServiceInterface $foundationService)
    {
        $this->foundationService = $foundationService;
    }

    public function compose(View $view)
    {
        $depts=$this->foundationService->getDepartments();
        Log::info('The departments were retrieved successfully');
        $view->with(array('depts'=>$depts));
    }
}