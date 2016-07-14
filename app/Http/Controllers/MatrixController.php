<?php

namespace CubeSummation\Http\Controllers;

use Illuminate\Http\Request;

use CubeSummation\Http\Requests;
use CubeSummation\Support\Operator;

class MatrixController extends Controller
{
    public function resolve(Request $request)
    {
        $commands = $request->get('commands', null);

        if ($commands) {
            $operator = new Operator($commands);

            $results = $operator->process();

            return response()->json([
                'data' => $results,
                'message' => 'Se ha realizado las operaciones',
                'success' => true
            ]);
        }

        return response()->json([
            'message' => 'Debe enviar los comandos',
            'success' => false
        ], 400);
    }
}
