<?php namespace common\src\foundation\support\interfaces;

interface Validatable
{
    /**
     * Validate this object (either entity or value object).
     *
     * @return \common\src\foundation\support\Validation
     */
    public function validate();

}