<?php
/*
 * WP Exclude Css-js
 * Top Refresh Explain in admin area
 */

$reset_text = ((get_locale() == 'it_IT')? 'Sicuro di voler resettare tutte le modifiche?\nRicorda di rieseguire il detect dei files cliccando su "Refresh".' : 'Are you sure you want to delete all changes?\nRemember to click "Refresh" to re-detect all files.');
?>
<div style="background-color: #fff; color: #333; border: 1px solid #E4E4E4; margin: 2px 0px 20px 0px; padding: 10px 10px 5px 10px; text-align: justify;">
	<table style="width: 100%; border-spacing: 0px; padding-bottom: 9px;">
		<tr>
			<td valign="top" style="padding: 0 0 9px 0;">
				<?php if(get_locale() == 'it_IT') { ?>
					Se non visualizzi i file "<?php echo $tab; ?>" utilizza il bottone "refresh" per forzare il detect dei file.<br />
					Puoi utilizzare il pulsante "Reset" per resettare tutte le modifiche fatte fin'ora.
				<?php } else { ?>
					If you cant see your "<?php echo $tab; ?>" files, try to push "refresh" button to force it.<br />
					You can use the "Reset" button to reset all the changes.
				<?php } ?>
			</td>
			<td style="padding: 0 0 9px 0;">
				<a class="wp_ex_refresh_btn" href="<?php echo admin_url().'options-general.php?'.http_build_query(array('page' => WP_EXPLUGIN_URL, 'refresh' => 'true', 'tab' => $tab)); ?>" style="float: right">
			    	<li class="wp_ex_refresh_ico"></li> Refresh
			    </a><br />
				<a class="reset_btn" style="float: right">
			    	<li class="wp_ex_delete_ico"></li> Reset
			    </a>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="border-top: 1px solid #E4E4E4; padding: 9px 0 0 0;">
				<table style="width: 100%; border-spacing: 0px;">
					<tr>
						<td style="width: 200px">
							<?php if(get_locale() == 'it_IT') { ?>
								<b>Detect durante la navigazione:</b>
							<?php } else { ?>
								<b>Detect during navigation:</b>
							<?php } ?>
						</td>
						<td>
							<div class="penguin-enabled <?php echo ((get_option(WP_EXNAVIGATION_DETECT) == 'true')? 'select' : ''); ?>" data-id="alterna_optionscustom-enable-css"></div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<?php if(get_locale() == 'it_IT') { ?>
								Abilita il <i>"Detect durante la navigazione"</i> solo se ritieni che manchino alcuni file dalla seguente lista, poi prova a navigare tra le varie pagine del sito.
								Ti consigliamo di <b style="color: #D54E21;">DISABILITARE il "Detect durante la navigazione"</b> <u>quando hai terminato i test</u>.
							<?php } else { ?>
								Enable <i>"Detect during navigation"</i> only if you think thant the list missing some files and then try to navigate around your site.
								We highly recommend to <b style="color: #D54E21;">DISABLE il "Detect during navigation"</b> <u>when you have finished the test</u>.
							<?php } ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<style type="text/css">
.wp_ex_refresh_ico { background-image: url('<?php echo WP_EXREFRESH_PNG; ?>'); }
#wp_ex_wrap .penguin-enabled {background-image: url('<?php echo WP_EXNAGIGATION_ENABLE; ?>'); }
.wp_ex_delete_ico { background-image: url('<?php echo WP_EXDELETE_ICO; ?>'); }
</style>
<script>
jQuery(document).ready(function($) {
	$('.penguin-enabled').click(function() {
		if($(this).hasClass('select')) {
			$(this).removeClass('select');
		} else {
			$(this).addClass('select');
		}

		setTimeout(function() {
        	window.location.replace("<?php echo admin_url().'options-general.php?'.http_build_query(array('page' => WP_EXPLUGIN_URL, 'detect' => 'change', 'tab' => $tab)); ?>");
		}, 500);
	})

	$('.reset_btn').click(function() {
		if(confirm('<?php echo $reset_text; ?>')) {
			window.location.replace("<?php echo admin_url().'options-general.php?'.http_build_query(array('page' => WP_EXPLUGIN_URL, 'reset' => 'true', 'tab' => $tab)); ?>");
		}
	});
});
</script>