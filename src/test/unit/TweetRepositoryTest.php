<?php

require_once dirname(__FILE__) . '/../bootstrap/unit.php';

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);
new sfDatabaseManager($configuration);

$doctrine = new sfDoctrineDropDbTask($configuration->getEventDispatcher(), new sfAnsiColorFormatter());
$doctrine->run(array(), array("--no-confirmation", "--env=test"));

$doctrine = new sfDoctrineBuildDbTask($configuration->getEventDispatcher(), new sfAnsiColorFormatter());
$doctrine->run(array(), array("--env=test"));

$doctrine = new sfDoctrineInsertSqlTask($configuration->getEventDispatcher(), new sfAnsiColorFormatter());
$doctrine->run(array(), array("--env=test"));

$t = new lime_test(2);

$firstUserId = createUser('first', 'first@example.com');
$secondUserId = createUser('second', 'second@example.com');

$tRepo = new TweetRepository();

$tid = $tRepo->addTweet($firstUserId, 'tweet1');
$t->is(TTweetTable::getInstance()->findOnebyId($tid)->getBody(), 'tweet1', 'post tweet');

sleep(1);
$tRepo->addTweet($secondUserId, 'tweet2');
$tRepo->follow($firstUserId, $secondUserId);
$tweets = $tRepo->getTimelineTweetsById($firstUserId);
$bodies = array();
foreach ($tweets as $tweet) {
    $bodies[] = $tweet->getBody();
}
$t->is_deeply($bodies, array(0 => 'tweet2', 'tweet1'), 'get own and follower\'s tweet for timeline');

function createUser($userName, $emailAddress)
{
    $sgUser = sfGuardUserTable::getInstance()->findOneByUserName($userName);
    if (!$sgUser) {
        $sgUser = new sfGuardUser();
        $sgUser->setUsername($userName);
        $sgUser->setEmailAddress($emailAddress);
        $sgUser->save();
    }
    return $sgUser->getId();
}

