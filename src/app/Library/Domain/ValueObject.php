<?php

namespace App\Library\Domain;

trait ValueObject
{

    use \App\Library\Fundamental\OneArgumentCompleteConstructor;

    /** @var mixed */
    private $value;

    /**
     * コンストラクタ
     *
     * ValueObjectでは設計の一貫性を持たせるため、属性名を"value"と固定している。
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->completeConstruct('value', $value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strval($this->value);
    }

}
