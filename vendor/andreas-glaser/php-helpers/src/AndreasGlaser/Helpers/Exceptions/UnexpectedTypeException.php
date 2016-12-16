<?php

namespace AndreasGlaser\Helpers\Exceptions;

/**
 * Class UnexpectedTypeException
 *
 * @package AndreasGlaser\Helpers\Exceptions
 * @author  Andreas Glaser
 */
class UnexpectedTypeException extends \RuntimeException
{
    /**
     * UnexpectedTypeException constructor.
     *
     * @param string $value
     * @param int    $expectedType
     *
     * @author Andreas Glaser
     */
    public function __construct($value, $expectedType)
    {
        parent::__construct(sprintf('Expected argument of type "%s", "%s" given', $expectedType, is_object($value) ? get_class($value) : gettype($value)));
    }
}