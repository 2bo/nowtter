<?php

/**
 * BaseTTweet
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property string $body
 * @property boolean $is_enable
 * @property sfGuardUser $sfGuardUser
 * @property Doctrine_Collection $FavoritedUsers
 * @property Doctrine_Collection $RetweetedUsers
 * 
 * @method integer             getUserId()         Returns the current record's "user_id" value
 * @method string              getBody()           Returns the current record's "body" value
 * @method boolean             getIsEnable()       Returns the current record's "is_enable" value
 * @method sfGuardUser         getSfGuardUser()    Returns the current record's "sfGuardUser" value
 * @method Doctrine_Collection getFavoritedUsers() Returns the current record's "FavoritedUsers" collection
 * @method Doctrine_Collection getRetweetedUsers() Returns the current record's "RetweetedUsers" collection
 * @method TTweet              setUserId()         Sets the current record's "user_id" value
 * @method TTweet              setBody()           Sets the current record's "body" value
 * @method TTweet              setIsEnable()       Sets the current record's "is_enable" value
 * @method TTweet              setSfGuardUser()    Sets the current record's "sfGuardUser" value
 * @method TTweet              setFavoritedUsers() Sets the current record's "FavoritedUsers" collection
 * @method TTweet              setRetweetedUsers() Sets the current record's "RetweetedUsers" collection
 * 
 * @package    nowtter
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTTweet extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('t_tweet');
        $this->hasColumn('user_id', 'integer', null, array(
            'type' => 'integer',
            'notnull' => true,
        ));
        $this->hasColumn('body', 'string', 140, array(
            'type' => 'string',
            'notnull' => true,
            'length' => 140,
        ));
        $this->hasColumn('is_enable', 'boolean', null, array(
            'type' => 'boolean',
            'notnull' => true,
            'default' => 1,
        ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
            'local' => 'user_id',
            'foreign' => 'id',
            'onDelete' => 'CASCADE'));

        $this->hasMany('TFavorite as FavoritedUsers', array(
            'local' => 'id',
            'foreign' => 'tweet_id'));

        $this->hasMany('TRetweet as RetweetedUsers', array(
            'local' => 'id',
            'foreign' => 'tweet_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}