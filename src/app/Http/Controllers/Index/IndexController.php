<?php

namespace App\Http\Controllers\Index;

use App\Application\EventList\EventListApplication;
use App\Http\Controllers\Controller;
use View;

class IndexController extends Controller
{

    private $eventListApplication;

    /** コンストラクタ */
    public function __construct(EventListApplication $eventListApplication)
    {
        $this->eventListApplication = $eventListApplication;
    }

    public function index()
    {
        $eventSummaryList = $this->eventListApplication->listRecent();
        return View::make('contents.index', array('eventSummaryList' => $eventSummaryList));
    }

}
