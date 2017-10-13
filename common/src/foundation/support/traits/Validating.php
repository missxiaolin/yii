<?php namespace common\src\foundation\support\traits;

use common\src\foundation\support\Validation;

trait Validating
{
    /**
     * Validation object to be used.
     *
     * @var \common\src\foundation\support\Validation
     */
    protected $validation;

    /**
     * Get the validation object.
     *
     * @return \common\src\foundation\support\Validation
     */
    protected function getValidation()
    {
        if (!isset($this->validation)) {
            $this->validation = new Validation();
        }

        return $this->validation;
    }

}