<?php

/**
 * post actions.
 *
 * @package    nowtter
 * @subpackage post
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class postActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->forward('default', 'module');
    }

    public function executePost(sfWebRequest $request)
    {
        if ($request->isMethod(sfRequest::POST)) {

            try {
                $tweetRepo = new TweetRepository();
                $tweetRepo->addTweet($this->getUser()->getGuardUser()->getId(), $request['body']);
                $this->redirect($this->getController()->genUrl('timeline'));
            } catch (Exception $e) {
                return sfView::ERROR;
            }
        }

        $form = new PostForm();
        $this->form = $form;
    }

    public function executePostJson(sfWebRequest $request)
    {
        sfContext::getInstance()->getLogger()->debug('posted');
        if ($request->isMethod(sfRequest::POST)) {
            $userId = $this->getUser()->getGuardUser()->getId();
            $tweetRepo = new TweetRepository();
            $ret = array();
            try {
                $tweetId = $tweetRepo->addTweet($userId, $request->getParameter('body'));
                $ret['success'] = 'ok';
                $ret['tweet_id'] = $tweetId;
            } catch (Exception $e) {
                $ret['success'] = 'ng';
            }
            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            return $this->renderText(json_encode($ret));
        }
    }
}
