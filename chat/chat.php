<?php 
session_start();
include_once "php/config.php";
if(!isset($_SESSION['id'])){
  header("location: " . SITE_URL);
}
?>
<?php include_once "header.php"; ?>
<script>document.title = 'Chat with';</script>
<div class="chat wrapper card">
  <section class="chat-area">
    <header>
      <?php 
      $user_id = (string) $_GET['user_id'];

      $sql = $db->query("SELECT * FROM user WHERE user_id = {$user_id}");
      $sql->execute();
      $rowCount = $sql->rowCount();

      if($rowCount > 0){
        $result = $sql->fetchAll();
        $row = array_shift( $result );
      }else{
        header("location: users.php");
      }
      ?>
      <a href="<?php echo SITE_URL ?>/chat" class="back-icon"><i class="fas fa-arrow-left"></i></a>
      <img src="<?php echo get_user_image($row['user_id']); ?>" alt="">
      <div class="details">
        <span><?php echo $row['user_name'] ?></span>
        <script>document.title += ' <?php echo $row['user_name'] ?>';</script>

        <p><?php echo $row['status']; ?></p>
      </div>
    </header>
    <div class="chat-box">

    </div>
    <form action="#" class="typing-area">
      <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
      <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
      <button><i class="fab fa-telegram-plane"></i></button>
    </form>
  </section>
</div>

<script src="javascript/chat.js"></script>

<?php include_once(dirname(__DIR__,1)."/inc/footer.php"); ?>