<div>
  <h1>Login form</h1>
  <form action="/login" method="post">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="Username">
      <small id="helpUsername" class="form-text text-muted"></small>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
      <small id="helpId" class="form-text text-muted"></small>
    </div>

    <input type="submit" class="btn btn-primary" value="Login">
  </form>

</div>
