<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 18-3-2015
 * Time: 19:59
 *
 * @Usbstikje, a random twitterbot.
 */

namespace Nav\CMSBundle\Controller;


use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Validator\Constraints\True;

/**
 * Class UsbstikController
 * @package Nav\CMSBundle\Controller
 *
 * Uses the feeds from NavCMSBundle:Page and
 * selects random one to tweet. Chops them
 * and uses googl url-shortner to stay within the
 * 140 characters limit of twitter.
 *
 */
class UsbstikController extends Controller{


    /**
     * - selectRandomSource: returns a tweet from a random source
     */
    public function startAction()
    {
        $tweet = $this->getLuckyTweetPost();
        $shortUrl = $this->getGooglShortUrl($tweet['link']);
        $composedTweet = substr($tweet['title'], 0, 120) . ' - ' . $shortUrl->id;
        $response = $this->tweetThis($composedTweet);

        if($response !== 200){
            //@TODO: Error handling
        }

        var_dump($response);
        exit;

    }

    /**
     * @param $tweet
     * @return int statuscode
     */
    public function tweetThis($tweet)
    {
        $twitter = $this->get('guzzle.twitter.client');
        $status = $twitter->post('statuses/update.json', null, ['status' => $tweet])
            ->send();

        return $status->getStatusCode();
    }

    /**
     * Returns a  tweet
     */
    public function getLuckyTweetPost(){

        $chuck = $this->get('scraper.chuck_norris');
        $feedburner = $this->get('scraper.feedburner');
        $em = $this->getDoctrine()->getEntityManager();
        $allFeeds = $em->getRepository('NavCMSBundle:Page')->findAll();

        foreach ($allFeeds as $feed) {
            $feeds[] = $feed->getFeed();
        }

        // And the lucky feed is:
        $luckyFeed = $feeds[rand(0, 5)];
        $feedburner->loadFeed($luckyFeed);
        $luckyArticle =  $feedburner->getOneEntry();

        // Some feeds dont return contentSnippet,
        // load the title instead if contentSnippet strlen < 10
        if(strlen($luckyArticle['contentSnippet']) < 10){
                $luckyArticle['contentSnippet'] = substr($luckyArticle['title'], 0, 135) . '...';
        }

        return $luckyArticle;
    }

    public function getGooglShortUrl($url){
        $client = new Client();
        $key = $this->container->getParameter('googl_key');
        $requestUrl = "https://www.googleapis.com/urlshortener/v1/url?key=" . $key;

        $response = $client->post($requestUrl, [
            'verify' => false,
            'body' => json_encode(['longUrl' => $url]),
            'headers' => ['Content-Type' => 'application/json']
        ]);

        return $response->json([
            'object'=>true
        ]);

    }




}