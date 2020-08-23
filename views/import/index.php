<?php
/* @var $this yii\web\View */

use app\models\import\SessionHelper;

?>
<?= "<head>" ?>
<?php
SessionHelper::init();
$this->title = 'Импорт организаций';
$this->params['breadcrumbs'][] = $this->title;
?>
</head>
<body>
<h3>Import</h3>
<div>
    <button>Import is over</button>
</div>
</body>
</html>