<?php

namespace Procon;

class Vector
{

    private $array = [];

    public function __construct()
    {
        if (func_num_args() > 0) {
            $this->array = array_fill(0, func_num_args(), null);
            for ($i = 0; $i < func_num_args(); $i++) {
                $this->array[$i] = func_get_arg($i);
            }
        }
    }

    public function add($object)
    {
        $tArray = array_fill(0, count($this->array) + 1, null);
        foreach ($this->array as $key => $value) {
            $tArray[$key] = $value;
        }
        $tArray[count($this->array)] = $object;
        $this->array = $tArray;
        return true;
    }

    public function contains($object)
    {
        foreach ($this->array as $value) {
            if ($value === $object) {
                return true;
            }
        }
        return false;
    }

    public function get($index)
    {
        if (array_key_exists($index, $this->array) === false) {
            throw new \OutOfRangeException;
        }
        return $this->array[$index];
    }

    public function set($index, $object)
    {
        if (array_key_exists($index, $this->array) === false) {
            throw new \OutOfRangeException;
        }
        $this->array[$index] = $object;
        return $object; // true or false?
    }

    public function size()
    {
        return count($this->array);
    }

    public function remove($index)
    {
        if (array_key_exists($index, $this->array) === false) {
            throw new \OutOfRangeException;
        }
        $tArray = array_fill(0, count($this->array) - 1, null);
        foreach ($this->array as $key => $value) {
            if ($key < $index) {
                $tArray[$key] = $value;
            } elseif ($key === $index) {
                $result = $value;
            } else {
                $tArray[$key - 1] = $value;
            }
        }
        $this->array = $tArray;
        return $result;
    }

    public function insert($index, $object)
    {
        if (array_key_exists($index, $this->array) === false) {
            throw new \OutOfRangeException;
        }
        $tArray = array_fill(0, count($this->array) + 1, null);
        foreach ($this->array as $key => $value) {
            if ($key < $index) {
                $tArray[$key] = $value;
            } elseif ($key === $index) {
                $tArray[$key] = $object;
                $tArray[$key + 1] = $value;
            } else {
                $tArray[$key + 1] = $value;
            }
        }
        $this->array = $tArray;
        return $object;
    }
}