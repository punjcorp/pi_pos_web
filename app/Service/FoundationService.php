<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/17/2019
 * Time: 11:36 AM
 */

namespace App\Service;

use App\Department;

class FoundationService implements FoundationServiceInterface
{

    public function getDepartments()
    {
        return Department::where('level_code','=','dept')->orderBy('sort_order', 'ASC')->get();
    }

}