<?php declare(strict_types=1);

namespace FORM\Core;

class Di
{
    /** 
     * @var array
     */
    private array $container =  array();

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set(string $key, $value) : Di
    {
        $this->container[$key] = $value;

        return $this;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->has($key);
    }

    /**
     * @param $key
     * @return bool
     */
    public function has(string $key)
    {
        return isset($this->container[$key]) ? $this->container[$key] : null;
    }
}
?>