<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use HasFactory;

    public function getLastOrderId()
    {
        $results = DB::table('orders')
            ->orderBy('id', 'DESC')
            ->first();
        return $results;
    }

    public function saveOrder($data)
    {
        $results = DB::table('orders')->insertGetId($data);
        return $results;
    }

    public function saveTestOrder($data)
    {
        $results = DB::table('test_orders')->insertGetId($data);
        return $results;
    }

    public function updateTestOrder($data, $id)
    {
        $results = DB::table('test_orders')->where('id', $id)->update($data);
        return $results;
    }

    public function updateOrder($data, $id)
    {
        $results = DB::table('orders')->where('id', $id)->update($data);
        return $results;
    }

    public function savePayment($data)
    {
        $results = DB::table('payments')->insert($data);
        return $results;
    }

    public function updateOrders($data, $orderNo)
    {
        $results = DB::table('test_orders')->where('order_no', $orderNo)->update($data);
        return $results;
    }

    public function getTestOrdersByUserId($userId)
    {
        $results = DB::table('test_orders')
            ->select('test_orders.*', 'lab_test_type.test_title', 'lab_test_type.test_code', 'lab_test_type.report_template')
            ->join('lab_test_type', 'test_orders.test_id', '=', 'lab_test_type.id')
            ->where('test_orders.payment_status', '=', '1000')
            ->orderBy('test_orders.id', 'DESC')
            ->get();
        return $results;
    }

    public function getByFieldValue($field, $status)
    {
        $results = DB::table('test_orders')
            ->select('test_orders.*', 'lab_test_type.test_title', 'lab_test_type.test_code', 'lab_test_type.report_template')
            ->join('lab_test_type', 'test_orders.test_id', '=', 'lab_test_type.id')
            ->where('test_orders.payment_status', '=', '1000')
            ->where('test_orders.'.$field, '=', $status)
            ->orderBy('test_orders.id', 'DESC')
            ->get();
        return $results;
    }

    public function getTestOrdersById($id)
    {
        $results = DB::table('test_orders')
            ->select('test_orders.*', 'lab_test_type.test_title', 'lab_test_type.test_code', 'lab_test_type.report_template')
            ->join('lab_test_type', 'test_orders.test_id', '=', 'lab_test_type.id')
            ->where('test_orders.id', '=', $id)
            ->orderBy('test_orders.id', 'DESC')
            ->first();
        return $results;
    }

    public function updateOrdersById($data, $id)
    {
        $results = DB::table('test_orders')->where('id', $id)->update($data);
        return $results;
    }
}
