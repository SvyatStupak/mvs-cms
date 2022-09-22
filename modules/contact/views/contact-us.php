<div class="starter-template">
  <h1><?= $pageObj->title ?></h1>
  <p><?= $pageObj->content ?></p>
  <form action="index.php" method="POST">
    <input type="hidden" name="seo_name" value="thank_you_for_contacted">
    <!-- <input type="hidden" name="action" value="submit"> -->
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Comment</label>
      <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
      <textarea name="comment" class="form-control" id="exampleInputPassword1" cols="30" rows="10"></textarea>
    </div>
    <div class="form-check">
    </div>
    <button type="submit" name='submit' class="btn btn-primary">Send</button>
  </form>
</div>