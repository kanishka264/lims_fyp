<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LabTest;

class HomePageController extends Controller
{
    public function __construct()
    {
        $this->labtest = new LabTest();
    }

    public function homePageView(){
        $lab_testing_list = $this->labtest->getTestingList();
        return view('index',['lab_testing_list'=>$lab_testing_list]);
    }
}
