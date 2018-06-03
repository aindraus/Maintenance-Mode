<?php 
    // Options Page - Settings -> Maintenance Mode
function ced_maintenance_register_options_page() {
    add_options_page('CED Maintenance Mode', 'Maintenance Mode', 'activate_plugins', 'ced_maintenance_options', 'ced_maintenance_callback');
}
// Options Page Form
function ced_maintenance_callback() {
?>
    <div class="ced_maintenance_page_container">
        <?php screen_icon(); ?>
        <!-- Options Form -->
        <div class="ced_maintenance_mode_options_form">
        <h3>Maintenance Mode Settings</h3>
            <form method="post" action="options.php">
                <?php settings_fields('ced-maintenance-group'); ?>
                <div class="ced_m_form_group">
                    <label for="ced_m_activated">Activate Maintenance Mode:<p>Maintenance mode will display a maintenance screen for all incoming website visitors.</p></label>
                    <input type="checkbox" id="ced_m_activated" name="ced_m_activated" <?php $checked = get_option('ced_m_activated'); if($checked) { echo 'checked'; }; ?> />
                </div>
                <hr>
                <div class="ced_m_form_group">
                    <label for="ced_m_content">Maintenance Message: <p>Maintenance message will replace the default message displayed in the maintenance.php template.</p></label>
                    <?php 
                    $settings = array(
                        'teeny' => true,
                        'textarea_rows' => 15,
                        'tabindex' => 1,
                        'media_buttons' => false,
                        'textarea_name' => 'ced_m_content',
                        'wpautop' => false
                    );
                    $content = get_option('ced_m_content');
                    wp_editor($content, 'ced_m_editor', $settings); ?>
                </div>
                <div class="ced_m_form_group">
                    <label for="ced_m_notify-form">Notify Form Shortcode: <p>Add a form shortcode to display on the maintenance.php page. </p></label>
                    <input type="text" placeholder="[form-shortcode id='332']" value="<?php echo get_option('ced_m_notify-form'); ?>" id="ced_m_notify-form" name="ced_m_notify-form"/>
                </div>
                <hr>
                <div class="ced_m_password_section">
                    <h4>Password Protection</h4>
                    <p style="margin-top:0;">Allow visitors to access the website while under maintenance.</p>
                    <div class="ced_m_form_group">
                        <label for="ced_m_enable_pass" class="checkbox-label">Password Protected Access:<p>Allow visitors to access and browse the website while under maintenance.</p> </label>
                        <input type="checkbox" id="ced_m_enable_pass" class="ios-toggle" name="ced_m_enable_pass" <?php $enabled = get_option('ced_m_enable_pass'); if($enabled) { echo 'checked'; };?> />
                    </div>
                    <hr>
                    <div class="ced_m_form_group">
                        <label for="ced_m_password">Website Password:<p>Please note password is not encrypted. DO NOT use passwords used anywhere else on the website.</p></label>
                        <input type="text" id="ced_m_password" name="ced_m_password" value="<?php echo get_option('ced_m_password'); ?>" placeholder="Enter Website Password">
                    </div>
                </div>
                <!-- Submit Button -->
                <?php  submit_button(); ?>
            </form>
        </div>
    </div>
<?php
}
add_action('admin_menu', 'ced_maintenance_register_options_page');
// Register Plugin Options (Turn On/Off, Message, Background Image, Notify Form)
function ced_maintenance_register_settings() {
    // Activate Maintenance Mode Option
    add_option('ced_m_activated', false);
    register_setting('ced-maintenance-group', 'ced_m_activated');
    // Change Default Message on Under Maintenance Page
    add_option('ced_m_content', '');
    register_setting('ced-maintenance-group', 'ced_m_content');
    // Add Contact Form (Notify Form - Contact Form 7 Shortcode)
    add_option('ced_m_notify-form', '');
    register_setting('ced-maintenance-group', 'ced_m_notify-form');
    // Enable Password Protected Website Access
    add_option('ced_m_enable_pass', '');
    register_setting('ced-maintenance-group', 'ced_m_enable_pass');
    // Set Password to View Website
    add_option('ced_m_password', '');
    register_setting('ced-maintenance-group', 'ced_m_password');
}
add_action('admin_init', 'ced_maintenance_register_settings');
?>