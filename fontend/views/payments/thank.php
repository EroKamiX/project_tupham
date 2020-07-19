
<div class="container">
    <?php if (!empty($this->error)) :?>
        <h2 class="alert alert-danger"><?php echo $this->error?></h2>
    <?php endif;?>
    <?php if (!empty($_SESSION['error'])) :?>
        <h2 class="alert alert-danger"><?php echo $_SESSION['error'] ; unset($_SESSION['error'])?></h2>
    <?php endif;?>
    <?php if (!empty($_SESSION['success'])) :?>
        <h2 class="alert alert-success"><?php echo $_SESSION['success'] ; unset($_SESSION['success'])?></h2>
    <?php endif;?>
    <?php echo $this->content?>
</div>