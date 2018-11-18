<?php

namespace RSSReader\Domain\Factories;

use SimpleXMLElement;

/**
 * RSS Class
 */
final class RSS
{
    /** @var string */
    private $feedUrl;
    /** @var SimpleXMLElement */
    private $xml;
    /** @var array */
    private $posts = [];

    /**
     * @param string $feedUrl
     *
     * @return RSS
     */
    public static function forge(string $feedUrl)
    {
        return new static($feedUrl);
    }

    /**
     * RSS constructor.
     *
     * @param string $feedUrl
     */
    public function __construct(string $feedUrl)
    {
        $this->feedUrl = $feedUrl;
        $this->getXML();
    }

    /**
     * Get the xml
     */
    private function getXML()
    {
        $this->xml = simplexml_load_file($this->feedUrl);
    }

    /**
     * Parse details we need from the feed
     *
     * @throws \Exception
     *
     * @return array
     */
    public function parseFeed() :array
    {
        if (empty($this->xml->channel->item) === true) {
            $items = $this->xml->item;
        } else {
            $items = $this->xml->channel->item;
        }

        foreach ($items as $item) {
            if (empty($item->pubDate) === true) {
                $date = null;
                $displayDate = null;
            } else {
                $date = new \DateTimeImmutable((string) $item->pubDate);
                $displayDate = $date->format('Y-m-d H:i:s');
            }

            try{
                $thumbnail = (string) $item->children('media', true)->thumbnail->attributes()->url;
            } catch (\ErrorException $e) {
                $thumbnail = '/assets/missing-image.png';
            }

            $this->posts[] = [
                'title' => (string) $item->title,
                'description' => (string) $item->description,
                'link' => (string) $item->link,
                'date' => $date,
                'display_date' => $displayDate,
                'thumbnail' => $thumbnail,
            ];
        }

        if ($date !== null) {
            $this->sortPosts();
        }

        if (empty($this->xml->channel->image->url) === true) {
            $image = '/assets/missing-image.png';
        } else {
            $image = (string) $this->xml->channel->image->url;
        }

        return [
            'details' => [
                'title' => (string) $this->xml->channel->title,
                'description' => (string) $this->xml->channel->description,
                'image' => $image,
                'website' => (string) $this->xml->channel->link,
            ],
            'posts' => $this->posts,
        ];
    }

    /**
     * Sort the posts data
     * Most recent first
     */
    private function sortPosts()
    {
        usort($this->posts, function($a, $b) {
            if ($a['date'] > $b['date']) {
                return 0;
            }
            if ($a['date'] < $b['date']) {
                return 1;
            }
        });
    }
}