<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabTest;
use Throwable;

class TestController extends Controller
{
    
    public function __construct()
    {
        $this->test = new LabTest();
    }

    public function addView(){
        return view('admin-portal/test/add');
    }

    public function add(Request $request){

        try{
            $test_data = array(
                'test_title' => $request->post('test_title'),
                'test_code'=> $request->post('test_code'),
                'test_field'=> $request->post('test_field'),
                'amount'=> $request->post('amount')
            );
    
            $store = $this->test->store( $test_data);
    
            if ($store) {
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = 'Success';
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again!";
            }

        }catch(Throwable $e){
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }
        
        return $response;
    }

    public function view(){
        $all_test =  $this->test->getTestingList();
        return view('admin-portal/test/view',['all_test'=>$all_test]);
    }

    public function editView(){
        $data =  $this->test->getById(request()->get('id'));
        return view('admin-portal/test/edit',['test_data'=>$data]);
    }


    public function update(Request $request){
        try{
            $test_data = array(
                'test_title' => $request->post('test_title'),
                'test_code'=> $request->post('test_code'),
                'test_field'=> $request->post('test_field'),
                'amount'=> $request->post('amount')
            );
    
            $store = $this->test->updateTest($test_data,$request->post('id'));
    
            if ($store) {
                $response[0]['response_code'] = 200;
                $response[0]['response_text'] = 'Success';
            } else {
                $response[0]['response_code'] = 400;
                $response[0]['response_text'] = "Something went wrong. Please try again!";
            }

        }catch(Throwable $e){
            $response[0]['response_code'] = 403;
            $response[0]['response_text'] = $e->getMessage();
        }
        
        return $response;
    }
}
