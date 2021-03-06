<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "tb_mt_skorsing".
 *
 * @property int $id_skorsing
 * @property int $id_pegawai
 * @property string $tanggal_awal
 * @property string $tanggal_akhir
 * @property string $keterangan
 *
 * @property TbMPegawai $pegawai
 */
class Skorsing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mt_skorsing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pegawai', 'tanggal_awal', 'tanggal_akhir'], 'required'],
            [['id_pegawai'], 'integer'],
            [['tanggal_awal', 'tanggal_akhir'], 'safe'],
            [['keterangan'], 'string'],
            [['id_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['id_pegawai' => 'id_pegawai']],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [


            "tanggal_akhirBeforeSave" => [
                "class" => TimestampBehavior::className(),
                "attributes" => [
                    ActiveRecord::EVENT_BEFORE_INSERT => "tanggal_akhir",
                    ActiveRecord::EVENT_BEFORE_UPDATE => "tanggal_akhir",
                ],

                "value" => function () {
                    return implode("-", array_reverse(explode("-", $this->tanggal_akhir)));
                }



            ],






            "tanggal_awalBeforeSave" => [
                "class" => TimestampBehavior::className(),
                "attributes" => [
                    ActiveRecord::EVENT_BEFORE_INSERT => "tanggal_awal",
                    ActiveRecord::EVENT_BEFORE_UPDATE => "tanggal_awal",
                ],

                "value" => function () {
                    return implode("-", array_reverse(explode("-", $this->tanggal_awal)));
                }



            ],




        ];
    }

    public function attributeLabels()
    {
        return [
            'id_skorsing' => Yii::t('app', 'Id Skorsing'),
            'id_pegawai' => Yii::t('app', 'Id Pegawai'),
            'tanggal_awal' => Yii::t('app', 'Tanggal Awal'),
            'tanggal_akhir' => Yii::t('app', 'Tanggal Akhir'),
            'keterangan' => Yii::t('app', 'Keterangan'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['id_pegawai' => 'id_pegawai']);
    }
    public function getNama_pegawai()
    {
        return is_null($this->pegawai) ? '' : '' . $this->pegawai->nama_lengkap;
    }

    public function getNip()
    {
        return is_null($this->pegawai) ? '' : '' . $this->pegawai->nip;
    }
}
