<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    /** コンストラクタ */
    public function __construct()
    {
    }

    public function index()
    {
        return json_encode(['hello, world!']);
    }

}
