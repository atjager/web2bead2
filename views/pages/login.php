
<div style="width: 350px; margin:auto">
<form name="form1" method="post" action="?controller=user&action=login">
<div class="field">
  <label class="label">Username</label>
  <div class="control">
    <input name=username class="input" required type="text" placeholder="Text input">
  </div>
</div>

<div class="field">
  <label class="label">Password</label>
  <div class="control">
    <input name="password" type="password" required class="input" type="text" placeholder="Text input">
  </div>
</div>

<div class="field is-grouped">
  <div class="control">
    <button name="submit" class="button is-link">Submit</button>
  </div>

</div>
</div>
<p>New User <a href="?controller=pages&action=register">Register Here</a></p>