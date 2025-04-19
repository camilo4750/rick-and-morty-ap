<?php

namespace App\Http\Controllers\Wrappers;


use App\Exceptions\AlertException;
use Illuminate\Validation\ValidationException;
use App\Exceptions\ApplicationLogicException;
use App\Exceptions\BusinessLogicException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class ControllerWrapper
{
    public static function execWithJsonSuccessResponse($callback, $fallback = null)
    {
        try {
            DB::beginTransaction();
            $response = $callback();
            $response = array_merge([
                'success' => true,
                'message' => ''
            ], $response);

            DB::commit();
        } catch (ValidationException $exception) {
            DB::rollBack();
            report($exception);
            $errors = [];
            foreach ($exception->errors() as $field => $error) {
                $errors[$field] = join(',', $error) . " ";
            }
            $response = response()->json([
                'success' => false,
                'code' => 422,
                'message' => 'Error al validar los datos',
                'errors' => $errors
            ], 422);
        } catch (ApplicationLogicException | BusinessLogicException $exception) {
            DB::rollBack();
            report($exception);
            $response = response()->json([
                'success' => false,
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'errors' => $exception->getErrors()
            ], $exception->getCode());
        }
        return $response;
    }
}
