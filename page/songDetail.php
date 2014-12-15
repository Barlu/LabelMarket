<?php

$songDao = new SongDao();
$song = new Song();
$albumDao = new AlbumDao();
$album = new Album();
$commentDao = new CommentDao();
$comments = [];

if(array_key_exists('submit', $_POST) && array_key_exists('comment', $_POST)){
    $senderId = null;   
    if(array_key_exists('username', $_SESSION)){
        $userDao = new UserDao();
        $user = $userDao->findByUsername($_SESSION['username']);
        $senderId = $user->getId();
       } 
    $data = [
        'comment' => $_POST['comment'],
        'senderId' => $senderId,
        'receiverId' => $_GET['songId']
        ];
    $comment = new Comment();
    Mapper::mapComment($comment, $data);
    $commentDao->save($comment);
}
if(array_key_exists('songId', $_GET)){
    $song = $songDao->findById($_GET['songId']);
    $album = $albumDao->findById($song->getAlbumId());
    $comments = $commentDao->findAllByReceiverId($_GET['songId'], 'mostRecent');
}else{
    header('Location: index.php?page=songMaster');
}

