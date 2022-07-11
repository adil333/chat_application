<?php  include_once "includes\head.php"; ?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>RealTime Chat Application</header>
            <form action="php/signup.php" method="POST" enctype="multipart/form-data">
                <div class="error-text"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder="First Name">
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name">
                    </div>
                </div>
                <div class="field input">
                    <label>Email Adress</label>
                    <input type="text" name="email"placeholder="Enter your email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" class="password" name="password" autocomplete="on"placeholder="Enter your password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select image</label>
                    <input type="file" name="img">
                </div>
                <div class="field button formSignup">
                   <input type="submit" name="submit" onclick="Ajaxo()"  value="Contenue to Chat">
                </div>
            </form>
            <div class="link">Already signed up  ?<a href="login.php">Login now </a></div>
        </section>
    </div>
    <script src="javascript/show_hid_password.js"></script>
    <script src="javascript/signup.js"></script>
</body>

</html>