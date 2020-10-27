<?php
namespace App\Traits;

trait ApiResponse{

	/**
	 * @param  data
	 * @param  message
	 * @param  code
	 * @return json
	 */
    protected function success($data = null, $message = null, $code = 200)
	{
		return response()->json([
			'status'=> 'Success', 
			'message' => $message, 
			'data' => $data
		], $code);
    }
    
    /**
     * @param  message
     * @param  code
     * @return json
     */
	protected function error($message = null, $code)
	{
		return response()->json([
			'status'=>'Error',
			'message' => $message,
			'data' => null
		], $code);
	}
}