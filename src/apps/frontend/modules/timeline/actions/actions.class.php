<?php

/**
 * timeline actions.
 *
 * @package    nowtter
 * @subpackage timeline
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class timelineActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        $userName = $request->getParameter('name');
        $tweetRepo = new TweetRepository();

        if (strlen($userName) > 0) {
            $this->tweets = $tweetRepo->getTweetsByName($userName);
        } else {
            $userId = $this->getUser()->getGuardUser()->getId();
            $this->tweets = $tweetRepo->getTimelineTweetsById($userId);
        }
    }

    public function executeGetJson(sfWebRequest $response)
    {
        $userId = $this->getUser()->getGuardUser()->getId();
        $tweetRepo = new TweetRepository();
        $tweets = $tweetRepo->getTimelineTweetsById($userId, true);
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        return $this->renderText(json_encode($tweets));
    }


}
