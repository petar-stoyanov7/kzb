<?php
/**
 * Import locations from json
 *
 * @since      0.0.1
 *
 * @package    IPM
 * @subpackage IPM/admin/partials
 */

$action = IPM_URI . 'admin/act/import.php';
?>

<style>
    <?php require_once __DIR__ . '/css/main.css'; ?>
    <?php require_once __DIR__ . '/css/form.css'; ?>
</style>
<div class="wrap">
    <div class="title">
        <div id="icon-themes" class="icon32"></div>
        <h2>IPM Custom Post Type Settings</h2>
    </div>
    <div class="left-pane">
        <form action="<?php echo $action ?>" name="import file" method="POST" enctype="multipart/form-data">
            <label for="locations">
                Upload JSON file:
                <input type="file" name="locations" id="locations" accept=".json">
            </label>
            <button type='submit'>Import</button>
        </form>
    </div>
    <div class="right-pane">
        <div class="notes">
            <h3>Instructions:</h3>
            <p>
                Import a json file, containing the locations structure.
                The json file must have structure like the following:
            </p>
            <pre>
            <code>
                {
                    "province1": [
                        "municipality1": ["city1", "city2"],
                        "municipality2": ["city3", "city4"],
                        ...
                    ],
                    "province2": [
                        "municipality3": ["city5", "city6"],
                        "municipality4": ["city7", "city8"],
                        ...
                    ],
                    ...
                }
            </code>
            </pre>
        </div>
    </div>
</div>