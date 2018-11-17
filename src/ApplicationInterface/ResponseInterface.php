<?php

namespace RSSReader\ApplicationInterface;

/**
 * Response Interface
 */
interface ResponseInterface
{
    /**
     * @return array
     */
    public function getData() :array;

    /**
     * @return string
     */
    public function getType() :string;

    /**
     * @return string|null
     */
    public function getTemplate();

    /**
     * @return int
     */
    public function getCode() :int;
}