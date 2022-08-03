<?php
    session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BetterLtd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Roboto+Mono&display=swap" rel="stylesheet"/>
	  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
    
    <link rel="stylesheet" href="css/login.css">
  
  </head>
  <body>

    
    <section id="login">
      <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2 text-center">
            <h3>Login</h3>
            <div class="row">
              <div class="col-md-4">
                <img src="img/logo.png"/>
                <h5>BetterLtd</h5>
              </div>
              <div class="col-md-8 text-left">
                <form method="POST" action="login.php">
                  <div class="form-floating mb-4">
                    <input type="text" name="staffID" id="staffID" class="form-control form-control-sm" placeholder="Account ID" id="acc">
                    <label for="floatingInput">Account ID</label>
                  </div>
                  <div class="form-floating mb-4">
                    <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Password" id="pwd">
                    <label for="floatingPassword">Password</label>
                  </div>
                  <div class="mt-4">
                    <input type="submit" name="Login" value="Login" class="btn btn-primary"/>
                    <input type="submit" name="Login" value="Manager Login" class="btn btn-danger"/>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>



  </body>


</html>