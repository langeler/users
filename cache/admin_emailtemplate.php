<?php class_exists('View') or exit; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Email Template</title>
		<link href="<?php echo "https://users/assets/admin.css" ?>" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="admin">
        <header>
            <h1>Admin Panel</h1>
            <a class="responsive-toggle" href="#">
                <i class="fas fa-bars"></i>
            </a>
        </header>
        <aside class="responsive-width-100 responsive-hidden">
            <a href="<?php echo "https://users/admin" ?>"><i class="fas fa-users"></i>Accounts</a>
            <a href="<?php echo "https://users/admin/emailtemplate" ?>"><i class="fas fa-envelope"></i>Email Template</a>
            <a href="<?php echo "https://users/admin/settings" ?>"><i class="fas fa-tools"></i>Settings</a>
            <a href="<?php echo "https://users/logout" ?>"><i class="fas fa-sign-out-alt"></i>Log Out</a>
        </aside>
        <main class="responsive-width-100">
            
<h2>Email Template</h2>

<div class="content-block">
    <form action="" method="post" class="form responsive-width-100">
        <textarea name="emailtemplate"><?php echo $contents ?></textarea>
        <input type="submit" value="Save">
    </form>
</div>

        </main>
        <script>
        document.querySelector(".responsive-toggle").onclick = function(event) {
            event.preventDefault();
            var aside_display = document.querySelector("aside").style.display;
            document.querySelector("aside").style.display = aside_display == "flex" ? "none" : "flex";
        };
        </script>
    </body>
</html>





