<div class="wrap">
    <h1>Ziada Settings</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('ziada_settings_group');
        do_settings_sections('ziada_settings_group');
        ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="ziada_form_language">Form Language</label></th>
                <td>
                    <select id="ziada_form_language" name="ziada_form_language">
                        <option value="en" <?php selected(get_option('ziada_form_language'), 'en'); ?>>English</option>
                        <option value="sw" <?php selected(get_option('ziada_form_language'), 'sw'); ?>>Swahili</option>
                    </select>
                    <p class="description">Select the default language for the registration form labels.</p>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>