<?php

declare(strict_types=1);

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiTestController extends Controller
{
    protected string $templatePath = 'admin.tests.api.';
}
