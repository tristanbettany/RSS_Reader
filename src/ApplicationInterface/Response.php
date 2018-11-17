<?php

namespace RSSReader\ApplicationInterface;

/**
 * Response Object
 */
final class Response implements ResponseInterface
{
    /** @var array */
    private $data = [];
    /** @var string */
    private $type = 'JSON';
    /** @var string|null */
    private $template;
    /** @var int */
    private $code = 200;

    /**
     * Response constructor.
     *
     * @param array $data
     * @param int $code
     * @param string $template
     * @param string $type
     */
    public function __construct(
        array  $data = [],
        int    $code = 200,
        string $template = null,
        string $type = 'JSON'
    ) {
        $this->template = $template;
        $this->data = $data;
        $this->code = $code;
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }
}