<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $data = $request->only('user_id', 'value', 'type', 'description');
            // dd($data);
            $validator = Validator::make($data, [
                'user_id' => 'required',
                'value' => 'required',
                'type' => 'required|string',
                'description' => 'required'
            ], [
                'value.required' => 'Valor é um campo obrigatório.',
                'type.required' => 'Tipo é um campo obrigatório.',
                'description.required' => 'Descrição é um campo obrigatório.',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            $transaction = new Transaction([
                'user_id' => $request->user_id,
                'value' => $request->value,
                'type' => $request->type,
                'description' => $request->description,
            ]);

            if (!$transaction->save()) {
                throw new \Exception("Transação não foi carastrado. Tente novamente!");
            }

            return response()->json([
                'error' => false,
                'response' => [
                    'message' => 'Transação cadastrado com sucesso!',
                    'transactions' => $transaction
                ]
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
    }

    public function showByUserId(int $user_id)
    {
        return response()->json([
            'error' => false,
            'response' => [
                'transactions' => Transaction::whereUserId($user_id)->get()
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    public function destroy($id)
    {
        try {
            if ($id) {
                $delete = Transaction::whereId($id)->delete();  
                if ($delete) {
                    return response()->json([
                        'error' => false,
                        'response' => [
                            'message' => 'Transação deletada com sucesso!'
                        ]
                    ]);
                }
            }
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }
}
