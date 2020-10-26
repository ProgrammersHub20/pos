<?php
namespace App\Traits;

trait ApiResponse{

    protected function success($message = null, $code = 200, $data = null)
	{
		return response()->json([
			'status'=> 'Success', 
			'message' => $message, 
			'data' => $data
		], $code);
    }
    

	protected function error($message = null, $code)
	{
		return response()->json([
			'status'=>'Error',
			'message' => $message,
			'data' => null
		], $code);
	}
}