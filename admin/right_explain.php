<?php
/*
 * WP Exclude Css-js
 * Right TD Explain in admin area
 */

if(defined('WP_EXPLUGIN_NAME') && get_locale() == 'it_IT') { ?>
<div style="background-color: #FFFBCC; color: #333; border: 1px solid #E6DB55; margin: 2px 2px 9px 2px; padding: 5px 10px; text-align: justify;">
    <h3 align="center">Snellisci il tuo WordPress</h3>
    <p>Il plugin <a href="<?php echo WP_EXPLUGIN_WP_URL; ?>"><?php echo WP_EXPLUGIN_NAME; ?></a> viene aggiornato e sviluppato da <a href="<?php echo WP_EXAUTHOR_SITE_URL; ?>"><?php echo WP_EXAUTHOR_FULLNAME; ?></a>.</p>
    <p>Se questo plugin ti è stato utile ringrazialo su <a target="_blank" href="<?php echo WP_EXGRAZIE_TWEET ?>">Twitter</a> e vieni a salutarlo sul suo blog: <a href="<?php echo WP_EXAUTHOR_SITE_URL; ?>"><?php echo WP_EXAUTHOR_SITE_NAME; ?></a>.</p>
        <h3 align="center">Serve un aiuto?</h3>
    <ol>
	    <li><a href="<?php echo WP_EXPLUGIN_WP_URL_INSTALL; ?>">Info installazione</a></li>
	    <li><a href="<?php echo WP_EXPLUGIN_WP_URL_FAQ; ?>">FAQ</a></li>
        <?php
        $git = WP_EXGITHUB_URL;
        echo ((!empty($git))? '<li><a target="_blank" href="'.WP_EXGITHUB_URL.'">Github</a></li>' : ''); ?>
        <li>Versione Plugin: <?php echo WP_EXPLUGIN_VERSION; ?></li>
    </ol>
    <?php
    if(strlen(WP_EXPLUGIN_WP_URL) > 1) { ?>
    	<h3 align="center">Vota questo plugin!</h3>
    	<p><a target="_blank" href="<?php echo WP_EXPLUGIN_WP_URL; ?>">Vota</a> questo plugin e dimmi se funziona oppure come migliorarlo. Il tuo feedback è importante per la buona realizzazione di questo progetto.</p>
	<?php } ?>
</div>
<?php }
else if(defined('WP_EXPLUGIN_NAME')) { ?>
<div style="background-color: #FFFBCC; color: #333; border: 1px solid #E6DB55; margin: 2px 2px 9px 2px; padding: 5px 10px; text-align: justify;">
    <h3 align="center">Speeds up your WordPress</h3>
    <p>This plugin <a href="<?php echo WP_EXPLUGIN_WP_URL; ?>"><?php echo WP_EXPLUGIN_NAME; ?></a> is updated and developed by <a href="<?php echo WP_EXAUTHOR_SITE_URL; ?>"><?php echo WP_EXAUTHOR_FULLNAME; ?></a>.</p>
    <p>If this plugin was useful to you thank him on <a target="_blank" href="<?php echo WP_EXTHANKYOU_TWEET ?>">Twitter</a> and greet him on his blog: <a href="<?php echo WP_EXAUTHOR_SITE_URL; ?>"><?php echo WP_EXAUTHOR_SITE_NAME; ?></a>.</p>
        <h3 align="center">Need Help?</h3>
    <ol>
	    <li><a href="<?php echo WP_EXPLUGIN_WP_URL_INSTALL; ?>">Installation info</a></li>
	    <li><a href="<?php echo WP_EXPLUGIN_WP_URL_FAQ; ?>">FAQ</a></li>
        <?php
        $git = WP_EXGITHUB_URL;
        echo ((!empty($git))? '<li><a target="_blank" href="'.WP_EXGITHUB_URL.'">Github</a></li>' : ''); ?>
        <li>Plugin Version: <?php echo WP_EXPLUGIN_VERSION; ?></li>
    </ol>
    <?php
    if(strlen(WP_EXPLUGIN_WP_URL) > 1) { ?>
    	<h3 align="center">Rate this plugin!</h3>
    	<p><a target="_blank" href="<?php echo WP_EXPLUGIN_WP_URL; ?>">Rate</a> this plugin and tell me if it works or how to improve. Your feedback is important for the successful implementation of this project.</p>
	<?php } ?>
</div>
<?php }
if(get_locale() == 'it_IT') { ?>
<div style="background-color: #fff; color: #333; border: 1px solid #E4E4E4; margin: 2px 2px 9px 2px; padding: 10px 10px 5px 10px; text-align: justify;">
    <b style="font-size: 1.17em;">Legenda:</b>
    <table style="width: 100%; margin-top: 5px;">
        <tr>
            <td valign="top"><span class="wp_ex_status_active">[Active]</span></td>
            <td valign="top" width="12">-></td>
            <td valign="top">Attivo e richiamto nel frontend</td>
        </tr>
        <tr>
            <td valign="top"><span class="wp_ex_status_disabled">[Disabled]</span></td>
            <td valign="top" width="12">-></td>
            <td valign="top">Rimosso dal frontend</td>
        </tr>
        <tr>
            <td valign="top"><span class="wp_ex_status_old">[Probably OLD]</span></td>
            <td valign="top" width="12">-></td>
            <td valign="top">Non più richiamato nel frontend (probabilmente rimosso dallo stesso plugin che ne faceva uso)</td>
        </tr>
    </table>
</div>
<?php } else { ?>
<div style="background-color: #fff; color: #333; border: 1px solid #E4E4E4; margin: 2px 2px 9px 2px; padding: 10px 10px 5px 10px; text-align: justify;">
    <b style="font-size: 1.17em;">Legend:</b>
    <table style="width: 100%; margin-top: 5px;">
        <tr>
            <td valign="top"><span class="wp_ex_status_active">[Active]</span></td>
            <td valign="top" width="12">-></td>
            <td valign="top">Active in frontend</td>
        </tr>
        <tr>
            <td valign="top"><span class="wp_ex_status_disabled">[Disabled]</span></td>
            <td valign="top" width="12">-></td>
            <td valign="top">Removed from frontend</td>
        </tr>
        <tr>
            <td valign="top"><span class="wp_ex_status_old">[Probably OLD]</span></td>
            <td valign="top" width="12">-></td>
            <td valign="top">Removed from frontend (removed by another plugin, not this!)</td>
        </tr>
    </table>
</div>
<?php } ?>
<div style="background-color: #fff; color: #333; border: 1px solid #E4E4E4; margin: 2px 2px 9px 2px; padding: 10px 10px 5px 10px; text-align: justify;">
    <table style="width: 100%;">
        <tr>
            <td valign="top">
                <?php if(get_locale() == 'it_IT') { ?>
                    <b style="font-size: 1.17em;">Offrimi una birra!</b><br /><br />
                    Se questo plugin ti è stato utile, ringraziami con 3,00€ simbolici per una birra :)
                    <br /><br /><br />
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
                    ">
                    <input type="image" src="https://www.paypalobjects.com/it_IT/IT/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - Il metodo rapido, affidabile e innovativo per pagare e farsi pagare.">
                    <img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
                    </form>
                <?php } else { ?>
                    <b style="font-size: 1.17em;">Give me a beer!</b><br /><br />
                    if this plugin was helpful thanks me with a beer for $ 2.5 :)
                    <br /><br /><br />
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
                    ">
                    <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
                    <img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
                    </form>
                <?php } ?>
            </td>
            <td valign="top">
                <img src="<?php echo WP_EXNERD_BEER; ?>" class="nerd_beer" />
            </td>
        </tr>
    </table>
</div>