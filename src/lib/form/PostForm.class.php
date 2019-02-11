<?php
/**
 * Created by PhpStorm.
 * User: tsubokoh
 * Date: 2019-02-02
 * Time: 14:32
 */

class PostForm extends BaseForm
{

    public function configure()
    {
        $this->setWidgets(array(
            'body' => new sfWidgetFormTextarea(),
        ));

        $this->setValidators(array(
            'body' => new sfValidatorString(),
        ));
    }
}