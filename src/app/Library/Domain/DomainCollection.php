<?php

namespace App\Library\Domain;

use Illuminate\Support\Collection;

trait DomainCollection
{

    use \App\Library\Fundamental\OneArgumentCompleteConstructor;

    public function __construct(array $itmes)
    {
        $this->completeConstruct('value', Collection::make($itmes));
    }

    public function get($index)
    {
        return $this->value->get($index);
    }

    public function toArray()
    {
        return $this->value->toArray();
    }

    public function count()
    {
        return $this->value->count();
    }

}
