<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function wantsJson(Request $request) {
        return $request->has('json');
    }

    public function jsonSuccess() {
        return response()->json([
            "success" => "true"
        ]);
    }

    public function jsonProblem($problem) {
        return response()->json([
            "success" => "false",
            "problem" => $problem
        ]);
    }
}
