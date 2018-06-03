<?php 
/*
*   Maintenance Page Template - Default
*/
if(isset($_POST['visitor_password'])){
    $_SESSION['website_password'] = $_POST['visitor_password'];
    header("Location: " . $_SERVER['REQUEST_URI']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Under Maintenance - <?php bloginfo('title'); ?></title>
    <link href="<?php echo plugin_dir_url(__DIR__) . 'assets/css/main.css';?>" rel="stylesheet">
</head>
<body>
    <section class="maintenance-content">
        <div class="logo">
            <?php 
                if(has_custom_logo()) {
                    echo '<img src="' . get_custom_logo() . '" alt="' . bloginfo('title') . '" />';
                } else {
            ?>
            <img src="<?php echo plugin_dir_url(__DIR__) . 'assets/images/ced.png'; ?>" alt="">
            <?php } ?>
        </div>
        <div class="maintenance-message">
            <?php 
            $content = get_option('ced_m_content');
            if(!empty($content)) {
                echo $content;
            } else {
            ?>
            <h3>Website is Down for Maintenance</h3>
            <p>We are adding new features that we think you will like very much!</p>
            <?php echo $_SESSION['website_password']; ?>
            <?php } ?>
        </div>
        <?php $notify = get_option('ced_m_notify-form'); 
            if(!empty($notify)) {
        ?>
        <div class="notify-form">
            <?php echo $notify; ?>
        </div>
            <?php } ?>
    </section>
    <?php
        if(get_option('ced_m_enable_pass')) {
        ?>
            <p>Please Enter Password</p>
            <form action="" method="post">
                <label>Website Password</p>
                <input type="password" name="visitor_password">
                <input type="submit" value="login">
            </form>
        <?php
        } 
    ?>
</body>
</html>