<?php
/**
 * The Taxonomy settings area of the plugin
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
        <form method="POST" action="options.php">
            <?php
            settings_fields('ipm_tax_settings');
            do_settings_sections('ipm_tax_settings');
            ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <div class="right-pane">
        <div class="notes">
            <h3>Legend</h3>
            <p>
                <strong>Name</strong> is the general name of the Taxonomy - the one used in menu, title bars, etc.
                <strong>Singular, Plural</strong> are names used in the Menus
            </p>
            <p>
                The <strong>Slug</strong> setting is quite <strong>important!</strong>. It's generally the same as the
                name of the Taxonomy, but in lower case, and spaces replaced with dashes.
                It is used for the whole functionality of this plugin.
                <span class="warning">
                    If you change this after once it's set - it might break the whole
                    functionality of the plugin!
                </span>
            </p>
            <p>
                <strong>Show UI, Show Admin, Show Menu</strong> generally determine whether the Custom Post Type
                created to be visible in the menus. It's better if all of these have the same setting.
            </p>
            <p>
                <strong>Related Post Types</strong> - this is the list of Post Types that use this taxonomy. The slug
                of the CPT you've created in <strong>CPT Settings</strong> should be present here.<br>
                e.g. <code>post,jobs</code>
            </p>
        </div>
    </div>
</div>
