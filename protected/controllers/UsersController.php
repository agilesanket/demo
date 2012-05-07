<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','activate','create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];			
			if($model->save())
			{	$model->password=md5($model->password);
				$model->varification_code=md5(time());
				$model->is_active='N';
				$model->save(false);					

				$url=Yii::app()->createUrl('users/activate/').'/userid/'.$model->userid.'/'.'varification_code/'.$model->varification_code;
				echo CHtml::link('Here',$url);exit;
// 				Yii::import('application.extensions.phpmailer.JPhpMailer');
// 				$mail = new JPhpMailer;
// 				$mail->IsSMTP();
// 				$mail->Host = 'localhost';
// 				$mail->SMTPAuth = true;
// 				$mail->Username = 'test@agiletechnosys.com';
// 				$mail->Password = '';
// 				$mail->SetFrom('test@agiletechnosys.com', 'Site Admin');
// 				$mail->Subject = 'Email Varification for Speedlight registration';
// 				$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
// 				$mail->MsgHTML('<h1>Verify your email</h1>
// 						<br />Click here to verify your email.
// 						');
// 				$mail->AddAddress($model->emailaddress, 'Site Admin');
// 				$mail->Send();

				$this->redirect(array('view','id'=>$model->userid));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->userid));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	 *function to activate user account
	 */
	public function actionActivate($userid,$varification_code)
	{		
		$user_model=Users::model()->findByAttributes(array('userid'=>$userid));
		if($user_model->varification_code == $varification_code)
		{
			$user_model->is_active='Y';
// 			echo "<pre>";
// 			print_r($user_model->attributes);
// 			echo "</pre>";
// 			exit;
			if($user_model->save(false))
			{
				Yii::app()->user->setFlash('success','<div class="success">Your account activated successfully.</div>');
				//echo "activation successful";exit;								
				$this->redirect(array('site/login'));
			}
			else
			{
				echo 'Invalid activation code';exit;
			}
		}		
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
