<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login Project control </title>
  <link rel="stylesheet" href="css/stylelogin.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body id="body">


  <div class="container">
    <div class="row" style="margin-top:250px; background:#151515; color:white;height:400px;">
      <div class="col-md-7 offset-md-3">
        <div class="form-group" style="margin-top:10%;padding:20px">
          <form action="inc/verify.inc.php" method="post">

            <h1><i class="fas fa-door-open"> Login Room</i></h1>
            <div class="textbox" style="margin-top:8%">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username">
            </div>

            <div class="textbox" style="margin-bottom:8%">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password">
            </div>
            <input type="submit" class="btn" value="Login" name="loginsubmit">
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>