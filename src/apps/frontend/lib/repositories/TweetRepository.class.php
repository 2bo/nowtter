<?php

/**
 * Created by PhpStorm.
 * User: tsubokoh
 * Date: 2019-02-05
 * Time: 23:00
 */
class TweetRepository
{

    public function addTweet($userId, $body)
    {
        $con = Doctrine_Manager::connection();
        $con->beginTransaction();

        try {
            $tweet = new TTweet();
            $tweet->setUserId($userId);
            $tweet->setBody($body);
            $tweet->save();

            $con->commit();
            return $tweet->getId();
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }

    public function getTimelineTweetsById($userId, $isResponseArray = false)
    {
//        $followUsers = TFollowTable::getInstance()
//            ->createQuery('f')
//            ->Select('f.follow_user_id')
//            ->Where('f.user_id = ?', $userId)
//            ->execute();
//
//        //FIXME: サブクエリ化
//        $targetUserIds = array();
//        foreach ($followUsers as $followUser) {
//            $targetUserIds[] = $followUser->getFollowUserId();
//        }
//        $targetUserIds[] = $userId;
//
//        $tweets = TTweetTable::getInstance()
//            ->createQuery('t')
//            ->addSelect('body')
//            ->WhereIn('t.user_id', $targetUserIds)
//            ->orderBy('created_at DESC');
//
//        if ($isResponseArray) {
//            $tweets = $tweets->fetchArray();
//        } else {
//            $tweets = $tweets->execute();
//        }
        $con = TTweetTable::getInstance()->getConnection();
        $sql = "SELECT t.body FROM t_tweet t WHERE t.user_id = :user_id OR t.id IN ( SELECT f.follow_user_id FROM t_follow f WHERE f.user_id = :user_id)";
        $tweets = $con->fetchAll($sql, array(":user_id" => $userId));

        return $tweets;
    }

    public function getTweetsByName($userName)
    {
        $con = TTweetTable::getInstance()->getConnection();
        $sql = "SELECT t.body AS body FROM t_tweet t 
                 INNER JOIN sf_guard_user sgu ON t.user_id = sgu.id 
                  WHERE sgu.username = :username";
        $tweets = $con->fetchAll($sql, array(':username' => $userName));
        return $tweets;
    }

    public function follow($userId, $followUserId)
    {
        $con = Doctrine_Manager::connection();
        $con->beginTransaction();
        try {
            $follow = new TFollow();
            $follow->setUserId($userId);
            $follow->setFollowUserId($followUserId);
            $follow->save();
            $con->commit();
        } catch (Exception $e) {
            throw $e;
        }
    }

}
