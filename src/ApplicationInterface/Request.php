<?php

namespace RSSReader\ApplicationInterface;

/**
 * Request Object
 */
final class Request implements RequestInterface
{
    /** @var array */
    private $attributes;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->buildRequest();
    }

    /**
     * Get/Set all the things
     *
     * @param $method
     * @param $arguments
     *
     * @return mixed
     */
    public function __call(
        $method,
        $arguments
    ) {
        if (strpos($method, 'get') === 0) {
            //Its a getter
           $attr = str_replace('get', '', $method);
           $attr = str_replace($attr{0}, strtolower($attr{0}), $attr);

           return $this->attributes[$attr];
        }

        if (strpos($method, 'set') === 0) {
            //Its a setter
            $attr = str_replace('set', '', $method);
            $attr = str_replace($attr{0}, strtolower($attr{0}), $attr);

            $this->attributes[$attr] = $arguments[0];
        }
    }

    /**
     * @return array
     */
    public function getAttributes() :array
    {
        return $this->attributes;
    }

    /**
     * Set server vars on request object
     */
    private function buildRequest()
    {
        foreach($_SERVER as $key => $value)
        {
            $attr = null;

            $attr = strtolower($key);
            preg_match_all('/_[a-z]/', $attr, $matches);
            foreach($matches[0] as $match)
            {
                $firstLetter = str_replace('_', '', $match);
                $attr = str_replace($match, strtoupper($firstLetter), $attr);
            }

            if (empty($attr) === false) {
                $this->attributes[$attr] = $value;
            }
        }
    }
}