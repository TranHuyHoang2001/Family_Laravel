<?php


namespace App\Traits;


trait LoggerTrait
{
    /**
     * Log error
     *
     * @param \Exception $exception
     */
    public function logError(\Exception $exception): void
    {
        \Log::error(
            sprintf(
                "Error \n File: %s \n Line: %s \n Message: %s",
                $exception->getFile(),
                $exception->getLine(),
                $exception->getMessage()
            )
        );
    }
}
