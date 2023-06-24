<?php
namespace Techwasi\Encipher;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Builder;

class EncipherQueryBuilder extends Builder {

    private $model;

    /**
     * EncipherQueryBuilder constructor.
     * @param ConnectionInterface $connection
     * @param Encipher $model
     */
    public function __construct(ConnectionInterface $connection, $model)
    {
        parent::__construct($connection, $connection->getQueryGrammar(), $connection->getPostProcessor());
        $this->model = $model;
    }

    /**
     * @param array|\Closure|string $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     * @return Builder
     * @throws \Exception
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        if (method_exists($this->model, 'encipher') && $this->model->encipher($column)) {
            list($value, $operator) = $this->prepareValueAndOperator($value, $operator, func_num_args() === 2);
            $value = $this->model->encryptAttribute($value);
        }

        return parent::where($column, $operator, $value, $boolean);

    }
}