<?php if ( ! defined( 'ABSPATH' ) ) exit;
$this->save();
$settings = $this->get();
$locales = $this->langs->locales();
$path = str_replace('\\','/', ABSPATH);
$url = site_url();
?>
<div class="wrap fma">
<h2><?php _e('Settings','file-manager-advanced')?> <?php if(!class_exists('file_manager_advanced_shortcode')) { ?><a href="https://advancedfilemanager.com/product/file-manager-advanced-shortcode-wordpress/" class="button button-primary" target="_blank"><?php _e('Buy Shortcode Addon','file-manager-advanced')?></a><?php } ?></h2>
<p style="width:100%; text-align:right;" class="description">
<span id="thankyou"><?php _e('Thank you for using <a href="https://wordpress.org/plugins/file-manager-advanced/">File Manager Advanced</a>. If happy then ','file-manager-advanced')?>
<a href="https://wordpress.org/support/plugin/file-manager-advanced/reviews/?filter=5"><?php _e('Rate Us','file-manager-advanced')?> <img src="<?php echo plugins_url( 'images/5stars.png', __FILE__ );?>" style="width:100px; top: 11px; position: relative;"></a></span>
</p>
<form action="" method="post">
<?php  wp_nonce_field( 'fmaform', '_fmaform' ); ?>
<table class="form-table">
<tbody>
<tr>
<th><?php _e('Theme','file-manager-advanced')?></th>
<td>
<select name="fma_theme" id="fma_theme">
	<option value="light" <?php echo(isset($settings['fma_theme']) && $settings['fma_theme'] == 'light') ? 'selected="selected"' : '';?>><?php _e('Light','file-manager-advanced')?></option>
	<option value="dark" <?php echo(isset($settings['fma_theme']) && $settings['fma_theme'] == 'dark') ? 'selected="selected"' : '';?>><?php _e('Dark','file-manager-advanced')?></option>
	<option value="grey" <?php echo(isset($settings['fma_theme']) && $settings['fma_theme'] == 'grey') ? 'selected="selected"' : '';?>><?php _e('Grey','file-manager-advanced')?></option>
	<option value="windows10" <?php echo(isset($settings['fma_theme']) && $settings['fma_theme'] == 'windows10') ? 'selected="selected"' : '';?>><?php _e('Windows 10','file-manager-advanced')?></option>
    <option value="bootstrap" <?php echo(isset($settings['fma_theme']) && $settings['fma_theme'] == 'bootstrap') ? 'selected="selected"' : '';?>><?php _e('Bootstrap','file-manager-advanced')?></option>
</select>
<p class="description"><?php _e('Select file manager advanced theme. Default: Light','file-manager-advanced')?></p>
</td>
</tr>
<tr>
<th><?php _e('Language','file-manager-advanced')?></th>
<td>
<select name="fma_locale" id="fma_locale">
<?php foreach($locales as $key => $locale) { ?>
<option value="<?php echo $locale;?>" <?php echo (isset($settings['fma_locale']) && $settings['fma_locale'] == $locale) ? 'selected="selected"' : '';?>><?php echo $key;?></option>
<?php } ?>
</select>
<p class="description"><?php _e('Select file manager advanced language. Default: en (English)','file-manager-advanced')?></p>
</td>
</tr>
<tr>
<th><?php _e('Public Root Path','file-manager-advanced')?></th>
<td>
<input name="public_path" type="text" id="public_path" value="<?php echo isset($settings['public_path']) && !empty($settings['public_path']) ? $settings['public_path'] : $path;?>" class="regular-text">
<p class="description"><?php _e('File Manager Advanced Root Path, you can change according to your choice.','file-manager-advanced')?></p>
<p>Default: <code><?php echo $path ?></code></p>
</td>
</tr>
<tr>
<th><?php _e('Files URL','file-manager-advanced')?></th>
<td>
<input name="public_url" type="text" id="public_url" value="<?php echo isset($settings['public_url']) && !empty($settings['public_url']) ? $settings['public_url'] : $url;?>" class="regular-text">
<p class="description"><?php _e('File Manager Advanced Files URL, you can change according to your choice.','file-manager-advanced')?></p>
<p>Default: <code><?php echo $url ?></code></p>
</td>
</tr>
<tr>
<th><?php _e('Hide File Path on Preview ?','file-manager-advanced');
?></th>
<td>
<input name="hide_path" type="checkbox" id="hide_path" value="1" <?php echo isset($settings['hide_path']) && ($settings['hide_path'] == '1') ? 'checked="checked"' : '';?>>
<p class="description"><?php _e('Hide real path of file on preview.','file-manager-advanced')?></p>
<p>Default: <code><?php _e('Not Enabled','file-manager-advanced')?></code></p>
</td>
</tr>
<tr>
<th><?php _e('Enable Trash?','file-manager-advanced');
?></th>
<td>
<input name="enable_trash" type="checkbox" id="enable_trash" value="1" <?php echo isset($settings['enable_trash']) && ($settings['enable_trash'] == '1') ? 'checked="checked"' : '';?>>
<p class="description"><?php _e('Deleted files will go to trash folder, you can restore later.','file-manager-advanced')?></p>
<p>Default: <code><?php _e('Not Enabled','file-manager-advanced')?></code></p>
</td>
</tr>
</tbody>
</table>
<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
</form>
</div>