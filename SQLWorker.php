<?php

class SQLWorker
{
    private $conn = null;
    private $stmt = null;

    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=socialmedia','root','');
        }catch(PDOException $e){
            var_dump($e->getMessage());
            die;
        }
    }

    private function execute(){
        try {
            $this->stmt->execute();
        }catch (PDOException $e){
            var_dump($e->getMessage());die;
        }
    }

    public function getUserByMail($email){
        $this->stmt = $this->conn->prepare('SELECT * FROM users WHERE email=:em');
        $this->stmt->bindParam(':em',$email);
        $this->execute();
        return $this->stmt->fetchObject();
    }

    public function register($data = []){
        $this->stmt = $this->conn->prepare('INSERT INTO users(name,email,password,created_at) VALUES (:un,:em,:pwd,:cr)');
        $this->stmt->bindValue(':un',$data['user_name']??null);
        $this->stmt->bindValue(':pwd',$data['password']??null);
        $this->stmt->bindValue(':em',$data['email']??null);
        $this->stmt->bindValue(':cr',date('Y-m-d H:i:s'));
        $this->execute();
        return $this->stmt->rowCount() >0;
    }

    public function updateProfile($id,$data = []){
        $this->stmt = $this->conn->prepare('UPDATE users SET name=:un,email=:em,avatar=:av where id=:id');
        $this->stmt->bindValue(':un',$data['name']??null);
        $this->stmt->bindValue(':em',$data['email']??null);
        $this->stmt->bindValue(':av',$data['avatar']??null);
        $this->stmt->bindValue(':id',$id);
        $this->execute();
        return $this->stmt->rowCount() >0;
    }

    public function updatePassword($id,$data = []){
        $this->stmt = $this->conn->prepare('UPDATE users SET password=:pwd  where id=:id');
        $this->stmt->bindValue(':pwd',$data['new-password']??null);
        $this->stmt->bindValue(':id',$id);
        $this->execute();
        return $this->stmt->rowCount() >0;
    }

    public function getAllPosts($user_id){
        $this->stmt = $this->conn->prepare('SELECT p.*,u.name,u.avatar,(SELECT count(id) FROM post_reactions where post_id=p.id and reaction="dislike") as dislike_count,(SELECT count(id) FROM post_reactions where post_id=p.id and reaction="like") as like_count,(SELECT reaction FROM post_reactions where post_id=p.id and user_id=:uid limit 1) as user_reaction FROM posts p JOIN users u on u.id=p.user_id LEFT JOIN post_reports pre on pre.post_id = p.id where (SELECT count(id) FROM post_reports pr where pr.post_id=p.id) < 3');
        $this->stmt->bindValue(':uid',$user_id);
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserPosts($user_id){
        $this->stmt = $this->conn->prepare('SELECT p.*,u.name,u.avatar,(SELECT count(id) FROM post_reactions where post_id=p.id and reaction="dislike") as dislike_count,(SELECT count(id) FROM post_reactions where post_id=p.id and reaction="like") as like_count,(SELECT reaction FROM post_reactions where post_id=p.id and user_id=:uid limit 1) as user_reaction FROM posts p JOIN users u on u.id=p.user_id LEFT JOIN post_reports pre on pre.post_id = p.id where (SELECT count(id) FROM post_reports pr where pr.post_id=p.id) < 3 AND p.user_id = :uid');
        $this->stmt->bindValue(':uid',$user_id);
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPost($id){
        $this->stmt = $this->conn->prepare('SELECT * FROM posts WHERE id=:id');
        $this->stmt->bindParam(':id',$id);
        $this->execute();
        return $this->stmt->fetchObject();
    }

    public function storePost($id,$data= [],$files =[]){
        $uploads_dir = "uploads/posts";
        $attachments = [];
        foreach ($files["photos"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $files["photos"]["tmp_name"][$key];
                $name = rand().'.'.explode('.',$files["photos"]["name"][$key])[1];
                if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
                    $attachments[] = $name;
                }
            }
        }
        $this->stmt = $this->conn->prepare('INSERT INTO posts (title,description,attachments,user_id,created_at) VALUES (:ti,:desc,:att,:id,:cr)');
        $this->stmt->bindParam(':id',$id);
        $this->stmt->bindValue(':ti',$data['title']??null);
        $this->stmt->bindValue(':desc',$data['description']??null);
        $this->stmt->bindValue(':att',json_encode($attachments));
        $this->stmt->bindValue(':cr',date('Y-m-d H:i:s'));
        $this->execute();
        return $this->stmt->rowCount()>0;
    }

    public function updatePost($id,$data= []){
        $this->stmt = $this->conn->prepare('UPDATE posts SET title=:ti,description=:desc,attachments=:att WHERE id=:id');
        $this->stmt->bindParam(':id',$id);
        $this->stmt->bindValue(':ti',$data['title']??null);
        $this->stmt->bindValue(':desc',$data['description']??null);
        $this->stmt->bindValue(':att',$data['attachments']??null);
        $this->execute();
        return $this->stmt->rowCount()>0;
    }


    public function removePost($id){
        $this->stmt = $this->conn->prepare('DELETE FROM posts WHERE id=:id');
        $this->stmt->bindParam(':id',$id);
        $this->execute();
        return $this->stmt->rowCount()>0;
    }

    public function reportPost($user_id,$post_id){
        $this->stmt = $this->conn->prepare('INSERT INTO post_reports (user_id,post_id) values (:uid,:pid)');
        $this->stmt->bindParam(':uid',$user_id);
        $this->stmt->bindParam(':pid',$post_id);
        $this->execute();
        return $this->stmt->rowCount()>0;
    }

    public function getReportPost($user_id,$post_id){
        $this->stmt = $this->conn->prepare('SELECT * FROM post_reports WHERE user_id=:uid and post_id=:pid');
        $this->stmt->bindParam(':uid',$user_id);
        $this->stmt->bindParam(':pid',$post_id);
        $this->execute();
        return $this->stmt->fetchObject();
    }
    public function getReactPost($user_id,$post_id){
        $this->stmt = $this->conn->prepare('SELECT * FROM post_reactions WHERE user_id=:uid and post_id=:pid');
        $this->stmt->bindParam(':uid',$user_id);
        $this->stmt->bindParam(':pid',$post_id);
        $this->execute();
        return $this->stmt->fetchObject();
    }
    public function storeReactPost($user_id,$post_id,$reaction){
        $this->stmt = $this->conn->prepare('INSERT INTO post_reactions (reaction,user_id,post_id) values (:re,:uid,:pid)');
        $this->stmt->bindParam(':re',$reaction);
        $this->stmt->bindParam(':uid',$user_id);
        $this->stmt->bindParam(':pid',$post_id);
        $this->execute();
        return $this->stmt->rowCount()>0;
    }
    public function updateReactPost($id,$reaction){
        $this->stmt = $this->conn->prepare('UPDATE post_reactions SET reaction=:re WHERE id=:id');
        $this->stmt->bindParam(':re',$reaction);
        $this->stmt->bindParam(':id',$id);
        $this->execute();
        return $this->stmt->rowCount()>0;
    }

    public function reactPost($user_id,$post_id,$reaction){
        $reactionExist = $this->getReactPost($user_id,$post_id);
        if($reactionExist){
            return $this->updateReactPost($reactionExist->id,$reaction);
        }
        return $this->storeReactPost($user_id,$post_id,$reaction);
    }
}