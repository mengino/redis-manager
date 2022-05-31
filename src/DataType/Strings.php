<?php
declare(strict_types=1);

namespace Encore\RedisManager\DataType;

use Illuminate\Support\Arr;

class Strings extends DataType
{
    /**
     * {@inheritdoc}
     */
    public function fetch(string $key)
    {
        return $this->getConnection()->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function update(array $params)
    {
        $this->store($params);
    }

    /**
     * {@inheritdoc}
     */
    public function store(array $params)
    {
        $key = Arr::get($params, 'key');
        $value = Arr::get($params, 'value');
        $seconds = Arr::get($params, 'seconds');

        $this->getConnection()->set($key, $value);

        if ($seconds > 0) {
            $this->getConnection()->expire($key, $seconds);
        }
    }
}
