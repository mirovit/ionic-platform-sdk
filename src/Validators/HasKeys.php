<?php

namespace Mirovit\IonicPlatformSDK\Validators;

use Mirovit\IonicPlatformSDK\Contracts\Validatable;

class HasKeys implements Validatable
{
    private $shouldHave = [];
    private $has = [];

    /**
     * Simple validation multiple key existence in an array.
     *
     * @param array $shouldHave
     * @param array $has
     */
    public function __construct(array $shouldHave, array $has)
    {
        $this->shouldHave = $shouldHave;
        $this->has = $has;
    }

    public function validate()
    {
        $required = array_intersect_key(
            array_flip($this->shouldHave),
            $this->has
        );

        return count($required) > 0;
    }
}