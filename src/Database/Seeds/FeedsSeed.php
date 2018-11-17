<?php

namespace RSSReader\Database\Seeds;

use RSSReader\Database\SeedInterface;
use RSSReader\Domain\Services\FeedService;

/**
 * Feeds seeder
 */
final class FeedsSeed implements SeedInterface
{
    /** @var string */
    public $name = 'feeds';

    /** @var FeedService */
    private $feedService;

    /**
     * FeedsSeed constructor.
     */
    public function __construct()
    {
        $this->feedService = new FeedService();
    }

    /**
     * @return void
     */
    public function exec()
    {
        $feeds = [
            'PHP'      => 'http://www.php.net/news.rss',
            'SlashDot' => 'http://slashdot.org/rss/slashdot.rss',
            'BBC News' => 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/front_page/rss.xml',
        ];

        foreach ($feeds as $feedName => $feedUrl) {
            $this->feedService->addFeed(
                $feedName,
                $feedUrl
            );
        }
    }
}