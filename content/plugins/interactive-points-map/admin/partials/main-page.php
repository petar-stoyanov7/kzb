<?php
/**
 * The General Settings area
 *
 * @since      0.0.1
 *
 * @package    IPM
 * @subpackage IPM/admin/partials
 */
?>

<style>
    <?php require_once __DIR__ . '/css/main.css'; ?>
</style>
<div class="wrap">
    <div class="title">
        <div id="icon-themes" class="icon32"></div>
        <h2>IPM Custom Post Type Settings</h2>
    </div>
    <div class="left-pane">
        <?php settings_errors(); ?>
        <form method="POST" action="options.php">
            <?php
            settings_fields('ipm_general_settings');
            do_settings_sections('ipm_general_settings');
            ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <div class="right-pane">
        <div class="notes">
            <h3>Legend:</h3>
            <p>
                <strong>API Key</strong> is the Google API key that will be used to visualize the maps.
            </p>
        </div>
    </div>
</div>