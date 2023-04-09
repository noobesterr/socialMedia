<?php
session_start();
require 'SQLWorker.php';
$sqlWorker = new SQLWorker();
if (!isset($_POST['action'])){
    Response([
        'error' => true,
        'message' => "attribute action missed"
    ]);
    die;
}
function Response($data = []){
    echo json_encode($data);
    die;
}
switch ($_POST['action']){
    case "delete_post":
        $result = $sqlWorker->removePost($_POST['id']);
        if ($result){
            Response([
                'error' => false,
                'message' => "Post successfully removed"
            ]);
        }
        break;
    case "edit_post":
        $result = $sqlWorker->updatePost($_POST['id'],$_POST);
        if ($result){
            Response([
                'error' => false,
                'message' => "Post successfully Updated"
            ]);
        }
        break;
    case "report_post":
        $report = $sqlWorker->getReportPost($_SESSION['id'],$_POST['id']);
        if ($report){
            Response([
                'error' => true,
                'message' => "You have already Reported this post"
            ]);
        }
        $result = $sqlWorker->reportPost($_SESSION['id'],$_POST['id']);
        if ($result){
            Response([
                'error' => false,
                'message' => "Post successfully Reported"
            ]);
        }
        break;
    case "react_post":
        $result = $sqlWorker->reactPost($_SESSION['id'],$_POST['id'],$_POST['reaction']);
        if ($result){
            Response([
                'error' => false
            ]);
        }
        break;
}
Response([
    'error' => true,
    'message' => "Something wrong happened, try later"
]);