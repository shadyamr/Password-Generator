<?php

class Password
{
    public int $value = 12;
    function PasswordGen($length)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*_=+-/.?<>';
        $password = array();
        $chars_length = strlen($chars) - 1;
        for($i = 0; $i < $length; $i++)
        {
            $random = rand(0, $chars_length);
            $password[] = $chars[$random];
        }
        $pwd = implode($password);
        print($pwd);

        $this->hashPwd($pwd);
    }

    function hashPwd($pass)
    {
        $hash = password_hash($pass, PASSWORD_BCRYPT);
        $this->setHash($hash);
    }

    function setHash($hash)
    {
        $this->hash = $hash;
    }

    function getHash()
    {
        echo $this->hash;
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Password Generator by Shady Amr.">
    <meta name="author" content="Shady Amr">
    <title>Password Generator</title>
    <link href="style.css" rel="stylesheet">
    <meta name="theme-color" content="#712cf9">
</head>

<body>

    <div class="col-lg-8 mx-auto p-3 py-md-5">
        <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">Shady</span>
            </a>
        </header>
        <?php
            $pwd = new Password();
        ?>
        <main>
            <h1>Password Generator</h1>
            <p>Create a secure, complex, and random password to protect yourself online!</p>
            <input class="form-control" type="text" value="<?php $pwd->PasswordGen($pwd->value); ?>" aria-label="password" readonly>
            <?php
                if($pwd->value >= 11)
                {
                    echo 
                    "
                    <div class='mt-2 mb-2 progress' style='height: 20px;'>
                        <div class='progress-bar bg-success' role='progressbar' style='width: 100%;' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>
                    </div>
                    ";
                }
                else if($pwd->value < 11 && $pwd->value >= 9)
                {
                    echo 
                    "
                    <div class='mt-2 mb-2 progress' style='height: 20px;'>
                        <div class='progress-bar bg-success' role='progressbar' style='width: 80%;' aria-valuenow='80' aria-valuemin='0' aria-valuemax='100'></div>
                    </div>
                    ";
                }
                else if($pwd->value < 9 && $pwd->value >= 7)
                {
                    echo 
                    "
                    <div class='mt-2 mb-2 progress' style='height: 20px;'>
                        <div class='progress-bar bg-warning' role='progressbar' style='width: 60%;' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100'></div>
                    </div>
                    ";
                }
                else if($pwd->value < 7 && $pwd->value >= 4)
                {
                    echo 
                    "
                    <div class='mt-2 mb-2 progress' style='height: 20px;'>
                        <div class='progress-bar bg-danger' role='progressbar' style='width: 40%;' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100'></div>
                    </div>
                    ";
                }
                else
                {
                    echo 
                    "
                    <div class='mt-2 mb-2 progress' style='height: 20px;'>
                        <div class='progress-bar bg-danger' role='progressbar' style='width: 0%;' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'></div>
                    </div>
                    ";
                }
            ?>

            <!--
                <label for="customRange2" class="mt-2 form-label">Password Length:</label>
                <input type="number" class="form-control form-control-sm mb-2" style="width: 15%;" value="12" minlength="0" maxlength="50">
            -->
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#hashPassword">Hash in BCRYPT!</button>
        </main>
    </div>

    <div class="modal fade" id="hashPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="hashPasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hashPasswordLabel">Hashed Password (BCRYPT)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Password has been hashed successfully!
            <div class="mt-2"></div>
            <input type="text" class="form-control" value="<?php $pwd->getHash();?>" readonly>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>
