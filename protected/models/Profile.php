<?php

/**
 * This is the model class for table "profile".
 *
 * The followings are the available columns in table 'profile':
 * @property string $id
 * @property string $time_reg
 * @property integer $type
 * @property string $vk
 * @property string $googleplus
 * @property string $facebook
 * @property string $twitter
 * @property string $phone
 * @property string $avatar
 * @property string $id_metro
 * @property string $id_city
 * @property string $skype
 *
 * The followings are the available model relations:
 * @property City $idCity
 * @property Metro $idMetro
 * @property User[] $users
 */

class Profile extends CActiveRecord
{
	/**
	 * Виды профиля (профиль пользователя, профиль группы)
	 */
	const TYPE_USER = 1;
	const TYPE_GROUP = 2;

	public $country;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country, id_city', 'required', 'on' => 'update'),
			array('id_metro', 'safe'),
			array('vk, googleplus, facebook, twitter, skype', 'length', 'max' => 65),
			array('phone', 'length', 'max' => 20),
			/*
			array('avatar', 'length', 'max' => 120),
			array('id_metro, id_city', 'length', 'max' => 10),
			*/
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			// array('id, time_reg, type, vk, googleplus, facebook, twitter, phone, avatar, id_metro, id_city, skype', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'metro' => array(self::BELONGS_TO, 'Metro', 'id_metro'),
			'city' => array(self::BELONGS_TO, 'City', 'id_city'),
			'user' => array(self::HAS_ONE, 'User', 'id_profile'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'time_reg' => 'Дата регистрации',
			'type' => 'Type',
			'vk' => 'Vk',
			'googleplus' => 'Google+',
			'facebook' => 'Facebook',
			'twitter' => 'Twitter',
			'skype' => 'Skype',
			'phone' => 'Телефон',
			'avatar' => 'Аватар',
			'country' => 'Страна',
			'id_metro' => 'Метро',
			'id_city' => 'Город',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('time_reg', $this->time_reg, true);
		$criteria->compare('type', $this->type);
		$criteria->compare('vk', $this->vk, true);
		$criteria->compare('googleplus', $this->googleplus, true);
		$criteria->compare('facebook', $this->facebook, true);
		$criteria->compare('twitter', $this->twitter, true);
		$criteria->compare('phone', $this->phone, true);
		$criteria->compare('avatar', $this->avatar, true);
		$criteria->compare('id_metro', $this->id_metro, true);
		$criteria->compare('id_city', $this->id_city, true);
		$criteria->compare('skype', $this->skype, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function beforeSave()
	{
		if (!parent::beforeSave()) {
			return false;
		}
		if ($this->getIsNewRecord()) {
			$this->time_reg = time();
		}

		return true;
	}

	/**
	 * Регистрация нового пользователя
	 * @param User $user
	 * @return boolean
	 */
	public function createUser(User $user)
	{
		$this->type = self::TYPE_USER;
		$transaction = $this->getDbConnection()->beginTransaction();
		try {
			if (!$this->save(false)) {
				throw new Exception();
			}
			$user->id_profile = $this->id;
			if (!$user->save(false)) {
				throw new Exception();
			}

			$transaction->commit();

			return true;
		} catch (Exception $e) {
			$transaction->rollback();
		}

		return false;
	}

	/**
	 * Обновление профиля пользователя
	 * @param User $user
	 * @return boolean
	 */
	public function updateUser(User $user)
	{
		$transaction = $this->getDbConnection()->beginTransaction();
		try {
			if (!$user->save(false) || !($user->profile && $user->profile->save(false))) {
				throw new Exception();
			}

			$transaction->commit();

			return true;
		} catch (Exception $e) {
			$transaction->rollback();
		}

		return false;
	}

	function behaviors()
	{
		return array(
			'ensureNull' => array(
				'class' => 'application.behaviors.EEnsureNullBehavior',
			)
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Profile the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
