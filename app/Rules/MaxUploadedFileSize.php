<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxUploadedFileSize implements Rule
{

    const MAX_FILE_SIZE = 157286400; // Kb

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $totalSize = array_reduce($value, function ( $sum, $item ) {
            // each item is UploadedFile Object
            $sum += $item->getSize();
            return $sum;
        });

        return $totalSize <= self::MAX_FILE_SIZE;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Максимальный общий допустимый размер файлов 150Мб.';
    }
}
