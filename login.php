<?php  include_once "includes\head.php"; ?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>RealTime Chat Application</header>
            <form action="php/login.php" method="POST" enctype="multipart/form-data">
                <div class="error-text">This is an error message!</div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter Your email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter Your Password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button formLogin">
                   <input type="submit" onclick="Ajaxo()" value="Contenue to Chat">
                </div>
            </form>
            <div class="link">Not yet signed up ?<a href="index.php">Signup now</a></div>
        </section>
    </div>
    <script src="javascript\show_hid_password.js"></script>
    <script src="javascript/signup.js"></script>
</body>
</html>