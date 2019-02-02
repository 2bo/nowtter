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

            $con = Doctrine_Manager::connection();
            $con->beginTransaction();
            try {
                $name = $request['name'];
                $user = Doctrine_Core::getTable('MUser')->findOneByUserName($name);
                if (!$user) {
                    $user = new MUser();
                    $user->setUserName($name);
                    $user->save();
                }

                $tweet = new TTweet();
                $tweet->setUserId($user->getId());
                $tweet->setBody($request['body']);
                $tweet->save();

                $con->commit();

            } catch (Exception $e) {
                $con->rollback();
                throw $e;
            }
        }

        $form = new PostForm();
        $this->form = $form;
    }
}
