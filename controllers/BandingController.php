<?php

namespace app\controllers;

use Yii;
use app\models\Banding;
use app\models\BandingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BandingController implements the CRUD actions for Banding model.
 */
class BandingController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Banding models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BandingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $jmlBanding = 0;
        if (Yii::$app->user->identity->is_atasan) {
            $jmlBanding = Banding::find()->where(['id_atasan' => Yii::$app->user->identity->id_pegawai, 'status_banding' => 'Belum Diapprove'])
            ->count();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'jmlBanding' => $jmlBanding,
        ]);
    }

    public function actionIndexApprove()
    {
        $searchModel = new BandingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 1);

        return $this->render('index-approve', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banding model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Banding model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banding();

        if ($model->load(Yii::$app->request->post()) &&  $model->upload('file') && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $model->tgl_banding = date('Y-m-d');
            if (!is_null(Yii::$app->user->identity->pegawai)) {
                $model->id_pegawai = Yii::$app->user->identity->pegawai->id_pegawai;
                if (!is_null(Yii::$app->user->identity->pegawai->pegawai_atasan)) {
                    $model->id_atasan = Yii::$app->user->identity->pegawai->pegawai_atasan->id_pegawai;

                    return $this->render('create', [
                        'model' => $model,
                    ]);
                } else {
                    Yii::$app->session->setFlash('error', ' Data Atasan Anda Belum di Isi Harap Hubungi Administrator');
                    $this->redirect('index');
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Banding model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->upload('file') && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_banding]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index-approve');
        } else {
            return $this->renderAjax('_form_approve', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Banding model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (\yii\db\IntegrityException  $e) {
            Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dihapus Karena Dipakai Modul Lain');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banding model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Banding the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banding::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
