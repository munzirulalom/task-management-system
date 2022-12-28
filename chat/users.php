<?php 

if(!isset($_SESSION['id'])){
  header("location: ". SITE_URL);
}
?>
<?php require_once ("header.php"); ?>
<div class="chat wrapper card">
  <section class="users">
    <header>
      <div class="content">
        <?php 
        $sql = $db->prepare("SELECT * FROM user WHERE user_id = {$_SESSION['id']}");
        $sql->execute();
        $result = $sql->fetchAll();
        $row = array_shift( $result );
        ?>
        <img src="<?php echo get_user_image($row['user_id']); ?>" alt="">
        <div class="details">
          <span><?php echo $row['user_name'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </div>
      
    </header>
    <div class="search">
      <span class="text">Select an user to start chat</span>
      <input type="text" placeholder="Enter name to search...">
      <button>
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
      </button>
    </div>
    <div class="users-list">
      
    </div>
  </section>
</div>

<script src="<?php echo SITE_URL ?>/chat/javascript/users.js"></script>

<?php include_once(dirname(__DIR__,1)."/inc/footer.php"); ?>
