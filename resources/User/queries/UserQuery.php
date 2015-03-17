<?php
/**
 * UserQuery.php
 * @author Revin Roman http://phptime.ru
 */

namespace resources\User\queries;

/**
 * Class UserQuery
 * @package resources\User\queries
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
        /** @var AbstractSocialQueryInterface $SocialQuery */
        $SocialQuery = $class::find();

        /** @var \resources\User\Auth\AbstractSocial $Social */
        $Social = $SocialQuery
            ->bySocialId($social_id)
            ->one();

        if (empty($Social)) {
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
        return $this->bySocialId(\resources\User\Auth\Facebook::class, $Facebook_id);
    }

    /**
     * @param integer|array $Github_id
     * @return self
     */
    public function byGithubId($Github_id)
    {
        return $this->bySocialId(\resources\User\Auth\Github::class, $Github_id);
    }

    /**
     * @param integer|array $Google_id
     * @return self
     */
    public function byGoogleId($Google_id)
    {
        return $this->bySocialId(\resources\User\Auth\Google::class, $Google_id);
    }

    /**
     * @param integer|array $Linkedin_id
     * @return self
     */
    public function byLinkedinId($Linkedin_id)
    {
        return $this->bySocialId(\resources\User\Auth\Linkedin::class, $Linkedin_id);
    }

    /**
     * @param integer|array $Live_id
     * @return self
     */
    public function byLiveId($Live_id)
    {
        return $this->bySocialId(\resources\User\Auth\Live::class, $Live_id);
    }

    /**
     * @param integer|array $Twitter_id
     * @return self
     */
    public function byTwitterId($Twitter_id)
    {
        return $this->bySocialId(\resources\User\Auth\Twitter::class, $Twitter_id);
    }


    /**
     * @param integer|array $Vkontakte_id
     * @return self
     */
    public function byVkontakteId($Vkontakte_id)
    {
        return $this->bySocialId(\resources\User\Auth\Vkontakte::class, $Vkontakte_id);
    }

    /**
     * @param integer|array $Yandex_id
     * @return self
     */
    public function byYandexId($Yandex_id)
    {
        return $this->bySocialId(\resources\User\Auth\Yandex::class, $Yandex_id);
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
        $this->andWhere(['deleted' => \resources\User::NOT_DELETED]);

        return $this;
    }
} 