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
        $this->tweets = Doctrine_Core::getTable('TTweet')
            ->createQuery('q')
            ->Select('body')
            ->orderBy('created_at DESC')
            ->execute();
    }
}
