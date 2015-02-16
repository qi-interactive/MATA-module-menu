<?php
use mata\modulemenu\assets\BootstrapAsset;
use yii\helpers\Html;

BootstrapAsset::register($this);
?>

<div style="display: block; position: relative; z-index: 9999" id="module-menu-bootstrap-prompt"  class="row">
	<div class="col-xs-12">
		<div class="alert alert-info">
			<?php foreach ($modules as $module): ?>

				<form id="module-menu-bootstrap" action="/mata/moduleMenu/bootstrap" method="POST">

					<p>Would you like to add the module <?php echo $module["Name"]; ?> to <?php echo \Yii::$app->name ?> menu?</p>
					<input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken() ?>">

					<?php echo Html::hiddenInput("module[Name]", $module["Name"]); ?>
					<?php echo Html::hiddenInput("module[Location]", $module["Location"]); ?>
					<?php echo Html::hiddenInput("module[Enabled]", null, [
						"id" => "module-enabled"
					]); ?>

					<button data-value="1" class="btn btn-success"type="submit">Add module to menu</button>
					<button data-value="0" class="btn btn-warning"type="submit">Don't ask me again</button>
				</form>      

			<?php endforeach; ?>
		</div>
	</div>
</div>
