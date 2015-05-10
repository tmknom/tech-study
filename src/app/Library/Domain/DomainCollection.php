<?php

namespace App\Library\Domain;

use Illuminate\Support\Collection;

trait DomainCollection
{

    use \App\Library\Fundamental\OneArgumentCompleteConstructor;

    /** @var Collection */
    private $collection;

    public function __construct(array $itmes)
    {
        $this->completeConstruct('collection', Collection::make($itmes));
    }

    /**
     * index番目の要素を取得する
     *
     * @param int $index
     * @return mixed
     */
    public function get($index)
    {
        return $this->getCollection()->get($index);
    }

    /**
     * コレクションを配列要素として取得する
     *
     * Viewなどでforeachすることを想定。
     * Domain層やService層では呼ばないことを推奨。
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getCollection()->toArray();
    }

    /**
     * 要素数を取得する
     *
     * @return int
     */
    public function count()
    {
        return $this->getCollection()->count();
    }

    /**
     * @return Collection
     */
    private function getCollection()
    {
        return $this->collection;
    }

}
