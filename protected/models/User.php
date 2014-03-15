<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $mail
 * @property string $password
 * @property string $key
 * @property string $fio
 * @property integer $role
 * @property integer $sex
 * @property string $birthday
 * @property integer $full_info
 * @property integer $status
 * @property string $balans
 * @property integer $send_status
 * @property string $last_visit
 * @property string $id_profile
 *
 * The followings are the available model relations:
 * @property Profile $idProfile
 */
class User extends CActiveRecord
{
	/**
	 * Роли пользователей
	 */
	const ROLE_BANNED = 0;
	const ROLE_USER = 1;
	const ROLE_VIP = 2;
	const ROLE_MODERATOR = 3;
	const ROLE_ADMIN = 4;

	/**
	 * Статусы рассылок
	 */
	const SEND_FALSE = 0;
	const SEND_TRUE = 1;

	/**
	 * Пол
	 */
	const SEX_MAN = 1;
	const SEX_WOMAN = 2;

	/**
	 * Статусы подтверждения регистрации
	 */
	const STATUS_UNCONFIRM = 0;
	const STATUS_CONFIRM = 1;

	const SALT = 'doctorebalak';

	public $repeatPassword;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('mail, password', 'required'),
			array('mail', 'email'),
			array('mail', 'unique', 'attributeName' => 'mail'),
			array('password', 'length', 'max' => 30, 'min' => 5),
			array('repeatPassword', 'required', 'on' => 'register'),
			array('repeatPassword', 'compare', 'compareAttribute' => 'password', 'on' => 'register'),
			array('fio, sex, birthday', 'required', 'on' => 'update'),
			array('sex', 'in', 'range' => array(self::SEX_MAN, self::SEX_WOMAN)),
			array('birthday', 'date', 'format' => 'yyyy-mm-dd'),

			array(
				'id, role, mail, password, sex, fname, lname, oname, birthday, timereg, lastvisit, full_info, id_cities, phone, skype, google, vk, facebook, twitter, send_status, id_avatar',
				'safe',
				'on' => 'search'
			),
		);
	}

	public function beforeSave()
	{
		if (!parent::beforeSave()) {
			return false;
		}
		if ($this->getIsNewRecord()) {
			$this->password = crypt($this->password, self::SALT);
			$this->key = md5(md5(time() . $this->mail . $this->password));
			$this->status = self::STATUS_UNCONFIRM;
			if ($this->getScenario() === 'register') {
				$this->role = self::ROLE_USER;
			}
		}

		return true;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'profile' => array(self::BELONGS_TO, 'Profile', 'id_profile'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'mail' => 'Эл. почта',
			'password' => 'Пароль',
			'repeatPassword' => 'Повторите пароль',
			'key' => 'Ключ',
			'fio' => 'Имя',
			'role' => 'Роль',
			'sex' => 'Пол',
			'birthday' => 'Дата рождения',
			'full_info' => 'Заполненность профиля',
			'status' => 'Подтверждение ренистрации',
			'balans' => 'Баланс',
			'send_status' => 'Статус рассылок',
			'last_visit' => 'Последний визит',
			'id_profile' => 'Профиль',
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
		$criteria->compare('mail', $this->mail, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('key', $this->key, true);
		$criteria->compare('fio', $this->fio, true);
		$criteria->compare('role', $this->role);
		$criteria->compare('sex', $this->sex);
		$criteria->compare('birthday', $this->birthday, true);
		$criteria->compare('full_info', $this->full_info);
		$criteria->compare('status', $this->status);
		$criteria->compare('balans', $this->balans, true);
		$criteria->compare('send_status', $this->send_status);
		$criteria->compare('last_visit', $this->last_visit, true);
		$criteria->compare('id_profile', $this->id_profile, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Возвращает true, если пользователь еще не сохранял страну
	 * @return bool
	 */
	public function isEmptyCountry()
	{
		return $this->profile->city->id_country === null;
	}

	/**
	 * Возвращает true, если пользователь еще не сохранял город
	 * @return bool
	 */
	public function isEmptyCity()
	{
		return $this->profile->id_city === null;
	}

	/**
	 * Возвращает true, если пользователь еще не сохранял метро
	 * @return bool
	 */
	public function isEmptyMetro()
	{
		return $this->profile->id_metro === null;
	}
}
