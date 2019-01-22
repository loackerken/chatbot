<?php
class myLib{
  public function Register($name,$lastname,$email,$username,$password){
    try{
      $db=DB();
      $query=$db->prepare("INSERT INTO user(name,lastname,email,username,password)
      VALUES(:name,:lastname,:email,:username,:password)");
      $query->bindParam("name",$name);
      $query->bindParam("lastname",$lastname);
      $query->bindParam("username",$username);
      $query->bindParam("email",$email);
      $query->bindParam("password",$enc_password);
      $enc_password=hash('sha256',$password);
      $query->execute();
      return $db->lastInsertID();
      }catch(PDOException $e){
        exit($e-> getMessage());
      }
      }
//---------------------------------------------------------------//
public function Edituser($user_id,$name,$lastname,$email,$password){
  try{
    $db=DB();
    $query=$db->prepare("UPDATE user SET name='$name',lastname='$lastname',email='$email',password='$password' WHERE user.user_id='$user_id'");
    $query->bindParam("name",$name);
    $query->bindParam("user_id",$user_id);
    $query->bindParam("lastname",$lastname);
    $query->bindParam("email",$email);
    $enc_password=hash('sha256',$password);
    $query->bindParam("password",$enc_password);
    $query->execute();
    return $db->lastInsertID();

    }catch(PDOException $e){
      exit($e-> getMessage());
    }
    }

//--------------------------------------------------------------//
public function isEmail($email){
  try{
    $db=DB();
    $query=$db->prepare("SELECT user_id FROM user WHERE email=:email");
    $query->bindParam("email",$email);
    $query->execute();
    if($query->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  } catch (PDOException $e){
    exit($e->getMessage());
  }
}

//----------------------------------------------------//

public function isUsername($username){
  try{
    $db=DB();
    $query=$db->prepare("SELECT user_id FROM user WHERE username=:username");
    $query->bindParam("username",$username);
    $query->execute();
    if($query->rowCount()>0) {
      return true;
    } else {
      return false;
    }
  } catch(PDOException $e){
    exit($e->getMessage());
  }
}
//------------------------------------------------------//

public function UserDetails($user_id){
  try{
    $db=DB();
    $db->exec("SET CHARACTER SET utf8");
    $query=$db->prepare("SELECT user.user_id,
                                user.lastname,
                                user.name,
                                user.username,
                                user.email,
                                user.password
                                FROM user WHERE user_id=:user_id");
    $query->bindParam("user_id",$user_id);
    $query->execute();
    if($query->rowCount()>0) {
      return $query->fetch(PDO::FETCH_OBJ);
    }
  } catch(PDOException $e){
    exit($e->getMessage());
  }
}
//---------------------------------------------------//

public function Login($username,$password){
try {
  $db=DB();
  $query=$db->prepare("SELECT user_id FROM user WHERE (username=:username) AND password=:password");
  $query->bindParam("username",$username);
  $enc_password=hash('sha256',$password);
  $query->bindParam("password",$enc_password);
  $query->execute();
    if ($query->rowCount() > 0) {
      $result=$query->fetch(PDO::FETCH_OBJ);
      return $result->user_id;
    }else {
      return false;
    }
  } catch (PDOException $e) {
    exit($e->getMessage());
  }
}

//-----------------------------------------------------------//
public function get_msg($user_id)    {
  try{
    $db=DB();
    $db->exec("SET CHARACTER SET utf8");
    $query=$db->prepare("SELECT chat.chat_id,
                                chat.user_id,
                                chat.message,
                                chat.time,
                                chat.type
                                FROM chat
                                WHERE user_id=:user_id
                                ORDER BY chat.chat_id asc");
    $query->bindParam("user_id",$user_id);
    $query->execute();
    if($query->rowCount() > 0){
      return $query->fetchAll(PDO::FETCH_NUM);
    }
  } catch(PDOException $e){
    exit($e->getMessage());
  }
}

//---------------------------------------------------------------//
public function send_msg($user_id,$message,$type)    {
  try{
    $db=DB();
    $query=$db->prepare("INSERT INTO chat(user_id,message,type)
    VALUES(:user_id,:message,:type)");
    $query->bindParam("user_id",$user_id);
    $query->bindParam("message",$message);
    $query->bindParam("type",$type);
    $query->execute();
    return $db->lastInsertID();
    }catch(PDOException $e){
      exit($e-> getMessage());
    }
}

//----------------------------------------------------------//
public function get_ans($question){
  try{
    $db=DB();
    $db->exec("SET CHARACTER SET utf8");
    $query=$db->prepare("SELECT answer.ans FROM answer WHERE que=:message");
    $query->bindParam("message",$question);
    $query->execute();
    if($query->rowCount()>0) {
      return $query->fetch(PDO::FETCH_OBJ);
    }
  } catch(PDOException $e){
    exit($e->getMessage());
  }
}

//--------------------------------------------------------------//
public function detail_QA(){
  try{
    $db=DB();
    $query=$db->prepare("SELECT answer.ans_id,answer.que,answer.ans FROM answer ORDER BY answer.ans_id DESC");
    $query->execute();
    if($query->rowCount()>0) {
      return $query->fetchAll(PDO::FETCH_NUM);
    }
  } catch(PDOException $e){
    exit($e->getMessage());
  }
}

//-----------------------------------------------------------------//
public function insertQA($question,$answer)    {
  try{
    $db=DB();
    $query=$db->prepare("INSERT INTO answer(que,ans)
    VALUES(:que,:ans)");
    $query->bindParam("que",$question);
    $query->bindParam("ans",$answer);
    $query->execute();
    return $db->lastInsertID();
    }catch(PDOException $e){
      exit($e-> getMessage());
    }
}

}//...ปิดคลาส..//
?>
