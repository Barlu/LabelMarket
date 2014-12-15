<?php

$mixDao = new MixDao();
$mix = new Mix();
$commentDao = new CommentDao();
$comments = [];

if(array_key_exists('submit', $_POST) && array_key_exists('comment', $_POST)){
    $sender = null;   
    if(array_key_exists('username', $_SESSION)){
        $userDao = new UserDao();
        $user = $userDao->findByUsername($_SESSION['username']);
        $senderId = $user->getId();
       } 
    $data = [
        'comment' => $_POST['comment'],
        'senderId' => $senderId,
        'receiverId' => $_GET['mixId']
        ];
    $comment = new Comment();
    Mapper::mapComment($comment, $data);
    $commentDao->save($comment);
}
if(array_key_exists('mixId', $_GET)){
    $mix = $mixDao->findById($_GET['mixId']);
    $comments = $commentDao->findAllByReceiverId($_GET['mixId'], 'mostRecent');
}else{
    header('Location: index.php?page=mixMaster');
}
