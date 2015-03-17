<?php
/**
 * UserQuery.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models\queries;

use frontend\modules\Account;

/**
 * Class UserQuery
 * @package frontend\modules\Account\models\queries
 */
class UserQuery extends \yii\db\ActiveQuery
{

    /**
     * @param integer|array $id
     * @return self
     */
    public function byId($id)
    {
        $this->andWhere(['id' => $id]);

        return $this;
    }

    /**
     * @param string $class
     * @param integer|array $social_id
     * @return $this|static
     */
    public function bySocialId($class, $social_id)
    {
        /** @var \yii\db\ActiveRecord $Facebook */
        $Social = $class::find()
            ->bySocialId($social_id)
            ->one();

        if (empty($VK)) {
            return $this->andWhere('1=0');
        } else {
            $this->byId($Social->social_id);
        }

        return $this;
    }

    /**
     * @param integer|array $Facebook_id
     * @return self
     */
    public function byFacebookId($Facebook_id)
    {
        return $this->bySocialId(Account\models\User\Facebook::class, $Facebook_id);
    }

    /**
     * @param integer|array $Github_id
     * @return self
     */
    public function byGithubId($Github_id)
    {
        return $this->bySocialId(Account\models\User\Github::class, $Github_id);
    }

    /**
     * @param integer|array $Google_id
     * @return self
     */
    public function byGoogleId($Google_id)
    {
        return $this->bySocialId(Account\models\User\Google::class, $Google_id);
    }

    /**
     * @param integer|array $Linkedin_id
     * @return self
     */
    public function byLinkedinId($Linkedin_id)
    {
        return $this->bySocialId(Account\models\User\Linkedin::class, $Linkedin_id);
    }

    /**
     * @param integer|array $Live_id
     * @return self
     */
    public function byLiveId($Live_id)
    {
        return $this->bySocialId(Account\models\User\Live::class, $Live_id);
    }

    /**
     * @param integer|array $Twitter_id
     * @return self
     */
    public function byTwitterId($Twitter_id)
    {
        return $this->bySocialId(Account\models\User\Twitter::class, $Twitter_id);
    }


    /**
     * @param integer|array $Vkontakte_id
     * @return self
     */
    public function byVkontakteId($Vkontakte_id)
    {
        return $this->bySocialId(Account\models\User\Vkontakte::class, $Vkontakte_id);
    }

    /**
     * @param integer|array $Yandex_id
     * @return self
     */
    public function byYandexId($Yandex_id)
    {
        return $this->bySocialId(Account\models\User\Yandex::class, $Yandex_id);
    }

    /**
     * @param string|array $token
     * @return self
     */
    public function byToken($token)
    {
        $this->andWhere(['token' => $token]);

        return $this;
    }

    /**
     * @param string|array $name
     * @return self
     */
    public function byName($name)
    {
        $this->andWhere(['name' => $name]);

        return $this;
    }

    /**
     * @param string|array $email
     * @return self
     */
    public function byEmail($email)
    {
        $this->andWhere(['email' => $email]);

        return $this;
    }

    /**
     * @param string|array $login
     * @return self
     */
    public function byLogin($login)
    {
        $this->andWhere(['login' => $login]);

        return $this;
    }

    /**
     * @return self
     */
    public function onlyNotDeleted()
    {
        $this->andWhere(['deleted' => Account\models\User::NOT_DELETED]);

        return $this;
    }
} 