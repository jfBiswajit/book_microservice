<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
  public function successResponse($data, $code = Response::HTTP_OK)
  {
    return response()->json([
      'success' => true,
      'data' => $data
    ], $code);
  }

  public function errorResponse($message, $code)
  {
    return response()->json([
      'success' => false,
      'error' => $message,
      'code' => $code
    ], $code);
  }
}
