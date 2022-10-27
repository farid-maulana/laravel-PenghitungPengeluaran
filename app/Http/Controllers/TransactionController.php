<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransactionProduct;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderByDesc('id')->get();
        return view('index', compact('transactions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'shipping_cost' => $request->shipping_cost,
            'total' => 0,
        ]);

        $discount = Discount::create([
            'transaction_id' => $transaction->id,
            'discount' => $request->discount / 100,
            'maximum_discount' => $request->maximum_discount,
            'minimum_transaction' => $request->minimum_transaction,
        ]);
        $total = 0;
        $count = count($request->name);

        foreach ($request->name as $index => $name)
        {
            $subtotal = 0;
            $expanse = 0;
            $detail = TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'name' => $name,
                'expanse' => 0,
            ]);
            
            for ($i = 0; $i < count($request->product[$index]['product_name']); $i++)
            {
                $productDetail = TransactionProduct::create([
                    'transaction_detail_id' => $detail->id,
                    'product_name' => $request->product[$index]['product_name'][$i],
                    'price' => $request->product[$index]['price'][$i],
                    'qty' => $request->product[$index]['qty'][$i],
                    'subtotal' => $request->product[$index]['price'][$i] * $request->product[$index]['qty'][$i],
                ]);

                $subtotal += $productDetail->subtotal;
            }

            $expanse = $subtotal - ($discount->discount * $subtotal) + ($transaction->shipping_cost / $count);

            $detail->update([
                'expanse' => $expanse,
            ]);

            $total += $expanse;

            $transaction->update([
                'total' => $total,
            ]);
        }

        return redirect()->back();
    }
}
