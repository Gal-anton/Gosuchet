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
<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
    //Идентификаторы завершенных задач
    var finishedTasks = [];

    //Стартовать длительную задачу
    var startLongTask = function (task_id, number) {
        $.get("?", {long_process: 1, task: task_id, number: number}, function (data) {
            finishedTasks.push(task_id);
            $("#task-" + task_id).text("Finished");
        }, "json");
    }

    //Отслеживать прогресс длительной задачи
    var monitorProgress = function (task_id) {
        $.get("?", {get_progress: 1, task: task_id}, function (data) {
            if ($.inArray(task_id, finishedTasks) != -1)
                return;

            if (data.progress !== undefined)
                $("#task-" + task_id).text("Progress: " + data.progress + "%");

            setTimeout(function () {
                monitorProgress(task_id);
            }, 100);
        }, "json");
    }

    //Запустить длительную задачу с отслеживанием прогресса
    var runTask = function (task_id, number) {
        var progressDiv = $("<div/>").addClass("progress-div");
        $("<div/>").text("Task ID: " + task_id).appendTo(progressDiv);
        $("<div/>").attr("id", "task-" + task_id).text("Starting...")
            .appendTo(progressDiv);
        $("#progressContainer").append(progressDiv);
        console.log(number);
        startLongTask(task_id, number);
        monitorProgress(task_id);
    }

    //Получить новый уникальный идентификатор задачи, после чего
    //запустить длительную задачу с отслеживанием прогресса
    var startProgress = function () {
        for (let i = 0; i < 2; i++) {
            $.get("?", {new_task: 1}, function (data) {
                runTask(data.task, 5 * i);
            }, "json");
        }
    }
</script>
<style>
    h3 {
        text-align: center;
    }

    .progress-div {
        padding: 5px;
        border: 1px solid gray;
        margin: 3px;
    }
</style>
</head>
<body>
<h3>Progress test</h3>
<div id="progressContainer">
</div>
<div>
    <button onclick="startProgress();">Start progress</button>
</div>
</body>
</html>