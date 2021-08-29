<?php
require ('connect.php');

?>
<form  action="input.php" method="post">
<div class="row mb-3">
    <label class="col-sm-2 col-form-label">SQL инъекция не возможна</label>
</div>
<div class="row mb-3">
    <label for="inputlogin" class="col-sm-2 col-form-label">Login</label>
    <div class="col-sm-10">
      <input type="login" name ="login1" class="form-control" id="inputLogin">
    </div>
</div>
<div class="row mb-3">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name ="password1" class="form-control" id="inputPassword">
    </div>
</div>
<div class="row mb-3">
    <label class="col-sm-2 col-form-label">SQL инъекция не возможна</label>
</div>
<div class="row mb-3">
    <label for="inputlogin" class="col-sm-2 col-form-label">Login</label>
    <div class="col-sm-10">
      <input type="login" name ="login2" class="form-control" id="inputLogin">
    </div>
</div>
<div class="row mb-3">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name ="password2" class="form-control" id="inputPassword">
    </div>
</div>

<p><input name="submit" type="submit" value="Input"></p>
</form>

