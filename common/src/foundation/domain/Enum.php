<?php namespace common\src\foundation\domain;

use common\src\foundation\domain\exceptions\EnumNotExists;
use common\src\foundation\support\interfaces\Printable;
use common\src\foundation\support\interfaces\Validatable;
use common\src\foundation\support\traits\Validating;

abstract class Enum extends ValueObject implements Printable, Validatable
{
    use Validating;

    /**
     * Define property name of enum value.
     * Override it.
     *
     * @var string
     */
    protected $enum = '';

    /**
     * Define acceptable enum values (keys) and their full meanings (values).
     * Override it.
     *
     * @var array
     */
    protected static $enums = [];

    /**
     * Create a enum value object by enum value or its code.
     *
     * @param string|int $enum
     * @param bool $throws Whether throws an EnumNotExists exception.
     *
     * @throws \common\src\foundation\domain\exceptions\EnumNotExists
     */
    public function __construct($enum, $throws = true)
    {
        if (array_key_exists($enum, static::$enums)) {
            $this->{$this->enum} = $enum;
        } elseif ($throws) {
            throw new EnumNotExists;
        }
    }

    /**
     * Get the enum value.
     *
     * @return int|string
     */
    public function getEnum()
    {
        return $this->{$this->enum};
    }

    /**
     * Validate this object (either entity or value object).
     *
     * @return \common\src\foundation\support\Validation
     */
    public function validate()
    {
        if (isset($this->{$this->enum})) {
            return $this->getValidation();
        } else {
            return $this->getValidation()->fail($this->enum, '不存在');
        }
    }

    /**
     * Print or echo the enum value.
     *
     * @return string
     */
    public function __toString()
    {
        return (string)static::$enums[$this->{$this->enum}];
    }

    /**
     * Get all acceptable enum values (keys) and their full meanings (values).
     *
     * @return array
     */
    public static function acceptableEnums()
    {
        return static::$enums;
    }

}