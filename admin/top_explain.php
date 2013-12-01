<?php
/*
 * WP Exclude Css-js
 * Top TD Explain in admin area
 */

if(get_locale() == 'it_IT') { ?>
<div style="background-color: #FFFBCC; color: #333; border: 1px solid #E6DB55; margin: 2px; margin: 2px 0px 9px 0; padding: 0 5px;">
    <p>Questo splendido plugin ti permette di togliere dalle pagine di <i>template</i> del frontend del tuo sito tutti i richiami ai file .css e .js che non servono, <b>solo se questi sono stati implementati correttamente</b> tramite le funzioni: <?php wp_ex_codex_references($tab); ?>.</p>
</div>
<?php }
else { ?>
<div style="background-color: #FFFBCC; color: #333; border: 1px solid #E6DB55; margin: 2px; margin: 2px 0px 9px 0; padding: 0 5px;">
    <p>This beautiful plugin allows you to remove from the pages of <i>template</i> in the frontend of your site all references to the .css and. .js file that do not serve, <b> only if they have been implemented correctly</b> using the functions: <?php wp_ex_codex_references($tab); ?>.</p>
</div>
<?php } ?>